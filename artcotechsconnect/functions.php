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

	  /* USER PROFILE INFORMATION
	  ============================================*/
      $user_avatar = get_user_meta( $current_user->ID, 'user_avatar', true );
      $user_name = get_user_meta( $current_user->ID, 'user_login', true );
      $first_name = get_user_meta( $current_user->ID, 'first_name', true );
      $last_name = get_user_meta( $current_user->ID, 'last_name', true );
      $website = get_user_meta( $current_user->ID, 'website', true );
      $email = get_user_meta( $current_user->ID, 'user_email', true );
      $nickname = get_user_meta( $current_user->ID, 'nickname', true );
      $display_name = get_user_meta( $current_user->ID, 'display_name', true );
      $user_avatar = get_user_meta( $current_user->ID, 'user_avatar', true );
      $member_credits = get_user_meta( $current_user->ID, 'member_credits', true );
	  $registered = ($user_info->user_registered . "\n");
	  $registered = date("n/j/Y", strtotime($registered));
	  

/* CREATE PROJECTS FOR ALL USERS WITHOUT ONE
============================================*/
/*$blogusers = get_users();
foreach($blogusers as $curr_user) {
	if($curr_user->project_id1 == '') {
		$new_project_name = $curr_user->user_login . '\'s Temporary Project' ;
		// Create post object
		$new_post = array(
		  'post_type'	  => 'client_projects',
		  'post_title'    => $new_project_name,
		  'post_content'  => '',
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		);
		
		// Insert the post into the database
		wp_insert_post( $new_post );
		$new_post_id = wp_insert_post( $new_post );
		update_user_meta($curr_user->ID, 'project_id1', $new_post_id);
		update_user_meta($curr_user->ID, 'project_link1', get_permalink($new_post_id));
	}
}*/
	  
/******************************************************************************************************************************************************************************************/
/******************************************************************************************************************************************************************************************/
/*		POST TYPE REGISTRATION		
/******************************************************************************************************************************************************************************************/
/******************************************************************************************************************************************************************************************/
function tasks_post_type_init() {
	$labels = array(
		'name' => _x('Tasks', 'post type general name'),
		'singular_name' => _x('Task', 'post type singular name'),
		'add_new' => _x('Add New', 'Project'),
		'add_new_item' => __('Add New Task'),
		'edit_item' => __('Edit Task'),
		'new_item' => __('New Task'),
    	'all_items'          => 'All Tasks',
		'view_item' => __('View Task'),
		'search_items' => __('Search Tasks'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_template_directory_uri() . '/images/main/amn-manhead-icon.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','comments', 'thumbnail')
	  ); 
  
	register_post_type( 'tasks' , $args );
}
add_action( 'init', 'tasks_post_type_init' );
add_action('admin_init', 'tasks_admin_init');
 
function tasks_admin_init(){
	global $post;
	$custom = get_post_custom($post->ID);	
	$twenty_percent_title = $custom["twenty_percent_title"][0];
  add_meta_box("assign_task_status","Task Status", "assign_task_status","tasks","normal","low"); 
  add_meta_box("task_subject","Task Subject", "task_subject","tasks","normal","low"); 
  add_meta_box("assign_task_meta", "Attach Task", "assign_task_meta", "tasks", "normal", "low");
  add_meta_box("email_task", "Email Task", "email_task", "tasks", "normal", "low");
  add_meta_box("attach_files", "Attach Files", "attach_files", "tasks", "normal", "low");
  
  
  add_post_meta($post->ID, 'attachments', '');
}

function tasks_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "task_name" => "Task Name",
    "task_description" => "Description",
    "project_assigned_to" => "Project Assigned To",
    "users_assigned_to" => "Users Assigned To",
	"task_due_date" => "Completion Date",
	"task_status" => "Status",
  );
 
  return $columns;
}

function tasks_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "task_name":
	  echo '<a href="'.get_site_url().'/wp-admin/post.php?post='.$post->ID.'&action=edit" title="Edit ' . get_the_title($post->ID) . '">' . get_the_title($post->ID) . '</a>';
      break;
    case "task_description":
      $custom = get_post_custom();
	  if($custom["task_description"][0] == ''){
		echo 'N/A';
	  }
	  else {
	  echo $custom["task_description"][0];
	  }
      break;
	case "project_assigned_to":
      $custom = get_post_custom();
	  if($custom["project_assigned_to"][0] == ''){
		echo 'N/A';
	  }
	  else {
	  	echo get_the_title($custom["project_assigned_to"][0]);;
	  }
      break;
	case "users_assigned_to":
      $custom = get_post_custom();
	  if($custom["users_assigned_to"][0] == NULL){
		echo 'No Assignees';
	  }
	  else {
		  $users_count = sizeof($custom["users_assigned_to"][0]);
		  $users_array = array();
		  $users_array = get_post_meta($post->ID, 'users_assigned_to', true);
		  //print_r($users_array);
		  for ($x=0; $x<=10; $x++) {
			$full_name = '';
			$firstName = get_user_meta($users_array[$x], 'first_name', true);  
			$lastName = get_user_meta($users_array[$x], 'last_name', true); 
			$full_name .= $firstName . ' ' . $lastName;   
		 	echo '<div>' . $full_name . '</div>';
		  }
	  }
      break;
	case "task_due_date":
		$custom = get_post_custom();
	  if($custom["task_due_date"][0] == ''){
		echo 'N/A';
	  }
	  else {
		echo $custom["task_due_date"][0];
	  }
		break;
	case "task_status":
		$custom = get_post_custom();
	  if($custom["task_status"][0] == ''){
		echo 'Not Started';
	  }
	  else {
		echo $custom["task_status"][0];
	  }
		break;
  }
}

add_action("manage_posts_custom_column",  "tasks_custom_columns");
add_filter("manage_edit-tasks_columns", "tasks_edit_columns");


function assign_task_status() { 
?>
    <div class="clearfix">
        <label for="task_status">Task Status</label>
    	<input type="radio" name="task_status" placeholder="Task Status" />
    </div>	
<?
}
function task_subject() { 
	$task_subject = $custom["task_subject"][0];
?>
    <div class="clearfix">
        <label for="task_subject">Task Subject</label>
    	<input type="text" name="task_subject" placeholder="Task Subject" />
    </div>	
 <? }
 
