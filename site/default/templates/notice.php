<?php
echo $this->get_header();

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
						<li><a href="page_not_found.php" class="bread"> Notice</a><i class="icon-angle-right"></i></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container" >
			<div class="row rowClass">
				<div class="col-lg-12">
					<h2>Notices</h2>
				</div>
			</div> 
		</div>
		
		<div class="container category_btn">
			<div class="btn-group btn-group-toggle" data-toggle="buttons">
				<label class="btn btn-secondary active">
				  <input type="radio" class="customRadioButtonNotice" id="ALL" name="searchRadio" value="" autocomplete="off" checked> All
				</label>
				
				<?php foreach ($categorylist as $sn => $category) :?>
					<label class="btn btn-secondary" for="<?= $category->category_name ?>">
						<input class="customRadioButtonNotice " id="<?= $category->category_name ?>" name="searchRadio" value="<?= $category->category_name ?>"  type="radio"><?= $category->category_name ?>
					</label>
				<?php endforeach; ?>
			
			</div>
		</div>
		
		<div class="container" id="main">
				<div class="row">
					<div class="col-lg-12">
					
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div style="margin-bottom:50px">
			<table id="noticeTbl"class="table table-striped table-bordered" cellspacing="0" width="100%">
				
                <thead class="thead-dark">
                  <tr>
                   <th>Updated Date</th>
					<th>Category Name </th>
					<th>PDF Name</th>
					<th>Attachment </th>

                  </tr>
                </thead>
                <tbody>
                  <?php
				  
					
				  
				  
                  foreach ($notices as $sn => $notice) :

                    //$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
                    // $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
                  ?>
                    <tr>
                    
                     <td><?= date("d-m-Y", strtotime($notice->effect_from_date)); ?></td>
                      <td><?= $notice->category_name ?></td>
                      <td><?= $notice->pdf_name ?></td>
					   
					  <td>
					 <?php  $uploadPath = 'notices' . '/' . $notice->attachment;
                            $file_location = $this->route->get_base_url() . "/" . $uploadPath; ?>

                            <u><a class="pdfanchorclass" href="<?= $file_location ?>" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?= $notice->pdf_name ?></a><br>(<?= filesize_formatted($uploadPath)?>)</u>
					  </td>
					   

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
	<script src="assets/datatable/js/ColReorderWithResize.js"></script>
<script>
$(document).ready(function() {
	
	jQuery.extend( jQuery.fn.dataTableExt.oSort, {
  "ddMmYyyy-pre" : function(a) {
   	 a = a.split('/');
     if (a.length < 2) return 0;
     return Date.parse(a[2] + '-' + a[0] + '-' + a[1])
  },
  "ddMmYyyy-asc" : function ( a, b ) {
     return ((a < b) ? -1 : ((a > b) ? 1 : 0));
  },
  "ddMmYyyy-desc": function ( a, b ) {
     return ((a < b) ? 1 : ((a > b) ? -1 : 0));
  }
})    


	
	
   var table =  $('#noticeTbl').DataTable( {
	  
        responsive: true,
		 "order": [[ 0, "desc" ]],
		 "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
		 "columnDefs": [
            {
                "targets": [ 1 ],
                "visible": false
            },
			{ targets: 0, type: "ddMmYyyy"}
			
			
           
        ],
		"columns": [
			{ "width": "12%" },
			null,
			null,
			null,
		  ],
	  "aoColumns": [
		null,
		null,
		{ "bSortable": false },
		{ "bSortable": false },
	] 
    } );
	
	 //Event Listener for custom radio buttons to filter datatable
    $('.customRadioButtonNotice').change(function () {
        table.columns(1).search(this.value).draw();
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