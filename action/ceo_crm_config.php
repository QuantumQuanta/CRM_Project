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
if($_SERVER['REQUEST_METHOD'] == "POST"){
    require '../constant/db_connect.php';
    $client_id_val = $_POST['client_id_val'];
    $sql_client_data_fetch ="SELECT * FROM `crm_master_table` WHERE uniq_id='$client_id_val'";
    $result_client_data_fetch = mysqli_query($conn,$sql_client_data_fetch);
    $row_client_data_fetch = mysqli_fetch_assoc($result_client_data_fetch);

    //response data of client
    $response['client_name'] = $row_client_data_fetch['client_name'];
    $response['client_contact'] = $row_client_data_fetch['client_contact'];
    $response['client_email'] = $row_client_data_fetch['client_email'];
    $response['client_state'] = $row_client_data_fetch['client_state'];
    $response['client_city'] = $row_client_data_fetch['client_city'];
    $response['code'] = $row_client_data_fetch['code'];
    $response['reference'] = $row_client_data_fetch['reference'];
    $response['category'] = $row_client_data_fetch['category'];
    $response['doa_1'] = $row_client_data_fetch['doa_1'];
    $response['first_resp'] = $row_client_data_fetch['1st_resp'];
    $response['doa_2'] = $row_client_data_fetch['doa_2'];
    $response['second_resp'] = $row_client_data_fetch['2nd_resp'];
    $response['doa_3'] = $row_client_data_fetch['doa_3'];
    $response['third_resp'] = $row_client_data_fetch['3rd_resp'];
    $response['uniq_id'] = $row_client_data_fetch['uniq_id'];
    
    echo json_encode($response);


}
?>