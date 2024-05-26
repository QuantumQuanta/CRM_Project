<?php
$servername = "localhost";
$username = "Subham";
$password = "Subham@123@";
$database = "testing";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (($_SERVER['REQUEST METHOD']) == 'POST') {
    $resp1 = $_POST['resp1'];
    $doc1 = $_POST['doc'];
    $client_name = $_POST['client_name'];
    $resp2 = $_POST['resp_2'];
    $doc2 = $_POST['doc_2'];
    $client_state = $_POST['client_state'];
    echo json_encode("PRO:" . $resp1 . " DOC1:" . $doc1 . " Client Name:" . $client_name . " 2RESP:" . $resp2 . " DOC2:" . $doc2 . " Client State:" . $client_state);
}
?>
<!---------------------------------------------------------------------------------------------------->


<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
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

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../stylesheet/header_login.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>header</title>
</head>

<body>

    <?php
    if ($loggedin == true) {
        echo '
        <!--heder top body-->
            <div id="header_top">
                <div id="header_top_dropdown" >
                    <!--<button id="header_top_dropbtn"></button>-->
                    <div id="header_imgright" >
                        <label class="avatar-edit">
                            <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg" required="true"/>
                            <img src="../image/header_top_icon/profile1.jpg" alt="profile" id="profileImage12">
                        </label>
                        <label class="profile-img">
                            
                            <img src="../image/header_top_icon/profile1.jpg" alt="profile" id="profileImage" >
                        </label>
                    </div>
                    <div id="header_top_dropdown-content" style="display:none;">
                        <div id="dropdown-content1">
                            <div id="dropdown-content1_header1">
                                    <img src="../image/header_top_icon/profile1.jpg" alt="profile" id="drop_content_Image" >
                                    <div id="dropdown-header_card">
                                    <p><b>' . $user_name . '</b></p>
                                    <p>jesminbaidya123@gmail.com</p>  
                                    <p>12324354657</p>  
                                    <div class="sub_dropdown">                        
                                        <img src="../image/header_top_icon/questionnaire.png" alt="question" id="questionicon" class="dropdown-btn">
                                        <div class="dropdown-container">
                                            <a href="#">Active</a>
                                            <a href="#">Busy</a>
                                            <a href="#">Ofline</a>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                            <hr id="hr_line1">
                        
                            <div id="dropdown-content1_foot1"> 
                                    <a href="#">                                
                                        <span class="material-icons">account_circle</span>
                                        <span id="content">My Profile</span>
                                    </a>
                            </div> 
                        </div>
                        <div id="dropdown-content2">
                                <a href="../action/logout.php" id="logout_btn">
                                <span class="material-icons" id="logoutImg">logout</span>
                                    <span id="content">Sign out</span>
                                </a>
                                <hr id="hr_line2">
                                <div id="dropdown-content2_foot2">
                                    <a href="#" id="content1">
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
    echo '
    <div class="navbar">';

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
                    <div id="nav_content_l">
                        <p>Welcome, ' . $user_name . ' ' .   $phase_det . '&nbsp;Today is ' . $date . '</p>
                    </div>
                    
                ';
    }
    echo ' 
    </div>';
    ?>

    <!-- <div class="container">
        <div class="avatar-upload">
            <div class="avatar-edit">
                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                <label for="imageUpload"></label>
            </div>
            <div class="avatar-preview">
                <div id="imagePreview" style="background-image: url('http://i.pravatar.cc/500?img=7');">
                </div>
            </div>
        </div>
    </div> -->









    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <script src="../script/JQuery_2.0.js" type="text/javascript"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->


    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->

    <script src="../script/header_imagechange.js" type="text/javascript"></script>


    <script src="../script/profile_btn.js" type="text/javascript"></script>
    <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>

</body>

</html>



<!---CSS--->
*, *:before, *:after {
box-sizing: inherit;
margin: 0;
padding: 0;
}
body {
padding: 0;
margin: 0;
font-family: "Lato", sans-serif;
overflow-x: hidden;
}

#header_top {
height: 5%;
width: 100%;
margin-bottom: 3px;
position: relative;
}

#header_top_dropdown {
float: right;
position: relative;
display: inline-block;
margin-top: 0.4%;
width: 5%;
margin-right: 5%;
z-index: 1;
}


