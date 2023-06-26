<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
              

				<div class="card-header">
			<h3 class="card-title"><a href="<?php echo $list_of_tenders; ?>" class="btn btn-primary pull-right" style="margin-top:-30px"><span class="glyphicon glyphicon-plus-sign"></span> Main Page </a></h3>
			

		</div>






                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                
                                <th>Tender Name </th>
                                <th>Pdf File</th>
                                <th>Status</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

							
                            foreach (@$creation_lists_archives as $sn => $tendercreationlist) :
                               // $delete_tender_link_str = str_replace("{id}", $tendercreationlist->tender_id, $delete_tender_link);
                               // $edit_tender_link_str = str_replace("{id}", $tendercreationlist->tender_id, $edit_tender_link);
                                //$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
                                // $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
                            ?>
                                <tr>
                                    <td><?= ++$sn; ?></td>
                                    <td><?= $tendercreationlist->pdf_name ?></td>
									<td><?php
									$uploadPath = 'tender' . '/' . $tendercreationlist->attachment;
									$file_location = $this->route->get_base_url() . "/" . $uploadPath; 
									?>
									<a href="<?= $file_location ?>" target="_blank"><?= $tendercreationlist->attachment ?></a><br>
									</td>
									</td>
										<td><?php if($tendercreationlist->p_status ==1)
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
													
													
													<!-- <a href="<?php echo $edit_tender_link_str;?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_tender_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a> -->
													<?php
if (@$_GET['status'] == 0 && $tendercreationlist->p_status != 1){?>
	<i class="fa fa-eye tender-archives-publish-button" 
	style="color:#007bff" id="<?=  $tendercreationlist->tender_id ?> " onclick="publishButton(
		'tender-archives-publish-button',
		'tender_id',
		'<?php echo $this->route->site_url('Admin/ajaxresponseforPublish'); ?>',
		'<?php echo      $this->route->site_url('Admin/dashboard/?action=listtenderarchieves'); ?>',
		'TenderArchives',   // Model Name
                          this.id
	
	
	)"></i>
<?php }
													
												}
										   
												else if($is_admin==1){?>
												
												
													<!-- <a href="<?php echo $edit_tender_link_str;?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_tender_link_str; ?>" onClick="return confirm('Are you sure you want to delete?');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a> -->
													<?php
if (@$_GET['status'] == 0 && $tendercreationlist->p_status != 1){?>
	<i class="fa fa-eye tender-archives-publish-button" 
	style="color:#007bff" id="<?=  $tendercreationlist->tender_id ?> " onclick="publishButton(
		'tender-archives-publish-button',
		'tender_id',
		'<?php echo $this->route->site_url('Admin/ajaxresponseforPublish'); ?>',
		'<?php echo      $this->route->site_url('Admin/dashboard/?action=listtenderarchieves'); ?>',
		'TenderArchives',   // Model Name
                          this.id
	
	
	)"></i>
<?php }
													
													
												 }
												elseif($is_uploader==1 ){ ?>
													<!-- <a href="<?php echo $edit_tender_link_str;?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_tender_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a> -->
													
												<?php }
												
												else{
													
if (@$_GET['status'] == 0 && $tendercreationlist->p_status != 1){?>
	<i class="fa fa-eye tender-archives-publish-button" 
	style="color:#007bff" id="<?=  $tendercreationlist->tender_id ?> " onclick="publishButton(
		'tender-archives-publish-button',
		'tender_id',
		'<?php echo $this->route->site_url('Admin/ajaxresponseforPublish'); ?>',
		'<?php echo      $this->route->site_url('Admin/dashboard/?action=listtenderarchieves'); ?>',
		'TenderArchives',   // Model Name
                          this.id
	
	
	)"></i>
<?php }


													}
										   ?>
										   <input type="hidden" value="<?= $tendercreationlist->tender_id ?>" name="id" id="tender_id">
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