function assign_task_meta() {
	$project_assigned_to = $custom["project_assigned_to"][0];
	$users_assigned_to = $custom["users_assigned_to"][0];
	$task_status = $custom["task_status"][0];
	
	$projects_Query = new WP_Query('post_type=client_projects');
	
	?>
    <div class="clearfix">
        <label for="project_assigned_to">Assign To Project</label>
        <select name="project_assigned_to" id="project_assign">
            <option value="">Attach task to a project..</option>
         <? while ( $projects_Query->have_posts() ) : $projects_Query->the_post(); ?>
            <option value="<? the_ID(); ?>"<? if($project_assigned_to == get_the_ID()){ echo ' selected'; } ?>><? the_title(); ?></option>
        <? endwhile ?>
        </select>
    </div>
    <div class="clearfix">
        <label for="users_assigned_to">Assign To Member</label>
        <select name="users_assigned_to" id="users_assign">
            <option value="">Assign task to a member..</option>
         <? $blogusers = get_users();
			foreach ($blogusers as $user) {  ?>
            <option value="<? echo $user->ID; ?>"<? if($users_assigned_to == $user->ID){ echo ' selected'; } ?>><? echo $user->display_name; ?></option>
            <? } ?>
        </select>
    </div>
    <div class="clearfix">
    
    </div>
	
<? 
}
function email_task() {
	$all_users = get_users();
	$user_email_to = $custom["user_email_to"][0];
	?>
    <div>
    <select id="email_to" name="user_email_to">
    	<option value="">Email note to a user...</option>
    <? foreach ($all_users as $user) { 
		if($user->user_email != '') {
	?>
		<option data-emailaddress="<? echo $user->user_email; ?>" value="<? echo $user->ID; ?>"<? if($user_email_to == $user->ID){ echo ' selected'; } ?>><? echo $user->display_name; ?></option>
	<? 		} 
		}
	?>
    </select>
    </div>
    <?
	
}
function attach_files(){
	?>
    	<div><input type="file" name="file_attachments"></div>
    <?
}
/******************************************************************************************************************************************************************************************/
/******************************************************************************************************************************************************************************************/
/******************************************************************************************************************************************************************************************/
/******************************************************************************************************************************************************************************************/
/******************************************************************************************************************************************************************************************/


