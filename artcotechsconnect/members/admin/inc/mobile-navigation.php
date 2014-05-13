
<div id="mobile-bottom-nav">
	<ul>
        <li<? if($currPostName == 'dashboard'){ ?> class="active"<? } ?>>
            <a href="/dashboard/" class="">
                <i class="fa fa-dashboard"></i>
                <div>
                    Dashboard
                </div>
            </a>
        </li>
        <li<? if($currPostName == 'users'){ ?> class="active"<? } ?>>
            <a href="/dashboard/users/" class="">
                <i class="fa fa-group"></i>
                <div>
                    Users
                </div>
            </a>
        </li>
        <li<? if($currPostName == 'projects'){ ?> class="active"<? } ?>>
            <a href="/dashboard/projects/" class="">
                <i class="fa fa-folder-open"></i>
                <div>
                    Projects
                </div>
            </a>
        </li>
        <li>
            <a href="#all-messages" data-toggle="tab" class="">
                <i class="fa fa-comments"></i>
                <div>
                    Messages
                </div>
            </a>
        </li>
        <li>
            <a href="#more-tabs-modal" data-toggle="modal" class="">
                <i class="fa fa-ellipsis-horizontal"></i>
                <div>
                    More
                </div>
            </a>
        </li>
    </ul>
</div>
<!-- MOBILE NAV EXTRA MENU MODAL -->
<div id="more-tabs-modal" class="modal fade in" tabindex="-1" data-replace="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">More Options</h4>
    </div>
    <div class="modal-body">
    	<ul class="list-group">
            <li class="list-group-item">
               <a href="#all-invoices" data-dismiss="modal" data-toggle="tab" class="block" title="All Invoices"><i class="fa fa-money"></i> All Invoices</a>
            </li>
            <li class="list-group-item">
               <a href="#support-tickets" data-dismiss="modal" data-toggle="tab" href="" class="block" title="Support Tickets"><i class="fa fa-info-circle"></i> Support Tickets</a>
            </li>
            <li class="list-group-item">
               <a href="#infinitewp-manager" data-dismiss="modal" data-toggle="tab" class="block" title="InfiniteWP Manager"><i class="fa fa-cogs"></i> InfiniteWP Manager</a>
            </li>
            <li class="list-group-item">
               <a href="#hosting-manager" data-dismiss="modal" data-toggle="tab" class="block" title="Hosting Management"><i class="fa fa-cloud"></i> Hosting Manager`</a>
            </li>
            <li class="list-group-item">
               <a href="#hosting-connection" data-dismiss="modal" data-toggle="tab" class="block" title="Hosting Management"><i class="fa fa-cloud-upload"></i> Hosting Connection</a>
            </li>
            <li class="list-group-item">
               <a href="#domain-manager" data-dismiss="modal" data-toggle="tab" class="block" title="Domain Management"><i class="fa fa-cloud-download"></i> Domain Management</a>
            </li>
            <li class="list-group-item">
               <a href="#myerp-manager" data-dismiss="modal" data-toggle="tab" class="block" title="Financial Accounting"><i class="fa fa-credit-card"></i> myERP</a>
            </li>
        </ul>
    </div>
</div>
<!-- MOBILE NAV EXTRA MENU MODAL -->



<div id="tasks-connect-panel">
	<div class="tasks-form-panel"></div>
	<div class="options">
        <ul>
            <li id="tasks-toggler"><a href="#tasks-compose-modal" data-toggle="modal" class="btn dark"><img src="<? echo get_template_directory_uri() . '/images/main/amn-manhead-icon.png'; ?>" height="20" width="20" alt=""></a></li>
        </ul>
    </div>
	
</div>



		<!--=============================================================================
        	TASKS COMPOSE MODAL
        ===============================================================================--> 
		<form id="tasks-compose-modal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="form" action="<? bloginfo( 'siteurl' ); ?>/wp-tasks-post.php" method="post">
		  <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          </div>
          <div class="modal-body">
              <div class="panel panel-primary">
              <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> New Task</h3> </div>
              <div class="panel-body">
                <div class="form-body">
                  <div class="form-group">
                    <input type="text" name="task_name" class="form-control" placeholder="Task Name / Subject">
                  </div>
                  <div class="form-group">
                    <input type="text" name="task_due_date" class="form-control" placeholder="Due Date [ MM-DD-YYYY ]" />
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="task_priority">
                    	<option value="">Task Priority Level...</option>
                    	<option value="I">I</option>
                    	<option value="II">II</option>
                    	<option value="III">III</option>
                    	<option value="IV">IV</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="task_status">
                    	<option value="">Task Status...</option>
                    	<option value="Not Started">Not Started</option>
                    	<option value="In Progress">In Progress</option>
                    	<option value="Progress Stopped">Progress Stopped</option>
                    	<option value="Awaiting Approval">Awaiting Approval</option>
                    	<option value="Completed">Completed</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="task_visibility">
                    	<option value="">Task Visibility...</option>
                    	<option value="Public">Public</option>
                    	<option value="Private">Private</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="project_assigned_to">
                    	<option value="">Attach to a project...</option>
					<? 
       				 	$projects_Query = new WP_Query('post_type=client_projects&posts_per_page=100');
						while ( $projects_Query->have_posts() ) : $projects_Query->the_post(); ?>
                        <option value="<? the_ID(); ?>"><? the_title(); ?></option>
                    <? endwhile ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="task_project_phase">
                    	<option value="">Task Phase...</option>
                    	<option value="Decipherment">Decipherment</option>
                    	<option value="Design">Design</option>
                    	<option value="Development">Development</option>
                    	<option value="Delivery">Delivery</option>
                    	<option value="Deployment">Deployment</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-label">Assign task to members:</label>	
					<? $all_users = get_users();
						foreach($all_users as $theUser) { ?>
                        	<div class="clearfix"><input value="<? echo $theUser->ID; ?>" type="checkbox" name="users_assigned_to[]" class="form-control" /> <? echo $theUser->display_name; ?></div>
                    	<? } ?>
                  </div>
                  <div class="form-group">
                    <label class="form-label">Send notifications to members?</label>
                    <div class="clearfix"><input type="radio" class="form-control"  name="send_notifications" value="Yes" /> Yes</div>
                    <div class="clearfix"><input type="radio" class="form-control"  name="send_notifications" value="No" /> No</div>
                  </div>
                  <div class="form-group">
                  	<label class="form-label">Attach an image.</label>
                    <input name="task_image" class="form-control blue" type="file" />
                  </div>
                  <div class="form-group">
                    <textarea name="task_description" class="form-control" rows="3" placeholder="Task Description"></textarea>
                  </div>
                  <div class="form-group">
                    <h3 class="form-label">Add a comment:</h3>
                    <textarea name="comment" class="form-control" rows="3" placeholder="Enter a comment to start a message thread for your task"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.modal-body -->

          <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
			  <button type="submit" class="btn btn-sm green"><i class="fa fa-pencil"></i> Create Task</button>
              <input type="hidden" name="action_type" value="new_task" />
          </div>
	  </form>
      <!-- /#tasks-compose-modal -->
      
      
		<!--=============================================================================
        	TASK CREATED SUCCESSFULLY RESPONSE MODAL
        ===============================================================================--> 
      <div class="modal fade in" id="task-created-modal" tabindex="-1" role="basic" aria-hidden="false">
		  <div class="modal-header">
			  <h4 class="modal-title"><i class="fa fa-tasks"></i> Task Created</h4>
		  </div>
		  <div class="modal-body modal-body-picture" id="modal-body-picture">
			  <div class="comment-image-wrapper">
				  <div class="row">
						<h5 class="text-info pull-center" style="text-align:center">Your Task Has Been Created!</h5>
				  </div>
			  </div>	
			  <!-- #comment-image-wrapper -->	
		  </div>  
		  <!-- /.modal-body --> 
		  
		  <div class="modal-footer">
			  <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Ok</button>
		  </div>	
      </div>
      <a href="#task-created-modal" data-toggle="modal"></a>
      
      
		<!--=============================================================================
        	MESSAGE SENT SUCCESSFULLY RESPONSE MODAL
        ===============================================================================--> 
      <div class="modal fade in" id="message-sent" tabindex="-1" role="basic" aria-hidden="false">
		  <div class="modal-header">
			  <h4 class="modal-title"><i class="fa fa-check"></i> Message Sent Successfully</h4>
		  </div>
		  <div class="modal-body modal-body-picture" id="modal-body-picture">
			  <div class="comment-image-wrapper">
				  <div class="row">
						<h5 class="text-info pull-center" style="text-align:center">Your Project Message Has Been Sent!</h5>
				  </div>
			  </div>	
			  <!-- #comment-image-wrapper -->	
		  </div>  
		  <!-- /.modal-body --> 
		  
		  <div class="modal-footer">
			  <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Ok</button>
		  </div>	
      </div>
      <a href="#message-sent" data-toggle="modal"></a>