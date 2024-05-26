<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
    $login_time = $_SESSION['login_time'];
} else {
    $loggedin = false;
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="icon" href="data:;base64,iVBORw0KGgo="> -->
    <link rel="stylesheet" href="../stylesheet/header_login.css">
    <style>
        .anim_container {
            padding-left: 20px;
        }

        .head_gif_div {
            width: 100%;
            right: 0;
            float: right;
            transform: translateX(100%);
            animation: santaWalk 20s linear infinite;
            animation-delay: 0s;

        }

        .santa-clausIMG {
            height: 45px;
        }

        .head_gif_div2 {
            color: #c1121f;
            /* background: url("https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1173&q=80"); */
            position: absolute;
            width: 0%;
            animation-name: EventAnim2;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
            animation-fill-mode: forwards;
            animation-duration: 10s;
            animation-delay: 10s;
            letter-spacing: 20px;
            font-size: 14px;
            font-weight: 900;
            white-space: nowrap;
            overflow: hidden;
            display: flex;
            padding: 0px !important;
            font-family: 'Kaushan Script', cursive !important;
        }

        #christ_tree {
            transform: rotate(21deg);
            animation: EventAnim3 5s infinite linear alternate;
        }

        @keyframes santaWalk {
            to {
                transform: translateX(-100%);
            }
        }

        @keyframes EventAnim3 {
            form {
                transform: rotate(21deg);
            }

            to {
                transform: rotate(-21deg);
            }
        }

        @keyframes EventAnim {
            form {
                right: 0;
            }

            to {
                right: 190vh;
            }
        }

        @keyframes EventAnim2 {
            form {
                width: 0%;
                letter-spacing: 20px;
            }

            to {
                width: 70%;
                /* right: 170vh; */
                letter-spacing: 10px;
                animation-delay: 10s;
                /* scale: 1.5; */
            }
        }

        .snow-ball-container .snow-ball {
            position: absolute;
            height: 10px;
            width: 10px;
            background: transparent;
            object-fit: cover;


        }

        .snow-ball-container .snow-ball:nth-child(even) {
            position: absolute;
            width: 15px;
            height: 15px;
            animation: flake-motion 15s linear;
            animation-iteration-count: 2;
        }

        .snow-ball-container .snow-ball:nth-child(1) {
            top: -40%;
            left: 3%;
            width: 20px;
            height: 20px;
            animation: snowball-animation 12s linear 2s;
            animation-iteration-count: 2;
        }


        .snow-ball-container .snow-ball:nth-child(2) {
            top: -10%;
            left: 6%;
        }

        .snow-ball-container .snow-ball:nth-child(3) {
            top: -40%;
            left: 9%;
            animation: snowball-animation 12s linear;
            animation-iteration-count: 2;
        }

        .snow-ball-container .snow-ball:nth-child(4) {
            top: -10%;
            left: 12%;
        }

        .snow-ball-container .snow-ball:nth-child(5) {
            top: -10%;
            left: 15%;
            width: 20px;
            height: 20px;
            animation: snowball-animation 12s linear 2s;
            animation-iteration-count: 2;
        }

        .snow-ball-container .snow-ball:nth-child(6) {
            top: -30%;
            left: 18%;
        }

        .snow-ball-container .snow-ball:nth-child(7) {
            top: -40%;
            left: 21%;
            width: 5px;
            height: 5px;
            animation: snowball-animation 12s linear;
            animation-iteration-count: 2;
        }

        .snow-ball-container .snow-ball:nth-child(8) {
            top: -10%;
            left: 24%;
        }

        .snow-ball-container .snow-ball:nth-child(9) {
            top: -20%;
            left: 27%;
            width: 5px;
            height: 5px;
            animation: snowball-animation 12s linear 2s;
            animation-iteration-count: 2;
        }

        .snow-ball-container .snow-ball:nth-child(10) {
            top: -40%;
            left: 30%;
        }

        .snow-ball-container .snow-ball:nth-child(11) {
            top: -10%;
            left: 33%;
            animation: snowball-animation 12s linear;
            animation-iteration-count: 2;
        }

        .snow-ball-container .snow-ball:nth-child(12) {
            top: -17%;
            left: 36%;
        }

        .snow-ball-container .snow-ball:nth-child(13) {
            top: -20%;
            left: 39%;
            width: 5px;
            height: 5px;
            animation: snowball-animation 12s linear 2s;
            animation-iteration-count: 2;
        }

        .snow-ball-container .snow-ball:nth-child(14) {
            top: -10%;
            left: 42%;
        }

        .snow-ball-container .snow-ball:nth-child(15) {
            top: -25%;
            left: 45%;
            width: 30px;
            height: 30px;
            animation: snowball-animation 12s linear;
            animation-iteration-count: 2;
        }

        /* next 15 */
        .snow-ball-container .snow-ball:nth-child(16) {
            top: -40%;
            left: 48%;
        }

        .snow-ball-container .snow-ball:nth-child(17) {
            top: -10%;
            left: 54%;
            width: 5px;
            height: 5px;
            animation: snowball-animation 12s linear 2s;
            animation-iteration-count: 2;
        }

        .snow-ball-container .snow-ball:nth-child(18) {

            top: -15%;
            left: 51%;
        }

        .snow-ball-container .snow-ball:nth-child(19) {
            top: -30%;
            left: 60%;
            width: 20px;
            height: 20px;
            animation: snowball-animation 12s linear;
            animation-iteration-count: 2;
        }

        .snow-ball-container .snow-ball:nth-child(20) {
            top: -10%;
            left: 57%;
        }

        .snow-ball-container .snow-ball:nth-child(21) {
            top: -7%;
            left: 66%;
            width: 5px;
            height: 5px;
            animation: snowball-animation 12s linear 2s;
            animation-iteration-count: 2;
        }

        .snow-ball-container .snow-ball:nth-child(22) {

            top: -30%;
            left: 63%;
        }

        .snow-ball-container .snow-ball:nth-child(23) {
            top: -15%;
            left: 72%;
            width: 25px;
            height: 25px;
            animation: snowball-animation 12s linear;
            animation-iteration-count: 2;

        }

        .snow-ball-container .snow-ball:nth-child(24) {
            top: -20%;
            left: 69%;
        }

        .snow-ball-container .snow-ball:nth-child(25) {
            width: 20px;
            height: 20px;
            top: -40%;
            left: 78%;
            animation: snowball-animation 12s linear 2s;
            animation-iteration-count: 2;

        }

        .snow-ball-container .snow-ball:nth-child(26) {
            top: -25%;
            left: 75%;

        }

        .snow-ball-container .snow-ball:nth-child(27) {
            top: -30%;
            left: 84%;
            width: 5px;
            height: 5px;
            animation: snowball-animation 12s linear;
            animation-iteration-count: 2;

        }

        .snow-ball-container .snow-ball:nth-child(28) {
            top: -7%;
            left: 81%;
        }

        .snow-ball-container .snow-ball:nth-child(29) {
            top: -20%;
            left: 90%;
            width: 25px;
            height: 25px;
            animation: snowball-animation 12s linear 2s;
            animation-iteration-count: 2;
        }

        .snow-ball-container .snow-ball:nth-child(30) {
            top: -10%;
            left: 87%;

        }

        .snow-ball-container .snow-ball:nth-child(31) {
            top: -40%;
            left: 93%;
        }

        .snow-ball-container .snow-ball:nth-child(32) {
            top: -5%;
            left: 96%;
            width: 20px;
            height: 20px;
            animation: snowball-animation 12s linear;
            animation-iteration-count: 2;
        }


        /* Define animations of Snowball and Snowflakes */

        @keyframes snowball-animation {
            0% {
                transform: translate(0);
                opacity: 1;
            }

            20% {
                transform: translate(4px, 100px);
                opacity: 0.8;
            }

            40% {
                transform: translate(-7px, 200px);
                opacity: 0.7;
            }

            60% {
                transform: translate(10px, 400px);
                opacity: 0.5;
            }

            80% {
                transform: translate(-14px, 700px);
                opacity: 0.2;
            }

            100% {
                transform: translate(16px, 900px);
                opacity: 0;
            }
        }

        @keyframes flake-motion {
            0% {
                transform: translate(-2px, 0);
                opacity: 1;
            }

            20% {
                transform: translate(-9px, 200px);
                opacity: 0.9;
            }

            40% {
                transform: translate(14px, 300px);
                opacity: 0.7;
            }

            60% {
                transform: translate(-22px, 400px);
                opacity: 0.6;
            }

            80% {
                transform: translate(30px, 600px);
                opacity: 0.5;
            }

            90% {
                transform: translate(-40px 800px);
                opacity: 0.3;
            }

            100% {
                transform: translate(52px, 1000px);
                opacity: 0;
            }
        }
    </style>
    <title>header</title>
