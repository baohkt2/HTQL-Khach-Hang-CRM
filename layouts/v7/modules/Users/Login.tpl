{*+**********************************************************************************
* CUSC CRM - Custom Login Page
* Customized for CUSC - Can Tho University Software Center
* Branding configuration loaded from .env file
************************************************************************************}
{* modules/Users/views/Login.php *}

{strip}
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<style>
		body {
			background: url({$BRANDING.login_background});
			background-position: center;
			background-size: cover;
			width: 100%;
			background-repeat: no-repeat;
			min-height: 100vh;
		}
		hr {
			margin-top: 15px;
			background-color: #7C7C7C;
			height: 2px;
			border-width: 0;
		}
		h3, h4 {
			margin-top: 0px;
		}
		hgroup {
			text-align:center;
			margin-top: 4em;
		}
		input {
			font-size: 16px;
			padding: 10px 10px 10px 0px;
			-webkit-appearance: none;
			display: block;
			color: #636363;
			width: 100%;
			border: none;
			border-radius: 0;
			border-bottom: 1px solid #757575;
		}
		input:focus {
			outline: none;
		}
		label {
			font-size: 16px;
			font-weight: normal;
			position: absolute;
			pointer-events: none;
			left: 0px;
			top: 10px;
			transition: all 0.2s ease;
		}
		input:focus ~ label, input.used ~ label {
			top: -20px;
			transform: scale(.75);
			left: -12px;
			font-size: 18px;
		}
		input:focus ~ .bar:before, input:focus ~ .bar:after {
			width: 50%;
		}
		select {
			font-size: 16px;
		}
		#page {
			padding-top: 86px;
		}
		.widgetHeight {
			min-height: 480px;
			margin-top: 20px !important;
		}
		.loginDiv {
			max-width: 400px;
			margin: 0 auto;
			border-radius: 8px;
			box-shadow: 0 4px 20px rgba(0,0,0,0.15);
			background-color: #FFFFFF;
		}
		.marketingDiv {
			color: #303030;
			min-height: 480px !important;
			background: rgba(255,255,255,0.95);
			border-radius: 8px;
			padding: 40px;
			box-shadow: 0 4px 20px rgba(0,0,0,0.15);
		}
		.separatorDiv {
			background-color: rgba(255,255,255,0.3);
			width: 2px;
			height: 460px;
			margin-left: 20px;
		}
		.user-logo {
			max-height: 80px;
			max-width: 200px;
			margin: 0 auto;
			padding-top: 30px;
			padding-bottom: 10px;
			display: block;
		}
		.app-name {
			text-align: center;
			font-size: 26px;
			font-weight: bold;
			color: #2c3e50;
			margin-bottom: 5px;
		}
		.app-tagline {
			text-align: center;
			font-size: 14px;
			color: #7f8c8d;
			margin-bottom: 25px;
		}
		.blockLink {
			border: 1px solid #303030;
			padding: 3px 5px;
		}
		.group {
			position: relative;
			margin: 20px 25px 40px;
		}
		.failureMessage {
			color: #e74c3c;
			display: block;
			text-align: center;
			padding: 10px 20px;
			background: #fdf0ed;
			border-radius: 4px;
			margin: 0 25px 15px;
		}
		.successMessage {
			color: #27ae60;
			display: block;
			text-align: center;
			padding: 10px 20px;
			background: #edfdf0;
			border-radius: 4px;
			margin: 0 25px 15px;
		}
		.inActiveImgDiv {
			padding: 5px;
			text-align: center;
			margin: 30px 0px;
		}
		.app-footer p {
			margin-top: 0px;
		}
		.footer {
			background-color: #fbfbfb;
			height:26px;
		}
		.bar {
			position: relative;
			display: block;
			width: 100%;
		}
		.bar:before, .bar:after {
			content: '';
			width: 0;
			bottom: 1px;
			position: absolute;
			height: 2px;
			background: #3498db;
			transition: all 0.2s ease;
		}
		.bar:before {
			left: 50%;
		}
		.bar:after {
			right: 50%;
		}
		.button {
			position: relative;
			display: inline-block;
			padding: 12px;
			margin: .3em 0 1em 0;
			width: 100%;
			vertical-align: middle;
			color: #fff;
			font-size: 16px;
			line-height: 20px;
			-webkit-font-smoothing: antialiased;
			text-align: center;
			letter-spacing: 1px;
			background: transparent;
			border: 0;
			cursor: pointer;
			transition: all 0.15s ease;
			border-radius: 6px;
			font-weight: 600;
		}
		.button:focus {
			outline: 0;
		}
		.buttonBlue {
			background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
			box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
		}
		.buttonBlue:hover {
			background: linear-gradient(135deg, #5dade2 0%, #3498db 100%);
			box-shadow: 0 6px 20px rgba(52, 152, 219, 0.5);
			transform: translateY(-1px);
		}
		.ripples {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			overflow: hidden;
			background: transparent;
		}
		.mCSB_container {
			height: inherit;
		}
		.copyright-footer {
			text-align: center;
			padding: 20px 25px;
			font-size: 12px;
			color: #95a5a6;
			border-top: 1px solid #ecf0f1;
			margin-top: 15px;
		}
		.copyright-footer a {
			color: #3498db;
			text-decoration: none;
		}
		.copyright-footer a:hover {
			text-decoration: underline;
		}
		.marketing-title {
			font-size: 32px;
			font-weight: bold;
			color: #2c3e50;
			margin-bottom: 20px;
			line-height: 1.3;
		}
		.marketing-description {
			font-size: 16px;
			color: #7f8c8d;
			margin-bottom: 35px;
			line-height: 1.7;
		}
		.feature-list {
			list-style: none;
			padding: 0;
			margin: 0;
		}
		.feature-list li {
			padding: 15px 0;
			border-bottom: 1px solid #ecf0f1;
			font-size: 16px;
			color: #34495e;
			display: flex;
			align-items: center;
		}
		.feature-list li:last-child {
			border-bottom: none;
		}
		.feature-list li:before {
			content: "✓";
			color: #fff;
			background: #27ae60;
			font-weight: bold;
			margin-right: 15px;
			width: 24px;
			height: 24px;
			border-radius: 50%;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			font-size: 12px;
			flex-shrink: 0;
		}
		.forgotPasswordLink {
			color: #3498db !important;
			font-size: 14px;
			transition: color 0.2s;
		}
		.forgotPasswordLink:hover {
			color: #2980b9 !important;
			text-decoration: underline;
		}

		/* Animations */
		@keyframes inputHighlighter {
			from {
				background: #3498db;
			}
			to {
				width: 0;
				background: transparent;
			}
		}
		@keyframes ripples {
			0% {
				opacity: 0;
			}
			25% {
				opacity: 1;
			}
			100% {
				width: 200%;
				padding-bottom: 200%;
				opacity: 0;
			}
		}
		@keyframes fadeIn {
			from {
				opacity: 0;
				transform: translateY(20px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
		.loginDiv, .marketingDiv {
			animation: fadeIn 0.5s ease-out;
		}
	</style>

	<span class="app-nav"></span>
	<div class="container-fluid loginPageContainer">
		<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
			<div class="loginDiv widgetHeight">
				{* Custom Logo from .env *}
				<img class="img-responsive user-logo" src="{$BRANDING.app_logo}" alt="{$BRANDING.app_name}" onerror="this.style.display='none'">
				
				{* App Name *}
				<div class="app-name">{$BRANDING.app_name}</div>
				
				{* App Tagline *}
				{if $BRANDING.app_tagline}
					<div class="app-tagline">{$BRANDING.app_tagline}</div>
				{/if}
				
				<div>
					<span class="{if !$ERROR}hide{/if} failureMessage" id="validationMessage">{$MESSAGE}</span>
					<span class="{if !$MAIL_STATUS}hide{/if} successMessage">{$MESSAGE}</span>
				</div>

				<div id="loginFormDiv">
					<form class="form-horizontal" method="POST" action="index.php">
						<input type="hidden" name="module" value="Users"/>
						<input type="hidden" name="action" value="Login"/>
						<div class="group">
							<input id="username" type="text" name="username" placeholder="Tên đăng nhập">
							<span class="bar"></span>
							<label>Tên đăng nhập</label>
						</div>
						<div class="group">
							<input id="password" type="password" name="password" placeholder="Mật khẩu">
							<span class="bar"></span>
							<label>Mật khẩu</label>
						</div>
						{assign var="CUSTOM_SKINS" value=Vtiger_Theme::getAllSkins()}
						{if !empty($CUSTOM_SKINS)}
						<div class="group" style="margin-bottom: 10px;">
							<select id="skin" name="skin" placeholder="Giao diện" style="text-transform: capitalize; width:100%;height:30px;">
								<option value="">Giao diện mặc định</option>
								{foreach item=CUSTOM_SKIN from=$CUSTOM_SKINS}
								<option value="{$CUSTOM_SKIN}">{$CUSTOM_SKIN}</option>
								{/foreach}
							</select>
						</div>
						{/if}
						<div class="group">
							<button type="submit" class="button buttonBlue">Đăng nhập</button><br>
							<a class="forgotPasswordLink" href="javascript:void(0);">Quên mật khẩu?</a>
						</div>
					</form>
				</div>

				<div id="forgotPasswordDiv" class="hide">
					<form class="form-horizontal" action="forgotPassword.php" method="POST">
						<div class="group">
							<input id="fusername" type="text" name="username" placeholder="Tên đăng nhập">
							<span class="bar"></span>
							<label>Tên đăng nhập</label>
						</div>
						<div class="group">
							<input id="email" type="email" name="emailId" placeholder="Email">
							<span class="bar"></span>
							<label>Email</label>
						</div>
						<div class="group">
							<button type="submit" class="button buttonBlue forgot-submit-btn">Gửi yêu cầu</button><br>
							<span style="font-size: 13px; color: #7f8c8d;">Nhập thông tin để lấy lại mật khẩu</span>
							<a class="forgotPasswordLink pull-right" href="javascript:void(0);">Quay lại</a>
						</div>
					</form>
				</div>
				
				{* Copyright Footer *}
				<div class="copyright-footer">
					{$BRANDING.app_copyright}
					{if $BRANDING.app_website}
						<br><a href="{$BRANDING.app_website}" target="_blank">{$BRANDING.app_website}</a>
					{/if}
				</div>
			</div>
		</div>

		<div class="col-lg-1 hidden-xs hidden-sm hidden-md">
			<div class="separatorDiv"></div>
		</div>

		<div class="col-lg-5 hidden-xs hidden-sm hidden-md">
			<div class="marketingDiv widgetHeight">
				<div class="marketing-title">Chào mừng đến với CUSC CRM</div>
				<div class="marketing-description">Giải pháp quản lý khách hàng toàn diện cho doanh nghiệp của bạn</div>
				
				<ul class="feature-list">
					<li>Quản lý leads &amp; contacts</li>
					<li>Tích hợp email</li>
					<li>Báo cáo &amp; phân tích</li>
					<li>Workflow tự động</li>
				</ul>
			</div>
		</div>
	</div>

	<script>
		jQuery(document).ready(function () {
			var validationMessage = jQuery('#validationMessage');
			var forgotPasswordDiv = jQuery('#forgotPasswordDiv');

			var loginFormDiv = jQuery('#loginFormDiv');

			loginFormDiv.find('a').click(function () {
				loginFormDiv.toggleClass('hide');
				forgotPasswordDiv.toggleClass('hide');
				validationMessage.addClass('hide');
			});

			forgotPasswordDiv.find('a').click(function () {
				loginFormDiv.toggleClass('hide');
				forgotPasswordDiv.toggleClass('hide');
				validationMessage.addClass('hide');
			});

			loginFormDiv.find('button').on('click', function () {
				var username = loginFormDiv.find('#username').val();
				var password = jQuery('#password').val();
				var result = true;
				var errorMessage = '';
				if (username === '') {
					errorMessage = 'Vui lòng nhập tên đăng nhập';
					result = false;
				} else if (password === '') {
					errorMessage = 'Vui lòng nhập mật khẩu';
					result = false;
				}
				if (errorMessage) {
					validationMessage.removeClass('hide').text(errorMessage);
				}
				return result;
			});

			forgotPasswordDiv.find('button').on('click', function () {
				var username = jQuery('#forgotPasswordDiv #fusername').val();
				var email = jQuery('#email').val();

				var email1 = email.replace(/^\s+/, '').replace(/\s+$/, '');
				var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/;
				var illegalChars = /[\(\)\<\>\,\;\:\\\"\[\]]/;

				var result = true;
				var errorMessage = '';
				if (username === '') {
					errorMessage = 'Vui lòng nhập tên đăng nhập';
					result = false;
				} else if (!emailFilter.test(email1) || email == '') {
					errorMessage = 'Vui lòng nhập địa chỉ email hợp lệ';
					result = false;
				} else if (email.match(illegalChars)) {
					errorMessage = 'Địa chỉ email chứa ký tự không hợp lệ';
					result = false;
				}
				if (errorMessage) {
					validationMessage.removeClass('hide').text(errorMessage);
				}
				return result;
			});

			jQuery('input').blur(function (e) {
				var currentElement = jQuery(e.currentTarget);
				if (currentElement.val()) {
					currentElement.addClass('used');
				} else {
					currentElement.removeClass('used');
				}
			});

			var ripples = jQuery('.ripples');
			ripples.on('click.Ripples', function (e) {
				jQuery(e.currentTarget).addClass('is-active');
			});

			ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function (e) {
				jQuery(e.currentTarget).removeClass('is-active');
			});

			loginFormDiv.find('#username').focus();
		});
	</script>
{/strip}
