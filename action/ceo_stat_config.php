<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../constant/db_connect.php';
    if ($_POST['val'] === 'go') {
        $sql_loginData = "SELECT `id`, `name`, `desg_code` FROM `login_data` WHERE `desg_code` IN ('PRO','2NDRESP')";
        $sql_clData = "SELECT `uniq_id`,`client_name`,`client_contact`,`client_state`,`code` FROM `crm_master_table`";
        $res_loginData = mysqli_query($conn, $sql_loginData);
        $res_clData = mysqli_query($conn, $sql_clData);
        // $data = $_POST['val'];
        // echo json_encode($data);
        global $arr_loginData, $arr_clData, $mainArr;
        $i = 0;
        while ($row_loginData = mysqli_fetch_assoc($res_loginData)) {
            $arr_loginData[$i] = $row_loginData['id'] . "|" . $row_loginData['name'] . "|" . $row_loginData['desg_code'];
            $i++;
        }
        $j = 0;
        while ($row_clData = mysqli_fetch_assoc($res_clData)) {
            $arr_clData[$j] = $row_clData['uniq_id'] . "|" . $row_clData['code'] . " " . $row_clData['client_name'] . " " . $row_clData['client_state'] . "|" . $row_clData['client_contact'];
            $j++;
        }
        $mainArr['respwise'] = $arr_loginData;
        $mainArr['clientwise'] = $arr_clData;

        echo json_encode($mainArr);
    }
}
