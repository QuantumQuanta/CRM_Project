<?php

require '../action/session_control.php';

session_start();

// $login_dt;
if (isset($_SESSION['login_dateTime']) && isset($_SESSION['user_id_no'])) {

    date_default_timezone_set('Asia/Kolkata');
    $logout_date = date("d.m.y");
    $logout_time = date("h:i:s A");

    $user_unqId = $_SESSION['user_id_no'];
    $login_dateTime = $_SESSION['login_dateTime'];
    // echo $user_unqId;
    // echo date('d/m/Y', $login_dt);
    // echo date('h:i:s', $login_dt);
    // echo ("loginDate" . $login_date . '||');
    // echo ("loginTime" . $login_time . "||");
    // echo "userID:" . $user_unqId;
    // echo "logout_date" . $logout_date . "|| logout_time" . $logout_time;
    date_default_timezone_set('Asia/Kolkata');
    $_date_time = date("Y-m-d H:i:s");
    $logout_dateTime = $_date_time;
    require '../constant/db_connect.php';
    $UserLOg_sql = "INSERT INTO `user_log`(`user_unq_id`, `login_date_time`, `logout_date_time`) VALUES (?,?,?)";

    // Assuming $conn is your mysqli connection
    $UserLOg_stmt = mysqli_prepare($conn, $UserLOg_sql);

    // Assuming $user_unqId, $login_dateTime, and $logout_dateTime are your variables
    mysqli_stmt_bind_param($UserLOg_stmt, 'iss', $user_unqId, $login_dateTime, $logout_dateTime);

    // Execute the statement
    $logoutRes = mysqli_stmt_execute($UserLOg_stmt);


    // $status = "Offline now";
    // $sql = mysqli_query($conn, "UPDATE login_data SET `status` = '{$status}' WHERE `id`='$user_unqId'");

    try {
        if ($logoutRes) {
            session_unset();
            session_destroy();
            header("location: ../action/index.php");
        } else {
            throw new Exception("Oops!Error 502 occured!"); // exception on _db 
        }
    } catch (Exception $e) {
        echo "Logout failed! Error:" . $e->getMessage(); //exception handled here
    }
    // Close the statement
    mysqli_stmt_close($UserLOg_stmt);
}