</head>

<body>
    <?php
    if ($loggedin == true) {
        date_default_timezone_set('Asia/Kolkata');
        $date_time = date("d.m.y g:i A");
        // $userArr['user_id']=$user_id;
        // $userArr['user_name']=$user_name;
        // $userArr['date_time']=$date_time;
        // $userArr['login_time']=$login_time;
        // // print_r($userArr);
        // print_r($login_time);
        require '../constant/db_connect.php';
        $userDataSql = "SELECT * FROM `login_data` WHERE `user`='$user_id'";
        $userDataRes = mysqli_query($conn, $userDataSql);
        $user_data = mysqli_fetch_assoc($userDataRes);

        echo '
        <!--heder top body-->
            <div class="header_top" id="header_top">                           
            <div class="anim_container" style="width:100%; display:flex">
                <div class="head_gif_div santa-claus-animation">
                </div>  
                <p class="head_gif_div2">Wish You Happy New Year 2024</p>
                <div class="snow-ball-container"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball">
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball"> 
                    <img src="../image/homePageImg/snowflake.png" class="snow-ball">
                </div>  
            </div>          
                <div id="header_top_dropdown" >
                    <div id="header_imgright" ><img src="../image/header_top_icon/profile1.jpg" alt="profile" id="profileImage"  class="dropbtn">';
        // if($user_data['user_pic']){
        //     echo '<img src="../'.$user_data['user_pic'].'" alt="profile" id="profileImage"  class="dropbtn">';
        // }else{
        //     echo '<img src="../image/header_top_icon/profile1.jpg" alt="profile" id="profileImage"  class="dropbtn">';
        // };
        // <img src="../'.$user_data['user_pic'].'" alt="profile" id="profileImage"  class="dropbtn">
        echo '</div>
                    <div id="header_top_dropdown-content"  style="display:none;">
                    <div id="dropdown-content1">
                        <div id="dropdown-content1_header1">
                        <div class="drop_contImgDiv" ><img src="../image/header_top_icon/profile1.jpg" alt="profile" id="drop_content_Image">';
        // if($user_data['user_pic']){
        //     echo '<img src="../'.$user_data['user_pic'].'" alt="profile" id="drop_content_Image">';
        // }else{
        //     echo '<img src="../image/header_top_icon/profile1.jpg" alt="profile" id="drop_content_Image">';
        // };
        echo '</div>
                <div id="dropdown-header_card">
                            <h4>' . $user_name . '</h4>
                            <p>' . $user_data['email'] . '</p>  
                            <p>' . $user_data['contact'] . '</p> 
                            <div class="container1 mt-box ">
                                <form action="#" method="post">
                                    <div class="row1"> 
                                        <div class="col-md-5" id="stat_div">
                                            <button class="emp_stat-select-box" type="button" id="stat_btn" onclick="toggleDiv()" disabled>
                                                <li id="btnData"><img src=" ../image/header_selectImg/active.png" alt="icon" > 
                                                    <span> Active </span>
                                                </li>
                                            </button>
                                            <div class="emp_stat-b" style="display: none; " id="emp_stat-b">
                                                <ul class="emp_stat-a"> 
                                                    <li  onclick="activity_status(this,`' . $login_time . '`,`' . $user_id . '`,`' . $user_name . '`,`' . $date_time . '`)">
                                                    <img src="../image/header_selectImg/active.png" alt="icon"> 
                                                        <span>
                                                        Active
                                                        </span>
                                                    </li>                                                  
                                                    <li  onclick="activity_status(this,`' . $login_time . '`,`' . $user_id . '`,`' . $user_name . '`,`' . $date_time . '`)">
                                                    <img src="../image/header_selectImg/call.png" alt="icon" > 
                                                        <span>
                                                            On A Call
                                                        </span>
                                                    </li>
                                                    <li  onclick="activity_status(this,`' . $login_time . '`,`' . $user_id . '`,`' . $user_name . '`,`' . $date_time . '`)" >
                                                    <img src="../image/header_selectImg/updating.png" alt="icon" >
                                                        <span>
                                                            Updating Status
                                                        </span>
                                                    </li> 
                                                    <li  onclick="activity_status(this,`' . $login_time . '`,`' . $user_id . '`,`' . $user_name . '`,`' . $date_time . '`)"  >
                                                    <img src=" ../image/header_selectImg/rest.png" alt="icon"> 
                                                        <span>
                                                            Rest
                                                        </span>
                                                    </li>
                                                    <li  onclick="activity_status(this,`' . $login_time . '`,`' . $user_id . '`,`' . $user_name . '`,`' . $date_time . '`)">
                                                    <img src=" ../image/header_selectImg/onMeeting.png" alt="icon"> 
                                                        <span>
                                                            On A Meeting
                                                        </span>
                                                    </li>
                                                    <li  onclick="activity_status(this,`' . $login_time . '`,`' . $user_id . '`,`' . $user_name . '`,`' . $date_time . '`)" >
                                                    <img src=" ../image/header_selectImg/busy.png" alt="icon"> 
                                                        <span>
                                                            Do Not Disturb
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>                                     
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                        <hr id="hr_line1">
                    
                        <div id="dropdown-content1_foot1"> 
                            <a href="../action/myProfile.php">                                
                                <span class="material-icons">account_circle</span>
                                <span id="content">My Profile</span>
                            </a>
                        </div> 
                    </div>
                    <div id="dropdown-content2">
                        <a href="../action/logout.php" id="logout_btn">
                        <span class="material-icons" id="logoutImg">logout</span>
                            <span id="content">Log out</span>
                        </a>
                        <hr id="hr_line2">
                        <div id="dropdown-content2_foot2">
                            <a href="../action/statistics.php" id="content1">
                                Statistics
                            </a>
                            <span class="material-Icons-outline">fiber_manual_record</span>
                            <a id="content2" >
                                Abbreviations
                            </a>
                        </div>
                    </div>                       
                </div>
            </div>

            <!--<img src="../image/header_top_icon/questionnaire.png" alt="question" id="questionicon">-->
            </div>            
        ';
    }
    // changing class name of navbar ( <div class="navbar">';)to  head-nav
    echo '
    <div class="head-nav">';

    if ($loggedin == true) {

        date_default_timezone_set('Asia/Kolkata');
        $date = date("dS F Y");
        $time = date("g:i A");

        $phase = date("A");
        $phase_det = '';
        if ($phase == 'AM') {
            $phase_det = "Good Morning!";
        } else {
            $phase_det = "Good Afternoon!";
        }

        echo ' 
                    <ul id="nav_content_l">
                            <p>Welcome, ' . $user_name . ' ' .   $phase_det . '&nbsp;Today is ' . $date . '</p>
                    </ul>
                    
                ';
    }
    echo ' 
    </div>';

    ?>




    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script type="text/javascript" src="../script/JQuery_2.0.js"></script>
    <!-- <script type="text/javascript" src="../script/jQuery3.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../script/logOut_box.js" type="text/javascript"></script>
    <script src="../script/myprflData.js" type="text/javascript"></script>
    <script src="../script/UserCurrStat.js" type="text/javascript"></script>

    <!-- <script type="text/javascript" src="../script/custom-selectbox.js"></script> -->
</body>

</html>