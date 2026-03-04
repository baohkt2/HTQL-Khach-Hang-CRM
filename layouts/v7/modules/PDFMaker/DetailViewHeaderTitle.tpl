{* ********************************************************************************
* The content of this file is subject to the PDF Maker Free license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
* Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
* All Rights Reserved.
* ****************************************************************************** *}

{strip}
	<div class="col-lg-6 col-md-6 col-sm-6">
		<div class="record-header clearfix">
			{if !$MODULE}
				{assign var=MODULE value=$MODULE_NAME}
			{/if}
			<div class="hidden-sm hidden-xs recordImage bg_{$MODULE} app-{$SELECTED_MENU_CATEGORY}">
				<div class="name">
					<span><strong><i class="vicon-{strtolower($MODULE)}"></i></strong></span>
				</div>  
			</div>

			<div class="recordBasicInfo">
				<div class="info-row">
					<h4>
						<span class="modulename_label">{vtranslate('LBL_MODULENAMES',$MODULE)}:</span>
						&nbsp;{vtranslate($RECORD->get('module'),$RECORD->get('module'))}
					</h4>
				</div>
			</div>
		</div>
	</div>
{/strip}