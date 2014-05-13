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
      $google_profile_picture = get_user_meta( $current_user->ID, 'google_profile_picture', true );
      $member_credits = get_user_meta( $current_user->ID, 'member_credits', true );
	  $project_link1 = get_user_meta( $current_user->ID, 'project_link1', true );
	  $project_link2 = get_user_meta( $current_user->ID, 'project_link2', true );
	  $project_type1 = get_user_meta( $current_user->ID, 'project_type1', true );
	  $project_type2 = get_user_meta( $current_user->ID, 'project_type2', true );
	  $project_id1 = get_user_meta( $current_user->ID, 'project_id1', true );
	  $project_id2 = get_user_meta( $current_user->ID, 'project_id2', true );
	  $project_calendar = get_user_meta( $current_user->ID, 'project_calendar', true );
	  
	  $registered = ($user_info->user_registered . "\n");
	  $registered = date("n/j/Y", strtotime($registered));
	  ?>
<div class="spinnerbg">
    <div id="spinner">
        <span id="first" class="ball"></span>
        <span id="second" class="ball"></span>
        <span id="third" class="ball"></span>
    </div>
</div>
  
<? //if(is_user_logged_in() && $userRole != 'administrator' && $userRole != 'super_admin') { ?>
<div class="header navbar navbar-inverse navbar-fixed-top admin">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="header-inner">
			<!-- BEGIN LOGO -->
			<a class="navbar-brand" href="/">
			<img src="<? bloginfo( 'siteurl' ); ?>/wp-content/uploads/2013/10/Artcotechs-logo-wht.png" alt="logo" class="img-responsive">
			</a>
			<!-- END LOGO -->
			<!-- BEGIN HORIZANTAL MENU -->
			<div class="hor-menu hidden-sm hidden-xs">
				<ul class="nav navbar-nav">
					<li<? if(isset($_GET['hubpage'])){ ?> class="active"<? } ?>>
						<a href="/?hubpage=client-dashboard" title="Back to Dashboard">
						Dashboard
						<span class="selected"></span>
						</a>
					</li>
					<li<? if($_GET['clientspage'] == 'support-ticket' || $_GET['clientspage'] == 'project-feedback' || $currPostName == 'project-questionnaires'){ ?> class="active"<? } ?>>
						<a data-toggle="dropdown" data-hover="dropdown" data-close-others="true" href="">
						Support   
						</a>
						<ul class="dropdown-menu">
                        	<? if($project_link1 != '' || $project_link2 != '' ) { ?>
							<li<? if($_GET['clientspage'] == 'project-feedback'){ ?> class="active"<? } ?>><a href="/?clientspage=project-feedback" title="Project Feedback"><i class="fa fa-gears"></i> Project Feedback</a></li>
                            <? } ?>
                            <li<? if($currPostName == 'project-questionnaires'){ ?> class="active"<? } ?>><a href="/your-profile/?view=quest" title="Project Questionnaires"><i class="fa fa-question"></i> Project Questionnaires</a>
							<li<? if($_GET['clientspage'] == 'support-ticket'){ ?> class="active"<? } ?>><a href="/?clientspage=support-ticket" title="Support Tickets"><i class="fa fa-info-circle"></i> Support Ticket</a></li>
                        </ul>
					</li>
					<li>
						<span class="hor-menu-search-form-toggler">&nbsp;</span>
						<div class="search-form">
							<form class="form-search">
								<div class="input-group">
									<input type="text" placeholder="Search..." class="form-control">
									<div class="input-group-btn">
										<button type="button" class="btn"></button>
									</div>
								</div>
							</form>
						</div>
					</li>
				</ul>
			</div>
			<!-- END HORIZANTAL MENU -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<img src="<? bloginfo( 'template_url' ); ?>/images/main/menu-toggler.png" alt="">
			</a>          
			<!-- END RESPONSIVE MENU TOGGLER -->       
			<!-- BEGIN TOP NAVIGATION MENU -->
			<ul class="nav navbar-nav pull-right">
            	<? if ( wp_is_mobile() ) { ?>
				<!-- BEGIN INBOX DROPDOWN -->
				<li id="header_inbox_bar">
					<a href="tel:17182184228">
					<i class="icon-mobile-phone"></i>
					</a>
				</li>
				<!-- END TODO DROPDOWN -->
                <? } ?>
                
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<li class="dropdown user" id="connect-member-links">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <? if($google_profile_picture != ''){ ?>
                    	<img src="<? echo $google_profile_picture; ?>" alt="Client avatar" id="member-avatar">
                    <? } else if($user_avatar != ''){ ?>
                    	<img src="http://connect.artcotechs.net/wp-content/uploads<? echo $user_avatar; ?>" alt="Client avatar" id="member-avatar">
					<? } else { ?> <img src="http://0.gravatar.com/avatar/a585fd258f1d1e71cd8aa11ee108d89e?s=32&d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D32&r=G" alt="Client avatar" id="member-avatar"> 
					<? } ?>
					<!--<img alt="" src="assets/img/avatar1_small.jpg">-->
					<span class="username"><? echo $user_name; ?></span>
					<i class="icon-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<? echo wp_logout_url( 'http://connect.artcotechs.net' ); ?>"><i class="fa fa-minus-circle"></i> Log Out</a></li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
    
    
<?  //} ?>
