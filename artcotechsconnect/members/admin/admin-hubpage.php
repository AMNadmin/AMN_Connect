<? 
global $userMeta, $user_identity, $userInfo, $user_ID, $wp_query, $wpdb, $wpc_client, $wp_crm, $current_user;

if(!is_user_logged_in()) {
	
	header('Location: http://connect.artcotechs.net/');
 } 
else {	 
 
	get_header(); ?>
	
	   <!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
	   <link href="<? bloginfo( 'template_url' ); ?>/css/select2_metro.css" rel="stylesheet" type="text/css" />
	   <link href="<? bloginfo( 'template_url' ); ?>/css/DT_bootstrap.css" rel="stylesheet" type="text/css"/>
	   <!-- END PAGE LEVEL PLUGIN STYLES -->
	   
	   
		<link href="<? bloginfo( 'template_url' ); ?>/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="<? bloginfo( 'template_url' ); ?>/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
        
        
        <link href="<? bloginfo( 'template_url' ); ?>/css/datepicker.css" rel="stylesheet" type="text/css"/>
        <link href="<? bloginfo( 'template_url' ); ?>/css/datetimepicker.css" rel="stylesheet" type="text/css"/>
        <link href="<? bloginfo( 'template_url' ); ?>/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="<? bloginfo( 'template_url' ); ?>/css/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
        
	
	   <!-- BEGIN THEME STYLES --> 
	   <link href="<? bloginfo( 'template_url' ); ?>/css/style-metronic.css" rel="stylesheet" type="text/css"/>
	   <link href="<? bloginfo( 'template_url' ); ?>/style.css" rel="stylesheet" type="text/css"/>
	   <link href="<? bloginfo( 'template_url' ); ?>/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	   <link href="<? bloginfo( 'template_url' ); ?>/css/plugins.css" rel="stylesheet" type="text/css"/>
	   <link href="<? bloginfo( 'template_url' ); ?>/css/tasks.css" rel="stylesheet" type="text/css"/>
	   <link href="<? bloginfo( 'template_url' ); ?>/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	   <!-- END THEME STYLES -->
	</head>
	<!-- END HEAD -->
    
	<!-- BEGIN BODY -->
	<body>
	   <!-- BEGIN HEADER -->  
	   <? include( 'inc/topbar.php' ); ?>
	   <!-- END HEADER -->
	   
	   <div class="clearfix"></div>
	   
	   <!-- BEGIN CONTAINER -->
	   <div class="page-container">
		  <!-- BEGIN SIDEBAR -->
		  <? include( 'inc/menu-admin.php' ); ?>
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
					  <? if(!isset($_GET['last_variable']) || $_GET['last_variable'] == ''){ echo 'Administrator Dashboard'; } else { echo $_GET['last_variable']; } ?> 
				   </h3>
				</div>
			 </div>
			 <!-- END PAGE HEADER-->
             
			 <!-- BEGIN PAGE CONTENT-->
			 <div class="row">
			 
				<div class="col-md-12">
					<div class="portlet box tabbable">
						<section>
							<div class="navbar navbar-inverse" role="navigation" id="main-connect-navbar">
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header active">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
										<img src="<? bloginfo( 'template_url' ); ?>/images/main/menu-toggler.png" alt="">
									</button>
									<a class="navbar-brand connect"  data-toggle="tab" href="#dashboard-overview"><img src="<? echo get_template_directory_uri() . '/images/main/amn-manhead-icon.png'; ?>" height="20" width="20" alt=""></a>
								</div>
								<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse navbar-ex1-collapse">
									<ul class="nav navbar-nav">
										<li id="all-activities-tab"><a href="#all-activities" data-toggle="tab"><i class="fa fa-exchange"></i> Activities</a></li>
										<li id="all-messages-tab" class="active"><a href="#all-messages" data-toggle="tab"><i class="fa fa-comments"></i> Project Messages</a></li>
										<li><a href="#all-users" data-toggle="tab"><i class="fa fa-group"></i> Users</a></li>
										<li><a href="#all-projects" data-toggle="tab"><i class="fa fa-folder-open"></i> Projects</a></li>
										<li><a href="#all-invoices" data-toggle="tab"><i class="fa fa-credit-card"></i> Invoices</a></li>
										<li><a href="#all-accounts" data-toggle="tab"><i class="fa fa-user"></i> Accounts</a></li>
										<li><a href="#all-inbox" data-toggle="tab"><i class="fa fa-inbox"></i> Inbox</a></li>
									</ul>
								</div>
								<!-- /.navbar-collapse -->
							</div>
							<!-- /.navbar -->
						</section>
						<div class="portlet-body">
							
							<div class="tab-content">
							
								<!-- START MESSAGES OVERVIEW PANE -->
								<div class="tab-pane admin-control-pane active" id="all-messages">
									<h2><i class="fa fa-comments"></i> Project Messaging</h2>
									<? include( 'views/all-messages.php' ); ?>
								</div>
								<!-- END MESSAGES OVERVIEW PANE -->
								
								<!-- START DASHBOARD OVERVIEW PANE -->
								<div class="tab-pane admin-control-pane" id="all-activities">
									<h2><i class="fa fa-bell-o"></i> Recent Activities</h2>
									<? include( 'views/all-activities.php' ); ?>
								</div>
								<!-- DASHBOARD OVERVIEW PANE -->
								
								<!-- START USER MANAGEMENT PANE -->
								<div class="tab-pane admin-control-pane" id="all-users">
									<h2><i class="fa fa-group"></i> Connect Members</h2>
									<? include( 'views/all-users.php' ); ?>
								</div>
								<!-- END USER MANAGEMENT PANE -->
								
								<!-- START USER MANAGEMENT PANE -->
								<div class="tab-pane admin-control-pane" id="all-projects">
									<h2><i class="fa fa-folder-open"></i> Connect Projects</h2>
									<? include( 'views/all-projects.php' ); ?>
								</div>
								<!-- END USER MANAGEMENT PANE -->
								
								<!-- START INVOICES PANE -->
								<div class="tab-pane admin-control-pane" id="all-invoices">
									<h2><i class="fa fa-credit-card"></i> Invoices Overview</h2>
									<? include( 'views/all-invoices.php' ); ?>
								</div>
								<!-- END INVOICES PANE -->
								
								<!-- START ACCOUNTS PANE -->
								<div class="tab-pane admin-control-pane" id="all-accounts">
									<h2><i class="fa fa-user"></i> Member Accounts</h2>
									<? include( 'views/all-accounts.php' ); ?>
								</div>
								<!-- END ACCOUNTS PANE -->
                                
                                <!-- START ACCOUNTS PANE -->
								<? include( 'views/loop-users.php' ); ?>
								<!-- END ACCOUNTS PANE -->
                                
                                
                                <!-- START LOOP ADMIN OVERHEAD PANES -->
								<? include( 'views/loop-overhead.php' ); ?>
								<!-- START LOOP ADMIN OVERHEAD PANES -->
	
	
							</div>
						
						</div>
						<!-- /.portlet-body -->
					</div>
					<!-- /.portlet -->
				</div>
				<!-- START ADMIN DASHBOARD -->
				<? //include( 'inc/admin-dash.php' ); ?>
				<!-- END ADMIN DASHBOARD -->
			 </div>
			 
			 
			 <!-- END PAGE CONTENT-->
		  </div>
		  <!-- END PAGE -->
	   </div>
	   <!-- END CONTAINER -->
	
	
	
	  
	<!-- BEGIN CORE PLUGINS -->   
	<!--[if lt IE 9]>
	<script src="<? bloginfo( 'template_url' ); ?>/js/respond.min.js"></script>
	<script src="<? bloginfo( 'template_url' ); ?>/js/excanvas.min.js"></script> 
	<![endif]-->   
	<script src="<? bloginfo( 'template_url' ); ?>/js/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="<? bloginfo( 'template_url' ); ?>/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script> 
	<script src="<? bloginfo( 'template_url' ); ?>/js/bootstrap.min.js" type="text/javascript"></script>  
	<script src="<? bloginfo( 'template_url' ); ?>/js/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<? bloginfo( 'template_url' ); ?>/js/jquery.blockui.min.js" type="text/javascript"></script> 
	<script src="<? bloginfo( 'template_url' ); ?>/js/jquery.cokie.min.js" type="text/javascript"></script> 
	<script src="<? bloginfo( 'template_url' ); ?>/js/jquery.uniform.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<? bloginfo( 'template_url' ); ?>/js/select2.min.js" type="text/javascript"></script> 
	<script src="<? bloginfo( 'template_url' ); ?>/js/jquery.dataTables.js" type="text/javascript"></script> 
	<script src="<? bloginfo( 'template_url' ); ?>/js/DT_bootstrap.js" type="text/javascript"></script> 
	<!-- END PAGE LEVEL SCRIPTS --> 
	
	
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
	
	<script src="<? bloginfo( 'template_url' ); ?>/js/fullcalendar.min.js" type="text/javascript"></script>
	<script src="<? bloginfo( 'template_url' ); ?>/js/bootstrap-modalmanager.js" type="text/javascript"></script>
	<script src="<? bloginfo( 'template_url' ); ?>/js/bootstrap-modal.js" type="text/javascript"></script>
	<script src="<? bloginfo( 'template_url' ); ?>/js/app.js" type="text/javascript"></script>
	<script src="<? bloginfo( 'template_url' ); ?>/js/index.js" type="text/javascript"></script>
	<script src="<? bloginfo( 'template_url' ); ?>/js/main.js" type="text/javascript"></script>   
	<script src="<? bloginfo( 'template_url' ); ?>/js/table-managed.js" type="text/javascript"></script>  
	<script src="<? bloginfo( 'template_url' ); ?>/js/table-editable.js" type="text/javascript"></script>  
	<script src="<? bloginfo( 'template_url' ); ?>/js/spinner.js" type="text/javascript"></script>
	<script src="<? bloginfo( 'template_url' ); ?>/js/iscroll.js" type="application/javascript"></script> 
	<script src="<? bloginfo( 'template_url' ); ?>/js/amn-scripts.js" type="text/javascript"></script> 
    
    
    
	<script src="<? bloginfo( 'template_url' ); ?>/js/bootstrap-datepicker.js" type="text/javascript"></script> 
	<script src="<? bloginfo( 'template_url' ); ?>/js/moment.min.js" type="text/javascript"></script> 
	<script src="<? bloginfo( 'template_url' ); ?>/js/daterangepicker.js" type="text/javascript"></script> 
	<script src="<? bloginfo( 'template_url' ); ?>/js/bootstrap-datetimepicker.js" type="text/javascript"></script> 
    	
	<script src="<? bloginfo( 'template_url' ); ?>/js/ui-extended-modals.js"></script>	
	<!-- END PAGE LEVEL SCRIPTS --> 
	
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
				  
		App.init(); // initlayout and core plugins
		//TableEditable.init();
		TableManaged.init();
		UIExtendedModals.init();
		
	  });
	</script>
	   	
	<? 
		// Get all User Modals for admin functionality
		admin_user_manage_modals(get_users()); 
		
		// Get all Project Modals for admin functionality
		admin_projects_manage_modals();
		
		// Get all Recent Activity Modals for admin functionality
		admin_recent_activity_modals();
	?>
	<? get_footer(); ?>
	<? include( 'inc/footer.php' ); ?>

<? } ?>