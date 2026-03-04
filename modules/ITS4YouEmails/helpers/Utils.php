<?php
/*********************************************************************************
 * The content of this file is subject to the ITS4YouEmails license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

class ITS4YouEmails_Utils_Helper
{
    public static $htmlEventAttributes = [
        'onerror',
        'onblur',
        'onchange',
        'oncontextmenu',
        'onfocus',
        'oninput',
        'oninvalid',
        'onresize',
        'onauxclick',
        'oncancel',
        'oncanplay',
        'oncanplaythrough',
        'onreset',
        'onsearch',
        'onselect',
        'onsubmit',
        'onkeydown',
        'onkeypress',
        'onkeyup',
        'onclose',
        'oncuechange',
        'ondurationchange',
        'onemptied',
        'onended',
        'onclick',
        'ondblclick',
        'ondrag',
        'ondragend',
        'ondragenter',
        'ondragleave',
        'ondragover',
        'ondragexit',
        'onformdata',
        'onloadeddata',
        'onloadedmetadata',
        'ondragstart',
        'ondrop',
        'onmousedown',
        'onmousemove',
        'onmouseout',
        'onmouseover',
        'onmouseenter',
        'onmouseleave',
        'onpause',
        'onplay',
        'onplaying',
        'onmouseup',
        'onmousewheel',
        'onscroll',
        'onwheel',
        'oncopy',
        'oncut',
        'onpaste',
        'onload',
        'onprogress',
        'onratechange',
        'onsecuritypolicyviolation',
        'onselectionchange',
        'onabort',
        'onselectstart',
        'onstart',
        'onfinish',
        'onloadstart',
        'onshow',
        'onreadystatechange',
        'onseeked',
        'onslotchange',
        'onseeking',
        'onstalled',
        'onsubmit',
        'onsuspend',
        'ontimeupdate',
        'ontoggle',
        'onvolumechange',
        'onwaiting',
        'onwebkitanimationend',
        'onstorage',
        'onwebkitanimationiteration',
        'onwebkitanimationstart',
        'onwebkittransitionend',
        'onafterprint',
        'onbeforeprint',
        'onbeforeunload',
        'onhashchange',
        'onlanguagechange',
        'onmessage',
        'onmessageerror',
        'onoffline',
        'ononline',
        'onpagehide',
        'onpageshow',
        'onpopstate',
        'onunload',
        'onrejectionhandled',
        'onunhandledrejection',
        'onloadend',
        'onpointerenter',
        'ongotpointercapture',
        'onlostpointercapture',
        'onpointerdown',
        'onpointermove',
        'onpointerup',
        'onpointercancel',
        'onpointerover',
        'onpointerout',
        'onpointerleave',
        'onactivate',
        'onafterscriptexecute',
        'onanimationcancel',
        'onanimationend',
        'onanimationiteration',
        'onanimationstart',
        'onbeforeactivate',
        'onbeforedeactivate',
        'onbeforescriptexecute',
        'onbegin',
        'onbounce',
        'ondeactivate',
        'onend',
        'onfocusin',
        'onfocusout',
        'onrepeat',
        'ontransitioncancel',
        'ontransitionend',
        'ontransitionrun',
        'ontransitionstart',
        'onbeforecopy',
        'onbeforecut',
        'onbeforepaste',
        'onfullscreenchange',
        'onmozfullscreenchange',
        'onpointerrawupdate',
        'ontouchend',
        'ontouchmove',
        'ontouchstart',
    ];

    /**
     * @param int $templateId
     * @return bool
     */
    public static function isTemplateForListView($templateId)
    {
        $adb = PearDatabase::getInstance();
        $result = $adb->pquery(
            'SELECT * FROM vtiger_emakertemplates WHERE templateid=? AND deleted=? AND is_listview=?',
            array($templateId, 0, 1)
        );

        return (bool)$adb->num_rows($result);
    }

    /**
     * @param int $sendingId
     * @return array
     */
    public static function sendEmails($sendingId)
    {
        $adb = PearDatabase::getInstance();
        $sql = 'SELECT crmid FROM vtiger_crmentity 
            INNER JOIN its4you_emails ON its4you_emails.its4you_emails_id=vtiger_crmentity.crmid 
            WHERE setype=? AND deleted=? AND sending_id=?';
        $result = $adb->pquery($sql,
            ['ITS4YouEmails', 0, $sendingId]
        );

        $sendingResult = array(
            'total' => (int)$adb->num_rows($result),
            'error' => 0,
            'sent' => 0,
	        'error_message' => '',
        );

        while ($row = $adb->fetchByAssoc($result)) {
            /** @var ITS4YouEmails_Record_Model $recordModel */
            $recordModel = Vtiger_Record_Model::getInstanceById($row['crmid'], 'ITS4YouEmails');

            if ($recordModel) {
                $recordModel->send();
				$emailFlag = $recordModel->get('email_flag');

				if ($emailFlag === $recordModel::$FLAG_SENT) {
                    $sendingResult['sent']++;
                } else {
					$sendingResult['error_message'] .= '<br>[' . $emailFlag . '] ' . $recordModel->get('result');
	                $sendingResult['error']++;
                }
            }
        }

        return $sendingResult;
    }

	/**
	 * @return mixed
	 */
	public static function getSendingId()
    {
        return PearDatabase::getInstance()->getUniqueID('its4you_emails_sending');
    }

    /**
     * @param array $templateIds
     * @return array
     * @throws Exception
     */
    public static function validatePDFTemplates($templateIds, $templateInfo = [])
    {
        $templates = array_flip($templateIds);
        $pdfMakerModel = new PDFMaker_PDFMaker_Model();

        $adb = PearDatabase::getInstance();
        $result = $adb->pquery(
            'SELECT templateid as template_id, description, filename, module FROM vtiger_pdfmaker WHERE templateid IN (' . generateQuestionMarks($templateIds) . ')',
            $templateIds
        );

        while ($row = $adb->fetchByAssoc($result)) {
            $templateId = $row['template_id'];

            if ($pdfMakerModel->CheckTemplatePermissions($row['module'], $templateId, false)) {
                if(!empty($templateInfo) && method_exists($pdfMakerModel, 'getPreparedName')) {
                    $templateName = $pdfMakerModel->getPreparedName((array)$templateInfo['records'], [$templateId], $templateInfo['module'], $templateInfo['language']);
                } else {
                    $templateName = $row['filename'];
                }

                $templates[$templateId] = $templateName;
            } else {
                unset($templates[$templateId]);
            }
        }

        return $templates;
    }

    /**
     * @throws Exception
     */
    public static function getSavedFromField($templateId)
    {
		if(empty($templateId) && !vtlib_isModuleActive('EMAILMaker')) {
			return '';
		}

        $current_user = Users_Record_Model::getCurrentUserModel();
        $adb = PearDatabase::getInstance();
        $result = $adb->pquery(
            'SELECT fieldname FROM vtiger_emakertemplates_default_from WHERE templateid=? AND userid=?',
            array($templateId, $current_user->getId())
        );

        return $adb->query_result($result, 0, 'fieldname');
    }

    /**
     * @param array $fromEmails
     * @param string $savedDefaultFrom
     * @return string
     * @throws Exception
     */
    public static function getOrganizationFromEmails(&$fromEmails, $savedDefaultFrom = '')
    {
        $fromEmailField = ITS4YouEmails_Record_Model::getVtigerFromEmailField();
        $selectedDefaultFrom = '';

        if (!empty($fromEmailField)) {
            $adb = PearDatabase::getInstance();
            $result = $adb->pquery('select * from vtiger_organizationdetails where organizationname!=?', array(''));

            while ($row = $adb->fetchByAssoc($result)) {
                $fromKey = 'a::' . $row['organizationname'];
                $fromEmails[$fromKey] = $row['organizationname'] . ' &lt;' . $fromEmailField . '&gt;';

                if ('0_organization_email' === $savedDefaultFrom) {
                    $selectedDefaultFrom = $fromKey;
                }
            }
        }

        return $selectedDefaultFrom;
    }

    /**
     * @param array $fromEmails
     * @param string $savedDefaultFrom
     * @return string
     */
    public static function getUserFromEmails(&$fromEmails, $savedDefaultFrom = '')
    {
        $adb = PearDatabase::getInstance();
        $result = $adb->pquery(
            'SELECT fieldname, fieldlabel FROM vtiger_field WHERE tabid=? AND uitype IN ( ? , ? ) ORDER BY fieldid',
            array(29, 104, 13)
        );
        $currentUser = Users_Record_Model::getCurrentUserModel();
        $currentUserId = $currentUser->getId();
        $currentUserModel = Users_Record_Model::getInstanceById($currentUserId, 'Users');
        $selectedDefaultFrom = '';

        while ($row = $adb->fetchByAssoc($result)) {
            $fieldName = $row['fieldname'];

            if (!$currentUserModel->isEmpty($fieldName)) {
                $fromKey = $fieldName . '::' . $currentUserId;
                $fromEmails[$fromKey] = $currentUserModel->getName() . ' &lt;' . $currentUserModel->get($fieldName) . '&gt;';

                if ('1_' . $fieldName === $savedDefaultFrom) {
                    $selectedDefaultFrom = $fromKey;
                }
            }
        }

        return $selectedDefaultFrom;
    }

	/**
	 * @param $body
	 * @return array|mixed|string|string[]
	 */
	public static function updateShortUrlData($body)
    {
        $regex = '/shorturl[.]php[?]id[=][0-9a-z]*[.][0-9]*/m';

        preg_match_all($regex, $body, $matches, PREG_SET_ORDER, 0);

        foreach ($matches as $match) {
            $body = str_replace($match[0], $match[0] . '&fromcrm=1', $body);
        }

        return $body;
    }

	/**
	 * @param $value
	 * @param $replaceAll
	 * @return array|mixed|string|string[]
	 */
	public static function purifyHtmlEventAttributes($value, $replaceAll = false)
    {
        $tmp_markers = $office365ImageMarkers = [];
        $value = method_exists('Vtiger_Functions', 'strip_base64_data') ? Vtiger_Functions::strip_base64_data($value, true, $tmp_markers) : $value;
        $value = method_exists('Vtiger_Functions', 'stripInlineOffice365Image') ? Vtiger_Functions::stripInlineOffice365Image($value, true, $office365ImageMarkers) : $value;
        $tmp_markers = array_merge($tmp_markers, $office365ImageMarkers);

        // remove malicious html attributes with its value.
        if ($replaceAll) {
            $value = preg_replace('/\b(alert|on\w+)\s*\([^)]*\)|\s*(?:on\w+)=(".*?"|\'.*?\'|[^\'">\s]+)\s*/', '', $value);
            //remove script tag with contents
            $value = purifyScript($value);
            //purify javascript alert from the tag contents
            $value = purifyJavascriptAlert($value);
        } elseif (preg_match("/\s*(" . implode('|', self::$htmlEventAttributes) . ")\s*=/i", $value)) {
            $value = str_replace("=", "&equals;", $value);
        }

        //Replace any strip-markers
        if ($tmp_markers) {
            $keys = [];
            $values = [];

            foreach ($tmp_markers as $k => $v) {
                $keys[] = $k;
                $values[] = $v;
            }

            $value = str_replace($keys, $values, $value);
        }

        return $value;
    }

	/**
	 * @param int $recordId
	 * @param int $relationId
	 * @return bool
	 */
	public static function isRelationExists($recordId, $relationId)
	{
		$adb = PearDatabase::getInstance();
		$result = $adb->pquery(
			'SELECT crmid FROM vtiger_crmentityrel WHERE crmid = ? AND module = ? AND relcrmid = ? AND relmodule = ?',
			array($recordId, getSalesEntityType($recordId), $relationId, getSalesEntityType($relationId))
		);

		return $result && $adb->num_rows($result);
	}

	/**
	 * @param $recordModel
	 * @return mixed|string
	 */
	public static function getEmailFieldFromRecord($recordModel)
	{
		$moduleModel = $recordModel->getModule();
		$fields = $moduleModel->getFieldsByType('email');

		foreach ($fields as $field) {
			$fieldName = $field->get('name');

			if (!$recordModel->isEmpty($fieldName)) {
				return $fieldName;
			}
		}

		return '';
	}

	/**
	 * @param $fileDetail
	 * @return mixed
	 */
	public static function getAttachmentDetails($fileDetail)
	{
		$fileDetail['storedname'] = $fileDetail['storedname'] ?? $fileDetail['name'];
		$fileDetail['fileid'] = $fileDetail['attachmentsid'];
		$fileDetail['docid'] = $fileDetail['crmid'];
		$fileDetail['attachment'] = $fileDetail['name'];
		$fileDetail['nondeletable'] = false;
		$fileDetail['size'] = filesize(decode_html($fileDetail['path'] . $fileDetail['attachmentsid'] . '_' . $fileDetail['storedname']));

		return $fileDetail;
	}

	/**
	 * @param object|Vtiger_Record_Model $recordModel
	 * @return array
	 */
	public static function getRecordAttachments($recordModel)
	{
		$fileDetails = $recordModel->getFileDetails();
		$attachments = [];

		foreach ($fileDetails as $fileDetail) {
			$fileDetail = self::getAttachmentDetails($fileDetail);
			unset($fileDetail['docid']);
			unset($fileDetail['crmid']);

			$attachments[] = $fileDetail;
		}

		return $attachments;
	}

	/**
	 * @param $recordModel
	 * @return array
	 */
	public static function getMailManagerAttachments($recordModel)
	{
		$currentUser = Users_Record_Model::getCurrentUserModel();
		$sql = 'SELECT vtiger_attachments.* FROM vtiger_mailmanager_mailattachments 
    		INNER JOIN vtiger_attachments ON vtiger_attachments.attachmentsid=vtiger_mailmanager_mailattachments.attachid
    		WHERE muid=? AND userid=? AND cid IS NULL';
		$adb = PearDatabase::getInstance();
		$result = $adb->pquery($sql, [$recordModel->muid(), $currentUser->getId()]);

		$attachments = [];

		while ($row = $adb->fetchByAssoc($result)) {
			$fileDetail = self::getAttachmentDetails($row);
			unset($fileDetail['docid']);
			unset($fileDetail['crmid']);

			$attachments[] = $fileDetail;
		}

		return $attachments;
	}

	/**
	 * @param array|string $values
	 * @return array
	 */
	public static function getEmailIds($values)
	{
		$ids = [];

		if(is_string($values)) {
			$values = json_decode($values);
		}

		if (!is_array($values)) {
			$values = [];
		}

		foreach ($values as $value) {
			$ids[] = sprintf('email|%s|', $value);
		}

		return $ids;
	}

	/**
	 * @param $emailAddressId
	 * @param $emailAddress
	 * @return array
	 */
	public static function getArrayAllEmails($emailAddressId, $emailAddress)
	{
		return [
			'id' => $emailAddressId,
			'name' => $emailAddress,
			'emailid' => $emailAddress,
			'module' => '',
		];
	}

	/**
	 * @param $emailAddressId
	 * @param $emailAddress
	 * @return array
	 */
	public static function getArrayAllMailNamesList($emailAddressId, $emailAddress) {
		return [
			'id' => $emailAddressId,
			'recordid' => '',
			'sid' => '0',
			'label' => $emailAddress,
			'value' => $emailAddress,
			'module' => '',
		];
	}

    public static function isWritableStorage()
    {
        global $root_directory;

        $dir = rtrim($root_directory, '/');

        return is_writable($dir . '/storage/') && is_writable($dir . '/' . decideFilePath());
    }
}