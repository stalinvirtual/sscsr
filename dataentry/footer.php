<!-- footer -->
<div class="footer">
  <i class="fa fa-object-group nav-icon" id="btnFullscreen" aria-hidden="true" title="full screen"></i>
  <p>©
    <?php echo date("Y"); ?> <a href="#">NIC</a> . All Rights Reserved .
  </p>
</div>
<!-- //footer -->
<script src="js/bootstrap.js"></script>
<script src="js/proton.js"></script>


<script type="text/javascript">
  function toggleFullscreen(elem) {
    elem = elem || document.documentElement;
    if (!document.fullscreenElement && !document.mozFullScreenElement &&
      !document.webkitFullscreenElement && !document.msFullscreenElement) {
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.msRequestFullscreen) {
        elem.msRequestFullscreen();
      } else if (elem.mozRequestFullScreen) {
        elem.mozRequestFullScreen();
      } else if (elem.webkitRequestFullscreen) {
        elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
      }
    } else {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
      }
    }
  }

  document.getElementById('btnFullscreen').addEventListener('click', function () {
    toggleFullscreen();
  });




</script>
</body>

</html>