<?

/* //////////////////////////////////////////////////////////////////////////
**		Get the Artcotechs messaging form based on the post_id
**		Return HTML with post specific form
** /////////////////////////////////////////////////////////////////////////*/
function admin_messaging_form($the_id, $redirect_url, $comment_parent) {
	
	if(!isset($comment_parent) || $comment_parent == ''){ $comment_parent = '0'; }
	
	// If the user is logged in
	$user = wp_get_current_user();
	if ( $user->exists() ) {
		if ( empty( $user->display_name ) )
			$user->display_name=$user->user_login;
		$comment_author       = wp_slash( $user->display_name );
		$comment_author_email = wp_slash( $user->user_email );
		$comment_author_url   = wp_slash( $user->user_url );
		
	}
	echo '
		<section id="discussion-form-wrapper" class="admin-thread">
		<form action="'.get_site_url().'/wp-comments-post.php" method="post" id="client-discussion-form" class="comment-form" enctype="multipart/form-data">  
      <div class="chat-form amn-chat-form">
          <div class="clearfix input-cont input-icon right"><i class="fa fa-pencil"></i><input type="text" name="comment_subject" class="form-control comment_subject" placeholder="Subject:"></div>
          <div class="clearfix input-cont input-icon right">   
              <i class="fa fa-edit" id="picture-upload-icon" title="Upload an image with your message."></i>
			  <textarea class="form-control comment_content" cols="8" id="comment_content" name="comment" placeholder="Type a message here..."></textarea>
          </div>
      </div>
      <div class="form-submit" id="comment_image_form_submit">
          <div class="row">
              <div class="col-md-12">
                  <div class="row block form-action-btns">
                      <input type="hidden" name="action" value="new-comment">
                      <input type="hidden" name="author" value="'.$comment_author.'">
                      <input type="hidden" name="email" value="'.$comment_author_email.'">
                      <input type="hidden" name="url" value="'.$comment_author_url.'">
                      <input type="hidden" name="comment_post_ID" value="'.$the_id.'" class="comment_post_ID" id="comment_post_ID">
                      <input type="hidden" name="comment_parent" class="comment_parent" id="comment_parent" value="'.$comment_parent.'">';
	if(isset($redirect_url) && $redirect_url != '') { 
		echo '		  <input type="hidden" name="redirecturl" class="redirecturl" id="redirecturl" value="'.$redirect_url.'">';
	}
	else {
		echo '		  <input type="hidden" name="redirecturl" class="redirecturl" id="redirecturl" value="'.get_site_url().'/hub-page/">';
	}
	echo '			  <div class="col-md-6 left-form-btns pull-left">';
    echo '	           	<a href="#picture-upload" data-toggle="modal" title="Upload an image with your message." class="btn btn-sm btn-primary" id="comment_image_attach_btn"><i class="fa fa-upload"></i></a> 
						
				
					  </div>
					  <div class="col-md-6 right-form-btns">
                      	<span class="pull-right inner"><button name="submit" class="btn btn-sm green amn-submit-button" type="submit" id="submit" value="Send Message" title="Send message"><i class="fa fa-share"></i> Send</button></span>
					  </div>
                  </div>
				  <div class="current_selected_image" id="comment_image_name">
					  <img src="'.get_template_directory_uri().'/images/main/ajax-loading.gif" style="display: none;" width="20" height="20" alt="">
					  <span class="alert alert-success" style="display: none;"></span>
				  </div>
              </div>
          </div>
          <!-- /.row -->
      </div>
      <!-- /.form-submit -->
      
      <!-- START COMMENT IMAGE MODAL -->
      <div class="modal fade in new-comment-image-modal" id="picture-upload" tabindex="-1" role="basic" aria-hidden="false" style="">
		  <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			  <h4 class="modal-title">Upload Picture</h4>
		  </div>
		  <div class="modal-body modal-body-picture" id="modal-body-picture">
			  <div class="comment-image-wrapper">
				  <div class="row">
						<div class="col-md-12">
						  <label for="comment_image">Select an image for your message (GIF, PNG, JPG, JPEG):</label>
						</div>
						<div class="col-md-12">
							<div class="clearfix"><p><input type="file" id="comment_image" class="btn btn-primary comment_image" name="comment_image"></p></div>
						</div>
						<div class="col-md-12">
							<div class="clearfix current_selected_image" id="client_selected_image">
								<div class="label label-warning" id="current_comment_image" style="display:none;"></div>
							</div>
						</div>
				  </div>
			  </div>	
			  <!-- #comment-image-wrapper -->	
		  </div>  
		  <!-- /.modal-body --> 
		  
		  <div class="modal-footer">
			  <button type="button" class="btn blue picture-save-btn" data-dismiss="modal" id="picture-save-btn">Save</button>
			  <button type="button" class="btn red picture-delete-btn" id="picture-delete-btn">Delete</button>
			  <button type="button" class="btn default picture-cancel-btn" data-dismiss="modal" id="picture-cancel-btn">Cancel</button>
		  </div>	
      </div>
      <!-- END COMMENT IMAGE MODAL -->
    </form>
	</section>';
	//amn_show_images_modal($the_id);
} 

