<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['remin_dT'])) {
        require '../constant/db_connect.php';
        $userid = $_POST['userid'];
        $userName = $_POST['user_name'];
        $L_userUnqId = $_POST['userUnqId'];
        $remin_dT = $_POST['remin_dT'];
        $priority = $_POST['priority'];
        $remType = $_POST['remType'];
        $rem_details = $_POST['rem_details'];
        $rem_title = $_POST['rem_title'];
        $dateAndTime = explode("T", $remin_dT);
        $date = $dateAndTime[0]; // Date
        $time = substr($dateAndTime[1], 0, 5);

        $reminShare = isset($_POST['sherewith']) ? $_POST['sherewith'] : [];
        $reminShareStr = '';
        $count = count($reminShare);
        for ($i = 0; $i < $count; $i++) {
            $reminShareStr .= $reminShare[$i];
            // Add a comma only if it's not the last element
            if ($i < $count - 1) {
                $reminShareStr .= ',';
            }
        }

        // echo json_encode($userid . " reminShare= " . $reminShareStr . " " . $userName . $remin_dT . $priority . $rem_details . $rem_title);

        $remindSet_sql = "INSERT INTO `reminder_table`(`userOG_name`, `userid`,`remType`, `rem_title`, `rem_details`, `date_time`, `bg_color`, `date`, `time`,`sharewith`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $remindSet_stmt = mysqli_prepare($conn, $remindSet_sql);

        mysqli_stmt_bind_param($remindSet_stmt, "ssssssssss", $userName, $userid,$remType, $rem_title, $rem_details, $remin_dT, $priority, $date, $time, $reminShareStr);
        mysqli_stmt_execute($remindSet_stmt);

        if (mysqli_stmt_affected_rows($remindSet_stmt) > 0) {
            $sql_rem_fetch = "SELECT * FROM `reminder_table` WHERE `userid`='$userid' OR FIND_IN_SET('$L_userUnqId', sharewith) > 0 OR `remType`='Meeting' ORDER BY slNo DESC";
            $result_rem = mysqli_query($conn, $sql_rem_fetch);
            $rem_rowNum = mysqli_num_rows($result_rem);
            $i = 0;
            $response;
            while ($row = mysqli_fetch_assoc($result_rem)) {
                $data['slNo' . $i] = $row['slNo'];
                $data['userid' . $i] = $row['userid'];
                $data['userOG_name' . $i] = $row['userOG_name'];
                $data['rem_title' . $i] = $row['rem_title'];
                $data['rem_details' . $i] = $row['rem_details'];
                $data['date_time' . $i] = date('g:i A d.m.Y', strtotime($row["date_time"]));
                $data['bg_color' . $i] = $row['bg_color'];
                $data['remType' . $i] = $row['remType'];
                $data['date' . $i] = $row['date'];
                $data['time' . $i] = $row['time'];
                $data['status' . $i] = $row['status'];

                $userIDs = $row['sharewith'];
                $userIDsArray = explode(',', $userIDs);
                $userList = '';

                // Check if there are any user IDs
                if (!empty($userIDsArray)) {
                    for ($j = 0; $j < count($userIDsArray); $j++) {
                        $userList_sql = "SELECT * FROM `login_data` WHERE FIND_IN_SET('$userIDsArray[$j]', id) > 0 ";
                        $userList_res = mysqli_query($conn, $userList_sql);
                        $userList_rowNo = mysqli_num_rows($userList_res);
                        // $userList .=$userList_sql. ',';
                        while ($userList_row = mysqli_fetch_assoc($userList_res)) {
                            $userList .= ($userList_row['name']) . ',';
                        }
                    }
                }
                $data['sharewith' . $i] = $userList;
                $reminder_success = "Successfully inserted!";
                $i++;
            }
            $response['data'] = $data;
            $response['rem_rowNum'] = $rem_rowNum;
            echo json_encode($response);
        } else {
            $response = "Data not saved";
            echo json_encode($response);
        }
    } else if (isset($_POST['userid']) && !isset($_POST['remin_dT'])) {
        require '../constant/db_connect.php';
        $L_userid = $_POST['userid'];
        $L_userName = $_POST['user_name'];
        $L_userUnqId = $_POST['userUnqId'];
        $response;

        $sqlLoadrem_fetch = "SELECT * FROM `reminder_table` WHERE `userid`='$L_userid' OR FIND_IN_SET('$L_userUnqId', sharewith) > 0 OR `remType`='Meeting' ORDER BY slNo DESC";
        $L_result_rem = mysqli_query($conn, $sqlLoadrem_fetch);
        $rem_rowNum = mysqli_num_rows($L_result_rem);
        // echo json_encode($rem_rowNum);


        if ($rem_rowNum > 0) {
            // $rem_rowNum = mysqli_num_rows($L_result_rem);
            $i = 0;
            // echo json_encode( $rem_rowNum);
            while ($row = mysqli_fetch_assoc($L_result_rem)) {
                $data['slNo' . $i] = $row['slNo'];
                $data['userid' . $i] = $row['userid'];
                $data['userOG_name' . $i] = $row['userOG_name'];
                $data['rem_title' . $i] = $row['rem_title'];
                $data['rem_details' . $i] = $row['rem_details'];
                $data['date_time' . $i] = date('g:i A d.m.Y', strtotime($row["date_time"]));
                $data['bg_color' . $i] = $row['bg_color'];
                $data['remType' . $i] = $row['remType'];
                $data['date' . $i] = $row['date'];
                $data['time' . $i] = $row['time'];
                $data['status' . $i] = $row['status'];

                $userIDs = $row['sharewith'];
                $userIDsArray = explode(',', $userIDs);
                $userList = '';
                if (!empty($userIDsArray)) {
                    for ($j = 0; $j < count($userIDsArray); $j++) {
                        $userList_sql = "SELECT * FROM `login_data` WHERE FIND_IN_SET('$userIDsArray[$j]', id) > 0 ";
                        $userList_res = mysqli_query($conn, $userList_sql);
                        $userList_rowNo = mysqli_num_rows($userList_res);
                        // $userList .=$userList_sql. ',';
                        while ($userList_row = mysqli_fetch_assoc($userList_res)) {
                            $userList .= ($userList_row['name']) . ',';
                        }
                    }
                }
                $data['sharewith' . $i] = $userList;
                $reminder_success = "Successfully inserted!";
                $i++;
            }
            $response['data'] = $data;
            $response['rem_rowNum'] = $rem_rowNum;
            echo json_encode($response);
        } else {
            echo json_encode(["error" => mysqli_error($conn)]);
        }
    }
}
?>
