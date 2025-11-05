<?php
/* Smarty version 4.5.5, created on 2025-11-05 07:48:19
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\VTEStore\Faq.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b01435ba573_68645549',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b5ae463dc77f8c6ba0c72a96b5657888336f7aed' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\VTEStore\\Faq.tpl',
      1 => 1762118939,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b01435ba573_68645549 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="globalmodal">
    <div id="massEditContainer" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header contentsBackground">
                <button aria-hidden="true" class="close " data-dismiss="modal" type="button"><span aria-hidden="true" class='fa fa-close'></span></button>
                <h4><?php echo vtranslate('FAQ','VTEStore');?>
</h4>
            </div>
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
                <div name="massEditContent" style="overflow: hidden; width: auto; height: auto;">
                    <div class="modal-body tabbable">
                        <ul class="nav nav-tabs massEditTabs">
                            <li class="active"><a data-toggle="tab" href="#block_1"><strong><?php echo vtranslate('LBL_INSTALLATION','VTEStore');?>
</strong></a></li>
                            <li><a data-toggle="tab" href="#block_2"><strong><?php echo vtranslate('LBL_EXTENSION_DETAILS','VTEStore');?>
</strong></a></li>
                            <li><a data-toggle="tab" href="#block_3"><strong><?php echo vtranslate('LBL_USABILITY','VTEStore');?>
</strong></a></li>
                            <li><a data-toggle="tab" href="#block_4"><strong><?php echo vtranslate('Subscription_Help','VTEStore');?>
</strong></a></li>
                            <li><a data-toggle="tab" href="#block_5"><strong><?php echo vtranslate('Troubleshooting','VTEStore');?>
</strong></a></li>
                        </ul>
                        <div class="tab-content massEditContent">
                            <div id="block_1" class="tab-pane active" align="center"><img src="https://www.vtexperts.com/guides/guide1.png"></div>
                            <div id="block_2" class="tab-pane row-fluid" align="center"><img src="https://www.vtexperts.com/guides/guide2.png"></div>
                            <div id="block_3" class="tab-pane row-fluid" style="max-height: 500px; overflow-y: scroll;"><?php echo $_smarty_tpl->tpl_vars['USABILITY']->value;?>
</div>
                            <div id="block_4" class="tab-pane row-fluid" style="max-height: 500px; overflow-y: scroll;"><?php echo $_smarty_tpl->tpl_vars['SUBSCRIPTION_HELP']->value;?>
</div>
                            <div id="block_5" class="tab-pane row-fluid" style="max-height: 500px; overflow-y: scroll;"><?php echo $_smarty_tpl->tpl_vars['TROUBLESHOOTING']->value;?>
</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-right cancelLinkContainer" style="margin-top: 0px;"><a class="cancelLink" type="reset" data-dismiss="modal"><strong><?php echo vtranslate('LBL_CLOSE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a></div>
            </div>
        </div>
    </div>
</div>
<?php }
}
