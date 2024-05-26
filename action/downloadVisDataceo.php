<?php
if (isset($_GET['value'])) {
    require '../constant/encrypt_decrypt.php';
    require '../constant/db_connect.php';

    $ceovisitorId = decryptData($_GET['value']);
    // echo $visitorId;
    $sql_visdata = "SELECT * FROM `visitor_log` WHERE `vis_unqidno`= '$ceovisitorId'";
    $sql_visname = "SELECT * FROM `visitor_log_main` WHERE `vis_unq_id`='$ceovisitorId'";
    $res_visname = mysqli_query($conn, $sql_visname);
    $res_visdata = mysqli_query($conn, $sql_visdata);
    $html = "
        <table>
        <tr>
        <td>ETA</td>
        <td>ATA</td>
        <td>Associates' Name</td>
        <td>To Meet</td>
        <td>Meet Room</td>
        <td>Visitor Id</td>
        <td>Associates' Id</td>
        <td>KYC Status</td>
        <td>Visitor Address</td>
        <td>Email</td>
        <td>Comments</td>
        </tr>
        ";
    $row_visname;    
    if($res_visname){
        $row_visname = mysqli_fetch_assoc($res_visname);
    }    
    if ($res_visdata) {
        while ($row_visdata = mysqli_fetch_assoc($res_visdata)) {
            $html .= "<tr>
            <td>" . $row_visdata['vis_eta'] . "</td>
            <td>" . $row_visdata['vis_ata'] . "</td>
            <td>" . $row_visdata['vis_assname'] . "</td>
            <td>" . $row_visdata['vis_tomeet'] . "</td>
            <td>" . $row_visdata['vis_meetroom'] . "</td>
            <td>" . $row_visdata['vis_idno'] . "</td>
            <td>" . $row_visdata['vis_assidno'] . "</td>
            <td>" . $row_visdata['vis_kycstat'] . "</td>
            <td>" . $row_visdata['vis_address'] . "</td>
            <td>" . $row_visdata['vis_email'] . "</td>
            <td>" . $row_visdata['vis_comment'] . "</td>
            </tr>";
        }
        $html .= "</table>";
    }
    header('Content-Type:application/xls');
    header('Content-Disposition:attachment;filename='.$row_visname['vis_name'].'.xls');
    echo $html;
}
?>