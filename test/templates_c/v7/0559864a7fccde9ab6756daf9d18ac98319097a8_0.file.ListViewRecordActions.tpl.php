<?php
/* Smarty version 4.5.5, created on 2025-09-18 09:15:20
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\Groups\ListViewRecordActions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cbcda8b9a264_48282735',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0559864a7fccde9ab6756daf9d18ac98319097a8' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\Groups\\ListViewRecordActions.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cbcda8b9a264_48282735 (Smarty_Internal_Template $_smarty_tpl) {
?> 

<div class="table-actions">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRecordLinks(), 'RECORD_LINK');
$_smarty_tpl->tpl_vars['RECORD_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RECORD_LINK']->value) {
$_smarty_tpl->tpl_vars['RECORD_LINK']->do_else = false;
?>
    <?php $_smarty_tpl->_assignInScope('RECORD_LINK_URL', $_smarty_tpl->tpl_vars['RECORD_LINK']->value->getUrl());?>
    <?php if ($_smarty_tpl->tpl_vars['RECORD_LINK']->value->getIcon() == 'icon-pencil') {?>
        <span>
            <a <?php if (stripos($_smarty_tpl->tpl_vars['RECORD_LINK_URL']->value,'javascript:') === 0) {?> onclick="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['RECORD_LINK_URL']->value,strlen("javascript:") ));?>
;if(event.stopPropagation){event.stopPropagation();}else{event.cancelBubble=true;}" <?php } else { ?> href='<?php echo $_smarty_tpl->tpl_vars['RECORD_LINK_URL']->value;?>
' <?php }?>>
                <i class="fa fa-pencil" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['RECORD_LINK']->value->getLabel(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>
            </a>
        </span>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['RECORD_LINK']->value->getIcon() == 'icon-trash') {?>
        <span>
            <a <?php if (stripos($_smarty_tpl->tpl_vars['RECORD_LINK_URL']->value,'javascript:') === 0) {?> onclick="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['RECORD_LINK_URL']->value,strlen("javascript:") ));?>
;if(event.stopPropagation){event.stopPropagation();}else{event.cancelBubble=true;}" <?php } else { ?> href='<?php echo $_smarty_tpl->tpl_vars['RECORD_LINK_URL']->value;?>
' <?php }?>>
                <i class="fa fa-trash" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['RECORD_LINK']->value->getLabel(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" ></i>
            </a>
        </span>
    <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>
<?php }
}
