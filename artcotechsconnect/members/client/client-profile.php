<?
get_header();
global $user_identity, $userInfo, $user_ID, $wp_query, $wpdb, $wpc_client, $wp_crm, $current_user;
	  $currUserInfo = get_userdata($user_ID);
	  $currPostName = $post->post_name; 
	  $currPostTitle = $post->post_title;
	  $currUserProperty = new WP_User( $user_ID ); 
	  $projID = $_GET['pid']; 
	  $userRole = '';
	  if ( !empty( $currUserProperty->roles ) && is_array( $currUserProperty->roles ) ) { 
		foreach ( $currUserProperty->roles as $role )
			$userRole = $role; 
	  } 
	  
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
	  $invoice_link = get_user_meta( $current_user->ID, 'invoice_link', true );

?>
    <link href="<? bloginfo( 'template_url' ); ?>/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
    <link href="<? bloginfo( 'template_url' ); ?>/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>

    <!-- BEGIN THEME STYLES -->
    <link href="<? bloginfo( 'template_url' ); ?>/css/style-metronic.css" rel="stylesheet" type="text/css"/>
    <link href="<? bloginfo( 'template_url' ); ?>/style.css" rel="stylesheet" type="text/css"/>
    <link href="<? bloginfo( 'template_url' ); ?>/css/style-responsive.css" rel="stylesheet" type="text/css"/>
    <link href="<? bloginfo( 'template_url' ); ?>/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<? bloginfo( 'template_url' ); ?>/css/tasks.css" rel="stylesheet" type="text/css"/>
    <link href="<? bloginfo( 'template_url' ); ?>/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="<? bloginfo( 'template_url' ); ?>/css/profile.css" rel="stylesheet" type="text/css">
    <link href="<? bloginfo( 'template_url' ); ?>/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->

</head><!-- END HEAD -->

<!-- BEGIN BODY -->
<body>

<!-- BEGIN HEADER -->
	<? include( get_template_directory(). '/members/client/inc/navbar.php' ); ?>
<!-- END HEADER -->

<div class="clearfix"></div>

