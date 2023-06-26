<?php
include 'archive_common_template.php';
$tableHeadingArray = array(
    "Exam Name",
    "Category Name",
    "Pdf File",
    "From Date",
    "To Date",
    "Status",
    "Action",
);
echo getTemplate(
    "tender_arc_form", 'year', 'month', 'effect_from_date', 'effect_to_date', 'elink', 'dlink', $edit_nomination_link, $delete_nomination_link, 'alink', $common_archives__link, 'form_submit_btn', 'form_reset_btn', 'frm-example-tender', $tender_boy, $is_publisher, $create_nomination_link, 'Add Nomination',$tableHeadingArray,'example'

);
?>