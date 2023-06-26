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
						<li><a href="#" class="bread"> Debarred Lists</a><i class="icon-angle-right"></i></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container" >
			<div class="row rowClass">
				<div class="col-lg-12">
					<h2>Debarred Lists</h2>
				</div>
			</div> 
		</div>
		
		
		<br>
		<div class="container" id="main">
				<div class="row">
					<div class="col-lg-12">
					
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div style="margin-bottom:50px">
			<table id="debarredlistsTbl"class="table table-striped table-bordered" cellspacing="0" width="100%">
				
                <thead class="thead-dark">
                  <tr>
                   <th>Updated Date</th>
					<th>Debarred List Name</th>
					<th>Attachment</th>
					

                  </tr>
                </thead>
                <tbody>
                  <?php
				  
				
                  foreach ($dlist_details as $sn => $dlist_detail) :

                    //$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
                    // $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
                  ?>
                    <tr>
                    
                     <td><?= date("d-m-Y", strtotime($dlist_detail->effect_from_date)); ?></td>
                      <td><?= $dlist_detail->pdf_name ?></td>
                      
					  
					
                      
					  <td>
					 <?php  $uploadPath = 'debarredlists' . '/' . $dlist_detail->attachment;
                            $file_location = $this->route->get_base_url() . "/" . $uploadPath; ?>

                            <u><a class="pdfanchorclass" href="<?= $file_location ?>" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?= $dlist_detail->pdf_name ?></a><br>(<?= filesize_formatted($uploadPath)?>)</u>
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


	
	
   var table =  $('#debarredlistsTbl').DataTable( {
	   responsive: true,
		 "order": [[ 0, "desc" ]],
		 "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
      
    } );

	
	
	
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