
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$login = false;
$error = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../constant/db_connect.php';
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    if ($user == "") {
        $msg_blank_user = "Username can't be blank";
        header("location: ../action/index.php?msg_blank_user=" . $msg_blank_user);
    } elseif ($pass == "") {
        $msg_blank_pass = "Password can't be blank";
        header("location: ../action/index.php?msg_blank_pass=" . $msg_blank_pass);
    } else {
        $sql_authen = "SELECT * FROM `login_data` WHERE BINARY `user`=? AND BINARY `pass`=?";
        $stmt_authen = mysqli_prepare($conn, $sql_authen);
        mysqli_stmt_bind_param($stmt_authen, "ss", $user, $pass);
        mysqli_stmt_execute($stmt_authen);
        $result = mysqli_stmt_get_result($stmt_authen);
        $row_user = mysqli_fetch_assoc($result);
        $num = mysqli_num_rows($result);
        if ($num == 1 && ($row_user['desg_code'] == 'PRO')) {
            require '../action/session_control.php';
            session_start();
            $login = true;
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id_no'] = $row_user['id'];
            $_SESSION['username'] = $user;
            $_SESSION['name'] = $row_user['name'];
            $_SESSION['desg_code'] = $row_user['desg_code'];
            //Date time stamp collected for login-->
            date_default_timezone_set('Asia/Kolkata');
            $_time = date("H:i:s A");
            $_SESSION['login_time'] = $_time;
            $_date_time = date("Y-m-d H:i:s");
            $_SESSION['login_dateTime'] = $_date_time;
            $_SESSION['LAST_ACTIVE_TIME'] = time();
            // $status = "Active now";
            // $sql2 = mysqli_query($conn, "UPDATE login_data SET status = '{$status}' WHERE `user`='$user'");
            header("location: ../action/home.php");
            die();
        } elseif ($num == 1 && ($row_user['desg_code'] == '2NDRESP')) {
            require '../action/session_control.php';
            session_start();
            $login = true;
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id_no'] = $row_user['id'];
            $_SESSION['username'] = $user;
            $_SESSION['name'] = $row_user['name'];
            $_SESSION['desg_code'] = $row_user['desg_code'];
            date_default_timezone_set('Asia/Kolkata');
            $_time = date("H:i:s A");
            $_SESSION['login_time'] = $_time;
            $_date_time = date("Y-m-d H:i:s");
            $_SESSION['login_dateTime'] = $_date_time;
            $_SESSION['LAST_ACTIVE_TIME'] = time();
            // $status = "Active now";
            // $sql2 = mysqli_query($conn, "UPDATE login_data SET status = '{$status}' WHERE `user`='$user'");
            header("location: ../action/home_2nd_resp.php");
            die();
        } elseif ($num == 1 && ($row_user['desg_code'] == 'CEO')) {
            require '../action/session_control.php';
            session_start();
            $login = true;
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id_no'] = $row_user['id'];
            $_SESSION['username'] = $user;
            $_SESSION['name'] = $row_user['name'];
            $_SESSION['desg_code'] = $row_user['desg_code'];
            date_default_timezone_set('Asia/Kolkata');
            $_time = date("H:i:s A");
            $_SESSION['login_time'] = $_time;
            $_date_time = date("Y-m-d H:i:s");
            $_SESSION['login_dateTime'] = $_date_time;
            // $status = "Active now";
            // $sql2 = mysqli_query($conn, "UPDATE login_data SET status = '{$status}' WHERE `user`='$user'");
            $_SESSION['LAST_ACTIVE_TIME'] = time();
            header("location: ../action/master_home.php");
            die();
        } elseif ($num == 1 && ($row_user['desg_code'] == 'CRTR')) {
            require '../action/session_control.php';
            session_start();
            $login = true;
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id_no'] = $row_user['id'];
            $_SESSION['username'] = $user;
            $_SESSION['name'] = $row_user['name'];
            $_SESSION['desg_code'] = $row_user['desg_code'];
            date_default_timezone_set('Asia/Kolkata');
            $_date_time = date("Y-m-d H:i:s");
            $_time = date("H:i:s A");
            $_SESSION['login_time'] = $_time;
            $_SESSION['login_dateTime'] = $_date_time;
            // $status = "Active now";
            // $sql2 = mysqli_query($conn, "UPDATE login_data SET status = '{$status}' WHERE `user`='$user'");
            $_SESSION['LAST_ACTIVE_TIME'] = time();
            header("location: ../action/encrypt_decrypt.php");
            die();
        } else {
            $msg_invalid = "Invalid Credentials";
            header("location: ../action/index.php?msg_invalid=" . $msg_invalid);
        }
        mysqli_stmt_close($stmt);
    }
}
