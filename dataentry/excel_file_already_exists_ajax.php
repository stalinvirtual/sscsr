<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

	if (!is_array($_FILES["excel_file_attachment"]["name"])) //single file
	{

		$extension = pathinfo($_FILES['excel_file_attachment']['name'], PATHINFO_EXTENSION);




		if (($extension == "xls") || ($extension == "xlsx")) {

			$fileName = $_FILES["excel_file_attachment"]["name"];
			$output_dir = 'uploaded_excel_files/';
			// check if fileName already exists
			if (file_exists($output_dir . $fileName)) {
				$fileName = $_FILES["excel_file_attachment"]["name"];


				$message = array(
					'response' => array(
						'status' => 'already_exists',
						'code' => '0',
						// whatever you want
						'message' => 'excel file already exists',
						'title' => 'Warning!'
					)
				);
			} else {

				$message = array(
					'response' => array(
						'status' => 'success',
						'code' => '1',
						// whatever you want
						'message' => 'excel file uploaded successfully',
						'title' => 'Warning!'
					)
				);

			}
		} else { // file Checking

			$message = array(
				'response' => array(
					'status' => 'Excel File only All',
					'code' => '2',
					// whatever you want
					'message' => 'Excel File only Allowed',
					'title' => 'Warning!'
				)
			);

		}






	}
	echo json_encode($message);

} else {

	header("Location: index.php");
	exit();
}