<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ((isset($_POST['token'])) && ($_POST['token'] == 'docLoad')) {
        require '../constant/db_connect.php';

        $client_uniq_id = intval($_POST['client_uniq_id']);
        $sql_mixed_output = "SELECT * FROM `mixed_input_proresp` WHERE uniq_id=? ORDER BY dt DESC";
        $stmt_mixed_output = mysqli_prepare($conn, $sql_mixed_output);
        mysqli_stmt_bind_param($stmt_mixed_output, "i", $client_uniq_id);
        mysqli_stmt_execute($stmt_mixed_output);
        $res_mixed_output = mysqli_stmt_get_result($stmt_mixed_output);
        $data = [];
        $response = [];
        // echo json_encode($mixed_rowNum);
        if ($res_mixed_output != false) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($res_mixed_output)) {
                $data['dt'] = date('g:i A d.m.y', strtotime($row['dt']));
                $data['contacted_us'] = $row['contacted_us'];
                $data['kyc_stat'] = $row['kyc_stat'];
                $data['pcr_priority'] = $row['pcr_priority'];
                $data['pcr_et'] = $row['pcr_et'];
                $data['call_type'] = $row['call_type'];
                $data['call_stat'] = $row['call_stat'];
                $data['category'] = $row['category'];
                $data['source'] = $row['source'];
                $data['comment_1'] = $row['comment_1'];
                $data['client_stat_1'] = $row['client_stat_1'];
                $data['pcr_resp_1'] = $row['pcr_resp_1'];
                $data['pcr_pt_1'] = $row['pcr_pt_1'];
                $data['client_rating_1'] = $row['client_rating_1'];
                $data['comment_2'] = $row['comment_2'];
                $data['client_stat_2'] = $row['client_stat_2'];
                $data['pcr_resp_2'] = $row['pcr_resp_2'];
                $data['pcr_pt_2'] = $row['pcr_pt_2'];
                $data['pcr_prc'] = $row['pcr_prc'];
                $data['client_rating_2'] = $row['client_rating_2'];
                // $data[$i] = $formattedDateTime . "|" . $row['contacted_us'] . "|" . $row['kyc_stat'] . "|" . $row['pcr_priority'] . "|" . $row['pcr_et'] . "|" . $row['call_type'] . "|" . $row['call_stat'] . "|" . $row['category'] . "|" . $row['source'] . "|" . $row['comment_1'] . "|" . $row['client_stat_1'] . "|" . $row['pcr_resp_1'] . "|" . $row['pcr_pt_1'] . "|" . $row['client_rating_1'] . "|" . $row['comment_2'] . "|" . $row['client_stat_2'] . "|" . $row['pcr_resp_2'] . "|" . $row['pcr_pt_2'] . "|" . $row['pcr_prc'] . "|" . $row['client_rating_2'];
                $response[$i] = $data;
                $i++;
            }
            echo json_encode($response);
        } else {
            echo json_encode(["error" => mysqli_error($conn)]);
        }
    }
}
