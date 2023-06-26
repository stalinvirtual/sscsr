<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><a href="<?php echo $create_login_user_link; ?>" class="btn btn-primary pull-right" style="margin-top:-30px"><span class="glyphicon glyphicon-plus-sign"></span> Create User </a></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                
                                <th>User Name </th>
                                <th>Role </th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Last Login</th>
                               <!-- <th> Action </th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php

							
                            foreach (@$usercreationlists as $sn => $userlist) :
                                //$delete_dl_link_str = str_replace("{id}", $userlist->debarred_lists_id, $delete_debarred_lists_link);
                               // $edit_dl_link_str = str_replace("{id}", $userlist->debarred_lists_id, $edit_debarred_lists_link);
                                //$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
                                // $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
                            ?>
							
							<?php
									if($userlist->user_role_id == 2)
									{
										$role = 'Admin';
									}else if($userlist->user_role_id == 3)
									{
										$role = 'Uploader';
									}else if($userlist->user_role_id == 4)
									{
										$role = 'Publisher';
									}else{
										$role = 'Super Admin';
									}
										
							
							?>
                                <tr>
                                    <td><?= ++$sn; ?></td>
                                    <td><?= $userlist->username ?></td>
                                    <td><?= $role  ?></td>
                                    <td><?= $userlist->email ?></td>
                                    <td><?= $userlist->phone_number ?></td>
                                    <td><?= $userlist->last_login ?></td>
									
                                   
                                    
                                    

                                </tr>
                            <?php endforeach; ?>
                            <?php //} 
                            ?>
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>