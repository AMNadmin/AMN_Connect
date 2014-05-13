<?
/*
*	Template Name: Welcome Page
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
      $user_avatar = get_user_meta( $current_user->ID, 'user_avatar', true );
	  $google_profile_picture = get_user_meta( $current_user->ID, 'google_profile_picture', true );
	  

?>
 <!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->


<!-- BEGIN HEAD -->

<!-- BEGIN BODY -->
<head>
<meta charset="utf-8">
<title>Artcotechs Network Connect</title>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="<? bloginfo( 'template_url' ); ?>/style.css" rel="stylesheet" type="text/css">

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<? bloginfo( 'template_url' ); ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<? bloginfo( 'template_url' ); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<? bloginfo( 'template_url' ); ?>/css/uniform.default.css" rel="stylesheet" type="text/css"/>

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<? bloginfo( 'template_url' ); ?>/css/select2_metro.css">
<link rel="stylesheet" type="text/css" href="http://connect.artcotechs.net/wp-content/plugins/nextend-google-connect/buttons/google-btn.css?ver=3.7">
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME STYLES -->
<link href="<? bloginfo( 'template_url' ); ?>/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<? bloginfo( 'template_url' ); ?>/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<? bloginfo( 'template_url' ); ?>/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<? bloginfo( 'template_url' ); ?>/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<? bloginfo( 'template_url' ); ?>/css/login.css" rel="stylesheet" type="text/css"/>
<link href="<? bloginfo( 'template_url' ); ?>/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->

<link href="<? bloginfo( 'template_url' ); ?>/css/add2home.css" rel="stylesheet">

<link rel="shortcut icon" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-icon.png">


<!-- BEGIN APPLE TOUCH SPLASH ICONS -->
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-icon-57x57-blue.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-icon-114x114-blue.png">
<link rel="apple-touch-icon-precomposed" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-icon-72x72-blue.png" sizes="72x72">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-icon-144x144-blue.png">
<!-- END APPLE TOUCH SPLASH ICONS -->

<!-- BEGIN APPLE TOUCH SPLASH IMAGES -->
<link rel="apple-touch-startup-image" media="screen and (device-width: 320px)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-320x460.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 320px) and (-webkit-device-pixel-ratio: 2)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-640x920.png">


<link rel="apple-touch-startup-image" media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-320x568.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 768px) and (orientation: portrait)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-768x1004.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-1024x748.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 1536px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-1536x2008.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 1536px)  and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" href="<? bloginfo( 'template_url' ); ?>/images/splash-ios/apple-touch-startup-image-2048x1496.png">
<!-- END APPLE TOUCH SPLASH IMAGES -->



<? wp_head(); ?>
<style type="text/css">
	html {
		margin-top: 0px !important;
	}
</style>
</head>

<!-- END HEAD -->

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
   <div id="login">
   
   	<? if(!is_user_logged_in()){ ?>
      <!-- BEGIN LOGIN FORM -->
      <?php while ( have_posts() ) : the_post(); ?>
      
          <? the_content(); ?>
          
	  <?php endwhile; ?>
      <div class="account-access-wrap">

        <div class="message">
            <div class="well">
                <h4>Sign in to:</h4>
                <div class="portlet-body">
                    <ul>
                        <li>View Your Account Summary</li>
                        <li>See How Much You Owe</li>
                        <li>Make Payments</li>
                        <li>Check Your Project Status</li>
                        <li>Upload And Manage Project Files</li>
                        <li>Communicate With Artcotechs</li>
                    </ul>
                </div>
                
                <a class="btn btn-primary btn-block" href="/log-in/" title="Access your account"><i class="fa fa-key"></i> Account Access</a>
                <a class="btn btn-primary btn-block" href="/registration/" title="Create an account"><i class="fa fa-user"></i> Create Account</a>
                <a class="btn btn-primary btn-block" href="/contact/" title="Get in touch with Artcotechs"><i class="fa fa-envelope"></i> Contact Us</a>
                <a class="btn btn-primary btn-block" href="/proposal/" title="Fill out a Project Proposal"><i class="fa fa-file-text"></i> Project Proposal</a>
                <? if(wp_is_mobile()){ ?>
                <!--<a class="btn btn-primary btn-block" href="tel:17182184228" title="Call Artcotechs"><i class="fa fa-phone"></i> Call Artcotechs</a>-->
                <? } ?>
                <!--<a class="btn btn-primary btn-block" href="/google-hangout/" title="Start a Google Hangout"><i class="fa fa-google-plus"></i> Start Google Hangout</a>-->
            </div>
        </div>
	  </div>
      <!-- /.account-access-wrap -->
      
      
    <? } else { ?>
    
    <div class="account-access-wrap">
        <div class="message">
            <div class="well">
            <? if($userRole == 'administrator' || $userRole == 'super_admin') { ?>
                <div class="preview-avatar"> 
                    <? if ($user_avatar != ''){ ?>
                      <img src="http://connect.artcotechs.net/wp-content/uploads<? echo $user_avatar; ?>" class="img-responsive" alt=""> 
                    <? } else { ?>
                      <img src="<? bloginfo( 'template_url' ); ?>/images/defaults/default_avatar.jpg" class="img-responsive" alt=""> 
                    <? } ?>
                </div>
                <a href="/dashboard/" class="btn btn-primary btn-block" title="Back to Admin Dashboard"><img src="<? bloginfo( 'template_url' ); ?>/images/main/amn-manhead-icon.png" alt="User Avatar" width="18" height="18"> Connect Dashboard</a>
                <a href="/wp-admin/" class="btn btn-primary btn-block" title="Back to Wordpress Dashboard"><i class="fa fa-exchange"></i> Wordpress Dashbaord</a>
                <a href="<? echo wp_logout_url( 'http://connect.artcotechs.net' ); ?>" class="btn btn-primary btn-block" title="Log out of your account"><i class="fa fa-minus-circle"></i>  Log out</a>
                
            <? } else if($userRole == 'wpc_client') { ?>
                <div class="preview-avatar">
                    <? if ($user_avatar != ''){ ?>
                      <img src="http://connect.artcotechs.net/wp-content/uploads<? echo $user_avatar; ?>" class="img-responsive" alt=""> 
                    <? } else { ?>
                      <img src="<? bloginfo( 'template_url' ); ?>/images/defaults/default_avatar.jpg" class="img-responsive" alt=""> 
                    <? } ?>
                </div>
                <a href="/dashboard/" class="btn btn-primary btn-block" title="Back to your dashboard"><i class="fa fa-dashboard"></i> My Dashbaord</a>
                <a href="/dashboard/my-profile/" class="btn btn-primary btn-block" title="Back to your member account"><i class="fa fa-user"></i> My Profile</a>
                <a href="<? echo wp_logout_url( 'http://connect.artcotechs.net/' ); ?>" class="btn btn-primary btn-block" title="Log out of your account"><i class="fa fa-minus-circle"></i> Log out</a>
                
            <? } ?>
            </div>
        </div>
    
    </div>
    
    
    <? } ?>
    
      
      
   </div>
   <!-- END LOGIN -->  
   
   <!-- BEGIN COPYRIGHT -->
   <div class="copyright">
       © 2014 Artcotechs Media Network <br> All Rights Reserved. 
   </div>
   <script src="<? bloginfo( 'template_url' ); ?>/js/jquery-1.10.2.min.js" type="text/javascript"></script>
   <!-- END COPYRIGHT -->
   
   <!-- BEGIN CORE PLUGINS -->   
   <!--[if lt IE 9]>
   <script src="<? bloginfo( 'template_url' ); ?>/js/respond.min.js"></script>
   <script src="<? bloginfo( 'template_url' ); ?>/js/excanvas.min.js"></script> 
   <![endif]-->   
   <script src="<? bloginfo( 'template_url' ); ?>/js/main.js" type="text/javascript"></script>
   <? if(!is_user_logged_in()) { ?>
   	<script src="<? bloginfo( 'template_url' ); ?>/js/add2home.js" type="text/javascript"></script>
   <? } ?>
   <!-- END PAGE LEVEL SCRIPTS --> 
   
   <script src="<? bloginfo( 'template_url' ); ?>/js/spinner.js" type="text/javascript"></script>
   <!-- END JAVASCRIPTS -->
   
<? 
if($userRole == 'administrator' || $userRole == 'super_admin') {
	include( get_template_directory(). '/members/admin/inc/mobile-navigation.php' ); 
}
if($userRole == 'embassador') {
	include( get_template_directory(). '/members/embassador/inc/footer.php' ); 
}
if($userRole == 'wpc_client') {
	include( get_template_directory(). '/members/client/inc/mobile-navigation.php' ); 
}
if($userRole == 'subscriber') {
	include( get_template_directory(). '/members/guest/inc/guest-footer.php' ); 
}
?>
</body>
</html>

