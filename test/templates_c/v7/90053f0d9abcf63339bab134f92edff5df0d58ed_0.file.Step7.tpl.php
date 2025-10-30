<?php
/* Smarty version 4.5.5, created on 2025-09-16 08:04:27
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Install\Step7.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90bfbb85960_31112233',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90053f0d9abcf63339bab134f92edff5df0d58ed' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Install\\Step7.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90bfbb85960_31112233 (Smarty_Internal_Template $_smarty_tpl) {
?>
<center><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_LOADING_PLEASE_WAIT' ));?>
...</center>

<form class="form-horizontal" name="step7" method="post" action="?module=Users&action=Login">
	<img src="//stats.vtiger.com/stats.php?uid=<?php echo $_smarty_tpl->tpl_vars['APPUNIQUEKEY']->value;?>
&v=<?php echo $_smarty_tpl->tpl_vars['CURRENT_VERSION']->value;?>
&type=I&industry=<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'urlencode' ][ 0 ], array( $_smarty_tpl->tpl_vars['INDUSTRY']->value ));?>
" alt='' title='' border=0 width='1px' height='1px'>
	<input type=hidden name="username" value="admin" >
	<input type=hidden name="password" value="<?php echo $_smarty_tpl->tpl_vars['PASSWORD']->value;?>
" >
</form>
<?php echo '<script'; ?>
 type="text/javascript">
	jQuery(function () { /* Delay to let page load complete */
		setTimeout(function () {
			jQuery('form[name="step7"]').submit();
		}, 150);
	});
<?php echo '</script'; ?>
>
<?php }
}
