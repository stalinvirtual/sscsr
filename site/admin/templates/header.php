<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Selection Commision</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/dist/css/font.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/dist/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <!-- <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/plugins/jqvmap/jqvmap.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/dist/css/adminlte.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $this->theme_url; ?>/dist/css/custom.css">





    <!--<script src="<?php //echo $this->theme_url; 
                        ?>/dist/js/custom.js"></script>-->









</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo $this->theme_url; ?>/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="#"><i class="fa fa-globe" aria-hidden="true"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->


                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->

                <!-- login-->
                <?php
                //echo '<pre>';
                //print_r($logged_user);

                ?>
                <li class="nav-item dropdown user user-menu">

                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $this->theme_url; ?>/dist/img/admin.png" class="user-image img-circle elevation-2 alt=" User Image">
                        <span class="hidden-xs"><?php echo $logged_user['username']; ?></span>
                        <span class="hidden-xs">(<?php echo $logged_user['rolename']; ?>)</span>


                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->

                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">

                            <div class="row">
                                <div class="col-3 text-center">

                                </div>
                                <div class="col-6 text-center">
                                    <a href="<?php echo $this->route->site_url("Admin/logout"); ?>" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                                <div class="col-3 text-center">

                                </div>

                            </div>


                            <!-- <div class="pull-left">
<a href="#" class="btn btn-default btn-flat">Profile</a>
</div>
<div class="pull-right">
<a href="#" class="btn btn-default btn-flat">Sign out</a>
</div> -->
                        </li>
                    </ul>
                </li>
                <!-- Login -->

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">

                Staff Selection Commision
                <!-- <img src="<?php echo $this->theme_url; ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
<span class="brand-text font-weight-light">AdminLTE 3</span> -->
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-header">Dashboard</li>
                        <?php if (@$is_superadmin == 1 || @$is_admin == 1) { ?>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Menu
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php echo $published_menus_list_link;
                                                    ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View Published</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $unpublished_menus_list_link;
                                                    ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View Unpublished </p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Page
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php echo $published_pages_list_link;
                                                    ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Page Published</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $unpublished_pages_list_link;
                                                    ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Page Unpublished </p>
                                        </a>
                                    </li>

                                </ul>
                            </li>


                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Menu Reorder
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php echo $menus_reorder_link;
                                                    ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Main-Menus Reorder</p>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="<?php //echo $sub_menus_reorder_link;
                                                    ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Sub-Menus Reorder </p>
                                        </a>
                                    </li> -->


                                    <li class="nav-item">
                                        <a href="<?php echo $sub_menus_reorder_link_new;
                                                    ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Sub-Menus Reorder </p>
                                        </a>
                                    </li>

                                </ul>
                            </li>


                        <?php } ?>

                        <!--<li class="nav-item">
                                <a href="<?php //echo $list_page_link; 
                                            ?>" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Page

                                    </p>
                                </a>
      
                            </li>-->

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Nomination
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="<?php echo $list_nomination_link; ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nomination </p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="<?php //echo $nomination_archieves;
                                                ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nomination Archieves</p>
                                    </a>
                                </li> -->

                            </ul>
                        </li>

                        <!-- <li class="nav-item">
                            <a href="<?php //echo $list_nomination_link;
                                        ?>" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Nomination

                                </p>
                            </a>
                        </li> -->


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Selection Post
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="<?php echo $list_selection_posts_link;
                                                ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Selection Post </p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="<?php //echo $sp_archieves_by_month;
                                                ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Selection Post Archieves</p>
                                    </a>
                                </li> -->

                            </ul>
                        </li>








                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Photo Gallery
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="<?php echo $event_category_link;
                                                ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Event Category </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $gallery_link;
                                                ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Gallery</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $list_debarred_lists_link;
                                        ?>" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Debarred Lists

                                </p>
                            </a>
                        </li>
                        <?php if ((@$is_superadmin == 1)) { ?>
                            <li class="nav-item">
                                <a href="<?php echo $list_of_login_user_details;
                                            ?>" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        User Creation

                                    </p>
                                </a>

                            </li>
                        <?php } ?>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Category
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="<?php echo $category_link;
                                                ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $category_reorder_nomination_link;
                                                ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nomination Reorder </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $category_reorder_sp_link;
                                                ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Selection Post Reorder </p>
                                    </a>
                                </li>

                            </ul>
                        </li>



                        <!-- <li class="nav-item">
                                <a href="<?php //echo $category_link;
                                            ?>" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Category

                                    </p>
                                </a>

                            </li> -->
                        <!--  # Faq--->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Extra Menu
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <!-- <li class="nav-item">
                                    <a href="<?php echo $notice_link;
                                                ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Notice</p>
                                    </a>
                                </li> -->

                                <!-- Notice Div-->
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-edit"></i>
                                        <p>
                                            Notice
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <li class="nav-item">
                                            <a href="<?php echo $notice_link;
                                                        ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Notice </p>
                                            </a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a href="<?php //echo $notices_archieves_by_month;
                                                        ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Notice Archieves</p>
                                            </a>
                                        </li> -->

                                    </ul>
                                </li>
                                <!-- Notice Div-->







                                <li class="nav-item">
                                    <a href="<?php echo $list_of_faq;
                                                ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>FAQ </p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!--  Faq--->

                        <!-- Tender Div-->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Tender
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="<?php echo $list_of_tenders;
                                                ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tender </p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="<?php echo $tender_archieves_by_month;
                                                ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tender Archieves</p>
                                    </a>
                                </li> -->
                            </ul>
                        </li>
                        <!-- Tender Div-->
                        <?php if (@$is_superadmin == 1 || @$is_admin == 1) { ?>
                        <li class="nav-item">
                            <a href="<?php echo $important_link;
                                        ?>" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Important Links

                                </p>
                            </a>

                        </li>
                        <?php } ?>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <style>
            .preloader {
                display: none !important;
            }
        </style>