/****************************************************/  
if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'before_widget' => '',
			'name' => 'Sidebar 1',
			'id' => 'sbar1',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => '',
		));
		register_sidebar(array(
			'before_widget' => '',
			'name' => 'Sidebar 2',
			'id' => 'sbar2',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => '',
		));
		register_sidebar(array(
			'before_widget' => '',
			'name' => 'Sidebar 3',
			'id' => 'sbar3',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => '',
		));
		register_sidebar(array(
			'before_widget' => '',
			'name' => 'Sidebar 4',
			'id' => 'sbar4',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'before_widget' => '',
			'name' => 'Sidebar 5',
			'id' => 'sbar5',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'before_widget' => '',
			'name' => 'Sidebar 6',
			'id' => 'sbar6',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'before_widget' => '',
			'name' => 'Sidebar 7',
			'id' => 'sbar7',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'before_widget' => '',
			'name' => 'Sidebar 8',
			'id' => 'sbar8',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
	}
	

	add_theme_support( 'post-thumbnails' ); 
	
	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image' ) );
	
	// add post-formats to post_type 'page'
	add_post_type_support( 'page', 'post-formats' );
	
class ConnectMenu {
  
  function ConnectMenu()
  {
      add_action( 'admin_bar_menu', array( $this, "Connect_links" ) );
  }

  /**
   * Add's new global menu, if $href is false menu is added but registred as submenuable
   *
   * $name String
   * $id String
   * $href Bool/String
   *
   * @return void
   * @author Janez Troha
   * @author Aaron Ware
   **/

  function add_root_menu($name, $id, $href = FALSE)
  {
    global $wp_admin_bar;
    if ( !is_super_admin() || !is_admin_bar_showing() )
        return;

    $wp_admin_bar->add_menu( array(
        'id'   => $id,
        'meta' => array(),
        'title' => $name,
        'href' => $href ) );
  }

  /**
   * Add's new submenu where additinal $meta specifies class, id, target or onclick parameters
   *
   * $name String
   * $link String
   * $root_menu String
   * $id String
   * $meta Array
   *
   * @return void
   * @author Janez Troha
   **/
  function add_sub_menu($name, $link, $root_menu, $id, $meta = FALSE)
  {
      global $wp_admin_bar;
      if ( ! is_super_admin() || ! is_admin_bar_showing() )
          return;
    
      $wp_admin_bar->add_menu( array(
          'parent' => $root_menu,
          'id' => $id,
          'title' => $name,
          'href' => $link,
          'meta' => $meta
      ) );
  }

  
/*
 * This theme uses a custom image size for featured images, displayed on
 * "standard" posts and pages.
 */
   function connect_links() {
      global $wp_admin_bar, $user_ID;
	  $currUserProperty = new WP_User( $user_ID ); 
	  $userRole = '';
	  if ( !empty( $currUserProperty->roles ) && is_array( $currUserProperty->roles ) ) { 
		foreach ( $currUserProperty->roles as $role )
			$userRole = $role; 
	  }  
	  
	$parentLink = '';
    $window_width = 'window.screen.width';
    $window_height = 'window.screen.height';


    //If you need the screen dimensions of the user (as the server)
    //You would need to use a bidirectional communication framework such as ajax
    //Or send something like a separate post request to the webserver.

	if(wp_is_mobile()) { 
		$parentLink = 'site-name'; 
		$wp_admin_bar->remove_menu('themes');
		$wp_admin_bar->remove_menu('customize');
		$wp_admin_bar->remove_menu('widgets');
		$wp_admin_bar->remove_menu('menus');
	}
	else { 
		$parentLink = 'wp-logo';
		$wp_admin_bar->remove_menu('dashboard');
		$wp_admin_bar->remove_menu('appearance');
		$wp_admin_bar->remove_menu('themes');
		$wp_admin_bar->remove_menu('customize');
		$wp_admin_bar->remove_menu('view-site');
		$wp_admin_bar->remove_menu('edit');
		
		$wp_admin_bar->remove_menu('about');
		$wp_admin_bar->remove_menu('wporg');
		$wp_admin_bar->remove_menu('documentation');
	}
	
    echo '<script type="text/javascript">';

    echo '	$(document).ready(function(){
				var screenW = $(window).width();
				if(screenW < 783) { ';
					$parentLink = 'site-name'; 
					$wp_admin_bar->remove_menu('themes');
					$wp_admin_bar->remove_menu('customize');
					$wp_admin_bar->remove_menu('widgets');
					$wp_admin_bar->remove_menu('menus');
	echo '		} '; 
	echo '		else {  '; 
					$parentLink = 'wp-logo';
					$wp_admin_bar->remove_menu('dashboard');
					$wp_admin_bar->remove_menu('appearance');
					$wp_admin_bar->remove_menu('themes');
					$wp_admin_bar->remove_menu('customize');
					$wp_admin_bar->remove_menu('view-site');
					$wp_admin_bar->remove_menu('edit');
					
					$wp_admin_bar->remove_menu('about');
					$wp_admin_bar->remove_menu('wporg');
					$wp_admin_bar->remove_menu('documentation');
	
	echo '		} '; 
	echo '
			});  '; 
	
	
	echo	'
    	</script>';
	
	if($userRole == 'administrator' || $userRole == 'super_admin') {
		
		$wp_admin_bar->add_menu(array(
			'parent' => $parentLink,
			'id' => 'amn-1',
			'title' => __('Connect Dashboard'),
			'href' => "http://connect.artcotechs.net/dashboard/")
		);
		
		$wp_admin_bar->add_menu(array(
			'parent' => $parentLink,
			'id' => 'amn-2',
			'title' => __('Network Users'),
			'href' => "#")
		);
		$wp_admin_bar->add_menu(array(
			'parent' => 'amn-2',
			'id' => 'amn-2.1',
			'title' => __('All Users'),
			'href' => "http://connect.artcotechs.net/wp-admin/users.php")
		);
		$wp_admin_bar->add_menu(array(
			'parent' => 'amn-2',
			'id' => 'amn-2.2',
			'title' => __('New User'),
			'href' => "http://connect.artcotechs.net/wp-admin/user-new.php")
		);
		
		
		$wp_admin_bar->add_menu(array(
			'parent' => $parentLink,
			'id' => 'amn-3',
			'title' => __('Client Projects'),
			'href' => "#")
		);
		$wp_admin_bar->add_menu(array(
			'parent' => 'amn-3',
			'id' => 'amn-3.1',
			'title' => __('All Projects'),
			'href' => "http://connect.artcotechs.net/wp-admin/edit.php?post_type=client_projects")
		);
		$wp_admin_bar->add_menu(array(
			'parent' => 'amn-3',
			'id' => 'amn-3.2',
			'title' => __('New Project'),
			'href' => "http://connect.artcotechs.net/wp-admin/post-new.php?post_type=client_projects")
		);
		
		
		$wp_admin_bar->add_menu(array(
			'parent' => $parentLink,
			'id' => 'amn-4',
			'title' => __('Client Invoices'),
			'href' => "#")
		);
		$wp_admin_bar->add_menu(array(
			'parent' => 'amn-4',
			'id' => 'amn-4.1',
			'title' => __('All Invoices'),
			'href' => "http://connect.artcotechs.net/wp-admin/admin.php?page=wpi_main")
		);
		$wp_admin_bar->add_menu(array(
			'parent' => 'amn-4',
			'id' => 'amn-4.2',
			'title' => __('New Invoice'),
			'href' => "http://connect.artcotechs.net/wp-admin/admin.php?page=wpi_page_manage_invoice")
		);
		
		$wp_admin_bar->add_menu(array(
			'parent' => $parentLink,
			'id' => 'amn-5',
			'title' => __('Network Events / Calender'),
			'href' => "#")
		);
		$wp_admin_bar->add_menu(array(
			'parent' => 'amn-5',
			'id' => 'amn-5.1',
			'title' => __('All Events'),
			'href' => "http://connect.artcotechs.net/wp-admin/edit.php?post_type=ai1ec_event")
		);
		$wp_admin_bar->add_menu(array(
			'parent' => 'amn-5',
			'id' => 'amn-5.2',
			'title' => __('New Event'),
			'href' => "http://connect.artcotechs.net/wp-admin/post-new.php?post_type=ai1ec_event")
		);
		
		$wp_admin_bar->add_menu(array(
			'parent' => $parentLink,
			'id' => 'amn-6',
			'title' => __('Network Messaging'),
			'href' => "#")
		);
		$wp_admin_bar->add_menu(array(
			'parent' => 'amn-6',
			'id' => 'amn-6.1',
			'title' => __('Private Messages'),
			'href' => "http://connect.artcotechs.net/wp-admin/admin.php?page=wpclients_messages")
		);
		$wp_admin_bar->add_menu(array(
			'parent' => 'amn-6',
			'id' => 'amn-6.2',
			'title' => __('Project Messages'),
			'href' => "http://connect.artcotechs.net/wp-admin/edit-comments.php")
		);
		
		$wp_admin_bar->add_menu(array(
			'parent' => $parentLink,
			'id' => 'amn-7',
			'title' => __('Client Support Tickets'),
			'href' => "http://connect.artcotechs.net/wp-admin/admin.php?page=wpscSupportTickets-admin")
		);
		
		$wp_admin_bar->add_menu(array(
			'parent' => $parentLink,
			'id' => 'amn-8',
			'title' => __('File Sharing'),
			'href' => "http://connect.artcotechs.net/wp-admin/admin.php?page=wpclients_files")
		);
		
		

	}
	
  }
  

}
add_action( "init", "ConnectMenuInit" );
function ConnectMenuInit() {
    global $ConnectMenu;
    $ConnectMenu = new ConnectMenu();
}



add_action( 'admin_menu', 'register_my_custom_menu_page' );

function register_my_custom_menu_page(){
    add_menu_page( 'Connect Hub', 'AMN Connect', 'manage_options', '../dashboard/', '', plugins_url( '/admin-infusion/images/amn-manhead-icon.png' ), 1 );
}



