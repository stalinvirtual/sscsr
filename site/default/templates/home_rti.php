<?php
echo $this->get_header();
?>
<div class="wrapper" id="skipCont"></div>
<!--/#skipCont-->
<section id="fontSize" class="wrapper body-wrapper ">

    <div class="bg-wrapper top-bg-wrapper gray-bg padding-top-bott">
        <div class="container body-container top-body-container padding-top-bott2">
            <div class="minister clearfix for-mobile-top" style="float:right !important">
                <div class="pub-btn  mar-bott">
                    <a href="">
                        <div class="video-icon"><i class="fa fa fa-link"></i></div>
                        <div class="video-text">Important Links</div>
                    </a>
                </div>
                <div class="minister-box" style="float: none !important;">
                    <div>
                        <ul class="list">
                            <li>Link 1 goes here</li>
                            <li>Link 2 goes here</li>
                            <li>Link 3 goes here</li>
                            <li>Link 4 goes here</li>
                            <li>Link 5 goes here</li>
                            <li>Link 6 goes here</li>
                            <li>Link 7 goes here</li>
                            <li>Link 8 goes here</li>
                        </ul>
                        <a class="read-more" href="#">Read more</a>
                    </div>
                </div>
            </div>
            <div class="left-block">
                <div class="whats-new-maincontainer">
                    <div id="feedTab">
                        <ul class="resp-tabs-list feedTab_1 clearfix">
                            <li> <a href="inner.php"><i class="fa fa-newspaper-o"></i> Latest News</a></li>
                            <li> <a href="inner.php"><i class="fa fa-star"></i> Important Activities</a></li>
                        </ul>
                        <div class="resp-tabs-container feedTab_1">
                            <div>
                                <ul class="list">
                                    <marquee direction="up" onmouseover="stop()" onmouseout="start()" scrolldelay="10">
                                        <li>Information about Latest Update 1 goes here</li>
                                        <li>Information about Latest Update 2 goes here</li>
                                        <li>Information about Latest Update 3 goes here</li>
                                        <li>Information about Latest Update 4 goes here</li>
                                        <li>Information about Latest Update 5 goes here</li>
                                        <li>Information about Latest Update 6 goes here</li>
                                        <li>Information about Latest Update 7 goes here</li>
                                        <li>Information about Latest Update 8 goes here</li>
                                        <li>Information about Latest Update 9 goes here</li>
                                    </marquee>
                                </ul>
                                <a class="read-more" href="#">Read more</a>
                            </div>
                            <div>
                                <ul class="list">
                                    <li>Information about Important Activity 1 goes here</li>
                                    <li>Information about Important Activity 2 goes here</li>
                                    <li>Information about Important Activity 3 goes here</li>
                                    <li>Information about Important Activity 4 goes here</li>
                                    <li>Information about Important Activity 5 goes here</li>
                                    <li>Information about Important Activity 6 goes here</li>
                                    <li>Information about Important Activity 7 goes here</li>
                                    <li>Information about Important Activity 8 goes here</li>
                                    <li>Information about Important Activity 9 goes here</li>
                                </ul>
                                <a class="read-more" href="inner.php">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                            <li data-thumb="theme/images/crousal/1.jpg" data-thumb-alt="Slide 1">
                                <img src="theme/images/crousal/1.jpg" alt="Carousal image 1" />
                                <div class="slide-caption">Description of the Photo goes here</div>
                            </li>
                            <li data-thumb="theme/images/crousal/2.jpg" data-thumb-alt="Slide 2">
                                <img src="theme/images/crousal/2.jpg" alt="Carousal image 2" />
                                <div class="slide-caption">Description of the Photo goes here</div>
                            </li>
                            <li data-thumb="theme/images/crousal/3.jpg" data-thumb-alt="Slide 3">
                                <img src="theme/images/crousal/3.jpg" alt="Carousal image 3" />
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
<?php echo $this->get_footer(); ?>