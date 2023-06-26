<?php

namespace App\Controllers;

use App\System\Route;

echo $this->get_header();
?>
<section class="buttons">
	<div class="container">
		<div class="row breadcrumbruler">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="index.php" class="breadcrumb_text_color">Home</a><i class="icon-angle-right"></i></li>
					<li><a href="#" class="bread"> FAQ</a><i class="icon-angle-right"></i></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
			<div class="row rowClass">
				<div class="col-lg-12">
					<h2>FAQ</h2>
				</div>
			</div> 
		</div>
		<br>
	<div class="container" id="main">
		<div class="row">
			<div class="col-lg-12"  style="max-height: 300px;overflow-y: scroll;">
			<?php 
			// $arrContextOptions=array(
			// 		"ssl"=>array(
			// 			"verify_peer"=>false,
			// 			"verify_peer_name"=>false,
			// 		),
			// 	);  
			// 	$str = file_get_contents($this->base_url."default/templates/faq.json", false, stream_context_create($arrContextOptions));
			// 	$json = json_decode($str,true);


				


				





				
				foreach($faq_for_websites as $key =>$value){?>
					<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title "><?php echo ++$key;?>&nbsp;<?php echo $value->faq_title;?></h3>
						<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
					</div>
					<div class="panel-body"><?php echo $value->faq_content;?></div>
				</div>
					
				<?php }
				
			?>
			</div>
		</div>
		
		
		
	</div>
	<br>
</section>
<?php include "footer2.php";?>
<style>
.select2-selection__rendered {
    line-height: 31px !important;
	white-space: inherit !important;
}
.select2-container .select2-selection--single {
    height: 56px !important;
	white-space: inherit !important;
}
.select2-selection__arrow {
    height: 56px !important;
}

.numberCircle {
    border-radius: 50%;
    width: 36px;
    height: 36px;
    padding: 8px;

    background: #fff;
    border: 2px solid #666;
    color: #666;
    text-align: center;

    font: 32px Arial, sans-serif;
}

.clickable{
    cursor: pointer;   
}

.panel-heading span {
	margin-top: -20px;
	font-size: 15px;
}

 </style>



<?php echo $this->get_footer(); ?>