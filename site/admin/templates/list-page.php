<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
			<?php 
				if(($is_superadmin==1) || ($is_admin==1) || ($is_uploader==1)  ){?>
					<div class="card-header">
						<h3 class="card-title"><a href="<?php echo $create_page_link; ?>" class="btn btn-primary pull-right" style="margin-top:-30px"><span class="glyphicon glyphicon-plus-sign"></span> Add Page</a></h3>
					</div>
				<?php }
				
				
				?>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="pageTbl" class="table table-bordered table-hover display">
                        <thead>
                            <tr>
                                <th style="width:5px">Sr.No</th>
                                <th >Title</th>
                                <th style="width:10px">Status</th>
                                <th style="width:5px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($pages as $sn => $page) :
                                $delete_page_link_str = str_replace("{id}", $page->page_id, $delete_page_link);
                                $edit_page_link_str = str_replace("{id}", $page->page_id, $edit_page_link);
								$view_page_link_str = str_replace("{id}", $page->page_id, $view_page_link);
                            ?>
                                <tr>
                                    <td style="text-align:center"><?= ++$sn; ?></td>
                                    <td><?= $page->title ?></td>
                                    <td><?php if($page->status ==1){
										echo '<button type="button" class="btn-success btn-fw" disabled>Published</button>';
									}else{
										echo '<button type="button" class="btn-danger btn-fw" disabled>Unpublished</button>';
									}   ?></td>

                                    <td>
                                        <form method="post">
                                                                                       <?php
																					   
												if($is_superadmin==1){?>
													<a href="<?php echo $edit_page_link_str; ?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<!-- <a href="<?php //echo $delete_page_link_str; ?>" onClick="return confirm('Are you sure you want to delete?');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a> -->
													
													<?php 
													if (@$_GET['status'] == 0){
														echo '<i class="fa fa-eye page_publish_button" style="color:#007bff"></i>';
													}
												 }									   
										   
												else if($is_admin==1){?>
												
												
													<a href="<?php echo $edit_page_link_str; ?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<!-- <a href="<?php //echo $delete_page_link_str; ?>" onClick="return confirm('Are you sure you want to delete?');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a> -->
													<?php 
													if (@$_GET['status'] == 0){
														echo '<i class="fa fa-eye page_publish_button" style="color:#007bff"></i>';
													}
													
													
												 }
												elseif($is_uploader==1){ ?>
													<a href="<?php echo $edit_page_link_str; ?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<!-- <a href="<?php //echo $delete_page_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a> -->
													
												<?php }
												
												else{
													if (@$_GET['status'] == 0){
														echo '<i class="fa fa-eye page_publish_button" style="color:#007bff"></i>';
													}


													}
										   ?>
										   	

                                        </form>
										<input type="hidden" id="pageid" value=<?= $page->page_id ?> />
                                    </td>

                                </tr>
                            <?php endforeach; ?>
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



<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> -->

