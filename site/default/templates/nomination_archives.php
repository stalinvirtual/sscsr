<?php
function filesize_formatted($path){
	$size = filesize($path);
	$units = array(
		'B',
		'KB',
		'MB',
		'GB',
		'TB',
		'PB',
		'EB',
		'ZB',
		'YB'
	);
	$power = $size > 0 ? floor(log($size, 1024)) : 0;
	return number_format($size / pow(1024, $power) , 2, '.', ',') . ' ' . $units[$power];
}
?>
<section class="buttons">
		
	
		
		<div class="container category_btn">
			<div class="btn-group btn-group-toggle" data-toggle="buttons">
				<label class="btn btn-secondary active">
				  <input type="radio" class="customRadioButton" id="ALL" name="searchRadio" value="" autocomplete="off" checked> All
				</label>
				
				<?php foreach ($categorylist as $sn => $category) :?>
					<label class="btn btn-secondary" for="<?= $category->category_name ?>">
						<input class="customRadioButton " id="<?= $category->category_name ?>" name="searchRadio" value="<?= $category->category_name ?>"  type="radio"><?= $category->category_name ?>
					</label>
				<?php endforeach; ?>
			
			</div>
		</div>
		
		<div class="container-fluid" id="main">
				<div class="row">
					<div class="col-lg-12">
					
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div style="margin-bottom:50px">
			<table id="nominationTbl"class="table table-striped table-bordered" cellspacing="0" width="100%">
				
                <thead class="thead-dark">
                  <tr>
                   <th>Uploaded Date</th>
					<th>Examination Name and Year</th>
					<th>Category Name </th>
					<th>Nomination Lists</th>
					

                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($nominations as $sn => $nomination) :

                    //$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
                    // $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
                  ?>
                    <tr>
                    
                     <td><?= date("d-m-Y", strtotime($nomination->date_archived)); ?></td>
                      <td><?= $nomination->exam_name ?></td>
                      <td><?= $nomination->category_name ?></td>
					  
					
                      <td>
                        <?php


                        foreach ($nominationchildlist as $key => $childlist) :
                          $selected = "";
                          if ($nomination->nomination_id == $childlist->nomination_id) {
                            $selected = "selected=\"selected\"";
                            $uploadPath = 'nominations' . '/' . @$childlist->attachment;
                            $file_location = $this->route->get_base_url() . "/" . $uploadPath; ?>

                            <u><a class="pdfanchorclass" href="<?= $file_location ?>" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?= $childlist->pdf_name ?>  </a> (<?= filesize_formatted($uploadPath)?>)</u><br>
                          <?php }


                          ?>

                        <?php endforeach; ?>




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
							
	
		


	