#header_imgright {
position: relative;
max-width: 205px;
margin: 25% auto;

}
.avatar-edit {
position: absolute;
right: 12px;
z-index: 1;
background: white;
border-radius: 50%;
top: 16px;
margin-right: -8px;
cursor: pointer;
width: 30px;
height: 30px;
overflow: hidden;
}
#imageUpload {
display: none;
}
#profileImage {
position: absolute;
/* float: right; */
width: 75px;
height: 75px;
border-radius: 50%;
border: 2px solid #444444;
box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
margin-top: -2.3em;
/* margin-right: 13%; */
cursor: pointer;
display: block;
/* z-index: 1; */
}
#profileimg {
display: none;
}

#header_top_dropdown-content {
display: none;
position: absolute;
right: 0;
width: 364px;
min-width: 364px;
box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
z-index: 1;
margin-top: 107px;
/* height: 289px; */
margin-right: 14px;
border-radius: 22px;
background: #eff6fe;
margin-left: 115px;
overflow: hidden;
}


#dropdown-content1_foot1 a:hover {
/* padding: 10px; */
border-bottom-left-radius: 22px;
border-bottom-right-radius: 22px;
background-color: #dee6fb;
}



#dropdown-content1 {
background-color: white;
border-radius: 22px;
border: none;
margin: 9px 10px;
box-sizing: border-box;
padding: 13px;
/* display: flex; */
}

#drop_content_Image {
width: 19%;
height: 25%;
border-radius: 50%;
border: 2px solid #444444;
box-shadow: 4px 6px 7px rgba(0, 0, 0, 0.2);
margin-top: 3px;
margin-right: 18px;
display: block;
position: absolute;
position: absolute;
}

#dropdown-content1_header1 {
display: flex;
}

#dropdown-header_card {
width: 100%;
padding-top: 19px;
padding-left: 93px;
}

#dropdown-header_card p {
margin-top: -12px;

}

#hr_line1 {
width: 111%;
margin-left: -22px;
border: 1px solid #eff6fe;
border-radius: 12px;
margin-top: 15px;
}

#dropdown-header_card a {
display: flex;
}

#dropdown-content1_foot1 {
width: 105%;
display: flex;
}

#dropdown-content1_foot1 a {
color: #0b0a0a;
padding: 17px 35px;
text-decoration: none;
display: block;
font-size: 13px;
font-weight: 500;
width: 104%;
border-bottom-left-radius: 22px;
/* background: black; */
margin-left: -14px;
/* margin-right: -9px; */
margin-top: -8px;
margin-bottom: -13px;
border-bottom-right-radius: 22px;
}

#dropdown-content1_foot1 #content {
font-size: 16px;
margin-left: 43px;
font-weight: bold;
vertical-align: middle;
line-height: 18px;
}

@font-face {
font-family: 'Material Icons';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/materialicons/v140/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2) format('woff2');
}

.material-icons {
font-family: 'Material Icons';
font-weight: normal;
font-style: normal;
font-size: 31px;
line-height: 0;
letter-spacing: normal;
text-transform: none;
display: inline-block;
white-space: nowrap;
word-wrap: normal;
direction: ltr;
-webkit-font-feature-settings: 'liga';
-webkit-font-smoothing: antialiased;
display: inline-block;
vertical-align: middle;
margin-left: 1px;
}


#dropdown-content2 #content {
font-size: 16px;
margin-left: 38px;
font-weight: bold;
vertical-align: middle;
line-height: 18px;
}

#hr_line2 {
width: 119.2%;
margin-left: -28.2px;
border: 1px solid rgb(205, 220, 233);
border-radius: 12px;
margin-top: 11px;
}

#dropdown-content2 {
margin: -12px 15px;
box-sizing: border-box;
padding: 14px;
/* display: flex; */
}

#dropdown-content2 a {
color: black;
padding: 5px 16px;
text-decoration: none;
display: block;
font-size: 13px;
font-weight: 500;
width: 100%;
}

#dropdown-content2 #logoutImg {
margin-left: 36px;
}



#dropdown-content2_foot2 {
/* font-size: 16px; */
/* margin-left: 26px; */
/* font-weight: bold; */
display: flex;
vertical-align: middle;
line-height: 18px;
}

