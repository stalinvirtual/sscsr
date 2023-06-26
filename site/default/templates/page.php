

<?php
echo $this->get_header();


?>



<section id="fontSize" class="wrapper body-wrapper " style="font-size: 100%;">
    <div class="bg-wrapper inner-wrapper">
	

	
	<div class="container">
		<div class="row breadcrumbruler">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="index.php" class="breadcrumb_text_color">Home</a><i class="icon-angle-right"></i></li>
					<li><a href="#" class="bread"> <?php echo $page->title; ?> </a><i class="icon-angle-right"></i></li>
				</ul>
			</div>
		</div>
	</div>
	
        <div class="body-container container">

            <div class="inner-content">
                <h2><?php echo $page->title; ?> </h2>

			
				
                <?php 



				
						if($page->page_content == '' && $page->status == 0){
							echo $page->last_content ;
						}else if($page->page_content != '' && $page->status == 1){?>
						
							<div class="pageContentClass "><?php echo $page->page_content ;?></div>
						<?php }
						else {
							echo "Somthing Went Wront!..." ;
						}
				 ?>
            </div>

        </div>

    </div>

</section>
<style>
.pageContentClass a {
    color: #428bca !important;
	text-decoration: underline !important;
}

.pageContentClass table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.pageContentClass td, .pageContentClass th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.pageContentClass 	tr:nth-child(even) {
  background-color: #dddddd;
}

</style>
<br>
<?php include "footer2.php";?>
<div <?php echo $this->get_footer(); ?>

