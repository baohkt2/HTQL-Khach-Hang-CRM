<?php
/* Smarty version 4.5.5, created on 2025-10-10 08:47:54
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\MergeRecords.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e8c83ac7c719_03706159',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '48283b0cf79970bfa9f06d54fd8ff33141bab633' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\MergeRecords.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e8c83ac7c719_03706159 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="fc-overlay-modal">
    <form class="form-horizontal" name="massMerge" method="post" action="index.php">
        <div class="overlayHeader">
            <?php ob_start();
echo vtranslate('LBL_MERGE_RECORDS_IN',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
ob_start();
echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable2 = ob_get_clean();
ob_start();
echo (($_prefixVariable1).(' > ')).($_prefixVariable2);
$_prefixVariable3=ob_get_clean();
$_smarty_tpl->_assignInScope('TITLE', $_prefixVariable3);?>
            <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0, true);
?>
        </div>
        <div class="overlayBody">
            <div class="container-fluid modal-body">
                <div class="row">
                    <div class="col-lg-12">
                            <input type="hidden" name=module value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" />
                            <input type="hidden" name="action" value="ProcessDuplicates" />
                            <input type="hidden" name="records" value=<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['RECORDS']->value);?>
 />
                            <div class="well well-sm" style="margin-bottom:8px">
                                <?php echo vtranslate('LBL_MERGE_RECORDS_DESCRIPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                            </div>
                            <div class="datacontent">
                                <table class="table table-bordered">
                                    <thead class='listViewHeaders'>
                                    <th>
                                        <?php echo vtranslate('LBL_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                    </th>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORDMODELS']->value, 'RECORD', false, NULL, 'recordList', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['RECORD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RECORD']->value) {
$_smarty_tpl->tpl_vars['RECORD']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_recordList']->value['index']++;
?>
                                        <th>
                                            <div class="checkbox">
                                                <label>
                                                <input <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_recordList']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_recordList']->value['index'] : null) == 0) {?>checked<?php }?> type=radio value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
" name="primaryRecord"/>
                                                &nbsp; <?php echo vtranslate('LBL_RECORD');?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDetailViewUrl();?>
" target="_blank" style="color: #15c;">#<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
</a>
                                                </label>
                                            </div>
                                        </th>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </thead>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS']->value, 'FIELD');
$_smarty_tpl->tpl_vars['FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD']->value) {
$_smarty_tpl->tpl_vars['FIELD']->do_else = false;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['FIELD']->value->isEditable()) {?>
                                        <tr>
                                            <td>
                                                <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                            </td>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORDMODELS']->value, 'RECORD', false, NULL, 'recordList', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['RECORD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RECORD']->value) {
$_smarty_tpl->tpl_vars['RECORD']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_recordList']->value['index']++;
?>
                                                <td>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_recordList']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_recordList']->value['index'] : null) == 0) {?>checked="checked"<?php }?> type=radio name="<?php echo $_smarty_tpl->tpl_vars['FIELD']->value->getName();?>
"
                                                            data-id="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['FIELD']->value->getName());?>
"/>
                                                             &nbsp; <?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD']->value->getName());?>

                                                        </label>
                                                   </div>
                                                </td>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </tr>
                                        <?php }?>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </table>
                             </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlayFooter">
            <?php $_smarty_tpl->_assignInScope('BUTTON_NAME', vtranslate('LBL_MERGE',$_smarty_tpl->tpl_vars['MODULE']->value));?>
            <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalFooter.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        </div>
    </form>
</div>
<?php }
}
