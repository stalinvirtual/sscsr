<section class="buttons">
		
		
		
		
		<br>
		<div class="container" id="main">
				<div class="row">
					<div class="col-lg-12">
					
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div style="margin-bottom:50px">
			<table id="tenderarchiveslistsTbl"class="table table-striped table-bordered" cellspacing="0" width="100%">
				
                <thead class="thead-dark">
                  <tr>
                   <th>Updated Date</th>
					<th>Tender Name</th>
					<th>Attachment</th>
					

                  </tr>
                </thead>
                <tbody>
                  <?php
				
                  foreach ($tenderarchiveslist as $sn => $tender) :

                    //$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
                    // $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
                  ?>
                    <tr>
                    
                     <td><?= date("d-m-Y", strtotime($tender->date_archived)); ?></td>
                      <td><?= $tender->pdf_name ?></td>
                      
					  
					
                      
					  <td>
					 <?php  $uploadPath = 'tender' . '/' . $tender->attachment;
                            $file_location = $this->route->get_base_url() . "/" . $uploadPath; ?>

                            <u><a class="pdfanchorclass" href="<?= $file_location ?>" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?= $tender->pdf_name ?></a><br>(<?= filesize_formatted($uploadPath)?>)</u>
					  </td>


                    </tr>
                  <?php endforeach; ?>
                  <?php //} 
                  ?>
                </tbody>

              </table>
						</div>
					</div>
					
				</div>
		</div>
		
		</section>

		<script>

		$(document).ready(function() {
	
	jQuery.extend( jQuery.fn.dataTableExt.oSort, {
  "ddMmYyyy-pre" : function(a) {
   	 a = a.split('/');
     if (a.length < 2) return 0;
     return Date.parse(a[2] + '-' + a[0] + '-' + a[1])
  },
  "ddMmYyyy-asc" : function ( a, b ) {
     return ((a < b) ? -1 : ((a > b) ? 1 : 0));
  },
  "ddMmYyyy-desc": function ( a, b ) {
     return ((a < b) ? 1 : ((a > b) ? -1 : 0));
  }
})    


	
	
   var table =  $('#tenderarchiveslistsTbl').DataTable( {
	   responsive: true,
		 "order": [[ 0, "desc" ]],
		 "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
      
    } );

	
	
	
} );



</script>
		