<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER']) || !isset($_SESSION['sess_user'])){
 header("Location: login.php");
}
else
{
?>
<?php 

include('header.php'); ?>
<div class="main-grid">
	<div class="panel panel-widget forms-panel">
		<div class="forms">
			<div class="inline-form widget-shadow">
				<div class="form-title">
					<h4>Upload Exam Venue details:</h4>
				</div>
				<div class="form-body">
					<div data-example-id="simple-form-inline"> 
						<form class="form-horizontal" action="#" method="post" id="export_excel_tier_exam">
							<div class="form-group">	
								<label for="examname" class="col-sm-4 control-label">Exam Name<font style="color:red";>*</font> </label> 
								<div class="col-sm-6">
									<select name="examname" id="examname" required="true" class="form-control">
										<option value="" selected="selected">Select Exam</option>		
									</select>	
								</div> 
							</div>
							<div class="form-group">	
								<label for="selectedtier" class="col-sm-4 control-label">Exam Tier<font style="color:red";>*</font> </label> 
								<div class="col-sm-6">
									<select name="selectedtier" id="selectedtier" required="true" class="form-control">
										<option value="" selected="selected">Select Tier</option>		
									</select>	
								</div> 
							</div>
							<div class="form-group">	
								<label for="examname" class="col-sm-4 control-label">Select(.xlsx) File<font style="color:red";>*</font> </label> 
								<div class="col-sm-6">
									<input type="file" required="true" name="excel_file_attachment"  id="excel_file" />		
								</div> 
							</div>				
						
							<button class="btn w3ls-button hvr-icon-down col-5" id="upload_excel"> Upload</button>
							<!-- Spinner div start-->
							<div id="overlay" style="display:none;">
								<div class="spinner"></div>
								<br/>
								Loading...
							</div>
							<!-- Spinner div End-->
						</form>  
					</div>
				</div>
				<div class="alert alert-success alert-dismissible"  role="alert">
					<strong style="color:green">Uploading Successfully!</strong> Please Check the <a href="log/tier_based_exam_log.log" target="_blank">Log File</a>.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
#overlay {
  background: #ffffff;
  color: #666666;
  position: fixed;
  height: 100%;
  width: 100%;
  z-index: 5000;
  top: 0;
  left: 0;
  float: left;
  text-align: center;
  padding-top: 25%;
  opacity: .80;
}

.spinner {
    margin: 0 auto;
    height: 64px;
    width: 64px;
    animation: rotate 0.8s infinite linear;
    border: 5px solid firebrick;
    border-right-color: transparent;
    border-radius: 50%;
}
@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>

<?php
}
?>
<?php include('footer.php'); ?>
	
<script type="text/javascript" language="javascript" >
 $(document).ready(function(){  

	$('.alert').hide();
	$('#examname').select2();
	$('#examname').select2({
        placeholder: 'Select Exam',
        ajax: {
          url: 'search_exam.php',
          dataType: 'json',
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }
      });
	  
	  $('#selectedtier').select2({
        placeholder: 'Select Tier',
        ajax: {
          url: 'search_tier.php',
          dataType: 'json',
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }
      });


	  $('#export_excel_tier_exam').on('submit', function(event){  
           event.preventDefault();  
		   var examname = $('#examname option:selected').val();
		   var selectedtier = $('#selectedtier option:selected').val();
		   if( examname!='' && selectedtier !=''){
			$('#overlay').fadeIn();
           $.ajax({  
                url:"python_upload_tier_based_exam_details.php",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
           }).done(function (data) {
			console.log(data);
			$('#overlay').fadeOut();
			$('.alert').show();
			});
		}
	else{
		alert("Please fill the reqired ( *) fields !")
	} 
      });  
	  
 });  
 </script>  	

	
	
	
	