<!-- BEGIN CONTAINER -->
<div class="page-container"> 
  <!-- BEGIN SIDEBAR -->
  <? 
	include( get_template_directory(). '/members/client/inc/navigation.php' ); 
	?>
  <!-- END SIDEBAR --> 
  
  <!-- BEGIN PAGE -->
  <div class="page-content"> 
    
    <!-- BEGIN STYLE CUSTOMIZER -->
    <? include( get_template_directory() . '/inc/style-customizer.php' ); ?>
    <!-- END BEGIN STYLE CUSTOMIZER --> 
    
    <!-- BEGIN PAGE HEADER-->
    <div class="row">
      <div class="col-md-12"> 
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
          <? the_title(); ?>
          <small></small> </h3>
        <ul class="page-breadcrumb breadcrumb">
          <li> <i class="fa fa-dashboard"></i> <a href="/dashboard/">Dashboard</a> <i class="fa fa-angle-right"></i> </li>
          <li>
            <? the_title(); ?>
          </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    
    <!-- BEGIN PROFILE CONTENT -->
    <div class="row profile">
      <div class="col-md-12">
        <div class="tabbable tabbable-custom tabbable-full-width">
          <ul class="nav nav-tabs" id="account-tab-links">
            <li class="<? if(!isset($_GET['level']) && !isset($_GET['view'])){ ?>active<? } ?>"> <a href="#tab_1_1" data-toggle="tab"> Overview </a> </li>
            <li class="<? if( ($_GET['level'] == 'profile' && $_GET['view'] == 'edit-avatar') || $_GET['view'] == 'edit-profile' || $_GET['view'] == 'change-password') { ?>active<? } ?>"> <a href="#tab_1_2" data-toggle="tab"> Account </a> </li>
            <li class=""> <a href="#tab_1_3" data-toggle="tab"> Projects </a> </li>
            <!--<li class=""> <a href="#tab_1_4" data-toggle="tab"> Documents </a> </li>-->
          </ul>
          <div class="tab-content" id="profile-meta-content">
            <div class="tab-pane <? if( !isset($_GET['level']) && !isset($_GET['view']) ){ ?> active<? } ?>" id="tab_1_1">
              <div class="row">
                <div class="col-md-3">
                  <ul class="list-unstyled profile-nav">
                    <li>
                      <? if($user_avatar != ''){ ?>
                      <img src="http://connect.artcotechs.net/wp-content<? echo $user_avatar; ?>" class="img-responsive" alt="">
                      <? } else { ?>
                      <img src="<? bloginfo( 'template_url' ); ?>/images/defaults/avatar-default.jpg" class="img-responsive" alt="">
                      <? } ?>
                      <a href="/dashboard/my-account/?level=profile&view=edit-avatar" class="profile-edit"> edit </a>
                    </li>
                    <li><a href="/dashboard/my-projects/?pid=<? echo $project_id1; ?>" title="My Projects"><i class="fa fa-file-text"></i> Projects</a></li>
                    <li> <a href="/dashboard/my-account/?level=profile&view=edit-profile"><i class="fa fa-user"></i> Edit Profile</a> <span class="after"></span></li>
                    <li><a href="/dashboard/my-account/?level=profile&view=edit-avatar" title="Update Password"><i class="fa fa-cog"></i> Change Avatar</a></li>
                  </ul>
                </div>
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-8 profile-info">
                      <h1><? echo $first_name . ' ' . $last_name; ?></h1>
                      <h5><? echo $brand_name; ?></h5>
                      <p>
                        <? if($short_description != '') { echo $short_description; } else { ?>
                        Welcome to Artcotechs Network Connect!
                        <? } ?>
                      </p>
                      <? if($website != '') { ?>
                      <p><a href="<? echo $website; ?>"><? echo $website; ?></a></p>
                      <? } ?>
                      <ul class="list" id="client-profile-meta">
                        <? if( $operation_location != '' ){ ?>
                        <li><i class="fa fa-map-marker"></i> <? echo $operation_location; ?></li>
                        <? } ?>
                        <? if( $date_established != '' ){ ?>
                        <li><i class="fa fa-calendar"></i> <? echo $date_established; ?></li>
                        <? } ?>
                        <? if($brand_industry != '' || $brand_secondIndustry != ''){ ?>
                        <li><i class="fa fa-briefcase"></i>
                          <? if($brand_industry != ''){ echo $brand_industry; }?>
                          <? if($brand_secondIndustry != ''){ echo  ', '.$brand_secondIndustry; } ?>
                        </li>
                        <? } ?>
                        <li><i class="fa fa-star"></i> Artcotechs Client</li>
                        <? if( $brand_status != '' ){ ?>
                        <li><i class="fa fa-heart"></i> <? echo $brand_status; ?></li>
                        <? } ?>
                      </ul>
                      
                    </div>
                    <!--end col-md-8-->
                    <div class="col-md-4">
                      <div class="portlet sale-summary">
                        <div class="portlet-title">
                          <div class="caption"> Account Summary </div>
                          <div class="tools"> <a class="reload" href="javascript:;"></a> </div>
                        </div>
                        <div class="portlet-body">
                          <ul class="list-unstyled">
                            <li> <span class="sale-info"> TOTAL <i class="fa fa-img-up"></i> </span> <span class="sale-num" id="invoice-total">$0</span> </li>
                            <li> <span class="sale-info"> PAYMENTS <i class="fa fa-img-up"></i> </span> <span class="sale-num" id="payments-made">$0</span> </li>
                            <li> <span class="sale-info"> BALANCE <i class="fa fa-img-down"></i> </span> <span class="sale-num" id="statement-balance">$0</span> </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <!--end col-md-4--> 
                  </div>
                  <!--end row--> 
                </div>
              </div>
              <!-- end row --> 
            </div>
            <!-- /.tab-pane --> 
            
            <div class="tab-pane<? if(($_GET['level'] == 'profile' && $_GET['view'] == 'edit-avatar') || $_GET['view'] == 'edit-profile' || $_GET['view'] == 'change-password') { ?> active<? } ?>" id="tab_1_2">
            	<div class="tabbable tabs-left" id="profile-edit-content"> 
                    <ul class="ver-inline-menu tabbable margin-bottom-10" id="account-links">
                      <li class="<? if( (!isset($_GET['level']) && !isset($_GET['view']) || ($_GET['level'] == 'profile' && $_GET['view'] == 'edit-profile') )){ ?> active<? } ?>"> <a data-toggle="tab" href="#tab_1-1"><i class="fa fa-user"></i> Contact Profile</a> <span class="after"></span></li>
                      <li class="<? if($_GET['level'] == 'profile' && $_GET['view'] == 'change-password') { ?> active<? } ?>"><a data-toggle="tab" href="#tab_2-2" title="Update Password"><i class="fa fa-cog"></i> Update Password</a></li>
                      <li class="<? if($_GET['level'] == 'profile' && $_GET['view'] == 'edit-avatar') { ?> active<? } ?>"><a data-toggle="tab" href="#tab_3-3" title="Update Profile Pic"><i class="fa fa-cog"></i> Update Profile Pic</a></li>
                      <li><a data-toggle="tab" href="#tab_9-9" title="Payment Preferences"><i class="fa fa-cog"></i> Payment Preferences</a></li>
                      <li><a data-toggle="tab" href="#tab_4-4" title="Brand Profile"><i class="fa fa-cog"></i> Brand Profile</a></li>
                      <li><a data-toggle="tab" href="#tab_5-5" title="Brand Ecosystem"><i class="fa fa-cog"></i> Brand Ecosystem</a></li>
                      <li><a data-toggle="tab" href="#tab_6-6" title="Brand Value"><i class="fa fa-cog"></i> Brand Value</a></li>
                      <li><a data-toggle="tab" href="#tab_7-7" title="Brand Culture"><i class="fa fa-cog"></i> Brand Culture</a></li>
                      <li><a data-toggle="tab" href="#tab_8-8" title="Social Media Information"><i class="fa fa-cog"></i> Social Media Info</a></li>
                    </ul> 
                    <div class="tab-content"> 
                        <!-- Personal Info -->
                      <div id="tab_1-1" class="tab-pane<? if( (!isset($_GET['level']) && !isset($_GET['view']) )|| ($_GET['level'] == 'profile' && $_GET['view'] == 'edit-profile') ){ ?> active<? } ?>">
                        <div class="portlet box blue ">
                          <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-user"></i> Contact Profile Update </div>
                            <div class="tools"> <a href="" class="collapse"></a> <a href="" class="reload"></a> </div>
                          </div>
                          <div class="portlet-body form">
                            <div class="form-body">
                              <?
                                  $newQuery1 = new WP_Query( 'p=63' );
                                   while ( $newQuery1->have_posts() ) : $newQuery1->the_post(); 
                                       the_content();
                                   endwhile;
                                   wp_reset_query(); 
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Change Password -->
                      <div id="tab_2-2" class="tab-pane<? if($_GET['level'] == 'profile' && $_GET['view'] == 'change-password') { ?> active<? } ?>">
                        <div class="portlet box blue ">
                          <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-lock"></i> Password Update </div>
                            <div class="tools"> <a href="" class="collapse"></a> <a href="" class="reload"></a> </div>
                          </div>
                          <div class="portlet-body form">
                            <div class="form-body">
                              <?
                                  $newQuery4 = new WP_Query( 'p=66' );
                                   while ( $newQuery4->have_posts() ) : $newQuery4->the_post(); 
                                       the_content();
                                   endwhile; 
                                   wp_reset_query(); 
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Profile Avatar -->
                      <div id="tab_3-3" class="tab-pane<? if($_GET['level'] == 'profile' && $_GET['view'] == 'edit-avatar') { ?> active<? } ?>">
                        <div class="portlet box blue ">
                          <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-picture-o"></i> Profile Avatar Update </div>
                            <div class="tools"> <a href="" class="collapse"></a> <a href="" class="reload"></a> </div>
                          </div>
                          <div class="portlet-body form">
                            <div class="form-body">
                              <?
                                  $newQuery3 = new WP_Query( 'p=69' );
                                   while ( $newQuery3->have_posts() ) : $newQuery3->the_post(); 
                                       the_content();
                                   endwhile; 
                                   wp_reset_query(); 
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Brand Profile -->
                      <div id="tab_4-4" class="tab-pane">
                        <div class="portlet box blue ">
                          <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-group"></i> Brand Profile </div>
                            <div class="tools"> <a href="" class="collapse"></a> <a href="" class="reload"></a> </div>
                          </div>
                          <div class="portlet-body form">
                            <div class="form-body">
                              <?
                                  $newQuery2 = new WP_Query( 'p=114' );
                                   while ( $newQuery2->have_posts() ) : $newQuery2->the_post(); 
                                       the_content();
                                   endwhile;
                                   wp_reset_query(); 
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Brand Ecosystem -->
                      <div id="tab_5-5" class="tab-pane">
                        <div class="portlet box blue ">
                          <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-cog"></i> Brand Ecosystem </div>
                            <div class="tools"> <a href="" class="collapse"></a> <a href="" class="reload"></a> </div>
                          </div>
                          <div class="portlet-body form">
                            <div class="form-body">
                              <?
                                  $newQuery5 = new WP_Query( 'p=118' );
                                   while ( $newQuery5->have_posts() ) : $newQuery5->the_post(); 
                                       the_content();
                                   endwhile; 
                                   wp_reset_query(); 
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Brand Value -->
                      <div id="tab_6-6" class="tab-pane">
                        <div class="portlet box blue ">
                          <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-cog"></i> Brand Value </div>
                            <div class="tools"> <a href="" class="collapse"></a> <a href="" class="reload"></a> </div>
                          </div>
                          <div class="portlet-body form">
                            <div class="form-body">
                              <?
                                  $newQuery6 = new WP_Query( 'p=377' );
                                   while ( $newQuery6->have_posts() ) : $newQuery6->the_post(); 
                                       the_content();
                                   endwhile; 
                                   wp_reset_query(); 
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Brand Culture -->
                      <div id="tab_7-7" class="tab-pane">
                        <div class="portlet box blue ">
                          <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-cog"></i> Brand Culture </div>
                            <div class="tools"> <a href="" class="collapse"></a> <a href="" class="reload"></a> </div>
                          </div>
                          <div class="portlet-body form">
                            <div class="form-body">
                              <?
                                  $newQuery7 = new WP_Query( 'p=379' );
                                   while ( $newQuery7->have_posts() ) : $newQuery7->the_post(); 
                                       the_content();
                                   endwhile; 
                                   wp_reset_query(); 
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Social Media Information -->
                      <div id="tab_8-8" class="tab-pane">
                        <div class="portlet box blue ">
                          <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-cog"></i> Social Media Information </div>
                            <div class="tools"> <a href="" class="collapse"></a> <a href="" class="reload"></a> </div>
                          </div>
                          <div class="portlet-body form">
                            <div class="form-body">
                              <?
                                  $newQuery8 = new WP_Query( 'p=381' );
                                   while ( $newQuery8->have_posts() ) : $newQuery8->the_post(); 
                                       the_content();
                                   endwhile; 
                                   wp_reset_query(); 
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Payment Preferences -->
                      <div id="tab_9-9" class="tab-pane">
                        <div class="portlet box blue ">
                          <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-cog"></i> Payment Preferences </div>
                            <div class="tools"> <a href="" class="collapse"></a> <a href="" class="reload"></a> </div>
                          </div>
                          <div class="portlet-body form">
                            <div class="form-body">
                              <?
                                  $newQuery9 = new WP_Query( 'p=383' );
                                   while ( $newQuery9->have_posts() ) : $newQuery9->the_post(); 
                                       the_content();
                                   endwhile; 
                                   wp_reset_query(); 
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                </div>
                <!-- /.tab-content -->
                   
            </div>
            <!-- /.tab-pane --> 
            <? if ($project_id1 != '') { ?>
            <div class="tab-pane" id="tab_1_3">
            	<div class="row">
                    <div class="col-md-12">
                        <div class="add-portfolio">
                            <span>
                                 <? echo get_the_title($project_id1); ?>
                            </span>
                            <a href="/dashboard/my-projects/?pid=<? echo $project_id1; ?>" class="btn icn-only green">
                                 View Project Details <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            	
            </div>
            <!-- /.tab-pane --> 
            <? } ?>
            
          </div>
          <!-- /.tab-content --> 
        </div>
      </div>
    </div>
    <!-- END PROFILE CONTENT --> 
  </div>
  <!-- END PAGE --> 
   <? include( 'inc/mobile-navigation.php' ); ?>
