<?
/*
*	Template Name: Member Login Page
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
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<!-- BEGIN HEAD -->

<!-- BEGIN BODY -->
<head>
<meta charset="utf-8">
<title>Artcotechs Network Connect</title>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="<? bloginfo( 'template_url' ); ?>/style.css" rel="stylesheet" type="text/css">

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<? bloginfo( 'template_url' ); ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/uniform.default.css" rel="stylesheet" type="text/css">

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<? bloginfo( 'template_url' ); ?>/css/select2_metro.css">
<link rel="stylesheet" type="text/css" href="<? bloginfo( 'template_url' ); ?>/css/select2-metronic.css">
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME STYLES -->
<link href="<? bloginfo( 'template_url' ); ?>/css/style-metronic.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/style-responsive.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/style.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/plugins.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="<? bloginfo( 'template_url' ); ?>/css/login.css" rel="stylesheet" type="text/css">
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

<!-- BEGIN LOGO -->
<div class="logo"> <img src="<? bloginfo( 'siteurl' ); ?>/wp-content/uploads/2014/01/amn-logo.png" alt=""/> </div>
<!-- END LOGO --> 

<!-- BEGIN LOGIN -->
<?php while ( have_posts() ) : the_post(); ?>
<div <? post_class('content well'); ?> id="access-content"> 
  
  
      
          <? the_content(); ?>

</div>
<? endwhile; ?>
<!-- END LOGIN --> 

<p id="nav">
<? if($currPostName == 'registration' ) { ?>
	<a href="/log-in/" title="Log in to your Account">Log In</a> | <a href="/resetpass/?action=lostpassword" title="Password Lost and Found">Lost Password?</a>

<? } else if($currPostName == 'resetpass' ) { ?>
	<a href="/log-in/" title="Log in to your Account">Log In</a> | <a href="/registration/" title="Create an Account">Create Account</a>

<? } else  if($currPostName == 'proposal') { ?>
	<a href="/log-in/" title="Log in to your Account">Log In</a> | <a href="/registration/" title="Create an Account">Create Account</a>
    <? } else  if($currPostName == 'contact') { ?>
	<a href="/registration/" title="Create an Account">Create Account</a> | <a href="/proposal/" title="Send a Project Proposal">Project Proposal</a>
<? } else { ?>
	<a href="/registration/" title="Create an Account">Create Account</a> | <a href="/contact/" title="Get In Touch">Contact Us</a>
<? } ?>
</p>
<p id="backtoblog"><a href="http://connect.artcotechs.net/" title="Back to Main">← Back to Artcotechs Connect</a></p>


<!-- BEGIN COPYRIGHT -->
<div class="copyright"> © 2013 Artcotechs Media Network <br>
  All Rights Reserved. </div>
  
 
<? 
if($userRole == 'administrator' || $userRole == 'super_admin') {
	include( get_template_directory(). '/members/admin/inc/footer.php' ); 
}
else if($userRole == 'embassador') {
	include( get_template_directory(). '/members/embassador/inc/footer.php' ); 
}
else if($userRole == 'wpc_client') {
	include( get_template_directory(). '/members/client/inc/footer.php' ); 
}
else if($userRole == 'subscriber') {
	include( get_template_directory(). '/members/guest/inc/guest-footer.php' ); 
}
 else { 
	 include( get_template_directory(). '/members/guest/inc/guest-footer.php' );
 } ?>

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
<script src="<? bloginfo( 'template_url' ); ?>/js/select2.min.js" type="text/javascript"></script> 
<!-- END PAGE LEVEL PLUGINS --> 

<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<script src="<? bloginfo( 'template_url' ); ?>/js/main.js" type="text/javascript"></script>
<script src="<? bloginfo( 'template_url' ); ?>/js/app.js" type="text/javascript"></script>  
<script src="<? bloginfo( 'template_url' ); ?>/js/amn-scripts.js" type="text/javascript"></script>  
<!--<script src="<? bloginfo( 'template_url' ); ?>/js/login.js" type="text/javascript"></script> -->
<script src="<? bloginfo( 'template_url' ); ?>/js/spinner.js" type="text/javascript"></script> 
<!-- END PAGE LEVEL SCRIPTS --> 

<script>
	$(document).ready(function() {    
			$('#register-btn').click(function () {
	            $('.login-form').hide();
	            $('.register-form').show();
	        });

	        $('#register-back-btn').click(function () {
	            $('.login-form').show();
	            $('.register-form').hide();
	        }); 
			$('#recaptcha_image').css('width', '100%');
			$('#recaptcha_area').css('margin-bottom', '20px');
	  App.init();

	});
</script> 
<!-- END JAVASCRIPTS -->


</body>
</html>
