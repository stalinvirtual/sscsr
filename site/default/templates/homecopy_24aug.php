<?php

namespace App\Controllers;

use App\System\Route;

echo $this->get_header();
$route = new Route();
$nominationpage = $route->site_url("IndexController/nomination");
$selectionpostpage = $route->site_url("IndexController/selectionpost");
$noticepage = $route->site_url("IndexController/notice");
$tenderpage = $route->site_url("IndexController/tender");
?>
<section id="featured" class="bg">
	<!-- start slider -->
	<div class="container-fluid">
		<div class="row">
			<section class="section1 buttons" id="main">
				<div class="container">
					<div class="row">


						<div class="col-lg-6">
							<h3>About SSCSR</h3>
							<p>
								The Staff Selection Commission is functioning under the Department of Personnel & Training, Government of India. Initially known as Subordinate Services Commission, it was set up on 1 July 1976 primarily to make recruitment on zonal basis for non-technical Group C posts under the Central Government, except the post for which recruitment was made by Railway Service Commission and the industrial establishments. The functions of the Staff Selection Commission have been enlarged from time to time and now it carries out the recruitment for Group B posts also under the Central Government. Thus, the Commission recruits for the major work force of the Central Government. This segment constitutes the most vital part of the Government machinery; the posts for which it makes recruitment are at the grass root level which interact with the public and interfaces with the implementation of the Government’s policies.

							</p>
						</div>
						<!-- Latest News Div-->
						<div class=" col-lg-6">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#one" data-toggle="tab"><i class="icon-briefcase"></i><b>Latest News</b></a></li>
								<li><a href="#two" data-toggle="tab"><i class="icon-briefcase"></i><b>Candidate Corner &nbsp;</b></a></li>

							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="one">
									<div class="ScrollStyle">
										<!-- <ul> -->
											<marquee behavior=scroll direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="height:200px">
												<h3>Nomination</h3>

												<?php foreach ($nominations_latest_news as $sn => $nomination) :
													$current_date =  date('Y-m-d');
													$nomination_date = date('Y-m-d', strtotime($nomination->effort_from_date));

												?>


													<!-- <li> -->
														 <div class="announcements">
															<p><strong><?= $nomination->exam_name ?></strong></p>
															<div class="date"><?= date('F j, Y',strtotime($nomination->effort_from_date)) ?></div>
														 
														<?php if ($current_date == $nomination_date) {
															echo '<img src="images/new.gif" style="width:40px">';
														}
														?>


														<?php


														foreach ($nominationchildlist_latest_news as $key => $childlist) :
															$selected = "";
															if ($nomination->nomination_id == $childlist->nomination_id) {
																$selected = "selected=\"selected\"";
																$uploadPath = 'nominations' . '/' . $childlist->attachment;
																$file_location = $this->route->get_base_url() . "/" . $uploadPath; ?>

																<a style="color:blue;text-decoration:underline" href="<?= $file_location ?>" target="_blank"><?= $childlist->pdf_name ?></a>,
															<?php }


															?>

														<?php endforeach; ?>

														</div>


														




													<?php endforeach; ?>

													<a href='<?php echo $nominationpage; ?>' target="_blank">
														<button class="GFG">
															View All
														</button>
													</a>
													<!-- </li> -->
													<h3>Selection Posts</h3>




													<?php

													foreach ($selectionposts_latest_news as $sn => $selectionpost) :
														$current_date =  date('Y-m-d');
														$sp_date = date('Y-m-d', strtotime($selectionpost->effort_from_date));

													?>

														<!-- <li> -->
															
														

														<div class="announcements">
															<p><strong><?= $selectionpost->exam_name ?></strong></p>
															<div class="date"><?= date('F j, Y',strtotime($selectionpost->effort_from_date)) ?></div>





															<?php if ($current_date == $sp_date) {
																echo '<img src="images/new.gif" style="width:40px">';
															}
															?>

															<?php


															foreach ($selectpostschildlist_latest_news as $key => $childlist) :
																$selected = "";
																if ($selectionpost->selection_post_id == $childlist->selection_post_id) {
																	$selected = "selected=\"selected\"";
																	$uploadPath = 'selectionposts' . '/' . $childlist->attachment;
																	$file_location = $this->route->get_base_url() . "/" . $uploadPath; ?>



																	<a style="color:blue;text-decoration:underline" href="<?= $file_location ?>" target="_blank"><?= $childlist->pdf_name ?></a>,
																<?php }


																?>

															<?php endforeach; ?>
														</div>


														<?php endforeach; ?>
														<a href='<?php echo $selectionpostpage; ?>' target="_blank">
														<button class="GFG">
															View All
														</button>
													</a>
														<!-- </li> -->
														<h3>Notices</h3>
														<?php
														


														foreach (@$notices_latest_news as $sn => $noticelist) :
															$current_date =  date('Y-m-d');
															$nl_date = date('Y-m-d', strtotime($noticelist->effect_from_date));

														?>

															<!-- <li> -->
															<div class="announcements">
															<p><strong><?= $noticelist->pdf_name ?></strong></p>
															<div class="date"><?= date('F j, Y',strtotime($noticelist->effect_from_date)) ?></div>

																




																<?php if ($current_date == $nl_date) {
																	echo '<img src="images/new.gif" style="width:40px">';
																}
																?>
																<?php
																$uploadPath = 'notices' . '/' . $noticelist->attachment;
																$file_location = $this->route->get_base_url() . "/" . $uploadPath;
																?>
																<a style="color:blue;text-decoration:underline" href="<?= $file_location ?>" target="_blank"><?= $noticelist->pdf_name ?></a>


																<!--  Form Start  --->


																</td>

																</tr>
																</div>
															<?php endforeach; ?>
																
															<a href='<?php echo $noticepage; ?>' target="_blank">
														<button class="GFG">
															View All
														</button>
													</a>
															<!-- </li> -->
															<h3>Tender</h3>

															<?php


															foreach (@$tenders_latest_news as $sn => $tendercreationlist) :
																$current_date =  date('Y-m-d');
																$tender_date = date('Y-m-d', strtotime($tendercreationlist->effect_from_date));

															?>

																<!-- <li> -->


																<div class="announcements">
															<p><strong><?= $tendercreationlist->pdf_name ?></strong></p>
															<div class="date"><?= date('F j, Y',strtotime($tendercreationlist->effect_from_date)) ?></div>
																	
																
																<?= $tendercreationlist->pdf_name ?>
																	<?php if ($current_date == $tender_date) {
																		echo '<img src="images/new.gif" style="width:40px">';
																	}
																	?>
																	<?php
																	$uploadPath = 'tender' . '/' . $tendercreationlist->attachment;
																	$file_location = $this->route->get_base_url() . "/" . $uploadPath;
																	?>
																	<a style="color:blue;text-decoration:underline" href="<?= $file_location ?>" target="_blank"><?= $tendercreationlist->pdf_name ?></a>
																</div>

																<?php endforeach; ?>
																<a href='<?php echo $tenderpage; ?>' target="_blank">
														<button class="GFG">
															View All
														</button>
													</a>
																<!-- </li> -->

											</marquee>


										<!-- </ul> -->


									</div>
								</div>
								<div class="tab-pane" id="two">
									<ul>
										<!-- <marquee behavior=scroll direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();"> -->

										<li style="padding:10px"><a href="IndexController/knowyourstatus" target="_blank" style="color:blue;text-decoration:underline;">Know Your Application Status</a></li>
										<li style="padding:10px"><a href="IndexController/knowyourvenuedetails" target="_blank" style="color:blue;text-decoration:underline;">Know Your Exam Date & City</a></li>
										<li style="padding:10px"><a href="IndexController/admitcard" target="_blank" style="color:blue;text-decoration:underline;">Admit Card or Call Letter</a></li>


										<!-- </marquee> -->
									</ul>
								</div>
							</div>
						</div>
						<!-- Lastest News Div-->

					</div>
				</div>
			</section>


			<?php include "footer2.php"; ?>

		</div>
	</div>
</Section>
<style>
	.announcements {
    -webkit-box-shadow: 0px 0px 5px 0px rgb(0 0 0 / 15%);
    -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.15);
    box-shadow: 0px 0px 5px 0px rgb(0 0 0 / 15%);
    padding: 15px;
    border-radius: 5px;
    position: relative;
    margin-bottom: 20px;
    border: 2px solid #3D8943;
    font-weight: 600;}
	.announcements .date {
    position: absolute;
    right: 15px;
    bottom: 15px;
    font-size: 9pt;
    font-weight: lighter;
}
	.GFG {
		position: relative;
    left: 408px;
    bottom: 15px;
    font-size: 9pt;
    font-weight: lighter;
        }

</style>

<?php echo $this->get_footer(); ?>