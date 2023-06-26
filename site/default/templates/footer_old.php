<div class="wrapper carousel-wrapper">
  <div class="container carousel-container">
    <div id="flexCarousel" class="flexslider carousel">
      <ul class="slides">
        <li><a target="_blank" href="https://data.gov.in/" title="Data portal, External Link that opens in a new window"><img src="assets/images/carousel/data-gov.png" alt="Data gov website link"></a></li>
        <li><a target="_blank" href="http://india.gov.in/" title="National Portal of India, External Link that opens in a new window"><img src="assets/images/carousel/india-gov.png" alt="India gov website link"></a></li>
        <li><a target="_blank" href="https://www.incredibleindia.org" title="Incredible India, External Link that opens in a new window"><img src="assets/images/incredible-india.png" alt="Incredible India website link"></a></li>
        <li><a target="_blank" href="https://digitalindia.gov.in/" title="Digital India, External Link that opens in a new window"><img src="assets/images/carousel/digital-india.png" alt="Digital India website link"></a></li>
        <li><a target="_blank" href="https://pmnrf.gov.in/" title="Prime Minister's National Relief Fund, External Link that opens in a new window"><img src="assets/images/carousel/ganhri.png" alt="PMNRF website link"></a></li>
        <li><a target="_blank" href="http://www.makeinindia.com/" title="Make In India, External Link that opens in a new window"> <img src="assets/images/carousel/makeinindia.png" alt="Make in India website link"></a></li>
        <li><a target="_blank" href="http://goidirectory.nic.in/" title="GOI Web Directory, External Link that opens in a new window"><img src="assets/images/carousel/goidirectory.png" alt="GOI Directory website link"></a></li>
        <li><a target="_blank" href="https://mygov.in/" title="MyGov, External Link that opens in a new window"><img src="assets/images/carousel/mygov.png" alt="MyGov website link"></a></li>
        <li><a target="_blank" href="https://eci.gov.in/" title="Election Commission of India, External Link that opens in a new window"><img src="assets/images/carousel/eci.png" alt="Election Commission of India website link"></a></li>
        <li><a target="_blank" href="http://egazette.nic.in/" title="eGazette, External Link that opens in a new window"><img src="assets/images/carousel/e-gazette.png" alt="eGazette website link"></a></li>
        <li><a target="_blank" href="https://evisitors.nic.in" title="MyVisit, External Link that opens in a new window"><img src="assets/images/carousel/myvisit-logo.png" alt="eVisitors website link"></a></li>
        <li><a target="_blank" href="https://pgportal.gov.in/" title="Centralized Public Grievance Redress and Monitoring System, External Link that opens in a new window"><img src="assets/images/carousel/pg-portal.png" alt="PG Portal website link"></a></li>
      </ul>
    </div>
  </div>
</div>
<!--/.carousel-wrapper-->
<footer class="wrapper footer-wrapper">
  <div class="footer-top-wrapper">
    <div class="container footer-top-container">
      <ul>
        <li><a href="inner.php">Feedback</a></li>
        <li><a href="inner.php">Website Policies </a></li>
        <li><a href="inner.php">Contact Us</a></li>
        <li><a href="inner.php">Web Information Manager </a></li>
        <li><a href="inner.php">FAQ’s</a></li>
        <li><a href="inner.php">Disclaimer</a></li>
        <li><a href="inner.php">Help</a></li>
        <li><a href="inner.php">Terms & Conditions</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom-wrapper">
    <div class="container footer-bottom-container">
      <div class="footer-content clearfix">
        <div class="copyright-content">
          Website Content Managed by <strong>Department Name, Ministry Name, <a target="_blank" title="GoI, External Link that opens in a new window" href="https://www.india.gov.in/"><strong>Government of India</strong></a></strong>
          <span>Designed, Developed and Hosted by <a target="_blank" title="NIC, External Link that opens in a new window" href="https://www.nic.in/"><strong>National Informatics Centre</strong></a><strong> (NIC)</strong></span>
          <span class="last-updated">Last Updated: <span id="lastupdated"></span></span>
        </div>

      </div>
    </div>
  </div>

</footer>
<!--/.footer-wrapper-->
<script src="assets/js/jquery-2.1.1.min.js"></script>
<script src="assets/js/jquery-accessibleMegaMenu.js"></script>
<script src="assets/js/framework.js"></script>
<script src="assets/js/jquery.flexslider.js"></script>
<script src="assets/js/font-size.js"></script>
<script src="assets/js/swithcer.js"></script>
<script src="theme/js/ma5gallery.js"></script>
<script src="assets/js/megamenu.js"></script>
<script src="theme/js/easyResponsiveTabs.js"></script>

