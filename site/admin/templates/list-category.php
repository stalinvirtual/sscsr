<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><a href="<?php echo $create_category_link; ?>" class="btn btn-primary pull-right" style="margin-top:-30px"><span class="glyphicon glyphicon-plus-sign"></span> Add Category </a></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="adminCategory" class="table table-bordered table-hover display">
                        <thead>
                            <tr>
								<th style="width:5px">Sr.No</th>
                                <th>Category Name </th>
                                <th style="width:20px">Category For </th>
                                <th style="width:10px">Status</th>
                                <th style="width:5px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

							
                            foreach (@$categorycreationlists as $sn => $categorylist) :
                                $delete_category_link_str = str_replace("{id}", $categorylist->category_id, $delete_category_link);
                                $edit_category_link_str = str_replace("{id}", $categorylist->category_id, $edit_category_link);
                                //$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
                                // $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
                            ?>
                                <tr>
                                    <td><?= ++$sn; ?></td>
                                    <td><?= $categorylist->category_name ?></td>
									
									
									<td><?php if($categorylist->show_in_selection_post ==1){
										echo '<button type="button" class="btn-primary btn-fw" disabled>Selection Post</button>';
									}else if($categorylist->show_in_nomination ==1){
										echo '<button type="button" class="btn-warning btn-fw" disabled>Nomination</button>';
									}else {
										echo '-';
									}

									?>
									</td>
									
									<td><?php if($categorylist->status ==1)
									{
										echo '<i class="fa fa-flag" aria-hidden="true"  style="color:green"></i>';
									}else{
										echo '<i class="fa fa-flag" aria-hidden="true" style="color:red"></i>';
									}   ?>
									</td>
									
									
                                   
                                    
                                    <td>
                                        <!--  Form Start  --->
									   
									   <form method="post">
                                           <?php
										   
												if($is_superadmin==1){?>
													
													
													<a href="<?php echo $edit_category_link_str;?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_category_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a>
													<?php 
													if (@$_GET['status'] == 0 && $categorylist->status != 1){
														echo '<i class="fa fa-eye category-publish-button" style="color:#007bff"></i>';
													}
													
												}
										   
												else if($is_admin==1){?>
												
												
													<a href="<?php echo $edit_category_link_str;?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_category_link_str; ?>" onClick="return confirm('Are you sure you want to delete?');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a>
													<?php 
													if (@$_GET['status'] == 0 && $categorylist->status != 1){
														echo '<i class="fa fa-eye category-publish-button" style="color:#007bff"></i>';
													}
													
													
												 }
												elseif($is_uploader==1 ){ ?>
													<a href="<?php echo $edit_category_link_str;?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_category_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a>
													
												<?php }
												
												else{
													if (@$_GET['status'] == 0 && $categorylist->status != 1){
														echo '<i class="fa fa-eye category-publish-button" style="color:#007bff"></i>';
													}


													}
										   ?>
										   <input type="hidden" value="<?= $categorylist->category_id ?>" name="id" id="category_id">
                                        </form>
                                       <!--  Form Start  --->
                                    </td>

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