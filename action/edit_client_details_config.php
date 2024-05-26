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
    $unq_id = $_POST['client_unqid'];
    //$data['id'] = $unq_id;
    require '../constant/db_connect.php';
    $sql_client_data_change = "SELECT * FROM `crm_master_table` WHERE `uniq_id`=$unq_id;";
    $result_client_data_change = mysqli_query($conn, $sql_client_data_change);
    $row_client_data_change = mysqli_fetch_assoc($result_client_data_change);
    $data['doc'] = $row_client_data_change['doc'];
    $data['client_name'] = $row_client_data_change['client_name'];
    $data['client_contact'] = $row_client_data_change['client_contact'];
    $data['client_email'] = $row_client_data_change['client_email'];
    $data['client_state'] = $row_client_data_change['client_state'];
    $data['code'] = $row_client_data_change['code'];
    $data['period'] = $row_client_data_change['period'];
    $data['doa_1'] = $row_client_data_change['doa_1'];
    $data['first_resp'] = $row_client_data_change['1st_resp'];
    $data['doa_2'] = $row_client_data_change['doa_2'];
    $data['second_resp'] = $row_client_data_change['2nd_resp'];
    $data['doa_3'] = $row_client_data_change['doa_3'];
    $data['third_resp'] = $row_client_data_change['3rd_resp'];
    $data['bcr'] = $row_client_data_change['bcr'];
    $data['verified'] = $row_client_data_change['verified'];
    $data['pcr'] = $row_client_data_change['pcr'];
    $data['remarks'] = $row_client_data_change['remarks'];
    $data['uniq_id'] = $row_client_data_change['uniq_id'];

    echo json_encode($data);
}
?>