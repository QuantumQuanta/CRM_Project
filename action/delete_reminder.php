<?php 
require '../action/session_control.php';
	session_start();
	require '../constant/db_connect.php';
	
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header("location: ../action/index.php");
    } 
	$sql="delete from reminder_table where slNo='{$_GET["id"]}'";
	if($conn->query($sql)){
		header("location:../action/reminders.php");
	}
?>