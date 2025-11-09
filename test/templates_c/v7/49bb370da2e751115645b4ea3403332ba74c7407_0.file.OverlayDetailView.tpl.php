<?php
/* Smarty version 4.5.5, created on 2025-11-05 23:02:59
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\Vtiger\OverlayDetailView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690bd7a34e6ce5_31130518',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '49bb370da2e751115645b4ea3403332ba74c7407' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\Vtiger\\OverlayDetailView.tpl',
      1 => 1762352656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690bd7a34e6ce5_31130518 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SCRIPTS']->value, 'jsModel', false, 'index');
$_smarty_tpl->tpl_vars['jsModel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['jsModel']->value) {
$_smarty_tpl->tpl_vars['jsModel']->do_else = false;
?>
    <?php echo '<script'; ?>
 type="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getType();?>
" src="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getSrc();?>
"><?php echo '</script'; ?>
>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<input type="hidden" id="recordId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
"/>
<?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value != null) {?>
    <?php echo '<script'; ?>
 type="text/javascript">
        var related_uimeta = (function() {
            var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;
            return {
                field: {
                    get: function(name, property) {
                        if (name && property === undefined) {
                            return fieldInfo[name];
                        }
                        if (name && property) {
                            return fieldInfo[name][property]
                        }
                    },
                    isMandatory: function(name) {
                        if (fieldInfo[name]) {
                            return fieldInfo[name].mandatory;
                        }
                        return false;
                    },
                    getType: function(name) {
                        if (fieldInfo[name]) {
                            return fieldInfo[name].type
                        }
                        return false;
                    }
                },
            };
        })();
    <?php echo '</script'; ?>
>
<?php }?>

<div class='fc-overlay-modal overlayDetail'>
    <div class = "modal-content">
        <div class="overlayDetailHeader col-lg-12 col-md-12 col-sm-12" style="z-index:1;">
            <div class="col-lg-10 col-md-10 col-sm-10" style = "padding-left:0px;">
                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "DetailViewHeaderTitle.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('MODULE_MODEL'=>$_smarty_tpl->tpl_vars['MODULE_MODEL']->value,'RECORD'=>$_smarty_tpl->tpl_vars['RECORD']->value), 0, true);
?>
            </div>
            <div class = "col-lg-2 col-md-2 col-sm-2">
                <div class="clearfix">
                    <div class = "btn-group">
                        <button class="btn btn-default fullDetailsButton" onclick="window.location.href = '<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getFullDetailViewUrl();?>
&app=<?php echo (isset($_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value)) ? $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value : '';?>
'"><?php echo vtranslate('LBL_DETAILS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button>
                        <?php if ((isset($_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value))) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEWBASIC'], 'DETAIL_VIEW_BASIC_LINK');
$_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value) {
$_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->do_else = false;
?>
                                <?php if ($_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value && $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value->getLabel() == 'LBL_EDIT') {?>
                                    <button class="btn btn-default editRelatedRecord" value = "<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getEditViewUrl();?>
"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button>
                                <?php }?>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>  
                        <?php }?>	
                    </div> 
                    <div class="pull-right " >
                        <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                            <span aria-hidden="true" class='fa fa-close'></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal-body'>
            <div class = "detailViewContainer">      
                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'DetailViewFullContents.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value), 0, true);
?>
            </div>
        </div>
    </div>
</div><?php }
}
