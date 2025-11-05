<?php
/* Smarty version 4.5.5, created on 2025-11-05 07:47:16
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Reports\Step1.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b010486c3a0_31191713',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa12b7bff08e8a87dbf21ae5f042d827d68805a7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Reports\\Step1.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b010486c3a0_31191713 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['REPORT_TYPE']->value == 'ChartEdit') {?>
    <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "EditChartHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
} else { ?>
    <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "EditHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
<div class="reportContents">
    <form class="form-horizontal recordEditView" id="report_step1" method="post" action="index.php">
		<input type="hidden" name="mode" value="step2" />
        <input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" />
        <input type="hidden" name="view" value="<?php echo $_smarty_tpl->tpl_vars['VIEW']->value;?>
" />
        <input type="hidden" class="step" value="1" />
        <input type="hidden" name="isDuplicate" value="<?php if ((isset($_smarty_tpl->tpl_vars['IS_DUPLICATE']->value))) {
echo $_smarty_tpl->tpl_vars['IS_DUPLICATE']->value;
} else { ?>false<?php }?>" />
        <input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" />
        <input type=hidden id="relatedModules" data-value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['RELATED_MODULES']->value);?>
' />
        <div style="border:1px solid #ccc;padding:4%;">
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-3 control-label textAlignLeft"><?php echo vtranslate('LBL_REPORT_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<span class="redColor">*</span></label>
                    <div class="col-lg-4">
                        <input type="text" class="inputElement" data-rule-required="true" name="reportname" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('reportname');?>
"/>
                    </div>
                </div>
            </div>
            <div class="row">		
                <div class="form-group">
                    <label class="col-lg-3 control-label textAlignLeft"><?php echo vtranslate('LBL_REPORT_FOLDER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<span class="redColor">*</span></label>
                    <div class="col-lg-4">
                        <select class="select2 col-lg-12 inputElement" name="reportfolderid" data-rule-required="true">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['REPORT_FOLDERS']->value, 'REPORT_FOLDER');
$_smarty_tpl->tpl_vars['REPORT_FOLDER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['REPORT_FOLDER']->value) {
$_smarty_tpl->tpl_vars['REPORT_FOLDER']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['REPORT_FOLDER']->value->getId();?>
" 
                                        <?php if ($_smarty_tpl->tpl_vars['REPORT_FOLDER']->value->getId() == $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('folderid')) {?>
                                            selected=""
                                        <?php }?>
                                        ><?php echo vtranslate($_smarty_tpl->tpl_vars['REPORT_FOLDER']->value->getName(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-3 control-label textAlignLeft"><?php echo vtranslate('PRIMARY_MODULE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<span class="redColor">*</span></label>
                    <div class="col-lg-4">
                        <select class="select2-container select2 col-lg-12 inputElement" id="primary_module" name="primary_module" data-rule-required="true"
                                <?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value && $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getPrimaryModule() && (isset($_smarty_tpl->tpl_vars['IS_DUPLICATE']->value)) && $_smarty_tpl->tpl_vars['IS_DUPLICATE']->value != true && $_smarty_tpl->tpl_vars['REPORT_TYPE']->value == "ChartEdit") {?> disabled="disabled"<?php }?>>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULELIST']->value, 'RELATED_MODULE', false, 'RELATED_MODULE_KEY');
$_smarty_tpl->tpl_vars['RELATED_MODULE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value => $_smarty_tpl->tpl_vars['RELATED_MODULE']->value) {
$_smarty_tpl->tpl_vars['RELATED_MODULE']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getPrimaryModule() == $_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value) {?> selected="selected" <?php }?>>
                                    <?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value);?>

                                </option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                        <?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value && $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getPrimaryModule() && (isset($_smarty_tpl->tpl_vars['IS_DUPLICATE']->value)) && $_smarty_tpl->tpl_vars['IS_DUPLICATE']->value != true && $_smarty_tpl->tpl_vars['REPORT_TYPE']->value == "ChartEdit") {?>
                            <input type="hidden" name="primary_module" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getPrimaryModule();?>
" />
                        <?php }?>
                    </div>
                </div>	
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-3 control-label textAlignLeft"><?php echo vtranslate('LBL_SELECT_RELATED_MODULES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;(<?php echo vtranslate('LBL_MAX',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;2)</label>
                    <div class="col-lg-4">
                        <?php if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getSecondaryModules() != null && $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getSecondaryModules() != '') {?>
                            <?php $_smarty_tpl->_assignInScope('SECONDARY_MODULES_ARR', explode(':',$_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getSecondaryModules()));?>
                        <?php } else { ?>
                            <?php $_smarty_tpl->_assignInScope('SECONDARY_MODULES_ARR', array());?>
                        <?php }?>
                        <?php $_smarty_tpl->_assignInScope('PRIMARY_MODULE', $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getPrimaryModule());?>

                        <?php if ($_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value == '') {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_MODULES']->value, 'RELATED', false, 'PARENT', 'relatedlist', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['RELATED']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PARENT']->value => $_smarty_tpl->tpl_vars['RELATED']->value) {
$_smarty_tpl->tpl_vars['RELATED']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_relatedlist']->value['index']++;
?>
                                <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_relatedlist']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_relatedlist']->value['index'] : null) == 0) {?>
                                    <?php $_smarty_tpl->_assignInScope('PRIMARY_MODULE', $_smarty_tpl->tpl_vars['PARENT']->value);?>
                                <?php }?>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>
                        <?php $_smarty_tpl->_assignInScope('PRIMARY_RELATED_MODULES', $_smarty_tpl->tpl_vars['RELATED_MODULES']->value[$_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value]);?>
                        <select class="select2-container col-lg-12 inputElement" id="secondary_module" multiple name="secondary_modules[]" data-placeholder="<?php echo vtranslate('LBL_SELECT_RELATED_MODULES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"
                                <?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value && $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getSecondaryModules() && $_smarty_tpl->tpl_vars['IS_DUPLICATE']->value != true && $_smarty_tpl->tpl_vars['REPORT_TYPE']->value == "ChartEdit") {?> disabled="disabled"<?php }?>>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PRIMARY_RELATED_MODULES']->value, 'PRIMARY_RELATED_MODULE_LABEL', false, 'PRIMARY_RELATED_MODULE');
$_smarty_tpl->tpl_vars['PRIMARY_RELATED_MODULE_LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PRIMARY_RELATED_MODULE']->value => $_smarty_tpl->tpl_vars['PRIMARY_RELATED_MODULE_LABEL']->value) {
$_smarty_tpl->tpl_vars['PRIMARY_RELATED_MODULE_LABEL']->do_else = false;
?>
                                <option <?php if (in_array($_smarty_tpl->tpl_vars['PRIMARY_RELATED_MODULE']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULES_ARR']->value)) {?> selected="" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['PRIMARY_RELATED_MODULE']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['PRIMARY_RELATED_MODULE_LABEL']->value;?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                        <?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value && $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getSecondaryModules() && $_smarty_tpl->tpl_vars['IS_DUPLICATE']->value != true && $_smarty_tpl->tpl_vars['REPORT_TYPE']->value == "ChartEdit") {?>
                            <input type="hidden" name="secondary_modules[]" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getSecondaryModules();?>
" />
                        <?php }?>
                    </div>
                </div>	
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-3 control-label textAlignLeft"><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label>
                    <div class="col-lg-4">
                        <textarea type="text" cols="50" rows="3" class="inputElement" name="description"><?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('description');?>
</textarea>
                    </div>
                </div>	
            </div>
            <div class='row'>
                <div class='form-group'>
                    <label class='col-lg-3 control-label textAlignLeft'><?php echo vtranslate('LBL_SHARE_REPORT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label>
                    <div class='col-lg-4'>
                        <select id="memberList" class="col-lg-12 select2-container select2 members " multiple="true" name="members[]" data-placeholder="<?php echo vtranslate('LBL_ADD_USERS_ROLES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
">
                            <optgroup label="<?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
">
                                    <option value="All::Users" data-member-type="<?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" 
                                                    <?php if (($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('sharingtype') == 'Public')) {?> selected="selected"<?php }?>>
                                            <?php echo vtranslate('LBL_ALL_USERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                    </option>
                            </optgroup>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MEMBER_GROUPS']->value, 'ALL_GROUP_MEMBERS', false, 'GROUP_LABEL');
$_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['GROUP_LABEL']->value => $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->value) {
$_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->do_else = false;
?>
                                <optgroup label="<?php echo $_smarty_tpl->tpl_vars['GROUP_LABEL']->value;?>
">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->value, 'MEMBER');
$_smarty_tpl->tpl_vars['MEMBER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MEMBER']->value) {
$_smarty_tpl->tpl_vars['MEMBER']->do_else = false;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['GROUP_LABEL']->value != 'Users' || $_smarty_tpl->tpl_vars['MEMBER']->value->getId() != ('Users:').($_smarty_tpl->tpl_vars['CURRENT_USER']->value->getId())) {?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['MEMBER']->value->getId();?>
"  data-member-type="<?php echo $_smarty_tpl->tpl_vars['GROUP_LABEL']->value;?>
" <?php if ((isset($_smarty_tpl->tpl_vars['SELECTED_MEMBERS_GROUP']->value[$_smarty_tpl->tpl_vars['GROUP_LABEL']->value][$_smarty_tpl->tpl_vars['MEMBER']->value->getId()]))) {?>selected="true"<?php }?>><?php echo $_smarty_tpl->tpl_vars['MEMBER']->value->getName();?>
</option>
                                        <?php }?>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </optgroup>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>
            </div>	
            <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ScheduleReport.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>	
        </div>
        <div class="border1px modal-overlay-footer clearfix">
            <div class="row clearfix">
                <div class="textAlignCenter col-lg-12 col-md-12 col-lg-12 ">
                    <button class="btn btn-success nextStep" type="submit"><?php echo vtranslate('LBL_NEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;
                    <a type="reset" onclick='window.history.back();' class="cancelLink cursorPointer"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                </div>
            </div>
        </div>
    </form><?php }
}
