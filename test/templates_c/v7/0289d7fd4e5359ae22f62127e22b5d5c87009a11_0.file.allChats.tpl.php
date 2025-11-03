<?php
/* Smarty version 4.5.5, created on 2025-10-31 05:21:50
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\CTChatLog\allChats.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6904476ead6c62_43202270',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0289d7fd4e5359ae22f62127e22b5d5c87009a11' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\CTChatLog\\allChats.tpl',
      1 => 1761807767,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6904476ead6c62_43202270 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- POPPER JS -->
	<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"><?php echo '</script'; ?>
>
	
	<!-- BOOTSTRAP -->
    <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"><?php echo '</script'; ?>
>
	
   	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- CUSTOM CSS -->
	<link rel="stylesheet"  type="text/css" href="layouts/v7/modules/CTChatLog/css/media.css">
	<link rel="stylesheet"  type="text/css" href="layouts/v7/modules/CTChatLog/css/allChats.css">

	<!-- FOR EMOJIS-->
	<link rel="stylesheet" href="layouts/v7/modules/CTChatLog/assets/css/reset.css">
    <link rel="stylesheet" href="layouts/v7/modules/CTChatLog/assets/css/style.css">
    <?php echo '<script'; ?>
 src="layouts/v7/modules/CTChatLog/assets/js/jquery.emojiarea.js"><?php echo '</script'; ?>
>
	
	<!-- GOOGLE FONTS-->
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<!-- VERTICAL TABS -->
	<?php echo '<script'; ?>
>
		function openTab(evt, tabName) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
			}
			document.getElementById(tabName).style.display = "inline-block";
			evt.currentTarget.className += " active";
		}//end of function

		$( document ).ready(function() {
			$('.tabcontent').css('display','none'); 
			$('#defaultTab').css('display','');
			$('#hamburger').click(function() {
				$('#hamburger').toggleClass('show');
				$('#overlay').toggleClass('show');
				$('.popup-contact').toggleClass('show');
			});
		});//end of function

		function DropDown(el) {
			this.dd = el;
			this.placeholder = this.dd.children('span');
			this.opts = this.dd.find('ul.dropdown > li');
			this.val = '';
			this.index = -1;
			this.initEvents();
		}//end of function

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
		}//end of function

		$(function() {
			$(document).click(function() {
				// all dropdowns
				$('.wrapper-dropdown').removeClass('active');
			});//end of function
		});//end of function
	<?php echo '</script'; ?>
>
</head>
<body>
	<!-- WA LISTING SECTION -->
	<div id="fbListing">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php if ($_smarty_tpl->tpl_vars['ACCESS_TOKEN_ROWS']->value == '0') {?>
						<p class="disconnectMessage"><?php echo vtranslate('LBL_FACEBOOK_DISCONNECTED_MESSAGE',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 <?php if ($_smarty_tpl->tpl_vars['ISADMIN']->value == 'on') {?><a href="index.php?module=CTFacebookMessengerIntegration&parent=Settings&view=CTFacebookMessengerIntegrationList" class="connectHereLink"><?php echo vtranslate('LBL_CLICK_HERE',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</a> <?php echo vtranslate('LBL_CONNECT_MESSENGER',$_smarty_tpl->tpl_vars['MODULENAME']->value);
}?></p>
					<?php }?>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="dropdown">
						<div id="quickAccessDiv" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							<a href="#" draggable="false"><p><?php echo vtranslate('LBL_QUICK_ACCESS',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 <img src="layouts/v7/modules/CTChatLog/image/listing_green.png" draggable="false" style="width: 20px;"></p></a>
						</div>
						<ul class="dropdown-menu facebookMenus facebookb" role="menu" aria-labelledby="dropdownMenu1" style="width:340px;">
							<li>
								<a href="index.php?module=Workflows&parent=Settings&view=List">
									<p><img src="layouts/v7/modules/CTChatLog/image/fbWorkflow.png" title="<?php echo vtranslate('LBL_AUTOMATEWORKFLOW',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
"/>
									<?php echo vtranslate('LBL_AUTOMATEWORKFLOW',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</p>
								</a>
							</li>
							<li>
								<a href="index.php?module=CTChatLogDetails&view=List&app=TOOLS">
									<p><img src="layouts/v7/modules/CTChatLog/image/wa_messages.png" title="<?php echo vtranslate('LBL_FACEBOOK_MESSAGES_LOG',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
"> <?php echo vtranslate('LBL_FACEBOOK_MESSAGES_LOG',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>

									</p>
								</a>
							</li>
							<li>
								<a href="index.php?parent=Settings&module=CTFacebookMessengerIntegration&view=CTGeneralConfiguration">
									<p><img src="layouts/v7/modules/CTChatLog/image/wa_setup.png" title="<?php echo vtranslate('LBL_SETUP_FB_CONFIGURATION',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 "> <?php echo vtranslate('LBL_SETUP_FB_CONFIGURATION',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>

									</p>
								</a>
							</li>
							<li>
								<a href="index.php?module=CTChatLog&view=DashBoard&mode=moduleDashBoard&analytics=1">
									<p><img src="layouts/v7/modules/CTChatLog/image/dashboardBlue.png" title="<?php echo vtranslate('LBL_FB_ANALYTICS',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
"/> <?php echo vtranslate('LBL_FB_ANALYTICS',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</p>
								</a>
							</li>
							<li>
								<a id="logoutFacebookQuickAccess">
									<p><img src="layouts/v7/modules/CTChatLog/image/logout.png" title="<?php echo vtranslate('LBL_FACEBOOK_LOGOUT',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
"> <?php echo vtranslate('LBL_FACEBOOK_LOGOUT',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>

									</p>
								</a>
							</li>

							<li>
								<a href="https://kb.crmtiger.com/article-categories/facebook-messenger-integration-for-vtiger/" target="_blank">
									<p><img src="layouts/v7/modules/CTChatLog/image/fbHelp.png" title="<?php echo vtranslate('LBL_FACEBOOK_HELP',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
"> <?php echo vtranslate('LBL_FACEBOOK_HELP',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 
									</p>
								</a>
							</li>
						</ul>
					</div>			
				</div>
				<!-- TABS -->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="fbTabs" >
						<ul class="nav nav-tabs activetab" id="myTab">
							<li class="nav-item facebookModules allMessagesModule" data-selectModule="AllMessages">
						 		<input type="hidden" name="AllMessagesTotalRecord" id="AllMessagesTotalRecord" value="">
								<a data-toggle="tab" class="nav-link active"><?php echo vtranslate('LBL_ALLMESSAGES',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</a>
							</li>

							<li class="nav-item facebookModules importantModule" data-selectModule="Important">
						 		<input type="hidden" name="ImportantTotalRecord" id="ImportantTotalRecord" value="<?php echo $_smarty_tpl->tpl_vars['IMPORTANTMESSAGECOUNTS']->value;?>
">
								<a data-toggle="tab" class="nav-link"><?php echo vtranslate('LBL_IMPORTANT',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>

									<?php if ($_smarty_tpl->tpl_vars['IMPORTANTMESSAGECOUNTS']->value != 0) {?> 
										<span class="counterMsg importantCount"><?php echo $_smarty_tpl->tpl_vars['IMPORTANTMESSAGECOUNTS']->value;?>
</span>
									<?php }?>
								</a>
							</li>
							<input type="hidden" id="facebookModule" value="Important">

							<li class="nav-item facebookModules" data-selectModule="NewMessages">
								<input type="hidden" name="NewMessagesTotalRecord" id="NewMessagesTotalRecord" value="<?php echo $_smarty_tpl->tpl_vars['NEWMESSAGESCOUNTS']->value;?>
">
								<a data-toggle="tab" class="nav-link"><?php echo vtranslate('LBL_NEWMESSAGES',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>

									<?php if ($_smarty_tpl->tpl_vars['NEWMESSAGECOUNTS']->value != 0) {?> 
										<span class="counterMsg new_messages"><?php echo $_smarty_tpl->tpl_vars['NEWMESSAGECOUNTS']->value;?>
</span>
									<?php } else { ?>
										<span class=" new_messages"></span>
									<?php }?>
								</a>
							</li> 

							<?php if ($_smarty_tpl->tpl_vars['ISADMIN']->value == 'on') {?>
								<li class="nav-item facebookModules unknownMessage" data-selectModule="Unknown">
									<input type="hidden" name="UnknownTotalRecord" id="UnknownTotalRecord" value="<?php echo $_smarty_tpl->tpl_vars['ALLUNKNOWNMESSAGECOUNTS']->value;?>
">
									<a data-toggle="tab" class="nav-link"><?php echo vtranslate('LBL_UNKNOWN',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>

										<?php if ($_smarty_tpl->tpl_vars['UNKNOWNMESSAGECOUNTS']->value != 0) {?> 
											<span class="counterMsg"><?php echo $_smarty_tpl->tpl_vars['UNKNOWNMESSAGECOUNTS']->value;?>
</span>
										<?php }?>
									</a>
								</li>
							<?php }?>

							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES']->value, 'FACEBOOK_ALLOW_MODULES_VALUE', false, 'FACEBOOK_ALLOW_MODULES_KEY');
$_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_KEY']->value => $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value) {
$_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->do_else = false;
?>
								<?php if ($_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_KEY']->value == 0 || $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_KEY']->value == 1) {?>
									<li class="nav-item facebookModules" data-selectModule="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value['module'];?>
">
										<input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value['module'];?>
TotalRecord" id="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value['module'];?>
TotalRecord" value="<?php echo $_smarty_tpl->tpl_vars['WHATSAPPMODULES_VALUE']->value['rows'];?>
">
										<a data-toggle="tab" class="nav-link"><?php echo vtranslate($_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value['module'],$_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value['module']);?>

										<span class="counterMsg hide"><?php echo $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value['rows'];?>
</span></a>
									</li>
								<?php }?>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

							<li class="nav-item hide facebookModules othermodule" data-selectModule="">
								<a data-toggle="tab" class="nav-link othermoduleopen"></a>
							</li>

							<?php if ($_smarty_tpl->tpl_vars['TOTALALLOWMODULE']->value > 2) {?>
							    <li class="nav-item dropdown">
								    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
								    <div class="dropdown-menu">
								    	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES']->value, 'FACEBOOK_ALLOW_MODULES_VALUE', false, 'FACEBOOK_ALLOW_MODULES_KEY');
$_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_KEY']->value => $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value) {
$_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->do_else = false;
?>
											<?php if ($_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_KEY']->value != 0 && $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_KEY']->value != 1) {?>
												<a class="dropdown-item dropdawnModule" data-modulename="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value['module'];?>
" data-translatemodulename="<?php echo vtranslate($_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value['module'],$_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value['module']);?>
"  data-count="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value['rows'];?>
" href="#"><?php echo vtranslate($_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value['module'],$_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value['module']);?>
</a>
											<?php }?>
										<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								    </div>
								</li>
							<?php }?>
						</ul>	
					</div>
				</div>
				
				<!-- TAB CONTENT -->
				<div class="tab-content fbTabContent hide">
					<!-- TAB 1 -->		
					<div id="ImportantMsg" class1="tab-pane fade in">
					</div>
					<!-- TAB 2 -->				
					<div id="NewMessagesMsg">
					</div>	

					<!-- TAB 3 -->				
					<div id="UnknownMsg">
					</div>

					<!-- TAB 4 -->	
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES']->value, 'FACEBOOK_ALLOW_MODULES_VALUE', false, 'FACEBOOK_ALLOW_MODULES_KEY');
$_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_KEY']->value => $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value) {
$_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->do_else = false;
?>
						<div id="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_ALLOW_MODULES_VALUE']->value['module'];?>
Msg" class="tabcontent1 hide">
						</div>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</div>

				<!-- TAB CONTENT -->
				<div class="tab-content fbTabContent">
					<!-- TAB 1 -->				
					<div id="impMsg" class1="tab-pane fade in active">
						<div class="defaultText">
							
							<!-- LISTING -->
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 padNone">										
								<div class="searchForm">
									<input type="text" placeholder="<?php echo vtranslate('LBL_SEARCH',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
" name="search" class="searchBox">
									<input type="hidden" id="facebookContactSearch" value="">
									<a href="#"><i class="fa fa-search"></i></a>
								</div>
								<div class="smallListing">
								</div>

								<input type="hidden" name="start" id="start" value="0">
								<input type="hidden" name="perpagerecord" id="perpagerecord" value="10">

								<div class="loadBtn">
									<button type="button" id="listViewNextPageButton" class="btn listViewNextPageButton greenBtn">
										<?php echo vtranslate('LBL_LOADMORE',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>

									</button>
								</div>
							</div>

							<!-- CONVERSATION -->
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 padNone hide messageBlock">
								<div class="conversationDiv yesRecordData">
									
									<div class="convHead">
										<div class="waProfile">
											<input type="hidden" name="sender_id" id="sender_id" value="">
											<input type="hidden" name="sender_name" id="sender_name" value="">
											<input type="hidden" name="module_recordid" id="module_recordid" value="">
											<input type="hidden" name="facebookPageId" id="facebookPageId" value="">
											<div class="pic recordData1 imagename"></div>
											<div class="pName">
												<span class="recordData2"></span><br>
												<span class="sender_name"></span>
											</div>
										</div>

										<ul class="nav" id="addProfile" draggable="false">
											<li class="closeBtn" title="<?php echo vtranslate('LBL_PREVIEW',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
">
											</li>
											<li class="recordAssign" draggable="false">
												<img src="layouts/v7/modules/CTChatLog/image/assignto.png" title="<?php echo vtranslate('Assigned To',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
" draggable="false"/>
											</li>
											<li class="editModuleRecord" draggable="false">
												<img class="editIcon" src="layouts/v7/modules/CTChatLog/image/edit.png" title="<?php echo vtranslate('LBL_EDIT_RECORD',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
" draggable="false"/>
											</li>
											<li class="importantMessages hide"><input type="hidden" name="messagesImportant" id="messagesImportant" value=""><img src="layouts/v7/modules/CTChatLog/image/favorites.png" title="<?php echo vtranslate('LBL_IMPORTTANTMESSAGE',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
" draggable="false" /></li>
										 	<li class="nav-item dropdown">
										 		<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" draggable="false">
										 			<img src="layouts/v7/modules/CTChatLog/image/plus.png" class="plusIcon" title="<?php echo vtranslate('LBL_STORESENDER',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
" draggable="false">
										 		</a>
											    <div class="dropdown-menu relatedModules">
											    </div>
											</li>
										</ul>
									</div>

									<div class="convChat recordData3">
									</div>
									<!-- TEXTBOX -->
									<div class="adminSendMessage hide">
										<center><?php echo vtranslate('LBL_ADMIN_CAN_SEND_MESSAGES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</center>
									</div>
									<div>
										<div>
											<div class="ipt-div text-wrapper">
												<div class="ipt-msg-div searchForm conversation-compose ipt-div text-wrapper facebookb" data-emojiarea data-type="unicode" data-global-picker="false">
													<textarea placeholder="<?php echo vtranslate('TYPE_MESSAGE',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
" class="chatText writemsg" name="writemsg" id="writemsg"></textarea>
													<div class="emoji emoji-button">
					                                    <i class="fa fa-grin">&#x1f604;</i>
				                              		</div>
												</div>
											</div>
											<div class="icons-wrapper">
												<div class="ipt-ioc-div">
													<div class="image-upload">
			                                            <label for="filename">
		                                                    <input type="hidden" name="selectfile_data" id="selectfile_data" value="">
		                                                    <i class="fa fa-paperclip fa-2x" aria-hidden="true" style="cursor: pointer;" title="<?php echo vtranslate('LBL_ATTACH',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
"></i>
		                                                    <input type="file" name="filename" id="filename" class="imageclick">
		                                                </label>
		                                            </div>
												</div>
												<div class="ipt-div-num facebookb">
													<?php if ($_smarty_tpl->tpl_vars['FACEBOOK_PAGES_LIST']->value != '') {?>
														<div id="dd" class="wrapper-dropdown" tabindex="1" style="pointer-events:none;">
															<span></span>
															<ul class="dropdown">
																<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FACEBOOK_PAGES_LIST']->value, 'FACEBOOK_PAGE_NAME', false, 'FACEBOOK_PAGE_ID');
$_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_ID']->value => $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->value) {
$_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->do_else = false;
?>
																	<li class="selectFacebookPageNumber" data-facebookpageid="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_ID']->value;?>
" data-facebookpagename="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->value;?>
">
																		<a href="#">
																			<div class="logo">
																				<img src="layouts/v7/modules/CTChatLog/image/facebook.png" width="20px">
																			</div><?php echo $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->value;?>

																		</a>
																	</li>
																<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
															</ul>
														</div>
													<?php }?>
													<span id="sendfacebookmsg" class="send msg_send_btn" style="cursor: pointer;" draggable="false">
									          			<img src="layouts/v7/modules/CTChatLog/image/send.png" alt="send-icon" draggable="false"/>
									          		</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- PROFILE DETAILS -->
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 padNone hide moduleDetailBlock">	
								<div class="proDetailsDiv">
									<div class="proHead">
										<div class="pic recordData1 imagename"><img src="layouts/v7/modules/CTChatLog/image/pic4.png" /></div>
										<div class="pName">
											<span class="recordData2"></span><br>
											<span class="sender_id"></span>
										</div>		
										<div class="closeBtn"></div>						
									</div>
									<div class="proDetails">
										<div class="personalInfo">
										</div>
										<div class="msgNo">
											<div class="sent">
												<span><?php echo vtranslate('LBL_SENT',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 - 
												<b class="recordData8">3</b></span></div>
											<div class="receive">
												<span><?php echo vtranslate('LBL_RECEIVED',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 -
												<b class="recordData9">4</b></span></div>
										</div>
										<div class="proForm commentSection hide">
											<form>
												<h3><?php echo vtranslate('LBL_COMMENTS',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</h3>
												<textarea class="myInput" id="commentText" placeholder="<?php echo vtranslate('LBL_ENTERCOMMENT',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
" ></textarea>
												<button class="myInput blue" type="button" id="saveComment"><?php echo vtranslate('LBL_POST',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</button>
												<div class="recordData10">
													
												</div>
												<button class="myInput hide" type="button">Assigned to you today 11.10 am</button>	
												<button class="myInput hide" type="button">Conversation Started at 11.50 am</button>	
											</form>
										</div>
										<div class="recentComment">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html><?php }
}
