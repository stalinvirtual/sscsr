<?php 
/** 
 * if the included view file is not found this page will be rendered
 */
?>
<div class="<?php echo $error?>" style="padding:10px; border:1px dashed #f00">
	The included file <strong><?php echo $file_path;?></strong> is not found, please create this file and check it 
</div>