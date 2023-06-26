<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<form method="post" id="frm-example" action="<?php echo $tender_boy; ?>">

					<div class="card-header">
						<h3 class="card-title"><a href="<?php echo $create_tender_link; ?>" class="btn btn-primary pull-right" style="margin-top:-30px"><span class="glyphicon glyphicon-plus-sign"></span> Add Tender </a></h3>
						<!-- <h3 class="card-title" style="margin-right: 10px;">
					<a href="<?php //echo $list_tender_archives_link; 
								?>" class="btn btn-primary pull-right" style="margin-top:-30px;padd"><span class="glyphicon glyphicon-plus-sign"></span> Archives </a></h3> -->
						<h3 class="card-title" style="margin-right: 10px;">
							<button class="btn btn-primary pull-right" style="margin-top:-30px;"><span class="glyphicon glyphicon-plus-sign"></span> Archives </button>
						</h3>


					</div>






					<!-- /.card-header -->
					<div class="card-body">

					<!-- <div class="form-group row">

<label for="inputEmail3" class="col-sm-2 col-form-label">Year : <span style='color:red'>*</span></label>

<div class="col-sm-10">

	<select name="tender_year" class="form-control" id="tender_year">
		<?php for ($i = 0; $i <= 5; $i++) {
			$year = date('Y', strtotime("last day of +$i year"));
			echo "<option name='$year'>$year</option>";
		} ?>
	</select>

</div>
</div>

<div class="form-group row">

<label for="inputEmail3" class="col-sm-2 col-form-label">Month : <span style='color:red'>*</span></label>

<div class="col-sm-10">

	<select name="tender_month" class="form-control" id="tender_month">
		<option value="All">All</option>
		<?php
		// for ($i = 1; $i <= 12; $i++) {
		// 	$month = date('F', strtotime("$i/12/10"));

		// 	if (strlen($i) == 1) {
		// 		$value = "0" . $i;
		// 	} else {

		// 		$value = $i;
		// 	}

		// 	echo "<option value=$value>$month</option> ";
		// } ?>
	</select>

</div>
</div>

		-->

<div class="form-group row">

<label for="inputEmail3" class="col-sm-2 col-form-label">From Date : <span style='color:red'>*</span></label>

<div class="col-sm-10">

<input type="text" id="min" name="min">	
</div>
</div>

<div class="form-group row">

<label for="inputEmail3" class="col-sm-2 col-form-label">End Date : <span style='color:red'>*</span></label>

<div class="col-sm-10">

<input type="text" id="max" name="max">
</div>
</div>


<div class="form-group row">

<label for="inputEmail3" class="col-sm-2 col-form-label"> <span style='color:red'>*</span></label>

<div class="col-sm-10">

<button id ="resetFilter"> Reset</button>
</div>
</div>


					

					


						<table id="list_tender" class="table table-bordered table-hover">


							<thead>
								<tr>
									<th><input name="select_all" value="1" type="checkbox"></th>

									<th>Tender Name </th>
									<th>Pdf File</th>
									<th>From Date</th>
									<th>To Date </th>
									<th>Status</th>
									<th> Action </th>
								</tr>
							</thead>
							<tbody>

								<?php




								if (@$creation_lists_new > 0) {

									//}





									foreach (@$creation_lists_new as $sn => $tendercreationlist) :
										$delete_tender_link_str = str_replace("{id}", $tendercreationlist->tender_id, $delete_tender_link);
										$edit_tender_link_str = str_replace("{id}", $tendercreationlist->tender_id, $edit_tender_link);


										$archive_tender_link_str = str_replace("{id}", $tendercreationlist->tender_id, $archive_tender_link);
										$copy_tender_link_str = str_replace("{id}", $tendercreationlist->tender_id, $copy_tender_link);




										//$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
										// $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
								?>
										<tr>
											<td><?= $tendercreationlist->tender_id ?>
											</td>
											<td><?= $tendercreationlist->pdf_name ?></td>
											<td><?php
												$uploadPath = 'tender' . '/' . $tendercreationlist->attachment;
												$file_location = $this->route->get_base_url() . "/" . $uploadPath;
												?>
												<a href="<?= $file_location ?>" target="_blank"><?= $tendercreationlist->attachment ?></a><br>
											</td>
											</td>
											<td><?= $tendercreationlist->effect_from_date ?></td>
											<td><?= $tendercreationlist->effect_to_date ?></td>
											<td><?php if ($tendercreationlist->p_status == 1) {
													echo '<i class="fa fa-flag" aria-hidden="true"  style="color:green"></i>';
												} else {
													echo '<i class="fa fa-flag" aria-hidden="true" style="color:red"></i>';
												}   ?>
											</td>


											<td>
												<!--  Form Start  --->



												<?php

												if ($is_superadmin == 1) { ?>


													<a href="<?php echo $edit_tender_link_str; ?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_tender_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a>



													<?php
													if (@$_GET['status'] == 0 && $tendercreationlist->p_status != 1) {
														echo '<i class="fa fa-eye tender-publish-button" style="color:#007bff"></i>';
													}
												} else if ($is_admin == 1) { ?>


													<a href="<?php echo $edit_tender_link_str; ?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_tender_link_str; ?>" onClick="return confirm('Are you sure you want to delete?');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a>

													<!-- Archive Icon-->

													<a href="<?php echo $archive_tender_link_str; ?>" onClick="return confirm('Are you sure you want to archive?');" class="iconSize" name="delete">
														<i class="fa fa-archive"></i>
													</a>

													<a href="<?php echo $copy_tender_link_str; ?>" class="iconSize" name="delete">
														<i class="fa fa-copy"></i>
													</a>


													<!-- Archive Icon-->






													<?php
													if (@$_GET['status'] == 0 && $tendercreationlist->p_status != 1) {
														echo '<i class="fa fa-eye tender-publish-button" style="color:#007bff"></i>';
													}
												} elseif ($is_uploader == 1) { ?>
													<a href="<?php echo $edit_tender_link_str; ?>" name="menu_update" class="iconSize">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo $delete_tender_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
														<i class="fa fa-trash"></i>
													</a>

												<?php } else {
													if (@$_GET['status'] == 0 && $tendercreationlist->p_status != 1) {
														echo '<i class="fa fa-eye tender-publish-button" style="color:#007bff"></i>';
													}
												}
												?>
												<input type="hidden" value="<?= $tendercreationlist->tender_id ?>" name="id" id="tender_id">
				</form>
				<!--  Form Start  --->
				</td>

				</tr>
			<?php endforeach; ?>
		<?php }
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
<style>
	.table-header
{
  margin-bottom: 35px;
 
}

.ui-widget-header {
    color: #333 !important;
}

</style>



	





