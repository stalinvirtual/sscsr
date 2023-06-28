<?php
require_once("config/db.php");


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    require_once("functions.php");
    $request = $_POST['request'];
    $id = $_POST['id'];
    // Fetch Coulmn details For Update Purpose
    if ($request == 2) {
        $id = 0;

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }

        $query = "SELECT * FROM column_master WHERE col_id=?";
        //echo  $query;

        $result = $pdo->prepare($query);
        $result->execute([$id]);
        $resultCount = $result->fetchColumn();


        //$resultCount = getRowCount($query,$id);

        $response = array();

        if ($resultCount > 0) {
            $row = getSingleRow($query, $id);

            $response = array(
                "col_name" => $row->col_name,
                "col_description" => $row->col_description,
                "is_kyas" => $row->is_kyas,
                "is_tier" => $row->is_tier,
                "is_skill" => $row->is_skill,
                "is_dme" => $row->is_dme,
                "is_pet" => $row->is_pet,
                "is_dv" => $row->is_dv
            );

            echo json_encode(
                array(
                    "status" => 1,
                    "data" => $response
                )
            );
            exit;
        } else {
            echo json_encode(
                array(
                    "status" => 0
                )
            );
            exit;
        }
    }

    // Update user
    if ($request == 3) {



        $query = "SELECT * FROM column_master WHERE col_id=?";
        //echo  $query;

        $result = $pdo->prepare($query);
        $result->execute([$id]);
        $resultCount = $result->fetchColumn();







        if ($resultCount > 0) {

            $column_name_update = $_POST['column_name_update'];
            $column_description_update = $_POST['column_description_update'];

            $myCheckboxes = $_POST['myCheckboxes'];

            //print_r($_POST['myCheckboxes']);
            $cnt = count($myCheckboxes);
            //echo $cnt;
            // if ($cnt == 1) {
            $is_kyas = '0';
            $is_tier = '0';
            $is_skill = '0';
            $is_dme = '0';
            $is_pet = '0';
            $is_dv = '0';
            foreach ($myCheckboxes as $val) {
                if ($val == "kyas") {
                    $is_kyas = '1';
                }

                if ($val == "tier") {
                    $is_tier = '1';
                }

                if ($val == "skill") {
                    $is_skill = '1';
                }

                if ($val == "dme") {
                    $is_dme = '1';
                }

                if ($val == "pet") {
                    $is_pet = '1';
                }

                if ($val == "dv") {
                    $is_dv = '1';
                }

            }
            // }
            /* else {
                $is_kyas = 1;
                $is_tier = 1;
            $is_skill = 1;
                $is_pet = 1;
            $is_dv = 1;
               
            }  */
        }

        try {
            $sql = "UPDATE column_master SET col_name='" . $column_name_update . "',col_datatype='text',col_description='" . $column_description_update . "',is_kyas='" . $is_kyas . "',is_tier='" . $is_tier . "',is_skill='" . $is_skill . "',is_dme='" . $is_dme . "',is_pet='" . $is_pet . "',is_dv='" . $is_dv . "',status='0' WHERE col_id=" . $id;

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $message = array(
                'response' => array(
                    'status' => 'success',
                    'code' => '1',
                    // whatever you want
                    'message' => 'Column Updated Successfully.',
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
    }
    // Delete user
    if ($request == 4) {

        // Check id
        $query = "SELECT * FROM column_master WHERE col_id=?";
        //echo  $query;

        $result = $pdo->prepare($query);
        $result->execute([$id]);
        $resultCount = $result->fetchColumn();
       
        if ($resultCount > 0) {
            try {
                $sql = "UPDATE column_master SET status='1' WHERE col_id=?";
                

                $stmt = $pdo->prepare($sql);
                $stmt->execute([$id]);
                $message = array(
                    'response' => array(
                        'status' => 'success',
                        'code' => '1',
                        // whatever you want
                        'message' => 'Column Deleted Successfully.',
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
        }
    }

    echo json_encode($message);
} else {
    header("Location: index.php");
    exit();
}