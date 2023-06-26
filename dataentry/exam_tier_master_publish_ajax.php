<?php
require_once("config/db.php");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    require_once("functions.php");

    $id = sanitize_string_value($_POST['exam_tier_master_id']);
    $count_of_days = sanitize_string_value($_POST['count_of_days']);

    // Update user

    try {

        date_default_timezone_set("Asia/Calcutta");
        $updated_time = $date = date("Y-m-d H:i:s");
        $sql = "UPDATE public.sscsr_db_table_tier_master SET  no_of_days='$count_of_days',updated_on = '$updated_time' WHERE id='$id'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $message = array(
            'response' => array(
                'status' => 'success',
                'code' => '1',
                // whatever you want
                'message' => 'Count of Days  Updated Successfully.',
                'title' => "success"
            )
        );
    } catch (Exception $e) {

        $message = array(
            'response' => array(
                'status' => 'error',
                'code' => '0',
                // whatever you want
                'message' => $e->getMessage(),
                'title' => 'Error'
            )
        );
    }



    echo json_encode($message);
} else {
    header("Location: index.php");
    exit();
}