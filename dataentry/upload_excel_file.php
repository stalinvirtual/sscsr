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
					<h4>Upload Excel Files:</h4>
				</div>
				<div class="form-body">
					<div data-example-id="simple-form-inline"> 
						<form class="form-horizontal" action="#" method="post" id="upload_exam_details" >
							<div class="form-group">        
									<label for="examname" class="col-sm-2 control-label">Exam Name<font style="color:red";>*</font> </label> 
									<div class="col-sm-6">
											<select name="examname" id="examname" required="true" class="form-control">
											</select>        
									</div> 
							</div>
							<div class="form-group">        
								<label for="exam_year" class="col-sm-2 control-label">Select Year<font style="color:red";>*</font> </label> 
								<div class="col-sm-6">
									<input type="text" min="<?php echo date('Y')-5 ;?>" max="<?php echo date('Y')+5 ;?>" step="1"  name="exam_year" id="exam_year" maxlength="4"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"  class="form-control" value="<?php echo date('Y');?>" />															  
								</div> 
								<div id="year_exists" class=" col-sm-4" >	
								</div>
							</div>  
						
							<div class="form-group selectedTableFormat">        
								<label for="selectedTableFormat" class="col-sm-2 control-label">Table For<font style="color:red";>*</font> </label> 
								<div class="col-sm-6">
									<select name="selectedTableFormat" id="selectedTableFormat" required="true" class="form-control">
										<option value="" ></option>		
										<option value="is_kyas" >Application Status</option>		
										<option value="is_tier" >Written Exam</option>		
										<option value="is_skill" >Skill Test</option>		
										<option value="is_dme" >Detailed Medical Examination</option>	
										<option value="is_pet" >Physical Standard Test and Physical Endurance Test</option>		
										<option value="is_dv" >Document Verification</option>		
									</select> 
								</div> 
								<div id="table_exits" class=" col-sm-4" >	
								</div>	
							</div>
							<div class="form-group kyas_status">	
							</div>
						
							<div class="form-group selectedtier">	
								<label for="selectedtier" class="col-sm-2 control-label">Exam Tier<font style="color:red";>*</font> </label> 
								<div class="col-sm-6">
									<select name="selectedtier" id="selectedtier" required="true" class="form-control">
										<option value="0" selected="selected">Select Tier</option>		
									</select>	
								</div> 
							</div>

							<div class="form-group selectedtier">	
								<label for="selectedtier" class="col-sm-2 control-label">No of days prior to download<font style="color:red";>*</font> </label> 
								<div class="col-sm-6">
								<input type="text"   name="no_of_days" id="no_of_days"    type = "number"  class="form-control" value="" />	
								</div> 
							</div>



							<div class="form-group tier1_status">	
							</div>
							<div class="form-group excel_file_attachment">	
								<label for="excelfile" class="col-sm-2 control-label">Select(.xlsx) File<font style="color:red";>*</font> </label> 
								<div class="col-sm-6 excelfile">
									<input type="file" required="true" name="excel_file_attachment"  id="excel_file" accept=".xls, .xlsx" />		
								</div> 
								<div id="excel_file_exists" class=" col-sm-4" style="margin-top:10px">
								</div>	
							</div>	
															
						
							<button class="btn w3ls-button hvr-icon-down col-5" id="upload_excel"> Upload</button>
							<!-- Spinner div start-->
							<div id="overlay" style="display:none;">
								<h1>Data Uploading...</h1>
								<br>
								<div class="progress-3"></div>
								<br>
								<h3>Please wait</h3>
							</div>

							<!-- Spinner div End-->
						</form>  
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<style>

.col-sm-4.status_card {
    background-color: #00acc1;
    text-align: center;
    padding: 10px;
    color: white;
    font-weight: 600;
	font-size: small;
}
.col-sm-6.status_card {
    background-color: #00acc1;
    text-align: center;
    padding: 10px;
    color: white;
    font-weight: 600;
	font-size: small;
}
.col-sm-6.kyas_status_form {
    padding-right: 0px;
}

