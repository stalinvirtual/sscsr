<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER']) && empty($_SERVER['HTTP_REFERER']) || !isset($_SESSION['sess_user'])){
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
					<h4>Upload Important Instruction details:</h4>
				</div>
				<div class="form-body">
					<div data-example-id="simple-form-inline"> 
						<form class="form-horizontal" action="#" method="post" id="upload_ii_attachment">
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
						
						
							<div class="form-group selectedtier">	
								<label for="selectedtier" class="col-sm-2 control-label">Exam Tier<font style="color:red";>*</font> </label> 
								<div class="col-sm-6">
									<select name="selectedtier" id="selectedtier" required="true" class="form-control">
										<option value="0" selected="selected">Select Tier</option>		
									</select>
								</div>
								<div id="pdf_file_exists" class=" col-sm-4" >	
								</div>								
							</div>
							<div class="form-group image_file_attachment">	
								<label for="excelfile" class="col-sm-2 control-label">Select PDF File<font style="color:red";>*</font> </label> 
								<div class="col-sm-6 excelfile">
									<input type="file" required="true" name="image_file_attachment"  id="excel_file" accept="application/pdf"/>		
								</div> 
							</div>				
					
							<button class="btn w3ls-button hvr-icon-down col-5" id="upload_excel"> Upload</button>
						</form>  
					</div>
				</div>
				<div class="alert alert-success alert-dismissible"  role="alert">
					<strong style="color:green">Uploading Successfully!</strong>
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

.errormsg{
	  background: antiquewhite;
}
i.fa.fa-exclamation-triangle {
    width: inherit;
}
</style>

<?php
}
?>
<?php include('footer.php'); ?>
	
	
<script>
	/* var myEditor;

    ClassicEditor
        .create( document.querySelector( '#important_instruction' ) )
        .then( editor => {
            console.log( 'Editor was initialized', editor );
            myEditor = editor;
        } )
        .catch( err => {
            console.error( err.stack );
        } ); */
	

    </script> 
<script type="text/javascript" language="javascript" >

$(document).ready(function(){ 

const d = new Date();
d.getMonth() + 1; // Month	[mm]	(1 - 12)
d.getDate();

$('.alert').hide();
$('#examname').select2();
$('#examname').select2({
    placeholder: 'Select Exam',
    ajax: {
        url: 'search_exam.php',
        dataType: 'json',
        processResults: function(data) {
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
        processResults: function(data) {
            return {
                results: data
            };
        },
        cache: true
    }
});


var current_yearbelow5 = d.getFullYear() - 5; // Day		[dd]	(1 - 31)
var current_yearabove5 = d.getFullYear() + 5;

$("#exam_year").keyup(function() {
    $('#table_exits').removeClass("errormsg");
    $('#table_exits').html("");

    year = $("#exam_year").val();

    if (year >= current_yearbelow5 && year <= current_yearabove5) {
        $("#year_exists").removeClass("errormsg");
        $('#year_exists').html("");

        	$('#selectedtier').select2({
    placeholder: 'Select Tier',
    ajax: {
        url: 'search_tier.php',
        dataType: 'json',
        processResults: function(data) {
            return {
                results: data
            };
        },
        cache: true
    }
});

    } else {
        $("#year_exists").addClass("errormsg");
        $('#year_exists').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'> <span  style='color: red;font-size:15px;'>Please type year between <b>" + current_yearbelow5 + "-" + current_yearabove5 + "</b></span></i>");
    }
});
$("#exam_year").keydown(function() {
    $('#table_exits').removeClass("errormsg");
    $('#table_exits').html("");
   

    year = $("#exam_year").val();

    if (year >= current_yearbelow5 && year <= current_yearabove5) {
       

        	$('#selectedtier').select2({
    placeholder: 'Select Tier',
    ajax: {
        url: 'search_tier.php',
        dataType: 'json',
        processResults: function(data) {
            return {
                results: data
            };
        },
        cache: true
    }
});

    } else {
        $('#year_exists').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'> <span  style='color: red;font-size:15px;'>Please type year between <b>" + current_yearbelow5 + "-" + current_yearabove5 + "</b></span></i>");
    }

});


// Tier Onchange
$('#selectedtier').on('change', function(event) {
	
	 $('#pdf_file_exists').removeClass("errormsg");
    $('#pdf_file_exists').html("");
	
	var examname = $('#examname option:selected').val(); //cgl
			
			 var myform = document.getElementById("upload_ii_attachment");
             var fd = new FormData(myform);
			
			 $.ajax({
            url: "pdf_file_already_exists_ajax.php",
            type: "POST",
            dataType: "json",
            data: fd,
            contentType: false,
            processData: false,
        }).done(function(data) {
            $('#overlay').fadeOut();
            if (data.response.status == 'already_exists') {
				
				$("#pdf_file_exists").addClass("errormsg");
			$('#pdf_file_exists').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'> <span  style='color: red;font-size:15px;'>PDF Already Exists <b></b></span></i>");
               /*  swal.queue([{
                    showCloseButton: true,
                    title: data.response.title,
                    text: data.response.message,
                    icon: data.response.status
                }]); */

            } else {

                swal.fire({
                    showCloseButton: true,
                    title: data.response.title,
                    text: data.response.message,
                    icon: data.response.status,
                });

            }
        });
	
});




//Tier Onchange







$('#upload_ii_attachment').on('submit', function(event) {
    event.preventDefault();
    var examname = $('#examname option:selected').val(); //cgl
    var exam_year = $('#exam_year').val(); //2021
    var selectedtier = $('#selectedtier option:selected').val(); // tier (1)
    if (examname != '' && selectedtier != '' && exam_year != '') {
        $('#overlay').fadeIn();
        $.ajax({
            url: "upload_admitcard_important_instructions_ajax.php",
            method: "POST",
            dataType: "json",
            data: new FormData(this),
            contentType: false,
            processData: false,
        }).done(function(data) {
            $('#overlay').fadeOut();
            if (data.response.status == 'already_exists') {
                swal.queue([{
                    showCloseButton: true,
                    title: data.response.title,
                    text: data.response.message,
                    icon: data.response.status,
                    confirmButtonText: 'Update',
                    showCancelButton: true,
                    cancelButtonText: 'Cancel',
                    showLoaderOnConfirm: true,
                    preConfirm: function() {
                        return new Promise(function(resolve) {

                            var myform = document.getElementById("upload_ii_attachment");
                            var fd = new FormData(myform);
                            $.ajax({
                                url: "update_important_instruction.php",
                                data: fd,
                                cache: false,
                                processData: false,
                                contentType: false,
                                type: 'POST',
                            }).done(function(data) {
                                swal .fire({
                                    showCloseButton: true,
                                    title: 'Instruction Updated',
                                    text: 'Successfully Updated',
                                    icon: 'success',
                                }).then(function() {
                                    location.reload();
                                });

                            })
                            resolve()

                        })
                        location.reload(true);

                    }
                }]);

            } else {

                swal.fire({
                    showCloseButton: true,
                    title: data.response.title,
                    text: data.response.message,
                    icon: data.response.status,
                }).then(function() {
                    location.reload();
                });;
               // location.reload();

            }
        });
    } else {
        alert("Please fill the reqired ( *) fields !")
    }
});
	  
 });  
 </script>  	

	
	
	
	