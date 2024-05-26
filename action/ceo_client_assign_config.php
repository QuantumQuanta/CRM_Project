<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../constant/db_connect.php';
    global $responseStr;
    $data = $_POST["CLDT"];
    foreach ($data as $strval) {
        $explodedValues = explode('|', $strval);
        array_pop($explodedValues);
        array_pop($explodedValues);

        $explodedValues[0];
        $explodedValues[1];
        $explodedValues[2];
        $explodedValues[3];
        $explodedValues[4];
        $explodedValues[5];
        $explodedValues[6];
        $explodedValues[7];
        $explodedValues[8];
        $explodedValues[9];
        $explodedValues[10];
        $explodedValues[11];
        $explodedValues[12];
        $explodedValues[13];
        $explodedValues[14];
        $explodedValues[15];
        $explodedValues[16];
        $explodedValues[17];
        $explodedValues[18];
        $explodedValues[19];
        $explodedValues[20];
        $explodedValues[21];

        $clInSQL = "INSERT INTO `crm_master_table`(`sl_no`, `doc`, `client_name`, `client_contact`, `client_email`, `client_state`, `client_city`, `code`, `period`, `category`, `reference`, `doa_1`, `1st_resp`, `doa_2`, `2nd_resp`, `doa_3`, `3rd_resp`, `comment_3resp`, `bcr`, `verified`, `pcr`, `remarks`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $clInSTMT = mysqli_prepare($conn,$clInSQL);
        mysqli_stmt_bind_param($clInSTMT,"isssssssssssssssssssss",$explodedValues[0],$explodedValues[1],$explodedValues[2],$explodedValues[3],$explodedValues[4],$explodedValues[5],$explodedValues[6],$explodedValues[7],$explodedValues[8],$explodedValues[9],$explodedValues[10],$explodedValues[11],$explodedValues[12],$explodedValues[13],$explodedValues[14],$explodedValues[15],$explodedValues[16],$explodedValues[17],$explodedValues[18],$explodedValues[19],$explodedValues[20],$explodedValues[21]);
        if(mysqli_stmt_execute($clInSTMT)){
            $responseStr.="success";
        }
        else{
            $responseStr.="unsuccess";
        }
    }
    echo json_encode($responseStr);
}
