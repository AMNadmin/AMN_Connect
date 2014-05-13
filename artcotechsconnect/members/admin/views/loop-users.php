<? 

$all_members = get_users();
foreach($all_members as $user) { 
$user_avatar = get_user_meta( $user->ID, 'user_avatar', true );
$project_id1 = get_user_meta( $user->ID, 'project_id1', true );
$fullName = $user->first_name . ' '. $user->last_name;
$currUserProperty = new WP_User( $user->ID ); 
$all_meta_for_user = get_user_meta( $user->ID );
$userRole = '';
if ( !empty( $currUserProperty->roles ) && is_array( $currUserProperty->roles ) ) { 
  foreach ( $currUserProperty->roles as $role )
	  $userRole = $role; 
} 
switch($userRole)
{
case 'administrator':
  $capUserRole = 'Administrator';
  break;
case 'super_admin':
  $capUserRole = 'Administrator';
  break;
case 'wpc_client':
  $capUserRole = 'Client';
  break;
case 'embassador':
  $capUserRole = 'Embassador';
  break;
case 'editor':
  $capUserRole = 'Editor';
  break;
case 'subscriber':
  $capUserRole = 'Subscriber';
  break;
}

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
<!-- START SINGLE USER PANE-<? echo $user->ID; ?> -->
<div class="tab-pane single-user-pane" id="single-user-<? echo $user->ID; ?>">
  <h2><i class="fa fa-folder-open"></i> <? if($fullName != '') { echo $fullName; } else { echo $user->display_name; } ?>'s Account</h2>
  <div class="row">
    <div class="col-md-12 block clearfix"> <a class="btn dark pull-right" href="#all-users" data-toggle="tab"><i class="fa fa-long-arrow-left"></i> Back to all users</a> <br><br></div>
    <div class="col-md-12 block clearfix"> <a class="btn green pull-right" href="#edit-user-pane-<? echo $user->ID; ?>" data-toggle="modal"><i class="fa fa-user"></i> Edit <? if($fullName != '') { echo $fullName; } else { echo $user->display_name; } ?>'s Profile </a> </div>
    <br>
  </div>
  <div class="row">
  
    <div class="col-md-6">
    	<h3><i class="fa fa-user"></i> Account Overview</h3>
      <!-- START PANEL -->
      <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#client-information-panel" href="#client-detail-results-<? echo $user->ID; ?>">Client Details <i class="fa fa-angle-down"></i></a></h4>
        </div>
        <div id="client-detail-results-<? echo $user->ID; ?>" class="panel-collapse in">
        <div class="panel-body">
          <table class="table table-bordered table-striped table-condensed" id="client-info-table">
            <thead>
              <tr>
                <th align="center" width="40%">DETAIL</th>
                <th align="center" width="60%">INFORMATION</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              	<td colspan="2" align="center">PERSONAL INFORMATION</td>
              </tr>
              <tr>
                <td>ID</td>
                <td><div><? echo $user->ID; ?></div></td>
              </tr>
              <? if($user->first_name != ''){ ?>
              <tr>
                <td>First Name</td>
                <td><div><? echo $user->first_name; ?></div></td>
              </tr>
              <? } ?>
              <? if($user->last_name != ''){ ?>
              <tr>
                <td>Last Name</td>
                <td><div><? echo $user->last_name; ?></div></td>
              </tr>
              <? } ?>
              <? if($user->nickname != ''){ ?>
              <tr>
                <td>Nickname</td>
                <td><div><? echo $user->nickname; ?></div></td>
              </tr>
              <? } ?>
              <tr>
                <td>Avatar</td>
                <td align="left"><? if($user_avatar != ''){ ?>
                  <a href="#edit-user-pane-<? echo $user->ID; ?>" data-toggle="modal" title="Edit User"> <img src="<? bloginfo( 'siteurl' ); ?>/wp-content/uploads<? echo $user_avatar; ?>" alt="User Avatar" class="member-avatar">
                  <? } else { ?>
                  <img src="<? bloginfo( 'template_url' ); ?>/images/main/amn-manhead-icon.png" width="25" height="25" alt="User Avatar" class="member-avatar">
                  <? } ?>
                  </a></div></td>
              </tr>
              <? if($user->display_name != ''){ ?>
              <tr>
                <td>Username</td>
                <td><div><? echo $user->display_name; ?></div></td>
              </tr>
              <? } ?>
              <? if($user->user_email != ''){ ?>
              <tr>
                <td>Email</td>
                <td><div><a href="mailto:<? echo $user->user_email; ?>"><? echo $user->user_email; ?></a></div></td>
              </tr>
              <? } ?>
              <tr>
                <td>Role</td>
                <td><div><? echo $capUserRole; ?></div></td>
              </tr>
              <? if($user->streetaddress != ''){ ?>
              <tr>
                <td>Address</td>
                <td><div><? echo $user->streetaddress; ?></div></td>
              </tr>
              <? } ?>
              <? if($user->city != ''){ ?>
              <tr>
                <td>City</td>
                <td><div><? echo $user->city; ?></div></td>
              </tr>
              <? } ?>
              <? if($user->state != ''){ ?>
              <tr>
                <td>State</td>
                <td><div><? echo $user->state; ?></div></td>
              </tr>
              <? } ?>
              <? if($user->contact_number != ''){ ?>
              <tr>
                <td>Contact Number</td>
                <td><div><? echo $user->contact_number; ?></div></td>
              </tr>
              <? } ?>
              <tr>
              	<td colspan="2" align="center">ACCOUNT INFORMATION</td>
              </tr>
              <? if($user->project_calendar != ''){ ?>
              <tr>
                <td>Google Calendar</td>
                <td><a href="<? echo $user->project_calendar; ?>"><img src="<? bloginfo( 'template_url' ); ?>/images/main/google-calendar-icon.png" width="25" height="25" /></a></td>
              </tr>
              <? } ?>
              <? if($user->google_drive != ''){ ?>
              <tr>
                <td>Google Drive</td>
                <td><div><a href="<? echo $user->google_drive; ?>"><img src="<? bloginfo( 'template_url' ); ?>/images/main/google-drive-icon.png" width="25" height="25" /></a></div></td>
              </tr>
              <? } ?>
              <? if($user->invoice_link != ''){ ?>
              <tr>
                <td>Invoice Link</td>
                <td><a href="<? echo $user->invoice_link; ?>"><? echo $user->invoice_link; ?></div></td>
              </tr>
              <? } ?>
              <? if($user->project_id1 != ''){ ?>
              <tr>
                <td>Project Link</td>
                <td><a href="<? echo get_permalink($user->project_id1); ?>" title="<? echo get_the_title($user->project_id1); ?>"><? echo get_the_title($user->project_id1); ?></a></td>
              </tr>
              <? } ?>
              <? if($user->registered_domain != ''){ ?>
              <tr>
                <td>Registered Domain</td>
                <td><div><? echo $user->registered_domain; ?></div></td>
              </tr>
              <? } ?>
              <? if($user->domain_registration != ''){ ?>
              <tr>
                <td>Domain Register Date</td>
                <td><div><? echo $user->domain_registration; ?></div></td>
              </tr>
              <? } ?>
              <? if($user->domain_expiration != ''){ ?>
              <tr>
                <td>Domain Expire Date</td>
                <td><div><? echo $user->domain_expiration; ?></div></td>
              </tr>
              <? } ?>
              <? if($user->hosting_registration != ''){ ?>
              <tr>
                <td>Hosting Register Date</td>
                <td><div><? echo $user->hosting_registration; ?></div></td>
              </tr>
              <? } ?>
              <? if($user->hosting_expiration != ''){ ?>
              <tr>
                <td>Hosting Expire Date</td>
                <td><div><? echo $user->hosting_expiration; ?></div></td>
              </tr>
              <? } ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
      <!-- END PANEL -->
    </div>
    
	<?
    // Display Project Questionnaire Results
    if(isset($quest_arrays) && $quest_arrays != NULL){
        ?>
    <div class="col-md-6"> 
    	<h3><i class="fa fa-columns"></i> Completed Questionnaires</h3>
			<?
            foreach($quest_arrays as $quests) { 
			echo '  <div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#project_quest_results" href="#'.$quests["questionnaire_slug"].'">
							'.$quests["form_title"].' Questionnaire <i class="fa fa-angle-down"></i></a>
							</h4>
						</div>
						<div id="'.$quests["questionnaire_slug"].'" class="panel-collapse collapse">
						<div class="panel-body">
						<table class="table table-bordered table-striped table-condensed">
						<thead>
							<tr>
								<th>#</th>
								<th>QUESTION</th>
								<th>ANSWER</th>
							</tr>
						</thead>
						<tbody>';
							$counter = 1;
						  foreach($quests as $key => $val) { 
								$key = str_replace('_',' ',$key); 
			echo '			<tr>
								<td>'. $counter . '. </td>
								<td><strong>' .  $key . '</strong></td>
								<td>'. $val . '</td>
							</tr>';
								$counter++;	
						  }
			echo '
						 </tbody>
						 </table>	';
			echo '		 </div>
						 </div>
					</div>';
			} 
			?>
    </div>
    <!-- /.col-md-6 -->
	<?	} ?>
    
    <div class="col-md-6"> 
    	<h3><i class="fa fa-tasks"></i> Assigned Tasks</h3>
    </div>
    <!-- /.col-md-6 -->
    
  </div>
  
</div>
<!-- END SINGLE USER PANE-<? echo $user->ID; ?> -->
<? } ?>
