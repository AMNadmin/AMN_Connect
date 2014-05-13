<? 

global $user_identity, $userInfo, $user_ID, $wp_query, $wpdb, $wpc_client, $wp_crm, $current_user;
	  $currUserInfo = get_userdata($user_ID);
	  $currPostName = $post->post_name; 
	  $currPostTitle = $post->post_title;
	  
	  if(get_the_title() == 'Sitewide Activity' || get_the_title() == 'Members'){
		  
		  include( get_template_directory(). '/templates/default.php' );
	  }
	  else {
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
<link rel="stylesheet" type="text/css" href="http://connect.artcotechs.net/wp-content/plugins/nextend-google-connect/buttons/google-btn.css?ver=3.7">
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME STYLES -->
<link href="<? bloginfo( 'template_url' ); ?>/css/style-metronic.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/style-responsive.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/plugins.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="<? bloginfo( 'template_url' ); ?>/css/login.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/custom.css" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->

<link href="<? bloginfo( 'template_url' ); ?>/css/add2home.css" rel="stylesheet">
 
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

<!-- END HEAD -->


<!-- BEGIN BODY -->
<body class="login">
    <div class="spinnerbg">
        <div id="spinner">
            <span id="first" class="ball"></span>
            <span id="second" class="ball"></span>
            <span id="third" class="ball"></span>
        </div>
    </div>

   <!-- BEGIN LOGIN -->
   <div id="login">
      <h1><a href="" title="">Artcotechs Connect</a></h1>
      
	  <?php while ( have_posts() ) : the_post(); ?>
      
      <p class="message register" id="mainHeader"><? the_title(); ?></p>
      <br>
	  <? the_content(); ?>
      
      
     <p id="nav">
      <? if($currPostName == 'resetpass') { ?>
      <a href="/wp-login.php" title="Account Access">Login</a> | <a href="/register/" title="Create an Account">Create Account</a>
      
      <? }  else { ?>
      <a href="/wp-login.php" title="Account Access">Login</a> | <a href="/resetpass/?action=lostpassword" title="Password Lost and Found">Lost Password?</a>
      
      <? } ?>
     </p> 

     <p id="backtoblog"><a href="http://connect.artcotechs.net/" title="Back to Main">← Back to Artcotechs Connect</a></p>
	 <?php endwhile; ?>
      
   </div>
   <!-- END LOGIN -->  
   
   <!-- BEGIN COPYRIGHT -->
   <div class="copyright">
       © 2013 Artcotechs Media Network <br> All Rights Reserved.
   </div>
   <script src="<? bloginfo( 'template_url' ); ?>/js/jquery-1.10.2.min.js" type="text/javascript"></script>
   <!-- END COPYRIGHT -->
   
   <!-- BEGIN CORE PLUGINS -->   
   <!--[if lt IE 9]>
   <script src="<? bloginfo( 'template_url' ); ?>/js/respond.min.js"></script>
   <script src="<? bloginfo( 'template_url' ); ?>/js/excanvas.min.js"></script> 
   <![endif]-->   
   <script src="<? bloginfo( 'template_url' ); ?>/js/main.js" type="text/javascript"></script>
   <script src="<? bloginfo( 'template_url' ); ?>/js/spinner.js" type="text/javascript"></script>
   <!-- END PAGE LEVEL SCRIPTS --> 
   
   <? wp_footer(); ?>
   <!-- END JAVASCRIPTS -->
</body>
</html>

<? } ?>



