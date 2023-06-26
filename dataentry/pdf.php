<?php
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="myPDF.pdf');

// Send Headers: Prevent Caching of File
header('Cache-Control: private');
header('Pragma: private');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
?>

