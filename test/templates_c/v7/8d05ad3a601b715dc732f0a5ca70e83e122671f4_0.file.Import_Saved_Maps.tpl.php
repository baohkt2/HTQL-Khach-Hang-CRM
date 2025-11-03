<?php
/* Smarty version 4.5.5, created on 2025-11-03 07:52:39
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Import\Import_Saved_Maps.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69085f47836949_19527995',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8d05ad3a601b715dc732f0a5ca70e83e122671f4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Import\\Import_Saved_Maps.tpl',
      1 => 1761802268,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69085f47836949_19527995 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="row" style = "margin-bottom: 10px">
    <div class = "form-group">
        <div class = "col-lg-2" style="margin-top:8px">
            <label class ="control-label" for="saved_maps"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_USE_SAVED_MAPS',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</label>
        </div>
        <div class="col-lg-4">
            <select name="saved_maps" id="saved_maps" class="select2 form-control" onchange="Vtiger_Import_Js.loadSavedMap();">
                <option id="-1" value="" selected>--<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_SELECT_SAVED_MAPPING',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
--</option>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SAVED_MAPS']->value, '_MAP', false, '_MAP_ID');
$_smarty_tpl->tpl_vars['_MAP']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['_MAP_ID']->value => $_smarty_tpl->tpl_vars['_MAP']->value) {
$_smarty_tpl->tpl_vars['_MAP']->do_else = false;
?>
                    <option id="<?php echo $_smarty_tpl->tpl_vars['_MAP_ID']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['_MAP']->value->getStringifiedContent();?>
"><?php echo $_smarty_tpl->tpl_vars['_MAP']->value->getValue('name');?>
</option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
        </div>
        <div id="delete_map_container" class ="col-lg-1" style="display:none; margin-top: 10px">
            <a class="glyphicon glyphicon-trash cursorPointer" onclick="Vtiger_Import_Js.deleteMap('<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
');" alt="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_DELETE',$_smarty_tpl->tpl_vars['FOR_MODULE']->value ));?>
"></a>
        </div>
    </div>
</div>


<?php }
}
