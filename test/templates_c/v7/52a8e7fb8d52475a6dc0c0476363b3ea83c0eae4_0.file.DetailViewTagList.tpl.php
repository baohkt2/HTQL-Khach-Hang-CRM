<?php
/* Smarty version 4.5.5, created on 2025-11-02 08:35:46
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\DetailViewTagList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690717e2c3ca93_55337771',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52a8e7fb8d52475a6dc0c0476363b3ea83c0eae4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\DetailViewTagList.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690717e2c3ca93_55337771 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="tagContainer">
    <div class="tag-contents <?php if (empty($_smarty_tpl->tpl_vars['TAGS_LIST']->value)) {?> hide<?php }?>">
        <div class="detailTagList" data-num-of-tags-to-show="<?php echo Vtiger_Tag_Model::NUM_OF_TAGS_DETAIL;?>
">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['TAGS_LIST']->value, 'TAG_MODEL', false, NULL, 'tagCounter', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['TAG_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TAG_MODEL']->value) {
$_smarty_tpl->tpl_vars['TAG_MODEL']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_tagCounter']->value['iteration']++;
?>
                <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_tagCounter']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_tagCounter']->value['iteration'] : null) > Vtiger_Tag_Model::NUM_OF_TAGS_DETAIL) {?>
                     <?php break 1;?>
                <?php }?>
                <?php $_smarty_tpl->_assignInScope('TAG_LABEL', $_smarty_tpl->tpl_vars['TAG_MODEL']->value->getName());?>
                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Tag.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

            <a href="javascript:void(0);" class="moreTags <?php if (php7_count($_smarty_tpl->tpl_vars['TAGS_LIST']->value) <= Vtiger_Tag_Model::NUM_OF_TAGS_DETAIL) {?> hide <?php }?>">
                <span class="tagMoreCount"><?php echo php7_count($_smarty_tpl->tpl_vars['TAGS_LIST']->value)-Vtiger_Tag_Model::NUM_OF_TAGS_DETAIL;?>
</span>
                &nbsp;<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strtolower' ][ 0 ], array( vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE']->value) ));?>

            </a>
        </div>
    </div>
    <div id="addTagContainer" >
        <a id="addTagTriggerer" class="badge">
            <i class="fa fa-plus"></i>
            <?php echo vtranslate('LBL_ADD_NEW_TAG',$_smarty_tpl->tpl_vars['MODULE']->value);?>

        </a>
    </div>
    <div class="viewAllTagsContainer hide">
        <div class="modal-dialog">
            <div class="modal-content" style="min-height:200px">
                <?php ob_start();
echo vtranslate('LBL_TAG_FOR',$_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['RECORD']->value->getName());
$_prefixVariable4=ob_get_clean();
$_smarty_tpl->_assignInScope('TITLE', $_prefixVariable4);?>
                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                <div class="modal-body detailShowAllModal">
                    <div class="form-group">
                        <label class="col-lg-3 col-sm-12 col-md-4 control-label">
                            <?php echo vtranslate('LBL_CURRENT_TAGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                        </label>
                        <div class="col-lg-9 col-sm-12 col-md-8 ">
                            <div class="currentTag multiLevelTagList form-control">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['TAGS_LIST']->value, 'TAG_MODEL');
$_smarty_tpl->tpl_vars['TAG_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TAG_MODEL']->value) {
$_smarty_tpl->tpl_vars['TAG_MODEL']->do_else = false;
?>
                                    <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Tag.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
   <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "AddTagUI.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RECORD_NAME'=>$_smarty_tpl->tpl_vars['RECORD']->value->getName()), 0, true);
?>
</div>
<div id="dummyTagElement" class="hide">
<?php $_smarty_tpl->_assignInScope('TAG_MODEL', Vtiger_Tag_Model::getCleanInstance());
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Tag.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</div>
<div>
    <div  class="editTagContainer hide" >
        <input type="hidden" name="id" value="" />
        <div class="editTagContents">
            <div>
                <input type="text" name="tagName" value="Teee" style="width:100%" />
            </div>
            <div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="visibility" value="<?php echo Vtiger_Tag_Model::PRIVATE_TYPE;?>
"/>
                        <input type="checkbox" name="visibility" value="<?php echo Vtiger_Tag_Model::PUBLIC_TYPE;?>
" />
                        &nbsp; <?php echo vtranslate('LBL_SHARE_TAG',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                    </label>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-mini btn-success saveTag" type="button" style="width:50%;float:left">
                <center> <i class="fa fa-check"></i> </center>
            </button>
            <button class="btn btn-mini btn-danger cancelSaveTag" type="button" style="width:50%">
                <center> <i class="fa fa-close"></i> </center>
            </button>
        </div>
    </div>
</div>
      <?php }
}
