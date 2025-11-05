<?php
/* Smarty version 4.5.5, created on 2025-11-05 07:55:51
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\ITS4YouInstaller\RequirementsPreProcess.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b0307aff9e1_24069395',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f2df2b4e9bc5c1c9ade1dcbe4c9d71eb1bfa4631' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\ITS4YouInstaller\\RequirementsPreProcess.tpl',
      1 => 1762329314,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b0307aff9e1_24069395 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <br>
            <div class="clearfix">
                <h4 class="pull-left"><b><?php echo vtranslate($_smarty_tpl->tpl_vars['REQUIREMENTS_TITLE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></h4>
                <div class="pull-right">
                    <select id="source_module" class="select2" style="width: 300px;">
                        <optgroup label="<?php echo vtranslate('LBL_SYSTEM_REQUIREMENTS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                            <option value="index.php?module=ITS4YouInstaller&parent=Settings&view=Requirements"><?php echo vtranslate('LBL_SYSTEM',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option>
                        </optgroup>
                        <optgroup label="<?php echo vtranslate('LBL_MODULE_REQUIREMENTS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SOURCE_MODULES']->value, 'SOURCE_MODULE');
$_smarty_tpl->tpl_vars['SOURCE_MODULE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value) {
$_smarty_tpl->tpl_vars['SOURCE_MODULE']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value->getDefaultUrl();?>
" <?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE_NAME']->value == $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value->getModuleName()) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value->getModuleLabel();?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div><?php }
}
