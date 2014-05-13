<? $projID = $_GET['pid']; ?>
<div class="tabbable-custom">
    <div class="row">
    	<label class="col-md-3 control-label">Choose a project:</label>
        <div class="col-md-9">
        <select class="form-control nav-tabs" id="project-nav">
          <?
            $projLoopQuery1 = new WP_Query('post_type=client_projects&posts_per_page=100');
            while ( $projLoopQuery1->have_posts() ) : $projLoopQuery1->the_post(); 
			$clientID = get_post_meta(get_the_id(), 'client_ID', true);
			$fName = get_user_meta( $clientID, 'first_name', true );
			$lName = get_user_meta( $clientID, 'last_name', true );
			$displayName = get_user_meta( $clientID, 'display_name', true );
			$user_email = get_user_meta( $clientID, 'user_email', true );
			$fullName = $fName . ' ' . $lName;
			
          ?>
            <option value="/dashboard/projects/?pid=<? echo get_the_id(); ?>"<? if($projID == get_the_id()){ ?> selected<? } ?>> <? if($fullName != '') { echo $fullName; } else { echo $user_email; } ?> - [ <? echo get_the_title(); ?> ] </option>
          <? endwhile; ?>
          
        </select>
        </div>
    </div>
    <section class="tab-content">
        <?
            $projLoopQuery2 = new WP_Query('post_type=client_projects&posts_per_page=100');
            while ( $projLoopQuery2->have_posts() ) : $projLoopQuery2->the_post(); 
        ?>
        <!-- START PROJECT PANE-<? echo get_the_id(); ?> -->
        <div class="tab-pane single-project-pane" style="<? if($projID == get_the_id()) { ?> display: block;<? } else { ?>display: none;<? } ?>" id="single-project-<? echo get_the_id(); ?>">
          
          <div class="row">
              <div class="col-md-12">
              	<div class="portlet blue box">
              	
                    <div class="portlet-title">
                    	<div class="caption"><i class="fa fa-file-text"></i> <? echo get_the_title($projID); ?> - Detail Overview</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix margin-bottom-10">
                            <div class="pull-right"><a href="#project-delete-pane-<? echo $projID; ?>" data-toggle="modal" class="btn btn-sm red"><i class="fa fa-times"></i> Delete Project</a></div>
                            <div class="pull-right margin-left-10"><a href="#project-edit-pane-<? echo $projID; ?>" data-toggle="modal" class="btn btn-sm green"><i class="fa fa-pencil"></i> Edit Project</a></div>
                        </div>
                        <?php
						  $custom_fields = get_post_custom($projID);
						  if(isset($custom_fields) && $custom_fields != NULL){ 
						  ?>
                            <table class="table table-bordered table-striped table-condensed">
                                <tr>
                                    <th>META</th>
                                    <th>DETAILS</th>
                                </tr>
                              <?
                                  foreach ( $custom_fields as $key => $value ) {
                                      if($key != '_edit_last' && $key != '_edit_lock' && $key != 'pjsp_client_email' && $key != 'pjsp_email_subject' && $key != 'pjsp_default_url' && $key != 'pjsp_email_message' && $key != '_wp_old_slug' && $key != 'action' && $key != 'footer_text' && $key != 'thread_type'){
                                      $key = str_replace('_',' ',$key); 
                                      $key = str_replace('-',' ',$key); 
                                          echo "<tr>";
                                            echo "<td>" .$key . "</td>";
                                            if($key == 'brandmark design form' || $key == 'web development form' || $key == 'graphic design form'){
                                                echo '<td><a href="#quest-form-pane-'.get_the_id().'" data-toggle="modal"><i class="fa fa-file-text"></i> View Results</a></td>';
                                            }
                                            else {
                                                echo "<td>" .$value[0] . "</td>";
                                            }
                                          echo "</tr>";
                                      }
                                  }
                            ?>
                            </table>
                        <?  } else { ?>
                        	<h3>NO PROJECT DETAILS</h3>
                        <? } ?>
                    </div>
                    <!-- portlet-body -->
                </div>
                <!-- portlet -->
                
              </div>
          </div>
          <?php
		  	/* Project Questionnaire Modal View */
			$custom_fields = get_post_custom($projID);
			foreach ( $custom_fields as $key => $value ) {
				if($key != '_edit_last' && $key != '_edit_lock' && $key != 'pjsp_client_email' && $key != 'pjsp_email_subject' && $key != 'pjsp_default_url' && $key != 'pjsp_email_message' && $key != '_wp_old_slug' && $key != 'action' && $key != 'footer_text' && $key != 'thread_type'){
				$key = str_replace('_',' ',$key); 
				$key = str_replace('-',' ',$key); 
					if($key == 'brandmark design form' || $key == 'web development form' || $key == 'graphic design form'){
				?>
					<div id="quest-form-pane-<? echo get_the_id(); ?>" class="modal fade in" tabindex="-1" data-replace="true">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title"><? echo $key; ?></h4>
						</div>
						<div class="modal-body">
							<? 
							foreach ( $value as $key => $val ) { 
							 $key = str_replace('_',' ',$key); 
                          	 $key = str_replace('-',' ',$key); 
							 
								echo $val; 
							?>
								
                                
							<? } ?>
						</div>
						
					  </div>  
					<? 	} 
				  }
			} 	
		  ?>
          
          <?php
		  	/* Project Delete Modal */ ?>
          	<div id="project-delete-pane-<? echo $projID; ?>" class="modal fade in" tabindex="-1" data-replace="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Delete Project</h4>
            </div>
            <div class="modal-body">
                <form action="<? bloginfo( 'siteurl' ); ?>/wp-projects-post.php" method="post" class="project-delete-form">
                    <h6>Are you sure you want to delete this project?</h6>
                    <input type="hidden" name="project_ID" value="<? echo $projID; ?>">
                    <input type="hidden" name="action" value="delete_project">
                    <button type="submit" class="btn btn-sm red">Delete</button> 
                    <button type="button" data-dismiss="modal" class="btn btn-sm default">Cancel</button>
                </form>
                
            </div>
          </div>
          
          <?php
		  	/* Project Delete Modal */ ?>
         	<div id="project-edit-pane-<? echo $projID; ?>" class="modal fade in" tabindex="-1" data-replace="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit Project</h4>
            </div>
            <div class="modal-body">
                <? amn_edit_project_form($projID); ?>
                
            </div>
            
          </div>
          
             
				 
          
        </div>
        <!-- END PROJECT PANE-<? echo get_the_id(); ?> -->
        <? endwhile ?>
    </section>
</div>