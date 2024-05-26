<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == '2NDRESP' || $_SESSION['desg_code'] == 'CRTR') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
} else {
    header("location: ../action/index.php");
}
?>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        require '../constant/db_connect.php';
        $id = $_POST['uniq_id_2'];
        //print_r($id);
        $sql_single_client = "SELECT * FROM `crm_master_table` WHERE uniq_id='$id'";
        $result3 = mysqli_query($conn,$sql_single_client);
        $row = mysqli_fetch_assoc($result3);

        $data['client_name']=$row['client_name'];
        $data['client_contact']=$row['client_contact'];
        $data['client_email']=$row['client_email'];
        $data['client_state']=$row['client_state'];
        $data['client_city']=$row['client_city'];
        $data['code']=$row['code'];
        $data['reference']=$row['reference'];
        $data['category']=$row['category'];
        $data['doa_1']=$row['doa_1'];
        $data['first_resp']=$row['1st_resp'];
        $data['doa_2']=$row['doa_2'];
        $data['second_resp']=$row['2nd_resp'];
        $data['doa_3']=$row['doa_3'];
        $data['third_resp']=$row['3rd_resp'];
        $data['uniq_id']=$row['uniq_id'];
        //echo($row['client_name'].$row['client_contact'].$row['client_email'].$row['client_state'].$row['client_city'].$row['code'].$row['reference'].$row['category'].$row['doa_1'].$row['1st_resp'].$row['doa_2'].$row['2nd_resp'].$row['doa_3'].$row['3rd_resp'].$row['uniq_id']);
        echo json_encode($data);
    }
?>