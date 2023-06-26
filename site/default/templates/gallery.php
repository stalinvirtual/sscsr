<?php 
namespace App\Controllers;
use App\System\Route; 

error_reporting(0);
if(!isset($_SERVER['HTTP_REFERER']) ){
	// redirect them to your desired location
	header('location:http://localhost/rd/security_audit/site/index.php');

	exit;
}
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
				<label id="yearId">Year:
				</label>
			</div>
			<div class="col-lg-5 col-sm-2 col-md-3" >
				<!-- <select name="gallery_year" id="gallery_year" required="true" class="form-control">				
				</select> -->



				<select name="gallery_year" id="gallery_year" required="true" class="form-control">
					  <!-- <option value="All">All</option> -->
                      <?php
						$current_year = date("Y") ;
                      foreach ($distinctyears as $key => $page) {
							 echo '<option value="'.$page->year.'"';
								if( $page->year ==  $current_year ) {
										echo ' selected="selected"';
								}
								echo ' >'.$page->year.'</option>';
					  }?>
                     
                    </select>
			</div>
			<div class="col-lg-2 col-sm-2">
			</div>
		</div>
		</br>
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 gallery_events_name" >
				
					<div class="btn-group btn-group-toggle" id="gallery_events" data-toggle="buttons">
						<!-- <label class="btn btn-secondary active">
						  <input type="radio" class="customEventRadioButton" id="ALL" name="searchRadio" checked ="checked"> All
						</label> -->
					</div>
				
			</div>
		</div>
		<!-- <section class="gallery-block cards-gallery">
	    <div class="container">
	      
	        <div class="row">
				<div id="imgGallery">
				</div>
				
	           
	           
	        </div>
	    </div>
    </section> -->

	<section class="gallery-block cards-gallery">
	    <div class="container">
			<div class='row ' id="imgGallery"></div>
	      
	       
	    </div>
    </section>





	</div>

</section>
<?php include "footer2.php";?>
<?php include "footer.php";?>

<style>

.eventClass{
	background-color: #433d3d;
	padding: 5px;
	color:white !important;
}

.gallery-block{
	/* padding-bottom: 60px;
	//padding-top: 60px; */
}
.imgClass{
	width: 200px !important;
	height:200px !important;
}

.gallery-block .heading{
    margin-bottom: 50px;
    text-align: center;
}

.gallery-block .heading h2{
    font-weight: bold;
    font-size: 1.4rem;
    text-transform: uppercase;
}

.gallery-block.cards-gallery h6 {
  font-size: 17px;
  font-weight: bold; 
}

.gallery-block.cards-gallery .card{
  transition: 0.4s ease; 
}

.gallery-block.cards-gallery .card img {
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15); 
}

.gallery-block.cards-gallery .card-body {
  text-align: center; 
}

.gallery-block.cards-gallery .card-body p {
  font-size: 15px; 
}

.gallery-block.cards-gallery a {
  color: white !important; 
}

.gallery-block.cards-gallery a:hover {
  text-decoration: none; 
}

.gallery-block.cards-gallery .card {
  margin-bottom: 30px; 
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15);
}

@media (min-width: 576px) {

	.gallery-block .transform-on-hover:hover {
	    transform: translateY(-10px) scale(1.02);
	    box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.15) !important; 
	}
}
 /* li.col-xs-6.col-sm-4.col-md-3.cl-lg-2 {
   
}  */

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