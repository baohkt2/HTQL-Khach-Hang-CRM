{*<!--
* 
* Copyright (C) www.vtiger.com. All rights reserved.
* @license Proprietary
*
-->*}
{strip}
<div class='modelContainer'>
	<div class="modal-header contentsBackground">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 style="color:green;">{$EXTENSION_NAME}</h3>
	</div>
        <div class="modal-body" id="installationLog">
            <div class="row-fluid" {if $ERROR=='yes'}style="color:red;"{/if}>{$MESSAGE}</div>
        </div>
	<div class="modal-footer">
		<span class="pull-right">
            <button class="btn btn-success" id="importCompleted" onclick="app.hideModalWindow();">{vtranslate('LBL_OK', 'VTEStore')}</button>
		</span>
	</div>
</div>
{/strip}