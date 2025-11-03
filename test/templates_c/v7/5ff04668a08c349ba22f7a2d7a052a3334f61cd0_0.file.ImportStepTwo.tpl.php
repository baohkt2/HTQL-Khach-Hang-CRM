<?php
/* Smarty version 4.5.5, created on 2025-11-03 07:37:06
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Import\ImportStepTwo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69085ba266e189_82838146',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5ff04668a08c349ba22f7a2d7a052a3334f61cd0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Import\\ImportStepTwo.tpl',
      1 => 1761802268,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69085ba266e189_82838146 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class = "importBlockContainer hide" id="importStep2Conatiner">
    <span>
        <h4>&nbsp;&nbsp;&nbsp;<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_DUPLICATE_RECORD_HANDLING',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</h4>
    </span>
    <hr>
    <table class = "table table-borderless" id="duplicates_merge_configuration">
        <tr>
            <td>
                <span><strong><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_SPECIFY_MERGE_TYPE',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</strong></span>
                <select name="merge_type" id="merge_type" class ="select select2 form-control">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['AUTO_MERGE_TYPES']->value, '_MERGE_TYPE_LABEL', false, '_MERGE_TYPE');
$_smarty_tpl->tpl_vars['_MERGE_TYPE_LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['_MERGE_TYPE']->value => $_smarty_tpl->tpl_vars['_MERGE_TYPE_LABEL']->value) {
$_smarty_tpl->tpl_vars['_MERGE_TYPE_LABEL']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['_MERGE_TYPE']->value;?>
"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( $_smarty_tpl->tpl_vars['_MERGE_TYPE_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </td>
        </tr>
        <tr>
            <td><strong><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_SELECT_MERGE_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</strong></td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td><b><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_AVAILABLE_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</b></td>
                        <td></td>
                        <td><b><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_SELECTED_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</b></td>
                    </tr>
                    <tr>
                        <td>
                            <select id="available_fields" multiple size="10" name="available_fields" class="txtBox" style="width: 100%">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['AVAILABLE_FIELDS']->value, '_FIELD_INFO', false, '_FIELD_NAME');
$_smarty_tpl->tpl_vars['_FIELD_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['_FIELD_NAME']->value => $_smarty_tpl->tpl_vars['_FIELD_INFO']->value) {
$_smarty_tpl->tpl_vars['_FIELD_INFO']->do_else = false;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['_FIELD_NAME']->value == 'tags') {?> <?php continue 1;?> <?php }?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['_FIELD_NAME']->value;?>
"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( $_smarty_tpl->tpl_vars['_FIELD_INFO']->value->getFieldLabelKey(),$_smarty_tpl->tpl_vars['FOR_MODULE']->value ));?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </td>
                        <td width="6%">
                            <div align="center">
                                <button class="btn btn-default btn-lg" onClick ="return Vtiger_Import_Js.copySelectedOptions('#available_fields', '#selected_merge_fields')"><span class="glyphicon glyphicon-arrow-right"></span></button>
                                <button class="btn btn-default btn-lg" onClick ="return Vtiger_Import_Js.removeSelectedOptions('#selected_merge_fields')"><span class="glyphicon glyphicon-arrow-left"></span></button>
                            </div>
                        </td>
                        <td>
                            <input type="hidden" id="merge_fields" size="10" name="merge_fields" value="" />
                            <select id="selected_merge_fields" size="10" name="selected_merge_fields" multiple class="txtBox" style="width: 100%">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ENTITY_FIELDS']->value, '_FIELD_INFO', false, '_FIELD_NAME');
$_smarty_tpl->tpl_vars['_FIELD_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['_FIELD_NAME']->value => $_smarty_tpl->tpl_vars['_FIELD_INFO']->value) {
$_smarty_tpl->tpl_vars['_FIELD_INFO']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['_FIELD_NAME']->value;?>
"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( $_smarty_tpl->tpl_vars['_FIELD_INFO']->value->getFieldLabelKey(),$_smarty_tpl->tpl_vars['FOR_MODULE']->value ));?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>

<?php }
}
