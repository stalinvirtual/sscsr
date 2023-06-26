<?php
namespace App\Controllers;
use App\System\Route; 
$route = new Route();
$gallerypage = $route->site_url("IndexController/gallerypage");
$nominationpage = $route->site_url("IndexController/nomination");
$selectionpostpage = $route->site_url("IndexController/selectionpost");
$faq = $route->site_url("IndexController/faq");
?>

					<section class="section6 buttons">
						<!-- Photo Gallery divider -->
						<div class="container">
							<div class="row">
								<div class="col-lg-6">
									<h3>Important Links</h3>
									<div class="row">
										<div class="col-lg-4">
											<ul>
											
											
											<?php 

											



											foreach (@$ilinkforFirstFourRow as $sn => $firstFourRow){?>
											<li><a class=" page-permission" target = '_blank' href="<?= $firstFourRow->menu_link ?>"><?= $firstFourRow->link_name ?></a></li>
												
											<?php }
											
											?>
												
											</ul>
										</div>
										<div class="col-lg-4">
											<ul>
												<?php 
											foreach (@$ilinkforAfterFirstFourRow as $sn => $afterFirstFourRow){?>
											<li><a class="page-permission" target = '_blank' href="<?= $afterFirstFourRow->menu_link ?>"><?= $afterFirstFourRow->link_name ?></a></li>
												
											<?php }
											
											?>
											</ul>
										</div>
									</div>
									
									
								</div>
								
								<div class="col-lg-6">

												



								
											<h3 class="photogalleryClass">Photo Gallery</h3>
											<div class="gallery">
											<?php
											$t = (array)$gallery_id_based_images;

											




											$gallery_count = count($t );

											if($gallery_count > 0 ){

												for($i = 0;$i< $gallery_count;$i++){
												
													if ($i == 4) {
													break;
												  }
													$path = "gallery/".$t[$i]->image_path;
													echo '
													<figure>
													<img src="'.$path.'" alt="" />
													<figcaption>Image-1 <small>Description</small></figcaption>
												  </figure>';
												 }

											}
											
											
											 ?>
											</div>	

											<?php 
												if($gallery_count > 0 ){?>
													<div class="cbp-l-loadMore-button">
														<a href="<?php echo $gallerypage;?>" target="_blank" class="loadmore indexmore" >VIEW ALL</a>
													</div>
												<?php }
											?>
												
																			
											
															
								</div>
								<!-- <div class="col-lg-4">
									<div class="cClass">
										<div class="monthly buttons" id="mycalendar"></div>
									</div>
								</div> -->
							</div>
						</div>
						<!-- Photo Gallery divider -->
					</section>
					<section class="customer-logos slider">

		<div class="slide"><a href="https://dipp.gov.in/"  rel = "noopener noreferrer" target="_blank"  class="thumbnail page-permission" aria-label="Government of Tamil Nadu - External site that opens in a new window"><img src="https://cdn.s3waas.gov.in/master/uploads/2017/04/2017110781.png" alt="Image" width="150px" height="100px" class="img-responsive" title=" Department for Promotion of Industry and Internal Trade"></a></div>
		
		
	<div class="slide"><a href="https://gandhi.gov.in/"  rel = "noopener noreferrer" target="_blank"  class="thumbnail page-permission" aria-label="Government of Tamil Nadu - External site that opens in a new window"><img src="https://cdn.s3waas.gov.in/master/uploads/2017/04/2017053017.png" alt="Image" width="150px" height="100px" class="img-responsive" title="150 Years of Celebrating The Mahatma"></a></div>
	
		<div class="slide"><a href="http://www.ipindia.nic.in/index.htm"   rel = "noopener noreferrer" target="_blank"  class="thumbnail page-permission"  aria-label="Government of Tamil Nadu - External site that opens in a new window"><img src="https://cdn.s3waas.gov.in/s3bbf94b34eb32268ada57a3be5062fe7d/uploads/bfi_thumb/2020122176-p06j9q33rs0jhfxlybu6de83n9hqnvzcnhw0l414o8.png
" alt="Image" width="150px" height="100px"class="img-responsive" title="Controller General of Patents, Designs & Trade Marks"></a></div>
				
		<div class="slide"><a href="http://copyright.gov.in/Default.aspx"  rel = "noopener noreferrer" target="_blank"  class="thumbnail page-permission" aria-label="Government of Tamil Nadu - External site that opens in a new window"><img src="https://cdn.s3waas.gov.in/master/uploads/2017/04/2017053014.png" alt="Image" width="150px" height="100px" class="img-responsive" title="Copyright Office"></a></div>

		<div class="slide"><a href="https://indiacode.nic.in/"  class="thumbnail page-permission"   rel = "noopener noreferrer" target="_blank"   aria-label="Government of Tamil Nadu - External site that opens in a new window"><img src="https://cdn.s3waas.gov.in/master/uploads/2017/04/2017053023.png"  width="150px" height="100px" alt="Image" class="img-responsive" title="India Code Portal"></a></div>
		<div class="slide"><a href="https://dipp.gov.in/"  rel = "noopener noreferrer" target="_blank"  class="thumbnail page-permission" aria-label="Government of Tamil Nadu - External site that opens in a new window"><img src="https://cdn.s3waas.gov.in/master/uploads/2017/04/2017110781.png" alt="Image" width="150px" height="100px" class="img-responsive" title=" Department for Promotion of Industry and Internal Trade"></a></div>
		<div class="slide"><a href="https://indiacode.nic.in/"  class="thumbnail page-permission"   rel = "noopener noreferrer" target="_blank"   aria-label="Government of Tamil Nadu - External site that opens in a new window"><img src="https://cdn.s3waas.gov.in/master/uploads/2017/04/2017053023.png"  width="150px" height="100px" alt="Image" class="img-responsive" title="India Code Portal"></a></div>


		
   </section>
   <style>
   .slide{
	   width:155px !important;
   }
   
   </style>