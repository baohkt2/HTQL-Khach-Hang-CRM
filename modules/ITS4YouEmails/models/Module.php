<?php
/*********************************************************************************
 * The content of this file is subject to the ITS4YouEmails license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

class ITS4YouEmails_Module_Model extends Vtiger_Module_Model
{
    public static $mobileIcon = 'mail';

    public static function isPHPMailerInstalled()
    {
        return is_file('modules/ITS4YouLibrary/PHPMailer/src/PHPMailer.php');
    }

    public static function isSendMailConfigured()
    {
        global $ITS4YouEmails_Mailer, $Emails_Mailer;

        if (is_file('modules/Emails/class.phpmailer.php')) {
            require_once 'modules/Emails/class.phpmailer.php';

            $mailer = new PHPMailer();
            $mailer->isSMTP();

            $Emails_Mailer = $mailer->Mailer;

            if ('smtp' !== $Emails_Mailer && $ITS4YouEmails_Mailer !== $Emails_Mailer) {
                return false;
            }
        }

        return true;
    }

    public function isQuickCreateSupported()
    {
        return false;
    }

    public function getSettingLinks()
    {
        $settingsLinks = parent::getSettingLinks();

        $currentUserModel = Users_Record_Model::getCurrentUserModel();

        if ($currentUserModel->isAdminUser()) {
            $settingsLinks[] = array(
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_INTEGRATION',
                'linkurl' => 'index.php?module=ITS4YouEmails&parent=Settings&view=Index',
            );
            $settingsLinks[] = array(
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_MODULE_REQUIREMENTS',
                'linkurl' => 'index.php?module=ITS4YouInstaller&parent=Settings&view=Requirements&mode=Module&sourceModule=ITS4YouEmails',
            );
            $settingsLinks[] = array(
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_LICENSE',
                'linkurl' => 'index.php?module=ITS4YouInstaller&view=License&parent=Settings&sourceModule=ITS4YouEmails',
            );
            $settingsLinks[] = array(
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_UPGRADE',
                'linkurl' => 'index.php?module=ModuleManager&parent=Settings&view=ModuleImport&mode=importUserModuleStep1',
            );
            $settingsLinks[] = array(
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_UNINSTALL',
                'linkurl' => 'index.php?module=ITS4YouInstaller&view=Uninstall&parent=Settings&sourceModule=ITS4YouEmails',
            );
        }

        return $settingsLinks;
    }

    public function getModuleBasicLinks()
    {
        return [
            [
                'linktype' => 'BASIC',
                'linklabel' => 'LBL_VTIGER_EMAILS',
                'linkurl' => $this->getListViewUrl() . '&targetModule=Emails',
                'linkicon' => 'fa-envelope',
            ]
        ];
    }

    public function getDatabaseTables()
    {
        return [
            'its4you_emails',
            'its4you_emailscf',
            'vtiger_its4you_email_no',
            'vtiger_its4you_email_no_seq',
            'vtiger_email_flag',
            'vtiger_email_flag_seq',
        ];
    }

    public function getPicklistFields()
    {
        return [
            'email_flag',
        ];
    }

    public function isStarredEnabled()
    {
        return false;
    }

	/**
	 * @return array
	 * @throws WebServiceException
	 */
	public function getEmailRelatedModules()
	{
		$userPrivModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		$relatedModules = vtws_listtypes(array('email'), Users_Record_Model::getCurrentUserModel());
		$relatedModules = $relatedModules['types'];

		foreach ($relatedModules as $key => $moduleName) {
			if ($moduleName === 'Users') {
				unset($relatedModules[$key]);
			}
		}

		foreach ($relatedModules as $moduleName) {
			$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
			if ($userPrivModel->isAdminUser() || $userPrivModel->hasGlobalReadPermission() || $userPrivModel->hasModulePermission($moduleModel->getId())) {
				$emailRelatedModules[] = $moduleName;
			}
		}

		$emailRelatedModules[] = 'Users';

		return $emailRelatedModules;
	}

	/**
	 * @param string $searchValue
	 * @param string $moduleName
	 * @return array
	 */
	public function searchEmails($searchValue, $moduleName = false)
	{
		$currentUser = Users_Record_Model::getCurrentUserModel();
		$emailsResult = [];
		$db = PearDatabase::getInstance();
		$emailsModuleModel = Vtiger_Module_Model::getInstance('Emails');
		$emailSupportedModulesList = $emailsModuleModel->getEmailRelatedModules();
		$fieldIds = [];
		$activeModules = [];

		foreach ($emailSupportedModulesList as $module) {
			if (in_array($module, ['Users', 'ModComments'])) {
				continue;
			}

			$activeModules[] = "'" . $module . "'";
			$activeModuleModel = Vtiger_Module_Model::getInstance($module);
			$moduleEmailFields = $activeModuleModel->getFieldsByType('email');

			foreach ($moduleEmailFields as $fieldName => $fieldModel) {
				if ($fieldModel->isViewable()) {
					$fieldIds[] = $fieldModel->get('id');
				}
			}
		}

		if ($moduleName) {
			$activeModules = ["'" . $moduleName . "'"];
		}

		$query = sprintf(
			'SELECT vtiger_emailslookup.crmid, vtiger_emailslookup.setype, vtiger_emailslookup.value, 
                          vtiger_crmentity.label FROM vtiger_emailslookup INNER JOIN vtiger_crmentity ON 
                          vtiger_crmentity.crmid = vtiger_emailslookup.crmid AND vtiger_crmentity.deleted=0 WHERE 
						  vtiger_emailslookup.fieldid IN (%s) AND 
						  vtiger_emailslookup.setype IN (%s) AND 
						  (vtiger_emailslookup.value LIKE ? OR vtiger_crmentity.label LIKE ?)',
			implode(',', $fieldIds),
			implode(',', $activeModules)
		);
		$emailOptOutIds = $emailsModuleModel->getEmailOptOutRecordIds();

		if (!empty($emailOptOutIds)) {
			$query .= sprintf(' AND vtiger_emailslookup.crmid NOT IN (%s)', implode(',', $emailOptOutIds));
		}

		$result = $db->pquery($query, ['%' . $searchValue . '%', '%' . $searchValue . '%']);
		$isAdmin = is_admin($currentUser);

		while ($row = $db->fetchByAssoc($result)) {
			if (!$isAdmin) {
				$recordPermission = Users_Privileges_Model::isPermitted($row['setype'], 'DetailView', $row['crmid']);

				if (!$recordPermission) {
					continue;
				}
			}

			$emailsResult[vtranslate($row['setype'], $row['setype'])][$row['crmid']][] = array(
				'value' => $row['value'],
				'label' => decode_html($row['label']) . ' <b>(' . $row['value'] . ')</b>',
				'name' => decode_html($row['label']),
				'module' => $row['setype']
			);
		}

		// For Users we should only search in users table
		$additionalModule = ['Users'];

		if (!$moduleName || in_array($moduleName, $additionalModule)) {
			foreach ($additionalModule as $moduleName) {
				$moduleInstance = CRMEntity::getInstance($moduleName);
				$searchFields = [];
				$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
				$emailFieldModels = $moduleModel->getFieldsByType('email');

				foreach ($emailFieldModels as $fieldName => $fieldModel) {
					if ($fieldModel->isViewable()) {
						$searchFields[] = $fieldName;
					}
				}

				$emailFields = $searchFields;
				$nameFields = $moduleModel->getNameFields();

				foreach ($nameFields as $fieldName) {
					$fieldModel = Vtiger_Field_Model::getInstance($fieldName, $moduleModel);

					if ($fieldModel->isViewable()) {
						$searchFields[] = $fieldName;
					}
				}

				if ($emailFields) {
					$userQuery = sprintf('SELECT %s,%s FROM vtiger_users WHERE deleted=0', $moduleInstance->table_index, implode(',', $searchFields));
					$result = $db->pquery($userQuery, []);

					while ($row = $db->fetchByAssoc($result)) {
						foreach ($emailFields as $emailField) {
							$emailFieldValue = decode_html($row[$emailField]);

							if ($emailFieldValue) {
								$recordLabel = getEntityFieldNameDisplay($moduleName, $nameFields, $row);

								if (strpos($emailFieldValue, $searchValue) !== false || strpos($recordLabel, $searchValue) !== false) {
									$emailsResult[vtranslate($moduleName, $moduleName)][$row[$moduleInstance->table_index]][] = [
										'value' => $emailFieldValue,
										'name' => $recordLabel,
										'label' => $recordLabel . ' <b>(' . $emailFieldValue . ')</b>',
										'module' => $moduleName,
									];
								}
							}
						}
					}
				}
			}
		}

		return $emailsResult;
	}
}