{strip}
<div id="closeSchoolContainer" class="modelContainer">
	<div class="modal-header contentsBackground">
		<button data-dismiss="modal" class="close" title="{vtranslate('LBL_CLOSE')}">&times;</button>
		<h3>{vtranslate('LBL_CLOSE_SCHOOL_POPUP_TITLE', $MODULE)}</h3>
	</div>
	<form class="form-horizontal" id="closeSchoolForm" name="closeSchoolForm" method="post" action="index.php">
		<input type="hidden" name="module" value="{$MODULE}" />
		<input type="hidden" name="action" value="CloseSchool" />
		<input type="hidden" name="record" value="{$RECORD_ID}" />

		<div class="modal-body tabbable">
			<div class="alert alert-warning">
				{vtranslate('LBL_CLOSE_SCHOOL_WARNING', $MODULE)}
			</div>

			<div class="control-group">
				<div class="control-label" style="width: 180px;">{vtranslate('LBL_CLOSE_SCHOOL_OLD_NAME', $MODULE)}</div>
				<div class="controls" style="padding-top: 5px;">{$ACCOUNT_NAME|escape:'html'}</div>
			</div>
			<div class="control-group">
				<div class="control-label" style="width: 180px;">{vtranslate('LBL_CLOSE_SCHOOL_NEW_NAME_PREVIEW', $MODULE)}</div>
				<div class="controls" style="padding-top: 5px;">{$CLOSED_NAME_PREVIEW|escape:'html'}</div>
			</div>

			<div class="control-group">
				<div class="controls" style="margin-left: 190px;">
					<label class="checkbox" style="font-weight: bold;">
						<input type="checkbox" id="selectAllCloseSchoolFields" checked="checked" />
						{vtranslate('LBL_CLOSE_SCHOOL_SELECT_ALL_FIELDS', $MODULE)}
					</label>
				</div>
			</div>

			<div class="control-group">
				<div class="controls" style="margin-left: 190px; max-height: 320px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; width: 75%;">
					{foreach item=FIELD_INFO from=$INHERITABLE_FIELDS}
						<label class="checkbox" style="margin-bottom: 8px;">
							<input type="checkbox" class="inheritFieldCheckbox" name="inherit_fields[]" value="{$FIELD_INFO.name|escape:'html'}" checked="checked" {if $FIELD_INFO.mandatory}disabled="disabled"{/if} />
							<strong>{$FIELD_INFO.label|escape:'html'}</strong>
							{if $FIELD_INFO.mandatory}<span class="redColor">*</span>{/if}
						</label>
						<div class="muted" style="padding-left: 18px; margin-top: -6px; margin-bottom: 8px;">{$FIELD_INFO.displayValue|escape:'html'}</div>
						{if $FIELD_INFO.mandatory}
							<input type="hidden" name="inherit_fields[]" value="{$FIELD_INFO.name|escape:'html'}" />
						{/if}
					{/foreach}
				</div>
			</div>

			<div class="control-group">
				<div class="controls" style="margin-left: 190px;">
					<small class="muted">{vtranslate('LBL_CLOSE_SCHOOL_STUDENT_LINK_NOTE', $MODULE)}</small>
				</div>
			</div>
		</div>

		<div class="modal-footer">
			<div class="pull-right cancelLinkContainer" style="margin-top: 0px;">
				<a class="cancelLink" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', $MODULE)}</a>
			</div>
			<button class="btn btn-danger" type="submit" name="saveButton"><strong>{vtranslate('LBL_CLOSE_SCHOOL', $MODULE)}</strong></button>
		</div>
	</form>
</div>
{/strip}
