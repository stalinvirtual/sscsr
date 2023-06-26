<?php 
namespace App\Controllers; 
use App\Helpers\Helpers;

Helpers::urlSecurityAudit(); 
echo $this->get_header(); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Page Creation Form</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Advanced Form</li>
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

        <div class="col-md-10">

          <!-- general form elements -->



          <!-- /.card -->

          <!-- Horizontal Form -->

          <div class="card card-info">

            <div class="card-header">

              <h3 class="card-title">Page creation Form</h3>

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

                  <label for="inputEmail3" class="col-sm-2 col-form-label">Title : <span style='color:red'>*</span></label>

                  <div class="col-sm-10">
                    <input class="form-control" type="text" name="title" id="title" required value="<?php echo $current_page['title']; ?>">



                  </div>
                </div>
                
                 <!-- <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>  -->

                 

                <script src="https://cdn.ckeditor.com/4.19.0/standard-all/ckeditor.js"></script> 



                 

                <div class="form-group row">

                  <label for="inputEmail3" class="col-sm-2 col-form-label"> Page Content : <span style='color:red'>*</span></label>

                  <div class="col-sm-10">

                    <textarea class="form-control" type="text" name="page_content" required><?php echo $current_page['page_content']; ?>
                    </textarea>
                   
                    <script type="text/javascript">
                      
                      //CKEDITOR.replace('page_content');
                      CKEDITOR.addCss('.cke_editable { font-size: 15px; padding: 2em; }');


                      


                      CKEDITOR.replace('page_content', {
      toolbar: [{
          name: 'document',
          items: ['Print','Source','PageBreak']
        },
        {
          name: 'clipboard',
          items: ['Undo', 'Redo']
        },
        {
          name: 'styles',
          items: ['Format', 'Font', 'FontSize']
        },
        {
          name: 'colors',
          items: ['TextColor', 'BGColor']
        },
        {
          name: 'align',
          items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
        },
        '/',
        {
          name: 'basicstyles',
          items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting']
        },
        {
          name: 'links',
          items: ['Link', 'Unlink']
        },
        {
          name: 'paragraph',
          items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
          name: 'insert',
          items: ['Image', 'Table']
        },
        {
          name: 'tools',
          items: ['Maximize']
        },
        {
          name: 'editing',
          items: ['Scayt']
        }
      ],

      extraAllowedContent: 'h3{clear};h2{line-height};h2 h3{margin-left}',

      // Adding drag and drop image upload.
      extraPlugins: 'print,format,font,colorbutton,justify,uploadimage,colordialog,tableresize',
      uploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

      // Configure your file manager integration. This example uses CKFinder 3 for PHP.
         filebrowserUploadUrl:'<?php echo $list_ckeditor_link_file;?>',
         filebrowserImageUploadUrl: '<?php echo $list_ckeditor_link_image;?>',
         filebrowserUploadMethod: 'form',

      height: 200,

      removeDialogTabs: 'image:advanced;link:advanced',
      removeButtons: 'PasteFromWord'
    });







                      // CKEDITOR.replace('page_content', {
                      //   extraPlugins: 'editorplaceholder',
                      //   editorplaceholder: 'Start typing here...',
                      //   removeButtons: 'PasteFromWord',
                      //   filebrowserUploadUrl:'<?php echo $list_ckeditor_link_file;?>',
                      //   filebrowserImageUploadUrl: '<?php echo $list_ckeditor_link_image;?>',
                      //   filebrowserUploadMethod: 'form',
                           
                      // });
                     // CKEDITOR.config.extraPlugins = 'colorbutton';
                    </script>
                    


                  </div>

                </div>
				
				

                <div class="form-group row" style="display:none">

                  <label for="inputEmail3" class="col-sm-2 col-form-label"> Category : <span style='color:red'>*</span></label>

                  <div class="col-sm-10">

                    <select name="category_id" class="form-control">
                      <?php foreach ([1 => 'Root'] as $key => $value) :
                        $selected = "";
                        if ($current_page['category_id']  == $key) {
                          $selected = "selected=\"selected\"";
                        }
                      ?>
                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                      <?php endforeach; ?>
                    </select>

                    <!--<input class="form-control" type="text" name="category_id" required value="<?php echo $current_page['category_id']; ?>">-->

                  </div>

                </div>

                <div class="form-group row" style="display:none">

                  <label for="inputEmail3" class="col-sm-2 col-form-label"> Language Code:<span style='color:red'>*</span></label>

                  <div class="col-sm-10">
                    <select name="language_code" class="form-control">
                      <?php foreach (['en' => 'English', 'hi' => 'Hindi'] as $key => $value) :
                        $selected = "";
                        if ($current_page['language_code']  == $key) {
                          $selected = "selected=\"selected\"";
                        }
                      ?>
                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <!-- <input class="form-control" type="text" name="language_code" required value="<?php echo $current_page['language_code']; ?>">-->


                  </div>

                </div>
                <div class="form-group row" style="display:none">

                  <label for="inputEmail3" class="col-sm-2 col-form-label"> Status:<span style='color:red'>*</span></label>

                  <div class="col-sm-10">
                    <select name="status" class="form-control">
                      <?php foreach ([0 => 'Unpublished', 1 => 'Published'] as $key => $value) :
                        $selected = "";
                        if ($current_page['status']  == $key) {
                          $selected = "selected=\"selected\"";
                        }
                      ?>
                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <!-- <input class="form-control" type="text" name="language_code" required value="<?php echo $current_page['language_code']; ?>">-->


                  </div>

                </div>
				
				
				

                 
                
                <!-- <div class="form-group row article-container">

                  <label for="inputEmail3" class="col-sm-2 col-form-label"> Article </label>

                  <div class="col-sm-10">
                    <select name="menu_type" class="form-control">
                      <option value="">Select Menu type</option>
                      <?php foreach ([1 => 'Pag1', 'pagw2', 'Page3'] as $key => $value) :
                        $selected = "";
                        if ($current_page['m_menu_article_id']  == $key) {
                          $selected = "selected=\"selected\"";
                        }
                      ?>
                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                      <?php endforeach; ?>
                    </select>

                  </div>

                </div> -->
                
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- <script src="<?php //echo $this->theme_url; ?>/dist/js/ckeditor.js"></script>  -->


            <!-- <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script> -->
                 


                <script>
                  jQuery(document).ready(function() {
                    jQuery("input[name='menu_type']").on('change', function() {
                      if (jQuery(this).val() == 1) {
                        jQuery(".article-container").show();
                      } else {
                        jQuery(".article-container").hide();
                      }
                    });
                    jQuery("input[name='menu_type']").trigger('change');

                  });
                </script>
                <input type="hidden" value="<?php echo $current_page['page_id']; ?>" name="page_id">

              </div>

              <!-- /.card-body -->

              <div class="card-footer">

                <input type="submit" class="btn btn-info" name="save-page" value="submit">
                <input type="button" class="btn btn-default float-right" onclick="history.back();" value="Cancel">



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