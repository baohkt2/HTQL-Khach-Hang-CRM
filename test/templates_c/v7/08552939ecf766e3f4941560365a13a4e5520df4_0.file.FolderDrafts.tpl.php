<?php
/* Smarty version 4.5.5, created on 2025-10-29 05:48:04
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\MailManager\FolderDrafts.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6901aa94efcf77_08617767',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08552939ecf766e3f4941560365a13a4e5520df4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\MailManager\\FolderDrafts.tpl',
      1 => 1758006150,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901aa94efcf77_08617767 (Smarty_Internal_Template $_smarty_tpl) {
?><div class='col-lg-12 padding0px'><span class="col-lg-1 paddingLeft5px"><input type='checkbox' id='mainCheckBox' class="pull-left"></span><span class="col-lg-6 padding0px"><span class="fa-stack fa-sm cursorPointer mmActionIcon" id="mmDeleteMail" title="<?php echo vtranslate('LBL_Delete',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-trash-o fa-stack-lg"></i></span></span><span class="col-lg-5 padding0px"><span class="pull-right"><?php if ($_smarty_tpl->tpl_vars['FOLDER']->value->mails()) {?><span><?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->pageInfo();?>
&nbsp;&nbsp;</span><?php }?><button type="button" id="PreviousPageButton" class="btn btn-default marginRight0px" <?php if ($_smarty_tpl->tpl_vars['FOLDER']->value->hasPrevPage()) {?>data-page='<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->pageCurrent(-1);?>
'<?php } else { ?>disabled="disabled"<?php }?>><i class="fa fa-caret-left"></i></button><button type="button" id="NextPageButton" class="btn btn-default" <?php if ($_smarty_tpl->tpl_vars['FOLDER']->value->hasNextPage()) {?> data-page='<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->pageCurrent(1);?>
'<?php } else { ?>disabled="disabled"<?php }?>><i class="fa fa-caret-right"></i></button></span></span></div><div class='col-lg-12 padding0px'><span class="col-lg-1 padding0px">&nbsp;</span><div class="col-lg-9 mmSearchContainer"><div><div class="input-group col-lg-8 padding0px"><input type="text" class="form-control" id="mailManagerSearchbox" aria-describedby="basic-addon2" value="<?php echo $_smarty_tpl->tpl_vars['QUERY']->value;?>
" data-foldername='<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->name();?>
' placeholder="<?php echo vtranslate('LBL_TYPE_TO_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></div><div class="col-lg-4 padding0px mmSearchDropDown"><select id="searchType" style="background: #DDDDDD url('layouts/v7/skins/images/arrowdown.png') no-repeat 95% 40%; padding-left: 9px;"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SEARCHOPTIONS']->value, 'label', false, 'value');
$_smarty_tpl->tpl_vars['label']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value => $_smarty_tpl->tpl_vars['label']->value) {
$_smarty_tpl->tpl_vars['label']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['value']->value == $_smarty_tpl->tpl_vars['TYPE']->value) {?>selected<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['label']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div></div><div class='col-lg-2' id="mmSearchButtonContainer"><button id='mm_searchButton' class="pull-right" style="width: 72%;"><?php echo vtranslate('LBL_Search',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div></div><?php if ($_smarty_tpl->tpl_vars['FOLDER']->value->mails()) {?><div class="col-lg-12 mmEmailContainerDiv" id='emailListDiv'><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FOLDER']->value->mails(), 'MAIL');
$_smarty_tpl->tpl_vars['MAIL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MAIL']->value) {
$_smarty_tpl->tpl_vars['MAIL']->do_else = false;
$_smarty_tpl->_assignInScope('IS_READ', 1);?><div class="col-lg-12 cursorPointer mailEntry <?php if ($_smarty_tpl->tpl_vars['IS_READ']->value) {?>mmReadEmail<?php }?>" data-read='<?php echo $_smarty_tpl->tpl_vars['IS_READ']->value;?>
'><span class="col-lg-1 paddingLeft5px"><input type='checkbox' class='mailCheckBox' class="pull-left"></span><div class="col-lg-11 draftEmail padding0px"><input type="hidden" class="msgNo" value='<?php echo $_smarty_tpl->tpl_vars['MAIL']->value['id'];?>
'><div class="col-lg-8 padding0px font13px stepText"><?php echo strip_tags($_smarty_tpl->tpl_vars['MAIL']->value['saved_toid']);?>
<br><?php echo strip_tags($_smarty_tpl->tpl_vars['MAIL']->value['subject']);?>
</div><div class="col-lg-4 padding0px"><span class="pull-right"><span class='mmDateTimeValue'><?php ob_start();
echo $_smarty_tpl->tpl_vars['MAIL']->value['date_start'];
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>
</span></span></div><div class="col-lg-12 mmMailDesc"><?php $_smarty_tpl->_assignInScope('MAIL_DESC', str_replace("\n"," ",strip_tags($_smarty_tpl->tpl_vars['MAIL']->value['description'])));
echo $_smarty_tpl->tpl_vars['MAIL_DESC']->value;?>
</div></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><?php } else { ?><div class="noMailsDiv"><center><strong><?php echo vtranslate('LBL_No_Mails_Found',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></center></div><?php }
}
}
