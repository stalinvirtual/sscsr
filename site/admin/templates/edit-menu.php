<?php 
namespace App\Controllers; 
use App\Helpers\Helpers;

//Helpers::urlSecurityAudit();
 echo $this->get_header();
 
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Menu Creation Form </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Menu Creation </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content   section div start -->
  <!-- Main content -->

  <section class="content">

    <div class="container-fluid">

      <div class="row">

        <!-- left column -->

        <div class="col-md-8">

          <!-- general form elements -->



          <!-- /.card -->

          <!-- Horizontal Form -->

          <div class="card card-info">

            <div class="card-header">

              <h3 class="card-title">Menu creation Form</h3>

            </div>

            <!-- /.card-header -->

            <!-- form start -->

            <!-- <form class="form-horizontal" method="post" enctype="multipart/form-data">

                  <div class="card-body">

                    <div class="form-group row">

                      <label for="inputEmail3" class="col-sm-2 col-form-label">Menu Name:<span style='color:red'>*</span></label>

                      <div class="col-sm-10">

                        <input class="form-control" type="text" name="menu_name" required>

                      </div>

                    </div>

                    <div class="form-group row">

                      <label for="inputEmail3" class="col-sm-2 col-form-label">Menu Link : <span style='color:red'>*</span></label>

                      <div class="col-sm-10">

                        <input class="form-control" type="text" name="menu_link" required>

                      </div>

                    </div>

                    <input type="hidden" value="<?= $user->id ?>" name="id">

                  </div>

                  <!-- /.card-body 

                <div class="card-footer">

                  <input type="submit" class="btn btn-info" name="add_main_menu" value="submit">
                </div>

                <!-- /.card-footer 

                </form> -->



            <form class="form-horizontal" method="post" enctype="multipart/form-data">

              <div class="card-body">
				<div class="form-group row">

                  <label for="inputEmail3" class="col-sm-4 col-form-label"> Is Footer Menu:<span style='color:red'>*</span></label>

                  <div class="col-sm-8">
                    <select name="is_footer_menu" class="form-control" onchange="getval(this);">
                      <?php
                      foreach (['false' => 'No','true' =>  'Yes'] as $key => $value) :

                        //foreach ([1 => 'Page', 'Internal', 'External', 'Pdf'] as $key => $value) :
                        $selected = "";
                        if ($current_menu['is_footer_menu']  == $key) {
                          $selected = "selected=\"selected\"";
                        }
                      ?>
                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                      <?php endforeach; ?>
                    </select>

                  </div>

                </div>
                <div class="form-group row">

                  <label for="inputEmail3" class="col-sm-4 col-form-label"> Menu Type:<span style='color:red'>*</span></label>

                  <div class="col-sm-8">
                    <select name="menu_type" class="form-control">
                      <?php
                      foreach ([1 => 'Page', 'External', 'Pdf', 'Dropdown'] as $key => $value) :

                        //foreach ([1 => 'Page', 'Internal', 'External', 'Pdf'] as $key => $value) :
                        $selected = "";
                        if ($current_menu['menu_type']  == $key) {
                          $selected = "selected=\"selected\"";
                        }
                      ?>
                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                      <?php endforeach; ?>
                    </select>

                  </div>

                </div>
                <div class="form-group row menulinkDiv">

                  <label for="inputEmail3" class="col-sm-4 col-form-label"> Link : <span style='color:red'>*</span></label>

                  <div class="col-sm-8">

                    <input class="form-control" type="text" name="menu_link" id="menu_link" value="<?php echo $current_menu['menu_link']; ?>">

                  </div>

                </div>
				
				<?php

					if($current_menu['is_redirect_popup'] == 1){
									
					?>
									
											
										
						<div class="form-group row redirectpopup">

                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Is Goverment site Link : <span style='color:red'>*</span></label>

                                    <div class="col-sm-8">
										 <input type="checkbox" id="is_redirect_popup" name="is_redirect_popup"  checked>
                                    </div>
                                </div>
										
									<?php }else{ ?>
									
									  <div class="form-group row redirectpopup">

                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Is Goverment site Link: <span style='color:red'>*</span></label>

                                    <div class="col-sm-8">
										 <input type="checkbox" id="is_redirect_popup" name="is_redirect_popup" >
                                    </div>
                                </div>
										
								<?php	}
									
								?>
				
                <div class="form-group row attachmentDiv" style="display:none">

                  <label for="inputPassword3" class="col-sm-4 col-form-label">Attachment: <span style='color:red'>*</span></label>

                  <div class="col-sm-8">
                    <?php


                    $singleFile = $current_menu['attachment'];
                    $uploadPath = 'uploads' . '/' . $singleFile;


                    $file_location = $this->route->get_base_url() . "/"  . $uploadPath;

                    ?>
                    <input class="form-control" type="file" name="attachment">
					 <input name="pdflink" value="<?= $current_menu['attachment'] ?>" type="hidden"/>
                    <td><a  href="<?= $file_location ?>" target="_blank"><?= $current_menu['attachment'] ?></a></td>

                    <!-- <input type=" hidden" name="MAX_FILE_SIZE" value="300000" /> -->

                  </div>

                </div>
                <div class="form-group row page-container pageContainer">

                  <label for="inputEmail3" class="col-sm-4 col-form-label"> Page <span style='color:red'>*</span></label>

                  <div class="col-sm-8">
                    <select name="menu_page_id" class="form-control">
                      <option value="">Select Page</option>
                      <?php
                      foreach ($pages as $key => $page) :
                        $selected = "";
                        if ($current_menu['menu_page_id']  == $page->page_id) {
                          $selected = "selected=\"selected\"";
                        }
                      ?>
                        <option <?php echo $selected; ?> value="<?php echo $page->page_id; ?>"><?php echo $page->title; ?></option>
                      <?php endforeach; ?>
                    </select>

                  </div>

                </div>

                <div class="form-group row">

                  <label for="inputEmail3" class="col-sm-4 col-form-label"> Parent Menu:</label>

                  <div class="col-sm-8 " id="stalin">
                    <?php
                    if ($is_superadmin == 1) { ?>
                      <select name="menu_parent_id" class="form-control" id="menu_parent_id">
                        <option value='0'>select parent menu</option>
                        <?php echo $renderedMenuOptions; ?>
                      </select>
                    <?php  } else if (@$is_admin == 1) { ?>

                      <select name="menu_parent_id" class="form-control" id="menu_parent_id">
                      <option value="0">Parent Menu</option>

                        <?php echo $renderedMenuOptions; ?>
                      </select>

                    <?php  }

                    $t = preg_replace('/(^[\"\']|[\"\']$)/', '', $renderedMenuOptions);
                    $t= html_entity_decode($t);
                    ?>



                  </div>
                </div>

                <div class="form-group row">

                  <label for="inputEmail3" class="col-sm-4 col-form-label"> Menu Name:<span style='color:red'>*</span></label>

                  <div class="col-sm-8">

                    <input class="form-control" type="text" name="menu_name" id="menu_name" required value="<?php echo strip_tags($current_menu['menu_name']); ?>">

                  </div>

                </div>


                <?php //echo '<pre>';
                //print_r($current_menu);
                ?>



                <div class="form-group row route-container">

                  <label for="inputEmail3" class="col-sm-4 col-form-label"> Route ( Ex: ControllerName/Method) </label>

                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="menu_route" value="<?php echo $current_menu['menu_route']; ?>">


                  </div>

                </div>

  <input class="form-control" type="hidden" name="id" value="<?php echo $current_menu['id']; ?>">

              

              </div>

              <!-- /.card-body -->

              <div class="card-footer">

                <input type="submit" class="btn btn-info" name="save-menu" value="submit">
                <input type="button" class="btn btn-default float-right" onclick="history.back();"" value="Cancel">
				
				 



              </div>

              <!-- /.card-footer -->

            </form>
            <!-- <button class="btn btn-default float-right" onclick="goBack()">Cancel</button> -->




          </div>

          <!-- /.card -->



        </div>

        <!--/.col (left) -->

        <!-- right column -->



        <!-- /.row -->

      </div><!-- /.container-fluid -->

  </section>

  <!-- Main content section div end -->
</div>
<?php echo $this->get_footer(); ?>
<style>
.fa-angle-down{
	display:none !important;
}

</style>
<script>

function getval(sel)
{
 
  if(sel.value =="true"){

    var  myElement  = document.getElementById("menu_parent_id");

 var test = document.getElementById("stalin");
 myElement.remove();
const node = document.createElement("select");
var option = document.createElement("option");
node.setAttribute("name", "menu_parent_id");
node.setAttribute("class", "form-control");

node.setAttribute("id", "menu_parent_id");
option.value = "0";
option.text ="select parent menu";
node.add(option);

document.getElementById("stalin").appendChild(node);

  }
  else{

    var  myElement  = document.getElementById("menu_parent_id");
    myElement.remove();
   
 // Create an "li" node:
const node = document.createElement("select");
var option = document.createElement("option");
node.setAttribute("name", "menu_parent_id");
node.setAttribute("class", "form-control");
node.setAttribute("id", "menu_parent_id");
option.value = "0";
option.text ="select parent menu";
node.add(option);
document.getElementById("stalin").appendChild(node);
var menus = '<?php echo $t; ?>';
$( "#menu_parent_id" ).append( menus );

  }
}


</script>

