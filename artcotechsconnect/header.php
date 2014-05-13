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
<?php wp_head(); ?>


<!-- BEGIN GLOBAL MANDATORY STYLES -->          
<link href="<? bloginfo( 'template_url' ); ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<? bloginfo( 'template_url' ); ?>/css/uniform.default.css" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<script type="text/javascript">
  	var site_url = "<? bloginfo( 'siteurl' ); ?>/";
</script>
<?
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

