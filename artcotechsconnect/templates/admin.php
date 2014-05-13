<? 
/*
*	Template Name: Admin Pages
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
	  
	get_header();

   	if($currPostName == 'users'){
		include( get_template_directory(). '/members/admin/admin-users.php' ); 
	} 
	if($currPostName == 'projects'){
		include( get_template_directory(). '/members/admin/admin-projects.php' ); 
	}
	if($currPostName == 'myerp'){
		include( get_template_directory(). '/members/admin/admin-external.php' ); 
	}
	if($currPostName == 'inifinitewp'){
		include( get_template_directory(). '/members/admin/admin-external.php' ); 
	}
	if($currPostName == 'hootsuite'){
		?> <iframe src="https://hootsuite.com/login" width="100%" height="600"></iframe>  <?
	}
	if($currPostName == 'hosting-manager'){
		?> <iframe src="https://hostingmanager.secureserver.net/Login.aspx" width="100%" height="600"></iframe>  <?
		
	}
	if($currPostName == 'domain-manager'){
		?> <iframe src="https://idp.securepaynet.net/login.aspx?SPKey=SPDCC-M1PWDCCWEB01&myaUrl=%2fdefault.aspx&prog_id=412956&domain=artcotechs.net&user=45398492" width="100%" height="600"></iframe>  <?
		
	}
?>
