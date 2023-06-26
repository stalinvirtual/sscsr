<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
				
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="table-resposive">
                        <table class="table table-striped table-bordered">
                            <thead style="cursor: all-scroll;">
                                <tr>
                                    <th>Menu Name</th>
                                    <th>Menu Order</th>
                                </tr>
                            </thead>
                            <tbody style="cursor: all-scroll;"></tbody>
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

	// for mainmenu reordering
	
	 $(function() {
        //menu reorder
        load_data();
        var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponsemenuorder"); ?>';

        $('tbody').sortable({
            placeholder: "ui-state-highlight",
            update: function(event, ui) {

                var page_id_array = new Array();
                $('tbody tr').each(function() {
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
                        load_data();
                    }
                })
            }
        });
    });

    function load_data() {

        var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponsemenuorder"); ?>';
        $.ajax({
            url: baseurl,
            method: "POST",
            data: {
                action: 'fetch_data'
            },
            dataType: 'json',
            success: function(data) {
                var html = '';
                for (var count = 0; count < data.length; count++) {
                    html += '<tr id="' + data[count].id + '">';
                    html += '<td>' + data[count].menu_name + '</td>';
                    html += '<td>' + data[count].menu_order + '</td>';
                    html += '</tr>';
                }
                $('tbody').html(html);
            }
        })
    }


</script>

<style>
.fa-angle-down{
	display:none !important;
}

</style>
