<?
/*
*	Template Name: Login
*/ 
global $user_identity, $userInfo, $user_ID, $wp_query, $wpdb, $wpc_client, $wp_crm, $current_user;
	  $currUserInfo = get_userdata($user_ID);
	  $currPostName = $post->post_name; 
	  $currPostTitle = $post->post_title;
	  $currUserProperty = new WP_User( $user_ID ); 
	  $userRole = '';
	  if ( !empty( $currUserProperty->roles ) && is_array( $currUserProperty->roles ) ) { 
		foreach ( $currUserProperty->roles as $role )
			$userRole = $role; 
	  } 
?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html lang="en">
<!--<![endif]-->
<head>
<title>
<?php
	// Detect Yoast SEO Plugin
	if (defined('WPSEO_VERSION')) {
		wp_title('');
	} else {
		
		global $page, $paged;
		
		$plugins_url = plugins_url();
	
		wp_title( '|', true, 'right' );
	
		// Add the blog name.
		bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'artcotechsconnect' ), max( $paged, $page ) );
	}
?>
</title>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-icon.png"> 
<link href="<? bloginfo( 'template_url' ); ?>/style.css" rel="stylesheet" type="text/css">

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<? bloginfo( 'template_url' ); ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/uniform.default.css" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<? bloginfo( 'template_url' ); ?>/css/select2.css">
<link rel="stylesheet" type="text/css" href="<? bloginfo( 'template_url' ); ?>/css/select2-metronic.css">
<link rel="stylesheet" type="text/css" href="<? bloginfo( 'siteurl' ); ?>/wp-content/plugins/nextend-google-connect/buttons/google-btn.css?ver=3.7">
<link href="<? bloginfo( 'template_url' ); ?>/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="<? bloginfo( 'template_url' ); ?>/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME STYLES -->
<link href="<? bloginfo( 'template_url' ); ?>/css/style-metronic.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/style-responsive.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/plugins.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="<? bloginfo( 'template_url' ); ?>/css/login2.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/custom.css" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->

<link rel="shortcut icon" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-icon.png">

<!-- BEGIN APPLE TOUCH SPLASH ICONS -->
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-icon-57x57-blue.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-icon-114x114-blue.png">
<link rel="apple-touch-icon-precomposed" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-icon-72x72-blue.png" sizes="72x72">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-icon-144x144-blue.png">
<!-- END APPLE TOUCH SPLASH ICONS -->

<!-- BEGIN APPLE TOUCH SPLASH IMAGES -->
<link rel="apple-touch-startup-image" media="(device-width: 320px)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-320x460.png">
<link rel="apple-touch-startup-image" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-640x920.png">
<link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-640x1096.png">
<link rel="apple-touch-startup-image" media="(device-width: 768px) and (orientation: portrait)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-768x1004.png">
<link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-1024x748.png">
<link rel="apple-touch-startup-image" media="(device-width: 1536px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-1536x2008.png">
<link rel="apple-touch-startup-image" media="(device-width: 1536px)  and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-2048x1496.png">
<!-- END APPLE TOUCH SPLASH IMAGES -->

<? wp_head(); ?>
</head>

