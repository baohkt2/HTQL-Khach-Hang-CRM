<?php
/* Smarty version 4.5.5, created on 2025-11-09 19:02:48
  from 'C:\xampp\htdocs\cusc\layouts\v7\modules\Vtiger\uitypes\File.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6910e5583a20f8_34587350',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7bade2fb3693a80d396a9f9cc91d0d52e9f973d9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cusc\\layouts\\v7\\modules\\Vtiger\\uitypes\\File.tpl',
      1 => 1762713640,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6910e5583a20f8_34587350 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());
$_smarty_tpl->_assignInScope('FIELD_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));
$_smarty_tpl->_assignInScope('SPECIAL_VALIDATOR', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator());?><div class="fileUploadContainer text-left"><div class="fileUploadBtn btn btn-sm btn-primary"><span><i class="fa fa-laptop"></i> <?php echo vtranslate('LBL_ATTACH_FILES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><input type="file" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" class="inputElement <?php if ($_smarty_tpl->tpl_vars['MODULE']->value == 'ModComments') {?> multi <?php }?> " maxlength="6" name="<?php if ($_smarty_tpl->tpl_vars['MODULE']->value == 'ModComments') {
echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
[]<?php } else {
echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();
}?>"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
" <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)) {?>data-validator='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
'<?php }
if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"] == true) {?> data-rule-required="true" <?php }
if (php7_count($_smarty_tpl->tpl_vars['FIELD_INFO']->value['validator'])) {?>data-specific-rules='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"]);?>
'<?php }?>/></div>&nbsp;&nbsp;<span class="uploadFileSizeLimit fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo vtranslate('LBL_MAX_UPLOAD_SIZE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['MAX_UPLOAD_LIMIT_MB']->value;?>
 <?php echo vtranslate('MB',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><span class="maxUploadSize" data-value="<?php echo $_smarty_tpl->tpl_vars['MAX_UPLOAD_LIMIT_BYTES']->value;?>
"></span></span><div class="uploadedFileDetails <?php if ($_smarty_tpl->tpl_vars['IS_EXTERNAL_LOCATION_TYPE']->value) {?>hide<?php }?>"><div class="uploadedFileSize"></div><div class="uploadedFileName"><?php if (!empty($_smarty_tpl->tpl_vars['FIELD_VALUE']->value) && !$_REQUEST['isDuplicate']) {?>[<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_VALUE']->value);?>
]<?php }?></div></div></div>
			<?php echo '<script'; ?>
>
				jQuery(document).ready(function() {
					var fileElements = jQuery('input[type="file"]',jQuery(this).data('fieldinfo') == 'file');
					fileElements.on('change',function(e) {
						var element = jQuery(this);
						var fileSize = e.target.files[0].size;
						var maxFileSize = element.closest('form').find('.maxUploadSize').data('value');
						if(fileSize > maxFileSize) {
							alert(app.vtranslate('JS_EXCEEDS_MAX_UPLOAD_SIZE'));
							element.val(null);
						}
					});
				});
			<?php echo '</script'; ?>
>
		
<?php }
}