[class*=classic]:before {
  content:"Loading...";
}
.progress-3 {
  width:100%;
  height:20px;
  border-radius: 20px;
  background:
   repeating-linear-gradient(135deg,#f03355 0 10px,#ffa516 0 20px) 0/0%   no-repeat,
   repeating-linear-gradient(135deg,#ddd    0 10px,#eee    0 20px) 0/100%;
  animation:p3 2s infinite;
}
@keyframes p3 {
    100% {background-size:100%}
}


#overlay {
  background: #000000;
  color: #FFFFFF;
  position: fixed;
  height: 100%;
  width: 100%;
  z-index: 5000;
  top: 0;
  left: 0;
  float: left;
  text-align: center;
  padding-top: 20%;
  padding-left: 10%;
  padding-right: 10%;
  opacity: .80;
}

.spinner {
    margin: 0 auto;
    height: 64px;
    width: 64px;
    animation: rotate 1s infinite linear;
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
.errormsg{
	  background: antiquewhite;
}
.successmsg{
	  background: #d7faeb;
}
i.fa.fa-exclamation-triangle {
    width: inherit;
}
.select2-container.select2-container-disabled .select2-choice {
  background-color: #ddd;
  border-color: #a8a8a8;
}
.col-sm-6.excelfile {
    padding: 10px;
}
input[type="file"] {
    display: block;
    padding: inherit;
    width: -webkit-fill-available;
	    background: antiquewhite;
}
p.count {
    background-color: #adadad;
    border-radius: 20px;
    font-size: unset;
}
</style>

<?php
}
?>
<?php include('footer.php'); ?>
	
<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
 const d = new Date();

d.getMonth() + 1;	// Month	[mm]	(1 - 12)
d.getDate();	

var current_yearbelow5 = d.getFullYear() - 5;	// Day		[dd]	(1 - 31)
var current_yearabove5 = d.getFullYear() + 5;	// Day		[dd]	(1 - 31)

	$('.alert').hide();
	$('.kyas_status').hide();
	$('.tier1_status').hide();
	$('.selectedtier').hide();
	$('.selectedTableFormat').hide();
	$('.excel_file_attachment').hide();
	$('#examname').select2();
	$('#examname').select2({
        placeholder: 'Please select exam',
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
	  

	
	
	
	$('#examname').on('change', function() {
		$('#table_exits').html("");
		$('.selectedTableFormat').show();
		$('.kyas_status').hide();
		$('.tier1_status').hide();
		$('.selectedtier').hide();
		$("#selectedTableFormat").val('');
		$('.excel_file_attachment').hide();
		$('#table_exits').removeClass("successmsg");
		$('#table_exits').removeClass("errormsg");
		$('#selectedTableFormat').select2({
			placeholder: 'Please select table format',
		});
	});
	
	 $("#exam_year").keyup(function(){
		 $('#table_exits').removeClass("successmsg");
		 $('#table_exits').removeClass("errormsg");
		$('#table_exits').html("");

			year =  $("#exam_year").val();

			if(year >= current_yearbelow5 && year <= current_yearabove5){
				$("#year_exists").removeClass("errormsg");
				$('#year_exists').html("");
					
				$('#selectedTableFormat').select2({
					placeholder: "Please select table format",
					allowClear: true,
				}); 
				$("#selectedTableFormat").val('').trigger('change')
			
			}else{
				 $("#year_exists").addClass("errormsg");
				$('#year_exists').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'> <span  style='color: red;font-size:15px;'>Please type year between <b>"+current_yearbelow5+"-"+current_yearabove5+"</b></span></i>");
			}
	  });
	   $("#exam_year").keydown(function(){
			$('#table_exits').removeClass("successmsg");
			$('#table_exits').removeClass("errormsg");
			$('#table_exits').html("");

			year =  $("#exam_year").val();

			if(year >= current_yearbelow5 && year <= current_yearabove5){
					
				$('#selectedTableFormat').select2({
					placeholder: "Please select table format",
					allowClear: true,
				}); 
				$("#selectedTableFormat").val('').trigger('change')
			
			}else{
				$('#year_exists').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'> <span  style='color: red;font-size:15px;'>Please type year between <b>"+current_yearbelow5+"-"+current_yearabove5+"</b></span></i>");
			}
	
	  });
	  
	   	$('#selectedTableFormat').on('change', function() {
			$('.kyas_status').hide();
			$('.kyas_status_form').hide();
			$('.tier1_status').hide();
			$('.excel_file_attachment').show();
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
	  
	   	$('#selectedtier').on('change', function() {
			$('.excel_file_attachment').show();
			var formdata = new FormData(document.getElementById("upload_exam_details"));
			var selectedtier = $('#selectedtier option:selected').val();
			var table_format = $('#selectedTableFormat option:selected').val();
			console.log(selectedtier);
			
			
				 if(selectedtier == "1" && table_format == "is_tier"){
					  console.log(selectedtier);
					 $.ajax({  
						url: 'getTier_1_status.php',
						data : formdata,
						method:"POST",  
						dataType: 'json',	
						contentType:false,  
						processData:false,  
						success:function (response) {
							if(response.complition == 'completed'){
								$('.tier1_status').show();
								$('.tier1_status').html("<label class='col-sm-2 control-label'>Uploaded Status </label> <div class='col-sm-6 kyas_status_form'><div class='form-group'><div class='col-sm-6 status_card'><p>Accepted Candidates</p><p class='count'>"+response.applicable_count+"</p></div> <div class='col-sm-6 status_card'><p>Tier-1 Candidates</p><p class='count'>"+response.tier1_count+"</p></div></div></div><div id='table_exits' class='col-sm-4 successmsg'><i class='fa fa-check-circle' aria-hidden='true'> <span style='color: green;font-size:15px;'><b> Uploading Data Completed </b></span></i></div> ");
						
							}
							else if(response.complition == 'No Data Found'){
								$('.tier1_status').show();
								$('.tier1_status').html("<label class='col-sm-2 control-label'>Uploaded Status </label> <div class='col-sm-6 kyas_status_form'><div class='form-group'><div class='col-sm-6 status_card'><p>Accepted Candidates</p><p class='count'>"+response.applicable_count+"</p></div> <div class='col-sm-6 status_card'><p>Tier-1 Candidates</p><p class='count'>"+response.tier1_count+"</p></div></div></div><div id='table_exits' class='col-sm-4 successmsg'><i class='fa fa-check-circle' aria-hidden='true'> <span style='color: green;font-size:15px;'><b> No Data Found </b></span></i></div> ");
						
							}
							else{
								$('.tier1_status').show();
								$('.tier1_status').html("<label  class='col-sm-2 control-label'>Uploaded Status </label> <div class='col-sm-6 kyas_status_form'><div class='form-group'><div class='col-sm-6 status_card'><p>Accepted Candidates</p><p class='count'>"+response.applicable_count+"</p></div> <div class='col-sm-6 status_card'><p>Tier-1 Candidates</p><p class='count'>"+response.tier1_count+"</p></div></div></div><div id='table_exits' class='col-sm-4 errormsg'><i class='fa fa-check-circle' aria-hidden='true'> <span style='color: red;font-size:15px;'><b> Uploading Data Not Completed</b></span></i></div> ");
							}
							
						}
					});
				 }
				 else{
				 $('.tier1_status').hide();
				}
			 
		});
	 
	  
	  	$('#selectedTableFormat').on('change', function() {
			$('.excel_file_attachment').hide();
			
			var examname = $('#examname option:selected').val();
			var table_format = $('#selectedTableFormat option:selected').val();
			var exam_year = $('#exam_year').val();
			if(table_format=='is_kyas'){
				
					var tablefor ='Application Status Table <br> Already Exists';
					
				}else{
					
					var tablefor ='Tier Based Exam Details Table <br> Already Exists';
					
				}
			console.log(table_format);
			
			var formdata = new FormData(document.getElementById("upload_exam_details"));
				 //check the table is already exits or not		
			 $.ajax({  
				url: 'check_table_isexists_when_upload.php',
				data : formdata,
				method:"POST",  
				dataType: 'json',	
				contentType:false,  
				processData:false,  
				success:function (response) {
					if(response == 1){
						$('#table_exits').removeClass("errormsg");
						$('#table_exits').addClass("successmsg");
						$('#table_exits').html("<i class='fa fa-check-circle' aria-hidden='true'> <span  style='color: green;font-size:15px;'><b>Application Status Table Is Exists</span></i>");
						
						$('.selectedtier').hide();
						$('.excel_file_attachment').show();
						//to get and show the uploded data and photos and signs counts
						$.ajax({  
							url: 'getdirectorycount.php',
							data : formdata,
							method:"POST",  
							dataType: 'json',	
							contentType:false,  
							processData:false,  
							success:function (response) {
								if(response.complition == 'new'){
									$('.kyas_status').show();
									$('.kyas_status').html("<label  class='col-sm-2 control-label'>Uploaded Status </label> <div class='col-sm-6 kyas_status_form'><div class='form-group'><div class='col-sm-4 status_card'><p>DATA</p><p class='count'>"+response.row_count+"</p></div> <div class='col-sm-4 status_card'><p>PHOTO</p><p class='count'>"+response.photo_count+"</p></div><div class='col-sm-4 status_card'><p>SIGN</p><p class='count'>"+response.sign_count+"</p></div></div></div><div id='table_exits' class='col-sm-4 successmsg'><i class='fa fa-check-circle' aria-hidden='true'> <span style='color: green;font-size:15px;'><b> Please upload some data </b></span></i></div> ");
							
								}
								else if(response.complition == 'complited'){
									$('.kyas_status').show();
									$('.kyas_status').html("<label  class='col-sm-2 control-label'>Uploaded Status </label> <div class='col-sm-6 kyas_status_form'><div class='form-group'><div class='col-sm-4 status_card'><p>DATA</p><p class='count'>"+response.row_count+"</p></div> <div class='col-sm-4 status_card'><p>PHOTO</p><p class='count'>"+response.photo_count+"</p></div><div class='col-sm-4 status_card'><p>SIGN</p><p class='count'>"+response.sign_count+"</p></div></div></div><div id='table_exits' class='col-sm-4 successmsg'><i class='fa fa-check-circle' aria-hidden='true'> <span style='color: green;font-size:15px;'><b> Uploading Data Completed </b></span></i></div> ");
							
								}else{
									$('.kyas_status').show();
									$('.kyas_status').html("<label  class='col-sm-2 control-label'>Uploaded Status </label> <div class='col-sm-6 kyas_status_form'><div class='form-group'><div class='col-sm-4 status_card'><p>DATA</p><p class='count'>"+response.row_count+"</p></div> <div class='col-sm-4 status_card'><p>PHOTO</p><p class='count'>"+response.photo_count+"</p></div><div class='col-sm-4 status_card'><p>SIGN</p><p class='count'>"+response.sign_count+"</p></div></div></div><div id='table_exits' class='col-sm-4 errormsg'><i class='fa fa-check-circle' aria-hidden='true'> <span style='color: red;font-size:15px;'><b> Uploading Data Not Completed</b></span></i></div> ");
								}
								
							}
						});
					}
					else if(response == 2){
						$('#table_exits').removeClass("successmsg");
						$('#table_exits').addClass("errormsg");
						$('#table_exits').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'> <span  style='color: red;font-size:15px;'><b>Application Status Table Not Exists</span></i>");
						$('.selectedtier').hide();
						$('.excel_file_attachment').hide();
						$('.kyas_status').hide();
						$('.tier1_status').hide();
					}
					else if(response == 3){
						$('#table_exits').removeClass("errormsg");
						$('#table_exits').addClass("successmsg");
						$('#table_exits').html("<i class='fa fa-check-circle' aria-hidden='true'> <span  style='color: green;font-size:15px;'><b>Written Exam Table Is Exists</span></i>");
						$('.selectedtier').show();
						$('.kyas_status').hide();
						$('.excel_file_attachment').hide();
						
					}
					else if(response == 4){
						$('#table_exits').removeClass("successmsg");
						$('#table_exits').addClass("errormsg");
						$('#table_exits').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'> <span  style='color: red;font-size:15px;'><b>Written Exam Table Not Exists</span></i>");
						$('.selectedtier').hide();
						$('.excel_file_attachment').hide();
						$('.kyas_status').hide();
						$('.tier1_status').hide();
					}
					else if(response == 5){
						$('#table_exits').removeClass("errormsg");
						$('#table_exits').addClass("successmsg");
						$('#table_exits').html("<i class='fa fa-check-circle' aria-hidden='true'> <span  style='color: green;font-size:15px;'><b>Skill Exam Table Is Exists</span></i>");
						$('.selectedtier').show();
						$('.kyas_status').hide();
						$('.tier1_status').hide();
					}
					else if(response == 6){
						$('#table_exits').removeClass("successmsg");
						$('#table_exits').addClass("errormsg");
						$('#table_exits').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'> <span  style='color: red;font-size:15px;'><b>Skill Exam Table Not Exists</span></i>");
						$('.selectedtier').hide();
						$('.excel_file_attachment').hide();
						$('.kyas_status').hide();
						$('.tier1_status').hide();
					}
					else if(response == 7){
						$('#table_exits').removeClass("errormsg");
						$('#table_exits').addClass("successmsg");
						$('#table_exits').html("<i class='fa fa-check-circle' aria-hidden='true'> <span  style='color: green;font-size:15px;'><b>PET Exam Table Is Exists</span></i>");
						$('.selectedtier').show();
						$('.excel_file_attachment').hide();
						$('.kyas_status').hide();
						$('.tier1_status').hide();
					}
					else if(response == 8){
						$('#table_exits').removeClass("successmsg");
						$('#table_exits').addClass("errormsg");
						$('#table_exits').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'> <span  style='color: red;font-size:15px;'><b>PET Exam Table Not Exists</span></i>");
						$('.selectedtier').hide();
						$('.excel_file_attachment').hide();
						$('.kyas_status').hide();
						$('.tier1_status').hide();
					}
					else if(response == 9){
						$('#table_exits').removeClass("errormsg");
						$('#table_exits').addClass("successmsg");
						$('#table_exits').html("<i class='fa fa-check-circle' aria-hidden='true'> <span  style='color: green;font-size:15px;'><b>DV Exam Table Is Exists</span></i>");
						$('.selectedtier').show();
						$('.excel_file_attachment').hide();
						$('.kyas_status').hide();
						$('.tier1_status').hide();
						
					}
					else if(response == 10){
						$('#table_exits').removeClass("successmsg");
						$('#table_exits').addClass("errormsg");
						$('#table_exits').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'> <span  style='color: red;font-size:15px;'><b>DV Exam Table Not Exists</span></i>");
						$('.selectedtier').hide();
						$('.excel_file_attachment').hide();
						$('.kyas_status').hide();
						$('.tier1_status').hide();
					}
					else if(response == 11){
						$('#table_exits').removeClass("errormsg");
						$('#table_exits').addClass("successmsg");
						$('#table_exits').html("<i class='fa fa-check-circle' aria-hidden='true'> <span  style='color: green;font-size:15px;'><b>DME Exam Table Is Exists</span></i>");
						$('.selectedtier').show();
						$('.excel_file_attachment').hide();
						$('.kyas_status').hide();
						$('.tier1_status').hide();
						
					}
					else if(response == 12){
						$('#table_exits').removeClass("successmsg");
						$('#table_exits').addClass("errormsg");
						$('#table_exits').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'> <span  style='color: red;font-size:15px;'><b>DME Exam Table Not Exists</span></i>");
						$('.selectedtier').hide();
						$('.excel_file_attachment').hide();
						$('.kyas_status').hide();
						$('.tier1_status').hide();
					}
					else{
						//if not exists
						$('#table_exits').removeClass("successmsg");
						$('#table_exits').removeClass("errormsg");
						$('#table_exits').html("");
						$('.excel_file_attachment').hide();
						$('.kyas_status').hide();
						$('.tier1_status').hide();
					}
				
				
					}
				});
		
		});





	  $('#upload_exam_details').on('submit', function(event){  
           event.preventDefault();  
		   
		   var examname 	= $('#examname option:selected').val();//cgl
		   var exam_year 	= $('#exam_year').val();//2021
		   var table_format = $('#selectedTableFormat option:selected').val();//kyas
		   var selectedtier = $('#selectedtier option:selected').val();// tier (1)
		   var no_of_days   = $('#no_of_days').val();// tier (1)
		   
		   
		   if( examname!='' && selectedtier !='' && exam_year !='' && table_format !=''){
			$('#overlay').fadeIn();
           $.ajax({  
                url:"upload_excel_file_ajax.php",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
           }).done(function (data) {
			/* console.log(data); */
			$('#overlay').fadeOut();
					swal.queue([{	
						showCloseButton: true,
						title: 'Please Check The Log File', 
						html: data,
						confirmButtonText: 'Log File',
						showLoaderOnConfirm: true,
						preConfirm: function () {
							window.open(
								  'log/sscsr_log.log',
								  '_blank' // <- This is what makes it open in a new window.
								);
							location.reload();
						}
					}]);
				
			});
		}
	else{
		alert("Please fill the reqired ( *) fields !")
	} 
      });  
	  
 });  
 </script>  	

	
	
	
	