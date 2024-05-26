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
<!doctype html>
<html lang="en" class="no-js">

<head>
    <script src="../script/backPre.js" type="text/javascript"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Creation</title>
    <link rel="stylesheet" href="../stylesheet/new_user.CSS">

</head>

<body>
    <!-- page body with sidenav start -->
    <div id="contentMain">
        <?php require '../layout/sidebar.php'; ?>
        <div id="contentBody">
            <!--heder top body End-->
            <?php
            require '../layout/header_login.php';
            ?>
            <div class="container-fluid">
                <div class="loginDiv">
                    <div class="div_forImage">
                        <img src="../image/theme_forlogInpage.jpg" alt="theme_forlogInpage" srcset="">
                        <div class="imageText">
                            <h1>Create New User</h1>
                            <h4>It's quick and easy!</h4>
                        </div>
                    </div>
                    <div id="new_user_div">
                        <form action="../action/new_user_config.php" method="post" id="newUserCreateForm" enctype="multipart/form-data">
                            <div class="Name_div">
                                <label for="user_name_div">Name </label>
                                <div id="user_name_div" class="user_name_div">
                                    <input type="text" id="userfirstName" name="userfirstName" placeholder="First Name">
                                    <input type="text" id="userlastName" name="userlastName" placeholder="Last Name">
                                </div>
                            </div>
                            <br>
                            <div class="mob_emailDiv">
                                <div id="user_contact_div" class="user_contact_div">
                                    <label for="userContactNo">Mobile/Contact No </label>
                                    <input type="tel" id="userContactNo" name="userContactNo" placeholder="Contact No.">
                                </div>
                                <div class="usermail_div">
                                    <label for="userEmailId">Email Id </label>
                                    <input type="email" id="userEmailId" name="userEmailId" placeholder="Email Id">
                                </div>
                            </div>
                            <br>
                            <div id="user_desg_div" class="user_desg_div">
                                <label for="userDesgCode">Designation Code </label>
                                <select name="userDesgCode" id="userDesgCode">
                                    <option selected>Choose...</option>
                                    <option value="PRO">PRO</option>
                                    <option value="2NDRESP">2nd Resp.</option>
                                </select>
                            </div>
                            <br>
                            <div class="UniName_pass">
                                <div id="user_unqname_div" class="user_unqname_div">
                                    <label for="userUniqueId">Unique User Id(Login Id)</label>
                                    <input type="text" id="userUniqueId" name="userUniqueId" placeholder="Enter a unique user-id!">
                                </div>
                                <div id="user_pass_div" class="user_pass_div">
                                    <label for="userPass">Password </label>
                                    <input type="password" id="userPass" name="userPass" placeholder="Create a strong password!">
                                </div>
                            </div>
                            <br>
                            <div id="user_pic_div" class="user_pic_div">
                                <label for="custom_file">Upload an image </label>
                                <div class="custom-file" id="custom_file">
                                    <input type="file" class="custom-file-input" id="userPic" name="userPic" accept="image/*" onchange="displayFileName()">                                   
                                    <label class=" custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div id="user_submit_div" class="user_submit_div">
                                <button id="nuSubBtn" name="nuSubBtn" type="submit">CREATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require '../layout/footer.php';
        ?>


        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../script/createUser.js" type="text/javascript"></script>
</body>

</html>