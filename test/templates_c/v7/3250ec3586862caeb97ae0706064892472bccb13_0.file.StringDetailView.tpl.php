<?php
/* Smarty version 4.5.5, created on 2025-11-02 07:40:45
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\uitypes\StringDetailView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69070afde310b1_48666630',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3250ec3586862caeb97ae0706064892472bccb13' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\uitypes\\StringDetailView.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69070afde310b1_48666630 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == 'picklist' && $_smarty_tpl->tpl_vars['MODULE']->value != 'Users') {?>
    <?php $_smarty_tpl->_assignInScope('PICKLIST_COLOR', Settings_Picklist_Module_Model::getPicklistColorByValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')));?>  
    <span <?php if (!empty($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value)) {?> class="picklist-color" style="background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value;?>
; line-height:15px; color: <?php echo Settings_Picklist_Module_Model::getTextColor($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value);?>
;" <?php }?>>
        <?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value);?>

    </span>
<?php } elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == 'multipicklist' && $_smarty_tpl->tpl_vars['MODULE']->value != 'Users') {?>
    <?php $_smarty_tpl->_assignInScope('PICKLIST_DISPLAY_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value));?>
    <?php $_smarty_tpl->_assignInScope('MULTI_RAW_PICKLIST_VALUES', explode('|##|',$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')));?>
    <?php $_smarty_tpl->_assignInScope('MULTI_PICKLIST_VALUES', explode(',',$_smarty_tpl->tpl_vars['PICKLIST_DISPLAY_VALUE']->value));?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MULTI_RAW_PICKLIST_VALUES']->value, 'MULTI_PICKLIST_VALUE', false, 'MULTI_PICKLIST_INDEX');
$_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX']->value => $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->do_else = false;
?>
        <?php $_smarty_tpl->_assignInScope('PICKLIST_COLOR', Settings_Picklist_Module_Model::getPicklistColorByValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName(),trim($_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->value)));?>
        <span class="picklist-color" <?php if (!empty($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value)) {?> style="background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value;?>
; color: <?php echo Settings_Picklist_Module_Model::getTextColor($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value);?>
;" <?php }?>> <?php echo trim($_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUES']->value[$_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX']->value]);?>
 </span>
        <?php if ($_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUES']->value[$_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX']->value+1] != '') {?>,<?php }?>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
<?php } elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == 'currency') {?>
    <?php $_smarty_tpl->_assignInScope('CURRENT_USER_MODEL', Users_Record_Model::getCurrentUserModel());?>
    <?php $_smarty_tpl->_assignInScope('SYMBOL_PLACEMENT', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('currency_symbol_placement'));?>
    <?php if (($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == '72') && ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName() == 'unit_price')) {?>
        <?php $_smarty_tpl->_assignInScope('CURRENCY_SYMBOL', $_smarty_tpl->tpl_vars['BASE_CURRENCY_SYMBOL']->value);?>
    <?php } elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == '71') {?>
        <?php $_smarty_tpl->_assignInScope('CURRENCY_INFO', getCurrencySymbolandCRate($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('currency_id')));?>
        <?php $_smarty_tpl->_assignInScope('CURRENCY_SYMBOL', $_smarty_tpl->tpl_vars['CURRENCY_INFO']->value['symbol']);?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['SYMBOL_PLACEMENT']->value == '$1.0') {?>
        <?php echo (isset($_smarty_tpl->tpl_vars['CURRENCY_SYMBOL']->value)) ? $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL']->value : '';?>
&nbsp;<span class="currencyValue"><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
</span>
    <?php } else { ?>
        <span class="currencyValue"><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
</span>&nbsp;<?php echo $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL']->value;?>

    <?php }
} elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name') == 'signature') {?>
	<?php echo decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value));?>

<?php } else { ?>
    <?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value);?>

<?php }
}
}
