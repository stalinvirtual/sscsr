<?php
echo $this->get_header(); ?>
<br>
<div class="container">
			<div class="row rowClass">
				<div class="col-lg-12">
					<h2>Archives  </h2>
				</div>
			</div> 
		</div>
		<br>
<div class="container">
	<div class="row">

		<div class=" col-lg-12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#one" data-toggle="tab"><i class="icon-briefcase"></i><b>Nomination </b></a></li>
				<li class=""><a href="#two" data-toggle="tab"><i class="icon-briefcase"></i><b>Selection Post &nbsp;</b></a></li>
				<li class=""><a href="#three" data-toggle="tab"><i class="icon-briefcase"></i><b>Notice &nbsp;</b></a></li>
				 <li class=""><a href="#four" data-toggle="tab"><i class="icon-briefcase"></i><b>Tender &nbsp;</b></a></li> 

			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="one">
					<?php include "nomination_archives.php" ?>
				</div>
				<div class="tab-pane" id="two">
					<?php include "selection_post_archives.php" ?>
				</div>
				<div class="tab-pane" id="three">
					<?php include "notices_archives.php" ?>
				</div>

				<div class="tab-pane" id="four">
					<?php include "tender_archives.php" ?>
				</div>
				
				
			</div>
		</div>
	</div>
</div>


<?php include "footer2.php";?>


<?php echo $this->get_footer(); ?>

<style>
	.tab-content>.tab-pane {
		border: none !important;
	}
</style>










