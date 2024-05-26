<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'CEO' || $_SESSION['desg_code'] == 'CRTR') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
    //$clientUniqueId = $_SESSION['clientUniqueId'];
} else {
    header("location: ../action/index.php");
}
?>






<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // require '../constant/db_connect.php';
    // $user_name = $_POST['userfirstName'].' '.$_POST['userlastName'];
    // $user_desg = '';
    // if ($_POST['userDesgCode'] != "Choose...") {
    //     $user_desg = $_POST['userDesgCode'];
    // } else {
    //     $user_desg = '';
    // }
    // $user_contact = $_POST['userContactNo'];
    // $user_email = $_POST['userEmailId'];
    // $user_loginId = $_POST['userUniqueId'];
    // $user_pass = $_POST['userPass'];
    // $newUserSql = "INSERT INTO `login_data`(`name`, `user`, `pass`, `desg_code`, `email`, `contact`) VALUES ('$user_name','$user_loginId','$user_pass','$user_desg','$user_email','$user_contact')";
    // $newUserRes = mysqli_query($conn,$newUserSql);
    // $userData;
    // if($newUserRes){
    //     // $userData = "success";
    //     header('location: ../action/new_user.php?success');
    // }
    // else{
    //     // $userData = "unsuccess";
    //     header('location: ../action/new_user.php?unsuccess');
    // }




    require '../constant/db_connect.php';
    $user_name = $_POST['userfirstName'] . " " . $_POST['userlastName'];
    $user_desg = '';
    if ($_POST['userDesgCode'] != "Choose...") {
        $user_desg = $_POST['userDesgCode'];
    } else {
        $user_desg = '';
    }
    $user_contact = $_POST['userContactNo'];
    $user_email = $_POST['userEmailId'];
    $user_loginId = $_POST['userUniqueId'];
    $user_pass = $_POST['userPass'];
    // $user_file = '';
    // if (isset($_FILES['userPic'])) {
    //     $user_file = $_FILES['userPic']['name'];
    // }
    $user_picname = $_FILES['userPic']['name']; 
    $user_pictname = $_FILES['userPic']['tmp_name'];

    $parentFolderPath = "../upload/user_profilepics/";
    $newFolderName = $user_name . "/";
    $newFolderPath = $parentFolderPath . $newFolderName;


    if (!file_exists($newFolderPath)) {
        mkdir($newFolderPath, 0777, true);
    }

    $user_finalDestination = $newFolderPath . $user_picname;
    $uploaded = move_uploaded_file($user_pictname, $user_finalDestination);

    // echo json_encode($user_name . ' ' . $user_desg . ' ' . $user_contact . ' ' . $user_email . ' ' . $user_loginId . ' ' . $user_pass . ' ' . $imageData);
    $newUserSql = "INSERT INTO `login_data`(`name`, `user`, `pass`, `desg_code`, `email`, `contact`, `user_pic`) VALUES ('$user_name','$user_loginId','$user_pass','$user_desg','$user_email','$user_contact','$user_finalDestination')";
    $newUserRes = mysqli_query($conn, $newUserSql);
    // echo $newUserRes;
    if($uploaded & $newUserRes){
        header("location:../action/new_user.php?success");
    }
    else{
        header("location:../action/new_user.php?unsuccess");
    }
}
