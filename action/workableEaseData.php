<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../constant/db_connect.php';
    //For PROs=>
    if ((isset($_POST["userDesg"])) && ($_POST["userDesg"] == "PRO")) {
        $user = $_POST["userName"];
        $clntid = intval($_POST["clientUID"]);
        $data_workable = [];
        $sql_workable = "SELECT * FROM `mixed_input_proresp` WHERE `uniq_id` = ? AND `pro_name`= ? ORDER BY `dt` DESC LIMIT 1";
        $stmt_workable = mysqli_prepare($conn, $sql_workable);
        mysqli_stmt_bind_param($stmt_workable, 'is', $clntid, $user);
        if (mysqli_stmt_execute($stmt_workable)) {
            if ($res_workable = mysqli_stmt_get_result($stmt_workable)) {
                // echo json_encode("Result=>suc");
                if ($row_workable = mysqli_fetch_assoc($res_workable)) {
                    $data_workable["desgCode"] = "PRO"; 
                    $data_workable["contact_stat"] = $row_workable["contacted_us"];
                    $data_workable["kyc_stat"] = $row_workable["kyc_stat"];
                    $data_workable["pcr_priority_1"] = $row_workable["pcr_priority"];
                    $data_workable["pcr_et_1"] = $row_workable["pcr_et"];
                    $data_workable["call_type"] =  $row_workable["call_type"];
                    $data_workable["call_stat"] = $row_workable["call_stat"];
                    $data_workable["category"] = $row_workable["category"];
                    $data_workable["source"] = $row_workable["source"];
                    $data_workable["client_stat_1"] = $row_workable["client_stat_1"];
                    $data_workable["pcr_resp_1"] = $row_workable["pcr_resp_1"];
                    $data_workable["pcr_pt_1"] = $row_workable["pcr_pt_1"];
                    $data_workable["client_rating_1"] = $row_workable["client_rating_1"];
                }
            }
        }
        echo json_encode($data_workable);
    }
    //For RESP=>
    elseif((isset($_POST["userDesg"])) && ($_POST["userDesg"] == "2NDRESP")) {
        $user = $_POST["userName"];
        $clntid = intval($_POST["clientUID"]);
        $data_workable = [];
        $sql_workable = "SELECT * FROM `mixed_input_proresp` WHERE `uniq_id` = ? AND `sec_resp_name`= ? ORDER BY `dt` DESC LIMIT 1";
        $stmt_workable = mysqli_prepare($conn, $sql_workable);
        mysqli_stmt_bind_param($stmt_workable, 'is', $clntid, $user);
        if (mysqli_stmt_execute($stmt_workable)) {
            if ($res_workable = mysqli_stmt_get_result($stmt_workable)) {
                // echo json_encode("Result=>suc");
                if ($row_workable = mysqli_fetch_assoc($res_workable)) {
                    $data_workable["desgCode"] = "2RESP"; 
                    $data_workable["client_stat_2"] = $row_workable["client_stat_2"];
                    $data_workable["pcr_resp_2"] = $row_workable["pcr_resp_2"];
                    $data_workable["pcr_pt_2"] = $row_workable["pcr_pt_2"];
                    $data_workable["pcr_prc"] = $row_workable["pcr_prc"];
                    $data_workable["client_rating_2"] =  $row_workable["client_rating_2"];
                }
            }
        }
        echo json_encode($data_workable);
    }
}
