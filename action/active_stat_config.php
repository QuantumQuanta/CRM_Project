<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  require '../constant/db_connect.php';
  $last_active = $_POST['lastActive'];
  $curr_active = $_POST['currActTime'];
  $inact_reason = $_POST['inactivityReason'];
  $inact_comment = $_POST['inactivityComment'];
  $user_idno = $_POST['userIdno'];
  $curr_date = $_POST['currDay'];

  $inactSql = "INSERT INTO `emp_activity_stat`(`uniq_useridno`, `curr_day`, `last_active`, `curr_active`, `inact_reason`, `inact_cmnt`) VALUES ('$user_idno','$curr_date','$last_active','$curr_active','$inact_reason','$inact_comment')";
  $inactRes = mysqli_query($conn,$inactSql);
  if($inactRes){
    echo json_encode("success");
  }
  else{
    echo json_encode("unsuccess");
  }

}
