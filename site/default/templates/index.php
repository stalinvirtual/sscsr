<?php

echo $this->get_header(null, $this->data);
?>
<!--/.nav-wrapper-->
<div class="wrapper banner-wrapper">
  <div id="flexSlider" class="flexslider">
    <ul class="slides">

      <li title="Banner 1"> <img src="theme/images/banner/slider-1.jpg" alt="Banner 1 image">
        <div class="container">
          <div class="slide-caption">
            Description of the banner 1 goes here.
          </div>
        </div>
      </li>
      <li title="Banner 2"> <img src="theme/images/banner/slider-2.jpg" alt="Banner 2 image">
        <div class="container">
          <div class="slide-caption">
            Description of the banner 2 goes here.
          </div>
        </div>
      </li>

      <li title="Banner 3"> <img src="theme/images/banner/slider-3.jpg" alt="Banner 3 image">
        <div class="container">
          <div class="slide-caption">
            Description of the banner 3 goes here.
          </div>
        </div>
      </li>

      <li title="Banner 3"> <img src="theme/images/banner/slider-4.jpg" alt="Banner 3 image">
        <div class="container">
          <div class="slide-caption">
            Description of the banner 3 goes here.
          </div>
        </div>
      </li>

    </ul>

  </div>
</div>
<div class="wrapper" id="skipCont"></div>
<!--/#skipCont-->
<section id="fontSize" class="wrapper body-wrapper ">
  <div class="bg-wrapper top-bg-wrapper gray-bg padding-top-bott">





    <div class="container body-container top-body-container padding-top-bott2">

      <div class="minister clearfix">
        <div class="minister-box">
          <div class="minister-image"><img src="https://ssc.nic.in/Content/library/assets/images/gandhi.png" alt="Minister image"></div>
          <div class="min-info">
            <p>"If I have the belief that I can do it, I shall surely acquire the capacity to do it even if I may not have it at the beginning."</p>

            <div class="text-heading">- Mahatma Gandhi</div>
            <!--<a href="#" class="bttn">View Profile</a>-->
          </div>
        </div>
        <div class="minister-box clearfix">
          <div class="min-info">
            <a href="#">
              <h4 class="color-blue">Public disclosure of scores and other details of non-recommended willing candidates</h4>
            </a>
          </div>
        </div>
        <hr>
        </hr>
        <div class="minister-box clearfix">
          <div class="minister-image"><img src="https://ssc.nic.in/Content/library/assets/images/Mahatma_Gandhi.jpeg" alt="Minister image"></div>
        </div>
        <hr>
        </hr>
        <div class="minister-box clearfix">
          <div class="minister-image"><img src="https://ssc.nic.in/Content/library/assets/images/logo-slider6.png" alt="Minister image"></div>
        </div>
      </div>

      <div class="right-block">
        <div class="whats-new-maincontainer">
          <div id="feedTab">
            <div class="resp-tabs-container feedTab_1">
              <div>
                <div class="pub-btn  mar-bott">
                  <a href="">
                    <div class="video-icon"><i class="fa fa-copy"></i></div>
                    <div class="video-text">Lates News</div>
                  </a>
                </div>
                <ul class="list">

                </ul>
                <a class="read-more" href="#">Read more</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="minister clearfix" style="float:right !important">
        <div class="pub-btn  mar-bott">
          <a href="">
            <div class="video-icon"><i class="fa fa-sign-in"></i></div>
            <div class="video-text">Login</div>
          </a>
        </div>
        <div class="minister-box">

          <?php
          if (isset($errorMsg)) {
            echo '<div class="alert alert-danger errormsg">';
            echo $errorMsg;
            echo '</div>';
            unset($errorMsg);
          }
          ?>
          <!-- Home Page Login Form start -->
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" Style="padding: 10px;" method="post">
            <div class="container" style="background-color:white">
              <input type="text" placeholder="Username " name="email" required>
              <input type="password" placeholder="Password " name="password" required>
            </div>

            <div class="container">
              <input type="submit" name="login" value="Login">
            </div>
          </form>
          <!-- Home Page Login Form End  -->
        </div>
        <div class="pub-btn  mar-bott">
          <a href="">
            <div class="video-icon"><i class="fa fa-calendar"></i></div>
            <div class="video-text">Calendar</div>
          </a>
        </div>
        <div class="minister-box">
          <h4 class="color-blue">Examination Calender pdficon (29.50 KB)</h4>
          <a href="#"></a><u>Click Here</u></a>
        </div>
        <hr>
        </hr>
        <div class="minister-image"><img src="https://cbpssubscriber.mygov.in/assets/uploads/89vQkZbZihu8Szgn" alt="Minister image"></div>
      </div>



    </div>
  </div>

</section>
<!--/.body-wrapper-->
<!--/.banner-wrapper-->
<?php echo $this->get_footer(); ?>