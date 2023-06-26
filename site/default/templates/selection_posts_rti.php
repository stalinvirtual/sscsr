<?php
echo $this->get_header();
?>
<style>
    .scroll-table1 {
        overflow-x: hidden !important;
        padding-bottom: 0px;
        margin-bottom: 22px;
    }

    .pdfanchorclass {
        color: blue;
        text-decoration: underline;

    }
</style>
<!--/.nav-wrapper-->
<div class="wrapper" id="skipCont"></div>
<!--/#skipCont-->
<section id="fontSize" class="wrapper body-wrapper ">
    <div class="container body-container top-body-container padding-top-bott2">
        <ul class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li>Selection Posts</li>
        </ul>
        <br>
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="selectionpostsTbl" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name of the Post</th>
                                        <th>Department name </th>
                                        <th>Post Name </th>
                                        <th>Category Name </th>
                                        <!-- <th>Phase Name </th> -->
                                        <!-- <th> status </th> -->
                                        <th>Pdf File</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


                                    foreach ($selectionposts as $sn => $selectionpost) :
                                        // $delete_selection_post_link_str = str_replace("{id}", $selectionpost->selection_post_id, $delete_selection_post_link);
                                        // $edit_selection_post_link_str = str_replace("{id}", $selectionpost->selection_post_id, $edit_selection_post_link);
                                        //$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
                                        // $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
                                    ?>
                                        <tr>
                                            <td><?= ++$sn; ?></td>
                                            <td><?= $selectionpost->exam_name ?></td>
                                            <td><?= $selectionpost->department_name ?></td>
                                            <td><?= $selectionpost->post_name ?></td>
                                            <td><?= $selectionpost->category_name ?></td>
                                            <td>
                                                <?php


                                                foreach ($selectpostschildlist as $key => $childlist) :
                                                    $selected = "";
                                                    if ($selectionpost->selection_post_id == $childlist->selection_post_id) {
                                                        $selected = "selected=\"selected\"";
                                                        $uploadPath = 'selectionposts' . '/' . $childlist->attachment;
                                                        $file_location = $this->route->get_base_url() . "/" . $uploadPath; ?>

                                                        <a class="pdfanchorclass" href="<?= $file_location ?>" target="_blank"><?= $childlist->pdf_name ?></a>,<br>
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
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div> <!-- body container div end-->







    <div class="wrapper home-btm-slider">
        <div class="container gallery-container">
            <div class="gallery-area clearfix">
                <div class="gallery-heading">
                    <h3>Photo Gallery</h3>
                    <a class="bttn-more bttn-view" href="inner.php"><span>View All</span></a>
                </div>
                <div class="gallery-holder">
                    <div id="galleryCarousel" class="flexslider">
                        <ul class="slides">
                            <li data-thumb="theme/images/crousal/1.jpg" data-thumb-alt="Slide 1"><img src="theme/images/crousal/1.jpg" alt="Carousal image 1" />
                                <div class="slide-caption">Description of the Photo goes here</div>
                            </li>

                            <li data-thumb="theme/images/crousal/1.jpg" data-thumb-alt="Slide 2"><img src="theme/images/crousal/1.jpg" alt="Carousal image 2" />
                                <div class="slide-caption">Description of the Photo goes here</div>
                            </li>

                            <li data-thumb="theme/images/crousal/1.jpg" data-thumb-alt="Slide 3"><img src="theme/images/crousal/1.jpg" alt="Carousal image 3" />
                                <div class="slide-caption">Description of the Photo goes here</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="ebook-maincontainer">
                <div class="youtube-video image-video">
                    <img width="300" height="480" class="image-video" src="theme/images/video.jpg" alt="video gallery placeholder">
                </div>
                <div class="video_link  mar-bott">
                    <a href="">
                        <div class="video-icon"><i class="fa fa-film"></i></div>
                        <div class="video-text">Video Gallery</div>
                    </a>
                </div>


                <div class="ebook-container">
                    <div class="publication">
                        Information about Publication goes here.
                    </div>
                    <div class="pub-btn  mar-bott">
                        <a href="">
                            <div class="video-icon"><i class="fa fa-copy"></i></div>
                            <div class="video-text">Publication</div>
                        </a>
                    </div>
                    <!-- <div class="new-text">
          <small>Journal of the
          National Human Rights Commission, 2017 </small>
          <p class="subscibe-now">Publications</p>
          </div>-->
                </div>
            </div>


        </div>
    </div>



</section>
<!--/.body-wrapper-->
<!--/.banner-wrapper-->
<!--/.body-wrapper-->
<!--/.banner-wrapper-->

<?php echo $this->get_footer(); ?>