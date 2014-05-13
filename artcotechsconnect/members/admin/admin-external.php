<?
get_header();
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
	$thread_type = get_post_meta($project_id1, 'thread_type', true);
	
	$user_type = get_user_meta( $current_user->ID, 'user_type', true );
	$invoice_link = get_user_meta( $current_user->ID, 'invoice_link', true );
	$project_calendar = get_user_meta( $current_user->ID, 'project_calendar', true );
	$project_link1 = get_user_meta( $current_user->ID, 'project_link1', true );
	$project_link2 = get_user_meta( $current_user->ID, 'project_link2', true );
	$project_type1 = get_user_meta( $current_user->ID, 'project_type1', true );
	$project_type2 = get_user_meta( $current_user->ID, 'project_type2', true );
	$project_id1 = get_user_meta( $current_user->ID, 'project_id1', true );
	$project_id2 = get_user_meta( $current_user->ID, 'project_id2', true );
	$development_link = get_user_meta( $current_user->ID, 'development_link', true );
	
	$progress = get_post_meta($project_id1, 'progress', true);
	$project_name = get_post_meta($project_id1, 'project_name', true);
	$project_phase = get_post_meta($project_id1, 'project_phase', true);
	$project_phase = get_post_meta($project_id1, 'project_phase', true);
?>
   <!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
   <link href="<? bloginfo( 'template_url' ); ?>/css/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
   <link href="<? bloginfo( 'template_url' ); ?>/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
   <link href="<? bloginfo( 'template_url' ); ?>/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
   <!-- END PAGE LEVEL PLUGIN STYLES -->
   
   <!-- BEGIN THEME STYLES --> 
   <link href="<? bloginfo( 'template_url' ); ?>/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="<? bloginfo( 'template_url' ); ?>/style.css" rel="stylesheet" type="text/css"/>
   <link href="<? bloginfo( 'template_url' ); ?>/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="<? bloginfo( 'template_url' ); ?>/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="<? bloginfo( 'template_url' ); ?>/css/tasks.css" rel="stylesheet" type="text/css"/>
   <link href="<? bloginfo( 'template_url' ); ?>/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="<? bloginfo( 'template_url' ); ?>/css/custom.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body>

   <!-- BEGIN HEADER -->  
   <? include( 'inc/navbar.php' ); ?>
   <!-- END HEADER -->
   
   <div class="clearfix"></div>
   
   
   <!-- BEGIN CONTAINER -->
   <div class="page-container">
   
      <!-- BEGIN SIDEBAR -->
   	  <? include( 'inc/navigation.php' ); ?>
      <!-- END SIDEBAR -->
      
      <!-- BEGIN PAGE -->
      <div class="page-content">
      
         <!-- BEGIN STYLE CUSTOMIZER -->
		 <? include( get_template_directory() . '/inc/style-customizer.php' ); ?>
         <!-- END BEGIN STYLE CUSTOMIZER -->   
         
         <!-- BEGIN PAGE HEADER -->
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN PAGE TITLE & BREADCRUMB-->
               <h3 class="page-title">
                  ADMIN DASHBOARD
               </h3>
               <ul class="page-breadcrumb breadcrumb">
                  <li>
                     <i class="fa fa-dashboard"></i>
                     <a href="/dashboard/">Main</a>  
                     <i class="fa fa-angle-right"></i>
                  </li>
                  <li><? the_title(); ?></li>
               </ul>
               <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
         </div>
         <!-- END PAGE HEADER -->
         
         <!-- BEGIN DASHBOARD CONTENT -->
         <div class="row">  
          	<div class="col-md-12">
            
            <!-- START INFINITE WP PANEL -->
			<? if($currPostName == 'inifinitewp'){ ?>
            	<iframe src="http://connect.artcotechs.net/wpi/login.php" width="100%" height="600" />
            <? } ?>
            <!-- END INFINITE WP PANEL -->
            
            <!-- START MYERP PANEL -->
			<? if($currPostName == 'myerp'){ ?>
            	<iframe src="https://app.myerp.com/login" width="100%" height="600" />
            <? } ?>
            <!-- END MYERP PANEL -->
            
            <!-- START INVOICE OVERVIEW PANEL -->
			<? if($currPostName == 'invoices'){ ?>
            <div id="invoices-listing"> </div>
            <? } ?>
            <!-- END INVOICE OVERVIEW PANEL -->
            
            </div>      
         </div>   
         <!-- END DASHBOARD CONTENT -->   
         
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

<script src="<? bloginfo( 'template_url' ); ?>/js/select2.min.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/jquery.dataTables.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/DT_bootstrap.js" type="text/javascript"></script> 


<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<? bloginfo( 'template_url' ); ?>/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<? bloginfo( 'template_url' ); ?>/js/bootstrap-modal.js" type="text/javascript"></script>
<script src="<? bloginfo( 'template_url' ); ?>/js/app.js" type="text/javascript"></script>
<script src="<? bloginfo( 'template_url' ); ?>/js/main.js" type="text/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/table-managed.js" type="text/javascript"></script>  
<script src="<? bloginfo( 'template_url' ); ?>/js/table-editable.js" type="text/javascript"></script>     
<script src="<? bloginfo( 'template_url' ); ?>/js/iscroll.js" type="application/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/amn-scripts.js" type="text/javascript"></script>         
<!-- END PAGE LEVEL SCRIPTS --> 

<script src="<? bloginfo( 'template_url' ); ?>/js/ui-extended-modals.js"></script>

<script>
  $(document).ready(function() { 
  
  	/*	Fetch All Invoices and display on Admin Dashboard
		===========================================================================*/ 
		$.ajax({
			url: 'http://connect.artcotechs.net/wp-admin/admin.php?page=wpi_main',
			type: 'GET',
			success: function(data) {
				var $invoice_pane = $(data).find('#the-list');
					
				$('#invoices-listing').html($invoice_pane.html());
				$('.row-actions').hide();
			}
		});  
  
    App.init();
	TableManaged.init();
   	UIExtendedModals.init();

  });
</script>
   
<? 
  // Get all User Modals for admin functionality
  //admin_user_manage_modals(get_users()); 
  
  // Get all Project Modals for admin functionality
  //admin_projects_manage_modals();
  
  // Get all Recent Activity Modals for admin functionality
  //admin_recent_activity_modals();
?>
<? get_footer(); ?>









