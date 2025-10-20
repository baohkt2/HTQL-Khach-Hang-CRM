<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- POPPER JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
	<!-- BOOTSTRAP -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	
   	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- CUSTOM CSS -->
	<link rel="stylesheet"  type="text/css" href="layouts/v7/modules/CTChatLog/css/media.css">
	<link rel="stylesheet"  type="text/css" href="layouts/v7/modules/CTChatLog/css/allChats.css">

	<!-- FOR EMOJIS-->
	<link rel="stylesheet" href="layouts/v7/modules/CTChatLog/assets/css/reset.css">
    <link rel="stylesheet" href="layouts/v7/modules/CTChatLog/assets/css/style.css">
    <script src="layouts/v7/modules/CTChatLog/assets/js/jquery.emojiarea.js"></script>
	
	<!-- GOOGLE FONTS-->
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<!-- VERTICAL TABS -->
	<script>
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
	</script>
</head>
<body>
	<!-- WA LISTING SECTION -->
	<div id="fbListing">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					{if $ACCESS_TOKEN_ROWS eq '0'}
						<p class="disconnectMessage">{vtranslate('LBL_FACEBOOK_DISCONNECTED_MESSAGE', $MODULENAME)} {if $ISADMIN eq 'on'}<a href="index.php?module=CTFacebookMessengerIntegration&parent=Settings&view=CTFacebookMessengerIntegrationList" class="connectHereLink">{vtranslate('LBL_CLICK_HERE', $MODULENAME)}</a> {vtranslate('LBL_CONNECT_MESSENGER', $MODULENAME)}{/if}</p>
					{/if}
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="dropdown">
						<div id="quickAccessDiv" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							<a href="#" draggable="false"><p>{vtranslate('LBL_QUICK_ACCESS', $MODULENAME)} <img src="layouts/v7/modules/CTChatLog/image/listing_green.png" draggable="false" style="width: 20px;"></p></a>
						</div>
						<ul class="dropdown-menu facebookMenus facebookb" role="menu" aria-labelledby="dropdownMenu1" style="width:340px;">
							<li>
								<a href="index.php?module=Workflows&parent=Settings&view=List">
									<p><img src="layouts/v7/modules/CTChatLog/image/fbWorkflow.png" title="{vtranslate('LBL_AUTOMATEWORKFLOW', $MODULENAME)}"/>
									{vtranslate('LBL_AUTOMATEWORKFLOW', $MODULENAME)}</p>
								</a>
							</li>
							<li>
								<a href="index.php?module=CTChatLogDetails&view=List&app=TOOLS">
									<p><img src="layouts/v7/modules/CTChatLog/image/wa_messages.png" title="{vtranslate('LBL_FACEBOOK_MESSAGES_LOG', $MODULENAME)}"> {vtranslate('LBL_FACEBOOK_MESSAGES_LOG', $MODULENAME)}
									</p>
								</a>
							</li>
							<li>
								<a href="index.php?parent=Settings&module=CTFacebookMessengerIntegration&view=CTGeneralConfiguration">
									<p><img src="layouts/v7/modules/CTChatLog/image/wa_setup.png" title="{vtranslate('LBL_SETUP_FB_CONFIGURATION', $MODULENAME)} "> {vtranslate('LBL_SETUP_FB_CONFIGURATION', $MODULENAME)}
									</p>
								</a>
							</li>
							<li>
								<a href="index.php?module=CTChatLog&view=DashBoard&mode=moduleDashBoard&analytics=1">
									<p><img src="layouts/v7/modules/CTChatLog/image/dashboardBlue.png" title="{vtranslate('LBL_FB_ANALYTICS', $MODULENAME)}"/> {vtranslate('LBL_FB_ANALYTICS', $MODULENAME)}</p>
								</a>
							</li>
							<li>
								<a id="logoutFacebookQuickAccess">
									<p><img src="layouts/v7/modules/CTChatLog/image/logout.png" title="{vtranslate('LBL_FACEBOOK_LOGOUT', $MODULENAME)}"> {vtranslate('LBL_FACEBOOK_LOGOUT', $MODULENAME)}
									</p>
								</a>
							</li>

							<li>
								<a href="https://kb.crmtiger.com/article-categories/facebook-messenger-integration-for-vtiger/" target="_blank">
									<p><img src="layouts/v7/modules/CTChatLog/image/fbHelp.png" title="{vtranslate('LBL_FACEBOOK_HELP', $MODULENAME)}"> {vtranslate('LBL_FACEBOOK_HELP', $MODULENAME)} 
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
								<a data-toggle="tab" class="nav-link active">{vtranslate('LBL_ALLMESSAGES', $MODULENAME)}</a>
							</li>

							<li class="nav-item facebookModules importantModule" data-selectModule="Important">
						 		<input type="hidden" name="ImportantTotalRecord" id="ImportantTotalRecord" value="{$IMPORTANTMESSAGECOUNTS}">
								<a data-toggle="tab" class="nav-link">{vtranslate('LBL_IMPORTANT', $MODULENAME)}
									{if $IMPORTANTMESSAGECOUNTS neq 0} 
										<span class="counterMsg importantCount">{$IMPORTANTMESSAGECOUNTS}</span>
									{/if}
								</a>
							</li>
							<input type="hidden" id="facebookModule" value="Important">

							<li class="nav-item facebookModules" data-selectModule="NewMessages">
								<input type="hidden" name="NewMessagesTotalRecord" id="NewMessagesTotalRecord" value="{$NEWMESSAGESCOUNTS}">
								<a data-toggle="tab" class="nav-link">{vtranslate('LBL_NEWMESSAGES', $MODULENAME)}
									{if $NEWMESSAGECOUNTS neq 0} 
										<span class="counterMsg new_messages">{$NEWMESSAGECOUNTS}</span>
									{else}
										<span class=" new_messages"></span>
									{/if}
								</a>
							</li> 

							{if $ISADMIN eq 'on'}
								<li class="nav-item facebookModules unknownMessage" data-selectModule="Unknown">
									<input type="hidden" name="UnknownTotalRecord" id="UnknownTotalRecord" value="{$ALLUNKNOWNMESSAGECOUNTS}">
									<a data-toggle="tab" class="nav-link">{vtranslate('LBL_UNKNOWN', $MODULENAME)}
										{if $UNKNOWNMESSAGECOUNTS neq 0} 
											<span class="counterMsg">{$UNKNOWNMESSAGECOUNTS}</span>
										{/if}
									</a>
								</li>
							{/if}

							{foreach item=FACEBOOK_ALLOW_MODULES_VALUE key=FACEBOOK_ALLOW_MODULES_KEY from=$FACEBOOK_ALLOW_MODULES}
								{if $FACEBOOK_ALLOW_MODULES_KEY == 0 || $FACEBOOK_ALLOW_MODULES_KEY == 1}
									<li class="nav-item facebookModules" data-selectModule="{$FACEBOOK_ALLOW_MODULES_VALUE['module']}">
										<input type="hidden" name="{$FACEBOOK_ALLOW_MODULES_VALUE['module']}TotalRecord" id="{$FACEBOOK_ALLOW_MODULES_VALUE['module']}TotalRecord" value="{$WHATSAPPMODULES_VALUE['rows']}">
										<a data-toggle="tab" class="nav-link">{vtranslate($FACEBOOK_ALLOW_MODULES_VALUE['module'], $FACEBOOK_ALLOW_MODULES_VALUE['module'])}
										<span class="counterMsg hide">{$FACEBOOK_ALLOW_MODULES_VALUE['rows']}</span></a>
									</li>
								{/if}
							{/foreach}

							<li class="nav-item hide facebookModules othermodule" data-selectModule="">
								<a data-toggle="tab" class="nav-link othermoduleopen"></a>
							</li>

							{if $TOTALALLOWMODULE gt 2}
							    <li class="nav-item dropdown">
								    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
								    <div class="dropdown-menu">
								    	{foreach item=FACEBOOK_ALLOW_MODULES_VALUE key=FACEBOOK_ALLOW_MODULES_KEY from=$FACEBOOK_ALLOW_MODULES}
											{if $FACEBOOK_ALLOW_MODULES_KEY != 0 && $FACEBOOK_ALLOW_MODULES_KEY != 1}
												<a class="dropdown-item dropdawnModule" data-modulename="{$FACEBOOK_ALLOW_MODULES_VALUE['module']}" data-translatemodulename="{vtranslate($FACEBOOK_ALLOW_MODULES_VALUE['module'], $FACEBOOK_ALLOW_MODULES_VALUE['module'])}"  data-count="{$FACEBOOK_ALLOW_MODULES_VALUE['rows']}" href="#">{vtranslate($FACEBOOK_ALLOW_MODULES_VALUE['module'], $FACEBOOK_ALLOW_MODULES_VALUE['module'])}</a>
											{/if}
										{/foreach}
								    </div>
								</li>
							{/if}
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
					{foreach item=FACEBOOK_ALLOW_MODULES_VALUE key=FACEBOOK_ALLOW_MODULES_KEY from=$FACEBOOK_ALLOW_MODULES}
						<div id="{$FACEBOOK_ALLOW_MODULES_VALUE['module']}Msg" class="tabcontent1 hide">
						</div>
					{/foreach}
				</div>

				<!-- TAB CONTENT -->
				<div class="tab-content fbTabContent">
					<!-- TAB 1 -->				
					<div id="impMsg" class1="tab-pane fade in active">
						<div class="defaultText">
							
							<!-- LISTING -->
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 padNone">										
								<div class="searchForm">
									<input type="text" placeholder="{vtranslate('LBL_SEARCH', $MODULENAME)}" name="search" class="searchBox">
									<input type="hidden" id="facebookContactSearch" value="">
									<a href="#"><i class="fa fa-search"></i></a>
								</div>
								<div class="smallListing">
								</div>

								<input type="hidden" name="start" id="start" value="0">
								<input type="hidden" name="perpagerecord" id="perpagerecord" value="10">

								<div class="loadBtn">
									<button type="button" id="listViewNextPageButton" class="btn listViewNextPageButton greenBtn">
										{vtranslate('LBL_LOADMORE', $MODULENAME)}
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
											<li class="closeBtn" title="{vtranslate('LBL_PREVIEW', $MODULENAME)}">
											</li>
											<li class="recordAssign" draggable="false">
												<img src="layouts/v7/modules/CTChatLog/image/assignto.png" title="{vtranslate('Assigned To', $MODULENAME)}" draggable="false"/>
											</li>
											<li class="editModuleRecord" draggable="false">
												<img class="editIcon" src="layouts/v7/modules/CTChatLog/image/edit.png" title="{vtranslate('LBL_EDIT_RECORD', $MODULENAME)}" draggable="false"/>
											</li>
											<li class="importantMessages hide"><input type="hidden" name="messagesImportant" id="messagesImportant" value=""><img src="layouts/v7/modules/CTChatLog/image/favorites.png" title="{vtranslate('LBL_IMPORTTANTMESSAGE', $MODULENAME)}" draggable="false" /></li>
										 	<li class="nav-item dropdown">
										 		<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" draggable="false">
										 			<img src="layouts/v7/modules/CTChatLog/image/plus.png" class="plusIcon" title="{vtranslate('LBL_STORESENDER', $MODULENAME)}" draggable="false">
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
										<center>{vtranslate('LBL_ADMIN_CAN_SEND_MESSAGES', $MODULE)}</center>
									</div>
									<div>
										<div>
											<div class="ipt-div text-wrapper">
												<div class="ipt-msg-div searchForm conversation-compose ipt-div text-wrapper facebookb" data-emojiarea data-type="unicode" data-global-picker="false">
													<textarea placeholder="{vtranslate('TYPE_MESSAGE', $MODULENAME)}" class="chatText writemsg" name="writemsg" id="writemsg"></textarea>
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
		                                                    <i class="fa fa-paperclip fa-2x" aria-hidden="true" style="cursor: pointer;" title="{vtranslate('LBL_ATTACH', $MODULENAME)}"></i>
		                                                    <input type="file" name="filename" id="filename" class="imageclick">
		                                                </label>
		                                            </div>
												</div>
												<div class="ipt-div-num facebookb">
													{if $FACEBOOK_PAGES_LIST neq ''}
														<div id="dd" class="wrapper-dropdown" tabindex="1" style="pointer-events:none;">
															<span></span>
															<ul class="dropdown">
																{foreach item=FACEBOOK_PAGE_NAME key=FACEBOOK_PAGE_ID from=$FACEBOOK_PAGES_LIST}
																	<li class="selectFacebookPageNumber" data-facebookpageid="{$FACEBOOK_PAGE_ID}" data-facebookpagename="{$FACEBOOK_PAGE_NAME}">
																		<a href="#">
																			<div class="logo">
																				<img src="layouts/v7/modules/CTChatLog/image/facebook.png" width="20px">
																			</div>{$FACEBOOK_PAGE_NAME}
																		</a>
																	</li>
																{/foreach}
															</ul>
														</div>
													{/if}
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
												<span>{vtranslate('LBL_SENT', $MODULENAME)} - 
												<b class="recordData8">3</b></span></div>
											<div class="receive">
												<span>{vtranslate('LBL_RECEIVED', $MODULENAME)} -
												<b class="recordData9">4</b></span></div>
										</div>
										<div class="proForm commentSection hide">
											<form>
												<h3>{vtranslate('LBL_COMMENTS', $MODULENAME)}</h3>
												<textarea class="myInput" id="commentText" placeholder="{vtranslate('LBL_ENTERCOMMENT', $MODULENAME)}" ></textarea>
												<button class="myInput blue" type="button" id="saveComment">{vtranslate('LBL_POST', $MODULENAME)}</button>
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
</html>