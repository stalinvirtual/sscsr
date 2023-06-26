<?php
require_once("phpqrcode/qrlib.php");
  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
phpinfo();

QRcode::png("1234567435ddddfghbd"); */
$student_name = 'Jeevitha';
	$student_roll_no = 1;
	$tempDir = 'temp/';  // file path after clicking download button this qr image will be downloaded in temp folder
	$filename = 'qrCode1';
	$codeContents = 'Student Name: '. $student_name . ' , Student Roll No: ' . $student_roll_no; // this is our string
	
	QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5); 