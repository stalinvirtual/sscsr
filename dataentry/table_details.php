<!-- session -->
<?php
require_once("config/db.php");
session_start();
if(!isset($_SERVER['HTTP_REFERER']) || !isset($_SESSION['sess_user'])){
 header("Location: login.php");
}
else
{
?>
<!-- header -->
<?php include('header.php'); ?>
<div class="main-grid">

	<div class="panel panel-widget forms-panel">
		<div class="forms">
			<div class="inline-form widget-shadow">
				<div class="form-title">
					<div class="row">
						<div class="col-md-12 form-group">
							<h4>SSCSR Table Details</h4>
						</div>
					</div>
				</div>
				
				<div class="form-body">
					<div id="examdata">	
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php
}
?>
<?php include('footer.php'); ?>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.js"></script> -->
<!-- <link href="https://www.eyecon.ro/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
<script src="https://www.eyecon.ro/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> -->






<script type="text/javascript"> 
	

$( document ).ready(function() {




// load exam	
$.ajax({
	url:"load_table_details.php",
	method:"GET",
	success:function(data)
	{
	$('#examdata').html(data);
	}
});

});
 </script> 		