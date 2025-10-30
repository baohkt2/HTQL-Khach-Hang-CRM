<?php
/* Smarty version 4.5.5, created on 2025-09-30 09:00:16
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Roles\EditView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db9c2046ecf7_49818402',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95cb095d9f71618fcf6726e8b48696ac6dabdf08' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Roles\\EditView.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db9c2046ecf7_49818402 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="editViewPageDiv viewContent">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="editViewHeader">
                <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getId()) {?>
                    <h4>
                        <?php echo vtranslate('LBL_EDIT_ROLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                    </h4>
                <?php } else { ?>
                    <h4>
                        <?php echo vtranslate('LBL_CREATE_ROLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                    </h4>
                <?php }?>
            </div>
            <hr>
        <form class="form-horizontal" id="EditView" name="EditRole" method="post" action="index.php" enctype="multipart/form-data">
            <div class="editViewBody">
                <div class="editViewContents">
                    <input type="hidden" name="module" value="Roles">
                    <input type="hidden" name="action" value="Save">
                    <input type="hidden" name="parent" value="Settings">
                    <?php $_smarty_tpl->_assignInScope('RECORD_ID', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getId());?>
                    <input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" />
                    <input type="hidden" name="mode" value="<?php echo $_smarty_tpl->tpl_vars['MODE']->value;?>
">
                    <input type="hidden" name="profile_directly_related_to_role_id" value="<?php echo (isset($_smarty_tpl->tpl_vars['PROFILE_ID']->value)) ? $_smarty_tpl->tpl_vars['PROFILE_ID']->value : '';?>
" />
                    <?php ob_start();
if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getParent()) {
echo "true";
}
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('HAS_PARENT', $_prefixVariable1);?>
                    <?php if ($_smarty_tpl->tpl_vars['HAS_PARENT']->value) {?>
                        <input type="hidden" name="parent_roleid" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getParent()->getId();?>
">
                    <?php }?>
                    <div name='editContent'>
                        <div class="form-group">
                            <label class="control-label fieldLabel col-lg-3 col-md-3 col-sm-3">
                                <strong><?php echo vtranslate('LBL_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></strong>
                            </label>
                            <div class="controls fieldValue col-lg-4 col-md-4 col-sm-4" >
                                <div class=""> <input type="text" class="inputElement" name="rolename" id="profilename" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
" data-rule-required='true'  />
                                </div> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label fieldLabel col-lg-3 col-md-3 col-sm-3">
                                <strong><?php echo vtranslate('LBL_REPORTS_TO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong>
                            </label>
                            <div class="controls fieldValue col-lg-4 col-md-4 col-sm-4" >
                                <input type="hidden" name="parent_roleid" <?php if ($_smarty_tpl->tpl_vars['HAS_PARENT']->value) {?>value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getParent()->getId();?>
"<?php }?>>
                                <div class=""> <input type="text" class="inputElement" name="parent_roleid_display" <?php if ($_smarty_tpl->tpl_vars['HAS_PARENT']->value) {?>value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getParent()->getName();?>
"<?php }?> readonly>
                                </div></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label fieldLabel col-lg-3 col-md-3 col-sm-3">
                                <strong><?php echo vtranslate('LBL_CAN_ASSIGN_RECORDS_TO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong>
                            </label>
                            <div class="controls fieldValue col-lg-9 col-md-9 col-sm-9">
                                <div class="radio">
                                    <label>
                                    <input type="radio" value="1"<?php if (!$_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('allowassignedrecordsto')) {?> checked=""<?php }?> <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('allowassignedrecordsto') == '1') {?> checked="" <?php }?> name="allowassignedrecordsto" data-handler="new" class="alignTop"/>
                                    &nbsp;<?php echo vtranslate('LBL_ALL_USERS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" value="2" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('allowassignedrecordsto') == '2') {?> checked="" <?php }?> name="allowassignedrecordsto" data-handler="new" class="alignTop"/>
                                    &nbsp;<?php echo vtranslate('LBL_USERS_WITH_SAME_LEVEL_AND_SUBORDINATES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" value="4" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('allowassignedrecordsto') == '4') {?> checked="" <?php }?> name="allowassignedrecordsto" data-handler="new" class="alignTop"/>
                                    &nbsp;<?php echo vtranslate('LBL_USERS_WITH_SAME_OR_LOWER_LEVEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" value="3" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('allowassignedrecordsto') == '3') {?> checked="" <?php }?> name="allowassignedrecordsto" data-handler="new" class="alignTop"/>
                                    &nbsp;<?php echo vtranslate('LBL_USERS_WITH_LOWER_LEVEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label fieldLabel col-lg-3 col-md-3 col-sm-3">
                                <strong><?php echo vtranslate('LBL_PRIVILEGES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong>
                            </label>
                            <div class="controls fieldValue col-lg-9 col-md-9 col-sm-9">
                                <div  class="radio">
                                    <label>
                                    <input type="radio" value="1" <?php if ($_smarty_tpl->tpl_vars['PROFILE_DIRECTLY_RELATED_TO_ROLE']->value) {?> checked="" <?php }?> name="profile_directly_related_to_role" data-handler="new" class="alignTop"/>&nbsp;
                                    <?php echo vtranslate('LBL_ASSIGN_NEW_PRIVILEGES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" value="0" <?php if ($_smarty_tpl->tpl_vars['PROFILE_DIRECTLY_RELATED_TO_ROLE']->value == false) {?> checked="" <?php }?> name="profile_directly_related_to_role" data-handler="existing" class="alignTop"/>&nbsp;
                                    <?php echo vtranslate('LBL_ASSIGN_EXISTING_PRIVILEGES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group " data-content="new" >
                            <div class="profileData col-sm-12">
                            </div>
                        </div>
                        <div class="form-group " data-content="existing">
                            <div class="fieldLabel control-label col-lg-3 col-md-3 col-sm-3"></div>
                            <div class="fieldValue controls col-lg-9 col-md-9 col-sm-9">
                                <?php $_smarty_tpl->_assignInScope('ROLE_PROFILES', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getProfiles());?>
                                <select class="select2 inputElement col-lg-12 hide" multiple="true" id="profilesList" name="profiles[]" data-placeholder="<?php echo vtranslate('LBL_CHOOSE_PROFILES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" style="width: 460px" data-rule-required="true">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_PROFILES']->value, 'PROFILE');
$_smarty_tpl->tpl_vars['PROFILE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PROFILE']->value) {
$_smarty_tpl->tpl_vars['PROFILE']->do_else = false;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['PROFILE']->value->isDirectlyRelated() == false) {?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['PROFILE']->value->getId();?>
" <?php if ((isset($_smarty_tpl->tpl_vars['ROLE_PROFILES']->value[$_smarty_tpl->tpl_vars['PROFILE']->value->getId()]))) {?>selected="true"<?php }?>><?php echo $_smarty_tpl->tpl_vars['PROFILE']->value->getName();?>
</option>
                                        <?php }?>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <div class='modal-overlay-footer  clearfix'>
                <div class="row clearfix">
                    <div class=' textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
                        <button type='submit' class='btn btn-success saveButton' ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;
                        <a class='cancelLink'  href="javascript:history.back()" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
</div>
</div>
</div>
<?php }
}
