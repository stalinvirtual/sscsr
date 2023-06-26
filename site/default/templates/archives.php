<?php
echo $this->get_header(); ?>
<br>
<div class="container">
			<div class="row rowClass">
				<div class="col-lg-12">
					<h2>Archives  </h2>
				</div>
			</div> 
		</div>
		<br>
<div class="container">
	<div class="row">

		<div class=" col-lg-12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#one" data-toggle="tab"><i class="icon-briefcase"></i><b>Nomination </b></a></li>
				<li class=""><a href="#two" data-toggle="tab"><i class="icon-briefcase"></i><b>Selection Post &nbsp;</b></a></li>
				<li class=""><a href="#three" data-toggle="tab"><i class="icon-briefcase"></i><b>Notice &nbsp;</b></a></li>
				 <li class=""><a href="#four" data-toggle="tab"><i class="icon-briefcase"></i><b>Tender &nbsp;</b></a></li> 

			</ul>
		</div>
		<div class=" col-lg-12">	
			<div class="tab-content">
				<div class="tab-pane active" id="one">
					<?php include "nomination_archives.php" ?>
				</div>
				<div class="tab-pane" id="two">
					<?php include "selection_post_archives.php" ?>
				</div>
				<div class="tab-pane" id="three">
					<?php include "notices_archives.php" ?>
				</div>

				<div class="tab-pane" id="four">
					<?php include "tender_archives.php" ?>
				</div>
				
				
			</div>
		</div>
	</div>
</div>


<?php include "footer2.php";?>


<?php echo $this->get_footer(); ?>

<style>
	.tab-content>.tab-pane {
		border: none !important;
	}
</style>










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

		jQuery.extend(jQuery.fn.dataTableExt.oSort, {
			"ddMmYyyy-pre": function(a) {
				a = a.split('/');
				if (a.length < 2) return 0;
				return Date.parse(a[2] + '-' + a[0] + '-' + a[1])
			},
			"ddMmYyyy-asc": function(a, b) {
				return ((a < b) ? -1 : ((a > b) ? 1 : 0));
			},
			"ddMmYyyy-desc": function(a, b) {
				return ((a < b) ? 1 : ((a > b) ? -1 : 0));
			}
		})




		var table = $('#nominationTbl').DataTable({

			responsive: true,
			"order": [
				[0, "desc"]
			],
			"lengthMenu": [
				[5, 10, 25, 50, -1],
				[5, 10, 25, 50, "All"]
			],
			"columnDefs": [{
					"targets": [2],
					"visible": false
				},
				{
					targets: 0,
					type: "ddMmYyyy"
				}



			],
			"columns": [{
					"width": "12%"
				},
				null,
				null,
				null,

			],
			"aoColumns": [

				null,
				null,
				{
					"bSortable": false
				},
				{
					"bSortable": false
				},
			]
		});

		//Event Listener for custom radio buttons to filter datatable
		$('.customRadioButton').change(function() {
			table.columns(2).search(this.value).draw();
		});



















	});




	$(document).ready(function() {
		var table = $('#selectionpostsTbl').DataTable({
			responsive: true,
			"columnDefs": [{
					"targets": 5,
					"type": 'num',
				},
				{
					"targets": [2],
					"visible": false
				},
				{
					"targets": [5],
					"visible": false
				},
			],
		});
		$('#phasename').on('change', function() {

			table.columns(5).search(this.value).draw();
		});

		//Event Listener for custom radio buttons to filter datatable
		$('.customRadioButton').change(function() {
			table.columns(2).search(this.value).draw();
			console.log(this.value);
		});

	});




</script>
<style>
	.btn-group-toggle .btn:not(:disabled):not(.disabled).active,
	.btn-group-toggle .btn:not(:disabled):not(.disabled):active,
	.show>.btn.dropdown-toggle {
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

	.btn-group,
	.btn-group-vertical {
		position: relative;
		display: inline-block;
		vertical-align: middle;
		text-align: center;
	}

	.category_btn {
		padding: 12px;
	}
</style>