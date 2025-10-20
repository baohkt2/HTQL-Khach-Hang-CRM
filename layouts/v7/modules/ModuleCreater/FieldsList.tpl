{*<!--
/* * *******************************************************************************
 * The content of this file is subject to the CRMTiger Pro license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is https://crmtiger.com/
 * Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
 * All Rights Reserved.
 * ****************************************************************************** */
-->*}

{strip}

	{assign var=IS_SORTABLE value=$SELECTED_MODULE_MODEL->isSortableAllowed()}
	{assign var=ALL_BLOCK_LABELS value=[]}

<form class="form-horizontal saveModuleData" id="saveModuleData">
<div class="editViewBody" >	
	<div class="row" style="padding:1% 0">
		<div class="col-sm-6">
			<button class="btn btn-default addButton addCustomBlock" type="button">
				<i class="fa fa-plus"></i>&nbsp;
				{vtranslate('LBL_ADD_CUSTOM_BLOCK', $QUALIFIED_MODULE)}
			</button>
		</div>
		<div class="col-sm-6">
			{if $IS_SORTABLE}
				<span class="pull-right">
					<button class="btn btn-success hide" id="saveModule" type="button">
						{vtranslate('LBL_SAVE', $QUALIFIED_MODULE)}
					</button>
				</span>
			{/if}
		</div>
		<!--<div class="col-sm-6">
			{if $IS_SORTABLE}
				<span class="pull-right">
					<button class="btn btn-success saveFieldSequence" type="button">
						{vtranslate('LBL_SAVE_LAYOUT', $QUALIFIED_MODULE)}
					</button>
				</span>
			{/if}
		</div>-->
	</div>
	
	<div class="row">
		<div class="col-sm-12" >
			<div id="moduleBlocks" style="margin-top:17px;">
			<div class="tksfirstblock" ></div>
			
			<!--<div class="tksfirstblock" ></div>-->
				{foreach key=BLOCK_LABEL_KEY item=BLOCK_MODEL from=$BLOCKS}
					{assign var=IS_BLOCK_SORTABLE value=$SELECTED_MODULE_MODEL->isBlockSortableAllowed($BLOCK_LABEL_KEY)}
					{assign var=FIELDS_LIST value=$BLOCK_MODEL->getLayoutBlockActiveFields()}
					{assign var=BLOCK_ID value=0}
					{if $BLOCK_LABEL_KEY neq 'LBL_INVITE_USER_BLOCK'}
						{$ALL_BLOCK_LABELS[$BLOCK_ID] = $BLOCK_MODEL}
					{/if}
				{/foreach}
	
	<input type="hidden" name="module" value="{$MODULE}" />
	<input type="hidden" name="action" value="BuildModule" />
	<input type="hidden" name="mode" value="saveModule" />		
	<input type="hidden" id="token" name="token" value="{$smarty.request.token}" />
	<input type="hidden" id="tks_modulename" name="tks_modulename" value="{$TKSMODULE}" />
	<input type="hidden" id="tks_entity" name="tks_entity" value="{$TKSMODULE}" />
	
	<input type="hidden" class="inActiveFieldsArray" value='{Vtiger_Functions::jsonEncode($IN_ACTIVE_FIELDS)}' />
	<input type="hidden" id="headerFieldsCount" value="{$HEADER_FIELDS_COUNT}">
	<input type="hidden" id="nameFields" value='{Vtiger_Functions::jsonEncode($SELECTED_MODULE_MODEL->getNameFields())}'>
	<input type="hidden" id="headerFieldsMeta" value='{Vtiger_Functions::jsonEncode($HEADER_FIELDS_META)}'>
	<input type = 'hidden' name = 'tksblockid' value ='0' id = 'tksblockid' />
	<input type = 'hidden' name = 'tksblocklabel' value ='' id = 'tksblocklabel' />

	<div id="" class="newCustomBlockCopy hide marginBottom10px border1px blockSortable" data-block-id="" data-sequence="">
	
		<div class="layoutBlockHeader" >
			<div class="col-sm-5 blockLabel padding5 marginLeftZero" style="word-break: break-all;">
				<img class="alignMiddle" src="{vimage_path('drag.png')}" />&nbsp;&nbsp;
			</div>
			<div class="col-sm-7 padding10 marginLeftZero">
				<div class="blockActions" style="float: right !important;">
					<!--<span>
						<i class="fa fa-info-circle" title="{vtranslate('LBL_COLLAPSE_BLOCK_DETAIL_VIEW', $QUALIFIED_MODULE)}"></i>&nbsp; {vtranslate('LBL_COLLAPSE_BLOCK', $QUALIFIED_MODULE)}&nbsp;
						<input style="opacity: 0;" type="checkbox" 
								{if $BLOCK_MODEL->isHidden()} checked value='0' {else} value='1' {/if} class ='cursorPointer' id="hiddenCollapseBlock" name="" 
								data-on-text="{vtranslate('LBL_YES', $QUALIFIED_MODULE)}" data-off-text="{vtranslate('LBL_NO', $QUALIFIED_MODULE)}" data-on-color="primary" data-block-id="{$BLOCK_MODEL->get('id')}"/>
					</span>-->&nbsp;
					<button class="btn btn-default addButton addCustomField" type="button">
						<i class="fa fa-plus"></i>&nbsp;{vtranslate('LBL_ADD_CUSTOM_FIELD', $QUALIFIED_MODULE)}
					</button>&nbsp;&nbsp;
					<!--<button class="inActiveFields addButton btn btn-default btn-sm">{vtranslate('LBL_SHOW_HIDDEN_FIELDS', $QUALIFIED_MODULE)}</button>-->&nbsp;&nbsp;
					<button class="deleteCustomBlock addButton btn btn-default btn-sm" type="button">{vtranslate('LBL_DELETE_CUSTOM_BLOCK', $QUALIFIED_MODULE)}</button>
				</div>
			</div>
		</div>
		<div class="blockFieldsList row blockFieldsSortable" >
			<ul class="connectedSortable col-sm-6 ui-sortable"name="sortable1">
				<li class="row dummyRow">
					<span class="dragUiText col-sm-8">
						{vtranslate('LBL_ADD_NEW_FIELD_HERE',$QUALIFIED_MODULE)}
					</span>
					<span class="col-sm-4" style="margin-top: 7%;margin-left: -15%;">
						<button class="btn btn-default btn-sm addButton" style="padding: 2px 15px;" type="button">
				<i class="fa fa-plus"></i>&nbsp;
				{vtranslate('LBL_ADD',$QUALIFIED_MODULE)}
			</button>
					</span>
				</li>
			</ul>
			<ul class="connectedSortable col-sm-6 ui-sortable" name="sortable2"></ul>
		</div>
		
	</div>
	
	</div>
		</div>
	</div>
	
	<hr>
	
		<!--<div class="container-fluid hide" id="layoutEditorContainer">-->
			<!--<div class="contents tabbable">-->
	
				 <div class="tab-content layoutContent padding20 themeTableColor overflowVisible">
					<div class="tab-pane" id="detailViewLayout">
					
						<div class="btn-toolbar padding20">
							<span class="pull-right">
								<button class="btn btn-success saveFieldSequence hide" type="button" 
									data-container="body" data-toggle="popover" data-placement="left" data-content="{vtranslate('LBL_SAVE_SEQUENCE', $MODULE)}">
									<i class="icon-align-justify"></i>&nbsp;&nbsp;<strong>{vtranslate('LBL_SAVE_FIELD_SEQUENCE', $MODULE)}</strong>
								</button>
							</span>
						</div><!--class="btn-toolbar padding20"-->
						
						<!--<div id="moduleBlocks">
							
						</div>-->	<!--id="moduleBlocks"-->
						
	
					


				</div><!--class="tab-content layoutContent padding20 themeTableColor overflowVisible"-->
	
	<div class="blockFieldsList  blockFieldsSortable  row">	
		<ul name="sortable1" class="connectedSortable col-sm-6 ui-sortable">
	<li class="newCustomFieldCopy hide">
		<div class="row border1px">
			<div class="col-sm-4">
				<div class="marginLeftZero" data-field-id="" data-sequence="" style="min-height: 138px; !important;">
					<div class="row">
						<span class="col-sm-1">&nbsp;
							{if $IS_SORTABLE}
								<img src="{vimage_path('drag.png')}" class="dragImage" border="0" title="{vtranslate('LBL_DRAG',$QUALIFIED_MODULE)}"/>
							{/if}
						</span>
						<div class="col-sm-9" style="word-wrap: break-word;">
							<div class="fieldLabelContainer row">
								<span class="fieldLabel fieldLabels">
									<b></b>
									&nbsp;
								</span>
								<div>
									<span class="pull-right fieldTypeLabel" style="opacity:0.6;"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-8 fieldPropertyContainer">
				<div class="row " style="padding:10px 0px">
					<div class="fieldProperties col-sm-10" data-field-id="">
						<span class="mandatory switch text-capitalize">
							<i class="fa fa-exclamation-circle" data-name="mandatory" 
								data-enable-value="M" data-disable-value="O" 
								title="{vtranslate('LBL_MANDATORY',$QUALIFIED_MODULE)}"></i>
							&nbsp;{vtranslate('LBL_PROP_MANDATORY',$QUALIFIED_MODULE)}
						</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="quickCreate switch">
							<i class="fa fa-plus" data-name="quickcreate" 
								data-enable-value="1" data-disable-value="0"
								title="{vtranslate('LBL_QUICK_CREATE',$QUALIFIED_MODULE)}"></i>
							&nbsp;{vtranslate('LBL_QUICK_CREATE',$QUALIFIED_MODULE)}
						</span><br><br>
						<span class="massEdit switch" >
							<img src="{vimage_path('MassEdit.png')}" data-name="masseditable" 
								 data-enable-value="1" data-disable-value="2" title="{vtranslate('LBL_MASS_EDIT',$QUALIFIED_MODULE)}" height=14 width=14 
								 />&nbsp;{vtranslate('LBL_MASS_EDIT',$QUALIFIED_MODULE)}
						</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="header switch">
							<i class="fa fa-flag-o" data-name="headerfield" 
								data-enable-value="1" data-disable-value="0" 
								title="{vtranslate('LBL_HEADER',$QUALIFIED_MODULE)}"></i>
							&nbsp;{vtranslate('LBL_HEADER',$QUALIFIED_MODULE)}
						</span><br><br>
						<span class="summary switch">
							<i class="fa fa-key" data-name="summaryfield" 
								data-enable-value="1" data-disable-value="0" 
								title="{vtranslate('LBL_KEY_FIELD',$QUALIFIED_MODULE)}"></i>
							&nbsp;{vtranslate('LBL_KEY_FIELD',$QUALIFIED_MODULE)}
						</span><br><br>
						<div class="defaultValue col-sm-12">
						</div>
					</div>
					<span class="col-sm-2 actions">
						<a href="javascript:void(0)" class="editFieldDetails">
							<i class="fa fa-pencil" title="{vtranslate('LBL_EDIT', $QUALIFIED_MODULE)}"></i>
						</a>
						<a href="javascript:void(0)" class="deleteCustomField pull-right">
							<i class="fa fa-trash" title="{vtranslate('LBL_DELETE', $QUALIFIED_MODULE)}"></i>
						</a>
					</span>
				</div>
			</div>
		</div>
	</li>
	</ul>
	</div>
	</div>

	
