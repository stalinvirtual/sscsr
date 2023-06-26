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

        <div class="col-md-8">

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

                  <label for="inputEmail3" class="col-sm-2 col-form-label">Name:<span style='color:red'>*</span></label>

                  <div class="col-sm-10">

                    <input class="form-control" type="text" name="fname" required value="<?php echo $current_candidate['fname']; ?>">

                  </div>

                </div>

                <div class="form-group row">

                  <label for="inputEmail3" class="col-sm-2 col-form-label">Email : <span style='color:red'>*</span></label>

                  <div class="col-sm-10">

                    <input class="form-control" type="email" name="email" required value="<?php echo $current_candidate['email']; ?>">

                  </div>

                </div>

                <div class=" form-group row">

                  <label for="inputEmail3" class="col-sm-2 col-form-label">Mobile No : <span style='color:red'>*</span></label>

                  <div class="col-sm-10">

                    <input class="form-control" type="text" name="mobile_no" required value="<?php echo $current_candidate['mobile_no']; ?>">

                  </div>

                </div>

                <div class="form-group row">

                  <label for="inputPassword3" class="col-sm-2 col-form-label">Announcement: <span style='color:red'>*</span></label>

                  <div class="col-sm-10">

                    <textarea rows="5" cols="5" class="form-control" name="address" required><?php echo $current_candidate['address']; ?></textarea>

                  </div>

                </div>

                <div class="form-group row">

                  <label for="inputPassword3" class="col-sm-2 col-form-label">Attachment: <span style='color:red'>*</span></label>

                  <div class="col-sm-10">
                    <?php
                    $singleFile = $current_candidate['attachment'];
                    $uploadPath = 'uploads' . '/' . $singleFile;


                    //echo $actual_link;
                    // $x = pathinfo($actual_link);
                    $file_location = $this->route->get_base_url() . "/"  . $uploadPath;
                    // echo $file_location;
                    ?>
                    <input class="form-control" type="file" name="attachment" required>
                    <td><a href="<?= $file_location ?>" target="_blank"><?= $current_candidate['attachment'] ?></a></td>

                    <!--<input class="form-control" type="file" name="attachment" required value="<?php echo $current_candidate['attachment']; ?>>-->

                    <!-- <input type=" hidden" name="MAX_FILE_SIZE" value="300000" /> -->

                  </div>

                </div>

                <input type="hidden" value="<?= $current_candidate['id'] ?>" name="id">

              </div>

              <!-- /.card-body -->

              <div class="card-footer">

                <input type="submit" class="btn btn-info" name="save-candidate" value="submit">

                <button class="btn btn-default float-right" onclick="goBack()">Cancel</button>

              </div>

              <!-- /.card-footer -->

            </form>

            <button class="btn btn-default float-right" onclick="goBack()">Cancel</button>




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