</div>
<!-- END CONTAINER -->


<!-- BEGIN CORE PLUGINS --> 
<!--[if lt IE 9]>
<script src="<? bloginfo( 'template_url' ); ?>/js/respond.min.js"></script>
<script src="<? bloginfo( 'template_url' ); ?>/js/excanvas.min.js"></script> 
<![endif]--> 
<script src="<? bloginfo( 'template_url' ); ?>/js/jquery-1.10.2.min.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script> 
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip --> 
<script src="<? bloginfo( 'template_url' ); ?>/js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/jquery.blockui.min.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/jquery.cookie.min.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/jquery.uniform.min.js" type="text/javascript"></script> 
<!-- END CORE PLUGINS --> 

<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<script src="<? bloginfo( 'template_url' ); ?>/js/app.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/main.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/spinner.js" type="text/javascript"></script> 
<!-- END PAGE LEVEL SCRIPTS --> 

<script>
  $(document).ready(function() {  
  	 $.ajax({
		url: '<? echo $invoice_link; ?>',
		type: 'GET',
		success: function(data) {
			var $balance = $(data).find('#account-balance').text(),
				$subtotal = $(data).find('#subtotal').text(),
				$adjustments = $(data).find('#adjustments').text();
				
				
			$('#invoice-total').text($subtotal);
			$('#payments-made').text($adjustments);
			$('#statement-balance').text($balance);
			
		}
	});
	 
	 $('#edit-profile-link a').click(function (e) {
		e.preventDefault();
		$('#account-tab-links a[href="#tab_1_2"]').tab('show');
	  });
	    
	 $('#change-avatar-link a').click(function (e) {
		e.preventDefault();
		$('#account-links li:first-child').tab('show');
	  });
	 
	 
  	$('#account-links li a').click(function(){
		$.scrollTo( '#target-examples', 800, {easing:'elasout'} );	
	});
	 
     App.init(); // initlayout and core plugins
   	 UIExtendedModals.init();
	 		  
  });
</script>
<? get_footer(); ?>
