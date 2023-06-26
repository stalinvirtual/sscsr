<?php







// Parameters
$type = $_GET['type'];
$CKEditor = $_GET['CKEditor'];
$funcNum = $_GET['CKEditorFuncNum'];

if($type == 'image'){

	$allowed_extension = array(
	  "png","jpg","jpeg"
	);

	// Get image file extension
	$file_extension = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);

	if(in_array(strtolower($file_extension),$allowed_extension)){


        $file = rand(1000, 100000) . "-" . $_FILES['upload']['name'];
        $file_loc = $_FILES['upload']['tmp_name'];
        $file_size = $_FILES['upload']['size'];
        $file_type = $_FILES['upload']['type'];
        $folder = './uploads/';
        $new_size = $file_size / 1024;
        /* make file name in lower case */
        $new_file_name = strtolower($file);
        /* make file name in lower case */
        $final_file = str_replace(' ', '-', $new_file_name);

	   
	   if(move_uploaded_file($file_loc, $folder . $final_file)){
		  // File path
		  if(isset($_SERVER['HTTPS'])){
			 $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
		  }
		  else{
			 $protocol = 'http';
		  }
          $url = $protocol . "://" . $_SERVER['SERVER_NAME'] . "/rd/sscsr/site/uploads/" .$final_file;
	   
		  echo '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
	   }

	}

	exit;
}

if ($type == 'file') {

    $allowed_extension = array(
        "doc", "pdf", "docx"
    );

    // Get image file extension
    $file_extension = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);

    if (in_array(strtolower($file_extension), $allowed_extension)) {

        $file = rand(1000, 100000) . "-" . $_FILES['upload']['name'];
        $file_loc = $_FILES['upload']['tmp_name'];
        $file_size = $_FILES['upload']['size'];
        $file_type = $_FILES['upload']['type'];
        $folder = './uploads/';
        $new_size = $file_size / 1024;
        /* make file name in lower case */
        $new_file_name = strtolower($file);
        /* make file name in lower case */
        $final_file = str_replace(' ', '-', $new_file_name);





        if (move_uploaded_file($file_loc, $folder . $final_file)) {
            // File path
            if (isset($_SERVER['HTTPS'])) {
                $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
            } else {
                $protocol = 'http';
            }

            $url = $protocol . "://" . $_SERVER['SERVER_NAME'] . "/rd/sscsr/site/uploads/" . $final_file;

            echo '<script>window.parent.CKEDITOR.tools.callFunction(' . $funcNum . ', "' . $url . '", "' . $message . '")</script>';
        }
    }

    exit;
}
