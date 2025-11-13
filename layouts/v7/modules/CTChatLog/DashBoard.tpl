<html>
	<head>
	  	<link rel="stylesheet" type="text/css" href="layouts/v7/modules/{$MODULE}/css/DashBoard.css">
	  	<style type="text/css">
	  		#countdowntimer{
			    font-family: sans-serif;
			    color: #fff;
			    display: inline-block;
			    font-weight: 100;
			    text-align: center;
			    font-size: 30px;
			}

			#countdowntimer{
			    padding: 10px;
			    border-radius: 3px;
			    background: #00BF96;
			    display: inline-block;
			}

			#countdowntimer{
			    padding: 15px;
			    border-radius: 3px;
			    background: #00816A;
			    display: inline-block;
			}
			.fbTabs {
				width: 100%;
				display: inline-block;
				float: left;
			}
			ul#myTab {
				border-bottom: 1px solid #0087fa;
			}
			.nav-tabs > li {
				float: left;
				margin-bottom: -1px;
			}
			.nav-tabs > li {
				border-bottom: 0;
				margin-bottom: -1px;
			}

			ul#myTab a.nav-link.active, ul#myTab .nav-link:hover {
				background: #1877f2;
				color: #fff;
			}
			ul#myTab .nav-link {
				font-size: 15px;
				font-weight: 500;
				border: 1px solid #ddd;
				border-bottom-color: rgb(221, 221, 221);
				border-bottom-style: solid;
				border-bottom-width: 1px;
				border-bottom: 0;
				border-radius: 0;
				margin-left: -1px;
				padding: 10px 20px;
			}
			ul.dropdown-menu li img {
			  width: 20px;
			}

			.facebookMenus.a {
				display: inline-block;
				width: 100%;
				padding: .25rem 1.5rem;
				clear: both;
				font-weight: 400;
				color: #212529;
				text-align: inherit;
				white-space: nowrap;
				background-color: transparent;
				border: 0;
				text-decoration: none;
				font-size: 14px;
			}

			.facebookMenus p{
				color: #666;
				font-weight: 400;
				font-size: 14px;
				line-height: 20px;
				margin: 0;
			}

			.dataTables_filter {
				float: right;
			}

			.dataTables_length {
				display: none;
			}

			.pagination {
				float: right;
			}

			.dataTables_empty {
				text-align: center;
			}

	  	</style>
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	   	<!-- FONT AWESOME -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class="wrapper bgb"><br>
			<section class="content">
		      	<div class="container-fluid">
		      		{if $FACEBOOK_STATUS eq '0'}
						<p class="disconnectMessage">{vtranslate('LBL_FACEBOOK_DISCONNECTED_MESSAGE', $MODULE)} {if $ISADMIN eq 'on'}<a href="index.php?module=CTFacebookMessengerIntegration&parent=Settings&view=CTFacebookMessengerIntegrationList" class="connectHereLink">{vtranslate('LBL_CLICK_HERE', $MODULE)}</a> {vtranslate('LBL_CONNECT_MESSENGER', $MODULE)}{/if}</p>
					{/if}
		      		<div class="row">
		      			<div class="dropdown" style="position: relative;">
		      				<div id="quickAccessDivDashboard" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="float: right !important;margin: 0px 15px 0px 0px;">
								<a href="#"><p>{vtranslate('LBL_QUICK_ACCESS', $MODULE)} <img src="layouts/v7/modules/CTChatLog/image/listing_green.png" style="width: 20px;"></p></a>
							</div>
							<ul class="dropdown-menu facebookMenus facebookb" role="menu" aria-labelledby="dropdownMenu1">
								<li>
									<a href="index.php?module=Workflows&parent=Settings&view=List">
										<span id="refreshMessages" title="{vtranslate('LBL_AUTOMATEWORKFLOW', $MODULE)}">
											<p><img src="layouts/v7/modules/CTChatLog/image/fbWorkflow.png" title="{vtranslate('LBL_AUTOMATEWORKFLOW', $MODULENAME)}"/>
										{vtranslate('LBL_AUTOMATEWORKFLOW', $MODULE)}</p>
										</span>
									</a>
								</li>
								<li>
									<a href="index.php?module=CTChatLog&view=ChatBox&mode=allChats">
										<span id="refreshMessages" title="{vtranslate('LBL_FACEBOOK_TIMELINE', $MODULE)}">
											<p><img src="layouts/v7/modules/CTChatLog/image/listing_green.png" title="{vtranslate('LBL_FACEBOOK_MESSAGES_LOG', $MODULENAME)}"> {vtranslate('LBL_FACEBOOK_TIMELINE', $MODULE)}</p>
										</span>
									</a>
								</li>
								<li>
									<a href="index.php?module=CTChatLogDetails&view=List&app=TOOLS">
										<span id="refreshMessages" title="{vtranslate('LBL_FACEBOOK_MESSAGES_LOG', $MODULE)}">
											<p><img src="layouts/v7/modules/CTChatLog/image/wa_messages.png" title="{vtranslate('LBL_FACEBOOK_MESSAGES_LOG', $MODULENAME)}"> {vtranslate('LBL_FACEBOOK_MESSAGES_LOG', $MODULE)}</p>
										</span>
									</a>
								</li>
								<li>
									<a href="index.php?parent=Settings&module=CTFacebookMessengerIntegration&view=CTGeneralConfiguration">
										<span id="refreshMessages" title="{vtranslate('LBL_SETUP_FB_CONFIGURATION', $MODULE)}">
											<p><img src="layouts/v7/modules/CTChatLog/image/wa_setup.png" title="Setup "> {vtranslate('LBL_SETUP_FB_CONFIGURATION', $MODULE)}
										</p>
										</span>
									</a>
								</li>
								<li>
									<a href="index.php?module=CTChatLog&view=DashBoard&mode=moduleDashBoard&analytics=1">
										<span id="refreshMessages" title="{vtranslate('LBL_FB_ANALYTICS', $MODULE)}">
											<p><img src="layouts/v7/modules/CTChatLog/image/dashboardBlue.png" title="{vtranslate('LBL_FB_ANALYTICS', $MODULE)}"/> {vtranslate('LBL_FB_ANALYTICS', $MODULE)}</p>
										</span>
									</a>
								</li>
								<li>
									<a id="logoutFacebookQuickAccess">
										<span id="refreshMessages" title="{vtranslate('LBL_FACEBOOK_LOGOUT', $MODULE)}">
											<p><img src="layouts/v7/modules/CTChatLog/image/logout.png" title="Logout Facebook"> {vtranslate('LBL_FACEBOOK_LOGOUT', $MODULE)}
											</p>
										</span>
									</a>
								</li>

								<li>
									<a href="https://kb.crmtiger.com/article-categories/facebook-messenger-integration-for-vtiger/">
										<p><img src="layouts/v7/modules/CTChatLog/image/fbHelp.png" title="{vtranslate('LBL_FACEBOOK_HELP', $MODULE)}"> {vtranslate('LBL_FACEBOOK_HELP', $MODULE)} 
										</p>
									</a>
								</li>
								
							</ul>
		      			</div>
		      		</div>
		      		<div class="row">
				        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0px 0px 0px -3px;">
							<div class="fbTabs" >
								<ul class="nav nav-tabs activetab" id="myTab">
									<input type="hidden" id="activeMessageTab" value="SendReceiveStatistics">
									<li class="nav-itemselectTab reportChart" data-selectTab="SendReceiveStatistics">
								 		<a data-toggle="tab" class="nav-link active">
								 			{vtranslate('LBL_SEND_RECEIVE_STATISTICS', $MODULE)}
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					{if $ANALYTICS eq 1}
						<div class="row">
				          	<div class="col-12">
				            	<div class="card">
				              		<div class="card-body mktg-bx-top">
										<div class="card-header rdus mrkg-hd-2">
											<br><br>
											<input type="hidden" name="periodData" value='thisweek'>
											<div style="float: right;margin: -45px 0px 0px 0px;">
												<br>
												<select class="inputElement select2" id="facebookPage" style="width: 170px;">
													<option value="">{vtranslate('LBL_SELECT_FACEBOOK_PAGE',$MODULE)}</option>
													<option value="All">All</option>
													{foreach item=FACEBOOK_PAGE_NAME key=FACEBOOK_PAGE_ID from=$FACEBOOK_PAGES_LIST}
														<option value="{$FACEBOOK_PAGE_ID}">{$FACEBOOK_PAGE_NAME}</option>
													{/foreach}
									         	</select>
									         	<select class="inputElement select2 " id="reportData" style="width: 170px;">
													<option value="">{vtranslate('LBL_SELECT_OPTION', $MODULE)}</option>
									            	<option value="today">{vtranslate('LBL_Today', $MODULE)}</option>
									            	<option value="yesterday">{vtranslate('LBL_Yesterday', $MODULE)}</option>
									            	<option value="thisweek">{vtranslate('LBL_ThisWeek', $MODULE)}</option>
									            	<option value="lastweek">{vtranslate('LBL_LastWeek', $MODULE)}</option>
									            	<option value="thismonth">{vtranslate('LBL_ThisMonth',$MODULE)}</option>
									            	<option value="lastmonth">{vtranslate('LBL_LastMonth',$MODULE)}</option>
									            	<option value="alltime">{vtranslate('LBL_ALLTIME',$MODULE)}</option>
									         	</select><br>
									        </div>
										</div>
										<br><br>
										<section class="content">
		      								<div class="container-fluid">
												<div class="row SendReceiveStatistics">
													<div class="col-lg-2 col-md-2 col-sm-2" style="width: 200px;">	
														<div class="small-box bg-info">
															<div class="inner">
																<span style="color: black;font-size: 25px;" class="FinishedChat">0</span>
																<br>
																<span style="color: black;">
																	<b>	{vtranslate('LBL_FINISHEDCHAT', $MODULE)}</b>
																	<a href="" class="fa fa-eye icon FinishedChatURL hide" target="_blank"></a>
																</span>
															</div>
														</div>
													</div>
													<div class="col-lg-2 col-md-2 col-sm-2" style="width: 200px;">	
														<div class="small-box bg-info">
															<div class="inner">
																<span style="color: black;font-size: 25px;" class="PendingChat">0</span><br>
																<span style="color: black;">
																	<b>{vtranslate('LBL_PENDINGCHAT', $MODULE)}</b>
																	<a href="" class="fa fa-eye icon PendingChatURL hide" target="_blank"></a>
																</span>
															</div>
														</div>
													</div>
													<div class="col-lg-2 col-md-2 col-sm-2 hide"style="width: 200px;">	
														<div class="small-box bg-info">
															<div class="inner">
																<span style="color: black;font-size: 25px;" class="ResponseTime">0</span><br>
																<span style="color: black;">
																	<b>{vtranslate('LBL_RESPONSETIME', $MODULE)}</b>
																	<a href="" class="fa fa-eye icon ResponseTimeURL"></a target="_blank">
																</span>
															</div>
														</div>
													</div>
													<div class="col-lg-2 col-md-2 col-sm-2" style="width: 200px;">	
														<div class="small-box bg-info">
															<div class="inner">
																<span style="color: black;font-size: 25px;" class="SentMessage">0</span><br>
																<span style="color: black;">
																	<b>{vtranslate('LBL_SENTMESSAGE', $MODULE)}</b>
																	<a href="" class="fa fa-eye icon SentMessageURL" target="_blank"></a>
																</span>
															</div>
														</div>
													</div>
													<div class="col-lg-2 col-md-2 col-sm-2" style="width: 200px;">	
														<div class="small-box bg-info">
															<div class="inner">
																<span style="color: black;font-size: 25px;" class="ReceivedMessage">0</span><br>
																<span style="color: black;">
																	<b>{vtranslate('LBL_RECEIVEDMESSAGE', $MODULE)}</b>
																	<a href="" class="fa fa-eye icon ReceivedMessageURL" target="_blank"></a>
																</span>
															</div>
														</div>
													</div>
													<div class="col-lg-2 col-md-2 col-sm-2" style="width: 200px;">	
														<div class="small-box bg-info">
															<div class="inner">
																<span style="color: black;font-size: 25px;" class="TotalMessage">0</span><br>
																<span style="color: black;">
																	<b>{vtranslate('LBL_TOTALMESSAGE', $MODULE)}</b>
																	<a href="" class="fa fa-eye icon TotalMessageURL" target="_blank"></a>
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
										<div class="card-header rdus mrkg-hd-2">
											<h3 class="card-title">{vtranslate('LBL_BYMESSAGE', $MODULE)}</h3>
										</div>
										<div id="byfacebookMessage">
										</div>
									</div>
								</div>
							</div>
						</div>
					{/if}
				</div>
		    </section>
		</div>
	</body>
</html>
{literal}
<script type="text/javascript" src="libraries/jquery/bootstrapswitch/js/bootstrap-switch.min.js"></script>
<link rel="stylesheet" href="libraries/jquery/bootstrapswitch/css/bootstrap3/bootstrap-switch.min.css">
{/literal}