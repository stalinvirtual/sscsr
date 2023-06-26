<!-- session -->
<?php
require_once("config/db.php");
require_once("functions.php");
session_start();
if (!isset($_SERVER['HTTP_REFERER']) || !isset($_SESSION['sess_user'])) {
	header("Location: login.php");
} else {
	?>
	<!-- header -->
	<?php include('header.php'); ?>
	<div class="main-grid">
		<div class="panel panel-widget forms-panel">
			<div class="forms">
				<div class="inline-form widget-shadow">
					<div class="form-title">
						<div class="row">
							<div class="col-md-12 form-group">
								<h4>Admit Card Preview</h4>
							</div>
						</div>
					</div>
					<div class="form-body">
						<div class="row">
							<div class="col-md-12 form-group videoWrapper">
								<iframe id="forPostyouradd" height='200%' width="100%"
									data-src="http://10.163.2.160/projects/sscsr/site/IndexController/admitcardpreview"
									src="about:blank" class="responsive-iframe" allowfullscreen
									style="background:#ffffff"></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
<?php include('footer.php'); ?>
<script type="text/javascript">

	$(document).ready(function () {


		var iframe = $("#forPostyouradd");
		iframe.attr("src", iframe.data("src"));

	});
</script>

<style>
	.videoWrapper {
		position: relative;
		padding-bottom: 56.25%;
		/* 16:9 */
		padding-top: 25px;
		height: 0;
	}

	.videoWrapper iframe {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}
</style>