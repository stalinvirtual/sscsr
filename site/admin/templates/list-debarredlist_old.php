<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">

				<?php

				if ($is_publisher == 1) {
				} else { ?>

					<div class="card-header">
						<h3 class="card-title"><a href="<?php echo $create_debarred_lists_link; ?>" class="btn btn-primary pull-right" style="margin-top:-30px"><span class="glyphicon glyphicon-plus-sign"></span> Add Debarred List </a></h3>
					</div>

				<?php }

				?>









				<!-- /.card-header -->
				<div class="card-body">
					<table id="example2" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Sr.No</th>

								<th>Debarred Name </th>
								<th>Pdf File</th>
								<th>Status</th>
								<th> Action </th>
							</tr>
						</thead>
						<tbody>
							<?php


							foreach (@$debarredgetlists as $sn => $debarredgetlist) :
								$delete_dl_link_str = str_replace("{id}", $debarredgetlist->debarred_lists_id, $delete_debarred_lists_link);
								$edit_dl_link_str = str_replace("{id}", $debarredgetlist->debarred_lists_id, $edit_debarred_lists_link);
								//$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
								// $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);

                                // $delete_event_category_link_str = str_replace("{id}", $eventcategorygetlist->event_id, $delete_event_category_link);
                                // $edit_event_category_link_str = str_replace("{id}", $eventcategorygetlist->event_id, $edit_event_category_link);








							?>
								<tr>
									<td><?= ++$sn; ?></td>
									<td><?= $debarredgetlist->pdf_name ?></td>
									<td><?php
										$uploadPath = 'debarredlists' . '/' . $debarredgetlist->attachment;
										$file_location = $this->route->get_base_url() . "/" . $uploadPath;
										?>
										<a href="<?= $file_location ?>" target="_blank"><?= $debarredgetlist->attachment ?></a><br>
									</td>
									<td><?php if ($debarredgetlist->p_status == 1) {
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


												<a href="<?php echo $edit_dl_link_str; ?>" name="menu_update" class="iconSize">
													<i class="fa fa-edit"></i>
												</a>
												<a href="#" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
													<i class="fa fa-trash"></i>
												</a>
												<?php
												if (@$_GET['status'] == 0 && $debarredgetlist->p_status != 1) {
													echo '<i class="fa fa-eye debarred-publish-button" style="color:#007bff"></i>';
												}
											} else if ($is_admin == 1) { ?>


												<a href="<?php echo $edit_dl_link_str; ?>" name="menu_update" class="iconSize">
													<i class="fa fa-edit"></i>
												</a>
												<a href="<?php echo $delete_dl_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
													<i class="fa fa-trash"></i>
												</a>
												<?php
												if (@$_GET['status'] == 0 && $debarredgetlist->p_status != 1) {
													echo '<i class="fa fa-eye debarred-publish-button" style="color:#007bff"></i>';
												}
											} elseif ($is_uploader == 1) { ?>
												<a href="<?php echo $edit_dl_link_str; ?>" name="menu_update" class="iconSize">
													<i class="fa fa-edit"></i>
												</a>
												<a href="<?php echo $delete_dl_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
													<i class="fa fa-trash"></i>
												</a>

											<?php } else {
												if (@$_GET['status'] == 0 && $debarredgetlist->p_status != 1) {
													echo '<i class="fa fa-eye debarred-publish-button" style="color:#007bff"></i>';
												}
											}
											?>
											<input type="hidden" value="<?= $debarredgetlist->debarred_lists_id ?>" name="id" id="debarred_lists_id">
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