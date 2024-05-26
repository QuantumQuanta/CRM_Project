<?php
// foreach ($_COOKIE as $cookieName => $cookieValue) {
//     setcookie($cookieName, '', time() - 3600, '/');
// }
require '../action/session_control.php';
session_start();
session_unset();
session_destroy();
?>
<!doctype html>
<html lang="en">

<head>
    <script src="../script/backPre.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../stylesheet/indexV2.0.css">
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <title>index</title>
    <style>
        #myVideo {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="wrapper-container">
    <!-- <video autoplay muted loop id="myVideo">
            <source src="../image/ram vector.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video> -->
        <?php
        require '../layout/header.php';
        ?>
        <?php
        ?>
        <div class="bg-slider">
            <ul class="slideshow">
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
            </ul>
        </div>

        <div class="container text-center" id="login_container">

            <div class="card" id="login_card">
                <div class="card-body">
                    <img src="../image/logo.png" alt="" height="25%" width="25%">
                    <h4 class="card-title">Sign In</h4>
                    <label class="para" id="authen_msg_area">Sign in with the valid credentials</label>
                    <?php

                    if (isset($_GET['msg_blank_user'])) {
                        echo '
                        <script src="../script/authen_output_text.js" type="text/javascript"></script>
                        <script>blankUserMsg();</script>
                                ';
                    } else if (isset($_GET['msg_blank_pass'])) {
                        echo '
                        <script src="../script/authen_output_text.js" type="text/javascript"></script>
                        <script>blankPassMsg();</script>
                                ';
                    } else if (isset($_GET['msg_invalid'])) {
                        echo '
                        <script src="../script/authen_output_text.js" type="text/javascript"></script>
                        <script>invalidCredMsg();</script>
                                ';
                    }
                    ?>
                    <div class="container-fluid">
                        <form class="form-group col-md-12 mx-auto" id="login_form" name="login_form" action="../action/login.php" method="post">
                            <div class="input-group input-group-sm mb-2">
                                <div class="text-container">
                                    <img src="../image/indexImg/maleUserIcon.png" class="material-icons" id="username_icon" alt="">
                                    <!-- <span class="material-icons" id="username_icon">account_circle</span> -->
                                    <input type="text" class="form-control" id="user" name="user" placeholder="Username" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" onkeyup="checkInput(this.value)">
                                </div>

                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <div class="text-container">
                                    <img src="../image/indexImg/iconsLock.png" class="material-icons" id="password_icon" alt="">
                                    <!-- <span class="material-icons" id="password_icon">lock</span> -->
                                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" onkeyup="checkInput(this.value)">
                                </div>

                            </div>
                            <br>

                            <button type="submit" id="submit_login_form" name="submit_login_form" class="btn btn-primary btn-sm btn-login">LOGIN</button>
                        </form>
                    </div>
                    <br>

                    <div class="f-card">
                        <p>Facing any issue?</p> <a class="btn btn-sm" href="../action/contact_admin.php" role="button">Contact with Admin</a>
                    </div>

                </div>
            </div>
        </div>

        <?php
        require '../layout/footer.php';
        ?>
    </div>
    <script src="../script/login_input.js" type="javascript/text"></script>
</body>
</html>