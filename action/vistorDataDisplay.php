<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../constant/db_connect.php';
    $visIdno = $_POST['visId'];
    $sqlVisData = "SELECT * FROM `visitor_log` WHERE `vis_unqidno` = $visIdno";
    $sqlVisName = "SELECT `vis_name` FROM `visitor_log_main` WHERE `vis_unq_id`= $visIdno";

    $resVisData = mysqli_query($conn, $sqlVisData);
    $resVisName = mysqli_query($conn,$sqlVisName);
    
    $visNameData = mysqli_fetch_assoc($resVisName);
    $dataNum = mysqli_num_rows($resVisData);
    $i = 0;
    while ($rowVisData = mysqli_fetch_assoc($resVisData)) {
        $data['vis_dt' . $i] = $rowVisData['vis_dt'];
        $data['vis_eta' . $i] = $rowVisData['vis_eta'];
        $data['vis_ata' . $i] = $rowVisData['vis_ata'];
        $data['vis_assname' . $i] = $rowVisData['vis_assname'];
        $data['vis_tomeet' . $i] = $rowVisData['vis_tomeet'];
        $data['vis_meetroom' . $i] = $rowVisData['vis_meetroom'];
        $data['vis_idno' . $i] = $rowVisData['vis_idno'];
        $data['vis_assidno' . $i] = $rowVisData['vis_assidno'];
        $data['vis_kycstat' . $i] = $rowVisData['vis_kycstat'];
        $data['vis_address' . $i] = $rowVisData['vis_address'];
        $data['vis_email' . $i] = $rowVisData['vis_email'];
        $data['vis_comment' . $i] = $rowVisData['vis_comment'];
        $i++;
    }
    $response['data'] = $data;
    $response['rowNo'] = $dataNum;
    echo json_encode($response);
    // flush();
    // sleep(1);
}
