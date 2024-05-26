<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['editClient'] && $_POST['clientid']) {
        require '../constant/db_connect.php';
        $id = $_POST['clientid'];
        $sql = "SELECT * FROM `crm_master_table` WHERE `uniq_id`='$id'";
        $query = mysqli_query($conn, $sql);
        $rowNum = mysqli_num_rows($query);
        $data = [];
        if ($rowNum > 0) {

            while ($row = mysqli_fetch_assoc($query)) {
                $data['name'] = $row['client_name'];
                $data['code'] = $row['code'];
                $data['state'] = $row['client_state'];
            }
            echo json_encode($data);
        } else {
            // No users are available to chat
            $Result = array("No client");
            echo json_encode($Result);
        }


        // Add data to ListResponse array

    }    
}
