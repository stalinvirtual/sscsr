<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">





				<div class="card-header">
					<h3 class="card-title"><a href="<?php echo $list_of_notices; ?>" class="btn btn-primary pull-right" style="margin-top:-30px"><span class="glyphicon glyphicon-plus-sign"></span> Main Page </a></h3>


				</div>











				<!-- /.card-header -->
				<div class="card-body">
					<table id="example2" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Sr.No</th>

								<th>Notice Name </th>
								<th>Pdf File</th>
								<th>Status</th>
								<th> Action </th>
							</tr>
						</thead>
						<tbody>
							<?php


							foreach (@$noticecreationlistsarchives as $sn => $noticelist) :
								// $delete_notice_link_str = str_replace("{id}", $noticelist->notice_id, $delete_notice_link);
								// $edit_notice_link_str = str_replace("{id}", $noticelist->notice_id, $edit_notice_link);
								//$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
								// $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
							?>
								<tr>
									<td><?= ++$sn; ?></td>
									<td><?= $noticelist->pdf_name ?></td>
									<td><?php
										$uploadPath = 'notices' . '/' . $noticelist->attachment;
										$file_location = $this->route->get_base_url() . "/" . $uploadPath;
										?>
										<a href="<?= $file_location ?>" target="_blank"><?= $noticelist->attachment ?></a><br>
									</td>
									<td><?php if ($noticelist->p_status == 1) {
											echo '<i class="fa fa-flag" aria-hidden="true"  style="color:green"></i>';
										} else {
											echo '<i class="fa fa-flag" aria-hidden="true" style="color:red"></i>';
										}   ?>
									</td>


									<td>
										<!--  Form Start  --->

										<form method="post">
											<?php

											if ($is_superadmin == 1) { ?>


												<!-- <a href="<?php echo $edit_notice_link_str; ?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_notice_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a> -->
												<?php
												if (@$_GET['status'] == 0 && $noticelist->p_status != 1) { ?>
													<i class="fa fa-eye notices_archives_publish_button" style="color:#007bff" id="<?= $noticelist->notice_id ?> " onclick="publishButton(
		'notices_archives_publish_button',
		'$noticelist->notice_id',
		'<?php echo $this->route->site_url('Admin/ajaxresponseforPublish'); ?>',
		'<?php echo $this->route->site_url('Admin/dashboard/?action=listnoticesarchieves'); ?>',
		'NoticeArchives',   // Model Name
        this.id
	
	
	)"></i>
												<?php 	}
											} else if ($is_admin == 1) { ?>


												<!-- <a href="<?php echo $edit_notice_link_str; ?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_notice_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a> -->
												<?php
												if (@$_GET['status'] == 0 && $noticelist->p_status != 1) { ?>
													<i class="fa fa-eye notices_archives_publish_button" style="color:#007bff" id="<?= $noticelist->notice_id ?> " onclick="publishButton(
		'notices_archives_publish_button',
		'$noticelist->notice_id',
		'<?php echo $this->route->site_url('Admin/ajaxresponseforPublish'); ?>',
		'<?php echo $this->route->site_url('Admin/dashboard/?action=listnoticesarchieves'); ?>',
		'NoticeArchives',   // Model Name
        this.id
	
	
	)"></i>
												<?php 	}
											} elseif ($is_uploader == 1) { ?>
												<!-- <a href="<?php echo $edit_notice_link_str; ?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_notice_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a> -->

												<?php } else {
												if (@$_GET['status'] == 0 && $noticelist->p_status != 1) { ?>
													<i class="fa fa-eye notices_archives_publish_button" style="color:#007bff" id="<?= $noticelist->notice_id ?> " onclick="publishButton(
		'notices_archives_publish_button',
		'$noticelist->notice_id',
		'<?php echo $this->route->site_url('Admin/ajaxresponseforPublish'); ?>',
		'<?php echo $this->route->site_url('Admin/dashboard/?action=listnoticesarchieves'); ?>',
		'NoticeArchives',   // Model Name
        this.id
	
	
	)"></i>
											<?php 	}
											}
											?>
											<input type="hidden" value="<?= $noticelist->notice_id ?>" name="id" id="notice_id">
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