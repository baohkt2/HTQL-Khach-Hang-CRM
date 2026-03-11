{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
************************************************************************************}
{strip}
	{assign var=SELECTED_FIELDS value=$CUSTOMVIEW_MODEL->getSelectedFields()}
	{assign var=SELECTED_FIELD_NAMES value=array()}
	{foreach from=$SELECTED_FIELDS item=FIELD_INFO}
		{append var='SELECTED_FIELD_NAMES' value=$FIELD_INFO.columnname}
	{/foreach}
	<div id="customExportContainer" style="height:100%">
		<form id="customExportForm" class="form-horizontal" method="post" action="index.php" style="height:100%">
			<input type="hidden" name="module" value="{$SOURCE_MODULE}" />
			<input type="hidden" name="source_module" value="{$SOURCE_MODULE}" />
			<input type="hidden" name="action" value="ExportData" />
			<input type="hidden" name="viewname" value="{$VIEWID}" />
			<input type="hidden" name="mode" value="ExportAllData" />
			<input type="hidden" name="custom_export" value="1" />
			<input type="hidden" name="export_format" value="xlsx" />
			{if $SOURCE_MODULE eq 'Documents'}
				<input type="hidden" name="folder_id" value="{$FOLDER_ID}" />
				<input type="hidden" name="folder_value" value="{$FOLDER_VALUE}" />
			{/if}
			<input type="hidden" name="selected_ids" value={ZEND_JSON::encode($SELECTED_IDS)}>
			<input type="hidden" name="excluded_ids" value={ZEND_JSON::encode($EXCLUDED_IDS)}>
			<input type="hidden" id="page" name="page" value="{$PAGE}" />
			<input type="hidden" name="orderby" value="{$ORDER_BY}" />
			<input type="hidden" name="sortorder" value="{$SORT_ORDER}" />
			<input type="hidden" name="columnslist" value='{Vtiger_Functions::jsonEncode($SELECTED_FIELD_NAMES)}' />
			<input type="hidden" id="advfilterlist" name="advfilterlist" value='{Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($ADVANCE_CRITERIA))}' />
			<input type="hidden" id="selectedCustomExportFormatId" name="selected_format_id" value="" />
			<input type="hidden" id="savedCustomExportFormats" value='{Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($SAVED_EXPORT_FORMATS))}' />
			<input type="hidden" name="date_filters" data-value='{Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($DATE_FILTERS))}' />
			<div class="modal-content" style="height:100%">
				<div class="overlayHeader">
					{assign var=TITLE value={vtranslate($EXPORT_TITLE_LABEL, 'Vtiger')}}
					{include file="ModalHeader.tpl"|vtemplate_path:$MODULE TITLE=$TITLE}
				</div>
				<div class="modal-body" style="max-height:calc(100vh - 220px);overflow-y:auto;overflow-x:hidden;">
					<div class="custom-export-content row" style="height:100%">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="form-group">
								<label>{vtranslate('LBL_EXPORT_FILE_NAME', 'Vtiger')}&nbsp;<span class="redColor">*</span></label>
								<div class="row">
									<div class="col-lg-6 col-md-8 col-sm-12">
										<input class="form-control" type="text" id="filename" name="filename" value="{vtranslate('LBL_CUSTOM_EXPORT_DEFAULT_FILENAME', 'Vtiger')}" data-rule-required="true" data-rule-maxsize="150" />
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>{vtranslate('LBL_TITLE', 'Vtiger')}</label>
								<div class="row">
									<div class="col-lg-6 col-md-8 col-sm-12">
										<input class="form-control" type="text" id="exportTitle" name="export_title" value="{vtranslate('LBL_CUSTOM_EXPORT_DEFAULT_TITLE', 'Vtiger')}" data-rule-maxsize="255" />
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>{vtranslate('LBL_CHOOSE_COLUMNS', 'Vtiger')} ({vtranslate('LBL_MAX_NUMBER_FILTER_COLUMNS', 'CustomView')})</label>
								<div class="row" style="margin-bottom:10px;display:flex;align-items:flex-start;flex-wrap:wrap;">
									<div class="col-lg-3 col-md-4 col-sm-12" style="margin-bottom:10px;">
										<div class="btn-group" style="width:100%;">
											<button type="button" class="btn btn-default btn-sm dropdown-toggle js-saved-export-format-button" data-toggle="dropdown" style="width:100%;text-align:left;display:flex;justify-content:space-between;align-items:center;overflow:hidden;">
												<span class="js-saved-export-format-button-label">{vtranslate('LBL_SELECT_SAVED_EXPORT_FORMAT', 'Vtiger')}</span>
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu js-saved-export-format-menu" style="width:100%;max-height:220px;overflow-y:auto;"></ul>
										</div>
									</div>
									<div class="col-lg-9 col-md-8 col-sm-12" style="margin-bottom:10px;">
										<div class="columnsSelectDiv clearfix">
											{assign var=MAX_ALLOWED_COLUMNS value=100}
											<select name="selectColumns" data-rule-required="true" data-msg-required="{vtranslate('LBL_PLEASE_SELECT_ATLEAST_ONE_OPTION',$SOURCE_MODULE)}" data-placeholder="{vtranslate('LBL_ADD_MORE_COLUMNS', 'CustomView')}" multiple class="select2 columnsSelect" id="viewColumnsSelect" style="width:100%;">
												{foreach key=BLOCK_LABEL item=BLOCK_FIELDS from=$RECORD_STRUCTURE}
													<optgroup label='{vtranslate($BLOCK_LABEL, $SOURCE_MODULE)}'>
														{foreach key=FIELD_NAME item=FIELD_MODEL from=$BLOCK_FIELDS}
															{if $FIELD_MODEL->getDisplayType() == '6'}
																{continue}
															{/if}
															<option value="{$FIELD_MODEL->getCustomViewColumnName()}" data-field-name="{$FIELD_NAME}" {if in_array(decode_html($FIELD_MODEL->getCustomViewColumnName()), $SELECTED_FIELD_NAMES)}selected{/if}>{Vtiger_Util_Helper::toSafeHTML(vtranslate($FIELD_MODEL->get('label'), $SOURCE_MODULE))}{if $FIELD_MODEL->isMandatory() eq true} <span>*</span>{/if}</option>
														{/foreach}
													</optgroup>
												{/foreach}
												{if isset($EVENT_RECORD_STRUCTURE) && is_array($EVENT_RECORD_STRUCTURE)}
													{foreach key=BLOCK_LABEL item=BLOCK_FIELDS from=$EVENT_RECORD_STRUCTURE}
														<optgroup label='{vtranslate($BLOCK_LABEL, 'Events')}'>
															{foreach key=FIELD_NAME item=FIELD_MODEL from=$BLOCK_FIELDS}
																{if $FIELD_MODEL->getDisplayType() == '6'}
																	{continue}
																{/if}
																<option value="{$FIELD_MODEL->getCustomViewColumnName()}" data-field-name="{$FIELD_NAME}" {if in_array(decode_html($FIELD_MODEL->getCustomViewColumnName()), $SELECTED_FIELD_NAMES)}selected{/if}>{Vtiger_Util_Helper::toSafeHTML(vtranslate($FIELD_MODEL->get('label'), $SOURCE_MODULE))}{if $FIELD_MODEL->isMandatory() eq true} <span>*</span>{/if}</option>
															{/foreach}
														</optgroup>
													{/foreach}
												{/if}
											</select>
										</div>
									</div>
								</div>
								<div class="row" style="display:flex;align-items:center;flex-wrap:wrap;gap:12px;margin-left:0;margin-right:0;">
									<div style="padding-top:6px;margin-bottom:10px;white-space:nowrap;flex:0 0 auto;">
										<label class="checkbox-inline" style="font-weight:normal;margin-left:0;">
											<input type="checkbox" id="saveCustomExportFormat" name="save_custom_export_format" value="1" />
											{vtranslate('LBL_SAVE_EXPORT_FORMAT', 'Vtiger')}
										</label>
									</div>
									<div style="margin-bottom:10px;flex:0 1 360px;min-width:260px;">
										<input class="form-control" type="text" id="customExportFormatName" name="format_name" value="" placeholder="{vtranslate('LBL_EXPORT_FORMAT_NAME', 'Vtiger')}" disabled="disabled" data-rule-maxsize="150" />
									</div>
								</div>
							</div>

							<div class="form-group">
								<div>
									<input type="checkbox" name="export_row_number" value="1" id="export_row_number" />
									<label style="font-weight:normal" for="export_row_number">&nbsp;&nbsp;{vtranslate('LBL_EXPORT_ROW_NUMBER', 'Vtiger')}</label>
								</div>
							</div>

							<div class="form-group" id="customExportSignatureSection">
								<label><b>{vtranslate('LBL_EXPORT_SIGNATURE', 'Vtiger')}</b></label>
								<div class="js-signature-blocks" style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:8px;">
									<div class="js-signature-block" style="flex:1;min-width:200px;">
										<textarea name="signature_blocks[]" class="form-control" rows="7" style="font-size:12px;"></textarea>
										<button type="button" class="btn btn-xs btn-danger js-remove-signature-block" style="margin-top:4px;">{vtranslate('LBL_EXPORT_REMOVE_BLOCK', 'Vtiger')}</button>
									</div>
									<div class="js-signature-block" style="flex:1;min-width:200px;">
										<textarea name="signature_blocks[]" class="form-control" rows="7" style="font-size:12px;"></textarea>
										<button type="button" class="btn btn-xs btn-danger js-remove-signature-block" style="margin-top:4px;">{vtranslate('LBL_EXPORT_REMOVE_BLOCK', 'Vtiger')}</button>
									</div>
								</div>
								<button type="button" class="btn btn-xs btn-default js-add-signature-block"><i class="fa fa-plus"></i>&nbsp;{vtranslate('LBL_EXPORT_ADD_SIGNATURE_BLOCK', 'Vtiger')}</button>
								<div style="margin-top:6px;font-size:11px;color:#888;">
									{vtranslate('LBL_EXPORT_SIGNATURE_PLACEHOLDERS', 'Vtiger')}
								</div>
							</div>

							<div>
								<label class="filterHeaders">{vtranslate('LBL_CHOOSE_FILTER_CONDITIONS', 'Vtiger')} :</label>
								<div class="js-custom-export-filter-wrapper">
									{include file='AdvanceFilter.tpl'|@vtemplate_path RECORD_STRUCTURE=$RECORD_STRUCTURE ADVANCE_CRITERIA=$ADVANCE_CRITERIA MODULE='Vtiger'}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-overlay-footer clearfix">
					<div class="row clearfix">
						<div class="textAlignCenter col-lg-12 col-md-12 col-sm-12">
							<div>
								<button type="submit" class="btn btn-success btn-lg">{vtranslate($EXPORT_ACTION_LABEL, 'Vtiger')}&nbsp;.xlsx</button>
								&nbsp;&nbsp;&nbsp;<a class="cancelLink" data-dismiss="modal" href="#">{vtranslate('LBL_CANCEL', $MODULE)}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
{/strip}
{literal}
<script>
jQuery(function($) {
	var defaultBlock1 = "Ngày {current_date}\nNGƯỜI LẬP\n\n\n\n{user_name}";
	var defaultBlock2 = "Ngày .../.../...\nBP ĐÀO TẠO\n\n\n\nTrương Xuân Việt";
	var $sigTextareas = $('#customExportSignatureSection .js-signature-blocks textarea');
	if ($sigTextareas.length >= 2) {
		$sigTextareas.eq(0).val(defaultBlock1);
		$sigTextareas.eq(1).val(defaultBlock2);
	}

	$(document).on('click', '#customExportSignatureSection .js-add-signature-block', function() {
		var html = '<div class="js-signature-block" style="flex:1;min-width:200px;">' +
			'<textarea name="signature_blocks[]" class="form-control" rows="7" style="font-size:12px;"></textarea>' +
			'<button type="button" class="btn btn-xs btn-danger js-remove-signature-block" style="margin-top:4px;">Xóa</button>' +
			'</div>';
		$('#customExportSignatureSection .js-signature-blocks').append(html);
	});

	$(document).on('click', '#customExportSignatureSection .js-remove-signature-block', function() {
		$(this).closest('.js-signature-block').remove();
	});
});
</script>
{/literal}