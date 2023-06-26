 <!-- /.content-wrapper -->
 <footer class="main-footer">
     <strong>Copyright &copy; 2014-2022 <a href="https://adminlte.io">SSCSR</a>.</strong>
     All rights reserved.
     <div class="float-right d-none d-sm-inline-block">
         <b>Version</b> 3.1.0
     </div>
 </footer>

 <!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-dark">
     <!-- Control sidebar content goes here -->
 </aside>
 <!-- /.control-sidebar -->
 </div>
 <!-- ./wrapper -->

 <!-- jQuery -->
 <script src="<?php echo $this->theme_url; ?>/plugins/jquery/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="<?php echo $this->theme_url; ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->


 
 <script>
     $.widget.bridge('uibutton', $.ui.button)
 </script>
 <!-- Bootstrap 4 -->
 <script src="<?php echo $this->theme_url; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- ChartJS -->
 <script src="<?php echo $this->theme_url; ?>/plugins/chart.js/Chart.min.js"></script>
 <!-- Sparkline -->
 <script src="<?php echo $this->theme_url; ?>/plugins/sparklines/sparkline.js"></script>
 <!-- JQVMap -->
 <script src="<?php echo $this->theme_url; ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
 <!-- jQuery Knob Chart -->
 <script src="<?php echo $this->theme_url; ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
 <!-- daterangepicker -->
 <script src="<?php echo $this->theme_url; ?>/plugins/moment/moment.min.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/daterangepicker/daterangepicker.js"></script>
 <!-- Tempusdominus Bootstrap 4 -->
 <script src="<?php echo $this->theme_url; ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
 <!-- Summernote -->
 <script src="<?php echo $this->theme_url; ?>/plugins/summernote/summernote-bs4.min.js"></script>
 <!-- overlayScrollbars -->
 <script src="<?php echo $this->theme_url; ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <!-- AdminLTE App -->
 <script src="<?php echo $this->theme_url; ?>/dist/js/adminlte.js"></script>
 <!-- AdminLTE for demo purposes -->
 <script src="<?php echo $this->theme_url; ?>/dist/js/demo.js"></script>
 <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
 <script src="<?php echo $this->theme_url; ?>/dist/js/pages/dashboard.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/jszip/jszip.min.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/pdfmake/pdfmake.min.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/pdfmake/vfs_fonts.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
 <script src="<?php echo $this->theme_url; ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
 
 <script src="<?php echo $this->theme_url; ?>/dist/js/sweetalert.min.js"></script> 


 <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/dist/css/custom.css">

 <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/dist/css/jquery-ui.css">


 <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/dist/css/mdtimepicker.css">

 <script src="<?php echo $this->theme_url; ?>/dist/js/customValidate.js"></script>
 <script src="<?php echo $this->theme_url; ?>/dist/js/publish.js"></script>


 <script src="<?php echo $this->theme_url; ?>/dist/js/mdtimepicker.js"></script> 

 <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/dist/css/jquery-ui-smooth.css" type="text/css">


 <script src="<?php echo $this->theme_url; ?>/dist/js/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>


  <!-- AdminLTE App -->

 <!-- AdminLTE for demo purposes -->

 <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/dist/css/custom.css">


 <script>

