<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'CEO' || $_SESSION['desg_code'] == 'CRTR') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
} else {
    header("location: ../action/index.php");
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $client_ids = $_POST['client_ids'];
    $doc = $_POST['doc'];
    $doa_1 = $_POST['doa_1'];
    $client_state_update = $_POST['editClientState'];
    $client_contact_update = $_POST['editClientContact'];
    $client_2ndresp_update = $_POST['edit2Resp'];
    $client_3rdresp_update = $_POST['edit3Resp'];

    /*$sql_client_details_update = "UPDATE `crm_master_table` SET `client_name`='$client_name_update',`client_contact`='$client_contact_update',`client_state`='$client_state_update',`code`='$client_code_update',`2nd_resp`='$client_2ndresp_update',`3rd_resp`='$client_3rdresp_update' WHERE `uniq_id`=$client_uniq_id;";
    $result_client_details_update = mysqli_query($conn,$sql_client_details_update);
    if($result_client_details_update){
        header('location: ../action/master_crm.php');
    }*/
}
?>