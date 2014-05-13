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
                  <? the_title(); ?>
               </h3>
               <ul class="page-breadcrumb breadcrumb">
                  <li>
                     <i class="fa fa-dashboard"></i>
                     <a href="/">Main</a>  
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
         	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <? the_content(); ?>
            
            </div>
            <!-- col-md-6 -->
            
         </div> 
         <!-- END DASHBOARD CONTENT-->
         
      </div>
      <!-- END PAGE -->
      
   </div>
   <!-- END CONTAINER -->
   


<? include( 'inc/mobile-navigation.php' ); ?>

  
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
<script src="<? bloginfo( 'template_url' ); ?>/js/table-editable.js" type="text/javascript"></script>    
<script src="<? bloginfo( 'template_url' ); ?>/js/iscroll.js" type="application/javascript"></script> 
<script src="<? bloginfo( 'template_url' ); ?>/js/spinner.js" type="text/javascript"></script>       
<script src="<? bloginfo( 'template_url' ); ?>/js/amn-scripts.js" type="text/javascript"></script>         
<!-- END PAGE LEVEL SCRIPTS --> 

<script src="<? bloginfo( 'template_url' ); ?>/js/ui-extended-modals.js"></script>


<script>
  $(document).ready(function() { 
  
  /* DISPLAY CLIENT DASHBOARD DISPLAYS  
	==============================================================*/
	<? if($invoice_link != ''){ ?>	
		//fetch_invoice_balance('<? echo $invoice_link; ?>');
		invoice_overview('<? echo $invoice_link; ?>');
		show_invoice_page('<? echo $invoice_link; ?>');
		account_summary_overview('<? echo $invoice_link; ?>');
		fetch_invoice_balance('<? echo $invoice_link; ?>');
	<? } ?>
  
    App.init();
   	UIExtendedModals.init();

  });
</script>
   
   
   
<? 
	// Show Messaging Action Modals
	show_messaging_action_modals( $project_id1 );
	
	// Show Registration Successful Modal
	register_success_modal();
?>

<? get_footer(); ?>









