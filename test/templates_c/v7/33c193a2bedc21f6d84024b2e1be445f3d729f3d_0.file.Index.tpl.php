<?php
/* Smarty version 4.5.5, created on 2025-09-30 09:04:09
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\MenuEditor\Index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db9d09eff288_75610462',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '33c193a2bedc21f6d84024b2e1be445f3d729f3d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\MenuEditor\\Index.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db9d09eff288_75610462 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('APP_IMAGE_MAP', Vtiger_MenuStructure_Model::getAppIcons());?>
<div class="listViewPageDiv detailViewContainer col-sm-12" id="listViewContent">
	<div class="col-sm-12">
		<div class="row">
			<div class=" vt-default-callout vt-info-callout">
				<h4 class="vt-callout-header"><span class="fa fa-info-circle"></span><?php echo vtranslate('LBL_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME']->value);?>
</h4>
				<p><?php echo vtranslate('LBL_MENU_EDITOR_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME']->value);?>
</p>
			</div>
		</div>
	</div>
	<div class="col-lg-12" style="margin-top: 10px;">
		<div class="row" style="margin-left: -28px;">
			<?php $_smarty_tpl->_assignInScope('APP_LIST', Vtiger_MenuStructure_Model::getAppMenuList());?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['APP_IMAGE_MAP']->value, 'APP_IMAGE', false, 'APP_NAME', 'APP_MAP', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['APP_IMAGE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['APP_NAME']->value => $_smarty_tpl->tpl_vars['APP_IMAGE']->value) {
$_smarty_tpl->tpl_vars['APP_IMAGE']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_APP_MAP']->value['index']++;
?>
				<?php if (!in_array($_smarty_tpl->tpl_vars['APP_NAME']->value,$_smarty_tpl->tpl_vars['APP_LIST']->value)) {?> <?php continue 1;?> <?php }?>
				<div class="col-lg-2<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_APP_MAP']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_APP_MAP']->value['index'] : null) == 0 || php7_count($_smarty_tpl->tpl_vars['APP_LIST']->value) == 1) {
}?>">
					<div class="menuEditorItem app-<?php echo $_smarty_tpl->tpl_vars['APP_NAME']->value;?>
" data-app-name="<?php echo $_smarty_tpl->tpl_vars['APP_NAME']->value;?>
">
						<span class="fa <?php echo $_smarty_tpl->tpl_vars['APP_IMAGE']->value;?>
"></span>
						<?php ob_start();
echo vtranslate("LBL_".((string)$_smarty_tpl->tpl_vars['APP_NAME']->value));
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('TRANSLATED_APP_NAME', $_prefixVariable1);?>
						<div class="textOverflowEllipsis" title="<?php echo $_smarty_tpl->tpl_vars['TRANSLATED_APP_NAME']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['TRANSLATED_APP_NAME']->value;?>
</div>
					</div>
					<div class="sortable appContainer" data-appname="<?php echo $_smarty_tpl->tpl_vars['APP_NAME']->value;?>
">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['APP_MAPPED_MODULES']->value[$_smarty_tpl->tpl_vars['APP_NAME']->value], 'moduleModel', false, 'moduleName');
$_smarty_tpl->tpl_vars['moduleModel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['moduleName']->value => $_smarty_tpl->tpl_vars['moduleModel']->value) {
$_smarty_tpl->tpl_vars['moduleModel']->do_else = false;
?>
							<div class="modules noConnect" data-module="<?php echo $_smarty_tpl->tpl_vars['moduleName']->value;?>
">
								<i data-appname="<?php echo $_smarty_tpl->tpl_vars['APP_NAME']->value;?>
" class="fa fa-times pull-right whiteIcon menuEditorRemoveItem" style="margin: 5%;padding-top:15px;"></i>
								<div class="menuEditorItem menuEditorModuleItem">
									<span class="pull-left marginRight10px marginTop5px">
										<img class="alignMiddle cursorDrag" src="<?php echo vimage_path('drag.png');?>
"/>
									</span>
									<?php $_smarty_tpl->_assignInScope('translatedModuleLabel', vtranslate($_smarty_tpl->tpl_vars['moduleModel']->value->get('label'),$_smarty_tpl->tpl_vars['moduleName']->value));?>
									<span>
										<span class="marginRight10px marginTop5px pull-left"><?php echo $_smarty_tpl->tpl_vars['moduleModel']->value->getModuleIcon();?>
</span>
									</span>
									<div class="textOverflowEllipsis marginTop5px textAlignLeft" title="<?php echo $_smarty_tpl->tpl_vars['translatedModuleLabel']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['translatedModuleLabel']->value;?>
</div>
								</div>
							</div>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<div class="menuEditorItem menuEditorModuleItem menuEditorAddItem" data-appname="<?php echo $_smarty_tpl->tpl_vars['APP_NAME']->value;?>
">
							<i class="fa fa-plus pull-left marginTop5px"></i>
							<div class="marginTop10px"><?php echo vtranslate('LBL_SELECT_HIDDEN_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME']->value);?>
</div>
						</div> 
					</div>
				</div>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div>
	</div>
</div>
<?php }
}
