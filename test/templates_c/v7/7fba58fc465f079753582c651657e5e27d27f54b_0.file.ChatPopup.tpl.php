<?php
/* Smarty version 4.5.5, created on 2025-11-05 10:32:36
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\CTChatLog\ChatPopup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b27c42ae594_69892400',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7fba58fc465f079753582c651657e5e27d27f54b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\CTChatLog\\ChatPopup.tpl',
      1 => 1761724803,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b27c42ae594_69892400 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="layouts/v7/modules/CTChatLog/assets/css/reset.css">
    <link rel="stylesheet" href="layouts/v7/modules/CTChatLog/assets/css/style.css">
    <?php echo '<script'; ?>
 src="layouts/v7/modules/CTChatLog/assets/js/jquery.emojiarea.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="layouts/v7/modules/CTChatLog/css/IndividualPopup.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
    <?php echo '<script'; ?>
>
        function DropDown(el) {
            this.dd = el;
            this.placeholder = this.dd.children('span');
            this.opts = this.dd.find('ul.dropdown > li');
            this.val = '';
            this.index = -1;
            this.initEvents();
        }
        DropDown.prototype = {
            initEvents : function() {
                var obj = this;
                obj.dd.on('click', function(event){
                    $(this).toggleClass('active');
                    return false;
                });
                obj.opts.on('click',function(){
                    var opt = $(this);
                    obj.val = opt.text();
                    obj.index = opt.index();
                    $('#facebookPageId').val($(this).attr("data-facebookpageid"));
                    obj.placeholder.text(obj.val);
                });
            },
            getValue : function() {
                return this.val;
            },
            getIndex : function() {
                return this.index;
            },
            setValueByFacebookPageId: function(pageId) {
                // Find the option with the specified data-facebookpageid attribute
                var option = this.opts.filter(function() {
                    return $(this).data('facebookpageid') == pageId;
                });
                
                // If the option is found, set the value and update the placeholder
                if (option.length > 0) {
                    this.val = option.text();
                    this.index = option.index();
                    $('#facebookPageId').val(pageId);
                    this.placeholder.text(this.val);
                }
            }
        }
        $(function() {
            //var dd = new DropDown( $('#dd') );
            $(document).click(function() {
                // all dropdowns
                $('.wrapper-dropdown').removeClass('active');
            });
        });
         $( document ).ready(function() {
            setTimeout(function(){
                var facebookPageId = $('#facebookPageId').val();
                var facebookPageName = $('#facebookPageName').val(); 
                $("#dd span").text(facebookPageName);
            }, 1000);
            $('.mainhamburger').click(function() {
                $('.mainhamburger').toggleClass('show');
                $('#overlay').toggleClass('show');
                $('.popup-contact').toggleClass('show');
            });
        });  
    <?php echo '</script'; ?>
>

<div class="modelContainer modal-dialog"><head><?php echo '<script'; ?>
>
            $(function() {
                $("#mymin").click(function(){
                    $(".conversation").slideToggle();
                    $(".myModal").toggleClass("facebook-bottom");
                    $("#minmax").toggleClass("fa-window-maximize");
                });
            });
        <?php echo '</script'; ?>
></head><body><div class="chat"><input type="hidden" name='facebookPopupOpen' id='facebookPopupOpen' value="true"><input type="hidden" name="module_name" id="module_name" value="<?php echo $_smarty_tpl->tpl_vars['SOURCEMODULE']->value;?>
"><input type="hidden" name='currentusername' id='currentusername' value="<?php echo $_smarty_tpl->tpl_vars['CURRENUSERNAME']->value;?>
"><input type="hidden" name='currentusername' id='currentdatetime' value="<?php echo $_smarty_tpl->tpl_vars['CURRENTDATETIME']->value;?>
"><input type="hidden" name="facebookPageId" id="facebookPageId" value="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_ID']->value;?>
"><input type="hidden" name="facebookPageName" id="facebookPageName" value="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->value;?>
"><input type="hidden" name="facebookstorageurl" id="facebookstorageurl" value="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_STORAGE_URL']->value;?>
"><div class="facebookb chat-container"><input type="hidden" name="sender_id" id="sender_id" value="<?php echo $_smarty_tpl->tpl_vars['SENDER_ID']->value;?>
"><input type="hidden" name="module_recordid" id="module_recordid" value="<?php echo $_smarty_tpl->tpl_vars['RECORDID']->value;?>
"><input type="hidden" name="sender_name" id="sender_name" value="<?php echo $_smarty_tpl->tpl_vars['SENDER_NAME']->value;?>
"><div id="call" class="user-bar"><div class="popupProfile"><span style="color:white;"><b><?php echo $_smarty_tpl->tpl_vars['PROFILEIMAGE']->value;?>
</b></span></div><div class="name" title="<?php echo $_smarty_tpl->tpl_vars['FULLNAME']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['RECORDID']->value != '') {?><span id="name" style="text-decoration: underline;font-style: oblique;width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;display: inline-block;position: relative;top: 2px;"><a href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['SOURCEMODULE']->value;?>
&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['RECORDID']->value;?>
" target="_blank" style="color: #fff;" draggable="false"><?php echo $_smarty_tpl->tpl_vars['FULLNAME']->value;?>
</a></span><?php } else { ?><div style="margin-top: 20px;"><?php echo $_smarty_tpl->tpl_vars['FULLNAME']->value;?>
</div><?php }?></div><!--//Add Comment--><?php if ($_smarty_tpl->tpl_vars['COMMETNMODULE']->value == 1) {?><div id="commentsdatefb" style="margin-left: 213px;"><i class="fa fa-comments" aria-hidden="true"></i></div><?php }?><!--//Add Comment--><div class="pull-right"><button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true" class="fa fa-close" ></span></button><button type="button" class="close hide" id="mymin"><span aria-hidden="true" class="fa fa-minus" id="minmax"></span></button></div></div><div class="conversation"><div class="conversation-container"><span id="ap"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FACEBOOKMESSAGES']->value, 'FACEBOOKMESSAGESVALUE', false, 'FACEBOOKMESSAGESKEY');
$_smarty_tpl->tpl_vars['FACEBOOKMESSAGESVALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FACEBOOKMESSAGESKEY']->value => $_smarty_tpl->tpl_vars['FACEBOOKMESSAGESVALUE']->value) {
$_smarty_tpl->tpl_vars['FACEBOOKMESSAGESVALUE']->do_else = false;
if ($_smarty_tpl->tpl_vars['FACEBOOKMESSAGESVALUE']->value['type'] == 'Received') {?><div class="message received"><span class="messageBody"><?php if ($_smarty_tpl->tpl_vars['FACEBOOKMESSAGESVALUE']->value['fbQuotedMessageBody'] != '') {?><div class="sendQuoteMessage"><p style="word-wrap: break-word;"><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['FACEBOOKMESSAGESVALUE']->value['fbQuotedMessageBody'],"\n","<br>");?>
</p></div><?php }?><p style="text-transform:none;"><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['FACEBOOKMESSAGESVALUE']->value['messageBody'],"\n","<br>");?>
<br></p></span><span class="metadata"><span class="time"><b><?php echo $_smarty_tpl->tpl_vars['FULLNAME']->value;?>
 -</b>&nbsp; <?php echo $_smarty_tpl->tpl_vars['FACEBOOKMESSAGESVALUE']->value['createdTime'];?>
</span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['FACEBOOKMESSAGESVALUE']->value['messageReadUnRead'] == 'Unread') {?><img src="layouts/v7/modules/CTChatLog/image/unread.png"/><?php } else { ?><img src="layouts/v7/modules/CTChatLog/image/read.png"/><?php }?></span>&nbsp;</div><?php if ($_smarty_tpl->tpl_vars['RECORDID']->value) {?>&nbsp;&nbsp;<span class="editModuleField"><img src="layouts/v7/modules/CTChatLog/image/editcontent.png" title="<?php echo vtranslate('LBL_EDITFIELD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php ob_start();
echo $_smarty_tpl->tpl_vars['SOURCEMODULE']->value;
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['SOURCEMODULE']->value;
$_prefixVariable2 = ob_get_clean();
echo vtranslate($_prefixVariable1,$_prefixVariable2);?>
"></span><?php }
} else { ?><div class="message sent"><span class="messageBody"><p style="text-transform:none;color:#FFF !important;"><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['FACEBOOKMESSAGESVALUE']->value['messageBody'],"\n","<br>");?>
<br></p></span><span class="metadata"><span class="time"><b><?php echo $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->value;?>
 -</b>&nbsp; <?php echo $_smarty_tpl->tpl_vars['FACEBOOKMESSAGESVALUE']->value['createdTime'];?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FACEBOOKMESSAGESVALUE']->value['messageReadUnRead'] == 'Unread') {?><img src="layouts/v7/modules/CTChatLog/image/unread.png"/><?php } else { ?><img src="layouts/v7/modules/CTChatLog/image/read.png"/><?php }?></span></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></span></div><div><div><div class="ipt-div text-wrapper"><div class="ipt-msg-div searchForm conversation-compose text-wrapper" data-emojiarea data-type="unicode" data-global-picker="false"><textarea placeholder="<?php echo vtranslate('TYPE_MESSAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" id="writemsg" class="input-msg writemsg sendMsgPopup" name="writemsg"></textarea><div class="emoji emoji-button"><i class="fa fa-grin">&#x1f604;</i></div></div><div class="icons-wrapper"><div class="ipt-ioc-div"><div class="image-upload"><label for="filename"><input type="hidden" name="selectfile_data" id="selectfile_data" value=""><i class="fa fa-paperclip fa-2x" aria-hidden="true" style="cursor: pointer;" title="<?php echo vtranslate('LBL_ATTACH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i><input type="file" name="filename" id="filename" class="imageclick" style="display: none;"></label></div></div><div class="ipt-div-num  facebookb"><?php if ($_smarty_tpl->tpl_vars['FACEBOOK_PAGES_LIST']->value != '') {?><div id="dd" class="wrapper-dropdown" tabindex="1" style="pointer-events:none;"><span></span><ul class="dropdown"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FACEBOOK_PAGES_LIST']->value, 'FACEBOOK_PAGE_NAME', false, 'FACEBOOK_PAGE_ID');
$_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_ID']->value => $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->value) {
$_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->do_else = false;
?><li class="selectFacebookPageNumber" data-facebookpageid="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_ID']->value;?>
" data-facebookpagename="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->value;?>
"><a href="#"><div class="logo"><img src="layouts/v7/modules/CTChatLog/image/facebook.png" width="20px"></div><?php echo $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->value;?>
</a></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></div><?php }?><span id="sendfacebookmsg" class="send facebookb msg_send_btnb" style="cursor: pointer;" draggable="false"><img src="layouts/v7/modules/CTChatLog/image/send.png" alt="send-icon" draggable="false" /></span></div></div></div></div></div></div></div></div></body></div><?php }
}
