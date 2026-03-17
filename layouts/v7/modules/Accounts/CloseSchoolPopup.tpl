{strip}
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<form class="form-horizontal" name="closeSchoolForm">
			<input type="hidden" name="module" value="{$MODULE}" />
			<input type="hidden" name="action" value="CloseSchool" />
			<input type="hidden" name="record" value="{$RECORD_ID}" />

			{include file="ModalHeader.tpl"|vtemplate_path:$MODULE TITLE={vtranslate('LBL_CLOSE_SCHOOL_POPUP_TITLE', $MODULE)}}

			<div class="modal-body">
				<div class="alert alert-warning">
					{vtranslate('LBL_CLOSE_SCHOOL_WARNING', $MODULE)}
				</div>

				<div class="row" style="margin-bottom: 12px;">
					<div class="col-lg-6">
						<strong>{vtranslate('LBL_CLOSE_SCHOOL_OLD_NAME', $MODULE)}:</strong>
						<span>{$ACCOUNT_NAME|escape:'html'}</span>
					</div>
					<div class="col-lg-6">
						<strong>{vtranslate('LBL_CLOSE_SCHOOL_NEW_NAME_PREVIEW', $MODULE)}:</strong>
						<span>{$CLOSED_NAME_PREVIEW|escape:'html'}</span>
					</div>
				</div>

				<div class="row" style="margin-bottom: 8px;">
					<div class="col-lg-12">
						<label>
							<input type="checkbox" id="selectAllCloseSchoolFields" checked="checked" />
							{vtranslate('LBL_CLOSE_SCHOOL_SELECT_ALL_FIELDS', $MODULE)}
						</label>
					</div>
				</div>

				<div class="row" style="max-height: 320px; overflow-y: auto; border: 1px solid #e6e6e6; padding: 10px 6px;">
					{foreach item=FIELD_INFO from=$INHERITABLE_FIELDS}
						<div class="col-lg-6" style="margin-bottom: 8px;">
							<label style="font-weight: normal;">
								<input type="checkbox" class="inheritFieldCheckbox" name="inherit_fields[]" value="{$FIELD_INFO.name|escape:'html'}" checked="checked" {if $FIELD_INFO.mandatory}disabled="disabled"{/if} />
								<strong>{$FIELD_INFO.label|escape:'html'}</strong>
								{if $FIELD_INFO.mandatory}<span class="redColor">*</span>{/if}
							</label>
							<div class="text-muted" style="padding-left: 18px;">{$FIELD_INFO.displayValue|escape:'html'}</div>
							{if $FIELD_INFO.mandatory}
								<input type="hidden" name="inherit_fields[]" value="{$FIELD_INFO.name|escape:'html'}" />
							{/if}
						</div>
					{/foreach}
				</div>

				<div class="row" style="margin-top: 12px;">
					<div class="col-lg-12">
						<small class="text-muted">{vtranslate('LBL_CLOSE_SCHOOL_STUDENT_LINK_NOTE', $MODULE)}</small>
					</div>
				</div>
			</div>

			{include file='ModalFooter.tpl'|@vtemplate_path:$MODULE BUTTON_NAME={vtranslate('LBL_CLOSE_SCHOOL', $MODULE)}}
		</form>
	</div>
</div>
{/strip}
