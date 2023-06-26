<?php 
namespace App\Controllers;
use App\System\Route; 
include "header.php";
$route = new Route();
$gallerypage = $route->site_url("IndexController/gallerypage");
?>
<!--<section class="section9">
		</section>-->
<section class="buttons sectionClass">
	<div class="container">
		<div class="row breadcrumbruler">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="index.php" class="breadcrumb_text_color">Home</a><i class="icon-angle-right"></i></li>
					<li><a href="<?php echo $gallerypage;?>" class="breadcrumb_text_color">Gallery</a><i class="icon-angle-right"></i></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container" >
		<div class="row rowClass">
			<div class="col-lg-4">
				<h2>PHOTO GALLERY</h2>
			</div>
		</div>  
	</div>
	<br>
	<div class="container marginbot50" id="main">
		<div class="row">
			<div class="col-lg-3 col-sm-2">
			</div>
			<div class="col-lg-1 col-sm-2">
				<label>Year:
				</label>
			</div>
			<div class="col-lg-5 col-sm-2 col-md-3" >
				<!-- <select name="gallery_year" id="gallery_year" required="true" class="form-control">				
				</select> -->



				<select name="gallery_year" id="gallery_year" required="true" class="form-control">
                      <option value="">Select Year</option>
                      <?php
                      foreach ($distinctyears as $key => $page) {?>
 <option  value="<?php echo $page->year; ?>"><?php echo $page->year; ?></option>
				<?php 	  }?>
                      
                       
                     
                    </select>
			</div>
			<div class="col-lg-2 col-sm-2">
			</div>
		</div>
		</br>
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 gallery_events_name" >
				
					<div class="btn-group btn-group-toggle" id="gallery_events" data-toggle="buttons">
						<label class="btn btn-secondary active">
						  <input type="radio" class="customEventRadioButton" id="ALL" name="searchRadio" checked ="checked"> All
						</label>
					</div>
				
			</div>
		</div>
		</br>
		<div class="row">
			<div class="col-lg-12" id="imgGallery">
				
				  
				<!--  <li class="col-xs-6 col-sm-4 col-md-3" data-src="imgs/2-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
					<a href="">
					  <img class="img-responsive" src="imgs/thumb-2.jpg">
					</a>
				  </li>
				  <li class="col-xs-6 col-sm-4 col-md-3" data-src="imgs/13-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
					<a href="">
					  <img class="img-responsive" src="imgs/thumb-13.jpg">
					</a>
				  </li>
				  <li class="col-xs-6 col-sm-4 col-md-3" data-src="imgs/4-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
					<a href="">
					  <img class="img-responsive" src="imgs/thumb-4.jpg">
					</a>
				  </li>
				   <li class="col-xs-6 col-sm-4 col-md-3" data-src="imgs/4-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
					<a href="">
					  <img class="img-responsive" src="imgs/thumb-4.jpg">
					</a>
				  </li>
				   <li class="col-xs-6 col-sm-4 col-md-3" data-src="imgs/4-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
					<a href="">
					  <img class="img-responsive" src="imgs/thumb-4.jpg">
					</a>
				  </li> -->
				

			</div>

		</div>
	</div>
</section>
<?php include "footer2.php";?>
<?php include "footer.php";?>

<style>



li.col-xs-6.col-sm-4.col-md-3 {
    width: 380px !important;
}

.btn-group-toggle 
.btn:not(:disabled):not(.disabled).active, 
.btn-group-toggle 
.btn:not(:disabled):not(.disabled):active, 
.show>.btn.dropdown-toggle {
      color: #fff;
          background-color: #a52a2a;
    border-color: #efb4b4;
	
}

/* non selected btn css */
.btn-group-toggle .btn {
  color: black;
  background-color: #b7b7b7;
  border-color: #6c757d;
 
}


.customEventRadioButton {
	padding:12px ;
}
.customEventRadioButton {
    position: absolute;
    z-index: -1;
    filter: alpha(opacity=0);
    opacity: 0;
}

 .event {
    margin-left: 5px !important;
}

.gallery_events_name{
	 text-align: center;
}
</style>