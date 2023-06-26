<?php
echo $this->get_header();

//echo $path = dirname(__DIR__."/selectionposts",0);
function filesize_formatted($path){
	$size = filesize($path);
	$units = array(
		'B',
		'KB',
		'MB',
		'GB',
		'TB',
		'PB',
		'EB',
		'ZB',
		'YB'
	);
	$power = $size > 0 ? floor(log($size, 1024)) : 0;
	return number_format($size / pow(1024, $power) , 2, '.', ',') . ' ' . $units[$power];
}
?>
<section class="buttons">
		<div class="container">
			<div class="row breadcrumbruler">
				<div class="col-lg-12">
					<ul class="breadcrumb">
						<li><a href="index.php" class="breadcrumb_text_color">Home</a><i class="icon-angle-right"></i></li>
						<li><a href="page_not_found.php" class="bread"> Selection Post</a><i class="icon-angle-right"></i></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container" >
			<div class="row rowClass">
				<div class="col-lg-12">
					<h2>Selection Post </h2>
				</div>
			</div>  
		</div>
		<br>
		
		<div class="container" id="main">
				<div class="row">
					<div class="col-lg-3 col-sm-2">
					</div>
					<div class="col-lg-1 col-sm-2">
						<label>Phase:
						</label>
					</div>
					<div class="col-lg-5 col-sm-2 col-md-3" >
						<select name="phasename" id="phasename" required="true" class="form-control">
							<option value="all" selected="selected">All</option>										
						</select>
					</div>
					<div class="col-lg-2 col-sm-2">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4 col-sm-2">
					</div>
					
					<div class="col-lg-5 col-sm-2 col-md-3" >
						<div class="container category_btn">
							<div class="btn-group btn-group-toggle" data-toggle="buttons">
								<label class="btn btn-secondary active">
								  <input type="radio" class="customRadioButton" id="ALL" name="searchRadio" value="" autocomplete="off" checked> All
								</label>
								
								<?php foreach ($categorylist as $sn => $category) :?>
									<label class="btn btn-secondary" for="<?= $category->category_name ?>">
										<input class="customRadioButton " id="<?= $category->category_name ?>" name="searchRadio" value="<?= $category->category_name ?>"  type="radio"><?= $category->category_name ?>
									</label>
								<?php endforeach; ?>
							
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div style="margin-bottom:50px">
								
							 <table id="selectionpostsTbl" class="table table-bordered table-hover">

								<thead class="thead-dark">
								  <tr>
									<th>S.No</th>
									<th>Advertisement No & Year</th>
									<th>Category Name </th>
									
									<th>Published Date</th>
									<th>Notices / Lists</th>
									<th>Phase Name</th>

								  </tr>
								</thead>
							<tbody>
                                    <?php


                                    foreach ($selectionposts as $sn => $selectionpost) :
                                        // $delete_selection_post_link_str = str_replace("{id}", $selectionpost->selection_post_id, $delete_selection_post_link);
                                        // $edit_selection_post_link_str = str_replace("{id}", $selectionpost->selection_post_id, $edit_selection_post_link);
                                        //$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
                                        // $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
                                    ?>
                                        <tr>
                                            <td><?= ++$sn; ?></td>
                                            <td><?= $selectionpost->exam_name ?></td>
                                            <td><?= $selectionpost->category_name ?></td>
											 <td><?= date("d-m-Y", strtotime($selectionpost->effect_from_date)); ?></td>
                                            <td>
                                                <?php


                                                foreach ($selectpostschildlist as $key => $childlist) :
                                                    $selected = "";
                                                    if ($selectionpost->selection_post_id == $childlist->selection_post_id) {
                                                        $selected = "selected=\"selected\"";
                                                        $uploadPath = 'selectionposts' . '/' . $childlist->attachment;
                                                        $file_location = $this->route->get_base_url() . "/" . $uploadPath; ?>

                                                       <u> <a class="pdfanchorclass" href="<?= $file_location ?>" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?= $childlist->pdf_name ?></a><br>(<?= filesize_formatted($uploadPath)?>)<u><br>
                                                    <?php }


                                                    ?>

                                                <?php endforeach; ?>




                                            </td>
											<td><?= $selectionpost->phase_name ?></td>


                                        </tr>
                                    <?php endforeach; ?>
                                    <?php //} 
                                    ?>
                                </tbody>

                            </table>
						</div>
					</div>
					
				</div>
		</div>
		
		</section>
<?php include "footer2.php";?>
<?php echo $this->get_footer(); ?>
	<script src="assets/datatable/js/modernizr.js"></script>
	<script src="assets/datatable/js/jquery.cookie.js"></script>
	<script src="assets/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/datatable/js/dataTables.responsive.min.js"></script>
	<script src="assets/datatable/js/dataTables.buttons.min.js"></script>
	<script src="assets/datatable/js/buttons.flash.min.js"></script>
	<script src="assets/datatable/js/jszip.min.js"></script>
	<script src="assets/datatable/js/pdfmake.min.js"></script>
	<script src="assets/datatable/js/vfs_fonts.js"></script>
	<script src="assets/datatable/js/buttons.html5.min.js"></script>
	<script src="assets/datatable/js/buttons.print.min.js"></script>
	<script src="assets/datatable/js/buttons.colVis.min.js"></script>
	<script src="assets/datatable/js/dataTables.checkboxes.min.js"></script>
	<script src="assets/datatable/js/ColReorderWithResize.js"></script><script>

$(document).ready(function() {
   var table = $('#selectionpostsTbl').DataTable( {
        responsive: true,
		  "columnDefs" : [{
        "targets": 5,
        "type": 'num',
      },
	   {
                "targets": [ 2 ],
                "visible": false
            },
			 {
                "targets": [ 5 ],
                "visible": false
            },
	  ],
    } );
	 $('#phasename').on('change', function() {
		 
        table.columns(5).search(this.value).draw();
    });
	
	 //Event Listener for custom radio buttons to filter datatable
    $('.customRadioButton').change(function () {
        table.columns(2).search(this.value).draw();
		console.log(this.value);
    });
	
} );



</script>
<style>

.btn-group-toggle .btn:not(:disabled):not(.disabled).active, .btn-group-toggle .btn:not(:disabled):not(.disabled):active, .show>.btn.dropdown-toggle {
      color: #fff;
          background-color: #a52a2a;
    border-color: #efb4b4;
	
}

/* non selected btn css */
.btn-group-toggle .btn {
  color: black;
  background-color: #b7b7b7;
  border-color: #6c757d;
 
}

.btn-group, .btn-group-vertical {
    position: relative;
    display: inline-block;
    vertical-align: middle;
	text-align:center;
}
.category_btn{
	padding:12px ;
}
</style>