/* //////////////////////////////////////////////////////////////////////////
**		Get the Modals for Recent Activity Thread
**		Return HTML with recent activity modals
** /////////////////////////////////////////////////////////////////////////*/
function admin_recent_activity_thread( $total_items = 20 ){
	global $wpdb;

	// Select all comment types and filter out spam later for better query performance.
	$comments = array();
	$start = 0;

	$comments_query = array(
		'number' => $total_items * 5,
		'offset' => 0
	);
	if ( ! current_user_can( 'edit_posts' ) )
		$comments_query['status'] = 'approve';

	while ( count( $comments ) < $total_items && $possible = get_comments( $comments_query ) ) {
		foreach ( $possible as $comment ) {
			if ( ! current_user_can( 'read_post', $comment->comment_post_ID ) )
				continue;
			$comments[] = $comment;
			if ( count( $comments ) == $total_items )
				break 2;
		}
		$comments_query['offset'] += $comments_query['number'];
		$comments_query['number'] = $total_items * 10;
	}
	
	// If the user is logged in
	$user = wp_get_current_user();
	if ( $user->exists() ) {
		$current_user_ID = $user->ID;
	}
	
	if ( $comments ) {
		
	echo '
			<!-- BEGIN PORTLET -->
			<div id="portlet-wrapper" class="portlet">
              	<div class="portlet-title line">
					<div class="caption">
						<i class="fa fa-comments"></i>Network Chats
					</div>
					<div class="tools">
						<a href="" class="collapse"></a>
						<a href="" class="reload"></a>
					</div>
              	</div>
				<!-- BEGIN WRAPPER -->
              	<div class="portlet-body scroller-portlet-body">';
		echo '<div class="wrapper" id="recentActivityWrapper">
            	<div class="scroller">
					<ul class="chats" id="chats-thread">';
						foreach ( $comments as $comment ) {
	
							// ...get the comment image meta
							$comment_image = get_comment_meta( $comment->comment_ID, 'comment_image', true );
							$comment_subject = get_comment_meta( $comment->comment_ID, 'comment_subject', true );
							$d = "l, F jS, Y";
							$comment_date = get_comment_date( $d, $comment->comment_ID );
							$the_title = get_the_title($comment->comment_post_ID);
							
							if($current_user_ID == $comment->user_id) {
							echo '<li class="out">';
							}
							else {
							echo '<li class="in">';
							}
								
							echo  	get_avatar( $comment, $args['avatar_size'] );
							echo '	<div class="message">
										<span class="arrow"></span>';
										
							echo '		<div class="clearfix">
											<div class="datetime">On <strong>'.$comment_date.'</strong></div>
											
											<span class="says"> Message from <a href="'.$comment->comment_author_url.'" rel="external nofollow" class="url"> '.$comment->comment_author.'</a>:</span>
										</div>';
							echo '		<div class="body">';
											if($the_title != '') { echo '<div class="project_name text-primary"><strong>Project:</strong> '. $the_title .'</div>'; }
											if($comment_subject != '' && $comment_subject != null) { echo '<div class="subject text-info"><strong>Subject:</strong> '.$comment_subject .'</div>'; }
							echo '			<p class="clearfix comment_content">'.$comment->comment_content.'</p>';
							echo '			<p class="clearfix"><img src="'.$comment_image['url'].'" class="comment_image" alt=""></p>';
							echo '			<div class="reply">
												<a href="#reply-modal-pane-'.$comment->comment_ID.'" data-toggle="modal" id="reply-modal-btn-'.$comment->comment_ID.'" class="btn btn btn-sm blue reply-modal-btn" title="Reply to '.$comment->comment_author.'\'s comment"><i class="fa fa-reply"></i></a>';
											if( 0 != get_comment_meta( $comment->comment_ID, 'comment_image', true )) {
												echo '
												<a  href="#delete-image-modal-pane-'.$comment->comment_ID.'" data-toggle="modal" id="delete-image-btn-'.$comment->comment_ID.'" class="btn btn-sm red delete-modal-btn" title="Delete this image"><i class="fa fa-picture-o"></i></a>';
											}
							echo '				<a  href="#delete-message-modal-pane-'.$comment->comment_ID.'" data-toggle="modal" id="delete-modal-btn-'.$comment->comment_ID.'" class="btn btn-sm red delete-modal-btn" title="Delete this comment"><i class="fa fa-minus-circle"></i></a>
											</div>
										</div>';
	
							echo '	</div>';
							echo '</li>';
	
	
						} // end foreach
				
		echo '		</ul>
				</div>
			  </div>
			  <!-- #recentActivityWrapper -->';
			  
			  
	   echo '<ul class="chats" id="mobile-chats-thread">';
						foreach ( $comments as $comment ) {
	
							// ...get the comment image meta
							$comment_image = get_comment_meta( $comment->comment_ID, 'comment_image', true );
							$comment_subject = get_comment_meta( $comment->comment_ID, 'comment_subject', true );
							$d = "l, F jS, Y";
							$comment_date = get_comment_date( $d, $comment->comment_ID );
							$the_title = get_the_title($comment->comment_post_ID);
							
							if($current_user_ID == $comment->user_id) {
							echo '<li class="out">';
							}
							else {
							echo '<li class="in">';
							}
								
							echo  	get_avatar( $comment, $args['avatar_size'] );
							echo '	<div class="message">
										<span class="arrow"></span>';
										
							echo '		<div class="clearfix">
											<div class="datetime">On <strong>'.$comment_date.'</strong></div>
											
											<span class="says"> Message from <a href="'.$comment->comment_author_url.'" rel="external nofollow" class="url"> '.$comment->comment_author.'</a>:</span>
										</div>';
							echo '		<div class="body">';
											if($the_title != '') { echo '<div class="project_name text-primary"><strong>Project:</strong> '. $the_title .'</div>'; }
											if($comment_subject != '' && $comment_subject != null) { echo '<div class="subject text-info"><strong>Subject:</strong> '.$comment_subject .'</div>'; }
							echo '			<p class="clearfix comment_content">'.$comment->comment_content.'</p>';
							echo '			<p class="clearfix"><img src="'.$comment_image['url'].'" class="comment_image" alt=""></p>';
							echo '			<div class="reply">
												<a href="#reply-modal-pane-'.$comment->comment_ID.'" data-toggle="modal" id="reply-modal-btn-'.$comment->comment_ID.'" class="btn btn btn-sm blue reply-modal-btn" title="Reply to '.$comment->comment_author.'\'s comment"><i class="fa fa-reply"></i></a>';
											if( 0 != get_comment_meta( $comment->comment_ID, 'comment_image', true )) {
												echo '
												<a  href="#delete-image-modal-pane-'.$comment->comment_ID.'" data-toggle="modal" id="delete-image-btn-'.$comment->comment_ID.'" class="btn btn-sm red delete-modal-btn" title="Delete this image"><i class="fa fa-picture-o"></i></a>';
											}
							echo '				<a  href="#delete-message-modal-pane-'.$comment->comment_ID.'" data-toggle="modal" id="delete-modal-btn-'.$comment->comment_ID.'" class="btn btn-sm red delete-modal-btn" title="Delete this comment"><i class="fa fa-minus-circle"></i></a>
											</div>
										</div>';
	
							echo '	</div>';
							echo '</li>';
	
	
						} // end foreach
				
		echo '		</ul>	';
		echo '	</div>
			  </div>';
		echo '
			  <script>
				var recentActivityWrapper_scroll;
				function recentActivityWrapper_loaded() {
					recentActivityWrapper_scroll = new iScroll(\'recentActivityWrapper\', { hScrollbar: false, vScrollbar: true });
					
					$("#all-activities-tab").click(function(){
						setTimeout(function () {
							recentActivityWrapper_scroll.refresh();
						}, 0);	
					});
				}
				document.addEventListener(\'DOMContentLoaded\', recentActivityWrapper_loaded, true);
			  </script>';
	} else {
		return false;
	}
	return true;
}
// END admin_recent_activity_thread()



/* //////////////////////////////////////////////////////////////////////////
**		Get the Modals for Recent Activity Thread
**		Return HTML with recent activity modals
** /////////////////////////////////////////////////////////////////////////*/
function admin_recent_activity_modals( $total_items = 20 ) {
	global $wpdb;

	// Select all comment types and filter out spam later for better query performance.
	$comments = array();
	$start = 0;

	$comments_query = array(
		'number' => $total_items * 5,
		'offset' => 0
	);
	if ( ! current_user_can( 'edit_posts' ) )
		$comments_query['status'] = 'approve';

	while ( count( $comments ) < $total_items && $possible = get_comments( $comments_query ) ) {
		foreach ( $possible as $comment ) {
			if ( ! current_user_can( 'read_post', $comment->comment_post_ID ) )
				continue;
			$comments[] = $comment;
			if ( count( $comments ) == $total_items )
				break 2;
		}
		$comments_query['offset'] += $comments_query['number'];
		$comments_query['number'] = $total_items * 10;
	}
	
	// If the user is logged in
	$user = wp_get_current_user();
	if ( $user->exists() ) {
		$current_user_ID = $user->ID;
	}
	if(isset($comments)) {	
		foreach($comments as $comment){
			$comment_image = get_comment_meta( $comment->comment_ID, 'comment_image', true );
			echo '<!-- START MESSAGE REPLY MODAL -->
				<div class="modal fade modal-scroll" id="reply-modal-pane-'.$comment->comment_ID.'" tabindex="-1" data-replace="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Reply to Message</h4>
					</div>
					<div class="modal-body" id="reply-modal-body-'.$comment->comment_ID.'">';
						amn_reply_forms( $comment->comment_ID );
			echo '	</div>
				</div>
				<!-- END MESSAGE REPLY MODAL -->';
				
			echo '<!-- START MESSAGE DELETE MODAL -->
				<div class="modal fade in" id="delete-message-modal-pane-'.$comment->comment_ID.'" tabindex="-1" data-replace="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Delete Message</h4>
					</div>
					<div class="modal-body" id="delete-modal-body-'.$comment->comment_ID.'">';
						
			echo '		<form action="'.get_site_url().'/wp-comments-delete.php" method="post" class="delete-comment-form">
							<h6>Are you sure you want to delete this message?</h6>
							<input type="hidden" name="comment_post_ID" value="'.$comment->comment_post_ID.'">
							<input type="hidden" name="deletecomID" value="'.$comment->comment_ID.'">
							<input type="hidden" name="action" value="delete_message">
							<button type="submit" class="btn btn-sm red">Delete</button>
							<button type="button" data-dismiss="modal" class="btn btn-sm default">Cancel</div>
						</form>
					</div>
				</div>
				<!-- END MESSAGE DELETE MODAL -->';
			if(isset($comment_image) && $comment_image['url'] != ''){	
				echo '<!-- START IMAGE DELETE MODAL -->
					<div class="modal fade in" id="delete-image-modal-pane-'.$comment->comment_ID.'" tabindex="-1" data-replace="true">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Delete Image</h4>
						</div>
						<div class="modal-body" id="delete-modal-body-'.$comment->comment_ID.'">';
				
				echo '		<div class="clearfix comment-image">';
				echo '			<img src="' . $comment_image['url'] . '" alt="" /><br />';
				echo '		</div><!-- /.comment-image -->';		
				echo '		<form action="'.get_site_url().'/wp-comments-delete.php" method="post" class="delete-comment-form">
								<h6>Are you sure you want to delete this image?</h6>
								<input type="hidden" name="comment_post_ID" value="'.$comment->comment_post_ID.'">
								<input type="hidden" name="deletecomID" value="'.$comment->comment_ID.'">
								<input type="hidden" name="action" value="delete_image">
								<button type="submit" class="btn btn-sm red">Delete</button>
								<button type="button" data-dismiss="modal" class="btn btn-sm default">Cancel</div>
							</form>
						</div>
					</div>
					<!-- END IMAGE DELETE MODAL -->';
			}
		}
		echo '<!-- START MESSAGE DELETED RESPONSE MODAL -->
			<div class="modal fade in" id="message-deleted-modal" tabindex="-1" data-replace="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Message Deleted</h4>
				</div>
				<div class="modal-body" id="msg-deleted-modal-body-'.$comment->comment_ID.'">';
					if($_GET["resp"] == 'msg-delete'){
		echo '		<div class="alert alert-success pull-center">Your Message Has Been Deleted!</div>';	
					}
					else if($_GET["resp"] == 'img-delete'){
		echo '		<div class="alert alert-success pull-center">Your Image Has Been Deleted!</div>';	
					}
		echo '	</div>
				<div class="modal-footer">
					<button type="button" class="btn default" data-dismiss="modal">Close</button>
				</div>
			</div>
			<a href="#message-deleted-modal" data-toggle="modal"></a>
			<!-- END MESSAGE DELETED RESPONSE MODAL -->';
	}
	
}
// admin_recent_activity_modals()


/* //////////////////////////////////////////////////////////////////////////
**		Get all user action modals for admin
**		Return Modals With Admin Actions - 	[ Create | Delete | Update ]
** /////////////////////////////////////////////////////////////////////////*/
function admin_user_manage_modals($all_users) {
	
		
	/*	Filter through all users and display modals
	*=========================================================*/
	foreach ($all_users as $curr_user) {
			$currUserProperty = new WP_User( $curr_user->ID ); 
			$userRole = '';
			if ( !empty( $currUserProperty->roles ) && is_array( $currUserProperty->roles ) ) { 
			  foreach ( $currUserProperty->roles as $role )
				  $userRole = $role; 
			} 
		echo '	<!-- START EDIT USER MODAL -->
				<div class="modal fade in" id="edit-user-pane-'.$curr_user->ID.'" tabindex="-1" data-replace="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Update Member Profile</h4>
					</div>
					<div class="modal-body" id="edit-user-modal-body-'.$curr_user->ID.'">';
					
		echo '			<form action="'.get_site_url().'/wp-users-post.php" method="post" class="edit-user-form" role="form">
							<h5><strong>'.$curr_user->display_name.'</strong>\'s Profile Details</h5>
							<div class="form-body">
								<div class="form-group">
									<label>User Email</label>
									<input type="text" class="form-control" name="user_email" placeholder="User email" value="'.$curr_user->user_email.'">
								</div>
								<div class="form-group">
									<label>Project ID</label>
									<input type="text" class="form-control" name="project_id1" placeholder="Project ID" value="'.$curr_user->project_id1.'">
								</div>
								<div class="form-group">
									<label>Member Role</label>
									<select name="role" class="form-control">
										<option></option>
										<option value="super_admin"'; if ( $userRole == 'super_admin') { echo ' selected="selected"'; }  echo '>Super Admin</option>
										<option value="administrator"'; if ( $userRole == 'administrator') { echo ' selected="selected"'; }  echo '>Administrator</option>
										<option value="embassador"'; if ( $userRole == 'embassador') { echo ' selected="selected"'; }  echo '>Embassador</option>
										<option value="wpc_client"'; if ( $userRole == 'wpc_client') { echo ' selected="selected"'; }  echo '>Client</option>
										<option value="subscriber"'; if ( $userRole == 'subscriber') { echo ' selected="selected"'; }  echo '>Subscriber</option>
									</section>
									<br><br>
								</div>
								<div class="form-group">
									<label>Project Link</label>
									<input type="text" class="form-control" name="project_link1" placeholder="Project Link" value="'.$curr_user->project_link1.'">
								</div>
								<div class="form-group">
									<label>Invoice Link</label>
									<input type="text" class="form-control" name="invoice_link" placeholder="Invoice Link" value="'.$curr_user->invoice_link.'">
								</div>
								<div class="form-group">
									<label>Google Drive</label>
									<input type="text" class="form-control" name="google_drive" placeholder="Google Drive link" value="'.$curr_user->google_drive.'">
								</div>
								<div class="form-group">
									<label>Google Calendar</label>
									<input type="text" class="form-control" name="project_calendar" placeholder="Google Calendar link" value="'.$curr_user->project_calendar.'">
								</div>
								<div class="form-group">
									<label>Registered Domain</label>
									<input type="text" class="form-control" name="registered_domain" value="'.$curr_user->registered_domain.'" placeholder="Registered Domain">
								</div>
								<div class="form-group">
									<label>Domain Registration</label>
									<input type="text" class="form-control" name="domain_registration"  value="'.$curr_user->domain_expiration.'"placeholder="Domain Registration Date">
								</div>
								<div class="form-group">
									<label>Domain Expiration</label>
									<input type="text" class="form-control" name="domain_expiration" value="'.$curr_user->domain_expiration.'" placeholder="Domain Expiration Date">
								</div>
								<div class="form-group">
									<label>Hosting Registration</label>
									<input type="text" class="form-control" name="hosting_registration" value="'.$curr_user->hosting_registration.'" placeholder="Domain Expiration">
								</div>
								<div class="form-group">
									<label>Hosting Expiration</label>
									<input type="text" class="form-control" name="hosting_expiration" value="'.$curr_user->hosting_expiration.'" placeholder="Domain Expiration Date">
								</div>';
		if( $curr_user->project_id1 != '' ) { 
			$ftp_url = get_post_meta( $curr_user->project_id1, 'ftp_url', true );
			$ftp_username = get_post_meta( $curr_user->project_id1, 'ftp_username', true );
			$ftp_password = get_post_meta( $curr_user->project_id1, 'ftp_password', true );
			$wp_url = get_post_meta( $curr_user->project_id1, 'wp_url', true );
			$wp_username = get_post_meta( $curr_user->project_id1, 'wp_username', true );
			$wp_password = get_post_meta( $curr_user->project_id1, 'wp_password', true );
		}
		echo '				</div>
							<div class="form-actions">
								<input type="hidden" name="action" value="update_user">
								<input type="hidden" name="user_ID" value="'.$curr_user->ID.'">
								<button type="submit" class="btn btn-sm green">Update</button> 
								<button type="button" class="btn btn-sm default" data-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div>
				</div>
				<!-- END EDIT USER MODAL -->';
		
		echo '	<!-- START USER NOTE MODAL -->
				<div class="modal fade in" id="user-note-pane-'.$curr_user->ID.'" tabindex="-1" data-replace="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Add a note to <strong>'.$curr_user->display_name.'</strong>\'s Profile</h4>
					</div>
					<div class="modal-body" id="user-note-modal-body-'.$curr_user->ID.'">';
		echo '			<form action="'.get_site_url().'/wp-users-post.php" method="post" class="user-note-form" role="form">
							<div class="form-body">
								<div class="form-group">
									<textarea class="form-control" name="admin_notes" placeholder="Admin Notes"></textarea>
								</div>
							</div>
							<div class="form-actions">
								<input type="hidden" name="action" value="add_user_note">
								<input type="hidden" name="user_ID" value="'.$curr_user->ID.'">
								<button type="submit" class="btn btn-sm btn-primary">Add Note</button> 
								<button type="button" class="btn btn-sm default" data-dismiss="modal">Cancel</button>
							</div>
						</form>';			
		echo '		</div>
				</div>
				<!-- END USER NOTE MODAL -->';
				
		echo '	<!-- START USER DETAILS MODAL -->
				<div class="modal fade in" id="user-details-pane-'.$curr_user->ID.'" tabindex="-1" data-replace="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Profile Details for <strong>'.$curr_user->display_name.'</strong></h4>
					</div>
					<div class="modal-body" id="user-details-modal-body-'.$curr_user->ID.'">';
				
		echo 			'<ul class="list-group">';
			if($curr_user->user_avatar != ''){
		echo 			'<li class="list-group-item"><img src="'. get_site_url() . '/wp-content/uploads' . $curr_user->user_avatar . '" alt="" class="img-responsive" /></li>';
			}
			if($curr_user->company_name != ''){
		echo 			'<li class="list-group-item"><strong>Company / Brand Name</strong>: '.$curr_user->company_name.'</li>';
			}
						$all_meta_for_user = get_user_meta( $curr_user->ID );
						foreach($all_meta_for_user as $key => $value) {
							if(is_array($value) && $value[0] != '') {
								
								switch($key)
								{ 
									case 'first_name':
									echo '<li class="list-group-item"><strong>First Name</strong>: ' . $value[0] . '</li>';
								  	break;
									case 'last_name':
									echo '<li class="list-group-item"><strong>Last Name</strong>: ' . $value[0] . '</li>';
								  	break;
									case 'nickname':
									echo '<li class="list-group-item"><strong>Nickname</strong>: ' . $value[0] . '</li>';
								  	break;
									case 'user_email':
									echo '<li class="list-group-item"><strong>Email Address</strong>: ' . $value[0] . '</li>';
								  	break;
									case 'user_url':
									echo '<li class="list-group-item"><strong>Website URL</strong>: ' . $value[0] . '</li>';
								  	break;
									case 'phonenumber':
									echo '<li class="list-group-item"><strong>Phone Number</strong>: ' . $value[0] . '</li>';
								  	break;
									case 'state':
									echo '<li class="list-group-item"><strong>State</strong>: ' . $value[0] . '</li>';
								  	break;
									case 'contact_number':
									echo '<li class="list-group-item"><strong>Contact Number</strong>: ' . $value[0] . '</li>';
								  	break;
									case 'preferred_communication':
									echo '<li class="list-group-item"><strong>Preferred Communication</strong>: ' . $value[0] . '</li>';
								  	break;
									case 'project_calendar':
									echo '<li class="list-group-item"><strong>Google Calendar</strong>: <a href="' . $value[0] . '" title="Google Calendar link"><img src="'.get_template_directory_uri().'/images/main/google-calendar-icon.png" width="30" height="30" alt=""></a></li>';
								  	break;
									case 'google_drive':
									echo '<li class="list-group-item"><strong>Google Drive</strong>: <a href="' . $value[0] . '" title="Google Drive link"><img src="'.get_template_directory_uri().'/images/main/google-drive-icon.png" width="30" height="30" alt=""></a></li>';
								  	break;
									case 'admin_notes':
								  	break;
									case 'user_avatar':
								  	break;
									case 'rich_editing':
								  	break;
									case 'comment_shortcuts':
								  	break;
									case 'admin_color':
								  	break;
									case 'show_admin_bar_front':
								  	break;
									case 'wp_capabilities':
								  	break;
									case 'wp_user_level':
								  	break;
									case 'dismissed_wp_pointers':
								  	break;
									case 'user_meta_user_status':
								  	break;
								}
							}
						}
		echo '					
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-sm btn-primary">Ok</button>
					</div>
				</div>
				<!-- END USER DETAILS MODAL -->';
				
		if($curr_user->user_email != '') {
		echo '	<!-- START EMAIL USER MODAL -->
				<div class="modal fade in" id="email-user-pane-'.$curr_user->ID.'" tabindex="-1" data-replace="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Send Email</h4>
					</div>
					<div class="modal-body" id="email-modal-body-'.$curr_user->ID.'">';
		echo '			
						<h5>Email will be sent to '.$curr_user->user_email.'</h5>
						<form action="'.get_site_url().'/wp-users-post.php" method="post" class="user-note-form" role="form">
							<div class="form-body">
								<div class="form-group">
									<label class="form-label">Subject:</label>
									<input type="text" name="message_subject" class="form-control">
								</div>
								<div class="form-group">
									<label class="form-label">Send an email to ';
		if ($curr_user->first_name == '' && $curr_user->last_name == '') { echo '<strong>'.$curr_user->user_login.'</strong>'; }
		else { echo '<strong>' . $curr_user->first_name .' '. $curr_user->last_name . '</strong>'; }
		echo '						 </label>
									<textarea class="form-control" name="message_content" rows="14" placeholder="Enter a message here..."></textarea>
								</div>
							</div>
							<div class="form-actions">
								<input type="hidden" name="action" value="email_user">
								<input type="hidden" name="message_to_FN" value="'.$curr_user->first_name.'">
								<input type="hidden" name="message_to_LN" value="'.$curr_user->last_name.'">
								<input type="hidden" name="message_to_EMAIL" value="'.$curr_user->user_email.'">
								<button type="submit" class="btn btn-sm btn-primary">Send Email</button> 
								<button type="button" class="btn btn-sm default" data-dismiss="modal">Cancel</button>
							</div>
						</form>';			
		echo '		</div>
				</div>
				<!-- END EMAIL USER MODAL -->';
		}
				
		echo '	<!-- START DELETE USER MODAL -->
				<div class="modal fade in" id="delete-user-pane-'.$curr_user->ID.'" tabindex="-1" data-replace="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Delete <strong>'.$curr_user->display_name.'</strong>\'s Profile</h4>
					</div>
					<div class="modal-body" id="delete-user-modal-body-'.$curr_user->ID.'">';
					
		echo '			<form action="'.get_site_url().'/wp-users-post.php" method="post" class="delete-user-form">
							<h6>Are you sure you want to delete this user?</h6>
							<input type="hidden" name="user_ID" value="'.$curr_user->ID.'">
							<input type="hidden" name="action" value="delete_user">
							<button type="submit" class="btn btn-sm red">Delete</button> 
							<button type="button" data-dismiss="modal" class="btn btn-sm default">Cancel</div>
						</form>
					</div>
				</div>
				<!-- END DELETE USER MODAL -->';
	}
	// end foreach loop
	
	echo '	<!-- START ADD USER MODAL -->
			<div class="modal fade in" id="new-user-pane" tabindex="-1" data-replace="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Add New User</h4>
				</div>
				<div class="modal-body" id="new-user-modal-body">';
				
		echo '			<form action="'.get_site_url().'/wp-users-post.php" method="post" class="add-user-form" role="form">
							<div class="form-body">
								<div class="form-group">
									<label>First Name</label>
									<input type="text" class="form-control" name="first_name" placeholder="First Name">
								</div>
								<div class="form-group">
									<label>Last Name</label>
									<input type="text" class="form-control" name="last_name" placeholder="Last Name">
								</div>
								<div class="form-group">
									<label>Company / Brand Name</label>
									<input type="text" class="form-control" name="company_name" placeholder="Comapany Name">
								</div>
								<div class="form-group">
									<label>User Email</label>
									<input type="text" class="form-control" name="user_email" placeholder="Email Address">
								</div>
								<div class="form-group">
									<label>Website URL</label>
									<input type="text" class="form-control" name="user_url" placeholder="Website">
								</div>
								<div class="form-group">
									<label>Contact Number</label>
									<input type="text" class="form-control" name="contact_number" placeholder="Contact Number">
								</div>
								<div class="form-group">
									<label>Member Role</label>
									<select name="role" class="form-control">
										<option></option>
										<option value="super_admin">Super Admin</option>
										<option value="administrator">Administrator</option>
										<option value="embassador">Embassador</option>
										<option value="wpc_client">Client</option>
										<option value="subscriber">Subscriber</option>
									</section>
								</div>
								<div class="form-group">
									<label>Username</label>
									<input type="text" class="form-control" name="user_login" placeholder="Username">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="text" class="form-control" name="user_password" placeholder="Password">
								</div>
								<div class="form-group">
									<label>Google Calendar</label>
									<input type="text" class="form-control" name="project_calendar" placeholder="Google Calendar">
								</div>
								<div class="form-group">
									<label>Google Drive</label>
									<input type="text" class="form-control" name="google_drive" placeholder="Google Drive">
								</div>
								<div class="form-group">
									<label>Invoice Link</label>
									<input type="text" class="form-control" name="invoice_link" placeholder="Invoice  Link">
								</div>
								<div class="form-group">
									<label>Registered Domain</label>
									<input type="text" class="form-control" name="registered_domain" placeholder="Registered Domain">
								</div>
								<div class="form-group">
									<label>Domain Registration</label>
									<input type="text" class="form-control" name="domain_registration" placeholder="Domain Registration Date">
								</div>
								<div class="form-group">
									<label>Domain Expiration</label>
									<input type="text" class="form-control" name="domain_expiration" placeholder="Domain Expiration Date">
								</div>
								<div class="form-group">
									<label>Hosting Registration</label>
									<input type="text" class="form-control" name="hosting_registration" placeholder="Domain Expiration">
								</div>
								<div class="form-group">
									<label>Hosting Expiration</label>
									<input type="text" class="form-control" name="hosting_expiration" placeholder="Domain Expiration Date">
								</div>
								<div class="form-group">
									<label>Admin Notes</label>
									<textarea class="form-control" name="admin_notes" placeholder="Add a note to user profile..."></textarea>
								</div>';
		echo '				</div>
							<div class="form-actions">
								<input type="hidden" name="action" value="new_user">
								<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add User</button> 
								<button type="button" class="btn btn-sm default" data-dismiss="modal">Cancel</button>
							</div>
						</form>
				</div>
			</div>
			<!-- END ADD USER MODAL -->';
	echo '	<!-- START USER MANAGER RESPONSE MODAL -->
				<div class="modal fade in" id="admin-user-action-modal" tabindex="-1" data-replace="true">
					<div class="modal-header pull-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>';
						
						switch($_GET['resp']){
							case 'user-added':
							  echo '<h4>User Successfully Added</h4>';
							  break;
							case 'user-exists':
							  echo '<h4>User Exists</h4>';
							  break;
							case 'user-updated':
							  echo '<h4>Profile Update Successful</h4>';
							  break;
							case 'no-user':
							  echo '<h4>User Non-existent</h4>';
							  break;
							case 'user-deleted':
							  echo '<h4>Profile Deletion Successful</h4>';
							  break;
							case 'note-added':
							  echo '<h4>Note Addition Successful</h4>';
							  break;
							case 'note-not-added':
							  echo '<h4>Note Addition Unsuccessful</h4>';
							  break;
							case 'email-not-sent':
							  echo '<h4>Email Not Sent</h4>';
							  break;
							case 'email-sent':
							  echo '<h4>Email Message Sent</h4>';
							  break;
							case 'project-not-added':
							  echo '<h4>Project Addition Unsuccessful</h4>';
							  break;
							case 'project-added':
							  echo '<h4>Project Addition Successful</h4>';
							  break;
							case 'project-not-deleted':
							  echo '<h4>Project Deletion Unsuccessful</h4>';
							  break;
							case 'project-deleted':
							  echo '<h4>Project Deleted Successful</h4>';
							  break;
							case 'project-not-updated':
							  echo '<h4>Project Update Unsuccessful</h4>';
							  break;
							case 'project-updated':
							  echo '<h4>Project Update Successful</h4>';
							  break;
						}
	echo '			</div>
					<div class="modal-body" id="user-action-response-modal-body">';
						switch($_GET['resp']){
							case 'user-added':
							  echo '<h6>The user <strong>'.$_GET['user'].'</strong> has been added to Artcotechs Connect!</h6>';
							  break;
							case 'user-exists':
							  echo '<h6>The user already exists!</h6>';
							  break;
							case 'user-updated':
							  echo '<h6>The profile for <strong>'.$_GET['user'].'</strong> has been updated!</h6>';
							  break;
							case 'no-user':
							  echo '<h6>This user does not exist!</h6>';
							  break;
							case 'user-deleted':
							  echo '<h6>The user has been deleted from Artcotechs Connect!</h6>';
							  break;
							case 'note-added':
							  echo '<h6>Your note has been added to the member profile!</h6>';
							  break;
							case 'note-not-added':
							  echo '<h6>Your note hasn\'t been added!</h6>';
							  break;
							case 'email-not-sent':
							  echo '<h6>Your email has not been sent to the user. Please make sure you fill in a subject and message to send to user.</h6>';
							  break;
							case 'email-sent':
							  echo '<h6>Your email has been successfully sent to the member.</h6>';
							  break;
							case 'project-added':
							  echo '<h6>Your project has successfully been added to Artcotechs Connect!</h6>';
							  break;
							case 'project-not-added':
							  echo '<h6>Your project has not been added to Artcotechs Connect!</h6>';
							  break;
							case 'project-not-deleted':
							  echo '<h6>Your project has not been deleted from Artcotechs Connect!</h6>';
							  break;
							case 'project-deleted':
							  echo '<h6>Your project has successfully been deleted from Artcotechs Connect!</h6>';
							  break;
							case 'project-updated':
							  echo '<h6>Your project has successfully been updated on Artcotechs Connect!</h6>';
							  break;
							case 'project-not-updated':
							  echo '<h6>Your project has not successfully been updated on Artcotechs Connect!</h6>';
							  break;
						}
						
		echo '		</div>
					<div class="modal-footer">	
						<div class="pull-right"><button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" aria-hidden="true">Ok</button></div>
					</div>
				</div>
				<a href="#admin-user-action-modal" data-toggle="modal"></a>
				<!-- END USER MANAGER RESPONSE MODAL -->';
}
// admin_user_manage_modals()



/* //////////////////////////////////////////////////////////////////////////
**		Get all project action modals for admin
**		Return Modals With Admin Actions - 	[ Create | Delete | Update ]
** /////////////////////////////////////////////////////////////////////////*/
function admin_projects_manage_modals() {
	
	$the_query = new WP_Query('post_type=client_projects&posts_per_page=100');
	while ( $the_query->have_posts() ) : $the_query->the_post(); 
		$quest_arrays = array();
		$brandmark_design_form = get_post_meta(get_the_ID(), 'brandmark-design-form', true); 
	  	$web_development_form = get_post_meta(get_the_ID(), 'web-development-form', true); 
	  	$graphic_design_form = get_post_meta(get_the_ID(), 'graphic-design-form', true); 
	  	$event_brand_form = get_post_meta(get_the_ID(), 'event-brand-form', true); 
	  	$social_media_form = get_post_meta(get_the_ID(), 'social-media-form', true); 
		if($brandmark_design_form != NULL) { array_push($quest_arrays, $brandmark_design_form); }
		if($web_development_form != NULL) { array_push($quest_arrays, $web_development_form); }
		if($graphic_design_form != NULL) { array_push($quest_arrays, $graphic_design_form); }
		if($event_brand_form != NULL) { array_push($quest_arrays, $event_brand_form); }
		if($social_media_form != NULL) { array_push($quest_arrays, $social_media_form); }
		$comments = get_comments(get_the_ID());
		$ftp_url = get_post_meta(get_the_ID(), 'ftp_url', true);
		$ftp_username = get_post_meta(get_the_ID(), 'ftp_username', true);
		$ftp_password = get_post_meta(get_the_ID(), 'ftp_password', true);
		$wp_url = get_post_meta(get_the_ID(), 'wp_url', true);
		$wp_username = get_post_meta(get_the_ID(), 'wp_username', true);
		$wp_password = get_post_meta(get_the_ID(), 'wp_password', true);
		
		$the_project_description = get_user_meta($client_ID, 'the_project_description', true);
		$project_start = get_post_meta(get_the_ID(), 'project_start', true);
		$project_end = get_post_meta(get_the_ID(), 'project_end', true);
		$progress = get_post_meta(get_the_ID(), 'progress', true);
		$project_status = get_post_meta(get_the_ID(), 'project_status', true);
		$project_phase = get_post_meta(get_the_ID(), 'project_phase', true);
		$client_ID = get_post_meta(get_the_ID(), 'client_ID', true);
		$client_NAME = get_user_meta($client_ID, 'client_name', true);
		
		$current_holds = get_post_meta(get_the_ID(), 'current_holds', true);
		$current_tasks = get_post_meta(get_the_ID(), 'current_tasks', true);
		$open_close = get_post_meta(get_the_ID(), 'open_close', true);
		$pm1_ID = get_post_meta(get_the_ID(), 'pm1_ID', true);
		$manager_NAME = get_user_meta($pm1_ID, 'display_name', true);
		
		
		echo '	
			<!-- START VIEW PROJECT MODAL -->
			<div class="modal fade in" id="project-view-pane-'.get_the_ID().'" tabindex="-1" data-replace="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Project Overview</h4>
				</div>
				<div class="modal-body" id="project-view-modal-body-'.get_the_ID().'">';
				
				echo '<div class="panel-group accordion" id="project_quest_results">';
					
					
				echo '  <div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#project_quest_results" href="#project-details-results">Project Details</a>
								</h4>
							</div>
							<div id="project-details-results" class="panel-collapse in">
								<div class="panel-body">
									<table class="table table-bordered table-striped table-condensed">
									<thead>
										<tr>
											<th>META</th>
											<th>DETAILS</th>
										</tr>
									</thead>
									<tbody>';
									if($client_NAME != ''){ echo ' <tr><td><strong>Client Name</strong></td><td>'.$client_NAME.'</td></tr>'; }
									if($project_start != ''){  echo ' <tr><td><strong>Project Start</strong></td><td>'.$project_start.'</td></tr>'; }
									if($project_end != ''){  echo ' <tr><td><strong>Project End</strong></td><td>'.$project_end.'</td></tr>'; }
									if($progress != ''){  echo ' <tr><td><strong>Completion %</strong></td><td>'.$progress.'% complete</td></tr>'; }
									if($project_phase != ''){  echo ' <tr><td><strong>Project Phase</strong></td><td>'.$project_phase.'</td></tr>'; }
									if($open_close != ''){  echo ' <tr><td><strong>Project Status</strong></td><td>'.$open_close.'</td></tr>'; }
									if($manager_NAME != ''){  echo ' <tr><td><strong>Project Manager</strong></td><td>'.$manager_NAME.'</td></tr>'; }
									
									if($current_holds != ''){  echo ' <tr><td><strong>Current Holds</strong></td><td>'.$current_holds.'</td></tr>'; }
									if($current_tasks != ''){  echo ' <tr><td><strong>Current Tasks</strong></td><td>'.$current_tasks.'</td></tr>'; }
									
									if($ftp_url != ''){  echo ' <tr><td><strong>FTP URL</strong></td><td>'.$ftp_url.'</td></tr>'; }
									if($ftp_username != ''){  echo '	<tr><td><strong>FTP Username</strong></td><td>'.$ftp_username.'</td></tr>'; }
									if($ftp_password != ''){  echo '	<tr><td><strong>FTP Password</strong></td><td>'.$ftp_password.'</td></tr>'; }
									if($wp_url != ''){  echo '	<tr><td><strong>WP Admin URL</strong></td><td><a href="'.$wp_url.'" title="Wordpress Admin URL" target="_blank">'.$wp_url.'</a></td></tr>'; }
									if($wp_username != ''){  echo '	<tr><td><strong>WP Username</strong></td><td>'.$wp_username.'</td></tr>'; }
									if($wp_password != ''){  echo '	<tr><td><strong>WP Password</strong></td><td>'.$wp_password.'</td></tr>'; }
				echo '				</tbody>
									</table>
								</div>
							</div>
						</div>';
					
					// Display Project Questionnaire Results
					if(isset($quest_arrays) && $quest_arrays != NULL){
						foreach($quest_arrays as $quests) { 
						echo '  <div class="panel panel-primary">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#project_quest_results" href="#'.$quests["questionnaire_slug"].'">
										'.$quests["form_title"].' Questionnaire </a>
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
					}
								
		echo ' 			</div>
						<!-- /.panel-group -->';
						
		echo '		</div>
					<!-- /.modal-body -->
					<div class="modal-footer">
						<button type="button" class="btn btn-sm default" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- END VIEW PROJECT MODAL -->';
				
		echo '	<!-- START EDIT PROJECT MODAL -->
				<div class="modal fade in" id="project-edit-pane-'.get_the_ID().'" tabindex="-1" data-replace="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Update Project</h4>
					</div>
					<div class="modal-body" id="project-edit-modal-body-'.get_the_ID().'">';
						amn_edit_project_form(get_the_ID());
		echo '		</div>
				</div>
				<!-- END EDIT PROJECT MODAL -->';
				
		echo '	<!-- START DELETE PROJECT MODAL -->
				<div class="modal fade in" id="project-delete-pane-'.get_the_ID().'" tabindex="-1" data-replace="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Delete Project</h4>
					</div>
					<div class="modal-body" id="project-delete-modal-body-'.get_the_ID().'">';
					
		echo '			<form action="'.get_site_url().'/wp-projects-post.php" method="post" class="project-delete-form">
							<h6>Are you sure you want to delete this project?</h6>
							<input type="hidden" name="project_ID" value="'.get_the_ID().'">
							<input type="hidden" name="action" value="delete_project">
							<button type="submit" class="btn btn-sm red">Delete</button> 
							<button type="button" data-dismiss="modal" class="btn btn-sm default">Cancel</button>
						</form>
					</div>
				</div>
				<!-- END DELETE PROJECT MODAL -->';
		if( isset($comments) && $comments != null ) { 
		echo '	<!-- START PROJECT MESSAGING THREAD MODAL -->
				<div class="modal fade in" id="project-messaging-pane-'.get_the_ID().'" tabindex="-1" data-replace="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Project Messaging Thread</h4>
					</div>
					<div class="modal-body" id="project-messaging-modal-body-'.get_the_ID().'">';
						amn_messaging_form( get_the_ID(), '', '' );
						amn_show_images_modal ( get_the_ID() );
						amn_show_messaging_thread( get_the_ID(), 'projectMessagingWrapper_' . get_the_ID());
		echo '			
					</div>
				</div>
				<!-- END PROJECT MESSAGING THREAD MODAL -->';
		}
	endwhile;
	
	echo '	<!-- START NEW PROJECT MODAL -->
			<div class="modal fade in" id="new-project-pane" tabindex="-1" data-replace="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Add New Project</h4>
				</div>
				<div class="modal-body" id="new-user-modal-body">';
				
		echo '			<form action="'.get_site_url().'/wp-projects-post.php" method="post" class="add-user-form" role="form">
							<div class="form-body">
								<div class="form-group">
									<label class="control-label">Client Name</label>
									<select class="form-control" name="client_ID" input-large">
										<option value="">Select a client... </option>';
									$all_users = get_users();
									
									foreach($all_users as $currUser){ 	
		echo '							<option value="'.$currUser->ID.'">'.$currUser->display_name.'</option> ';
								}
										
		echo '						</select>
								</div>
								<div class="form-group">
									<label class="control-label">Project Name</label>
									<input type="text" class="form-control" name="project_name" placeholder="Project Name">
								</div>
								<div class="form-group">
									<label class="control-label">Project Description</label>
									<textarea class="form-control" name="the_project_description" cols="8" placeholder="Project Description"></textarea>
								</div>
								<div class="form-group">
									<label class="control-label">Project Start</label>
									<input type="text" class="form-control" name="project_start" placeholder="Project Start">
								</div>
								<div class="form-group">
									<label class="control-label">Project End</label>
									<input type="text" class="form-control" name="project_end" placeholder="Project End">
								</div>
								<div class="form-group">
									<label class="control-label">Project Progress</label>
									<input type="text" class="form-control" name="progress" placeholder="% Complete">
								</div>
								<div class="form-group">
									<label class="">Project Phase</label>
									<div class="radio-list">
										<label>
										<input type="radio" name="project_phase" id="project_phase1" value="Discovery" checked> Discovery </label>
										<label>
										<input type="radio" name="project_phase" id="project_phase2" value="Design"> Design </label>
										<label>
										<input type="radio" name="project_phase" id="project_phase3" value="Development"> Development </label>
										<label>
										<input type="radio" name="project_phase" id="project_phase4" value="Launch"> Launch </label>
										<label>
										<input type="radio" name="project_phase" id="project_phase5" value="Post Launch"> Post Launch </label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Project Status</label>
									<div class="radio-list">
										<label>
										<input type="radio" name="open_close" id="open_close1" value="Not Started" checked> Not Started </label>
										<label>
										<input type="radio" name="open_close" id="open_close2" value="In Progress"> In Progress </label>
										<label>
										<input type="radio" name="open_close" id="open_close3" value="Awaiting Approval"> Awaiting Approval </label>
										<label>
										<input type="radio" name="open_close" id="open_close4" value="Closed"> Closed </label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Current Holds</label>
									<textarea class="form-control" name="current_holds" placeholder="Current Holds"></textarea>
								</div>
								<div class="form-group">
									<label class="control-label">Current Tasks</label>
									<textarea class="form-control" name="current_tasks" placeholder="Current Tasks"></textarea>
								</div>
								<div class="form-group">
									<label class="control-label">Project Administrator</label>
									<select class="form-control" name="pm1_ID" input-large">
										<option value="">Select a project manager... </option>';
									
									foreach($all_users as $currUser){ 	
										$currUserProperty = new WP_User( $currUser->ID ); 
										$pm_role = '';
										if ( !empty( $currUserProperty->roles ) && is_array( $currUserProperty->roles ) ) { 
										  foreach ( $currUserProperty->roles as $curr_role )
											  $pm_role = $curr_role; 
										}	
										if($pm_role == 'administrator' || $pm_role == 'super_admin' || $pm_role == 'embassador') {
		echo '							<option value="'.$currUser->ID.'">'.$currUser->display_name.'</option> ';
										}
									}
										
		echo '						</select>
								</div>
								
								<div class="form-group">
									<label class="control-label">Current Assignee</label>
									<select class="form-control" name="assignee_ID" input-large">
										<option value="">Assign project to... </option>';
									
									foreach($all_users as $currUser){ 	
		echo '							<option value="'.$currUser->ID.'">'.$currUser->display_name.'</option> ';
								}
										
		echo '						</select>
								</div>';
		echo '					
								<div class="form-group">
									<label class="control-label">FTP Credentials</label>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="ftp_url" placeholder="FTP URL">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="ftp_username" placeholder="FTP Username">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="ftp_password" placeholder="FTP Password">
								</div>
								<div class="form-group">
									<label>Wordpress Credentials</label>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="wp_url" placeholder="WP Admin URL">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="wp_username" placeholder="WP Username">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="wp_password" placeholder="WP Password">
								</div>
								<div class="form-group">
									<label class="control-label">20% Phase</label>
									<textarea class="form-control" name="twenty_percent_desc" cols="10" placeholder="20% Phase"></textarea>
								</div>
								<div class="form-group">
									<label class="control-label">40% Phase</label>
									<textarea class="form-control" name="forty_percent_desc" cols="10" placeholder="40% Phase"></textarea>
								</div>
								<div class="form-group">
									<label class="control-label">60% Phase</label>
									<textarea class="form-control" name="sixty_percent_desc" cols="10" placeholder="60% Phase"></textarea>
								</div>
								<div class="form-group">
									<label class="control-label">80% Phase</label>
									<textarea class="form-control" name="eighty_percent_desc" cols="10" placeholder="80% Phase"></textarea>
								</div>
								<div class="form-group">
									<label class="control-label">100% Phase</label>
									<textarea class="form-control" name="hundred_percent_desc" cols="10" placeholder="100% Phase"></textarea>
								</div>';
		echo '				</div>
							<div class="form-actions">
								<input type="hidden" name="action" value="new_project">
								<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Project</button> 
								<button type="button" class="btn btn-sm default" data-dismiss="modal">Cancel</button>
							</div>
						</form>
				</div>
			</div>
			<!-- END NEW PROJECT MODAL -->';
}
//`admin_projects_manage_modals()


/* //////////////////////////////////////////////////////////////////////////
**		Get project edit form admin
**		Return Form
** /////////////////////////////////////////////////////////////////////////*/
function amn_edit_project_form($the_id){
	
	
	$client_ID = get_post_meta($the_id, 'client_ID', true);
	$client_name = get_post_meta($the_id, 'client_name', true);
	$project_name = get_post_meta($the_id, 'project_name', true);
	$the_project_description = get_post_meta($the_id, 'the_project_description', true);
	$project_start = get_post_meta($the_id, 'project_start', true);
	$project_end = get_post_meta($the_id, 'project_end', true);
	$current_tasks = get_post_meta($the_id, 'current_tasks', true);
	$current_holds = get_post_meta($the_id, 'current_holds', true);
	$progress = get_post_meta($the_id, 'progress', true);
	$open_close = get_post_meta($the_id, 'open_close', true);
	$project_phase = get_post_meta($the_id, 'project_phase', true);
	$project_image = get_post_meta($the_id, 'project_image', true);
	$pm1_ID = get_post_meta($the_id, 'pm1_ID', true);
	$assignee_ID = get_post_meta($the_id, 'assignee_ID', true);
	$pm1_name = get_post_meta($the_id, 'pm1_name', true);
	$assignee_name = get_post_meta($the_id, 'assignee_name', true);
	
	
	$wp_url = get_post_meta($the_id, 'wp_url', true);
	$wp_username = get_post_meta($the_id, 'wp_username', true);
	$wp_password = get_post_meta($the_id, 'wp_password', true);
	$ftp_url = get_post_meta($the_id, 'ftp_url', true);
	$ftp_username = get_post_meta($the_id, 'ftp_username', true);
	$ftp_password = get_post_meta($the_id, 'ftp_password', true);
	
	$twenty_percent_title = get_post_meta($the_id, 'twenty_percent_title', true);
	$fourty_percent_title = get_post_meta($the_id, 'fourty_percent_title', true);
	$sixty_percent_title = get_post_meta($the_id, 'sixty_percent_title', true);
	$eighty_percent_title = get_post_meta($the_id, 'eighty_percent_title', true);
	$hundred_percent_title = get_post_meta($the_id, 'hundred_percent_title', true);
	$twenty_percent_desc = get_post_meta($the_id, 'twenty_percent_desc', true);
	$fourty_percent_desc = get_post_meta($the_id, 'fourty_percent_desc', true);
	$sixty_percent_desc = get_post_meta($the_id, 'sixty_percent_desc', true);
	$eighty_percent_desc = get_post_meta($the_id, 'eighty_percent_desc', true);
	$hundred_percent_desc = get_post_meta($the_id, 'hundred_percent_desc', true);
	
	
	echo '			<form action="'.get_site_url().'/wp-projects-post.php" method="post" class="project-edit-form" role="form">
							<div class="form-body">
								<div class="form-group">
									<label class="control-label">Client Name</label>
									<select class="form-control" name="client_ID" input-large">
										<option value="">Choose a client... </option>';
									$all_users = get_users();
									
								foreach($all_users as $currUser){ 
									
		echo '							<option value="'.$currUser->ID.'"';
											if($client_ID == $currUser->ID) { echo ' selected'; }
		echo '								>'.$currUser->display_name.'</option> ';
								}
		echo '						</select>
								</div>';
		echo	'				<div class="form-group">
									<label class="control-label">Project Name</label>
									<input type="text" class="form-control" name="project_name" placeholder="Project Name" value="'.$project_name.'">
								</div>
								<div class="form-group">
									<label class="control-label">Project Description</label>
									<textarea class="form-control" name="the_project_description" cols="8" placeholder="Project Description">'.$the_project_description.'</textarea>
								</div>
								<div class="form-group">
									<label class="control-label">Project Start</label>
									<input type="text" class="form-control" name="project_start" placeholder="Project Start" value="'.$project_start.'">
								</div>

								<div class="form-group">
									<label class="control-label">Project End</label>
									<input type="text" class="form-control" name="project_end" placeholder="Project End" value="'.$project_end.'">
								</div>
								<div class="form-group">
									<label class="control-label">Project Progress</label>
									<input type="text" class="form-control" name="progress" placeholder="% Complete" value="'.$progress.'">
								</div>
								<div class="form-group">
									<label class="">Project Phase</label>
									<div class="radio-list">
										<label>
										<input type="radio" name="project_phase" id="project_phase1" value="Discovery"'; 
										if($project_phase == 'Discovery'){ echo 'checked'; }
										echo '> Discovery </label>
										<label>
										<input type="radio" name="project_phase" id="project_phase2" value="Design"';
										if($project_phase == 'Design'){ echo 'checked'; }
										echo '> Design </label>
										<label>
										<input type="radio" name="project_phase" id="project_phase3" value="Development"';
										if($project_phase == 'Development'){ echo 'checked'; }
										echo '> Development </label>
										<label>
										<input type="radio" name="project_phase" id="project_phase4" value="Launch"';
										if($project_phase == 'Launch'){ echo 'checked'; }
										echo '> Launch </label>
										<label>
										<input type="radio" name="project_phase" id="project_phase5" value="Post Launch"';
										if($project_phase == 'Post Launch'){ echo 'checked'; }
										echo '> Post Launch </label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Current Holds</label>
									<textarea class="form-control" name="current_holds" cols="8" placeholder="Current Holds">'.$current_holds.'</textarea>
								</div>
								<div class="form-group">
									<label class="control-label">Current Tasks</label>
									<textarea class="form-control" name="current_tasks" cols="8" placeholder="Current Tasks">'.$current_tasks.'</textarea>
								</div>
								<div class="form-group">
									<label class="control-label">Project Status</label>
									<div class="radio-list">
										<label>
										<input type="radio" name="open_close" id="open_close1" value="Not Started"';
										if($open_close == 'Not Started'){ echo 'checked'; }
										echo '> Not Started </label>
										<label>
										<input type="radio" name="open_close" id="open_close2" value="In Progress"';
										if($open_close == 'In Progress'){ echo 'checked'; }
										echo '> In Progress </label>
										<label>
										<input type="radio" name="open_close" id="open_close3" value="Awaiting Approval"';
										if($open_close == 'Awaiting Approval'){ echo 'checked'; }
										echo '> Awaiting Approval </label>
										<label>
										<input type="radio" name="open_close" id="open_close4" value="Closed"';
										if($open_close == 'Closed'){ echo 'checked'; }
										echo '> Closed </label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Project Administrator</label>
									<select class="form-control" name="pm1_ID" input-large">
										<option value="">Select a project manager... </option>';
									
									foreach($all_users as $currUser){ 
										$currUserProperty = new WP_User( $currUser->ID ); 
										$pm_role = '';
										if ( !empty( $currUserProperty->roles ) && is_array( $currUserProperty->roles ) ) { 
										  foreach ( $currUserProperty->roles as $curr_role )
											  $pm_role = $curr_role; 
										}	
										if($pm_role == 'administrator' || $pm_role == 'super_admin' || $pm_role == 'embassador') {
		echo '							<option value="'.$currUser->ID.'"';
											if($pm1_ID == $currUser->ID) { echo ' selected'; }
		echo '								>'.$currUser->display_name.'</option> ';
										}
								}
		echo '						</select>
								</div>';
								
		echo '					<div class="form-group">
									<label class="control-label">Current Assignee</label>
									<select class="form-control" name="assignee_ID" input-large">
										<option value="">Assign project to member... </option>';
									
									foreach($all_users as $currUser){ 	
		echo '							<option value="'.$currUser->ID.'"';
											if($assignee_ID == $currUser->ID) { echo ' selected'; }
		echo '								>'.$currUser->display_name.'</option> ';
								}
		echo '						</select>
								</div>';
		echo '					
								<div class="form-group">
									<label class="control-label">FTP Credentials</label>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="ftp_url" placeholder="FTP URL" value="'.$ftp_url.'">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="ftp_username" placeholder="FTP Username" value="'.$ftp_username.'">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="ftp_password" placeholder="FTP Password" value="'.$ftp_password.'">
								</div>
								<div class="form-group">
									<label>Wordpress Credentials</label>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="wp_url" placeholder="WP Admin URL" value="'.$wp_url.'">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="wp_username" placeholder="WP Username" value="'.$wp_username.'">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="wp_password" placeholder="WP Password" value="'.$wp_password.'">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="development_link" placeholder="Development Link" value="'.$development_link.'">
								</div>
								<div class="form-group">
									<label class="control-label">20% Phase</label>
									<textarea class="form-control" name="twenty_percent_desc" rows="8" placeholder="20% Phase">'.$twenty_percent_desc.'</textarea>
								</div>
								<div class="form-group">
									<label class="control-label">40% Phase</label>
									<textarea class="form-control" name="forty_percent_desc" rows="8" placeholder="40% Phase">'.$forty_percent_desc.'</textarea>
								</div>
								<div class="form-group">
									<label class="control-label">60% Phase</label>
									<textarea class="form-control" name="sixty_percent_desc" rows="8" placeholder="60% Phase">'.$sixty_percent_desc.'</textarea>
								</div>
								<div class="form-group">
									<label class="control-label">80% Phase</label>
									<textarea class="form-control" name="eighty_percent_desc" rows="8" placeholder="80% Phase">'.$eighty_percent_desc.'</textarea>
								</div>
								<div class="form-group">
									<label class="control-label">100% Phase</label>
									<textarea class="form-control" name="hundred_percent_desc" rows="8" placeholder="100% Phase">'.$hundred_percent_desc.'</textarea>
								</div>';
		echo '				</div>
							<div class="form-actions">
								<input type="hidden" name="action" value="update_project">
								<input type="hidden" name="project_ID" value="'.$the_id.'">
								<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Update Project</button> 
								<button type="button" class="btn btn-sm default" data-dismiss="modal">Cancel</button>
							</div>
						</form>';
	
}
// amn_edit_project_form()



?>