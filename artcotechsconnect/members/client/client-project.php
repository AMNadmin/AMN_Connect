<?
	get_header();
	$thread_type = get_post_meta(get_the_id(), 'thread_type', true);
	$progress = get_post_meta(get_the_id(), 'progress', true);
	$project_name = get_post_meta(get_the_id(), 'project_name', true);
	$project_phase = get_post_meta(get_the_id(), 'project_phase', true);
	$project_phase = get_post_meta(get_the_id(), 'project_phase', true);
	
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
	
	
	$quest_arrays = array();
	$brandmark_design_form = get_post_meta($project_id1, 'brandmark-design-form', true); 
	$web_development_form = get_post_meta($project_id1, 'web-development-form', true); 
	$graphic_design_form = get_post_meta($project_id1, 'graphic-design-form', true); 
	$event_brand_form = get_post_meta($project_id1, 'event-brand-form', true); 
	$social_media_form = get_post_meta($project_id1, 'social-media-form', true); 
	if($brandmark_design_form != NULL) { array_push($quest_arrays, $brandmark_design_form); }
	if($web_development_form != NULL) { array_push($quest_arrays, $web_development_form); }
	if($graphic_design_form != NULL) { array_push($quest_arrays, $graphic_design_form); }
	if($event_brand_form != NULL) { array_push($quest_arrays, $event_brand_form); }
	if($social_media_form != NULL) { array_push($quest_arrays, $social_media_form); }
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
   <link href="<? bloginfo( 'template_url' ); ?>/css/timeline.css" rel="stylesheet" type="text/css"/>
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
                  Project Overview
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
         
         <!-- BEGIN PROJECT CONTENT -->
         <div class="row">
         	<div class="col-md-12">
         	  <div class="tabbable-custom">
                  <ul class="nav nav-tabs ">
                    <li class="active"> <a href="#tab_1_1" data-toggle="tab">Details</a> </li>
                    <li class=""> <a href="#tab_1_2" data-toggle="tab">Timeline</a> </li>
                    <li class=""> <a href="#tab_1_3" data-toggle="tab">Questionnaires</a> </li>
					<? if(isset($quest_arrays) && $quest_arrays != NULL) { ?>
                    <li class=""> <a href="#tab_1_4" data-toggle="tab">Results</a> </li>
                    <? }?>
                  </ul>
                  <div class="tab-content">
						<!-- START PROJECT DETAILS-->
                  		<div class="tab-pane active" id="tab_1_1">
                        	<h3>DETAIL INFORMATION</h3>
                            <section id="project-details-section">
                            
                              <div class="panel-group accordion" id="accordion1">
                              
                                  <div class="panel panel-primary">
                                  		<div class="panel-heading">
                                      <h4 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1"> <i class="fa fa-list-ul"></i> Project Details </a> </h4>
                                    </div>
                                    	<div id="collapse_1" class="panel-collapse in">
                                      <div class="panel-body">
                                        <div class="note note-success">
                                          <?
                                            $clientID = get_post_meta(get_the_id(), 'client_ID', true);
                                            $firstName = get_user_meta($clientID, 'first_name', true);
                                            $lastName = get_user_meta($clientID, 'last_name', true);
                                            $client_name  = $firstName . ' ' . $lastName;
                                          ?>
                                          <address>
                                          <p><strong>Client Name: </strong><?php echo $client_name; ?></p>
                                          <p><strong>Project Start: </strong><?php echo get_post_meta(get_the_id(), 'project_start', true); ?></p>
                                          <p><strong>Predicted End: </strong> <?php echo get_post_meta(get_the_id(), 'project_end', true); ?></p>
                                          <p><strong>Project Description: </strong><?php echo get_post_meta(get_the_id(), 'the_project_description', true); ?></p>
                                          <? if($pm1_name != ''){  ?>
                                          <p><strong>Project Administrator: </strong><?php echo $pm1_name; ?></p>
                                          <? } ?>
                                          </address>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
								  <?php if( get_post_meta($project_id1, 'wp_url', true) != ''){  ?>
                                  <div class="panel panel-primary">
                                        <div class="panel-heading">
                                          <h4 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_2"> <i class="fa fa-code"></i> Wordpress Credentials </a> </h4>
                                        </div>
                                        <div id="collapse_2" class="panel-collapse collapse">
                                          <div class="panel-body">
                                            <div class="note note-success">
                                              <address>
                                              <p><strong>WP Admin URL: </strong><a href="<?php echo get_post_meta($project_id1, 'wp_url', true); ?>"><?php echo get_post_meta($project_id1, 'wp_url', true); ?></a></p>
                                              <p><strong>WP Username: </strong><?php echo get_post_meta($project_id1, 'wp_username', true); ?></p>
                                              <p><strong>WP Password: </strong> <?php echo get_post_meta($project_id1, 'wp_password', true); ?></p>
                                              <p><strong>Development Link: </strong><a href="<?php echo get_post_meta($project_id1, 'development_link', true); ?>"><?php echo get_post_meta($project_id1, 'development_link', true); ?></a></p>
                                              </address>
                                            </div>
                                          </div>
                                        </div>
                                  </div>
                                  <? } ?>
                                  <?php if( get_post_meta($project_id1, 'ftp_url', true) != ''){  ?>
                                  <div class="panel panel-primary">
                                    	<div class="panel-heading">
                                      <h4 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_3"> <i class="fa fa-exchange"></i> FTP Credentials </a> </h4>
                                    </div>
                                    <div id="collapse_3" class="panel-collapse collapse">
                                      <div class="panel-body">
                                        <div class="note note-success">
                                          <address>
                                          <p><strong>FTP Path: </strong><?php echo get_post_meta($project_id1, 'ftp_url', true); ?></p>
                                          <p><strong>FTP Username: </strong><?php echo get_post_meta($project_id1, 'ftp_username', true); ?></p>
                                          <p><strong>FTP Password: </strong> <?php echo get_post_meta($project_id1, 'ftp_password', true); ?></p>
                                          </address>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <? } ?>
                                  <div class="panel panel-primary">
                                        <div class="panel-heading">
                                          <h4 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_5"> <i class="fa fa-gears"></i> Terms of Services </a> </h4>
                                        </div>
                                        <div id="collapse_5" class="panel-collapse collapse">
                                          <div class="panel-body">
                                            <section>
                                              <?php $newQuery = new WP_Query('post_type=post&p=307');
                                                while ( $newQuery->have_posts() ) : $newQuery->the_post(); 
                                                 the_content(); 
                                             endwhile;
                                             wp_reset_query(); 
                                            ?>
                                            </section>
                                          </div>
                                        </div>
                                  </div>
                              </div>
                              <!-- /.panel-group -->
                            </section>
                        </div>
						<!-- END PROJECT DETAILS-->
                        
						<!-- BEGIN PROJECT TIMELINE -->
                  		<div class="tab-pane" id="tab_1_2">
                        	<h3>PROJECT TIMELINE</h3>
                          	<div class="col-md-12">
                              <ul class="timeline">
                                  <li class="timeline-yellow">
                                      <div class="timeline-time">
                                          <span class="date">
                                               20%
                                          </span>
                                          <span class="time">
                                               Discovery
                                          </span>
                                      </div>
                                      <div class="timeline-icon">
                                          <i class="fa fa-trophy"></i>
                                      </div>
                                      <div class="timeline-body">
                                          <h2>Discovery</h2>
                                          <div class="timeline-content">
                                              <?php echo get_post_meta(get_the_id(), 'twenty_percent_desc', true); ?>
                                          </div>
                                      </div>
                                  </li>
                                  <li class="timeline-blue">
                                      <div class="timeline-time">
                                          <span class="date">
                                               40%
                                          </span>
                                          <span class="time">
                                               Design
                                          </span>
                                      </div>
                                      <div class="timeline-icon">
                                          <i class="fa fa-video-camera"></i>
                                      </div>
                                      <div class="timeline-body">
                                          <h2>Design</h2>
                                          <div class="timeline-content">
                                              <?php echo get_post_meta(get_the_id(), 'forty_percent_desc', true); ?>
                                          </div>
                                      </div>
                                  </li>
                                  <li class="timeline-green">
                                      <div class="timeline-time">
                                          <span class="date">
                                               60%
                                          </span>
                                          <span class="time">
                                               Development
                                          </span>
                                      </div>
                                      <div class="timeline-icon">
                                          <i class="fa fa-comments"></i>
                                      </div>
                                      <div class="timeline-body">
                                          <h2>Development</h2>
                                          <div class="timeline-content">
                                              <?php echo get_post_meta(get_the_id(), 'sixty_percent_desc', true); ?>
                                          </div>
                                      </div>
                                  </li>
                                  <li class="timeline-grey">
                                      <div class="timeline-time">
                                          <span class="date">
                                               80%
                                          </span>
                                          <span class="time">
                                               Launch
                                          </span>
                                      </div>
                                      <div class="timeline-icon">
                                          <i class="fa fa-comments"></i>
                                      </div>
                                      <div class="timeline-body">
                                          <h2>Launch</h2>
                                          <div class="timeline-content">
                                              <?php echo get_post_meta(get_the_id(), 'eighty_percent_desc', true); ?>
                                          </div>
                                      </div>
                                  </li>
                                  <li class="timeline-red">
                                      <div class="timeline-time">
                                          <span class="date">
                                              100%
                                          </span>
                                          <span class="time">
                                               Post Launch
                                          </span>
                                      </div>
                                      <div class="timeline-icon">
                                          <i class="fa fa-comments"></i>
                                      </div>
                                      <div class="timeline-body">
                                          <h2>Post Launch</h2>
                                          <div class="timeline-content">
                                              <?php echo get_post_meta(get_the_id(), 'hundred_percent_desc', true); ?>
                                          </div>
                                      </div>
                                  </li>
                              </ul>
                          	</div>
                      	</div>
						<!-- END PROJECT TIMELINE-->
                        
						<!-- BEGIN PROJECT QUESTIONNAIRES -->
						<div class="tab-pane" id="tab_1_3">
                        	<h3>PROJECT QUESTIONNAIRES</h3>
                        	<section id="account-questionnaires-panel"> 
                    
                                <div class="tabbable tabs-left">
                                  <ul class="nav nav-tabs" id="questionnaires-nav-tabs">
                                    <li id="quest-tab-block"><span id="quest-tab"><i class="fa fa-question"></i> Questionnaires</span></li>
                                    <li class="active"><a href="#tab_6_1" class="quest-type" data-toggle="tab"><i class="fa fa-caret-right"></i> Brandmark Design</a></li>
                                    <li><a href="#tab_6_2" class="quest-type" data-toggle="tab"><i class="fa fa-caret-right"></i> Event Branding</a></li>
                                    <li><a href="#tab_6_3" class="quest-type" data-toggle="tab"><i class="fa fa-caret-right"></i> Graphic Design</a></li>
                                    <li><a href="#tab_6_4" class="quest-type" data-toggle="tab"><i class="fa fa-caret-right"></i> Web Design + Development</a></li>
                                    <li><a href="#tab_6_5" class="quest-type" data-toggle="tab"><i class="fa fa-caret-right"></i> Social Media Management</a></li>
                                  </ul>
                                  <div class="tab-content" id="tab-content-questionnaires">
                                    
                                    <div class="tab-pane active" id="tab_6_1">
                                      <? include( get_template_directory(). '/members/client/forms/brandmark-design.php' ); ?>
                                    </div>
                                    <div class="tab-pane" id="tab_6_2">
                                      <? include( get_template_directory(). '/members/client/forms/event-branding.php' ); ?>
                                    </div>
                                    <div class="tab-pane" id="tab_6_3">
                                      <? include( get_template_directory(). '/members/client/forms/graphic-design.php' ); ?>
                                    </div>
                                    <div class="tab-pane" id="tab_6_4">
                                      <? include( get_template_directory(). '/members/client/forms/web-development.php' ); ?>
                                    </div>
                                    <div class="tab-pane" id="tab_6_5">
                                      <? include( get_template_directory(). '/members/client/forms/social-media.php' ); ?>
                                    </div>
                                  </div>
                                  <!-- /.tab-content --> 
                                  
                                </div>
                                <!-- /.tabbable --> 
                            
                        	</section>
                        </div>
						<!-- END PROJECT QUESTIONNAIRES -->
                        
						<? if(isset($quest_arrays) && $quest_arrays != NULL) { ?>
						<!-- BEGIN QUESTIONNAIRES RESULTS -->
                  			<div class="tab-pane" id="tab_1_4">
                        	 <h3>QUESTIONNAIRE RESULTS</h3>
                          	 <!-- PROJECT QUESTIONNAIRES RESULTS PANEL -->
							 <div class="panel-group accordion" id="accordion2">
                              
							 <?	$quest_index = 1;
                              	foreach($quest_arrays as $quest){ 
							  		$qRotate  =  $quest; 
									$cntr = 0;
								?>
								  <?  foreach($qRotate as $key => $val) {
									  if($key == 'form_title'){ $form_title = $val; }
									  if($key == 'questionnaire_slug'){ $questionnaire_slug = $val; }
							  		}	 
								?>
                              <!-- START <? echo $form_title; ?> PANEL -->
                              <div class="panel panel-primary">
                                <div class="panel-heading">
                                  <h4 class="panel-title"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#<? echo $questionnaire_slug; ?>"> <? echo $form_title; ?> Results </a> </h4>
                                </div>
                                <div id="<? echo $questionnaire_slug; ?>" class="panel-collapse collapse <? if($quest_index == 1){ ?>in<? } ?>">
                                  <div class="panel-body">
                                    <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                      <tr>
                                        <th></th>
                                        <th>QUESTION</th>
                                        <th>ANSWERS</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        
                                      <?	
									  foreach($quest as $key => $val) {
									  if($key != 'form_title' && $key != 'questionnaire_slug' && $key != 'project_id'){ 
										$key = str_replace('_',' ',$key); 	
										$cntr++;
										?>
                                      <tr>
                                      	<td><? echo $cntr; ?>.</td>
                                        <td width="50%"><strong><? echo $key; ?></strong></td>
                                        <td width="50%"><? echo $val; ?></td>
                                      </tr>
                                      <?  }
                                            }
                                           ?>
                                    </tbody>
                                  </table>
                                  </div>
								</div>
                              </div>
                              <!-- END <? echo $form_title; ?> PANEL -->
						      <? $quest_index++;
							  	} ?>
                              
							 </div>
                          	 <!-- PROJECT QUESTIONNAIRES RESULTS PANEL -->
                        </div>
						<!-- END QUESTIONNAIRES RESULTS -->
						<? } ?>
                  </div>
                  <!-- /.tab-content -->
             </div>
             <!-- /.tabbable-custom -->
          	</div>
          </div>
	      <!-- END PROJECT CONTENT -->
              
         
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
	<? } ?>
  
    App.init();
   	UIExtendedModals.init();

  });
</script>
   
   
   
<? 
	// Show Messaging Action Modals
	show_messaging_action_modals( get_the_id() );
	
	// Show Registration Successful Modal
	register_success_modal();
?>

<? get_footer(); ?>









