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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../constant/db_connect.php';
    $uniq_id = $_POST['uniqId'];
    $doc = date("d-m-Y", strtotime($_POST['doc']));
    $doa_1 = date("d-m-Y", strtotime($_POST['doa1']));
    $strPeriod = date("d-m-Y", strtotime($_POST['strPeriod']));
    $endPeriod = date("d-m-Y", strtotime($_POST['endPeriod']));
    $period = $strPeriod.' - '.$endPeriod;
    $code = $_POST['code'];
    $client_name = $_POST['clientName'];
    $client_state = $_POST['clientState'];
    $client_contact = $_POST['clientContact'];
    $bcr = $_POST['bcr'];
    $verified = $_POST['verified'];
    $pcr = $_POST['pcr'];
    $pro_name = $_POST['proName'];
    $doa_2 = date("d-m-Y", strtotime($_POST['doa2']));
    $secresp_name = $_POST['secName'];
    $doa_3 = date("d-m-Y", strtotime($_POST['doa3']));
    $thrdresp_name = $_POST['thrName'];
    $remarks = $_POST['remarks'];
    //echo json_encode($uniq_id);
    $resArr=[];
    for ($i = 0; $i <= sizeof($uniq_id)-1; $i++) {
        $id_val = $uniq_id[$i];

        if ($uniq_id != null && $doc != null) {
            // $valArr[$i] = $id_val.'doc Updated';
            $sql_up_doc = "UPDATE `crm_master_table` SET `doc` ='$doc' WHERE uniq_id=$id_val";
            $result_up_doc = mysqli_query($conn, $sql_up_doc);
            if($result_up_doc){
                $resArr['up_doc='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $doa_1 != null) {
            // $valArr[$i+1] = $id_val.'doa1 Updated';
            $sql_up_doa_1 = "UPDATE `crm_master_table` SET `doa_1` ='$doa_1' WHERE uniq_id=$id_val";
            $result_up_doa_1 = mysqli_query($conn, $sql_up_doa_1);
            if($result_up_doa_1){
                $resArr['up_doa_1='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $period != ' - ') {
            // $valArr[$i+2] = $id_val.'period Updated';
            $sql_up_period = "UPDATE `crm_master_table` SET `period` ='$period' WHERE uniq_id=$id_val";
            $result_up_period = mysqli_query($conn, $sql_up_period);
            if($result_period){
                $resArr['up_period='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $code != null) {
            // $valArr[$i+3] = $id_val.'code Updated';
            $sql_up_code = "UPDATE `crm_master_table` SET `code`='$code' WHERE uniq_id=$id_val";
            $result_up_code = mysqli_query($conn, $sql_up_code);
            if($result_up_code){
                $resArr['up_code='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $client_name != null) {
            // $valArr[$i+4] = $id_val.'clientname Updated';
            $sql_up_client_name = "UPDATE `crm_master_table` SET `client_name`='$client_name' WHERE uniq_id=$id_val";
            $result_up_client_name = mysqli_query($conn, $sql_up_client_name);
            if($result_up_client_name){
                $resArr['up_client_name='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $client_state != null) {
            // $valArr[$i+5] = $id_val.'clientstate Updated';
            $sql_up_client_state = "UPDATE `crm_master_table` SET `client_state`='$client_state' WHERE uniq_id=$id_val";
            $result_up_client_state = mysqli_query($conn, $sql_up_client_state);
            if($result_up_client_state){
                $resArr['up_client_state='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $client_contact != null) {
            // $valArr[$i+6] = $id_val.'clientcontact Updated';
            $sql_up_client_contact = "UPDATE `crm_master_table` SET `client_contact`='$client_contact' WHERE uniq_id=$id_val";
            $result_up_client_contact = mysqli_query($conn, $sql_up_client_contact);
            if($result_up_client_contact){
                $resArr['up_client_contact='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $bcr != null) {
            // $valArr[$i+7] = $id_val.'bcr Updated';
            $sql_up_bcr = "UPDATE `crm_master_table` SET `bcr`='$bcr' WHERE uniq_id=$id_val";
            $result_up_bcr = mysqli_query($conn, $sql_up_bcr);
            if($result_up_bcr){
                $resArr['up_bcr='.$id_val] = 'Success!';
            }
            
        }
        if ($uniq_id != null && $verified != null) {
            // $valArr[$i+8] = $id_val.'verified Updated';
            $sql_up_verified = "UPDATE `crm_master_table` SET `verified`='$verified' WHERE uniq_id=$id_val";
            $result_up_verified = mysqli_query($conn, $sql_up_verified);
            if($result_up_verified){
                $resArr['up_verified='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $pcr != null) {
            // $valArr[$i+9] = $id_val.'pcr Updated';
            $sql_up_pcr = "UPDATE `crm_master_table` SET `pcr`='$pcr' WHERE uniq_id=$id_val";
            $result_up_pcr = mysqli_query($conn, $sql_up_pcr);
            if($result_up_pcr){
                $resArr['up_pcr='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $pro_name != null) {
            // $valArr[$i+10] = $id_val.'proname Updated';
            $sql_up_pro_name = "UPDATE `crm_master_table` SET `1st_resp`='$pro_name' WHERE uniq_id=$id_val";
            $result_up_pro_name = mysqli_query($conn, $sql_up_pro_name);
            if($result_up_pro_name){
                $resArr['up_pro_name='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $doa_2 != null) {
            // $valArr[$i+11] = $id_val.'doa2 Updated';
            $sql_up_doa_2 = "UPDATE `crm_master_table` SET `doa_2`='$doa_2' WHERE uniq_id=$id_val";
            $result_up_doa_2 = mysqli_query($conn, $sql_up_doa_2);
            if($result_up_doa_2){
                $resArr['up_doa_2='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $secresp_name != null) {
            // $valArr[$i+12] = $id_val.'scerespname Updated';
            $sql_up_secresp_name = "UPDATE `crm_master_table` SET `2nd_resp`='$secresp_name' WHERE uniq_id=$id_val";
            $result_up_secresp_name = mysqli_query($conn, $sql_up_secresp_name);
            if($result_up_secresp_name){
                $resArr['up_secresp_name='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $doa_3 != null) {
            // $valArr[$i+13] = $id_val.'doa3 Updated';
            $sql_up_doa_3 = "UPDATE `crm_master_table` SET `doa_3`='$doa_3' WHERE uniq_id=$id_val";
            $result_up_doa_3 = mysqli_query($conn, $sql_up_doa_3);
            if($result_up_doa_3){
                $resArr['up_doa_3='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $thrdresp_name != null) {
            // $valArr[$i+14] = $id_val.'thrdrespname Updated';
            $sql_up_thrdresp_name = "UPDATE `crm_master_table` SET `3rd_resp`='$thrdresp_name' WHERE uniq_id=$id_val";
            $result_up_thrdresp_name = mysqli_query($conn, $sql_up_thrdresp_name);
            if($result_up_thrdresp_name){
                $resArr['up_thrdresp_name='.$id_val] = 'Success!';
            }
        }
        if ($uniq_id != null && $remarks != null) {
            // $valArr[$i+15] = $id_val.'remarks Updated';
            $sql_up_remarks = "UPDATE `crm_master_table` SET `remarks`='$remarks' WHERE uniq_id=$id_val";
            $result_up_remarks = mysqli_query($conn, $sql_up_remarks);
            if($result_up_remarks){
                $resArr['up_remarks='.$id_val] = 'Success!';
            }
        }
    }
    echo json_encode($resArr);

}

?>