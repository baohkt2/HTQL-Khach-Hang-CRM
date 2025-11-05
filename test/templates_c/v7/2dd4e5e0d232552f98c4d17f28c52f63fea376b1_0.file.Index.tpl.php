<?php
/* Smarty version 4.5.5, created on 2025-11-05 04:54:22
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\ITS4YouEmails\Index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690ad87eb10943_02862439',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2dd4e5e0d232552f98c4d17f28c52f63fea376b1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\ITS4YouEmails\\Index.tpl',
      1 => 1762316122,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690ad87eb10943_02862439 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="padding20 emailsIntegration">
    <h3><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3>
    <hr>
    <form method="post">
        <table class="table border1px">
            <tr>
                <th colspan="2">
                    <input type="text" class="inputElement searchModule" placeholder="<?php echo vtranslate('LBL_SEARCH_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                </th>
            </tr>
            <tr>
                <?php $_smarty_tpl->_assignInScope('SUPPORTED_NUM', 0);?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SUPPORTED_MODULES']->value, 'SUPPORTED_MODULE');
$_smarty_tpl->tpl_vars['SUPPORTED_MODULE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['SUPPORTED_MODULE']->value) {
$_smarty_tpl->tpl_vars['SUPPORTED_MODULE']->do_else = false;
?>
                <?php $_smarty_tpl->_assignInScope('SUPPORTED_NUM', $_smarty_tpl->tpl_vars['SUPPORTED_NUM']->value+1);?>
                <?php $_smarty_tpl->_assignInScope('SUPPORTED_MODULE_NAME', $_smarty_tpl->tpl_vars['SUPPORTED_MODULE']->value->getName());?>
                <td class="updateModuleTd">
                    <label>
                        <input class="updateModule" type="checkbox" <?php if (ITS4YouEmails_Integration_Model::isActive($_smarty_tpl->tpl_vars['SUPPORTED_MODULE_NAME']->value)) {?>checked="checked"<?php }?> data-module="<?php echo $_smarty_tpl->tpl_vars['SUPPORTED_MODULE_NAME']->value;?>
">
                        <span><?php echo vtranslate($_smarty_tpl->tpl_vars['SUPPORTED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SUPPORTED_MODULE_NAME']->value);?>
</span>
                    </label>
                </td>

                <?php if ($_smarty_tpl->tpl_vars['SUPPORTED_NUM']->value == 2) {?>
                <?php $_smarty_tpl->_assignInScope('SUPPORTED_NUM', 0);?>
            </tr>
            <tr>
                <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tr>
        </table>
    </form>
</div><?php }
}
