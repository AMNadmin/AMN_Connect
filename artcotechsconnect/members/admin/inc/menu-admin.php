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
	  $user_type = get_user_meta( $current_user->ID, 'user_type', true );
	  $invoice_link = get_user_meta( $current_user->ID, 'invoice_link', true );
	  $project_link1 = get_user_meta( $current_user->ID, 'project_link1', true );
	  $project_link2 = get_user_meta( $current_user->ID, 'project_link2', true );
	  $development_link = get_user_meta( $current_user->ID, 'development_link', true );
	  $project_calendar = get_user_meta( $current_user->ID, 'project_calendar', true );
	  
	  ?>

	<div class="page-sidebar navbar-collapse collapse admin">
         <!-- BEGIN SIDEBAR MENU -->        
         <ul class="page-sidebar-menu">
            <li>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
               <div class="sidebar-toggler hidden-phone"></div>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li class="start<? if($_GET['hubpage'] == 'admin-dashboard' && !isset($_GET['level']) && !isset($_GET['view'])){ ?> active<? } ?>">
               <a href="/hub-page/">
               <img src="<? echo get_template_directory_uri(); ?>/images/main/amn-manhead-icon.png" width="20" height="20" alt="">
               <span class="title">Connect Dashboard</span>
               <? if($_GET['hubpage'] == 'admin-dashboard') { ?><span class="selected"></span><? } ?>
               </a>
            </li>
            <li>
               <a href="/wp-admin/">
               <i class="fa fa-exchange"></i> 
               <span class="title">Wordpress Dashboard</span>
               </a>
            </li>
            <li class="<? if($_GET['view'] == 'infinitewp') { ?>active<? } ?>">
				<a href="#infinitewp-manager" data-toggle="tab">
               <i class="fa fa-cogs"></i> 
               <span class="title">InfiniteWP Manager</span>
               <? if($_GET['view'] == 'infinitewp') { ?><span class="selected"></span><? } ?>
               </a>
            </li>
            <li class="<? if($_GET['level'] == 'nm') { ?>active open<? } ?>">
               <a href="javascript:;">
               <i class="fa fa-code-fork"></i> 
               <span class="title">Network Management</span>
				<? if($_GET['level'] == 'nm' || $_GET['view'] == 'hosting-manager' || $_GET['view'] == 'hosting-connection' || $_GET['view'] == 'domain-manager') { ?><span class="selected"></span><? } ?>
               <span class="arrow<? if($_GET['level'] == 'nm' || $_GET['view'] == 'hosting-manager' || $_GET['view'] == 'hosting-connection' || $_GET['view'] == 'domain-manager') { ?> open<? } ?>"></span>
               </a>
               <ul class="sub-menu">
                  <li class="<? if($_GET['view'] == 'hosting-manager') { ?>active<? } ?>">
                  	<a href="#hosting-manager" data-toggle="tab">
                    <i class="fa fa-cloud"></i> 
               		<span class="title">Hosting Manager</span>
               		<? if($_GET['view'] == 'hosting-manager') { ?><span class="selected"></span><? } ?>
                    </a>
                  </li>
                  <li class="<? if($_GET['view'] == 'hosting-connection') { ?>active<? } ?>">
                  	<a href="#hosting-connection" data-toggle="tab">
                    <i class="fa fa-cloud-upload"></i> 
               		<span class="title">Hosting Connection</span>
               		<? if($_GET['view'] == 'hosting-connection') { ?><span class="selected"></span><? } ?>
                    </a>
                  </li>
                  <li class="<? if($_GET['view'] == 'domain-manager') { ?>active<? } ?>">
                  	<a href="#domain-manager" data-toggle="tab">
                    <i class="fa fa-cloud-download"></i>
               		<span class="title">Domain Manager</span>
               		<? if($_GET['view'] == 'domain-manager') { ?><span class="selected"></span><? } ?>
                    </a>
                  </li>
               </ul>
            </li>
            <li>
              <a href="#myerp-manager" data-toggle="tab">
              <i class="fa fa-credit-card"></i> 
			  <span class="title">myERP</span>
              <? if($_GET['view'] == 'myerp') { ?><span class="selected"></span><? } ?>
              </a>
            </li>
            <li class="<? if($_GET['level'] == 'sm') { ?>active open<? } ?>">
              <a href="#hootsuite-manager" data-toggle="tab">
              <i class="fa fa-group"></i> 
               <span class="title">Hootsuite</span>
              <? if($_GET['view'] == 'myerp') { ?><span class="selected"></span><? } ?>
              </a>
            </li>
            <li class="<? if($currPostName == 'admin-profile') { ?>active<? } ?>">
               <a href="/admin-profile/">
               <i class="fa fa-user"></i> 
               <span class="title">Admin Profile</span>
               <? if($currPostName == 'admin-profile') { ?><span class="selected"></span><? } ?>
               </a>
            </li>
            <li class="">
               <a href="https://plus.google.com/hangouts/_?gid=715338896861">
               <i class="fa fa-google-plus"></i> 
               <span class="title">Google Connect</span>
               </a>
            </li>
            <li class="">
               <a href="<? echo wp_logout_url( 'http://connect.artcotechs.net' ); ?>">
               <i class="fa fa-minus-circle"></i> 
               <span class="title">Log Out</span>
               </a>
            </li>
            
            
         </ul>
         <!-- END SIDEBAR MENU -->
      </div>