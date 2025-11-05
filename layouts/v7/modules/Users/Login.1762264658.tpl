{*<!--
/* * *******************************************************************************
 * The content of this file is subject to the VTE Custom User Login Page ("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTExperts.com
 * Portions created by VTExperts.com. are Copyright(C)VTExperts.com.
 * All Rights Reserved.
 * ****************************************************************************** */
-->*}
{strip}
    <!DOCTYPE html>
    <html>
    <head>
        <title>{$COMPANY_DETAILS.name}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- for Login page we are added -->
        <link href="layouts/v7/modules/Settings/UserLogin/resources/UserLogin.css" rel="stylesheet" />
        <link href="layouts/v7/modules/UserLogin/resources/UserLogin.css" rel="stylesheet" />
        <script src="libraries/jquery/boxslider/jqueryBxslider.js"></script>
        <script src="libraries/jquery/boxslider/respond.min.js"></script>
        <script>
            jQuery(document).ready(function(){
                scrollx = jQuery(window).outerWidth();
                window.scrollTo(scrollx,0);
                slider = jQuery('.bxslider').bxSlider({
                    mode: 'horizontal',
                    auto: true,
                    randomStart : false,
                    autoHover: false,
                    controls: false,
                    pager: false,
                    speed: '1500',
                    easing: 'linear',
                    onSliderLoad: function() {

                    }
                });
            });
        </script>
    </head>
    <body>
    <div class="vte-login-container">
        <div class="logo">
            <img src="test/logo/iconContact.png" />
        </div>
        <div style="margin-left: -10px">
            <div class="col-lg-6 col-md-6 col-sm-6 slideshow">
                <div class="carousal-container">
                    <ul class="bxslider">
                        <li>
                                <div id="slide0" class="slide">
                                    <img class="pull-left" src="test/logo/DALL·E 2023-11-02 19.35.39 - A photo of an open address book laying flat on a wooden desk surface, displaying alphabetical tabs on the side. The pages are filled with handwritten .png">
                                </div>
                            </li><li>
                                <div id="slide1" class="slide">
                                    <img class="pull-left" src="test/logo/z6152938103594_1623d450afa5e0bb3e99d5487f8914ef.jpg">
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 login-area">

                <div class="col-lg-12 col-md-12 col-sm-12 site-info">
                    <h1 class="login-header">CUSC CRM</h1>
                    <p>This is CUSC CRM</p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 login-box" id="loginDiv">
                    <form class="form-horizontal login-form" action="index.php?module=Users&action=Login" method="POST">
                        {if isset($smarty.request.error)}
                            <div class="row alert alert-error">
                                <p>Invalid username or password.</p>
                            </div>
                        {/if}
                        {if isset($smarty.request.fpError)}
                            <div class="row alert alert-error">
                                <p>Invalid Username or Email address.</p>
                            </div>
                        {/if}
                        {if isset($smarty.request.status)}
                            <div class="row alert alert-success">
                                <p>Mail has been sent to your inbox, please check your e-mail.</p>
                            </div>
                        {/if}
                        {if isset($smarty.request.statusError)}
                            <div class="row alert alert-error">
                                <p>Outgoing mail server was not configured.</p>
                            </div>
                        {/if}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 username">
                                <input type="text" id="username" name="username" placeholder="Username" value="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 password">
                                <input type="password" id="password" name="password" placeholder="Password" value="">
                            </div>
                        </div>
                        <div class="row control-group signin-button pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12" id="forgotPassword">
                                <a>Forgot Password ?</a>&nbsp;&nbsp;&nbsp;
                                <button type="submit" class="btn btn-primary sbutton">Sign in</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 login-box hide" id="forgotPasswordDiv">
                    <form class="form-horizontal login-form" action="forgotPassword.php" method="POST">
                        <div class="row">
                            <h3 class="forgot-password">Forgot Password</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 username">
                                <input type="text" id="user_name" name="username" placeholder="Username">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 password">
                                <input type="text" id="emailId" name="emailId"  placeholder="Email">
                            </div>
                        </div>
                        <div class="row control-group signin-button">
                            <div class="" id="backButton">
                                <input type="button" class="btn btn-back sbutton pull-left" value="Back">
                                <input type="submit" class="btn btn-primary sbutton pull-right" value="Submit" name="retrievePassword">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 login-more-info vte-user-login">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 social">
                            
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 copy-right">
                            <small></small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </body>
    <script>
        jQuery(document).ready(function(){
            jQuery("#forgotPassword a").click(function() {
                jQuery("#loginDiv").addClass('hide');
                jQuery("#forgotPasswordDiv").removeClass('hide');
            });

            jQuery("#backButton .btn-back").click(function() {
                jQuery("#loginDiv").removeClass('hide');
                jQuery("#forgotPasswordDiv").addClass('hide');
            });

            jQuery("input[name='retrievePassword']").click(function (){
                var username = jQuery('#user_name').val();
                var email = jQuery('#emailId').val();

                var email1 = email.replace(/^\s+/,'').replace(/\s+$/,'');
                var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
                var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;

                if(username == ''){
                    alert('Please enter valid username');
                    return false;
                } else if(!emailFilter.test(email1) || email == ''){
                    alert('Please enater valid email address');
                    return false;
                } else if(email.match(illegalChars)){
                    alert( "The email address contains illegal characters.");
                    return false;
                } else {
                    return true;
                }

            });
        });
    </script>
    </html>
{/strip}
