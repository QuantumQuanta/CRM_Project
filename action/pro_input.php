<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'PRO' || $_SESSION['desg_code'] == 'CRTR') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
} else {
    header("location: ../action/index.php");
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //database connection
    require '../constant/db_connect.php';
    include '../constant/encrypt_decrypt.php';

    $client_uniq_id = ($_POST['client_uniq_id_trans']);
    $pro_name = ($_POST['1st_resp']);
    $contact_stat = ($_POST['contact_stat']);
    $kyc_stat = ($_POST['kyc_stat']);
    $call_stat = ($_POST['call_stat']);
    $call_type = ($_POST['call_type']);
    $category = ($_POST['category']);
    $source = ($_POST['source']);
    $client_stat_1 = ($_POST['client_stat_1']);
    $pcr_priority_1 = ($_POST['pcr_priority_1']);
    $pcr_et_1 = ($_POST['pcr_et_1']);
    $date_time = ($_POST['date_time_1']);
    $pcr_resp_1 = ($_POST['pcr_resp_1']);
    $pcr_pt_1 = ($_POST['pcr_pt_1']);
    $client_rating_1 = ($_POST['client_rating_1']);
    $comment_1 = ($_POST['comment_1']);
    //echo($pro_name.$contact_stat.$kyc_stat.$call_stat.$call_type.$category.$source.$client_stat_1.$date_time.$pcr_resp_1.$pcr_pt_1.$comment_1);
    //$sql_client_pro_data = "INSERT INTO `pro_input_data`(`uniq_id`, `1st_resp`, `contacted_us`, `kyc_stat`, `call_stat`, `call_type`, `category`, `source`, `client_stat_1`, `pcr_priority`, `pcr_et`, `pcr_resp_1`, `pcr_pt_1`, `comment_1`, `client_rating_1`, `date_time_1`) VALUES ('$client_uniq_id','$pro_name','$contact_stat','$kyc_stat','$call_stat','$call_type','$category','$source','$client_stat_1','$pcr_priority_1','$pcr_et_1','$pcr_resp_1','$pcr_pt_1','$comment_1','$client_rating_1','$date_time')";
    //$sql_client_pro_data_join = "INSERT INTO `joined_pro_2resp_dt` (`uniq_id`, `1st_resp`, `contacted_us`, `kyc_stat`, `call_stat`, `call_type`, `category`, `source`, `client_stat_1`,`pcr_priority`,`pcr_et`, `pcr_resp_1`, `pcr_pt_1`, `comment_1`, `client_rating_1`, `date_time_1`) VALUES ('".$client_uniq_id."', '".$pro_name."', '".$contact_stat."', '".$kyc_stat."', '".$call_stat."', '".$call_type."', '".$category."', '".$source."', '".$client_stat_1."','".$pcr_priority_1."','".$pcr_et_1."', '".$pcr_resp_1."', '".$pcr_pt_1."', '".$comment_1."', '".$client_rating_1."', '".$date_time."')";
    $result_client_pro_data = mysqli_query($conn, $sql_client_pro_data);

    if ($result_client_pro_data) {
        $msg_suc = "1";
        //echo json_encode($data);
        header("location: ../action/pro_workable.php?msg_suc=" . $msg_suc);
    } else {
        $msg_unsuc = "0";
        //echo json_encode($data);
        header("location: ../action/pro_workable.php?msg_unsuc=" . $msg_unsuc);
    }
}

?>