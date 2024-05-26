<?php
/*
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'CEO' || $_SESSION['desg_code'] == 'CRTR') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
    //echo $client_unique_id;
} else {
    header("location: ../action/index.php");
}*/
?>
<?php
header('Content-Type: text/html; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../constant/db_connect.php';
    $client_unq_id = $_POST['client_id_val'];
    // session_start();
    // $_SESSION['clientUniqueId'] = $_POST['client_id_val'];
    $sql_mixTable = "SELECT * FROM `mixed_input_proresp` WHERE `uniq_id`=$client_unq_id ORDER BY `dt`DESC;";
    $result_mixTable = mysqli_query($conn, $sql_mixTable);
    $rowNum = mysqli_num_rows($result_mixTable);
    //$data_mixTable = array();
    $i = 0;
    $response;
    while ($row_mixTable = mysqli_fetch_assoc($result_mixTable)) {
        $formatted_date_mixed = date('g:i A d.m.y', strtotime($row_mixTable['dt']));
        $data['dt' . $i] = $formatted_date_mixed;
        $data['pro_name' . $i] = $row_mixTable['pro_name'];
        $data['contacted_us' . $i] = $row_mixTable['contacted_us'];
        $data['kyc_stat' . $i] = $row_mixTable['kyc_stat'];
        $data['pcr_priority' . $i] = $row_mixTable['pcr_priority'];
        $data['pcr_et' . $i] = $row_mixTable['pcr_et'];
        $data['call_type' . $i] = $row_mixTable['call_type'];
        $data['call_stat' . $i] = $row_mixTable['call_stat'];
        $data['category' . $i] = $row_mixTable['category'];
        $data['source' . $i] = $row_mixTable['source'];
        $data['comment_1' . $i] = $row_mixTable['comment_1'];
        $data['client_stat_1' . $i] = $row_mixTable['client_stat_1'];
        $data['pcr_resp_1' . $i] = $row_mixTable['pcr_resp_1'];
        $data['pcr_pt_1' . $i] = $row_mixTable['pcr_pt_1'];
        $data['client_rating_1' . $i] = $row_mixTable['client_rating_1'];
        $data['sec_resp_name' . $i] = $row_mixTable['sec_resp_name'];
        $data['comment_2' . $i] = $row_mixTable['comment_2'];
        $data['client_stat_2' . $i] = $row_mixTable['client_stat_2'];
        $data['pcr_resp_2' . $i] = $row_mixTable['pcr_resp_2'];
        $data['pcr_pt_2' . $i] = $row_mixTable['pcr_pt_2'];
        $data['pcr_prc' . $i] = $row_mixTable['pcr_prc'];
        $data['client_rating_2' . $i] = $row_mixTable['client_rating_2'];
        $i++;
    }
    $response['data'] = $data;
    $response['rowNum'] = $rowNum;
    echo json_encode($response);
    flush();
    sleep(1);
}

?>