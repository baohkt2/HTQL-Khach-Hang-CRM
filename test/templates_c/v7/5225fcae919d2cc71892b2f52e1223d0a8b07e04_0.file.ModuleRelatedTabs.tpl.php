<?php
/* Smarty version 4.5.5, created on 2025-11-02 08:35:47
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\ModuleRelatedTabs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690717e311a6c9_53128918',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5225fcae919d2cc71892b2f52e1223d0a8b07e04' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\ModuleRelatedTabs.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690717e311a6c9_53128918 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<div class='related-tabs row'><nav class="navbar margin0" role="navigation"><div class="navbar-header"><button type="button" class="navbar-toggle btn-group-justified collapsed border0" data-toggle="collapse" data-target="#nav-tabs" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button></div><div class="collapse navbar-collapse" id="nav-tabs"><ul class="nav nav-tabs"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEWTAB'], 'RELATED_LINK');
$_smarty_tpl->tpl_vars['RELATED_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_LINK']->value) {
$_smarty_tpl->tpl_vars['RELATED_LINK']->do_else = false;
$_smarty_tpl->_assignInScope('RELATEDLINK_URL', $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl());
$_smarty_tpl->_assignInScope('RELATEDLINK_LABEL', $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel());
ob_start();
echo vtranslate(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE_NAME']->value),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
$_prefixVariable5 = ob_get_clean();
$_smarty_tpl->_assignInScope('RELATED_TAB_LABEL', (($_prefixVariable5).(" ")).($_smarty_tpl->tpl_vars['RELATEDLINK_LABEL']->value));?><li class="tab-item <?php if ($_smarty_tpl->tpl_vars['RELATED_TAB_LABEL']->value == $_smarty_tpl->tpl_vars['SELECTED_TAB_LABEL']->value) {?>active<?php }?>" data-url="<?php echo $_smarty_tpl->tpl_vars['RELATEDLINK_URL']->value;?>
&tab_label=<?php echo $_smarty_tpl->tpl_vars['RELATED_TAB_LABEL']->value;?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
" data-label-key="<?php echo $_smarty_tpl->tpl_vars['RELATEDLINK_LABEL']->value;?>
" data-link-key="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linkKey');?>
" ><a href="<?php echo $_smarty_tpl->tpl_vars['RELATEDLINK_URL']->value;?>
&tab_label=<?php echo $_smarty_tpl->tpl_vars['RELATEDLINK_LABEL']->value;?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
" class="textOverflowEllipsis"><span class="tab-label"><strong><?php ob_start();
echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;
$_prefixVariable6 = ob_get_clean();
echo vtranslate($_smarty_tpl->tpl_vars['RELATEDLINK_LABEL']->value,$_prefixVariable6);?>
</strong></span></a></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ((isset($_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEWRELATED']))) {
$_smarty_tpl->_assignInScope('RELATEDTABS', $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEWRELATED']);
}
if (!empty($_smarty_tpl->tpl_vars['RELATEDTABS']->value)) {
$_smarty_tpl->_assignInScope('COUNT', smarty_modifier_count($_smarty_tpl->tpl_vars['RELATEDTABS']->value));
$_smarty_tpl->_assignInScope('LIMIT', 10);
if ($_smarty_tpl->tpl_vars['COUNT']->value > 10) {
$_smarty_tpl->_assignInScope('COUNT1', $_smarty_tpl->tpl_vars['LIMIT']->value);
} else {
$_smarty_tpl->_assignInScope('COUNT1', $_smarty_tpl->tpl_vars['COUNT']->value);
}
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['COUNT1']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['COUNT1']->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;
$_smarty_tpl->_assignInScope('RELATED_LINK', $_smarty_tpl->tpl_vars['RELATEDTABS']->value[$_smarty_tpl->tpl_vars['i']->value]);
$_smarty_tpl->_assignInScope('RELATEDMODULENAME', $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getRelatedModuleName());
$_smarty_tpl->_assignInScope('RELATEDFIELDNAME', $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linkFieldName'));
$_smarty_tpl->_assignInScope('DETAILVIEWRELATEDLINKLBL', vtranslate($_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel(),$_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value));?><li class="tab-item <?php if ((trim($_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel()) == trim($_smarty_tpl->tpl_vars['SELECTED_TAB_LABEL']->value)) && ($_smarty_tpl->tpl_vars['RELATED_LINK']->value->getId() == $_smarty_tpl->tpl_vars['SELECTED_RELATION_ID']->value)) {?>active<?php }?>" data-url="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl();?>
&tab_label=<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
" data-label-key="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
"data-module="<?php echo $_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value;?>
" data-relation-id="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getId();?>
" <?php if ($_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value == "ModComments") {?> title <?php } else { ?> title="<?php echo $_smarty_tpl->tpl_vars['DETAILVIEWRELATEDLINKLBL']->value;?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['RELATEDFIELDNAME']->value) {?>data-relatedfield ="<?php echo $_smarty_tpl->tpl_vars['RELATEDFIELDNAME']->value;?>
"<?php }?>><a href="index.php?<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl();?>
&tab_label=<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
" class="textOverflowEllipsis" displaylabel="<?php echo $_smarty_tpl->tpl_vars['DETAILVIEWRELATEDLINKLBL']->value;?>
" recordsCount="" ><?php if ($_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value == "ModComments") {?><span class="tab-icon"><i class="fa fa-comment" style="font-size: 24px"></i></span><?php } else { ?><span class="tab-icon"><?php $_smarty_tpl->_assignInScope('RELATED_MODULE_MODEL', Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value));
echo $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->getModuleIcon();?>
</span><?php }?>&nbsp;<span class="numberCircle hide">0</span></a></li><?php ob_start();
echo $_smarty_tpl->tpl_vars['REQ']->value->get('relationId');
$_prefixVariable7 = ob_get_clean();
if (($_smarty_tpl->tpl_vars['RELATED_LINK']->value->getId() == $_prefixVariable7)) {
$_smarty_tpl->_assignInScope('MORE_TAB_ACTIVE', 'true');
}
}
}
if ($_smarty_tpl->tpl_vars['MORE_TAB_ACTIVE']->value != 'true') {
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['COUNT']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['COUNT']->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;
$_smarty_tpl->_assignInScope('RELATED_LINK', $_smarty_tpl->tpl_vars['RELATEDTABS']->value[$_smarty_tpl->tpl_vars['i']->value]);
ob_start();
echo $_smarty_tpl->tpl_vars['REQ']->value->get('relationId');
$_prefixVariable8 = ob_get_clean();
if (($_smarty_tpl->tpl_vars['RELATED_LINK']->value->getId() == $_prefixVariable8)) {
$_smarty_tpl->_assignInScope('RELATEDMODULENAME', $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getRelatedModuleName());
$_smarty_tpl->_assignInScope('RELATEDFIELDNAME', $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linkFieldName'));
$_smarty_tpl->_assignInScope('DETAILVIEWRELATEDLINKLBL', vtranslate($_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel(),$_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value));?><li class="more-tab moreTabElement active" data-url="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl();?>
&tab_label=<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
" data-label-key="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
"data-module="<?php echo $_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value;?>
" data-relation-id="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getId();?>
" <?php if ($_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value == "ModComments") {?> title <?php } else { ?> title="<?php echo $_smarty_tpl->tpl_vars['DETAILVIEWRELATEDLINKLBL']->value;?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['RELATEDFIELDNAME']->value) {?>data-relatedfield ="<?php echo $_smarty_tpl->tpl_vars['RELATEDFIELDNAME']->value;?>
"<?php }?>><a href="index.php?<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl();?>
&tab_label=<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
" class="textOverflowEllipsis" displaylabel="<?php echo $_smarty_tpl->tpl_vars['DETAILVIEWRELATEDLINKLBL']->value;?>
" recordsCount="" ><?php if ($_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value == "ModComments") {?><span class="tab-icon"><i class="fa fa-comment" style="font-size: 24px"></i></span><?php } else { ?><span class="tab-icon"><?php $_smarty_tpl->_assignInScope('RELATED_MODULE_MODEL', Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value));
echo $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->getModuleIcon();?>
</span><?php }?>&nbsp;<span class="numberCircle hide">0</span></a></li><?php break 1;
}
}
}
}
if ($_smarty_tpl->tpl_vars['COUNT']->value > $_smarty_tpl->tpl_vars['LIMIT']->value) {?><li class="dropdown related-tab-more-element"><a href="javascript:void(0)" data-toggle="dropdown" class="dropdown-toggle"><span class="tab-label"><strong><?php echo vtranslate("LBL_MORE",$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong> &nbsp; <b class="fa fa-caret-down"></b></span></a><ul class="dropdown-menu pull-right" id="relatedmenuList"><?php
$_smarty_tpl->tpl_vars['j'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['j']->step = 1;$_smarty_tpl->tpl_vars['j']->total = (int) ceil(($_smarty_tpl->tpl_vars['j']->step > 0 ? $_smarty_tpl->tpl_vars['COUNT']->value-1+1 - ($_smarty_tpl->tpl_vars['COUNT1']->value) : $_smarty_tpl->tpl_vars['COUNT1']->value-($_smarty_tpl->tpl_vars['COUNT']->value-1)+1)/abs($_smarty_tpl->tpl_vars['j']->step));
if ($_smarty_tpl->tpl_vars['j']->total > 0) {
for ($_smarty_tpl->tpl_vars['j']->value = $_smarty_tpl->tpl_vars['COUNT1']->value, $_smarty_tpl->tpl_vars['j']->iteration = 1;$_smarty_tpl->tpl_vars['j']->iteration <= $_smarty_tpl->tpl_vars['j']->total;$_smarty_tpl->tpl_vars['j']->value += $_smarty_tpl->tpl_vars['j']->step, $_smarty_tpl->tpl_vars['j']->iteration++) {
$_smarty_tpl->tpl_vars['j']->first = $_smarty_tpl->tpl_vars['j']->iteration === 1;$_smarty_tpl->tpl_vars['j']->last = $_smarty_tpl->tpl_vars['j']->iteration === $_smarty_tpl->tpl_vars['j']->total;
$_smarty_tpl->_assignInScope('RELATED_LINK', $_smarty_tpl->tpl_vars['RELATEDTABS']->value[$_smarty_tpl->tpl_vars['j']->value]);
$_smarty_tpl->_assignInScope('RELATEDMODULENAME', $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getRelatedModuleName());
$_smarty_tpl->_assignInScope('RELATEDFIELDNAME', $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linkFieldName'));
$_smarty_tpl->_assignInScope('DETAILVIEWRELATEDLINKLBL', vtranslate($_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel(),$_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value));?><li class="more-tab <?php if ((trim($_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel()) == trim($_smarty_tpl->tpl_vars['SELECTED_TAB_LABEL']->value)) && ($_smarty_tpl->tpl_vars['RELATED_LINK']->value->getId() == $_smarty_tpl->tpl_vars['SELECTED_RELATION_ID']->value)) {?>active<?php }?>" data-url="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl();?>
&tab_label=<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
" data-label-key="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
"data-module="<?php echo $_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value;?>
" title="" data-relation-id="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getId();?>
" <?php if ($_smarty_tpl->tpl_vars['RELATEDFIELDNAME']->value) {?>data-relatedfield ="<?php echo $_smarty_tpl->tpl_vars['RELATEDFIELDNAME']->value;?>
"<?php }?>><a href="index.php?<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl();?>
&tab_label=<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
" displaylabel="<?php echo $_smarty_tpl->tpl_vars['DETAILVIEWRELATEDLINKLBL']->value;?>
" recordsCount=""><?php if ($_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value == "ModComments") {?><span class="tab-icon textOverflowEllipsis"><i class="fa fa-comment"></i> &nbsp;<span class="content"><?php echo $_smarty_tpl->tpl_vars['DETAILVIEWRELATEDLINKLBL']->value;?>
</span></span><?php } else {
$_smarty_tpl->_assignInScope('RELATED_MODULE_MODEL', Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['RELATEDMODULENAME']->value));?><span class="tab-icon textOverflowEllipsis"><?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->getModuleIcon();?>
<span class="content"> &nbsp;<?php echo $_smarty_tpl->tpl_vars['DETAILVIEWRELATEDLINKLBL']->value;?>
</span></span><?php }?>&nbsp;<span class="numberCircle hide">0</span></a></li><?php }
}
?></ul></li><?php }
}?></ul></div></nav></div><?php }
}
