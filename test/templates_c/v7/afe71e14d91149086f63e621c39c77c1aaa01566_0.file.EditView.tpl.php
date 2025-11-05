<?php
/* Smarty version 4.5.5, created on 2025-11-05 03:50:25
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\ModuleLinkCreator\EditView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690ac9818f0a37_35251636',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'afe71e14d91149086f63e621c39c77c1aaa01566' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\ModuleLinkCreator\\EditView.tpl',
      1 => 1762314568,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690ac9818f0a37_35251636 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="main-container"><div class="editViewPageDiv viewContent editViewContents"><div class="col-sm-12 col-xs-12 content-area"><div id="js_currentUser" class="hide noprint"><?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['USER_PROFILE']->value);?>
</div><div id="js_config" class="hide noprint"><?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['CONFIG']->value);?>
</div><div id="js_settings" class="hide noprint"><?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SETTINGS']->value);?>
</div><form class="form-horizontal fieldBlockContainer" id="EditView" name="EditView" method="post" action="index.php" enctype="multipart/form-data"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
"><input type="hidden" name="action" value="Save"><div class="contentHeader row"><h3 class="col-sm-8 col-xs-8 textOverflowEllipsis"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h3><span class="col-sm-4 col-xs-4 text-right"><button class="btn btn-success" type="submit" disabled="disabled"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><a class="cancelLink" href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&view=List"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></span></div><div class="contentHeader row-fluid"><div class="alert alert-warning"><?php echo vtranslate('LBL_NOTE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div></div><table id="module-link-creator-edit-table" class="table table-bordered listview-table" style="border-top: 1px solid #ddd;"><thead><tr><th colspan="4"><?php echo vtranslate('LBL_MODULE_DETAILS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><tbody><tr><td class="fieldLabel medium"><label class="muted pull-right marginRight10px"><span class="redColor">*</span> <?php echo vtranslate('LBL_SINGULAR_MODULE_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue medium"><div class="row-fluid"><span class="span10"><input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_singular_module_label"type="text" class="inputElement nameField"name="singular_module_label" required="required"value="CM<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('singular_module_label');?>
"<?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value) {?> readonly="readonly" <?php }?>/></span></div></td></tr><tr><td class="fieldLabel medium"><label class="muted pull-right marginRight10px"><span class="redColor">*</span> <?php echo vtranslate('LBL_MODULE_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue medium"><div class="row-fluid"><span class="span10"><input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_module_label"type="text" class="inputElement nameField"name="module_label" required="required"value="CM<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('module_label');?>
"<?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value) {?> readonly="readonly" <?php }?>/></span></div></td></tr><tr><td class="fieldLabel medium"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_MODULE_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue medium"><div class="row-fluid"><span class="span10"><input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_module_name"type="text" class="inputElement nameField"name="module_name" readonly="readonly" required="required"value="CM<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('module_name');?>
"></span></div></td></tr><tr><td class="fieldLabel medium" style="vertical-align: middle"><label class="muted pull-right marginRight10px"><span class="redColor">*</span> <?php echo vtranslate('LBL_BASE_PERMISSIONS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue medium"><div class="row-fluid "><select id="base_permissions" name="base_permissions"><option value=""><?php echo vtranslate('LBL_SELECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="0"><?php echo vtranslate('LBL_AVAIL_EVERYONE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="1"><?php echo vtranslate('LBL_AVAIL_ADMINISTRATOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option></select><a href="#" data-html="true" style="margin-left: 20px" class="hover-tooltip" data-toggle="tooltip" data-placement="bottom" title='<?php echo vtranslate('LBL_BASE_PERMISSIONS_TOOLTIP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
'><i class="fa fa-question-circle"></i></a></div></td></tr><tr><td class="fieldLabel medium" style="vertical-align: middle"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_ICON',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue medium"><div class="row-fluid logo-module"><span class="span10" style="margin-right: 10px"><!-- Button trigger modal --><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalIcons">Select Icon</button></span><span class="icon-module" id="icon-module" style="font-size: 30px; vertical-align: middle;"></span><input type="hidden" name="data-icon-module" data-info=""></div></td></tr><tr><td class="fieldLabel medium" style="vertical-align: middle"><label class="muted pull-right marginRight10px"><?php echo vtranslate('Menu Placement',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue medium"><div class="row-fluid "><select id="Menu_Placement" name="menu_placement"><option value="MARKETING">MARKETING</option><option value="SALES">SALES</option><option value="INVENTORY">INVENTORY</option><option value="TOOLS">TOOLS</option><option value="SUPPORT">SUPPORT</option><option value="PROJECT">PROJECTS</option></select></div></td></tr><tr><td class="fieldLabel medium"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_MODULE_TYPE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue medium"><div class="row-fluid"><span class="span10"><select name="module_type" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_module_type"class="select2" disabled="disabled" required="required"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_TYPES']->value, 'LABEL', false, 'ID');
$_smarty_tpl->tpl_vars['LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ID']->value => $_smarty_tpl->tpl_vars['LABEL']->value) {
$_smarty_tpl->tpl_vars['LABEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['MOULE_TYPE_VALUE']->value == $_smarty_tpl->tpl_vars['ID']->value) {?> selected="selected" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></span></div></td></tr><tr><td class="fieldLabel medium"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue medium"><div class="row-fluid"><span class="span10"><select name="module_fields[]" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_module_fields"class="select2" disabled="disabled" multiple="multiple"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_FIELDS']->value, 'ITEM', false, 'KEY');
$_smarty_tpl->tpl_vars['ITEM']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['KEY']->value => $_smarty_tpl->tpl_vars['ITEM']->value) {
$_smarty_tpl->tpl_vars['ITEM']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" data-info='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['ITEM']->value);?>
'selected="selected"><?php echo vtranslate($_smarty_tpl->tpl_vars['ITEM']->value['fieldlabel'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></span></div></td></tr><tr><td class="fieldLabel medium"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_LIST_VIEW_FILTER_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue medium"><div class="row-fluid"><span class="span10"><select id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_module_list_view_filter_fields"name="module_list_view_filter_fields[]"class="select2" disabled="disabled" multiple="multiple"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_LIST_VIEW_FILTER_FIELDS']->value, 'ITEM', false, 'KEY');
$_smarty_tpl->tpl_vars['ITEM']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['KEY']->value => $_smarty_tpl->tpl_vars['ITEM']->value) {
$_smarty_tpl->tpl_vars['ITEM']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" data-info='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['ITEM']->value);?>
'selected="selected"><?php echo vtranslate($_smarty_tpl->tpl_vars['ITEM']->value['fieldlabel'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></span></div></td></tr><tr><td class="fieldLabel medium"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_SUMMARY_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue medium"><div class="row-fluid"><span class="span10"><select id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_module_summary_fields"name="module_summary_fields[]"class="select2" disabled="disabled" multiple="multiple"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_SUMMARY_FIELDS']->value, 'ITEM', false, 'KEY');
$_smarty_tpl->tpl_vars['ITEM']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['KEY']->value => $_smarty_tpl->tpl_vars['ITEM']->value) {
$_smarty_tpl->tpl_vars['ITEM']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" data-info='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['ITEM']->value);?>
'selected="selected"><?php echo vtranslate($_smarty_tpl->tpl_vars['ITEM']->value['fieldlabel'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></span></div></td></tr><tr><td class="fieldLabel medium"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_QUICK_CREATE_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue medium"><div class="row-fluid"><span class="span10"><select id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_module_quick_create_fields"name="module_quick_create_fields[]"class="select2" disabled="disabled" multiple="multiple"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_QUICK_CREATE_FIELDS']->value, 'ITEM', false, 'KEY');
$_smarty_tpl->tpl_vars['ITEM']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['KEY']->value => $_smarty_tpl->tpl_vars['ITEM']->value) {
$_smarty_tpl->tpl_vars['ITEM']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" data-info='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['ITEM']->value);?>
'selected="selected"><?php echo vtranslate($_smarty_tpl->tpl_vars['ITEM']->value['fieldlabel'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></span></div></td></tr><tr><td class="fieldLabel medium"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_LINKED_MODULES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue medium"><div class="row-fluid"><span class="span10"><select id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_module_links" name="module_links[]"class="select2" disabled="disabled" multiple="multiple"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_LINKS']->value, 'ITEM', false, 'KEY');
$_smarty_tpl->tpl_vars['ITEM']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['KEY']->value => $_smarty_tpl->tpl_vars['ITEM']->value) {
$_smarty_tpl->tpl_vars['ITEM']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ITEM']->value['module_name'];?>
" data-info='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['ITEM']->value);?>
'selected="selected"><?php echo vtranslate($_smarty_tpl->tpl_vars['ITEM']->value['module_label'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></span></div></td></tr></tbody></table><br><div class="row-fluid"><div class="pull-right"><button class="btn btn-success" type="submit" disabled="disabled"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><a class="cancelLink" type="reset" onclick="window.history.back();"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><div class="clearfix"></div></div><br></form></div></div></div>
<style>
    .cell-icon:hover {
        background: #AAAAAA;
    }
</style>


<!-- Modal -->
<div class="modal fade" id="ModalIcons" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 680px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow: scroll; overflow-x: hidden;">
                <div class="form">
                    <?php $_smarty_tpl->_assignInScope('LISTICONS_LENGTH', (count($_smarty_tpl->tpl_vars['LISTICONS']->value)-1));?>
                    <?php $_smarty_tpl->_assignInScope('INDEX', 0);?>
                    <table data-length="<?php echo $_smarty_tpl->tpl_vars['LISTICONS_LENGTH']->value;?>
" border="1px solid #cccccc">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTICONS']->value, 'val', false, 'k');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
                            <?php $_smarty_tpl->_assignInScope('MODE4OK', (($_smarty_tpl->tpl_vars['INDEX']->value % 14) == 0));?>
                            <?php if ($_smarty_tpl->tpl_vars['MODE4OK']->value) {?>
                                <tr>
                            <?php }?>
                            <td style="padding: 5px;" class="cell-icon">
                                <span class="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
 icon-module" style="font-size: 30px; vertical-align: middle;" data-info="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
"></span>
                            </td>
                            <?php if (($_smarty_tpl->tpl_vars['INDEX']->value % 14) == 13 || $_smarty_tpl->tpl_vars['LISTICONS_LENGTH']->value == $_smarty_tpl->tpl_vars['INDEX']->value) {?>
                                </tr>
                            <?php }?>
                            <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['INDEX']->value++;?>
">

                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-submit">Save</button>
            </div>
        </div>
    </div>
</div>
<?php }
}
