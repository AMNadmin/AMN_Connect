
<section> 
  <!-- START ALL PROJECTS PORTLET -->
  
  <div class="portlet box amn-portlet-tab">
    <div class="portlet-title">
      <div class="caption"> <i class="fa fa-folder-open"></i> All Projects </div>
      <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="javascript:;" class="reload"></a> </div>
    </div>
    <div class="portlet-body table-responsive amn-data-table flip-scroll" id="all-projects-portlet-body">
      <table class="table table-striped table-bordered table-hover flip-content" id="sample_2">
        <thead class="flip-content">
            <tr role="row">
            	<th></th>
            	<th>ID</th>
                <th>Project <br>Name</th>
                <th>Project <br>Image</th>
                <th>Client <br>Name</th>
                <th>Project <br>Start</th>
                <th>Project <br>End</th>
                <th align="center">Project<br>Phase</th>
                <th>Project <br>Completion</th>
                <th align="center">Status</th>
                <th>Project <br>Manager</th>
                <th>Assigned To</th>
                <th>Current <br>Holds</th>
            </tr>
        </thead>
        <tbody aria-live="polite" aria-relevant="all">
        <?php
        $projects_Query = new WP_Query('post_type=client_projects&posts_per_page=100');
        while ( $projects_Query->have_posts() ) : $projects_Query->the_post(); 
			$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
            $client_ID = get_post_meta($post->ID, 'client_ID', true);
            $client_name = get_post_meta($post->ID, 'client_name', true);
            $project_start = get_post_meta($post->ID, 'project_start', true);
            $project_end = get_post_meta($post->ID, 'project_end', true);
            $project_phase = get_post_meta($post->ID, 'project_phase', true);
            $progress = get_post_meta($post->ID, 'progress', true);
            $current_holds = get_post_meta($post->ID, 'current_holds', true);
            $current_tasks = get_post_meta($post->ID, 'current_tasks', true);
            $assignee_ID = get_post_meta($post->ID, 'assignee_ID', true);
            $assignee_name = get_post_meta($post->ID, 'assignee_name', true);
            $pm1_name = get_post_meta($post->ID, 'pm1_name', true);
            $pm1_ID = get_post_meta($post->ID, 'pm1_ID', true);
            $open_close = get_post_meta($post->ID, 'open_close', true);
			$brandmark_design_form = get_post_meta($post->ID, 'brandmark-design-form', true); 
			$web_development_form = get_post_meta($post->ID, 'web-development-form', true); 
			$graphic_design_form = get_post_meta($post->ID, 'graphic-design-form', true); 
			$event_brand_form = get_post_meta($post->ID, 'event-brand-form', true); 
			$social_media_form = get_post_meta($post->ID, 'social-media-form', true); 
            $label_type = '';
            $open_close_status = '';
            
            if( $client_name == '' ) { $client_name = 'N/A'; }
            if( $project_start == '' ) { $project_start = 'N/A'; }
            if( $project_end == '' ) { $project_end = 'N/A'; }
            if( $project_phase == '' ) { $project_phase = 'N/A'; }
            if( $progress == 0 || $progress == '' ) { $progress = 0; }
            if( $current_holds == '' ) { $current_holds = 'N/A'; }
            if( $current_tasks == '' ) { $current_tasks = 'N/A'; }
            if( $pm1_name == '' ) { $pm1_name = 'N/A'; }
            if( $assignee == '' ) { $assignee = 'N/A'; }
            
            switch($open_close)
            {
            case '':
              $label_type = 'label-warning';
              $open_close_status = 'Not Started';
              break;
            case 'Not Started':
              $label_type = 'label-warning';
              $open_close_status = 'Not Started';
              break;
            case 'In Progress':
              $label_type = 'label-success';
              $open_close_status = 'In Progress';
              break;
            case 'Awaiting Approval':
              $label_type = 'label-info';
              $open_close_status = 'Awaiting Approval';
              break;
            case 'Closed':
              $label_type = 'label-danger';
              $open_close_status = 'CLOSED';
              break;
            }
            
            switch($progress)
            {
            case '':
              $label_type = 'label-warning';
              $open_close_status = 'Not Started';
              break;
            case 0:
              $label_type = 'label-warning';
              $open_close_status = 'Not Started';
              break;
            case $progress > 0:
                if($open_close == 'Awaiting Approval'){
                  $label_type = 'label-info';
                  $open_close_status = 'Awaiting Approval';
                }
                else if($open_close == 'CLOSED'){
                  $label_type = 'label-danger';
                  $open_close_status = 'CLOSED';
                    
                }else {
                  $label_type = 'label-success';
                  $open_close_status = 'In Progress';
                }
              break;
            default:
            }
            
            
            
            echo '<tr>';
            echo 	'<td>
						<a href="#project-view-pane-'.get_the_ID().'" data-toggle="modal" class="btn btn-sm dark"><i class="fa fa-file-text"></i></a>
						<a href="#project-edit-pane-'.get_the_ID().'" data-toggle="modal" class="btn btn-sm green"><i class="fa fa-pencil"></i></a><br><br>
						<a href="#project-messaging-pane-'.get_the_ID().'" data-toggle="modal" class="btn btn-sm blue"><i class="fa fa-inbox"></i></a>
						<a href="#project-delete-pane-'.get_the_ID().'" data-toggle="modal" class="btn btn-sm red"><i class="fa fa-minus-circle"></i></a>';
						if($client_ID != '' && $client_ID != null){
			echo '
						<a href="#email-user-pane-'.$client_ID.'"data-toggle="modal" class="btn btn-sm green" title="Email User"><i class="fa fa-mail-forward"></i></a>';
						}
			echo '	</td>
					<td>'.get_the_ID().'</td>';
            echo 	'<td><a href="/dashboard/projects/?pid='.get_the_ID().'" title="Edit '.get_the_title().'">' . get_the_title() . '</a></td>';
			if(isset($featured_image) && $featured_image != '') {
				echo 	'<td align="center"><img src="'. $featured_image[0] .'" width="50" height="50" alt="" ></td>';
			} else {
				echo 	'<td align="center"><img src="'.get_bloginfo('template_url').'/images/main/amn-manhead-icon.png" alt="User Avatar" width="50" height="50"></td>';
			}
            echo '	<td>';
			if($client_ID != '' && $client_ID != null){ echo 	get_user_meta($client_ID, 'first_name', true) . ' ' .get_user_meta($client_ID, 'last_name', true); }
			else {
				if($client_name != ''){ echo $client_name; }
				else { echo 'N/A'; }
			}
            echo '	</td>';
                
            echo 	'<td>' . $project_start . '</td>';
            echo 	'<td>' . $project_end . '</td>';
            echo 	'<td align="center">' . $project_phase . '</td>';
            echo 	'<td> 
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'.$progress.'" aria-valuemin="0" aria-valuemax="100" style="width: '. $progress .'%">
                                <span class="sr-only">
                                    '.$progress.'% Complete
                                </span>
                            </div>
                        </div>';
            if( $progress == 0 || $progress == '' ){ echo '<span class="badge badge-danger">0%</span>';	}
            else { echo '<span class="badge badge-success">'.$progress.'%</span>';	}
            echo 	'</td>
                    <td align="center" valign="middle"><span class="label '.$label_type.'">' . $open_close_status . '</span></td>
                    <td>';
			if($pm1_ID != ''){
				echo 		get_user_meta($pm1_ID, 'first_name', true) . ' ' .get_user_meta($pm1_ID, 'last_name', true);
			}else {
				echo 'N/A';
			}
			echo 	'</td>';
            echo 	'<td>';
			if($assignee_ID != ''){
				echo 		get_user_meta($assignee_ID, 'first_name', true) . ' ' .get_user_meta($assignee_ID, 'last_name', true);
			}else {
				echo 'N/A';
			}
			echo 	'</td>';
            echo 	'<td>' . $current_holds . '</td>';
            echo '</tr>';
            
        endwhile; 
        ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- END ALL PROJECTS PORTLET --> 
</section>

