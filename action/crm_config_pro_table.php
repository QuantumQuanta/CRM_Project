<?php
// require '../action/session_control.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_client_uniq_id = $_POST['id'];
    $input_client_name = $_POST['clientName'];
    $input_client_state = $_POST['clientState'];
    $input_client_city = $_POST['clientcity'];
    $input_client_Code = $_POST['clientCode'];
    // $data['id'] = $_POST['id'];
    //echo $input_client_uniq_id;
    $_SESSION['client_uniq_id'] = $input_client_uniq_id;
    $_SESSION['client_name'] = $input_client_name;
    $_SESSION['client_state'] = $input_client_state;
    $_SESSION['client_city'] = $input_client_city;
    $_SESSION['client_Code'] = $input_client_Code;

    //echo ($data);

}
