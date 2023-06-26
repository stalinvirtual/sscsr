<?php 
namespace App\Controllers;
use App\System\Route; 
include "header.php";
$route = new Route();
$candidateCorner = $route->site_url("IndexController/candidateCorner");
$admitcard = $route->site_url("IndexController/admitcard");
$knowyourstatus = $route->site_url("IndexController/knowyourstatus");
$knowyourrollno= $route->site_url("IndexController/knowyourrollno");
$knowyourvenuedetails = $route->site_url("IndexController/knowyourvenuedetails");

?>
<!--<section class="section9">
		</section>-->
<section class="buttons sectionClass">
		<div class="container">
			<div class="row breadcrumbruler">
				<div class="col-lg-12">
					<ul class="breadcrumb">
						<li><a href="index.php" class="breadcrumb_text_color">Home</a><i class="icon-angle-right"></i></li>
						<li><a href="<?php echo $candidateCorner;?>" class="breadcrumb_text_color">Candidate Corner</a><i class="icon-angle-right"></i></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container" >
		<div class="row rowClass">
			<div class="col-lg-12">
				<h2>Candidate Corner</h2>
			</div>
		</div>  
	</div>
	<BR>
   <div class="container marginbot50" id="main">
		<div class="row">
			<div class="col-lg-10">
				<div>
					<ul>
						<li class="cbp-item graphic">
							<div class="flip-container" ontouchstart="this.classList.toggle('hover');">
								<div class="flipper">
									<div class="front">
										<h4 class="ccn">Know<br>your<br>Application<br>status</h4>
									</div>
									<div class="back">
										<a href="<?php echo $knowyourstatus;?>" class="cbp-l-caption-buttonRight" target="_blank">Go <i class="fa fa-share" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
						</li>
						<li class="cbp-item graphic">
							<div class="flip-container" ontouchstart="this.classList.toggle('hover');">
									<div class="flipper">
										<div class="front">
											<h4 class="ccn">Know your<br>Date and City of Exam</h4>
										</div>
										<div class="back">
											<a href="<?php echo $knowyourvenuedetails;?>" class="cbp-l-caption-buttonRight" target="_blank">Go <i class="fa fa-share" aria-hidden="true"></i></a>
										</div>
									</div>
							</div>
						</li> 
						<li class="cbp-item graphic">
							<div class="flip-container" ontouchstart="this.classList.toggle('hover');">
									<div class="flipper">
										<div class="front">
											<h4 class="ccn">Admit Card <br>or<br> Call Letter</h4>
										</div>
										<div class="back">
											<a href="<?php echo $admitcard;?>" class="cbp-l-caption-buttonRight" target="_blank">Go <i class="fa fa-share" aria-hidden="true"></i></a>
										</div>
								</div>
							</div>
						</li>
					</ul> 
				</div>

			</div>
		</div>
	</div>
   </section>
	<?php include "footer2.php";?>
	<?php include "footer.php";?>
	
	<style>
	/* entire container, keeps perspective */
.flip-container {
    perspective:1000px;
}
	/* flip the pane when hovered */
	.flip-container:hover .flipper, .flip-container.hover .flipper {
		transform: rotateY(180deg);
	}

.flip-container, .front, .back {
	width: 200px;
	height: 200px;
}

/* flip speed goes here */
.flipper {
	transition: 0.6s;
	transform-style: preserve-3d;

	position: relative;
}

/* hide back of pane during swap */
.front, .back {
	backface-visibility: hidden;
	position: absolute;
	top: 0;
	left: 0;
}

/* front pane, placed above back */
.front {
	z-index: 2;
	/* for firefox 31 */
	transform: rotateY(0deg);
    background-color:#ccc;
}

/* back, initially hidden pane */
.back {
	transform: rotateY(180deg);
    background-color:#bada55;
}
.graphic{
	list-style-type: none;  
}
.ccn {
    text-align: center;
    margin: 40px;
}
.cbp-l-caption-buttonRight{
    background-color: #a94442;
    color: #FFF;
    display: inline-block;
    font: 12px/28px sans-serif;
    text-decoration: none;
    width: 120px !important;
    text-align: center;
    margin: 40px;
    padding: 40px !important;
}
	</style>