#dropdown-content2_foot2 a {
line-height: 27px;
}

#dropdown-content2_foot2 #content1 {
font-size: 17px;
margin-left: 43px;
/* font-weight: bold; */
vertical-align: middle;
padding: 5px;
}

#dropdown-content2_foot2 #content2 {
font-size: 17px;
margin-left: 3px;
/* font-weight: bold; */
vertical-align: middle;
padding: 5px;
}

#dropdown-content2_foot2 #content1:hover {
text-decoration: underline;
}

#dropdown-content2_foot2 #content2:hover {
text-decoration: underline;
}

#dropdown-content2 #logout_btn {
/* padding-right: 45px; */
/* background: blue; */
margin-left: -30px;
padding-top: 14px;
padding-bottom: 14px;
margin-top: -10px;
margin-bottom: -11px;
width: 119%;

}


#dropdown-content2 #logout_btn:hover {
background-color: #dee6fb;
}

@font-face {
font-family: 'Material Icons-outline';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/materialicons/v140/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2) format('woff2');
}

.material-Icons-outline {
font-family: 'Material Icons-outline';
font-size: 9px;
line-height: 4;
vertical-align: middle;
margin-left: -37px;
margin-right: 17px
}



#dropdown-header_card a {
display: flex;
padding-top: 5px;
padding-left: 14px;
padding-bottom: 11px;
text-decoration: none;
}
.sub_dropdown {
position: relative;
display: inline-block;
}
.dropdown-btn {
display: block;
border: none;
background: none;
text-align: left;
cursor: pointer;
outline: none;
}
#dropdown-header_card a:hover{
background-color: #dee6fb;;
}



.dropdown-container {
display: none;
position: absolute;
background-color: #eff6fe;
min-width: 160px;
overflow: auto;
box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
z-index: 1;
border-radius: 6px;
padding: 8px;
}


h5 {
text-align: right;
font-size: 80px;
font-weight: 500;
background: -webkit-linear-gradient(#020c6d, #706036);
-webkit-background-clip: text;
}


.navbar {
height: 3.1%;
width: 100%;
color: #2b62e4;
padding-top: 20px;
background-image: linear-gradient(70deg, rgba(2,0,36,1),rgb(76, 76, 163)35%, rgb(46, 196, 226) 100%);
position: absolute;
}

/* @keyframes gradientChange {
0% {
background-position: 0 0;
}

12.5% {
background-position: 100% 0;
}

25% {
background-position: 100% 100%;
}

37.5% {
background-position: 0 100%;
}

50% {
background-position: 0 0;
}

62.5% {
background-position: 100% 0;
}

75% {
background-position: 100% 100%;
}

87.5% {
background-position: 0 100%;
}

100% {
background-position: 0 0;
}
} */




#nav_content_l {
/* display: flex; */
margin-top: -25px;
color: white;
font-size: 16px;
font-weight: bold;
width: 100%;

}
#nav_content_l p{
animation: 3s linear 1s infinite running slidein;
}

#navbar_oms {
position: absolute;
right: 0;
margin-top: 5px;
padding-right: 11px;
}


/* new design heading */










<?php
switch ($desgCode) {
    case "PRO":
        echo 'Public Relationship Officer';
        break;
    case "2NDRESP":
        echo 'Level-2 Respondent';
        break;
    case "CEO":
        echo 'Chief Executive Officer';
        break;
    default:
        echo 'Yet to be Designated!';
        break;
}


$special_query = "SELECT `client_stat_1`,`client_stat_2` FROM `mixed_input_proresp` WHERE `uniq_id`=3 AND `dt`=(SELECT MAX(`dt`) FROM `mixed_input_proresp` WHERE `uniq_id`=3)";
$special_query2 = "SELECT `uniq_id`,`dt`,`client_stat_1`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`=1 AND `client_stat_1` IS NOT NULL;";
$spqcial_query3 = "WITH LatestEntry AS(SELECT `uniq_id`,`dt`,`client_stat_1`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`=1 AND `client_stat_1` IS NOT NULL) SELECT `client_stat_1` FROM `LatestEntry` WHERE `client_stat_1` IS NOT NULL ORDER BY `entry_seq`";
?>