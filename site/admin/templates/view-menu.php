<?php echo $this->get_header();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">

                        <?php

                        // if ($is_admin && @$_GET['action'] == 'listpage') {
                        //     echo 'Page Creation ';
                        // } elseif ($is_admin) {
                        //     echo 'Menu Creation ';
                        // } else {
                        //     echo 'View Published';
                        // }

                        ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
    // echo '<pre>';
    // print_r($_SESSION);
    ?>

    <!-- Main content -->
    <section class="content">
        <?php if (isset($message_type)) : ?>
            <div class="alert alert-<?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">

                    <!-- general form elements -->



                    <!-- /.card -->

                    <!-- Horizontal Form -->

                    <div class="card card-info">

                        <div class="card-header">

                            <h3 class="card-title">View Form</h3>

                        </div>
                        <div class="card-body">
                            <?php
                            if ($_SESSION['user']['roleid'] == 1) {
                                echo '<button class="btn btn-success pull-right publish-button"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Publish</button>';
                            }
                            ?>
                            <a href="<?php echo $this->route->site_url("admin/dashboard/?action=listmenus"); ?>" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-eye-open"></span> Back </a>
                            <br>
                            <div class="form-group row" style="margin-top: 10px;">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Menu Name: </label>
                                <div class="col-sm-10">
                                    <p class="form-control"><?= $current_menu['menu_name'] ?></p>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top: 10px;">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Menu Link: </label>
                                <div class="col-sm-10">
                                    <p class="form-control"><?= $current_menu['menu_link'] ?></p>
                                </div>
                            </div>


                            <input type="hidden" id="menuid" value=<?= $current_menu['id'] ?> </div>


                            <!-- /.card-header -->

                            <!-- form start -->



                        </div>

                        <!-- /.card -->



                    </div>

                    <!--/.col (left) -->

                    <!-- right column -->



                    <!-- /.row -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>





    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
<?php echo $this->get_footer(); ?>