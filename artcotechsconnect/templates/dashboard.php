<? 
/*
*	Template Name: Dashboard
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

   	if($userRole == 'wpc_client'){
		include( get_template_directory(). '/members/client/client-dashboard.php' ); 
		
	} else if($userRole == 'administrator' || $userRole == 'super_admin'){
		include( get_template_directory(). '/members/admin/admin-dashboard.php' ); 
	}
?>