/*	DISPLAY THEME ADMIN FUNCTIONS
==================================================================*/
include(get_template_directory().'/members/admin/inc/admin-functions.php');

/*	DISPLAY THEME EMBASSADOR FUNCTIONS
==================================================================*/
include(get_template_directory().'/members/embassador/inc/embassador-functions.php');

/*	DISPLAY THEME CLIENT FUNCTIONS
==================================================================*/
include(get_template_directory().'/members/client/inc/client-functions.php');




/*	Default Comment List View 
==================================================================*/
function mytheme_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<? if(isset($comment)) { ?>
        <li class="in" id="comment-id-<? echo get_comment_id(); ?>">
            <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
            <div class="message">
                <span class="arrow"></span>
                <span class="datetime"><? printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' ); ?></span><br />
                <a href="#" class="name"><?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?></a>
                <p>
                    <span class="body">
                    	<? if(get_comment_subject() != '') { ?><div class="subject"><strong>Subject:</strong> <? echo get_comment_subject(); ?></div><? } ?>
                        <?php comment_text() ?>
                        <div class="reply">
						<a href="/messaging/?pID=<? the_ID(); ?>&replytocom=<? echo get_comment_id(); ?>" class="btn btn btn-sm blue" id="replyto-link-<? echo get_comment_id(); ?>" title="Reply to <? comment_author(); ?>'s comment"><i class="fa fa-reply"></i> </a>
                        <?php //comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        </div>
                        
                    </span>
                </p>
            </div>
        </li>
		<? }
		else { ?>
        <li class="in" id="comment-id">
			<h2>No Recent Messages</h2>
        </li>
		<? } ?>
		
<?php
        }


/*	Has Comment Images
 ========================================================================*/ 
function has_comment_images( $comments ) {
		$hasImages = false;
		if( count( $comments ) > 0 ) {
			foreach( $comments as $comment ) {
				if( true == get_comment_meta( $comment->comment_ID, 'comment_image' ) ) {
					$hasImages = true;
				}
			}
		}
		return $hasImages;
}

/*	Get Current Page URL
 ========================================================================*/ 
function current_page_url() {
	$pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
}


/*	Display Modal Comment Images
 ========================================================================*/ 
function modal_comment_images( $comments, $userID ) {
	
		// Make sure that there are comments
		if( count( $comments ) > 0 ) {
			$html = '';
			$html .= '<div class="wrapper" id="imagesModalThreadWrapper">';
			$html .= '<div class="scroller">';
			$html .= '<ul class="chats">';
			// Loop through each comment...
			foreach( $comments as $comment ) {

				// ...and if the comment has a comment image...
				if( true == get_comment_meta( $comment->comment_ID, 'comment_image' ) ) {

					// ...get the comment image meta
					$comment_image = get_comment_meta( $comment->comment_ID, 'comment_image', true );
					$html .= '<li class="in">';
                    $html .=  get_avatar( $comment, $args['avatar_size'] );
					$html .= '<div class="message">
								<span class="arrow">
								</span>';

                	$html .= '	<div class="clearfix">';
					$html .= '		<span class="datetime">On '.$comment->comment_date.'</span>'; 
					$html .= '		<a href="#" class="name"><cite class="fn"></cite></a>';
					$html .= '		<a href="'.$comment->comment_author_url.'" rel="external nofollow" class="url"> '.$comment->comment_author.'</a>';
					$html .= '		<span class="says"> uploaded:</span>';
					$html .= '	</div>';
					 
					$html .= '	<div class="clearfix comment-image">';
					$html .= '		<img src="' . $comment_image['url'] . '" alt="" /><br />';
					$html .= '	</div><!-- /.comment-image -->';
					
					$html .= '</div>';
					$html .= '</li>';

				} // end if

			} // end foreach
			$html .= '</ul>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '';

		} // end if

		echo $html;

} 
	

/*	Quick Reply to Comment View 
==================================================================*/
function quick_replytocom($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<? if(get_comment_id() == $_GET['replytocom']) { ?>
                    <li class="in comment-block" id="comment-id-<? echo get_comment_id(); ?>">
                        <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                        <div class="message">
                            <span class="arrow"></span>
                            <span class="datetime"><? printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' ); ?></span><br />
                            <a href="#" class="name"><?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?></a>
                            <p>
                                <span class="body">
                                    <?php comment_text() ?>
                                    <div class="clearfix reply">
                                    <a href="#" class="btn btn btn-sm red"><i class="fa fa-reply"></i> Cancel </a>
                                    <?php //comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                                    </div>
                                    
                                </span>
                            </p>
                        </div>
                    </li>
        <? } ?>
        
<?php
}




/* //////////////////////////////////////////////////////////////////////////
**		Determine if the current post has any uploaded images
**		Return true or false indicating the result.
** /////////////////////////////////////////////////////////////////////////*/
function comment_has_images($post_id) {
	// Get the comments for the current post.
	$args = array(
		'post_id' => $post_id
	);
	$comments = get_comments( $args );
	
	// Look at each of the comments to determine if there's at least one comment image
	$has_comment_images = false;
	foreach( $comments as $comment ) {
	
		// If the comment meta indicates there's a comment image and we've not yet indicated that it does...
		if( 0 != get_comment_meta( $comment->comment_ID, 'comment_image', true ) && ! $has_comment_images ) {
	
			// Mark that we've discovered at least one comment image
			$has_comment_images = true;
	
		} // end if
	
	} 
	return $has_comment_images;
	
} 
// END comment_has_images()


