<?php
/* Smarty version 4.5.5, created on 2025-11-05 18:18:10
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\PDFMaker\Install.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b94e2dad580_10073234',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f6b10d9c632b33b02278aea4731a20a46b3200b7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\PDFMaker\\Install.tpl',
      1 => 1762366664,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b94e2dad580_10073234 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="detailViewContainer viewContent clearfix" >
    <div class="col-sm-12 col-xs-12">
        <h3><?php echo vtranslate('LBL_MODULE_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_INSTALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h3>
        <div class="editContainer">
            <br>
            <div id="breadcrumb">
                <ul class="crumbs marginLeftZero">
                    <li class="first step <?php if ($_smarty_tpl->tpl_vars['STEP']->value == "1") {?>active<?php }?>" style="z-index:10;" id="steplabel1"><a>
                            <span class="stepNum">1
                            </span>
                            <span class="stepText"><?php echo vtranslate('LBL_INSTALL_STEP_1',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                            </span></a>
                    </li>        <?php if ($_smarty_tpl->tpl_vars['TOTAL_STEPS']->value == "3") {?>
                        <li class="step <?php if ($_smarty_tpl->tpl_vars['STEP']->value == "2") {?>active<?php }?>" style="z-index:9;"  id="steplabel2"><a>
                            <span class="stepNum">2
                            </span>
                                <span class="stepText"><?php echo vtranslate('LBL_DOWNLOAD',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                            </span></a>
                        </li>        <?php }?>
                    <li class="step last <?php if ($_smarty_tpl->tpl_vars['CURRENT_STEP']->value == $_smarty_tpl->tpl_vars['TOTAL_STEPS']->value) {?>active<?php }?>" style="z-index:7;"  id="steplabel<?php echo $_smarty_tpl->tpl_vars['TOTAL_STEPS']->value;?>
"><a>
                            <span class="stepNum"><?php echo $_smarty_tpl->tpl_vars['TOTAL_STEPS']->value;?>

                            </span>
                            <span class="stepText"><?php echo vtranslate('LBL_FINISH',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                            </span></a>
                    </li>
                </ul>
            </div>
            <div class="clearfix">
            </div>
            <form name="install" id="editLicense"  method="POST" action="index.php" class="form-horizontal">
                <input type="hidden" name="module" value="PDFMaker"/>
                <input type="hidden" name="view" value="List"/>
                <div id="step1" class="marginTop15px padding15px" style="border:1px solid #ccc; <?php if ($_smarty_tpl->tpl_vars['STEP']->value != "1") {?>display:none;<?php }?>" >
                    <input type="hidden" name="installtype" value="validate"/>
                    <div class="controls">
                        <div>            <strong><?php echo vtranslate('LBL_WELCOME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>
                        </div>
                        <br>
                        <div class="clearfix">
                        </div>
                    </div>
                    <div class="controls">
                        <div>           <?php echo vtranslate('LBL_WELCOME_DESC',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                            </br>            <?php echo vtranslate('LBL_WELCOME_FINISH',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                        </div>
                        <br>
                        <div class="clearfix">
                        </div>
                    </div>
                    <br>
                    <div class="controls">
                        <button type="button" id="start_button" class="btn btn-success"><strong><?php echo vtranslate('LBL_NEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>
                        </button>&nbsp;&nbsp;
                    </div>
                </div>     <?php if ($_smarty_tpl->tpl_vars['TOTAL_STEPS']->value == "3") {?>
                <div id="step2" class="marginTop15px padding15px" style="border:1px solid #ccc;  <?php if ($_smarty_tpl->tpl_vars['STEP']->value != "2") {?>display:none;<?php }?>">
                    <input type="hidden" name="installtype" value="download_src"/>
                    <div class="controls">
                        <div>            <strong><?php echo vtranslate('LBL_DOWNLOAD_SRC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>
                        </div>
                        <br>
                        <div class="clearfix">
                        </div>
                    </div>
                    <div class="controls">
                        <div>            <?php echo vtranslate('LBL_DOWNLOAD_SRC_DESC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
             <?php if ($_smarty_tpl->tpl_vars['MB_STRING_EXISTS']->value == 'false') {?>
                                <br><?php echo vtranslate('LBL_MB_STRING_ERROR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
             <?php }?>
                        </div>
                        <br>
                        <div class="clearfix">
                        </div>
                    </div>
                    <div class="controls">
                        <button type="button" id="download_button" class="btn btn-success"><strong><?php echo vtranslate('LBL_DOWNLOAD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>
                        </button>&nbsp;&nbsp;
                    </div>
                    </div><?php }?>
                <div id="step<?php echo $_smarty_tpl->tpl_vars['TOTAL_STEPS']->value;?>
" class="marginTop15px padding15px" style="border:1px solid #ccc; <?php if ($_smarty_tpl->tpl_vars['STEP']->value != "3") {?>display:none;<?php }?>" >
                    <input type="hidden" name="installtype" value="redirect_recalculate" />
                    <div class="controls">
                        <div><?php echo vtranslate('LBL_INSTALL_SUCCESS',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                    <br>
                    <div class="controls">
                        <button type="submit" id="next_button" class="btn btn-success"><strong><?php echo vtranslate('LBL_FINISH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>
                        </button>&nbsp;&nbsp;
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><?php }
}
