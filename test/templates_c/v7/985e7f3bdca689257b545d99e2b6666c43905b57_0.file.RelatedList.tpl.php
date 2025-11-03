<?php
/* Smarty version 4.5.5, created on 2025-11-03 07:10:34
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\LayoutEditor\RelatedList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6908556a5c8455_70328380',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '985e7f3bdca689257b545d99e2b6666c43905b57' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\LayoutEditor\\RelatedList.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6908556a5c8455_70328380 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('ModulesList', array());
$_smarty_tpl->_assignInScope('removedModuleIds', array());?><div class="relatedTabModulesList" style="padding:1% 0"><div><?php if (empty($_smarty_tpl->tpl_vars['RELATED_MODULES']->value) && empty($_smarty_tpl->tpl_vars['RELATION_FIELDS']->value)) {?><div class="emptyRelatedTabs" style="margin-top:100px;"><div class="recordDetails"><div class="textAlignCenter" style="font-size:20px;opacity:0.7"><?php echo vtranslate('LBL_NO_RELATED_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
.</div></div></div><?php } else { ?><div class="relatedListContainer" style="margin-top:20px;"><div class="row"><div class="col-sm-5" id="ONE_ONE_AND_MANY_ONE_RELATIONSHIP"><div style="padding-bottom:15px;"><h6><?php echo vtranslate('ONE_ONE_AND_MANY_ONE_RELATIONSHIP',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h6></div><div style="list-style: none;"><?php if (php7_count($_smarty_tpl->tpl_vars['RELATION_FIELDS']->value) == 0) {?><div class="well" style="height:72px;opacity:0.6;text-align:center;padding-top: 30px;"><div><?php echo vtranslate('LBL_NO_RELATION_TYPE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
.</div></div><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATION_FIELDS']->value, 'RELATION_FIELD', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['RELATION_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['RELATION_FIELD']->value) {
$_smarty_tpl->tpl_vars['RELATION_FIELD']->do_else = false;
$_smarty_tpl->_assignInScope('REFERENCE_LIST', $_smarty_tpl->tpl_vars['RELATION_FIELD']->value->getReferenceList());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['REFERENCE_LIST']->value, 'REFERENCE_MODULE');
$_smarty_tpl->tpl_vars['REFERENCE_MODULE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['REFERENCE_MODULE']->value) {
$_smarty_tpl->tpl_vars['REFERENCE_MODULE']->do_else = false;
?><div class="contentsBackground border1px ONE_TO_ONE" data-relation-type="<?php echo $_smarty_tpl->tpl_vars['RELATION_FIELD']->value->get('_relationType');?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"data-module="<?php echo $_smarty_tpl->tpl_vars['REFERENCE_MODULE']->value;?>
"><div class="row" style="margin-bottom: 5px;"><div class="col-sm-5" style="margin-top:5px;"><div class="textOverflowEllipsis" style="font-size:15px;" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</div><span class="referenceModule"><?php echo vtranslate($_smarty_tpl->tpl_vars['REFERENCE_MODULE']->value,$_smarty_tpl->tpl_vars['REFERENCE_MODULE']->value);?>
</span></div><div class="col-sm-5" style="margin-top: 5px;"><div class="pull-right"><?php if ($_smarty_tpl->tpl_vars['RELATION_FIELD']->value->get('_relationType') == Settings_LayoutEditor_Module_Model::MANY_TO_ONE) {?><img src="<?php echo vimage_path('N-1.png');?>
" width="100" height="50" /><?php } else { ?><img src="<?php echo vimage_path('1-1.png');?>
" width="100" height="50" /><?php }?></div></div></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div><div class="col-sm-7" id="ONE_MANY_RELATIONSHIP"><div class="row" style="padding-bottom:15px;"><span class="col-sm-6"><h6><?php echo vtranslate('ONE_MANY_RELATIONSHIP',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h6></span><span class="col-sm-5">&nbsp;</span></div><div class="row"><?php if (php7_count($_smarty_tpl->tpl_vars['RELATED_MODULES']->value) == 0) {?><div class="well" style="height:72px;opacity:0.6;text-align:center;padding-top: 30px;"><div> <?php echo vtranslate('LBL_NO_RELATION_TYPE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
.</div></div><?php } else { ?><div class="col-sm-6"><ul class="relatedModulesList" style="list-style: none;margin:0px;padding-left:0px;"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_MODULES']->value, 'MODULE_MODEL');
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_MODEL']->value) {
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = false;
if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isActive()) {
$_smarty_tpl->_assignInScope('RELATION_FIELD_MODEL', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getRelationField());?><li class="relatedModule module_<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getId();?>
 border1px ONE_TO_MANY"data-relation-id="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getId();?>
" data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getRelationModuleName();?>
"data-relation-type="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('relationtype');?>
"<?php if ($_smarty_tpl->tpl_vars['RELATION_FIELD_MODEL']->value) {?> data-field-name="<?php echo $_smarty_tpl->tpl_vars['RELATION_FIELD_MODEL']->value->getName();?>
"<?php }?>><div class="row"><span class="col-sm-1" style="margin-top:18px;"><img class="cursorPointerMove" src="<?php echo vimage_path('drag.png');?>
" title="<?php echo vtranslate('LBL_DRAG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"/>&nbsp;&nbsp;</span><div class="col-sm-5" style="margin-top:4px;"><div class="textOverflowEllipsis"><span class="moduleLabel" style="font-size:15px;" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getRelationModuleName());?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getRelationModuleName());?>
</span></div><span class="moduletranslatedLabel"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getRelationModuleName(),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getRelationModuleName());?>
</span></div><div class="col-sm-4" style="margin-top: 4px;"><div class="pull-right"><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('relationtype') == '1:N' && $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getRelationModuleName() != 'Calendar') {?><img src="<?php echo vimage_path('1-N.png');?>
" width="100" height="50" /><?php } else { ?><img src="<?php echo vimage_path('N-N.png');?>
" width="100" height="50" /><?php }?></div></div><div class="col-sm-1 deleteButton" style="padding-right: 0px;" data-relation="1"><div class="pull-right"><button class="close" data-dismiss="modal" title="<?php echo vtranslate('LBL_CLOSE');?>
">x</button></div></div></div></li><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></div><div class="col-sm-6"><div><div class="pull-right" style="margin-bottom:20px;"><span class="col-sm-6" style="width:100%"><img src="<?php echo vimage_path('Square.png');?>
" />&nbsp;&nbsp;&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</span><span class="col-sm-6" style="width:100%"><img src="<?php echo vimage_path('Circle.png');?>
" />&nbsp;&nbsp;&nbsp;<?php echo vtranslate('LBL_RELATED_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div></div><div class="relationListInfoWrapper"><div class="col-sm-10 relationListInfo" style="margin-left: 40px;"><?php if (php7_count($_smarty_tpl->tpl_vars['RELATED_MODULES']->value) != 0) {?><div style="margin: 5px 0px;"><div class="relatedListInfoHeader"><i class="fa fa-info-circle"></i>&nbsp;<?php echo vtranslate('LBL_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><br><div><?php echo vtranslate('LBL_RELATED_LIST_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
.</div><br></div><?php }?></div></div></div><?php }?></div><br><div class="row hiddenModulesContainer <?php if (!$_smarty_tpl->tpl_vars['HIDDEN_TAB_EXISTS']->value) {?>hide<?php }?>"><div class="col-lg-6" style="padding-right: 0px;"><select class="select2 inputElement" multiple name="addToList" placeholder="<?php echo vtranslate('LBL_SELECT_HIDDEN_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_MODULES']->value, 'MODULE_MODEL');
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_MODEL']->value) {
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = false;
$_tmp_array = isset($_smarty_tpl->tpl_vars['ModulesList']) ? $_smarty_tpl->tpl_vars['ModulesList']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array[$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getId()] = vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getRelationModuleName());
$_smarty_tpl->_assignInScope('ModulesList', $_tmp_array);
if (!$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isActive()) {
echo array_push($_smarty_tpl->tpl_vars['removedModuleIds']->value,$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getId());?>
<option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getId();?>
" data-module-translated-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getRelationModuleName(),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getRelationModuleName());?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getRelationModuleName());?>
</option><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div></div></div><div class='modal-overlay-footer clearfix saveRelatedListContainer hide'><div class="row clearfix"><div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type='submit' class='btn btn-success saveButton saveRelatedList' ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;</div></div></div><li class="moduleCopy hide border1px " style="width: 300px;padding: 5px;"><div class="row"><span class="col-sm-1" style="margin-top:18px;"><img class="cursorPointerMove" src="<?php echo vimage_path('drag.png');?>
" title="<?php echo vtranslate('LBL_DRAG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"/>&nbsp;&nbsp;</span><div class="col-sm-5" style="margin-top:4px;"><div class="textOverflowEllipsis"><span class="moduleLabel" style="font-size:15px;"></span></div><span class="moduletranslatedLabel"></span></div><div class="col-sm-4" style="margin-top: 4px;"><div class="pull-right"><img src="<?php echo vimage_path('N-N.png');?>
" width="100" height="50" /></div></div><div class="col-sm-1 deleteButton" style="padding-right: 0px;" data-relation="1"><div class="pull-right"><button class="close" data-dismiss="modal" title="<?php echo vtranslate('LBL_CLOSE');?>
">x</button></div></div></div></li></div><?php }?><input type="hidden" class="ModulesListArray" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['ModulesList']->value);?>
' /><input type="hidden" class="RemovedModulesListArray" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['removedModuleIds']->value);?>
' /></div></div><?php }
}
