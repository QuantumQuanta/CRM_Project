<?php
function authenticate_n_update($currentPassword, $newPassword, $userId)
{
    require '../constant/db_connect.php';
    // Input validation (you might need more validation depending on your requirements)
    if (empty($currentPassword) || empty($newPassword) || empty($userId)) {
        return ("Invalid input! Please try again or contact with the admin");
    }

    // Password hashing should be used for security

    // Authentication
    $checkSql = "SELECT * FROM `login_data` WHERE BINARY `pass`=?";
    $checkStmt = mysqli_prepare($conn, $checkSql);

    if (!$checkStmt) {
        return ("Database error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($checkStmt, "s", $currentPassword);
    mysqli_stmt_execute($checkStmt);

    $checkResult = mysqli_stmt_get_result($checkStmt);
    $checkRow = mysqli_fetch_assoc($checkResult);
    $checkNum = mysqli_num_rows($checkResult);

    if ($checkNum == 1 && $checkRow['user'] === $userId) {
        // Password update
        $passUpSql = "UPDATE `login_data` SET `pass` =? WHERE `login_data`.`id` =?";
        $passUpStmt = mysqli_prepare($conn, $passUpSql);

        if (!$passUpStmt) {
            return ("Database error: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($passUpStmt, "si", $newPassword, $checkRow['id']);
        mysqli_stmt_execute($passUpStmt);

        $affectedRows = mysqli_stmt_affected_rows($passUpStmt);

        if ($affectedRows==1) {
            return ("Password has been changed successfully");
        } else {
            return ("Failed to update password: " . mysqli_error($conn));
        }
    } else {
        return ("Authentication failed. Password doesn't match our records for the provided user.");
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../constant/db_connect.php';
    $prePass = $_POST['prePass'];
    $newPass = $_POST['newPass'];
    $cnewPass = $_POST['cnewPass'];
    $userid = $_POST['userid'];
    if (empty($prePass) && empty($userid)) {
        echo json_encode("Unexpected error occured!");
    } else {
        $response = authenticate_n_update($prePass, $newPass, $userid);
        echo json_encode($response);
    }
}


?>