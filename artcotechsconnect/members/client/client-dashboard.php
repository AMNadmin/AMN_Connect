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
                  CLIENT DASHBOARD
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
         	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <!-- START PROJECT STATUS PORTLET -->
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="fa fa-file-text"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                             <? if($progress != '' ) { echo $progress; } else { echo '0'; } ?>%
                        </div>
                        <div class="desc">
                             Project Status
                        </div>
                    </div>
                    <a class="more" href="/dashboard/my-projects/?pid=<? $project_id1; ?>">
                         View status <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
                <!-- END PROJECT STATUS PORTLET -->
                
                <!-- START PROJECT OVERVIEW -->
        		<div class="portlet box blue" id="dashboard-project-overview-panel">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-file-text"></i> Project Overview</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a><a href="javascript:;" class="reload"></a>
                        </div>
                    </div>
                    <div class="portlet-body" id="dashboard-project-portlet-body">
                        <? if ($project_id1 != '') { ?>
						<blockquote><p>Quick overview of your open project(s) status with Artcotechs.</p></blockquote>
                        <h3><? echo get_the_title($project_id1); ?></h3>
                        <?php if( $progress > 0 ){ ?>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%">
                                <span class="sr-only">
                                    <? if($progress != '' ) { echo $progress; } else { echo '0'; } ?>% Complete 
                                </span>
                            </div>
                        </div>
                        <? } ?>
                        <h4><? if($progress != '' ) { echo $progress; } else { echo '0'; } ?>% complete</h4>
                        <h6><strong>Project Phase:</strong> <? if($project_phase != '' ) { echo $project_phase; } else { echo 'Not Started'; } ?></h6>
                        <div>
                        	<a href="/dashboard/my-projects/?pid=<? echo $project_id1; ?>" class="btn btn-sm green all-projects-btn" title="View Project Detail"><i class="fa fa-file-text"></i> View Project Details</a><br><br>
                        	<a class="btn btn-sm blue" id="/dashboard/my-projects/?view=questionnaires"><i class="fa fa-info-circle"></i> Questionnaire Results</a>
                            <br><br>
                        </div>
                        <div class="clearfix">
                        </div>
                        <? }
						else {  ?>
                        	<h2>NO OPEN PROJECT</h2>
                        <? } ?>
                    </div>
                </div>
                <!-- END PROJECT OVERVIEW -->
            </div>
            <!-- /.col-lg-6 -->
            
         	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            
                <!-- START INVOICE OVERVIEW PORTLET -->
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="details">
                        <div class="number account-balance">
                             
                        </div>
                        <div class="desc">
                             Account Balance
                        </div>
                    </div>
                    <a class="more" href="<? echo $invoice_link; ?>">
                         View invoice <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
                <!-- END INVOICE OVERVIEW PORTLET -->
                
            	<!-- START INVOICE OVERVIEW -->
        		<div class="portlet box green" id="dashboard-invoice-overview-panel">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-credit-card"></i> Payment Center</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a><a href="javascript:;" class="reload"></a>
                        </div>
                    </div>
                    <div class="portlet-body" id="invoice-overview-portlet-body">
                    
						<? if($invoice_link != ''){ ?>
                        <div class="portlet sale-summary">
                            <div class="portlet-title">
                                <div class="caption">Account Overview</div>
                            </div>
                            <div class="portlet-body">
                                <div class="ajax-place-loader"><img src="<? bloginfo( 'template_url' ); ?>/images/main/ajax-loading.gif" alt=""></div>
                                <blockquote><p id="invoice_description"></p></blockquote>
                                <div id="wpi_checkout_form_wrapper"></div>
                                <div class="clearfix" id="wpi_checkout">
                                    <a href="<? echo $invoice_link; ?>" id="make-payment-btn" class="btn btn-sm green"><i class="fa fa-money"></i> Make a Payment</a>
                                </div>
                            </div>
                        </div>
						<? }
                        else { ?>
                            <h2>NO CURRENT INVOICE</h2>
                        <? } ?>
                        
                	</div>
					<!-- #invoice-overview-portlet-body -->
				</div>
            	<!-- END INVOICE OVERVIEW -->
            
            </div>
            <!-- col-md-6 -->
            
         </div> 
         <!-- END DASHBOARD CONTENT-->
         
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









