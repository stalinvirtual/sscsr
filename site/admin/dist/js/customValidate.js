/***   Debarred List Page Validation    ***/

$(document).ready(function () {

  $('#debarred_list_form').validate({ // initialize the plugin
    rules: {
      pdf_name: {
        required: true,
        maxlength: 256
      },
      effort_from_date: "required",
     
      attachment: "required",


    },
    // Specify validation error messages
    messages: {
      pdf_name: {
        required: "Please Enter Debarred List Name",
        maxlength: "Your Exam Name must be maximum 256 characters long"
      },
      effort_from_date: "Please Enter  From Date",
      
      attachment: "Please provide a Attachment.",

    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
     submitHandler: function (form) {
      form.submit();
    }
  });
 
  
  
  $("#debarred_list_form").on("submit", function(){
  });
  
  }); 


/***************** Debarred List field validation below ****************/	

$('#pdf_name').on("cut copy paste",function(e) {
  e.preventDefault();
});

$("#pdf_name").keypress(function (e) {

 
  var regex = new RegExp('^[a-zA-Z0-9 _.,(),-]*$');
  
  var key = String.fromCharCode(!event.charcode ? event.which : event.charcode);
  
  if(!regex.test(key)){


  event.preventDefault();
  return false;
  }
     
   });


  

/***   Debarred List Page Validation    ***/

$(document).ready(function () {




 
  

$('#nomination_form').validate({ // initialize the plugin
  rules: {
    exam_name: {
      required: true,
      maxlength: 256
    },
    effect_from_date: "required",
    effect_to_date: {
      required: true,
      greaterNominationlist: "#effect_from_date"
    }, 
    attachment: "required",
    

    // "pdf_name[]": {
    //   required: true
    //  },
    

    

   
    
    





  },
  // Specify validation error messages
  messages: {
    exam_name: {
      required: "Please Enter Nomination  Name",
      maxlength: "Your Exam Name must be maximum 256 characters long"
    },
    effect_from_date: "Please Enter  From Date",
    effect_to_date:
    {
      required: "Please Enter To Date",
      greaterNominationlist: "Must be greater than From date"
    },
    attachment: "Please provide a Attachment.",
   

   

    

  },
  //errorClass: "invalid",
  // Make sure the form is submitted to the destination defined
  // in the "action" attribute of the form when valid
  submitHandler: function (form) {
    
    form.submit();
  }
});










// $('input[name="pdf_name"]').rules('add', {
//   checkCode: true
// });


//  $.validator.addClassRules({
//    item_name:{  // here authUrl is one of the class Name for the input row..
//      ItemNameValidation:true
//  },
//  });


// jQuery.validator.addMethod("ItemNameValidation", function(value, element) {
//   debugger;

//   $("input").each(function () {
//     $(this).rules("add", {
//         required: true,
//         messages: {
//             required: "Specify the reference name"
//         }
//     });
//   });



  
// }, 'Please enter a valid email address.');


// $.validator.addClassRules({
//   'pdf_name[]': {
//       required: true,
     
//   }
// });


//$.validator.setDefaults( {



// $('[name*="pdf_name"]').each(function() {
//   $(this).rules('add', {
//       required: true,
//       //number: true
//   });
// });


// $(".form-control item_name").each(function(){
//   debugger;
//   $(this).rules("add", {
//     required: true,
//     email: true,
//     messages: {
//       required: "Specify a valid email"
//     }
//   });   
// });



// $(".item_name :input").rules("add", { 
//   required:true,  
//   number:true
// });












//  });

 
//  jQuery.validator.addMethod("ItemNameValidation", function (value, element, params) {

  
//   $("input.item_name").each(function(){
//     $(this).rules("add", {
//         required: true,
//         messages: {
//             required: "Specify the years you worked"
//         }
//     } );            
// });



// }, 'Must be greater than start date.');








jQuery.validator.addMethod("greaterNominationlist", function (value, element, params) {

  

  var startDate = document.getElementById("effect_from_date").value;
    //Convert DD-MM-YYYY to YYYY-MM-DD format using Javascript

  var startDate = startDate.split("-").reverse().join("-");


  var endDate = document.getElementById("effect_to_date").value;

   //Convert DD-MM-YYYY to YYYY-MM-DD format using Javascript


  var endDate = endDate.split("-").reverse().join("-");









  var startDateParseData = Date.parse(startDate) ;
  var endDateParseData = Date.parse(endDate) ;
return this.optional(element) || endDateParseData >= startDateParseData;
}, 'Must be greater than start date.');







$("#nomination_form").on("submit", function(){
});

}); 




/***  Selection Post Validation    ***/


$(document).ready(function () {

  $('#selection_post_form').validate({ // initialize the plugin
    rules: {
      exam_name: {
        required: true,
        maxlength: 256
      },
      effort_from_date: "required",
      effect_to_date: {
        required: true,
        greaterSelectionPost: "#effort_from_date"
      }, 
      attachment: "required",


    },
    // Specify validation error messages
    messages: {
      exam_name: {
        required: "Please Enter Selection Post  Name",
        maxlength: "Your Exam Name must be maximum 256 characters long"
      },
      effort_from_date: "Please Enter  From Date",
      effect_to_date:
      {
        required: "Please Enter To Date",
        greaterSelectionPost: "Must be greater than From date"
      },
      attachment: "Please provide a Attachment.",

    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function (form) {
      form.submit();
    }
  });
  jQuery.validator.addMethod("greaterSelectionPost", function (value, element, params) {

  

    var startDate = document.getElementById("effort_from_date").value;
    var startDate = startDate.split("-").reverse().join("-");
    var endDate = document.getElementById("effect_to_date").value;
    var endDate = endDate.split("-").reverse().join("-");
    var startDateParseData = Date.parse(startDate) ;
    var endDateParseData = Date.parse(endDate) ;
  return this.optional(element) || endDateParseData >= startDateParseData;
}, 'Must be greater than start date.');
  
  
  $("#selection_post_form").on("submit", function(){
  });
  
  }); 
  

/***************** Selection Post field validation below ****************/	

$('#exam_name').on("cut copy paste",function(e) {
  e.preventDefault();
});

$("#exam_name").keypress(function (e) {
 
 
  var regex = new RegExp('^[a-zA-Z0-9 _.,(),-]*$');
  
  var key = String.fromCharCode(!event.charcode ? event.which : event.charcode);
  
  if(!regex.test(key)){


  event.preventDefault();
  return false;
  }
     
   });


  

/***   Selection Post Page Validation    ***/







/***  Notice Validation    ***/


$(document).ready(function () {

  $('#notice_form').validate({ // initialize the plugin
    rules: {
      pdf_name: {
        required: true,
        maxlength: 256
      },
      effect_from_date: "required",
      effect_to_date: {
        required: true,
        greaterNotice: "#effect_from_date"
      }, 
      attachment: "required",


    },
    // Specify validation error messages
     messages: {
      pdf_name: {
        required: "Please Enter Notice  Name",
        maxlength: "Your Exam Name must be maximum 256 characters long"
      },
      effect_from_date: "Please Enter  From Date",
      effect_to_date:
      {
        required: "Please Enter To Date",
        greaterNotice: "Must be greater than From date"
      },
      attachment: "Please provide a Attachment.",

    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
     submitHandler: function (form) {
      form.submit();
    }
  });
  jQuery.validator.addMethod("greaterNotice", function (value, element, params) {
    //debugger;

  
  

      var startDate = document.getElementById("effect_from_date").value;

      var startDate = startDate.split("-").reverse().join("-");



      var endDate = document.getElementById("effect_to_date").value;

      var endDate = endDate.split("-").reverse().join("-");

      var startDateParseData = Date.parse(startDate) ;
      var endDateParseData = Date.parse(endDate) ;




    return this.optional(element) || endDateParseData >= startDateParseData;
  }, 'Must be greater than start date.');
  
  
  $("#notice_form").on("submit", function(){
  });
  
  }); 



/***************** Notice field validation below ****************/	

$('#pdf_name').on("cut copy paste",function(e) {
  e.preventDefault();
});

$("#pdf_name").keypress(function (e) {

 
  var regex = new RegExp('^[a-zA-Z0-9 _.,(),-]*$');
  
  var key = String.fromCharCode(!event.charcode ? event.which : event.charcode);
  
  if(!regex.test(key)){


  event.preventDefault();
  return false;
  }
     
   });


  

/***   Notice Page Validation    ***/









/***  Tende Validation    ***/

$(document).ready(function () {

  $('#tenderForm').validate({ // initialize the plugin
      rules: {
      pdf_name: {
        required: true,
        maxlength: 256
      },
      effect_from_date: "required",
      effect_to_date: {
        required: true,
        greaterTender: "#effect_from_date"
      }, 
      attachment: "required",


    },
    // Specify validation error messages
   messages: {
      pdf_name: {
        required: "Please Enter Tender  Name",
        maxlength: "Your Exam Name must be maximum 256 characters long"
      },
      effect_from_date: "Please Enter  From Date",
      effect_to_date:
      {
        required: "Please Enter To Date",
        greaterTender: "Must be greater than From date"
      },
      attachment: "Please provide a Attachment.",

    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
     submitHandler: function (form) {
      form.submit();
    }
  });
  jQuery.validator.addMethod("greaterTender", function (value, element, params) {

  

      var startDate = document.getElementById("effect_from_date").value;
      var startDate = startDate.split("-").reverse().join("-");



      var endDate = document.getElementById("effect_to_date").value;

      var endDate = endDate.split("-").reverse().join("-");


      



      var startDateParseData = Date.parse(startDate) ;
      var endDateParseData = Date.parse(endDate) ;




    return this.optional(element) || endDateParseData >= startDateParseData;
  }, 'Must be greater than start date.');
  
  
  $("#tenderForm").on("submit", function(){
  });
  
  }); 


/***************** Tender validation below ****************/	

$('#pdf_name').on("cut copy paste",function(e) {
  e.preventDefault();
});

$("#pdf_name").keypress(function (e) {

 
  var regex = new RegExp('^[a-zA-Z0-9 _.,(),-]*$');
  
  var key = String.fromCharCode(!event.charcode ? event.which : event.charcode);
  
  if(!regex.test(key)){


  event.preventDefault();
  return false;
  }
     
   });


  

/***  Tender Page Validation    ***/







/***  Important Links Validation    ***/

$(document).ready(function () {

  $('#importantLinkForm').validate({ // initialize the plugin
      rules: {
      link_name: {
        required: true,
        maxlength: 256
      },
      menu_link:{
	  required : true,
	  
	  url:true
	  },
     


    },
    // Specify validation error messages
    messages: {
      link_name: {
        required: "Please Enter Link  Name",
        maxlength: "Your Exam Name must be maximum 256 characters long"
      },
     
	  
	  menu_link: {
        required: "Please Enter Link  URL ",
        url: "Please Enter Valid URL"
      },
      

    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
     submitHandler: function (form) {
      form.submit();
    }
  });

  
  
  $("#importantLinkForm").on("submit", function(){
  });
  
  }); 



  

/***************** Tender validation below ****************/	

$('#link_name').on("cut copy paste",function(e) {
  e.preventDefault();
});

$("#link_name").keypress(function (e) {

 
  var regex = new RegExp('^[a-zA-Z0-9 _.,(),-]*$');
  
  var key = String.fromCharCode(!event.charcode ? event.which : event.charcode);
  
  if(!regex.test(key)){


  event.preventDefault();
  return false;
  }
     
   });


  

/***  Important Links Page Validation    ***/


/*****     Menu Page Validation */



$('#menu_name').on("cut copy paste",function(e) {
  e.preventDefault();
});

$("#menu_name").keypress(function (e) {

 
  var regex = new RegExp('^[a-zA-Z0-9 _.,(),-]*$');
  
  var key = String.fromCharCode(!event.charcode ? event.which : event.charcode);
  
  if(!regex.test(key)){


  event.preventDefault();
  return false;
  }
     
   });


/*****     Menu Page Validation */




/*****     Page Validation */



$('#title').on("cut copy paste",function(e) {
  e.preventDefault();
});

$("#title").keypress(function (e) {

 
  var regex = new RegExp('^[a-zA-Z0-9 _.,(),-]*$');
  
  var key = String.fromCharCode(!event.charcode ? event.which : event.charcode);
  
  if(!regex.test(key)){


  event.preventDefault();
  return false;
  }
     
   });


/*****    Page Validation */






// Event Category Form
$(document).ready(function () {

  $('#event_category_form').validate({ // initialize the plugin
    rules: {
      event_name: {
        required: true,
        maxlength: 256
      },
      creation_date: "required"
    },
    // Specify validation error messages
    messages: {
      event_name: {
        required: "Please Enter Enter  Name",
        maxlength: "Your Exam Name must be maximum 256 characters long"
      },
      creation_date: "Please Enter  Creation  Date"

    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function (form) {
      form.submit();
    }
  });
 
  
  
  $("#event_category_form").on("submit", function(){
  });
  
  }); 





  $('#event_name').on("cut copy paste",function(e) {
    e.preventDefault();
  });
  
  $("#event_name").keypress(function (e) {
  
   
    var regex = new RegExp('^[a-zA-Z0-9 _.,(),-]*$');
    
    var key = String.fromCharCode(!event.charcode ? event.which : event.charcode);
    
    if(!regex.test(key)){
  
  
    event.preventDefault();
    return false;
    }
       
     });
// Event Category Form



//Photo gallery

$(document).ready(function () {


  //  Form id 
    
  
  // $('#editgallery_form').validate({ // initialize the plugin
  //   rules: {

  //     image_file: {
  //       required: true,
  //       extension: "jpg|jpeg|png|ico|bmp"
  //     }
  //   },
  //   // Specify validation error messages
  //   messages: {
  //     image_file: "Please Enter Image File"
  
  //   },
  //   // Make sure the form is submitted to the destination defined
  //   // in the "action" attribute of the form when valid
  //   submitHandler: function (form) {
  //     form.submit();
  //   }
  // });
  
  
  
  $("#editgallery_form").on("submit", function(){
  });
  
  });
  
  
//Photo gallery






//  Category Form
$(document).ready(function () {

  $('#category_form').validate({ // initialize the plugin
    rules: {
      category_name: {
        required: true,
        maxlength: 256
      },
     
    },
    // Specify validation error messages
    messages: {
      category_name: {
        required: "Please Enter Category  Name",
        maxlength: "Your Category must be maximum 256 characters long"
      },
      

    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function (form) {
      form.submit();
    }
  });
 
  
  
  $("#category_form").on("submit", function(){
  });
  
  }); 





  $('#category_name').on("cut copy paste",function(e) {
    e.preventDefault();
  });
  
  $("#category_name").keypress(function (e) {
  
   
    var regex = new RegExp('^[a-zA-Z0-9 _.,(),-]*$');
    
    var key = String.fromCharCode(!event.charcode ? event.which : event.charcode);
    
    if(!regex.test(key)){
  
  
    event.preventDefault();
    return false;
    }
       
     });
//  Category Form





// Faq Form

$(document).ready(function () {


  //  Form id 
    
  
  $('#faq_form').validate({ // initialize the plugin
    rules: {
      faq_title: {
        required: true,
        maxlength: 500
      },
      faq_content: {
        required: true,
        maxlength: 500
      },
      effect_from_date: "required"
    },
    // Specify validation error messages
    messages: {
      faq_title: {
        required: "Please Enter Faq  Title",
        maxlength: "Your Faq must be maximum 500 characters long"
      },
      faq_content: {
        required: "Please Enter Faq  Content",
        maxlength: "Your Exam Name must be maximum 500 characters long"
      },
      effect_from_date: "Please Enter  From Date",
      
  
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function (form) {
      form.submit();
    }
  });
  
  
  
  $("#faq_form").on("submit", function(){
  });
  
  });




  // $('#faq_title').on("cut copy paste",function(e) {
  //   e.preventDefault();
  // });
  
  $("#faq_title").keypress(function (e) {
  
   
    var regex = new RegExp('^[a-zA-Z0-9 _.,(),-?]*$');
    
    var key = String.fromCharCode(!event.charcode ? event.which : event.charcode);
    
    if(!regex.test(key)){
  
  
    event.preventDefault();
    return false;
    }
       
     });
  
  
  
  // $('#faq_content').on("cut copy paste",function(e) {
  //   e.preventDefault();
  // });
  
  $("#faq_content").keypress(function (e) {
  
   
    var regex = new RegExp('^[a-zA-Z0-9 _.,(),-]*$');
    
    var key = String.fromCharCode(!event.charcode ? event.which : event.charcode);
    
    if(!regex.test(key)){
  
  
    event.preventDefault();
    return false;
    }
       
     });
  
  
  












// Faq Form







