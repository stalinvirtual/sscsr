<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <br>

                <div class="card-body">


                    <select class="form-control" id="submenu_reorder">
                    </select>

                    <br>

                    <div class="table-resposive">
                        <table class="table table-striped table-bordered">
                            <thead style="cursor: all-scroll;">
                                <tr>
                                    <th>Sub-Menu Name</th>
                                    
                                   <th>Menu Order</th>
                                </tr>
                            </thead>
                            <tbody class="submenutblbody" style="cursor: all-scroll;"></tbody>
                        </table>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    //for submenu reordering

    $(function() {

        load_submenudata(menu_id = 0);
        // var baseurl = '<?php //echo $this->route->site_url("Admin/ajaxresponsesubmenuordernew"); ?>';

        // $('.submenutblbody').sortable({
        //     placeholder: "ui-state-highlight",
        //     update: function(event, ui) {

        //         var page_id_array = new Array();
        //         $('.submenutblbody tr').each(function() {
        //             page_id_array.push($(this).attr('id'));
        //         });

        //         $.ajax({
        //             url: baseurl,
        //             method: "POST",
        //             data: {
        //                 page_id_array: page_id_array,
        //                 action: 'update'
        //             },
        //             success: function() {
        //                 load_submenudata();
        //             }
        //         })
        //     }
        // });
    });

    function load_submenudata(menu_id) {

     

        if(menu_id !=0){

            menu_id = menu_id;

        }

        var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponsesubmenuordernew"); ?>';
        $.ajax({
            url: baseurl,
            method: "POST",
            data: {
                action: 'fetch_data',
                menu_id: menu_id
            },
            // dataType: 'json',
            success: function(data) {
               // debugger;
                $("#submenu_reorder").html(data);
            }
        })
    }

    $('#submenu_reorder').on('change', function() {
        var menu_id = this.value;
        if(menu_id==""){
            load_submenudata(menu_id);
            $('.submenutblbody').html("");
        }
        else{
            load_submenudatabyid(menu_id);
           // submenutblbody 
        }
        //debugger;

        
       
    });
    function load_submenudatabyid(menu_id) {

var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponsesubmenuordernewbyId"); ?>';
$.ajax({
    url: baseurl,
    method: "POST",
    data: {
        action: 'fetch_data',
        id:menu_id
    },
     dataType: 'json',
    success: function(data) {
       // $("#submenu_reorder").html(data);

     
        //debugger;
        var html = '';
        for (var count = 0; count < data.length; count++) {
            html += '<tr id="' + data[count].id + '">';
            html += '<td>' + data[count].menu_name + '</td>';
           html += '<td>' + data[count].menu_order + '</td>';
            html += '</tr>';
        }
        $('.submenutblbody').html(html);

        load_submenudata(menu_id);


        $('.submenutblbody').sortable({
            placeholder: "ui-state-highlight",
            update: function(event, ui) {

                var page_id_array = new Array();
                $('.submenutblbody tr').each(function() {
                    page_id_array.push($(this).attr('id'));
                });

                $.ajax({
                    url: baseurl,
                    method: "POST",
                    data: {
                        page_id_array: page_id_array,
                        action: 'update'
                    },
                    success: function() {
                        load_submenudatabyid(menu_id);

                        
                    }
                })
            }
        });
    }
})
}
</script>

<style>
    .fa-angle-down {
        display: none !important;
    }
</style>