/* //////////////////////////////////////////////////////////////////////////
**		Get the Artcotechs messaging form based on the post_id
**		Return HTML with post specific form
** /////////////////////////////////////////////////////////////////////////*/
function amn_messaging_form($the_id, $redirect_url, $comment_parent) {
	
	if(!isset($comment_parent) || $comment_parent == ''){ $comment_parent = '0'; }
	
	// If the user is logged in
	$user = wp_get_current_user();
	if ( $user->exists() ) {
		if ( empty( $user->display_name ) )
			$user->display_name=$user->user_login;
		$comment_author       = wp_slash( $user->display_name );
		$comment_author_email = wp_slash( $user->user_email );
		$comment_author_url   = wp_slash( $user->user_url );
		
	}
	echo '<form action="'.get_site_url().'/wp-comments-post.php" method="post" data-formkey="'.$the_id.'" id="comment-form-'.$the_id.'" class="comment-form" enctype="multipart/form-data">  
	  <input type="hidden" name="formkey" class="formkey" value="'.$the_id.'">            
      <div class="chat-form amn-chat-form">
          <div class="clearfix input-cont input-icon right"><i class="fa fa-pencil"></i><input type="text" name="comment_subject" class="form-control comment_subject" placeholder="Subject:"></div>
          <div class="clearfix input-cont input-icon right">   
              <i class="fa fa-edit" id="picture-upload-icon" title="Upload an image with your message."></i>
			  <textarea class="form-control comment_content" cols="8" id="comment_content_'.$the_id.'" name="comment" placeholder="Type a message here..."></textarea>
          </div>
      </div>
      <div class="form-submit" id="comment_image_form_submit_'.$the_id.'">
          <div class="row">
              <div class="col-md-12">
                  <div class="row block form-action-btns">
                      <input type="hidden" name="action" value="new-comment">
                      <input type="hidden" name="author" value="'.$comment_author.'">
                      <input type="hidden" name="email" value="'.$comment_author_email.'">
                      <input type="hidden" name="url" value="'.$comment_author_url.'">
                      <input type="hidden" name="comment_post_ID" value="'.$the_id.'" class="comment_post_ID" id="comment_post_ID_'.$the_id.'">
                      <input type="hidden" name="comment_parent" class="comment_parent" id="comment_parent_'.$the_id.'" value="'.$comment_parent.'">';
	if(isset($redirect_url) && $redirect_url != '') { 
		echo '		  <input type="hidden" name="redirecturl" class="redirecturl" id="redirecturl_'.$the_id.'" value="'.$redirect_url.'">';
	}
	else {
		echo '		  <input type="hidden" name="redirecturl" class="redirecturl" id="redirecturl_'.$the_id.'" value="http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"].'">';
	}
	echo '			  <div class="col-md-6 left-form-btns pull-left">';
						if(comment_has_images($the_id) == true){
	echo '				<a href="#comment-images-modal-'.$the_id.'" data-commentpostid="'.$the_id.'" data-toggle="modal" title="View all images in thread." class="btn btn-sm dark" id="comment_images_modal_btn_'.$the_id.'"><i class="fa fa-picture-o"></i></a>';
						}
    echo '	           	<a href="#picture-upload-'.$the_id.'" data-commentpostid="'.$the_id.'" data-toggle="modal" title="Upload an image with your message." class="btn btn-sm btn-primary" id="comment_image_attach_btn_'.$the_id.'"><i class="fa fa-upload"></i></a> 
                      	<a class="btn btn-sm red comment_image_delete" id="comment_image_delete_'.$the_id.'" title="Delete attached image" data-commentpostid="'.$the_id.'" style="display: none;"><i class="fa fa-minus"></i></a>
					  </div>
					  <div class="col-md-6 right-form-btns">
                      	<button name="submit" class="btn btn-sm green amn-submit-button pull-right" type="submit" id="submit" value="Send Message" title="Send message"><i class="fa fa-share"></i> Send</button>
					  </div>
                  </div>
				  <div class="current_selected_image" id="comment_image_name_'.$the_id.'">
					  <img src="'.get_template_directory_uri().'/images/main/ajax-loading.gif" style="display: none;" width="20" height="20" alt="">
					  <span class="label label-warning" style="display: none;"></span>
				  </div>
              </div>
          </div>
          <!-- /.row -->
      </div>
      <!-- /.form-submit -->
      
      <!-- START COMMENT IMAGE MODAL -->
      <div class="modal fade in new-comment-image-modal" id="picture-upload-'.$the_id.'" tabindex="-1" role="basic" aria-hidden="false" style="">
		  <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			  <h4 class="modal-title">Upload Picture</h4>
		  </div>
		  <div class="modal-body modal-body-picture" id="modal-body-picture-'.$the_id.'">
			  <div class="comment-image-wrapper">
				  <div class="row">
						<div class="col-md-12">
						  <label for="comment_image_'.$the_id.'">Select an image for your message (GIF, PNG, JPG, JPEG):</label>
						</div>
						<div class="col-md-12">
							<div class="clearfix"><p><input type="file" id="comment_image_'.$the_id.'" data-commentpostid="'.$the_id.'" class="btn btn-primary comment_image" name="comment_image_'.$the_id.'"></p></div>
						</div>
						<div class="col-md-12">
							<div class="clearfix current_selected_image">
								<div class="label label-warning" id="current_comment_image_'.$the_id.'" style="display:none;"></div>
							</div>
						</div>
				  </div>
			  </div>	
			  <!-- #comment-image-wrapper -->	
		  </div>  
		  <!-- /.modal-body --> 
		  
		  <div class="modal-footer">
			  <button type="button" class="btn blue picture-save-btn" data-commentpostid="'.$the_id.'" data-dismiss="modal" id="picture-save-btn-'.$the_id.'">Save</button>
			  <button type="button" class="btn red picture-delete-btn" data-commentpostid="'.$the_id.'" id="picture-delete-btn-'.$the_id.'">Delete</button>
			  <button type="button" class="btn default picture-cancel-btn" data-commentpostid="'.$the_id.'" data-dismiss="modal" id="picture-cancel-btn-'.$the_id.'">Cancel</button>
		  </div>	
      </div>
      <!-- END COMMENT IMAGE MODAL -->
    </form>';
	amn_show_images_modal($the_id);
} 
// END amn_messaging_form()


