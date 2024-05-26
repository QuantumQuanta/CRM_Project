<?php
// require '../action/session_control.php';
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $input_client_uniq_id2 = $_POST['id2'];
    $input_client_name2 = $_POST['clientName2'];
    $input_client_state2 = $_POST['clientState2'];
    $input_client_city2 = $_POST['clientcity2'];
    $input_client_Code2 = $_POST['clientCode2'];
    //echo $input_client_uniq_id;
    $_SESSION['client_uniq_id2'] = $input_client_uniq_id2;
    $_SESSION['client_name2'] = $input_client_name2;
    $_SESSION['client_state2'] = $input_client_state2;
    $_SESSION['client_city2'] = $input_client_city2;
    $_SESSION['client_Code2'] = $input_client_Code2;

}