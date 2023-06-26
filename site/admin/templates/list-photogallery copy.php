<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><a href="<?php echo $create_gallery_link; ?>" class="btn btn-primary pull-right" style="margin-top:-30px"><span class="glyphicon glyphicon-plus-sign"></span> Add Photo Gallery </a></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Event Name</th>
                                <th>Event Year </th>
                                <th>Image Name</th>
                               <!-- <th>Status</th>-->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							
							
							
							
							
							
							
							
							

                            $nomination_type_array = [1 => "Multitasking", "Normal"];
                            foreach ($gallerymodelgetlists as $sn => $gallerymodelgetlist) :
                                $delete_gallery_link_str = str_replace("{id}", $gallerymodelgetlist->gallery_id, $delete_gallery_link);
                                $edit_gallery_link_str = str_replace("{id}", $gallerymodelgetlist->gallery_id, $edit_gallery_link);
                                //$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
                                // $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
                            ?>
                                <tr>
                                    <td><?= ++$sn; ?></td>
                                    <td><?= $gallerymodelgetlist->event_name ?></td>
                                    <td><?= $gallerymodelgetlist->year ?></td>
									
									<td>
                                        <?php


                                        foreach ($gallerymodelchildlist as $key => $childlist) :
                                            $selected = "";
                                            if ($gallerymodelgetlist->gallery_id == $childlist->gallery_id) {
                                                $selected = "selected=\"selected\"";
                                                $uploadPath = 'gallery' . '/' . $childlist->image_path;
                                                $file_location = $this->route->get_base_url() . "/" . $uploadPath; ?>

                                                <a href="<?= $file_location ?>" target="_blank"><?= $childlist->image_path ?></a>,<br>
                                            <?php }


                                            ?>

                                        <?php endforeach; ?>




                                    </td>
                                  
                                    
									 <td><?php if($gallerymodelgetlist->p_status =='1')
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
													
													
													<a href="<?php echo $edit_gallery_link_str; ?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_gallery_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a>
													<?php 
													if (@$_GET['status'] == 0 && $gallerymodelgetlist->p_status != '1' ){







													//	echo '<i class="fa fa-eye nomination-publish-button" style="color:#007bff"></i>';
													}
													
												}
										   
												else if($is_admin==1){?>
												
												
													<a href="<?php echo $edit_gallery_link_str; ?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_gallery_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a>
													<?php 
													if (@$_GET['status'] == 0 && $gallerymodelgetlist->p_status != 1){?>
                                                        <i class="fa fa-eye gallery-publish-button" 
                                                        style="color:#007bff" id="<?=  $gallerymodelgetlist->gallery_id ?> " onclick="publishButton(
                                                            'gallery-publish-button',
                                                            'gallery_id',
                                                            '<?php echo $this->route->site_url('Admin/ajaxresponseforPublish'); ?>',
                                                            '<?php echo      $this->route->site_url('Admin/dashboard/?action=listofphotogallery&&status=0'); ?>',
                                                            'Gallery',
                                                                              this.id
                                                        
                                                        
                                                        )"></i>
                                                    <?php }
													
													
												 }
												elseif($is_uploader==1 ){ ?>
													<a href="<?php echo $edit_gallery_link_str; ?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_gallery_link_str; ?>" onClick="return confirm('Are you sure you want to delete?');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a>
													
												<?php }
												
												else{
													if (@$_GET['status'] == 0 && $gallerymodelgetlist->p_status != '1'){
														//echo '<i class="fa fa-eye nomination-publish-button" style="color:#007bff"></i>';
													}


													}
										   ?>
										   <input type="hidden" value="<?= $gallerymodelgetlist->gallery_id ?>" name="gallery_id" id="gallery_id">
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