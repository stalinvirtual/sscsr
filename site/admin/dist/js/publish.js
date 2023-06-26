
function publishButton(
    publishbuttonclass,
    eachrowid,
    baseurlpath,
    redirecturlpath,
    modelClassName,
    rowidalue
) {

    var rowid = rowidalue;
    var baseurl = baseurlpath;
    var redirecturl = redirecturlpath;


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
                    rowid: rowid,
                    modelClassName: modelClassName
                },
                type: 'post',
                dataType: 'json',
                success: function (response) {
                    if (response.message == 1) {
                        window.location.href = redirecturl;
                    }
                }
            });
        }
        return false;
    });
}



function archivesButton(
    publishbuttonclass,
    eachrowid,
    baseurlpath,
    redirecturlpath,
    modelClassName,
    rowidalue
) {

    debugger;

    var rowid = rowidalue;
    var baseurl = baseurlpath;
    var redirecturl = redirecturlpath;


    swal("Want To Archive?", {
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
                    rowid: rowid,
                    modelClassName: modelClassName
                },
                type: 'post',
                dataType: 'json',
                success: function (response) {
                   
                    $("#notification").removeClass("alert-success").removeClass("alert-danger").hide();
                    if (response.status == 'success') {
                        $("#notification").addClass("alert-success").html( response.message).show();
                    } else {
                        $("#notification").addClass("alert-danger").html( response.message).show();
                    }
                    //setTimeout(function(){});
                }
            });
        }
        return false;
    });
}




function confirmationdelete(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
    console.log(urlToRedirect); // verify if this is the right URL
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this Tender file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      // redirect with javascript here as per your logic after showing the alert using the urlToRedirect value
      if (willDelete) {
        window.location.href = urlToRedirect;
      } else {
       // swal("Your imaginary file is safe!");
      }
    });
    }

    function confirmationarchive(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL

        debugger;
        swal({
          title: "Are you sure to want to Archive?",
         
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          // redirect with javascript here as per your logic after showing the alert using the urlToRedirect value
          if (willDelete) {
            window.location.href = urlToRedirect;
          } else {
           // swal("Your imaginary file is safe!");
          }
        });
        }




        

function archiveTemp(
    formId,
    resetbtn,
    effect_from_date,
    effect_to_date,
    month,
    year,
    form_submit_btn,
    elink,
    dlink,
    alink,
    from_and_to_date_container,
    datepickerIcon,
    tender_archive_baseurl,
    model,
    tableId
    
    
    
    
    ){
   
        let formEl = $(`#${formId}`)
        // reset
        formEl.find("." +resetbtn).on('click', function(event) {

            event.preventDefault();
            formEl.find("."+ effect_from_date).val("");
            formEl.find("."+ effect_to_date).val("");
            formEl.find("."+ month).val("All");

            formEl.find("."+ form_submit_btn).trigger('click');

        });


        formEl.find("."+ form_submit_btn).on('click', function(event) {

            event.preventDefault();


            $('#example').dataTable().fnDestroy();



            var baseurl = tender_archive_baseurl;
            


            var formData = {
                year: $("."+year + " option:selected").text(),
                month: $("."+month + " option:selected").text(),
                elink: $("."+ elink).val(),
                dlink: $("."+ dlink).val(),
                alink: $("."+ alink).val(),
                effect_from_date: $("."+ effect_from_date).val(),
                effect_to_date: $("."+ effect_to_date).val(),
                model : model,
            };


            // dbshow(formData);

            var table = $('#example').DataTable({
                "ajax": {
                    'type': 'POST',
                    'url': baseurl,
                    data: formData,
                },
                'columnDefs': [{
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }

                }],
                'order': [
                    [2, 'desc']
                ],
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                //             "aoColumns" : [
                //     { sWidth: '5px' },
                //     { sWidth: '100px' },
                //     { sWidth: '120px' },
                //     { sWidth: '25px' },
                //     { sWidth: '25px' },

                //     { sWidth: '0px' },
                //     { sWidth: '100px' },
                // ]  ,




                //fixedColumns: true,
                'responsive': true
            });

            table.clear().draw();



        });
        formEl.find("."+ form_submit_btn).trigger('click');
        // tender_year 
       

            formEl.find("."+ year).on('change', function(e) {


            let year = $(this).val();
            let monthoutput = formEl.find("."+ month).val();

            // let monthvalue = month == 'All' ?'01':month;
            //month == 'All' ?'01':month;

            if (monthoutput == 'All') {

                monthvalue = '01';

                formEl.find("#"+ from_and_to_date_container).hide();
              




            } else {
                formEl.find("#"+ from_and_to_date_container).show();

                monthvalue = monthoutput;

                formEl.find("."+ effect_from_date).datepicker("setDate", `01-${monthvalue}-${year}`);
                formEl.find("."+ effect_to_date).datepicker("setDate", `01-${monthvalue}-${year}`);


                console.log(`01-${monthvalue}-${year}`)

            }



        });
        // tender_month 

        console.log( formEl.find("."+ year).val());
        formEl.find("."+ month).on('change', function(e) {
            debugger;
            let month = $(this).val();
            let yearvalue = formEl.find("."+ year).val();
            if (month == 'All') {
                monthvalue = '01';
                formEl.find("#"+ from_and_to_date_container).hide();

            } else {
                debugger;
                formEl.find("#"+ from_and_to_date_container).show();
                monthvalue = month;
                formEl.find("."+ effect_from_date).datepicker("setDate", `01-${monthvalue}-${yearvalue}`);
                formEl.find("."+ effect_to_date).datepicker("setDate", `01-${monthvalue}-${yearvalue}`);

                console.log(`01-${monthvalue}-${yearvalue}`)
            }

        });
   



    $.datepicker.setDefaults({
        showOn: "button",
        buttonImage: datepickerIcon,

        buttonText: "Date Picker",
        buttonImageOnly: true,
        dateFormat: 'dd-mm-yy'
    });
    var fromDateUIPicker;
    var toDateUIPicker;
    $(function() {

        fromDateUIPicker =  formEl.find("."+ effect_from_date).datepicker({
                changeMonth: true,
                changeYear: true,
                // yearRange: '2020:+0'
            }


        );
        toDateUIPicker = formEl.find("."+ effect_to_date).datepicker({
            changeMonth: true,
            changeYear: true,
            // yearRange: '2020:+0'
        });
    });
}
    







