<?php

namespace App\Controllers;

use App\System\Route;

echo $this->get_header();
?>

<!--/.nav-wrapper-->
<div class="wrapper" id="skipCont"></div>
<!--/#skipCont-->
<section id="fontSize" class="wrapper body-wrapper ">


  <div class="bg-wrapper top-bg-wrapper gray-bg padding-top-bott">


    <div class="container body-container top-body-container padding-top-bott2">


      <ul class="breadcrumb">
        <li><a href="home.php">Home</a></li>
        <li>Admin Login</li>
      </ul>
      <br>
      <div class="boxed-text">
        <h3>Sub Heading 1 </h3>
        <div class="minister clearfix for-mobile-top" style="float:right !important">
          <div class="pub-btn mar-bott">
            <a href="">
              <div class="video-icon"><i class="fa fa-sign-in"></i></div>
              <div class="video-text">Login</div>
            </a>
          </div>
          
         
          <div class="minister-box" style="float: none !important;">
            <?php
            if (isset($errorMsg) && !empty($errorMsg)) {
              echo '<div class="alert alert-danger errormsg">';
              echo $errorMsg;
              echo '</div>';
              //unset($errorMsg);
            }

            $route = new Route();
            $loadcaptcha = $route->site_url("Api/loadcaptcha");
            ?>
            <form style="padding: 10px;" id="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="container" style="background-color:white">
                <input type="text" placeholder="Username " name="username" id = "username" required="" autocomplete="off">
                <input type="password" placeholder="Password " name="password" required="" id = "password" autocomplete="off">
                <input type="text" name="captcha_code" id="captcha" class="demoInputBox" required="" autocomplete="off"><br>
                <img src="<?php echo $loadcaptcha; ?>" style="width:100px"  id="captcha_code"/>
                <button name="submit" class="btnRefresh" onClick="refreshCaptcha();">Refresh Captcha</button>
              </div>

              <div class="container">
                <input type="submit" value="Login" name="login">
              </div>
            </form>
          </div>
        </div>
        <p>Description of the sub-heading 1 goes here. An informative text section that outlines the work portfolio of the ministry and the initiatives/ schemes and other useful purpose that the ministry website serves.</p>
        <p>Description of the sub-heading 1 goes here. An informative text section that outlines the work portfolio of the ministry and the initiatives/ schemes and other useful purpose that the ministry website serves. </p><a href="#" class="more">View More</a>

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
        <div class="video_link mar-bott">
          <a href="">
            <div class="video-icon"><i class="fa fa-film"></i></div>
            <div class="video-text">Video Gallery</div>
          </a>
        </div>


        <div class="ebook-container">
          <div class="publication">
            Information about Publication goes here.
          </div>
          <div class="pub-btn mar-bott">
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
      <!-- 23966

      1034


      29866 -->

    </div>
  </div>
  <?php
$route = new Route();
$loadcaptcha = $route->site_url("api/loadcaptcha");
  ?>


</section>

<!--/.body-wrapper-->
<!--/.banner-wrapper-->
<script>
function refreshCaptcha() {
  var url = '<?php echo $loadcaptcha;?>';
  $('#captcha_code').attr('src', url);
}
</script>

<?php echo $this->get_footer(); ?>