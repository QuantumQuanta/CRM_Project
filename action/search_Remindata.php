<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'PRO' || $_SESSION['desg_code'] == '2NDRESP' || $_SESSION['desg_code'] == 'CEO' || $_SESSION['desg_code'] == 'CRTR') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
} else {
    header("location: ../action/index.php");
}


// Database connection
require '../constant/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['selectedDate'])) {
        $selectedDate = $_POST['selectedDate'];
        // Modify your SQL query to fetch data for the selected date
        $sql_fetch_data = "SELECT * FROM `reminder_table` WHERE `date`='$selectedDate' and `userName`='$user_id'";
        $result = mysqli_query($conn, $sql_fetch_data);

        $data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        echo json_encode($data);
    }
    // if (isset($_GET['action_shareWith'])) {
    //     $shareWith_list=$_GET['shareList'];
    //     $userList_sql = "SELECT * FROM `login_data`";
    //     $userList_stmt = mysqli_prepare($conn, $userList_sql);
    //     mysqli_stmt_execute($userList_stmt);
    //     $userList_res = mysqli_stmt_get_result($userList_stmt);
    //     $shareWith_list = array();
    //     while ($userList_row = mysqli_fetch_assoc($userList_res)) {
    //         $userListId = $userList_row["id"];
    //         $searchValue = "(" . $userListId . ")";

    //         if (strpos($row["sharewith"], $searchValue) !== false) {
    //             // echo  $userList_row['name'] . ' , ';
    //             $shareWith_list[] =   $userList_row['name'];
    //         } else {
    //             // echo "Value is not present in the string";
    //         }
    //     }
    //     echo json_encode($shareWith_list);
    // }
}
