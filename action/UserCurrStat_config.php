<?php
// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//   require '../constant/db_connect.php';
//   $dataElem = $_POST['dataElem'];
//   $empId = $_POST['empId'];
//   $empName = $_POST['empName'];
//   $date_time = $_POST['date_time'];
//   $log_time=$_POST['loginTime'];


//   $sql_activity_stat ="INSERT INTO `headerActiveStatus`(`stat_start_time`, `emp_status`, `emp_id`,`emp_name`,`login_time`) 
//     VALUES ('$date_time','$dataElem','$empId','$empNames','$log_time')";

//   $result_activity_stat = mysqli_query($conn,$sql_activity_stat);

//   if($result_activity_stat){
//     echo json_encode('Successfully inserted');
//   }
//   else{
//     echo json_encode('Unsuccessful!');
//   }

// }
