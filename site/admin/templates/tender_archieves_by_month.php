<?php
include 'archive_common_template.php';
$tableHeadingArray = array(
    "Tender Name",
    "Pdf File",
    "From Date",
    "To Date",
    "Status",
    "Action",
);
echo getTemplate(
    "tender_arc_form", 'year', 'month', 'effect_from_date', 'effect_to_date', 'elink', 'dlink', $edit_tender_link, $delete_tender_link, 'alink', $common_archives__link, 'form_submit_btn', 'form_reset_btn', 'frm-example-tender', $tender_boy, $is_publisher, $create_tender_link, 'Add Tender',$tableHeadingArray,'example'

);
?>