<script>
  // function sendContact() {
  // 	var valid;	
  // 	valid = validateContact();
  // 	if(valid) {
  // 		jQuery.ajax({
  // 		url:  '<?php echo $this->route->site_url("index/ajaxresponse"); ?>';
  // 		data:'userName='+$("#username").val()+'&password='+$("#password").val()+'&captcha='+$("#captcha").val(),
  // 		type: "POST",
  // 		success:function(data){
  // 		$("#mail-status").html(data);
  // 		},
  // 		error:function (){}
  // 		});
  // 	}
  // }

  // function validateContact() {
  // 	var valid = true;	
  // 	$(".demoInputBox").css('background-color','');
  // 	$(".info").html('');

  // 	if(!$("#userName").val()) {
  // 		$("#userName-info").html("(required)");
  // 		$("#userName").css('background-color','#FFFFDF');
  // 		valid = false;
  // 	}
  // 	if(!$("#userEmail").val()) {
  // 		$("#userEmail-info").html("(required)");
  // 		$("#userEmail").css('background-color','#FFFFDF');
  // 		valid = false;
  // 	}
  // 	if(!$("#userEmail").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
  // 		$("#userEmail-info").html("(invalid)");
  // 		$("#userEmail").css('background-color','#FFFFDF');
  // 		valid = false;
  // 	}
  // 	if(!$("#subject").val()) {
  // 		$("#subject-info").html("(required)");
  // 		$("#subject").css('background-color','#FFFFDF');
  // 		valid = false;
  // 	}
  // 	if(!$("#content").val()) {
  // 		$("#content-info").html("(required)");
  // 		$("#content").css('background-color','#FFFFDF');
  // 		valid = false;
  // 	}
  // 	if(!$("#captcha").val()) {
  // 		$("#captcha-info").html("(required)");
  // 		$("#captcha").css('background-color','#FFFFDF');
  // 		valid = false;
  // 	}

  // 	return valid;
  // }

  $(window).ready(function() {
    // Slider						
    $('#flexSlider').flexslider({
      animation: "slide",
      pausePlay: true,
      controlNav: true,
      start: function(slider) {
        $('body').removeClass('loading');
      }
    });
    $('#flexSlider1').flexslider({
      animation: "slide",
      controlNav: false,
      start: function(slider) {
        $('body').removeClass('loading');
      }
    });
    $('#flexSlider2').flexslider({
      animation: "slide",
      controlNav: false,
      start: function(slider) {
        $('body').removeClass('loading');
      }
    });


    $('#contSlider1').flexslider({
      animation: "swing",
      controlNav: false,
      directionNav: false,
      direction: "vertical",
      easing: 'linear',
      prevText: " ",
      nextText: " ",
      minItems: 2,
      maxItems: 2,
      move: 2,
      itemMargin: 0,
      pausePlay: true,
      pauseOnHover: true,
      slideshowSpeed: 1000,
      animationSpeed: 10000,


    });

    $('#contSlider2').flexslider({
      animation: "slide",
      controlNav: false,
      start: function(slider) {
        $('body').removeClass('loading');
      }
    });



    // Carousel						
    $('#flexCarousel').flexslider({
      animation: "slide",
      animationLoop: false,
      itemWidth: 200,
      itemMargin: 5,
      minItems: 2,
      maxItems: 6,
      slideshow: 1,
      move: 1,
      pausePlay: true,
      pauseText: 'Pause',
      playText: 'Play',
      controlNav: false,
      start: function(slider) {
        $('body').removeClass('loading');
        if (slider.pagingCount === 1) slider.addClass('flex-centered');
      }
    });

    $('#flexCarousel1').flexslider({
      animation: "slide",
      animationLoop: false,
      itemWidth: 168,
      itemMargin: 20,
      minItems: 1,
      maxItems: 4,
      slideshow: 1,
      move: 1,
      controlNav: false,
      start: function(slider) {
        $('body').removeClass('loading');
        //if (slider.pagingCount === 1) slider.addClass('flex-centered');
      }
    });
    // breaking_news

    $('#breaking_news').flexslider({
      animation: "slide",
      controlNav: false,
      animationLoop: true,
      directionNav: false,
      direction: "horizontal",
      slideshowSpeed: 7000,
      animationSpeed: 600,
      initDelay: 1000,
      pausePlay: true,
      pauseText: '',
      playText: '',
      pauseOnHover: false
    });

    // Gallery
    $('#galleryCarousel').flexslider({
      animation: "fade",
      controlNav: "thumbnails",
      start: function(slider) {
        $('body').removeClass('loading');
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('figure img').ma5gallery({
      preload: true
    });

    $('#socialTab').easyResponsiveTabs({
      type: 'default', //Types: default, vertical, accordion
      width: 'auto', //auto or any width like 600px
      fit: true, // 100% fit in a container
      tabidentify: 'socialTab_1', // The tab groups identifier
      activate: function(event) { // Callback function if tab is switched
        var $tab = $(this);
        var $info = $('#nested-tabInfo');
        var $name = $('span', $info);
        $name.text($tab.text());
        $info.show();
      }
    });

    $('#feedTab').easyResponsiveTabs({
      type: 'default', //Types: default, vertical, accordion
      width: 'auto', //auto or any width like 600px
      fit: true, // 100% fit in a container
      tabidentify: 'feedTab_1', // The tab groups identifier
      activate: function(event) { // Callback function if tab is switched
        var $tab = $(this);
        var $info = $('#nested-tabInfo');
        var $name = $('span', $info);
        $name.text($tab.text());
        $info.show();
      }
    });

    $('.resp-tabs-list li a').click(function(event) {
      event.preventDefault();
    })

  });
</script>
<script>
  var a = 0;
  $(window).scroll(function() {

    var oTop = $('#counter').offset().top - window.innerHeight;
    if (a == 0 && $(window).scrollTop() > oTop) {
      $('.count').each(function() {
        $(this).prop('Counter', 0).animate({
          Counter: $(this).text()
        }, {
          duration: 4000,
          easing: 'swing',
          step: function(now) {
            $(this).text(Math.ceil(now));
          }
        });
      });
      a = 1;
    }

  });
</script>

<script>
  var d = new Date();
  var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  document.getElementById("lastupdated").innerHTML = months[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
</script>
</body>

</html>