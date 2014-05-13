


<!---====================================================================================-->


        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box amn-portlet-tab">
            <div class="portlet-title">
                <div class="caption"> <i class="fa fa-group"></i> All Members </div>
                <div class="tools">
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body" id="all-users-portlet-body">
                <div class="table-toolbar">
                    <div class="btn-group">
                        <a href="#new-user-pane" data-toggle="modal" class="btn btn-primary" title="Add a new user"><i class="fa fa-plus"></i> Add New Member</a>                            
                    </div>
                    <div class="btn-group pull-right">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="#">Print</a>
                            </li>
                            <li>
                                <a href="#">Save as PDF</a>
                            </li>
                            <li>
                                <a href="#">Export to Excel</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead class="table-checkbox">
                  <tr>
                    <th></th>
                    <th align="center">ID</th>
                    <th align="center">Avatar</th>
                    <th align="center">Username</th>
                    <th align="center">Email</th>
                    <th align="center">Role</th>
                  </tr>
                </thead>
                <tbody>
               <?php
                $blogusers = get_users();
                foreach ($blogusers as $user) { 
                $currUserProperty = new WP_User( $user->ID ); 
                $userRole = '';
                $capUserRole = '';
                $user_avatar = get_user_meta( $user->ID, 'user_avatar', true );
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
                ?>
                <tr class="odd gradeX">
                    <td>
                        <a class="btn btn-sm dark" href="#single-user-<? echo $user->ID; ?>" data-toggle="tab" title="View User"><i class="fa fa-user"></i></a> 
                        <a class="btn btn-sm purple" href="#edit-user-pane-<? echo $user->ID; ?>" data-toggle="modal" title="Edit User"><i class="fa fa-pencil"></i></a> 
                        <br /><br />
                        <? if( isset($user->user_email) && $user->user_email != '' ) { ?>
                        <a class="btn btn-sm green" href="#email-user-pane-<? echo $user->ID; ?>" data-toggle="modal" title="Email User"><i class="fa fa-mail-forward"></i></a>
                        <? } ?>
                        <a class="btn btn-sm red" href="#delete-user-pane-<? echo $user->ID; ?>" data-toggle="modal" title="Delete User"><i class="fa fa-minus-circle"></i></a>
                    </td>
                    <td><? echo $user->ID; ?></td>
                    <td align="center"><? if($user_avatar != ''){ ?>
                      <a href="#edit-user-pane-<? echo $user->ID; ?>" data-toggle="modal" title="Edit User">
                      <img src="<? bloginfo( 'siteurl' ); ?>/wp-content/uploads<? echo $user_avatar; ?>" alt="User Avatar" class="member-avatar">
                      <? } else { ?>
                      <img src="<? bloginfo( 'template_url' ); ?>/images/main/amn-manhead-icon.png" alt="User Avatar" class="member-avatar">
                      <? } ?>
                      </a>
                    </td>
                    <td><? echo $user->display_name; ?></td>
                    <td><a href="mailto:<? echo $user->user_email; ?>"><? echo $user->user_email; ?></a></td>
                    <td><? echo $capUserRole; ?></td>
                </tr>
                <? }  ?>
                </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->