</form>

	<!--add BLOCK pop up START-->
				<div class="modal-dialog modal-content addBlockModal hide">
				
					{assign var=HEADER_TITLE value={vtranslate('LBL_ADD_CUSTOM_BLOCK', $QUALIFIED_MODULE)}}
					{include file="ModalHeader.tpl"|vtemplate_path:$MODULE TITLE=$HEADER_TITLE}
					<form class="form-horizontal addCustomBlockForm">
						<div class="modal-body">
							<div class="form-group">
							<label class="control-label fieldLabel col-sm-5">
									<span>{vtranslate('LBL_BLOCK_NAME',$MODULE)}</span>
									<span class="redColor">*</span>
								    </label>
									<div class="controls col-sm-6">
						<input type="text" name="label" class="col-sm-3 inputElement" data-rule-required='true' data-rule-illegal='true' style='width: 75%'/>
					</div></div>
								
							
							<div class="form-group">
					<label class="control-label fieldLabel col-sm-5">
						{vtranslate('LBL_ADD_AFTER', $MODULE)}
					</label>
								<div class="controls col-sm-6">
									
										<select class="span8" name="beforeBlockId">
											<option value="0">{vtranslate('SELECT_BLOCK', $MODULE)}</option>
										</select>
									
								</div><!--class="controls"-->
							</div><!--class="control-group"-->
						</div><!--class="modal-body"-->
						{include file='ModalFooter.tpl'|@vtemplate_path:'Vtiger'}
					</form><!--class="form-horizontal addCustomBlockForm"-->
				</div><!--class="modal addBlockModal hide"-->
				<!--add BLOCK pop up END-->
	

	
	
	<div class="hide defaultValueIcon">
		<img src="{vimage_path('DefaultValue.png')}" height=14 width=14>
	</div>
	{assign var=FIELD_INFO value=$CLEAN_FIELD_MODEL->getFieldInfo()}
	{include file=vtemplate_path('FieldCreate.tpl','ModuleCreater') FIELD_MODEL=$CLEAN_FIELD_MODEL IS_FIELD_EDIT_MODE=false}
	<div class="modal-dialog inactiveFieldsModal hide">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>{vtranslate('LBL_INACTIVE_FIELDS', $QUALIFIED_MODULE)}</h3>
		</div>
		<div class="modal-content">
			<form class="form-horizontal inactiveFieldsForm">
				<div class="modal-body">
					<div class="inActiveList row">
						<div class="col-sm-1"></div>
						<div class="list col-sm-10"></div>
						<div class="col-sm-1"></div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="pull-right cancelLinkContainer">
						<a class="cancelLink" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', $QUALIFIED_MODULE)}</a>
					</div>
					<button class="btn btn-success" type="submit" name="reactivateButton">
						<strong>{vtranslate('LBL_REACTIVATE', $QUALIFIED_MODULE)}</strong>
					</button>
				</div>
			</form>
		</div>
	</div>
{/strip}
