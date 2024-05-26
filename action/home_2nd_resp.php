<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == '2NDRESP' || $_SESSION['desg_code'] == 'CRTR') {


    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
} else {
    header("location: ../action/index.php");
}
?>
<?php
require '../constant/userActivityfn.php';
$_SESSION['LAST_ACTIVE_TIME'] = time();
?>

<!doctype html>
<html lang="en">

<head>
    <script src="../script/backPre.js" type="text/javascript"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../stylesheet/home_2nd_resp.css">
    <title>home</title>
</head>

<body>
    <!-- page body with sidenav start -->
    <div id="contentMain">
        <?php require '../layout/sidebar.php'; ?>
        <div id="contentBody">
            <!--heder top body End-->

            <?php
            require '../layout/header_login.php';
            echo '<input id="user_name" value="' . $user_id . '" hidden/>';
            ?>
            <div class="position-relative1">
                <?php
                require '../layout/ReminAtTime.php';
                ?>
                <div class="row">
                    <div class="col"><label for="">New Clients :</label>
                        <?php

                        ?>
                        <p id="user_new_client" name="user_new_client"></p>
                    </div>
                    <div class="col"><label for="">Total Clients :</label>
                        <?php
                        require '../constant/db_connect.php';
                        $sql_total_client = "SELECT DISTINCT `uniq_id` FROM `crm_master_table` WHERE `2nd_resp`='$user_name';";
                        $result_total_client = mysqli_query($conn, $sql_total_client);
                        $num_total_client = mysqli_num_rows($result_total_client);
                        ?>
                        <p id="user_total_client" name="user_total_client"><?php echo $num_total_client ?></p>
                    </div>
                    <div class="col"><label for="">Dead Leads :</label>
                        <?php
                        require '../constant/db_connect.php';
                        $sql_dead_client = "SELECT DISTINCT `uniq_id` FROM `mixed_input_proresp` WHERE `sec_resp_name`='$user_id' AND `client_stat_2`='Number Invalid' OR 'Left The Field/Trade';";
                        $result_dead_client = mysqli_query($conn, $sql_dead_client);
                        $num_dead_client = mysqli_num_rows($result_dead_client);
                        ?>
                        <p id="user_dead_client" name="user_dead_client"><?php echo $num_dead_client ?></p>
                    </div>
                    <div class="col"><label for="">Active Clients :</label>
                        <p id="user_active_client" name="user_active_client"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require '../layout/footer.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../script/notificationAtTime.js" type="text/javascript"></script>
    <script src="../script/activity_stat.js" type="text/javascript"></script>
    <script src="../script/fontawesomeJS.js"></script>
</body>

</html>