<body <? body_class('login'); ?>>
    <div class="spinnerbg">
        <div id="spinner">
            <span id="first" class="ball"></span>
            <span id="second" class="ball"></span>
            <span id="third" class="ball"></span>
        </div>
    </div>
   <!-- BEGIN CONTAINER -->
   <div class="page-container">

        <!-- BEGIN LOGO -->
        <div class="logo"> <img src="<? bloginfo( 'siteurl' ); ?>/wp-content/uploads/2014/01/amn-logo.png" alt=""/> </div>
        <!-- END LOGO --> 
        
        <!-- BEGIN LOGIN -->
        <?php while ( have_posts() ) : the_post(); ?>
        <div <? post_class('content well'); ?> id="access-content"> 
        
                  <? the_content(); ?>
        
        </div>
        <? endwhile; ?>
        
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <?php /*?>	 <form class="login-form" action="<? bloginfo( 'siteurl' ); ?>/wp-login.php" method="post" novalidate="novalidate">
                <h3 class="form-title">Login to your account</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>
                         Enter any username and password.
                    </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="user_login">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="user_pass">
                    </div>
                </div>
                <div class="form-actions">
                    <label class="checkbox">
                    <div class="checker"><span><input type="checkbox" name="remember" value="1"></span></div> Remember me </label>
                    <button type="submit" class="btn green pull-right">
                    Login <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                    <input type="hidden" name="redirect_to" value="http://artcotechs.net/wp-admin/">
                </div>
                <div class="login-options">
                    <h4>Or login with</h4>
                    <ul class="social-icons">
                        <li>
                            <a class="facebook" data-original-title="facebook" href="#">
                            </a>
                        </li>
                        <li>
                            <a class="twitter" data-original-title="Twitter" href="#">
                            </a>
                        </li>
                        <li>
                            <a class="googleplus" data-original-title="Goole Plus" href="#">
                            </a>
                        </li>
                        <li>
                            <a class="linkedin" data-original-title="Linkedin" href="#">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="forget-password">
                    <h4>Forgot your password ?</h4>
                    <p>
                         no worries, click
                        <a href="javascript:;" id="forget-password">
                             here
                        </a>
                         to reset your password.
                    </p>
                </div>
                <div class="create-account">
                    <p>
                         Don't have an account yet ?&nbsp;
                        <a href="javascript:;" id="register-btn">
                             Create an account
                        </a>
                    </p>
                </div>
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="index.html" method="post" novalidate="novalidate">
                <h3>Forget Password ?</h3>
                <p>
                     Enter your e-mail address below to reset your password.
                </p>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn">
                    <i class="m-icon-swapleft"></i> Back </button>
                    <button type="submit" class="btn green pull-right">
                    Submit <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
            <!-- BEGIN REGISTRATION FORM -->
            <form class="register-form" action="index.html" method="post" novalidate="novalidate">
                <h3>Sign Up</h3>
                <p>
                     Enter your personal details below:
                </p>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Full Name</label>
                    <div class="input-icon">
                        <i class="fa fa-font"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="fullname">
                    </div>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Address</label>
                    <div class="input-icon">
                        <i class="fa fa-check"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Address" name="address">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">City/Town</label>
                    <div class="input-icon">
                        <i class="fa fa-location-arrow"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="City/Town" name="city">
                    </div>
                </div>
                <p>
                     Enter your account details below:
                </p>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                    <div class="controls">
                        <div class="input-icon">
                            <i class="fa fa-check"></i>
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>
                    <div class="checker"><span><input type="checkbox" name="tnc"></span></div> I agree to the
                    <a href="#">
                         Terms of Service
                    </a>
                     and
                    <a href="#">
                         Privacy Policy
                    </a>
                    </label>
                    <div id="register_tnc_error">
                    </div>
                </div>
                <div class="form-actions">
                    <button id="register-back-btn" type="button" class="btn">
                    <i class="m-icon-swapleft"></i> Back </button>
                    <button type="submit" id="register-submit-btn" class="btn green pull-right">
                    Sign Up <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                </div>
            </form>  <?php */?>
            <!-- END REGISTRATION FORM -->
        </div>
        
        <!-- END LOGIN --> 
        
        <p id="backtoblog"><a href="http://connect.artcotechs.net/" title="Back to Main">← Back to Artcotechs Connect</a></p>
        
        
        <!-- BEGIN COPYRIGHT -->
        <div class="copyright"> © 2013 Artcotechs Media Network <br>
          All Rights Reserved. </div>
          
         
        <? 
        if($userRole == 'administrator' || $userRole == 'super_admin') {
            include( get_template_directory(). '/members/admin/inc/mobile-navigation.php' ); 
        }
        else if($userRole == 'embassador') {
            include( get_template_directory(). '/members/embassador/inc/footer.php' ); 
        }
        else if($userRole == 'wpc_client') {
            include( get_template_directory(). '/members/client/inc/mobile-navigation.php' ); 
        }
        else if($userRole == 'subscriber') {
            include( get_template_directory(). '/members/guest/inc/guest-footer.php' ); 
        }
         else { 
             include( get_template_directory(). '/members/guest/inc/guest-footer.php' );
         } ?>
	</div>
    <!-- END CONTAINER -->
    
    
<!-- END COPYRIGHT --> 
<script src="<? bloginfo( 'template_url' ); ?>/js/jquery-1.10.2.min.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/jquery.blockui.min.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/jquery.cokie.min.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/jquery.uniform.min.js" type="text/javascript"></script> 
<!-- END CORE PLUGINS --> 

<!-- BEGIN PAGE LEVEL PLUGINS --> 
<script src="<? bloginfo( 'template_url' ); ?>/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<? bloginfo( 'template_url' ); ?>/js/select2.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS --> 

<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<script src="<? bloginfo( 'template_url' ); ?>/js/main.js" type="text/javascript"></script>
<script src="<? bloginfo( 'template_url' ); ?>/js/app.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/login.js" type="text/javascript"></script>  
<script src="<? bloginfo( 'template_url' ); ?>/js/amn-scripts.js" type="text/javascript"></script> 
 
<!--<script src="<? bloginfo( 'template_url' ); ?>/js/login.js" type="text/javascript"></script> -->
<script src="<? bloginfo( 'template_url' ); ?>/js/spinner.js" type="text/javascript"></script> 
<!-- END PAGE LEVEL SCRIPTS --> 

<script>
	$(document).ready(function() {  
	
	  App.init();
	  Login.init();


	});
</script> 
<!-- END JAVASCRIPTS -->


</body>
</html>
