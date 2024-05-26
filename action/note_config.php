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
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['addNoteBtn'])) {
        note_input();
    }
}

function note_input()
{
    require '../constant/db_connect.php';
    $note = $_POST['addTxt'];
    $note_title = $_POST['addTitle'];
    $pro_name = $_POST['pro_name'];
    date_default_timezone_set('Asia/Kolkata');
    $currentDate = date("Y-m-d");
    $currentTime = date('h:i');

    // print_r('note  '.$note." "."pro_name  ".$pro_name."  currentDate  ".$currentDate);


    if ($pro_name != "" && $note != "" && $currentDate != "") {
        $sql_note_input = "INSERT INTO `notes_data`(`userId`, `submitdate`, `note`,`note_title`,`time`)VALUES ('$pro_name','$currentDate','$note','$note_title','$currentTime')";
        $result_note_input = mysqli_query($conn, $sql_note_input);
        if ($result_note_input) {
            $note_success = "Successfully inserted!";
            header('location:../action/note.php?notes_success' . $note_success);
        }
    } else {
        header('location:../action/note2.php?notes_unsuccess: data not saved ');
    }
}
?>