/* //////////////////////////////////////////////////////////////////////////
**		Get the Artcotechs images thread from post based on the post_id
**		Return HTML with post specific imgaes thread
** /////////////////////////////////////////////////////////////////////////*/
function amn_show_images_modal($post_id) {
	if(comment_has_images($post_id) == true){
	
	
	echo '<!-- START COMMENT IMAGES THREAD MODAL -->
      	<div class="modal fade modal-scroll" id="comment-images-modal-'.$post_id.'" tabindex="-1" data-replace="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Images Thread</h4>
			</div>
			<div class="modal-body images-thread-body" id="images-thread-body-'.$post_id.'">
				<div class="row">';
			  
				  // Loop through each comment...
				  foreach( get_comments($post_id) as $comment ) {
						  $d = "l, F jS, Y";
						  $comment_date = get_comment_date( $d, $comment->comment_ID );
						  $comment_image = get_comment_meta( $comment->comment_ID, 'comment_image' );
	  
						  
						  if( true == get_comment_meta( $comment->comment_ID, 'comment_image' ) && $comment->comment_post_ID == $post_id ) {
							  // ...get the comment image meta
							  $comment_image = get_comment_meta( $comment->comment_ID, 'comment_image', true );
							  echo '	<div class="col-sm-6 col-md-3 col-sm-6 well">';
							  echo '	<h4>'.$comment->comment_author.'</h4>';
							  echo '	<h6>'.$comment_date.'</h6>';
							  echo '		<div class="thumbnail thread-images"><img src="' . $comment_image['url'] . '" alt="" class="img-responsive" /></div>';
							  echo '	</div><!-- /.comment-image -->';
						  }
						  
				  } // end foreach
				  
				
	echo '		</div>
			</div>  
			<!-- /.modal-body --> 
			
			<div class="modal-footer">
				<button type="button" class="btn default picture-cancel-btn" data-commentpostid="'.$post_id.'" data-dismiss="modal" id="picture-cancel-btn-'.$post_id.'">Close</button>
			</div>		
      </div>
      <!-- END COMMENT IMAGES THREAD MODAL -->';
	  
	}
} 
// END amn_show_images_modal()


/* //////////////////////////////////////////////////////////////////////////
**		Get the Artcotechs messaging thread from post based on the post_id
**		Return Action Modals - [ Reply, Delete ]
** /////////////////////////////////////////////////////////////////////////*/
function show_messaging_action_modals($post_id) {
		
	$args = 'post_id=' . $post_id;
	$comments = get_comments($args);
	
	// If the user is logged in
	$user = wp_get_current_user();
	if ( $user->exists() ) {
		$current_user_ID = $user->ID;
	}	
	
	
	if(isset($comments)) {	
		foreach($comments as $comment){
			$comment_image = get_comment_meta( $comment->comment_ID, 'comment_image', true );
			echo '<!-- START MESSAGE REPLY MODAL -->
				<div class="modal fade modal-scroll" id="reply-modal-pane-'.$comment->comment_ID.'" tabindex="-1" data-replace="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Reply to Message</h4>
					</div>
					<div class="modal-body" id="reply-modal-body-'.$post_id.'">';
						amn_reply_forms( $comment->comment_ID );
			echo '	</div>
				</div>
				<!-- END MESSAGE REPLY MODAL -->';
				
			echo '<!-- START MESSAGE DELETE MODAL -->
				<div class="modal fade in" id="delete-message-modal-pane-'.$comment->comment_ID.'" tabindex="-1" data-replace="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Delete Message</h4>
					</div>
					<div class="modal-body" id="delete-modal-body-'.$post_id.'">';
						
			echo '		<form action="'.get_site_url().'/wp-comments-delete.php" method="post" class="delete-comment-form">
							<h6>Are you sure you want to delete this message?</h6>
							<input type="hidden" name="comment_post_ID" value="'.$post_id.'">
							<input type="hidden" name="deletecomID" value="'.$comment->comment_ID.'">
							<input type="hidden" name="action" value="delete_message">
							<button type="submit" class="btn btn-sm red">Delete</button>
							<button type="button" data-dismiss="modal" class="btn btn-sm default">Cancel</div>
						</form>
					</div>
				</div>
				<!-- END MESSAGE DELETE MODAL -->';
			if(isset($comment_image) && $comment_image['url'] != ''){	
				echo '<!-- START IMAGE DELETE MODAL -->
					<div class="modal fade in" id="delete-image-modal-pane-'.$comment->comment_ID.'" tabindex="-1" data-replace="true">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Delete Image</h4>
						</div>
						<div class="modal-body" id="delete-modal-body-'.$post_id.'">';
				
				echo '		<div class="clearfix comment-image">';
				echo '			<img src="' . $comment_image['url'] . '" alt="" /><br />';
				echo '		</div><!-- /.comment-image -->';		
				echo '		<form action="'.get_site_url().'/wp-comments-delete.php" method="post" class="delete-comment-form">
								<h6>Are you sure you want to delete this image?</h6>
								<input type="hidden" name="comment_post_ID" value="'.$post_id.'">
								<input type="hidden" name="deletecomID" value="'.$comment->comment_ID.'">
								<input type="hidden" name="action" value="delete_image">
								<button type="submit" class="btn btn-sm red">Delete</button>
								<button type="button" data-dismiss="modal" class="btn btn-sm default">Cancel</div>
							</form>
						</div>
					</div>
					<!-- END IMAGE DELETE MODAL -->';
			}
		}
		echo '<!-- START MESSAGE DELETED RESPONSE MODAL -->
			<div class="modal fade in" id="message-deleted-modal" tabindex="-1" data-replace="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Message Deleted</h4>
				</div>
				<div class="modal-body" id="msg-deleted-modal-body-'.$post_id.'">';
					if($_GET["resp"] == 'msg-delete'){
		echo '		<div class="alert alert-success pull-center">Your Message Has Been Deleted!</div>';	
					}
					else if($_GET["resp"] == 'img-delete'){
		echo '		<div class="alert alert-success pull-center">Your Image Has Been Deleted!</div>';	
					}
		echo '	</div>
				<div class="modal-footer">
					<button type="button" class="btn default" data-dismiss="modal">Close</button>
				</div>
			</div>
			<a href="#message-deleted-modal" data-toggle="modal"></a>
			<!-- END MESSAGE DELETED RESPONSE MODAL -->';
	}
}
// END show_messaging_action_modals()


