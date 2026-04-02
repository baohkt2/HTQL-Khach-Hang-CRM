{strip}
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" id="markAssignment" name="markAssignment" method="post" action="index.php">
				<input type="hidden" name="module" value="{$MODULE}" />
				<input type="hidden" name="action" value="MarkAssignment" />

				{assign var=TITLE value={vtranslate('LBL_MARK_ASSIGNMENT', $MODULE)}}
				{include file="ModalHeader.tpl"|vtemplate_path:$MODULE TITLE=$TITLE}

				<div class="modal-body">
					<div class="form-group">
						<label class="col-lg-4 control-label">{vtranslate('LBL_ASSIGNMENT_ACTION', $MODULE)}</label>
						<div class="col-lg-6">
							<select class="form-control select2" name="assignment_mode" data-rule-required="true">
								<option value="mark">{vtranslate('LBL_MARK_AS_ASSIGNED', $MODULE)}</option>
								<option value="unmark">{vtranslate('LBL_UNMARK_AS_ASSIGNED', $MODULE)}</option>
							</select>
						</div>
					</div>
				</div>

				{include file='ModalFooter.tpl'|@vtemplate_path:$MODULE}
			</form>
		</div>
	</div>
{/strip}
