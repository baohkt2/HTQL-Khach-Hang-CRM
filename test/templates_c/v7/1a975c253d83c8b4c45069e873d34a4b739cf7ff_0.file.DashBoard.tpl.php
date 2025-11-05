<?php
/* Smarty version 4.5.5, created on 2025-11-05 09:25:06
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\CTChatLog\DashBoard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b17f2ab47a0_21953830',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1a975c253d83c8b4c45069e873d34a4b739cf7ff' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\CTChatLog\\DashBoard.tpl',
      1 => 1761724803,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b17f2ab47a0_21953830 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
	<head>
	  	<link rel="stylesheet" type="text/css" href="layouts/v7/modules/<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
/css/DashBoard.css">
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
	  	<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"><?php echo '</script'; ?>
>
	   	<!-- FONT AWESOME -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class="wrapper bgb"><br>
			<section class="content">
		      	<div class="container-fluid">
		      		<?php if ($_smarty_tpl->tpl_vars['FACEBOOK_STATUS']->value == '0') {?>
						<p class="disconnectMessage"><?php echo vtranslate('LBL_FACEBOOK_DISCONNECTED_MESSAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php if ($_smarty_tpl->tpl_vars['ISADMIN']->value == 'on') {?><a href="index.php?module=CTFacebookMessengerIntegration&parent=Settings&view=CTFacebookMessengerIntegrationList" class="connectHereLink"><?php echo vtranslate('LBL_CLICK_HERE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a> <?php echo vtranslate('LBL_CONNECT_MESSENGER',$_smarty_tpl->tpl_vars['MODULE']->value);
}?></p>
					<?php }?>
		      		<div class="row">
		      			<div class="dropdown" style="position: relative;">
		      				<div id="quickAccessDivDashboard" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="float: right !important;margin: 0px 15px 0px 0px;">
								<a href="#"><p><?php echo vtranslate('LBL_QUICK_ACCESS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <img src="layouts/v7/modules/CTChatLog/image/listing_green.png" style="width: 20px;"></p></a>
							</div>
							<ul class="dropdown-menu facebookMenus facebookb" role="menu" aria-labelledby="dropdownMenu1">
								<li>
									<a href="index.php?module=Workflows&parent=Settings&view=List">
										<span id="refreshMessages" title="<?php echo vtranslate('LBL_AUTOMATEWORKFLOW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
">
											<p><img src="layouts/v7/modules/CTChatLog/image/fbWorkflow.png" title="<?php echo vtranslate('LBL_AUTOMATEWORKFLOW',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
"/>
										<?php echo vtranslate('LBL_AUTOMATEWORKFLOW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</p>
										</span>
									</a>
								</li>
								<li>
									<a href="index.php?module=CTChatLog&view=ChatBox&mode=allChats">
										<span id="refreshMessages" title="<?php echo vtranslate('LBL_FACEBOOK_TIMELINE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
">
											<p><img src="layouts/v7/modules/CTChatLog/image/listing_green.png" title="<?php echo vtranslate('LBL_FACEBOOK_MESSAGES_LOG',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
"> <?php echo vtranslate('LBL_FACEBOOK_TIMELINE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</p>
										</span>
									</a>
								</li>
								<li>
									<a href="index.php?module=CTChatLogDetails&view=List&app=TOOLS">
										<span id="refreshMessages" title="<?php echo vtranslate('LBL_FACEBOOK_MESSAGES_LOG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
">
											<p><img src="layouts/v7/modules/CTChatLog/image/wa_messages.png" title="<?php echo vtranslate('LBL_FACEBOOK_MESSAGES_LOG',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
"> <?php echo vtranslate('LBL_FACEBOOK_MESSAGES_LOG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</p>
										</span>
									</a>
								</li>
								<li>
									<a href="index.php?parent=Settings&module=CTFacebookMessengerIntegration&view=CTGeneralConfiguration">
										<span id="refreshMessages" title="<?php echo vtranslate('LBL_SETUP_FB_CONFIGURATION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
">
											<p><img src="layouts/v7/modules/CTChatLog/image/wa_setup.png" title="Setup "> <?php echo vtranslate('LBL_SETUP_FB_CONFIGURATION',$_smarty_tpl->tpl_vars['MODULE']->value);?>

										</p>
										</span>
									</a>
								</li>
								<li>
									<a href="index.php?module=CTChatLog&view=DashBoard&mode=moduleDashBoard&analytics=1">
										<span id="refreshMessages" title="<?php echo vtranslate('LBL_FB_ANALYTICS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
">
											<p><img src="layouts/v7/modules/CTChatLog/image/dashboardBlue.png" title="<?php echo vtranslate('LBL_FB_ANALYTICS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/> <?php echo vtranslate('LBL_FB_ANALYTICS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</p>
										</span>
									</a>
								</li>
								<li>
									<a id="logoutFacebookQuickAccess">
										<span id="refreshMessages" title="<?php echo vtranslate('LBL_FACEBOOK_LOGOUT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
">
											<p><img src="layouts/v7/modules/CTChatLog/image/logout.png" title="Logout Facebook"> <?php echo vtranslate('LBL_FACEBOOK_LOGOUT',$_smarty_tpl->tpl_vars['MODULE']->value);?>

											</p>
										</span>
									</a>
								</li>

								<li>
									<a href="https://kb.crmtiger.com/article-categories/facebook-messenger-integration-for-vtiger/">
										<p><img src="layouts/v7/modules/CTChatLog/image/fbHelp.png" title="<?php echo vtranslate('LBL_FACEBOOK_HELP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"> <?php echo vtranslate('LBL_FACEBOOK_HELP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 
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
								 			<?php echo vtranslate('LBL_SEND_RECEIVE_STATISTICS',$_smarty_tpl->tpl_vars['MODULE']->value);?>

										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<?php if ($_smarty_tpl->tpl_vars['ANALYTICS']->value == 1) {?>
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
													<option value=""><?php echo vtranslate('LBL_SELECT_FACEBOOK_PAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
													<option value="All">All</option>
													<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FACEBOOK_PAGES_LIST']->value, 'FACEBOOK_PAGE_NAME', false, 'FACEBOOK_PAGE_ID');
$_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_ID']->value => $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->value) {
$_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->do_else = false;
?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_ID']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_NAME']->value;?>
</option>
													<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
									         	</select>
									         	<select class="inputElement select2 " id="reportData" style="width: 170px;">
													<option value=""><?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
									            	<option value="today"><?php echo vtranslate('LBL_Today',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
									            	<option value="yesterday"><?php echo vtranslate('LBL_Yesterday',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
									            	<option value="thisweek"><?php echo vtranslate('LBL_ThisWeek',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
									            	<option value="lastweek"><?php echo vtranslate('LBL_LastWeek',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
									            	<option value="thismonth"><?php echo vtranslate('LBL_ThisMonth',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
									            	<option value="lastmonth"><?php echo vtranslate('LBL_LastMonth',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
									            	<option value="alltime"><?php echo vtranslate('LBL_ALLTIME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
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
																	<b>	<?php echo vtranslate('LBL_FINISHEDCHAT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b>
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
																	<b><?php echo vtranslate('LBL_PENDINGCHAT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b>
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
																	<b><?php echo vtranslate('LBL_RESPONSETIME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b>
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
																	<b><?php echo vtranslate('LBL_SENTMESSAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b>
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
																	<b><?php echo vtranslate('LBL_RECEIVEDMESSAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b>
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
																	<b><?php echo vtranslate('LBL_TOTALMESSAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b>
																	<a href="" class="fa fa-eye icon TotalMessageURL" target="_blank"></a>
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
										<div class="card-header rdus mrkg-hd-2">
											<h3 class="card-title"><?php echo vtranslate('LBL_BYMESSAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h3>
										</div>
										<div id="byfacebookMessage">
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php }?>
				</div>
		    </section>
		</div>
	</body>
</html>

<?php echo '<script'; ?>
 type="text/javascript" src="libraries/jquery/bootstrapswitch/js/bootstrap-switch.min.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="libraries/jquery/bootstrapswitch/css/bootstrap3/bootstrap-switch.min.css">
<?php }
}