/* //////////////////////////////////////////////////////////////////////////
**		Get the messaging thread reply forms in loop based on the comment_id
**		Return Message Reply Form
** /////////////////////////////////////////////////////////////////////////*/
function amn_reply_forms( $comment_id ){
	
	$the_post_id = get_the_ID();
	
	// If the user is logged in
	$user = wp_get_current_user();
	if ( $user->exists() ) {
		if ( empty( $user->display_name ) )
			$user->display_name=$user->user_login;
		$comment_author       = wp_slash( $user->display_name );
		$comment_author_email = wp_slash( $user->user_email );
		$comment_author_url   = wp_slash( $user->user_url );
		
	}
	
	foreach(get_comments('post_id=' . $the_post_id) as $currComment){
		$currComment_image = get_comment_meta( $currComment->comment_ID, 'comment_image', true );
		if($currComment->comment_ID == $comment_id){
			$d = "l, F jS, Y";
			$comment_date = get_comment_date( $d, $currComment->comment_ID );
			echo '
				<h4 class="clearfix comment-author">'.$currComment->comment_author.'</h4>
				<h6 class="clearfix comment-date">'.$comment_date.'</h6>
				<p class="clearfix comment-content">'.$currComment->comment_content.'</p>
			   	<div class="clearfix comment-image">
						<img src="' . $currComment_image['url'] . '" alt="" /><br />
				</div><!-- /.comment-image -->';
				
			$currCommentParent = $currComment->comment_parent;
		}
	}
	echo '
	<form action="'.get_site_url().'/wp-comments-post.php" method="post" id="reply-comment-form-'.$comment_id.'" class="comment-form reply" enctype="multipart/form-data">       
	  <input type="hidden" name="formkey" class="formkey" value="'.$comment_id.'">     
      <div class="chat-form amn-chat-form">
          <div class="clearfix input-cont input-icon right"><i class="fa fa-pencil"></i><input type="text" name="comment_subject" class="form-control comment_subject" placeholder="Subject:"></div>
          <div class="clearfix input-cont input-icon right">   
              <i class="fa fa-edit" title="Enter a message."></i>
			  <textarea class="form-control comment_content" cols="8" id="comment_content_'.$comment_id.'" name="comment" placeholder="Type a message here..."></textarea>
          </div>
		  
      </div>
      <div class="form-submit" id="comment_image_form_submit_'.$comment_id.'">
          <div class="row">
              <div class="col-md-12">
                  <div class="row block form-action-btns">
                      <input type="hidden" name="action" value="new-comment">
                      <input type="hidden" name="replytocom" value="'.$comment_id.'">
                      <input type="hidden" name="author" value="'.$comment_author.'">
                      <input type="hidden" name="email" value="'.$comment_author_email.'">
                      <input type="hidden" name="url" value="'.$comment_author_url.'">
                      <input type="hidden" name="comment_post_ID" value="'.$the_post_id.'" class="comment_post_ID" id="comment_post_ID_'.$comment_id.'">
                      <input type="hidden" name="comment_parent" class="comment_parent" id="comment_parent_'.$comment_id.'" value="'.$comment_id.'">';
	echo '		  	  <input type="hidden" name="redirecturl" class="redirecturl" id="redirecturl_'.$comment_id.'" value="http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"].'">';
	echo '			  <div class="left-form-btns reply">';
    echo '	          
					  	<input type="file" id="comment_image_'.$comment_id.'" class="btn blue reply_comment_image" name="comment_image_'.$the_post_id.'">
						<button type="button" class="btn btn-sm red comment_image_delete" id="comment_image_delete_'.$comment_id.'" title="Delete attached image" data-commentid="'.$comment_id.'" style="display: none;"><i class="fa fa-minus"></i></a>
						</button>
						<div class="current_selected_image" id="reply_comment_image_name_'.$comment_id.'">
							<img src="'.get_template_directory_uri().'/images/main/ajax-loading.gif" style="display: none;" width="20" height="20" alt="">
							<span class="label label-success" style="display: none;"></span>
						</div>
					  </div>
					  <div class="right-form-btns reply">
                      	<button name="submit-comment-'.$comment_id.'" class="btn btn-sm green amn-submit-button" type="submit" id="submit-'.$comment_id.'" value="Reply to Message" title="Send message"><i class="fa fa-share"></i> Reply</button> 
					  	<button class="btn btn-sm default replyto-cancel-btn" data-commentid="'.$comment_id.'" data-dismiss="modal" id="replyto-cancel-btn-'.$comment_id.'" type="button">Cancel</button>
					  </div>
                  </div>
              </div>
          </div>
          <!-- /.row -->
      </div>
      <!-- /.form-submit -->
    </form>';
}
// END amn_reply_forms()