$(function () {

  
  
    var url = window.location;
    // for single sidebar menu
    $('ul.nav-sidebar a').filter(function () {
        return this.href == url;
    }).addClass('active');

    // for sidebar menu and treeview
    $('ul.nav-treeview a').filter(function () {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview")
        .css({'display': 'block'})
        .addClass('menu-open').prev('a')
        .addClass('active');
});
     $(function() {

         jQuery("select[name='menu_type']").on('change', function() {
             if (jQuery(this).val() == 1) {
                 jQuery(".attachmentDiv").hide();
                 jQuery(".menulinkDiv").show();
                 jQuery(".pageContainer").show();
                 jQuery(".route-container").hide();
                 jQuery(".menulinkDiv").hide();
				  jQuery(".redirectpopup").hide();
				  jQuery("#menu_link").val('');

             } else if (jQuery(this).val() == 2) {
                 jQuery(".attachmentDiv").hide();
                 jQuery(".pageContainer").hide();
                 jQuery(".route-container").hide();
                 jQuery(".menulinkDiv").show();
                 jQuery(".redirectpopup").show();
				 //jQuery("#menu_link").val('#');

             } else if(jQuery(this).val() == 3){
                 jQuery(".attachmentDiv").show();
                 jQuery(".menulinkDiv").hide();
                 jQuery(".pageContainer").hide();
                 jQuery(".route-container").hide();
                 jQuery(".menulinkDiv").hide();
				  jQuery(".redirectpopup").hide();
				  jQuery("#menu_link").val('');

             
			 } 
			 else if(jQuery(this).val() == 4){
                 jQuery(".attachmentDiv").hide();
                 jQuery(".menulinkDiv").hide();
                 jQuery(".pageContainer").hide();
                 jQuery(".route-container").hide();
                 jQuery(".menulinkDiv").show();
				  jQuery(".redirectpopup").hide();
				  jQuery("#menu_link").val('#');
			 }
			 
			 
			 else  {
                 jQuery(".attachmentDiv").hide();
                 jQuery(".pageContainer").hide();
                 jQuery(".route-container").hide();
                 jQuery(".menulinkDiv").show();
				 
				  jQuery(".redirectpopup").hide();
                 jQuery("#menu_link").val('#');

             }
         });
         jQuery("select[name='menu_type']").trigger('change');





         jQuery('.publish-button').on(
             'click',
             function() {
				
            
				 
				 var menuid = $(this).closest('td').find('#menuid').val();
                 var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponse"); ?>';
                 var redirecturl = '<?php echo $this->route->site_url("Admin/dashboard/?action=listmenus&&status=0"); ?>';


                 swal("Want To Publish?", {
                     buttons: {
                         yes: {
                             text: "ok",
                             value: "yes"
                         },
                         No: {
                             text: "cancel",
                             value: "No",
                             buttonColor: "#000000",
                         }
                     }
                 }).then((value) => {
                     if (value === "yes") {
                         jQuery.ajax({
                             url: baseurl,
                             data: {
                                 menuid: menuid
                             },
                             type: 'post',
                             dataType: 'json',
                             success: function(response) {
                                 if (response.message == 1) {
                                     //alert("Welcome")
                                     window.location.href = redirecturl;

                                 }
                             }
                         });
                     }
                     return false;
                 });
             }
         );
         //Ajax Response for Publish
        // Ajax Response for Page start
		
		         jQuery('.page_publish_button').on(
             'click',
             function() {

                //debugger;
                
				  var pageid = $(this).closest('td').find('#pageid').val();
                 var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforpage"); ?>';
                 var redirecturl = '<?php echo $this->route->site_url("Admin/dashboard/?action=listpages&&status=0"); ?>';


                 swal("Want To Publish?", {
                     buttons: {
                         yes: {
                             text: "ok",
                             value: "yes"
                         },
                         No: {
                             text: "cancel",
                             value: "No",
                             buttonColor: "#000000",
                         }
                     }
                 }).then((value) => {
                     if (value === "yes") {
                         jQuery.ajax({
                             url: baseurl,
                             data: {
                                 pageid: pageid
                             },
                             type: 'post',
                             dataType: 'json',
                             success: function(response) {
                                 if (response.message == 1) {
                                     //alert("Welcome")
                                     window.location.href = redirecturl;

                                 }
                             }
                         });
                     }
                     return false;
                 });
             }
         );
		  // Ajax Response for Page End
	//list nomination publish button	
 jQuery('.nomination-publish-button').on(
             'click',
             function() {

                //debugger;
				 
				 
                 var nomination_id =  $(this).closest('td').find('#nomination_id').val();
                 var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforNomination"); ?>';
                 var redirecturl = '<?php echo $this->route->site_url("Admin/dashboard/?action=listnominations&&status=0"); ?>';


                 swal("Want To Publish?", {
                     buttons: {
                         yes: {
                             text: "ok",
                             value: "yes"
                         },
                         No: {
                             text: "cancel",
                             value: "No",
                             buttonColor: "#000000",
                         }
                     }
                 }).then((value) => {
                     if (value === "yes") {
                         jQuery.ajax({
                             url: baseurl,
                             data: {
                                 nomination_id: nomination_id
                             },
                             type: 'post',
                             dataType: 'json',
                             success: function(response) {
								
                                 if (response.message == 1) {

                                    

                                    
                                     //alert("Welcome")
                                     window.location.href = redirecturl;

                                     //window.location.reload();

                                 }
                             }
                         });
                     }
                     return false;
                 });
             }
         );

	//list nomination publish button

	//list nomination Archives publish button	
    jQuery('.nomination-archives-publish-button').on(
             'click',
             function() {

                debugger;
				 
				 
                 var nomination_id =  $(this).closest('td').find('#nomination_id').val();
                 var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforNominationArchives"); ?>';
                 var redirecturl = '<?php echo $this->route->site_url("Admin/dashboard/?action=listnominationsarchieves&&status=0"); ?>';


                 swal("Want To Publish?", {
                     buttons: {
                         yes: {
                             text: "ok",
                             value: "yes"
                         },
                         No: {
                             text: "cancel",
                             value: "No",
                             buttonColor: "#000000",
                         }
                     }
                 }).then((value) => {
                     if (value === "yes") {
                         jQuery.ajax({
                             url: baseurl,
                             data: {
                                 nomination_id: nomination_id
                             },
                             type: 'post',
                             dataType: 'json',
                             success: function(response) {
								
                                 if (response.message == 1) {

                                    

                                    
                                     //alert("Welcome")
                                     window.location.href = redirecturl;

                                     //window.location.reload();

                                 }
                             }
                         });
                     }
                     return false;
                 });
             }
         );

	//list nomination Archives publish button














	
	
		//list sp publish button	
 jQuery('.selectionpost-publish-button').on(
             'click',
             function() {
				 
				 
                 var selection_post_id =  $(this).closest('td').find('#selection_post_id').val();
                 var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforSelectionPost"); ?>';
                 var redirecturl = '<?php echo $this->route->site_url("Admin/dashboard/?action=listselectionposts&&status=0"); ?>';


                 swal("Want To Publish?", {
                     buttons: {
                         yes: {
                             text: "ok",
                             value: "yes"
                         },
                         No: {
                             text: "cancel",
                             value: "No",
                             buttonColor: "#000000",
                         }
                     }
                 }).then((value) => {
                     if (value === "yes") {
                         jQuery.ajax({
                             url: baseurl,
                             data: {
                                 selection_post_id: selection_post_id
                             },
                             type: 'post',
                             dataType: 'json',
                             success: function(response) {
								
                                 if (response.message == 1) {
                                     //alert("Welcome")
                                     window.location.href = redirecturl;

                                 }
                             }
                         });
                     }
                     return false;
                 });
             }
         );

	//list sp publish button

    
	
			//list dlist publish button	
 jQuery('.debarred-publish-button').on(
             'click',
             function() {
				 
				 
                 var debarred_lists_id =  $(this).closest('td').find('#debarred_lists_id').val();
                 var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforDebarredList"); ?>';
                 var redirecturl = '<?php echo $this->route->site_url("Admin/dashboard/?action=listdebarredlists&&status=0"); ?>';


                 swal("Want To Publish?", {
                     buttons: {
                         yes: {
                             text: "ok",
                             value: "yes"
                         },
                         No: {
                             text: "cancel",
                             value: "No",
                             buttonColor: "#000000",
                         }
                     }
                 }).then((value) => {
                     if (value === "yes") {
                         jQuery.ajax({
                             url: baseurl,
                             data: {
                                 debarred_lists_id: debarred_lists_id
                             },
                             type: 'post',
                             dataType: 'json',
                             success: function(response) {
								
                                 if (response.message == 1) {
                                     //alert("Welcome")
                                     window.location.href = redirecturl;

                                 }
                             }
                         });
                     }
                     return false;
                 });
             }
         );

	//list dlist publish button
	
	
	//Notice publish button	
 jQuery('.notice-publish-button').on(
             'click',
             function() {
				 
				 
                 var notice_id =  $(this).closest('td').find('#notice_id').val();
                 var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforNotice"); ?>';
                 var redirecturl = '<?php echo $this->route->site_url("Admin/dashboard/?action=listofnotices&&status=0"); ?>';


                 swal("Want To Publish?", {
                     buttons: {
                         yes: {
                             text: "ok",
                             value: "yes"
                         },
                         No: {
                             text: "cancel",
                             value: "No",
                             buttonColor: "#000000",
                         }
                     }
                 }).then((value) => {
                     if (value === "yes") {
                         jQuery.ajax({
                             url: baseurl,
                             data: {
                                 notice_id: notice_id
                             },
                             type: 'post',
                             dataType: 'json',
                             success: function(response) {
								
                                 if (response.message == 1) {
                                     //alert("Welcome")
                                     window.location.href = redirecturl;

                                 }
                             }
                         });
                     }
                     return false;
                 });
             }
         );

	//Notice publish button
	
	
		//tender publish button	
 jQuery('.tender-publish-button').on(
             'click',
             function() {
				 
				 
                 var tender_id =  $(this).closest('td').find('#tender_id').val();
                 var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforTender"); ?>';
                 var redirecturl = '<?php echo $this->route->site_url("Admin/dashboard/?action=listoftenders&&status=0"); ?>';


                 swal("Want To Publish?", {
                     buttons: {
                         yes: {
                             text: "ok",
                             value: "yes"
                         },
                         No: {
                             text: "cancel",
                             value: "No",
                             buttonColor: "#000000",
                         }
                     }
                 }).then((value) => {
                     if (value === "yes") {
                         jQuery.ajax({
                             url: baseurl,
                             data: {
                                 tender_id: tender_id
                             },
                             type: 'post',
                             dataType: 'json',
                             success: function(response) {
								
                                 if (response.message == 1) {
                                     //alert("Welcome")
                                     window.location.href = redirecturl;

                                 }
                             }
                         });
                     }
                     return false;
                 });
             }
         );

	//tender publish button
	//Important Links publish button	
 jQuery('.il-publish-button').on(
             'click',
             function() {
				 
				 
                 var importantlink_id =  $(this).closest('td').find('#importantlink_id').val();
                 var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforImportantLinks"); ?>';
                 var redirecturl = '<?php echo $this->route->site_url("Admin/dashboard/?action=listofimportantlinks&&status=0"); ?>';


                 swal("Want To Publish?", {
                     buttons: {
                         yes: {
                             text: "ok",
                             value: "yes"
                         },
                         No: {
                             text: "cancel",
                             value: "No",
                             buttonColor: "#000000",
                         }
                     }
                 }).then((value) => {
                     if (value === "yes") {
                         jQuery.ajax({
                             url: baseurl,
                             data: {
                                 importantlink_id: importantlink_id
                             },
                             type: 'post',
                             dataType: 'json',
                             success: function(response) {
								
                                 if (response.message == 1) {
                                     //alert("Welcome")
                                     window.location.href = redirecturl;

                                 }
                             }
                         });
                     }
                     return false;
                 });
             }
         );

	//tender publish button


    //Faq publish button
jQuery('.faq-publish-button').on(
             'click',
             function() {
				 
				 
                 var faq_id =  $(this).closest('td').find('#faq_id').val();
                 var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforFaq"); ?>';
                 var redirecturl = '<?php echo $this->route->site_url("Admin/dashboard/?action=listoffaq&&status=0"); ?>';


                 swal("Want To Publish?", {
                     buttons: {
                         yes: {
                             text: "ok",
                             value: "yes"
                         },
                         No: {
                             text: "cancel",
                             value: "No",
                             buttonColor: "#000000",
                         }
                     }
                 }).then((value) => {
                     if (value === "yes") {
                         jQuery.ajax({
                             url: baseurl,
                             data: {
                                 faq_id: faq_id
                             },
                             type: 'post',
                             dataType: 'json',
                             success: function(response) {
								
                                 if (response.message == 1) {
                                     //alert("Welcome")
                                     window.location.href = redirecturl;

                                 }
                             }
                         });
                     }
                     return false;
                 });
             }
         );

	//Faq publish button
	
	
	/* 
		        $('.pdfnomination').on('change', function() {
            debugger;
            
			var myfile = $(this).closest('td').find('.pdfnomination').val();
            var ext = myfile.split('.').pop();
            if (ext == "pdf") {
                return true;
            } else {
               swal("Accept Only PDF Files","","warning");
				myfile.val('');
				return;
            }
        }); */

	
	
	

         jQuery("select[name='m_menu_type']").on('change', function() {
             console.log('here')
             if (jQuery(this).val() == 1) {
                 jQuery(".page-container").show();
                 jQuery(".route-container").hide();
             } else if (jQuery(this).val() == 2) {
                 jQuery(".page-container").hide();
                 jQuery(".route-container").show();
             } else {
                 jQuery(".page-container").hide();
                 jQuery(".route-container").hide();
             }
         });
         jQuery("select[name='m_menu_type']").trigger('change');


         var table = jQuery('#example2').DataTable({
             "lengthMenu": [
                 [5, 10, 25, 50, -1],
                 [5, 10, 25, 50, "All"]
             ],
			 
			  
              
			
			//fixedColumns: true,
             'responsive': true
         });

 var table = jQuery('#menuTbl').DataTable({
             "lengthMenu": [
                 [5, 10, 25, 50, -1],
                 [5, 10, 25, 50, "All"]
             ],
			 /* "autoWidth": false, // might need this
			  "columns": [
				
				null, // automatically calculates
				null,
				null,
				{ "width": "20%" },
				null,
				null,
				null,
				// remaining width
			  ], */
			
			//fixedColumns: true,
             'responsive': true
         });

//Event Category start


	//Event Category publish button	
    jQuery('.ec-publish-button').on(
             'click',
             function() {
				 
				 
                 var ec_id =  $(this).closest('td').find('#eventcategory_id').val();
                 var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforEventCategory"); ?>';
                 var redirecturl = '<?php echo $this->route->site_url("Admin/dashboard/?action=listofeventcategories"); ?>';


                 swal("Want To Publish?", {
                     buttons: {
                         yes: {
                             text: "ok",
                             value: "yes"
                         },
                         No: {
                             text: "cancel",
                             value: "No",
                             buttonColor: "#000000",
                         }
                     }
                 }).then((value) => {
                     if (value === "yes") {

                         jQuery.ajax({
                             url: baseurl,
                             data: {
                                ec_id: ec_id
                             },
                             type: 'post',
                             dataType: 'json',
                             success: function(response) {
								
                                 if (response.message == 1) {
                                     //alert("Welcome")
                                     window.location.href = redirecturl;

                                 }
                             }
                         });
                     }
                     return false;
                 });
             }
         );

//Event Category End


// Category publish button	
// jQuery('.category-publish-button').on(
//              'click',
//              function() {
    $('#example2').on('click', '.category-publish-button', function(event) {
			event.preventDefault();
				 
                 var cat_id =  $(this).closest('td').find('#category_id').val();
                 var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforCategory"); ?>';
                 var redirecturl = '<?php echo $this->route->site_url("Admin/dashboard/?action=listofcategory"); ?>';


                 swal("Want To Publish?", {
                     buttons: {
                         yes: {
                             text: "ok",
                             value: "yes"
                         },
                         No: {
                             text: "cancel",
                             value: "No",
                             buttonColor: "#000000",
                         }
                     }
                 }).then((value) => {
                     if (value === "yes") {
                         jQuery.ajax({
                             url: baseurl,
                             data: {
                                cat_id: cat_id
                             },
                             type: 'post',
                             dataType: 'json',
                             success: function(response) {
								
                                 if (response.message == 1) {
                                     //alert("Welcome")
                                     window.location.href = redirecturl;

                                 }
                             }
                         });
                     }
                     return false;
                 });
             }
         );

//Category End



            








































		 
		 
		/*  Check Username Availability with jQuery and AJAX  Start*/
		
		$("#txt_username").keyup(function(){

      var username = $(this).val().trim();
	  var baseurl = '<?php echo $this->route->site_url("Admin/ajaxResponseforUserNameAlreadyExists"); ?>';

      if(username != ''){

         $.ajax({
            url: baseurl,
            type: 'post',
            data: {username: username},
            success: function(response){

                $('#uname_response').html(response);

             }
         });
      }else{
         $("#uname_response").html("");
      }

    });

		
		/*  Check Username Availability with jQuery and AJAX End*/
		
		/*  Check Email Availability with jQuery and AJAX  Start*/
		
		$("#txt_email").keyup(function(){

      var email = $(this).val().trim();
	  var baseurl = '<?php echo $this->route->site_url("Admin/ajaxResponseforEmailAlreadyExists"); ?>';

      if(email != ''){

         $.ajax({
            url: baseurl,
            type: 'post',
            data: {email: email},
            success: function(response){

                $('#email_response').html(response);

             }
         });
      }else{
         $("#email_response").html("");
      }

    });

		
		/*  Check Email Availability with jQuery and AJAX End*/
		
		
		/*  Check Phone Number Availability with jQuery and AJAX  Start*/
		
		$("#phone_number").keyup(function(){

      var phone_number = $(this).val().trim();
	  var baseurl = '<?php echo $this->route->site_url("Admin/ajaxResponseforPhoneNumberAlreadyExists"); ?>';

      if(phone_number != ''){

         $.ajax({
            url: baseurl,
            type: 'post',
            data: {phone_number: phone_number},
            success: function(response){

                $('#phone_response').html(response);

             }
         });
      }else{
         $("#phone_response").html("");
      }

    });

		
		/*  Check Phone Number Availability with jQuery and AJAX End*/

		



     });





 </script>
 </body>

 </html>