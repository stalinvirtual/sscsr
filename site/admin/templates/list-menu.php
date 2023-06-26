<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
				<?php 
				if($is_superadmin==1 ){
					echo '<div class="card-header">
						<h3 class="card-title"><a href="'. $create_menu_link . '" class="btn btn-primary pull-right" style="margin-top:-30px"><span class="glyphicon glyphicon-plus-sign"></span> Add Menu</a></h3>
					</div>';
				}
				?>
                
                <!-- /.card-header -->
				
                <div class="card-body">
                    <table id="menuTbl" class="table table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Menu Name</th>
                                <th>Menu Parent </th>
                                <th>Menus Link </th>
                                <th>Menu Type </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $menu_type_array = [1 => "Page", "External", "Pdf",'Dropdown'];
                            foreach ($menus as $sn => $menu) :
                                $delete_menu_link_str = str_replace("{id}", $menu->id, $delete_menu_link);
                                $edit_menu_link_str = str_replace("{id}", $menu->id, $edit_menu_link);
                                //$preview_url  = ($menu->menu_type == 3) ? $menu->menu_link : $this->route->site_url($menu->menu_link);
                                $view_menu_link_str = str_replace("{id}", $menu->id, $view_menu_link);
                            ?>
                                <tr>
                                    <td><?= ++$sn; ?></td>
                                    <td><?= $menu->menu_name ?></td>
                                    <td><?php 
									
										if (@$menu->parent_name == null){
											echo 'Parent Menu';
										
										}else{
											echo @$menu->parent_name ;
										}	
										?></td>

                                    <?php
									
										if ($menu->menu_link == '#'){
											echo '<td>----- No Links -----</td>';
										
										}	
									 
										else if ($menu->menu_link == null) {
                                        $singleFile = $menu->attachment;
                                        $uploadPath = 'uploads' . '/' . $singleFile;
                                        $file_location = $this->route->get_base_url() . "/"  . $uploadPath; ?>
                                        <td><a href="<?= $file_location ?>" target="_blank"><?= $menu->attachment ?></a></td>
                                    <?php  } else { ?>
                                        <td><?= implode(PHP_EOL, str_split($menu->menu_link, 50)); ?></td>

                                    <?php }

                                    ?>

                                    <td><?= $menu_type_array[$menu->menu_type] ?></td>


                                    <td>
									
									
									
                                        <form method="post">
                                           <?php
										   
										   $myArr = ['Nomination', 'Selection Post', 'Tender', 'Notice of Recruitment','Debarred List'];
										   
												if($is_superadmin==1){
													?>
														<a href="<?php echo $edit_menu_link_str; ?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													
													<a href="<?php echo $delete_menu_link_str; ?>" onClick="return confirm('Are you sure you want to delete? This operation will delete the children menu if any? and this cannot be undo');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a>
													<?php 
													if (@$_GET['status'] == 0){
														echo '<i class="fa fa-eye publish-button" style="color:#007bff"></i>';
													}
													
												}
										   
												else if($is_admin==1){
													
													
												
													if(in_array($menu->menu_name, $myArr) ){
													?>	
														
													<?php }else{ 

														if($menu->id=="1"){

														}
														else{?>

															<a href="<?php echo $edit_menu_link_str; ?>" name="menu_update" class="iconSize">
															<i class="fa fa-edit"></i>
														</a>
														<?php }
														
														
														?>
														
													
													
													<?php } ?>
												
													
													
												
													<?php 
													if (@$_GET['status'] == 0){
														echo '<i class="fa fa-eye publish-button" style="color:#007bff"></i>';
													}
													
													
												 }
												elseif($is_uploader==1){
													
													
												
													if(in_array($menu->menu_name, $myArr) ){
													?>	
														
													<?php }else{ ?>
														
														<a href="<?php echo $edit_menu_link_str; ?>" name="menu_update" class="iconSize">
															<i class="fa fa-edit"></i>
														</a>
													
													<?php } ?>
												
													
													
												
													<?php 
													/* if (@$_GET['status'] == 0){
														echo '<i class="fa fa-eye publish-button" style="color:#007bff"></i>';
													} */
													
													
												 }
												
												else{
													
													//for publisher
													if (@$_GET['status'] == 0){
														echo '<i class="fa fa-eye publish-button" style="color:#007bff"></i>';
													}


													}
										   ?>
										   <input class="form-control" type="hidden" name="id" id="menuid" value="<?php echo $menu->id; ?>">
                                        </form>
										
										
										
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
<style>
.fa-angle-down{
	display:none !important;
}

</style>

