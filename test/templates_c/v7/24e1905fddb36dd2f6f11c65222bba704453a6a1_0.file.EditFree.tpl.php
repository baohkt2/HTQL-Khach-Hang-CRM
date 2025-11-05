<?php
/* Smarty version 4.5.5, created on 2025-11-05 15:12:28
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\PDFMaker\EditFree.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b695c91f913_60877459',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '24e1905fddb36dd2f6f11c65222bba704453a6a1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\PDFMaker\\EditFree.tpl',
      1 => 1762329414,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b695c91f913_60877459 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?>

<div class="contents tabbable ui-sortable">


    <form class="form-horizontal recordEditView" id="EditView" name="EditView" method="post" action="index.php" enctype="multipart/form-data">
        <input type="hidden" name="module" value="PDFMaker">
        <input type="hidden" name="parenttab" value="<?php echo $_smarty_tpl->tpl_vars['PARENTTAB']->value;?>
">
        <input type="hidden" name="templateid" id="templateid" value="<?php echo $_smarty_tpl->tpl_vars['TEMPLATEID']->value;?>
">
        <input type="hidden" name="action" value="SavePDFTemplate">
        <input type="hidden" name="redirect" value="true">
        <input type="hidden" name="return_module" value="<?php echo $_REQUEST['return_module'];?>
">
        <input type="hidden" name="return_view" value="<?php echo $_REQUEST['return_view'];?>
">
        <input type="hidden" name="selectedTab" id="selectedTab" value="properties">
        <input type="hidden" name="selectedTab2" id="selectedTab2" value="body">

        <ul class="nav nav-tabs layoutTabs massEditTabs">
            <li class="detailviewTab active">
                <a data-toggle="tab" href="#pdfContentEdit" aria-expanded="true"><strong><?php echo vtranslate('LBL_PROPERTIES_TAB',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a>
            </li>
            <li class="detailviewTab">
                <a data-toggle="tab" href="#pdfContentOther" aria-expanded="false"><strong><?php echo vtranslate('LBL_OTHER_INFO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a>
            </li>
            <li class="detailviewTab">
                <a data-toggle="tab" href="#pdfContentLabels" aria-expanded="false"><strong><?php echo vtranslate('LBL_LABELS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a>
            </li>
            <li class="detailviewTab">
                <a data-toggle="tab" href="#pdfContentProducts" aria-expanded="false"><strong><?php echo vtranslate('LBL_ARTICLE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a>
            </li>
            <li class="detailviewTab">
                <a data-toggle="tab" href="#pdfContentHeaderFooter" aria-expanded="false"><strong><?php echo vtranslate('LBL_HEADER_TAB',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 / <?php echo vtranslate('LBL_FOOTER_TAB',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a>
            </li>
            <li class="detailviewTab">
                <a data-toggle="tab" href="#editTabSettings" aria-expanded="false"><strong><?php echo vtranslate('LBL_SETTINGS_TAB',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a>
            </li>
        </ul>
        <div >
                        <div>
                <div class="row" >
                    <div class="left-block col-xs-4">
                        <div>
                            <div class="tab-content layoutContent themeTableColor overflowVisible">
                                <div class="tab-pane active" id="pdfContentEdit">
                                    <div class="edit-template-content col-lg-4" style="position:fixed;z-index:1000;">
                                                                                <div id="properties_div">
                                            <br>
                                                                                        <div class="form-group">
                                                <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                    <?php echo vtranslate('LBL_MODULENAMES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['MODULENAME']->value;?>
:
                                                </label>
                                                <div class="controls col-sm-9">
                                                    <div class="input-group">
                                                        <input type="hidden" name="modulename" id="modulename" value="<?php echo $_smarty_tpl->tpl_vars['SELECTMODULE']->value;?>
">
                                                        <select name="modulefields" id="modulefields" class="select2 form-control">
                                                            <option value=""><?php echo vtranslate('LBL_SELECT_MODULE_FIELD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
                                                        </select>
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-success InsertIntoTemplate" data-type="modulefields" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                            <button type="button" class="btn btn-warning InsertLIntoTemplate" data-type="modulefields" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-text-width"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                                                        <div class="form-group">
                                                <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                    <?php echo vtranslate('LBL_RELATED_MODULES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                </label>
                                                <div class="controls col-sm-9">
                                                    <div class="input-group">
                                                        <select name="relatedmodulesorce" id="relatedmodulesorce" class="select2 form-control">
                                                            <option value=""><?php echo vtranslate('LBL_SELECT_MODULE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_MODULES']->value, 'RelMod');
$_smarty_tpl->tpl_vars['RelMod']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RelMod']->value) {
$_smarty_tpl->tpl_vars['RelMod']->do_else = false;
?>
                                                                <option value="<?php echo $_smarty_tpl->tpl_vars['RelMod']->value[0];?>
" data-module="<?php echo $_smarty_tpl->tpl_vars['RelMod']->value[3];?>
"><?php echo $_smarty_tpl->tpl_vars['RelMod']->value[1];?>
 (<?php echo $_smarty_tpl->tpl_vars['RelMod']->value[2];?>
)</option>
                                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                </label>
                                                <div class="controls col-sm-9">
                                                    <div class="input-group">
                                                        <select name="relatedmodulefields" id="relatedmodulefields" class="select2 form-control">
                                                            <option value=""><?php echo vtranslate('LBL_SELECT_MODULE_FIELD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
                                                        </select>
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-success InsertIntoTemplate" data-type="relatedmodulefields" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                            <button type="button" class="btn btn-warning InsertLIntoTemplate" data-type="relatedmodulefields" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-text-width"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pdfContentOther">
                                    <div class="edit-template-content col-lg-4" style="position:fixed;z-index:1000;">
                                        <br>
                                                                                <div class="form-group">
                                            <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                <?php echo vtranslate('LBL_COMPANY_USER_INFO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                            </label>
                                            <div class="controls col-sm-9">
                                                <div class="input-group">
                                                    <select name="acc_info_type" id="acc_info_type" class="select2 form-control">
                                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['CUI_BLOCKS']->value),$_smarty_tpl);?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label fieldLabel col-sm-3" style="font-weight: normal"></label>
                                            <div class="controls col-sm-9">
                                                <div>
                                                    <div id="acc_info_div" class="au_info_div" style="display:inline;">
                                                        <div class="input-group">
                                                            <select name="acc_info" id="acc_info" class="select2 form-control">
                                                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['ACCOUNTINFORMATIONS']->value),$_smarty_tpl);?>

                                                            </select>
                                                            <div class="input-group-btn">
                                                                <button type="button" class="btn btn-success InsertIntoTemplate" data-type="acc_info" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                                <button type="button" class="btn btn-warning InsertLIntoTemplate" data-type="acc_info" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-text-width"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="user_info_div" class="au_info_div" style="display:none;">
                                                        <div class="input-group">
                                                            <select name="user_info" id="user_info" class="select2 form-control">
                                                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['USERINFORMATIONS']->value['a']),$_smarty_tpl);?>

                                                            </select>
                                                            <div class="input-group-btn">
                                                                <button type="button" class="btn btn-success InsertIntoTemplate" data-type="user_info" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                                <button type="button" class="btn btn-warning InsertLIntoTemplate" data-type="user_info" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-text-width"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="logged_user_info_div" class="au_info_div" style="display:none;">
                                                        <div class="input-group">
                                                            <select name="logged_user_info" id="logged_user_info" class="select2 form-control">
                                                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['USERINFORMATIONS']->value['l']),$_smarty_tpl);?>

                                                            </select>
                                                            <div class="input-group-btn">
                                                                <button type="button" class="btn btn- InsertIntoTemplate" data-type="logged_user_info" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                                <button type="button" class="btn btn-warning InsertLIntoTemplate" data-type="logged_user_info" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-text-width"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="modifiedby_user_info_div" class="au_info_div" style="display:none;">
                                                        <div class="input-group">
                                                            <select name="modifiedby_user_info" id="modifiedby_user_info" class="select2 form-control">
                                                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['USERINFORMATIONS']->value['m']),$_smarty_tpl);?>

                                                            </select>
                                                            <div class="input-group-btn">
                                                                <button type="button" class="btn btn-success InsertIntoTemplate" data-type="modifiedby_user_info" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                                <button type="button" class="btn btn-warning InsertLIntoTemplate" data-type="modifiedby_user_info" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-text-width"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="smcreator_user_info_div" class="au_info_div form-control" style="display:none;">
                                                        <div class="input-group">
                                                            <select name="smcreator_user_info" id="smcreator_user_info" class="select2 form-control">
                                                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['USERINFORMATIONS']->value['c']),$_smarty_tpl);?>

                                                            </select>
                                                            <div class="input-group-btn">
                                                                <button type="button" class="btn btn-success InsertIntoTemplate" data-type="smcreator_user_info" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                                <button type="button" class="btn btn-warning InsertLIntoTemplate" data-type="smcreator_user_info" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-text-width"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                <?php echo vtranslate('TERMS_AND_CONDITIONS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                            </label>
                                            <div class="controls col-sm-9">
                                                <div class="input-group">
                                                    <select name="invterandcon" id="invterandcon" class="select2 form-control">
                                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['INVENTORYTERMSANDCONDITIONS']->value),$_smarty_tpl);?>

                                                    </select>
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-success InsertIntoTemplate" data-type="invterandcon" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                <?php echo vtranslate('LBL_CURRENT_DATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                            </label>
                                            <div class="controls col-sm-9">
                                                <div class="input-group">
                                                    <select name="dateval" id="dateval" class="select2 form-control">
                                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['DATE_VARS']->value),$_smarty_tpl);?>

                                                    </select>
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-success InsertIntoTemplate" data-type="dateval" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pdfContentLabels">
                                    <dic class="edit-template-content col-lg-4" style="position:fixed;z-index:1000;">
                                                                                <div id="labels_div">
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                    <?php echo vtranslate('LBL_GLOBAL_LANG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                </label>
                                                <div class="controls col-sm-9">
                                                    <div class="input-group">
                                                        <select name="global_lang" id="global_lang" class="select2 form-control">
                                                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['GLOBAL_LANG_LABELS']->value),$_smarty_tpl);?>

                                                        </select>
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-warning InsertIntoTemplate" data-type="global_lang" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-text-width"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                    <?php echo vtranslate('LBL_MODULE_LANG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                </label>
                                                <div class="controls col-sm-9">
                                                    <div class="input-group">
                                                        <select name="module_lang" id="module_lang" class="select2 form-control">
                                                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['MODULE_LANG_LABELS']->value),$_smarty_tpl);?>

                                                        </select>
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-warning InsertIntoTemplate" data-type="module_lang" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-text-width"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </dic>
                                </div>
                                <div class="tab-pane" id="pdfContentProducts">
                                    <dic class="edit-template-content col-lg-4" style="position:fixed;z-index:1000;">
                                                                                <div id="products_div">
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                    <?php echo vtranslate('LBL_PRODUCT_BLOC_TPL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                </label>
                                                <div class="controls col-sm-9">
                                                    <div class="input-group">
                                                        <select name="productbloctpl2" id="productbloctpl2" class="select2 form-control">
                                                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['PRODUCT_BLOC_TPL']->value),$_smarty_tpl);?>

                                                        </select>
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-success InsertIntoTemplate" data-type="productbloctpl2" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                    <?php echo vtranslate('LBL_ARTICLE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                </label>
                                                <div class="controls col-sm-9">
                                                    <div class="input-group">
                                                        <select name="articelvar" id="articelvar" class="select2 form-control">
                                                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['ARTICLE_STRINGS']->value),$_smarty_tpl);?>

                                                        </select>
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-success InsertIntoTemplate" data-type="articelvar" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                                                        <div class="form-group">
                                                <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                    *<?php echo vtranslate('LBL_PRODUCTS_AVLBL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                </label>
                                                <div class="controls col-sm-9">
                                                    <div class="input-group">
                                                        <select name="psfields" id="psfields" class="select2 form-control">
                                                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['SELECT_PRODUCT_FIELD']->value),$_smarty_tpl);?>

                                                        </select>
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-success InsertIntoTemplate" data-type="psfields" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                                                        <div class="form-group">
                                                <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                    *<?php echo vtranslate('LBL_PRODUCTS_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                </label>
                                                <div class="controls col-sm-9">
                                                    <div class="input-group">
                                                        <select name="productfields" id="productfields" class="select2 form-control">
                                                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['PRODUCTS_FIELDS']->value),$_smarty_tpl);?>

                                                        </select>
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-success InsertIntoTemplate" data-type="productfields" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                                                        <div class="form-group">
                                                <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                    *<?php echo vtranslate('LBL_SERVICES_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                </label>
                                                <div class="controls col-sm-9">
                                                    <div class="input-group">
                                                        <select name="servicesfields" id="servicesfields" class="select2 form-control">
                                                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['SERVICES_FIELDS']->value),$_smarty_tpl);?>

                                                        </select>
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-success InsertIntoTemplate" data-type="servicesfields" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="muted"><small><?php echo vtranslate('LBL_PRODUCT_FIELD_INFO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</small></label>
                                            </div>
                                        </div>
                                    </dic>
                                </div>
                                <div class="tab-pane" id="pdfContentHeaderFooter">
                                    <dic class="edit-template-content col-lg-4" style="position:fixed;z-index:1000;">
                                                                                <div id="headerfooter_div">
                                            <br>
                                                                                        <div class="form-group">
                                                <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                    <?php echo vtranslate('LBL_HEADER_FOOTER_VARIABLES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                </label>
                                                <div class="controls col-sm-9">
                                                    <div class="input-group">
                                                        <select name="header_var" id="header_var" class="select2 form-control">
                                                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['HEAD_FOOT_VARS']->value,'selected'=>''),$_smarty_tpl);?>

                                                        </select>
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-success InsertIntoTemplate" data-type="header_var" title="<?php echo vtranslate('LBL_INSERT_TO_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-usd"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                                                        <div class="form-group">
                                                <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                    <?php echo vtranslate('LBL_DISPLAY_HEADER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                </label>
                                                <div class="controls col-sm-9">
                                                    <div class="input-group">
                                                        <b><?php echo vtranslate('LBL_ALL_PAGES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b>&nbsp;<input type="checkbox" id="dh_allid" name="dh_all" onclick="PDFMaker_EditFreeJs.hf_checkboxes_changed(this, 'header');" <?php echo $_smarty_tpl->tpl_vars['DH_ALL']->value;?>
/>
                                                        &nbsp;&nbsp;
                                                        <?php echo vtranslate('LBL_FIRST_PAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<input type="checkbox" id="dh_firstid" name="dh_first" onclick="PDFMaker_EditFreeJs.hf_checkboxes_changed(this, 'header');" <?php echo $_smarty_tpl->tpl_vars['DH_FIRST']->value;?>
/>
                                                        &nbsp;&nbsp;
                                                        <?php echo vtranslate('LBL_OTHER_PAGES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<input type="checkbox" id="dh_otherid" name="dh_other" onclick="PDFMaker_EditFreeJs.hf_checkboxes_changed(this, 'header');" <?php echo $_smarty_tpl->tpl_vars['DH_OTHER']->value;?>
/>&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                    <?php echo vtranslate('LBL_DISPLAY_FOOTER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                </label>
                                                <div class="controls col-sm-9">
                                                    <div class="input-group">
                                                        <b><?php echo vtranslate('LBL_ALL_PAGES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b>&nbsp;<input type="checkbox" id="df_allid" name="df_all" onclick="PDFMaker_EditFreeJs.hf_checkboxes_changed(this, 'footer');" <?php echo $_smarty_tpl->tpl_vars['DF_ALL']->value;?>
/>
                                                        &nbsp;&nbsp;
                                                        <?php echo vtranslate('LBL_FIRST_PAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<input type="checkbox" id="df_firstid" name="df_first" onclick="PDFMaker_EditFreeJs.hf_checkboxes_changed(this, 'footer');" <?php echo $_smarty_tpl->tpl_vars['DF_FIRST']->value;?>
/>
                                                        &nbsp;&nbsp;
                                                        <?php echo vtranslate('LBL_OTHER_PAGES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<input type="checkbox" id="df_otherid" name="df_other" onclick="PDFMaker_EditFreeJs.hf_checkboxes_changed(this, 'footer');" <?php echo $_smarty_tpl->tpl_vars['DF_OTHER']->value;?>
/>
                                                        &nbsp;&nbsp;
                                                        <?php echo vtranslate('LBL_LAST_PAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<input type="checkbox" id="df_lastid" name="df_last" onclick="PDFMaker_EditFreeJs.hf_checkboxes_changed(this, 'footer');" <?php echo $_smarty_tpl->tpl_vars['DF_LAST']->value;?>
/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </dic>
                                </div>
                                <div class="tab-pane" id="editTabSettings">
                                    <div id="settings_div">
                                        <br>
                                        <div class="form-group">
                                            <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                <?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                            </label>
                                            <div class="controls col-sm-9">
                                                <input name="description" type="text" value="<?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
" class="col-sm-12 form-control" tabindex="2">
                                            </div>
                                        </div>
                                                                                <div class="form-group">
                                            <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                <?php echo vtranslate('LBL_PDF_FORMAT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                            </label>
                                            <div class="controls col-sm-9">
                                                <div class="input-group">
                                                    <select name="pdf_format" id="pdf_format" class="select2 col-sm-12" onchange="PDFMaker_EditFreeJs.CustomFormat();">
                                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['FORMATS']->value,'selected'=>$_smarty_tpl->tpl_vars['SELECT_FORMAT']->value),$_smarty_tpl);?>

                                                    </select>
                                                    <br>
                                                    <table class="table showInlineTable" id="custom_format_table" <?php if ($_smarty_tpl->tpl_vars['SELECT_FORMAT']->value != 'Custom') {?>style="display:none"<?php }?>>
                                                        <tr>
                                                            <td align="right" nowrap><?php echo vtranslate('LBL_WIDTH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
                                                            <td>
                                                                <input type="text" name="pdf_format_width" id="pdf_format_width" class="inputElement" value="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_FORMAT']->value['width'];?>
" style="width:50px">
                                                            </td>
                                                            <td align="right" nowrap><?php echo vtranslate('LBL_HEIGHT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
                                                            <td>
                                                                <input type="text" name="pdf_format_height" id="pdf_format_height" class="inputElement" value="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_FORMAT']->value['height'];?>
" style="width:50px">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                                                                <div class="form-group">
                                            <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                <?php echo vtranslate('LBL_PDF_ORIENTATION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                            </label>
                                            <div class="controls col-sm-9">
                                                <div class="input-group">
                                                    <select name="pdf_orientation" id="pdf_orientation" class="select2 form-control">
                                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['ORIENTATIONS']->value,'selected'=>$_smarty_tpl->tpl_vars['SELECT_ORIENTATION']->value),$_smarty_tpl);?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                                                                <div class="form-group">
                                            <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                <?php echo vtranslate('LBL_IGNORE_PICKLIST_VALUES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                            </label>
                                            <div class="controls col-sm-9">
                                                <input type="text" name="ignore_picklist_values" value="<?php echo $_smarty_tpl->tpl_vars['IGNORE_PICKLIST_VALUES']->value;?>
" class="form-control"/>
                                            </div>
                                        </div>
                                                                                <?php $_smarty_tpl->_assignInScope('margin_input_width', '50px');?>
                                        <?php $_smarty_tpl->_assignInScope('margin_label_width', '50px');?>
                                        <div class="form-group">
                                            <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                <?php echo vtranslate('LBL_MARGINS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                            </label>
                                            <div class="controls col-sm-9">

                                                <div class="form-group">
                                                    <label class="control-label fieldLabel col-sm-1" style="font-weight: normal">
                                                        <?php echo vtranslate('LBL_TOP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                    </label>
                                                    <div class="controls col-sm-11">
                                                        <input type="text" name="margin_top" id="margin_top" class="inputElement" value="<?php echo $_smarty_tpl->tpl_vars['MARGINS']->value['top'];?>
" style="width:<?php echo $_smarty_tpl->tpl_vars['margin_input_width']->value;?>
" onKeyUp="PDFMaker_EditFreeJs.ControlNumber('margin_top', false);">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label fieldLabel col-sm-1" style="font-weight: normal">
                                                        <?php echo vtranslate('LBL_BOTTOM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                    </label>
                                                    <div class="controls col-sm-11">
                                                        <input type="text" name="margin_bottom" id="margin_bottom" class="inputElement" value="<?php echo $_smarty_tpl->tpl_vars['MARGINS']->value['bottom'];?>
" style="width:<?php echo $_smarty_tpl->tpl_vars['margin_input_width']->value;?>
" onKeyUp="PDFMaker_EditFreeJs.ControlNumber('margin_bottom', false);">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label fieldLabel col-sm-1" style="font-weight: normal">
                                                        <?php echo vtranslate('LBL_LEFT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                    </label>
                                                    <div class="controls col-sm-11">
                                                        <input type="text" name="margin_left"  id="margin_left" class="inputElement" value="<?php echo $_smarty_tpl->tpl_vars['MARGINS']->value['left'];?>
" style="width:<?php echo $_smarty_tpl->tpl_vars['margin_input_width']->value;?>
" onKeyUp="PDFMaker_EditFreeJs.ControlNumber('margin_left', false);">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label fieldLabel col-sm-1" style="font-weight: normal">
                                                        <?php echo vtranslate('LBL_RIGHT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                    </label>
                                                    <div class="controls col-sm-11">
                                                        <input type="text" name="margin_right" id="margin_right" class="inputElement" value="<?php echo $_smarty_tpl->tpl_vars['MARGINS']->value['right'];?>
" style="width:<?php echo $_smarty_tpl->tpl_vars['margin_input_width']->value;?>
" onKeyUp="PDFMaker_EditFreeJs.ControlNumber('margin_right', false);">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                                                                <div class="form-group">
                                            <label class="control-label fieldLabel col-sm-3" style="font-weight: normal">
                                                <?php echo vtranslate('LBL_DECIMALS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                            </label>
                                            <div class="controls col-sm-9">

                                                <div class="form-group">
                                                    <label class="control-label fieldLabel col-sm-4" style="font-weight: normal">
                                                        <?php echo vtranslate('LBL_DEC_POINT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                    </label>
                                                    <div class="controls col-sm-8">
                                                        <input type="text" maxlength="2" name="dec_point" class="inputElement" value="<?php echo $_smarty_tpl->tpl_vars['DECIMALS']->value['point'];?>
" style="width:<?php echo $_smarty_tpl->tpl_vars['margin_input_width']->value;?>
"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label fieldLabel col-sm-4" style="font-weight: normal">
                                                        <?php echo vtranslate('LBL_DEC_DECIMALS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                    </label>
                                                    <div class="controls col-sm-8">
                                                        <input type="text" maxlength="2" name="dec_decimals" class="inputElement" value="<?php echo $_smarty_tpl->tpl_vars['DECIMALS']->value['decimals'];?>
" style="width:<?php echo $_smarty_tpl->tpl_vars['margin_input_width']->value;?>
"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label fieldLabel col-sm-4" style="font-weight: normal">
                                                        <?php echo vtranslate('LBL_DEC_THOUSANDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:
                                                    </label>
                                                    <div class="controls col-sm-8">
                                                        <input type="text" maxlength="2" name="dec_thousands" class="inputElement" value="<?php echo $_smarty_tpl->tpl_vars['DECIMALS']->value['thousands'];?>
" style="width:<?php echo $_smarty_tpl->tpl_vars['margin_input_width']->value;?>
"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                                       <div class="middle-block col-xs-8">
                        <div id="ContentEditorTabs">
                            <ul class="nav nav-pills">
                                <li class="active" data-type="body">
                                    <a href="#body_div2" aria-expanded="false" data-toggle="tab"><?php echo vtranslate('LBL_BODY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                                </li>
                                <li data-type="header">
                                    <a href="#header_div2" aria-expanded="false" data-toggle="tab"><?php echo vtranslate('LBL_HEADER_TAB',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                                </li>
                                <li data-type="footer">
                                    <a href="#footer_div2" aria-expanded="false" data-toggle="tab"><?php echo vtranslate('LBL_FOOTER_TAB',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                                </li>
                            </ul>
                        </div>
                                                <div class="tab-content ">
                            <div class="tab-pane active" id="body_div2">
                                <textarea name="body" id="body" style="width:90%;height:700px" class=small tabindex="5"><?php echo $_smarty_tpl->tpl_vars['BODY']->value;?>
</textarea>
                            </div>
                                                        <div class="tab-pane" id="header_div2">
                                <textarea name="header_body" id="header_body" style="width:90%;height:200px" class="small"><?php echo $_smarty_tpl->tpl_vars['HEADER']->value;?>
</textarea>
                            </div>
                                                        <div class="tab-pane" id="footer_div2">
                                <textarea name="footer_body" id="footer_body" style="width:90%;height:200px" class="small"><?php echo $_smarty_tpl->tpl_vars['FOOTER']->value;?>
</textarea>
                            </div>
                        </div>
                        <?php echo '<script'; ?>
 type="text/javascript">
                             jQuery(document).ready(function(){
                                CKEDITOR.replace('body', {height: '1000'});
                                CKEDITOR.replace('header_body', {height: '1000'});
                                CKEDITOR.replace('footer_body', {height: '1000'});
                            })
                        <?php echo '</script'; ?>
>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal-overlay-footer row-fluid">
            <div class="textAlignCenter ">
                <button class="btn" type="submit" onclick="document.EditView.redirect.value = 'false';" ><strong><?php echo vtranslate('LBL_APPLY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;
                <button class="btn btn-success" type="submit" ><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>
                <?php if ($_REQUEST['return_view'] != '') {?>
                    <a class="cancelLink" type="reset" onclick="window.location.href = 'index.php?module=<?php if ($_REQUEST['return_module'] != '') {
echo $_REQUEST['return_module'];
} else { ?>PDFMaker<?php }?>&view=<?php echo $_REQUEST['return_view'];
if ($_REQUEST['templateid'] != '' && $_REQUEST['return_view'] != "List") {?>&templateid=<?php echo $_REQUEST['templateid'];
}?>';"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                <?php } else { ?>
                    <a class="cancelLink" type="reset" onclick="javascript:window.history.back();"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                <?php }?>            			
            </div>
            <div align="center" class="small" style="color: rgb(153, 153, 153);"><?php echo vtranslate('PDF_MAKER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['VERSION']->value;?>
 <?php echo vtranslate('COPYRIGHT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div>
        </div>
    </form>
</div>
<div id="company_stamp_signature_content" class="hide">
    <?php echo $_smarty_tpl->tpl_vars['COMPANY_STAMP_SIGNATURE']->value;?>

</div>
<div id="companylogo_content" class="hide">
    <?php echo $_smarty_tpl->tpl_vars['COMPANYLOGO']->value;?>

</div>
<div id="company_header_signature_content" class="hide">
    <?php echo $_smarty_tpl->tpl_vars['COMPANY_HEADER_SIGNATURE']->value;?>

</div>
<div id="vatblock_table_content" class="hide">
    <?php echo $_smarty_tpl->tpl_vars['VATBLOCK_TABLE']->value;?>

</div>



<?php echo '<script'; ?>
 type="text/javascript">

    var selectedTab = 'properties';
    var selectedTab2 = 'body';
    var module_blocks = new Array();
 
    var selected_module = '<?php echo $_smarty_tpl->tpl_vars['SELECTMODULE']->value;?>
';

    var constructedOptionValue;
    var constructedOptionName;

    jQuery(document).ready(function() {

        jQuery.fn.scrollBottom = function() {
            return jQuery(document).height() - this.scrollTop() - this.height();
        };

        var $el = jQuery('.edit-template-content');
        var $window = jQuery(window);
        var top = 127;

        $window.bind("scroll resize", function() {

            var gap = $window.height() - $el.height() - 20;
            var scrollTop = $window.scrollTop();

            if (scrollTop < top - 125) {
                $el.css({
                    top: (top - scrollTop) + "px",
                    bottom: "auto"
                });
            } else {
                $el.css({
                    top: top  + "px",
                    bottom: "auto"
                });
            }
        }).scroll();
    });

<?php echo '</script'; ?>
>

<?php }
}
