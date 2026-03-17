<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Emails_MassSaveAjax_View extends Vtiger_Footer_View {
	function __construct() {
		parent::__construct();
		$this->exposeMethod('massSave');
	}
	
	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'DetailView');
		return $permissions;
	}
	
	public function checkPermission(Vtiger_Request $request) {
		return parent::checkPermission($request);
	}

	public function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if(!empty($mode)) {
			echo $this->invokeExposedMethod($mode, $request);
			return;
		}
	}

	/**
	 * Function Sends/Saves mass emails
	 * @param <Vtiger_Request> $request
	 */
	public function massSave(Vtiger_Request $request) {
		global $upload_badext;
		$adb = PearDatabase::getInstance();
		$parentIds = '';

		$moduleName = $request->getModule();
		$currentUserModel = Users_Record_Model::getCurrentUserModel();
		$recordIds = $this->getRecordsListFromRequest($request);
		$documentIds = $request->get('documentids');
		$signature = $request->get('signature');
		// This is either SENT or SAVED
		$flag = $request->get('flag');
		$temporaryPdfFiles = array();
		$perRecipientPdfAttachments = array();

		$result = Vtiger_Util_Helper::transformUploadedFiles($_FILES, true);
		$_FILES = $result['file'];

		$recordId = $request->get('record');

		if(!empty($recordId)) {
			$recordModel = Vtiger_Record_Model::getInstanceById($recordId,$moduleName);
			$recordModel->set('mode', 'edit');
		}else{
			$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
			$recordModel->set('mode', '');
		}

		$parentEmailId = $request->get('parent_id',null);
		$attachmentsWithParentEmail = array();
		if(!empty($parentEmailId) && !empty ($recordId)) {
			$parentEmailModel = Vtiger_Record_Model::getInstanceById($parentEmailId);
			$attachmentsWithParentEmail = $parentEmailModel->getAttachmentDetails();
		}
		$existingAttachments = $request->get('attachments',array());
		if(empty($recordId)) {
			if(is_array($existingAttachments)) {
                /**
				 * When no document is selected from CRM in compose mail form, the $documentIds will be an empty string and not an array
				 * Since $documentIds is string and here we are trying to array push string it will throw fatal error.
				 */
				$documentIds = $documentIds ? $documentIds : array();
				foreach ($existingAttachments as $index =>  $existingAttachInfo) {
					$existingAttachInfo['tmp_name'] = $existingAttachInfo['name'];
					$existingAttachments[$index] = $existingAttachInfo;
					if(array_key_exists('docid',$existingAttachInfo)) {
						$documentIds[] = $existingAttachInfo['docid'];
						unset($existingAttachments[$index]);
					}

				}
			}
		}else{
			//If it is edit view unset the exising attachments
			//remove the exising attachments if it is in edit view

			$attachmentsToUnlink = array();
			$documentsToUnlink = array();


			foreach($attachmentsWithParentEmail as $i => $attachInfo) {
				$found = false;
				foreach ($existingAttachments as $index =>  $existingAttachInfo) {
					if($attachInfo['fileid'] == $existingAttachInfo['fileid']) {
						$found = true;
						break;
					}
				}
				//Means attachment is deleted
				if(!$found) {
					if(array_key_exists('docid',$attachInfo)) {
						$documentsToUnlink[] = $attachInfo['docid'];
					}else{
						$attachmentsToUnlink[] = $attachInfo;
					}
				}
				unset($attachmentsWithParentEmail[$i]);
			}
			//Make the attachments as empty for edit view since all the attachments will already be there
			$existingAttachments = array();
			if(!empty($documentsToUnlink)) {
				$recordModel->deleteDocumentLink($documentsToUnlink);
			}

			if(!empty($attachmentsToUnlink)){
				$recordModel->deleteAttachment($attachmentsToUnlink);
			}

		}

		// This will be used for sending mails to each individual
		$toMailInfo = $request->get('toemailinfo');

		$to = $request->get('to');
		if(is_array($to)) {
			$to = implode(',',$to);
		}
                $documentIds  = ((!empty($documentIds) && is_array($documentIds)) ? $documentIds:(!empty($documentIds))) ? (array)$documentIds : array();

		$content = $request->getRaw('description');
		$processedContent = Emails_Mailer_Model::getProcessedContent($content); // To remove script tags
		$mailerInstance = Emails_Mailer_Model::getInstance();
		$processedContentWithURLS = decode_html($mailerInstance->convertToValidURL($processedContent));
		$recordModel->set('description', $processedContentWithURLS);
		$recordModel->set('subject', $request->get('subject'));
		$recordModel->set('toMailNamesList',$request->get('toMailNamesList'));
		$recordModel->set('saved_toid', $to);
		$recordModel->set('ccmail', $request->get('cc'));
		$recordModel->set('bccmail', $request->get('bcc'));
		$recordModel->set('assigned_user_id', $currentUserModel->getId());
		$recordModel->set('email_flag', $flag);
		$recordModel->set('documentids', json_encode($documentIds));
		$recordModel->set('signature',$signature);

		$recordModel->set('toemailinfo', $_REQUEST['toemailinfo']);
		foreach($toMailInfo as $recordId=>$emailValueList) {
			if($recordModel->getEntityType($recordId) == 'Users'){
				$parentIds .= $recordId.'@-1|';
			}else{
				$parentIds .= $recordId.'@1|';
			}
		}
		$recordModel->set('parent_id', $parentIds);

		//save_module still depends on the $_REQUEST, need to clean it up
		$_REQUEST['parent_id'] = $parentIds;

		$success = false;
		$message = '';
		$selectedPdfTemplateId = 0;
		$pdfSourceModule = '';
		$viewer = $this->getViewer($request);
		if ($recordModel->checkUploadSize($documentIds)) {
			$canProceed = true;
			$selectedPdfTemplateId = $this->sanitizePdfTemplateId($request->get('pdf_template_id'));
			if ($flag === 'SENT' && !empty($selectedPdfTemplateId)) {
				$pdfSourceModule = $request->get('source_module');
				if (empty($pdfSourceModule)) {
					$canProceed = false;
					$message = vtranslate('LBL_RECORD_NOT_FOUND', $moduleName);
				} else {
					if (is_array($toMailInfo)) {
						foreach ($toMailInfo as $recipientRecordId => $emailValueList) {
							if (!is_numeric($recipientRecordId)) {
								continue;
							}
							$recipientRecordId = (int) $recipientRecordId;
							$recipientEntityType = getSalesEntityType($recipientRecordId);
							if (!empty($recipientEntityType) && $recipientEntityType !== $pdfSourceModule) {
								continue;
							}

							$pdfErrorMessage = '';
							$generatedPdfAttachment = $this->createGeneratedPdfAttachment($selectedPdfTemplateId, $recipientRecordId, $pdfSourceModule, $pdfErrorMessage);
							if ($generatedPdfAttachment === false) {
								$canProceed = false;
								$message = !empty($pdfErrorMessage) ? $pdfErrorMessage : 'Khong the tao file PDF tu mau da chon.';
								break;
							}

							$recipientKey = (string) $recipientRecordId;
							$perRecipientPdfAttachments[$recipientKey][] = $generatedPdfAttachment;
							if (!empty($generatedPdfAttachment['filepath'])) {
								$temporaryPdfFiles[] = $generatedPdfAttachment['filepath'];
							} else {
								$temporaryPdfFiles[] = $generatedPdfAttachment['path'] . '/' . $generatedPdfAttachment['storedname'];
							}
						}
					}

					if ($canProceed && empty($perRecipientPdfAttachments)) {
						$pdfSourceRecordId = $this->resolvePdfSourceRecordId($request, $recordIds, $toMailInfo, $pdfSourceModule);
						if (empty($pdfSourceRecordId)) {
							$canProceed = false;
							$message = vtranslate('LBL_RECORD_NOT_FOUND', $moduleName);
						} else {
							$pdfErrorMessage = '';
							$generatedPdfAttachment = $this->createGeneratedPdfAttachment($selectedPdfTemplateId, $pdfSourceRecordId, $pdfSourceModule, $pdfErrorMessage);
							if ($generatedPdfAttachment === false) {
								$canProceed = false;
								$message = !empty($pdfErrorMessage) ? $pdfErrorMessage : 'Khong the tao file PDF tu mau da chon.';
							} else {
								$perRecipientPdfAttachments['__default__'][] = $generatedPdfAttachment;
								if (!empty($generatedPdfAttachment['filepath'])) {
									$temporaryPdfFiles[] = $generatedPdfAttachment['filepath'];
								} else {
									$temporaryPdfFiles[] = $generatedPdfAttachment['path'] . '/' . $generatedPdfAttachment['storedname'];
								}
							}
						}
					}
				}
			}
			if ($canProceed) {
			// Fix content format acceptable to be preserved in table.
			$decodedHtmlDescriptionToSend = $recordModel->get('description');
			$recordModel->set('description', to_html($decodedHtmlDescriptionToSend));
			$recordModel->save();

			// Restore content to be dispatched through HTML mailer.
			$recordModel->set('description', $decodedHtmlDescriptionToSend);

			// To add entry in ModTracker for email relation
			$emailRecordId = $recordModel->getId();
			foreach ($toMailInfo as $recordId => $emailValueList) {
				$relatedModule = $recordModel->getEntityType($recordId);
				if (!empty($relatedModule) && $relatedModule != 'Users') {
					$relatedModuleModel = Vtiger_Module_Model::getInstance($relatedModule);
					$relationModel = Vtiger_Relation_Model::getInstance($relatedModuleModel, $recordModel->getModule());
					if ($relationModel) {
						$relationModel->addRelation($recordId, $emailRecordId);
					}
				}
			}
			// End

			//To Handle existing attachments
			$current_user = Users_Record_Model::getCurrentUserModel();
			$ownerId = $recordModel->get('assigned_user_id');
			$date_var = date("Y-m-d H:i:s");
			if(is_array($existingAttachments)) {
				foreach ($existingAttachments as $index =>  $existingAttachInfo) {
					/**
					 * For download or send email filename should not be in encoded format (md5)
					 * Ex: for PDF: if filename - abc_md5(abc).pdf then raw filename - abc.pdf
					 * For Normal documents: rawFileName is not exist in the attachments info. So it fallback to normal filename
					 */
					$rawFileName = $existingAttachInfo['attachment'];
					$file_name = $existingAttachInfo['storedname'];
					$path = $existingAttachInfo['path'];
					$fileId = $existingAttachInfo['fileid'];

					$oldFileName = $file_name;
					//SEND PDF mail will not be having file id
					if(!empty ($fileId)) {
						$oldFileName = $existingAttachInfo['fileid'].'_'.$file_name;
					}
					$oldFilePath = $path.'/'.$oldFileName;
					$binFile = sanitizeUploadFileName($rawFileName, $upload_badext);

					$current_id = $adb->getUniqueID("vtiger_crmentity");

					$filename = ltrim(basename(" " . $binFile)); //allowed filename like UTF-8 characters
					$filetype = $existingAttachInfo['type'];
					$filesize = $existingAttachInfo['size'];

					//get the file path inwhich folder we want to upload the file
					$upload_file_path = decideFilePath();
					$encryptFileName = Vtiger_Util_Helper::getEncryptedFileName($binFile);
					$newFilePath = $upload_file_path . $current_id . "_" . $encryptFileName;

					//expect attachment only from storage directory
					$allowedAttachmentFolders = array('storage');
					if (!empty($existingAttachInfo['is_generated_pdf'])) {
						$allowedAttachmentFolders[] = 'cache';
					}
					Vtiger_Utils::checkFileAccessIn($oldFilePath, $allowedAttachmentFolders);
					
					copy($oldFilePath, $newFilePath);

					$sql1 = "insert into vtiger_crmentity (crmid,smcreatorid,smownerid,setype,description,createdtime,modifiedtime) values(?, ?, ?, ?, ?, ?, ?)";
					$params1 = array($current_id, $current_user->getId(), $ownerId, $moduleName . " Attachment", $recordModel->get('description'), $adb->formatDate($date_var, true), $adb->formatDate($date_var, true));
					$adb->pquery($sql1, $params1);

					// Inserting $encrypedFilename into the sql query 
					$sql2 = "INSERT INTO vtiger_attachments(attachmentsid, name, description, type, path, storedname) values(?, ?, ?, ?, ?, ?)";
					$params2 = array($current_id, $filename, $this->column_fields['description'], $filetype, $upload_file_path, $encryptFileName);
					$adb->pquery($sql2, $params2);
					// NOTE: Missing storedname columns in below code
					// $sql2 = "insert into vtiger_attachments(attachmentsid, name, description, type, path) values(?, ?, ?, ?, ?)";
					// $params2 = array($current_id, $filename, $recordModel->get('description'), $filetype, $upload_file_path);
					// $result = $adb->pquery($sql2, $params2);

					$sql3 = 'insert into vtiger_seattachmentsrel values(?,?)';
					$adb->pquery($sql3, array($recordModel->getId(), $current_id));
				}
			}
			$success = true;
			if($flag == 'SENT') {
				$recordModel->set('perRecipientPdfAttachments', $perRecipientPdfAttachments);
				$recordModel->set('pdf_template_id', $selectedPdfTemplateId);
				$recordModel->set('pdf_source_module', $pdfSourceModule);
				$status = $recordModel->send(false, array(
					'perRecipientPdfAttachments' => $perRecipientPdfAttachments,
					'pdf_template_id' => $selectedPdfTemplateId,
					'pdf_source_module' => $pdfSourceModule
				));
				if ($status === true) {
					// This is needed to set vtiger_email_track table as it is used in email reporting
					$recordModel->setAccessCountValue();
				} else {
					$success = false;
					$message = $status;
				}
			}
			}

		} else {
			$message = vtranslate('LBL_MAX_UPLOAD_SIZE', $moduleName).' '.vtranslate('LBL_EXCEEDED', $moduleName);
		}
		$this->cleanupTemporaryFiles($temporaryPdfFiles);
		$viewer->assign('SUCCESS', $success);
		$viewer->assign('MESSAGE', $message);
		$viewer->assign('FLAG', $flag);
		$viewer->assign('MODULE',$moduleName);
		$loadRelatedList = $request->get('related_load');
		if(!empty($loadRelatedList)){
			$viewer->assign('RELATED_LOAD',true);
		}
		$viewer->view('SendEmailResult.tpl', $moduleName);
	}

	protected function sanitizePdfTemplateId($templateId) {
		if (empty($templateId) || !is_numeric($templateId)) {
			return 0;
		}
		return (int) $templateId;
	}

	protected function resolvePdfSourceRecordId(Vtiger_Request $request, $recordIds, $toMailInfo, $sourceModule) {
		$sourceRecord = $request->get('sourceRecord');
		if (!empty($sourceRecord) && is_numeric($sourceRecord)) {
			return (int) $sourceRecord;
		}

		if (is_array($recordIds)) {
			foreach ($recordIds as $recordId) {
				if (!is_numeric($recordId)) {
					continue;
				}
				$entityType = getSalesEntityType($recordId);
				if (!empty($sourceModule) && $entityType === $sourceModule) {
					return (int) $recordId;
				}
			}
		}

		if (is_array($toMailInfo)) {
			foreach ($toMailInfo as $recordId => $emails) {
				if (!is_numeric($recordId)) {
					continue;
				}
				$entityType = getSalesEntityType($recordId);
				if (!empty($sourceModule) && $entityType === $sourceModule) {
					return (int) $recordId;
				}
			}
		}

		return 0;
	}

	protected function createGeneratedPdfAttachment($templateId, $recordId, $sourceModule, &$errorMessage) {
		$errorMessage = '';
		$templateId = (int) $templateId;
		$recordId = (int) $recordId;

		if ($templateId <= 0 || $recordId <= 0 || empty($sourceModule)) {
			$errorMessage = 'Thieu thong tin de tao file PDF.';
			return false;
		}

		if (!class_exists('PDFMaker2_Record_Model') && file_exists('modules/PDFMaker2/models/Record.php')) {
			require_once 'modules/PDFMaker2/models/Record.php';
		}
		if (!class_exists('PDFMaker2_PDFRenderer_Model') && file_exists('modules/PDFMaker2/models/PDFRenderer.php')) {
			require_once 'modules/PDFMaker2/models/PDFRenderer.php';
		}

		if (!class_exists('PDFMaker2_Record_Model') || !class_exists('PDFMaker2_PDFRenderer_Model')) {
			$errorMessage = 'Khong tim thay module PDFMaker2.';
			return false;
		}

		$templateModel = PDFMaker2_Record_Model::getInstanceById($templateId);
		if (!$templateModel) {
			$errorMessage = 'Mau PDF khong ton tai hoac da bi xoa.';
			return false;
		}

		try {
			$pdfContent = PDFMaker2_PDFRenderer_Model::render($templateId, $recordId, $sourceModule, 'string');
		} catch (Exception $e) {
			$errorMessage = $e->getMessage();
			return false;
		}

		if ($pdfContent === false || $pdfContent === '') {
			$errorMessage = 'Khong nhan duoc noi dung PDF tu bo render.';
			return false;
		}

		$rootDirectory = rtrim(vglobal('root_directory'), '/');
		$tempDirRelative = 'cache/pdfmaker2/email';
		$tempDir = $rootDirectory . '/' . $tempDirRelative;
		if (!is_dir($tempDir) && !mkdir($tempDir, 0755, true)) {
			$errorMessage = 'Khong tao duoc thu muc tam de luu PDF.';
			return false;
		}

		$templateName = decode_html($templateModel->get('template_name'));
		$templateName = html_entity_decode($templateName, ENT_QUOTES, 'UTF-8');
		$templateName = preg_replace('/[\\\\\/:"*?<>|]+/u', ' ', $templateName);
		$templateName = preg_replace('/\s+/u', ' ', trim($templateName));
		if (empty($templateName)) {
			$templateName = 'PDF_Template';
		}
		$fileName = $templateName . '_' . $recordId . '_' . date('YmdHis') . '.pdf';
		$filePath = $tempDir . '/' . $fileName;

		if (file_put_contents($filePath, $pdfContent) === false) {
			$errorMessage = 'Khong ghi duoc file PDF tam.';
			return false;
		}

		return array(
			'attachment' => $fileName,
			'filepath' => $filePath,
			'storedname' => $fileName,
			'path' => $tempDirRelative,
			'fileid' => '',
			'type' => 'application/pdf',
			'size' => filesize($filePath),
			'pdf_content_base64' => base64_encode($pdfContent),
			'is_generated_pdf' => true
		);
	}

	protected function cleanupTemporaryFiles(array $paths) {
		if (empty($paths)) {
			return;
		}
		foreach ($paths as $path) {
			if (!empty($path) && file_exists($path) && is_file($path)) {
				@unlink($path);
			}
		}
	}

	/**
	 * Function returns the record Ids selected in the current filter
	 * @param Vtiger_Request $request
	 * @return integer
	 */
	public function getRecordsListFromRequest(Vtiger_Request $request, $model = false) {
		$cvId = $request->get('viewname');
		$selectedIds = $request->get('selected_ids');
		$excludedIds = $request->get('excluded_ids');

		if(!empty($selectedIds) && $selectedIds != 'all') {
			if(!empty($selectedIds) && php7_count($selectedIds) > 0) {
				return $selectedIds;
			}
		}

		if($selectedIds == 'all'){
			$sourceRecord = $request->get('sourceRecord');
			$sourceModule = $request->get('sourceModule');
			if ($sourceRecord && $sourceModule) {
				$sourceRecordModel = Vtiger_Record_Model::getInstanceById($sourceRecord, $sourceModule);
				return $sourceRecordModel->getSelectedIdsList($request->get('parentModule'), $excludedIds);
			}

			$customViewModel = CustomView_Record_Model::getInstanceById($cvId);
			if($customViewModel) {
				$searchKey = $request->get('search_key');
				$searchValue = $request->get('search_value');
				$operator = $request->get('operator');
				if(!empty($operator)) {
					$customViewModel->set('operator', $operator);
					$customViewModel->set('search_key', $searchKey);
					$customViewModel->set('search_value', $searchValue);
				}
				return $customViewModel->getRecordIds($excludedIds);
			}
		}
		return array();
	}

	public function validateRequest(Vtiger_Request $request) {
		$request->validateWriteAccess();
	}
}