/* //////////////////////////////////////////////////////////////////////////
**		Get the messaging thread based on the post_id
**		Return Messaging Thread
** /////////////////////////////////////////////////////////////////////////*/
function amn_show_messaging_thread($post_id, $scoller_wrapper) {
	
	if($post_id == '')
		$post_id = get_the_ID();
		
	if($scoller_wrapper == '')
		$scoller_wrapper = 'wrapper';
		
	$args = 'post_id=' . $post_id;
	$comments = get_comments($args);
	
	// If the user is logged in
	$user = wp_get_current_user();
	if ( $user->exists() ) {
		$current_user_ID = $user->ID;
	}
	
	echo '
			<!-- BEGIN PORTLET -->
			<div id="portlet-wrapper-'.$post_id.'" class="portlet">
              	<div class="portlet-title line">
					<div class="caption">
						<i class="fa fa-comments"></i>Chats
					</div>
					<div class="tools">
						<a href="" class="collapse"></a>
						<a href="" class="reload"></a>
					</div>
              	</div>
				<!-- BEGIN WRAPPER -->
              	<div class="portlet-body scroller-portlet-body">';
		if(isset($comments) && $comments != null) {
			
		
	echo '
                			<ul class="chats" id="chats-'.$post_id.'">';
							
								foreach($comments as $comment){
									$side = 'in';
									$comment_image = get_comment_meta( $comment->comment_ID, 'comment_image', true );
									$comment_subject = get_comment_meta( $comment->comment_ID, 'comment_subject', true );
									$d = "l, F jS, Y";
									$comment_date = get_comment_date( $d, $comment->comment_ID );
									if($current_user_ID != $comment->user_id){ $side = 'out'; }
									echo '<li class="'.$side.'" id="comment-'.$comment->comment_ID.'">';
									echo get_avatar( $comment, $args['avatar_size'] );
									echo '	<div class="message">
												<span class="arrow"></span>';
												
									echo '		<div class="clearfix">
													<div class="datetime">On '.$comment_date.'</div>
													
													<span class="says"> Message from <a href="'.$comment->comment_author_url.'" rel="external nofollow" class="url"> '.$comment->comment_author.'</a>:</span>
												</div>';
									echo '		<div class="body">';
													if($comment_subject != '' || $comment_subject != null) { echo '<div class="subject"><strong>Subject:</strong> '.$comment_subject .'</div>'; }
									echo '			<p class="clearfix comment_content">'.$comment->comment_content.'</p>';
									echo '			<p class="clearfix"><img src="'.$comment_image['url'].'" class="comment_image" alt=""></p>';
									echo '			<div class="reply">
														<a href="#reply-modal-pane-'.$comment->comment_ID.'" data-toggle="modal" id="reply-modal-btn-'.$comment->comment_ID.'" class="btn btn btn-sm blue reply-modal-btn" title="Reply to '.$comment->comment_author.'\'s comment"><i class="fa fa-reply"></i></a>';
												
									if($current_user_ID == $comment->user_id) {
									echo '				<a  href="#delete-message-modal-pane-'.$comment->comment_ID.'" data-toggle="modal" id="delete-modal-btn-'.$comment->comment_ID.'" class="btn btn-sm red delete-modal-btn" title="Delete this comment"><i class="fa fa-minus-circle"></i></a>';
									}
									
									echo '
													</div>
												</div>';
			
									echo '	</div>';
									echo '</li>';
								}
	
	echo '				</ul>';
	echo '
					<script>
					var '.$scoller_wrapper.'_scroll;
					function '.$scoller_wrapper.'_loaded() {
						'.$scoller_wrapper.'_scroll = new iScroll("'.$scoller_wrapper.'", { hScrollbar: false, vScrollbar: true, hScroll: true });
					}
					document.addEventListener("DOMContentLoaded", '.$scoller_wrapper.'_loaded, true);
					</script>';
		}
		else {
	echo '			<h2 class="">NO CURRENT MESSAGES</h2>';
		}
	echo '
				</div><!-- /.portlet-body -->';
	echo '</div> 
		<!-- END PORTLET -->';
	
}
// END amn_show_messaging_thread()


/* //////////////////////////////////////////////////////////////////////////
**		Get the images thread based on the post_id
**		Return Messaging Thread
** /////////////////////////////////////////////////////////////////////////*/
function amn_show_images_thread( $the_post_id ) {
	
		$comments = get_comments($the_post_id);
		
		// Make sure that there are comments
		if( count( $comments ) > 0 ) {
			$html = '';
			$html .= '<div class="wrapper" id="imagesFullThreadWrapper">';
			$html .= '<div class="scroller">';
			$html .= '<ul class="chats">';
			// Loop through each comment...
			foreach( $comments as $comment ) {

				// ...and if the comment has a comment image...
				if( true == get_comment_meta( $comment->comment_ID, 'comment_image' ) ) {

					// ...get the comment image meta
					$comment_image = get_comment_meta( $comment->comment_ID, 'comment_image', true );
					$d = "l, F jS, Y";
					$comment_date = get_comment_date( $d, $comment->comment_ID );
					$html .= '<li class="in">';
                    $html .=  get_avatar( $comment, $args['avatar_size'] );
					$html .= '<div class="message">
									<span class="arrow"></span>';
								
					
					$html .= '		<div class="clearfix">
										<div class="datetime">On '.$comment_date.'</div>
									
										<span class="says"><a href="'.$comment->comment_author_url.'" rel="external nofollow" class="url"> '.$comment->comment_author.'</a> uploaded:</span>
									</div>';
					$html .= '		<div class="body">';
									if($comment_subject != '' || $comment_subject != null) { echo '<div class="subject"><strong>Subject:</strong> '.$comment_subject .'</div>'; }
					$html .= '			<p class="clearfix"><img src="'.$comment_image['url'].'" class="comment_image" alt=""></p>';
					$html .= '			<div class="reply">
										<a  href="#delete-image-modal-pane-'.$comment->comment_ID.'" data-toggle="modal" id="delete-modal-btn-'.$comment->comment_ID.'" class="btn btn-sm red delete-modal-btn" title="Delete this image"><i class="fa fa-minus-circle"></i></a>
									</div>
								</div>';

					$html .= '	</div>';
					$html .= '</li>';

				} // end if

			} // end foreach
			$html .= '</ul>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '<script>
                var imagesFullThreadScroll_scroll;
                function imagesThreadLoaded() {
                    imagesFullThreadScroll_scroll = new iScroll("imagesFullThreadWrapper", { hScrollbar: false, vScrollbar: true });
                     
                }
                document.addEventListener("DOMContentLoaded", imagesThreadLoaded, true);
              </script>';

		} // end if

		echo $html;

} 
// END amn_show_images_thread()


/* //////////////////////////////////////////////////////////////////////////
**		Return Successful Registration Modal
** /////////////////////////////////////////////////////////////////////////*/
function register_success_modal() {
	echo '
    <!-- START NEW CLIENT MODAL -->
    <div class="modal fade modal-scroll" id="register-success" tabindex="-1" data-replace="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title text-success"><i class="fa fa-user"></i> Registration Successful!</h4>
        </div>
        <div class="modal-body">';
	echo '	
            <p class="info-text">Thank you for registering on <strong class="text-info">ArtcotechsConnect!</strong> You\'re account has now been added to Artcotechs Connect Network Portal.</p> 
            <p class="info-text">You may explore and get familiar with our new user interface as we will use here to manage all interactions and services affiliated with Artcotechs. </p>
            <p class="info-text">Feel free to provide us with any feedback you may have, as well as any bugs or issues you may come across while using Artcotechs Connect as we are in the process of working hard to fully optimize every aspect of our company portal. </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn green" data-dismiss="modal">Ok</button>
        </div>
    </div>
    <a data-toggle="modal" href="#register-success"></a>
    <!-- END NEW CLIENT MODAL -->';
}
//register_success_modal()



?>