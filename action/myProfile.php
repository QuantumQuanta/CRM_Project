<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'PRO' || $_SESSION['desg_code'] == 'CEO' || $_SESSION['desg_code'] == '2NDRESP') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
    $desgCode = $_SESSION['desg_code'];
    $user_uniqueId = $_SESSION['user_id_no'];
} else {
    header("location: ../action/index.php");
}
?>
<?php
require '../constant/userActivityfn.php';
$_SESSION['LAST_ACTIVE_TIME'] = time();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../script/backPre.js" type="text/javascript"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myprofile</title>
    <link href="../stylesheet/bootstrapMin.css" rel="stylesheet" >
    <link rel="stylesheet" href="../stylesheet/userProfile.css">
</head>

<body>
    <div id="contentMain">
        <?php require '../layout/sidebar.php'; ?>
        <div id="contentBody">
            <?php
            require '../layout/header_login.php';
            ?>

            <?php
            require '../constant/db_connect.php';
            $userDetSQL = "SELECT * FROM `login_data` WHERE `id`=$user_uniqueId";
            $userDetRes = mysqli_query($conn, $userDetSQL);
            $userDetRow = mysqli_fetch_assoc($userDetRes);
            $totalClientNum;
            if ($desgCode === 'PRO') {
                $_sql_clientNum = "SELECT `uniq_id`, `client_name` FROM `crm_master_table` WHERE `1st_resp`= '$user_name'";
                $_res_clientNum = mysqli_query($conn, $_sql_clientNum);
                $totalClientNum = mysqli_num_rows($_res_clientNum);
            } elseif ($desgCode === '2NDRESP') {
                $_sql_clientNum = "SELECT `uniq_id`, `client_name` FROM `crm_master_table` WHERE `2nd_resp`= '$user_name'";
                $_res_clientNum = mysqli_query($conn, $_sql_clientNum);
                $totalClientNum = mysqli_num_rows($_res_clientNum);
            } else {
                echo "Designation Code doesn't match!";
            }



            ?>
            <!-- <a href="../action/logout.php"><button class="btn btn-danger btn-sm">Logout</button></a> -->
            <div class="main-body">
                <!-- /Breadcrumb -->
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="<?php echo $userDetRow['user_pic']; ?>" alt="profile_pic<3" class="rounded-circle" width="150" height="150">
                                    <div class="mt-3">
                                        <h4><?php echo $user_name; ?></h4>
                                        <p class="text-secondary mb-1"><?php
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
                                                                        ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <ul class="list-group list-group-flush">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mx-2">Designation:</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary">
                                        <p><?php echo $desgCode; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mx-2">Official Email:</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary">
                                        <p><?php echo $userDetRow['email']; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mx-2">Official Contact:</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary">
                                        <p><?php echo $userDetRow['contact']; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mx-2">Address:</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary">
                                        <p>Bay Area, San Francisco, CA</p>
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <br>
                        <div id="passReset">
                            <div id="passResetHeadDiv">
                                <h3>Password Reset</h3>
                                &nbsp;
                                <a href="#" id="passFAQ" name="passFAQ">
                                    <img src="../image/passReset/request.png" height="20px" width="20px" alt="FAQ">
                                </a>
                            </div>
                            <div>
                                <label for="prePass">Previous Password:</label>
                                <input id="prePass" name="prePass" type="text" require>
                                <label id="forprePass" style="display: none;"></label>
                            </div>
                            <div>
                                <label for="newPass">New Password:</label>
                                <input id="newPass" name="newPass" type="password">
                                <label id="fornewPass" style="display: none;"></label>
                            </div>
                            <div>
                                <label for="cnewPass">Confirm New Password:</label>
                                <input id="cnewPass" name="cnewPass" type="password">
                                <label id="forcnewPass" style="display: none;"></label>
                            </div>
                            <input type="hidden" name="userIDIn" id="userIDIn" value="<?php echo $user_id;?>">
                            <br>
                            <div>
                                <button class="passSubBtn-pushable" role="button" type="submit" id="passResetSubBtn" name="passResetSubBtn">
                                    <span class="passSubBtn-shadow"></span>
                                    <span class="passSubBtn-edge"></span>
                                    <span class="passSubBtn-front text">
                                        SAVE
                                    </span>
                                </button>
                            </div>
                            <label id="responseP" style="display: none;"></label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div>
                                    <h3>Total Number of Clients: <?php echo $totalClientNum; ?></h3>
                                </div>
                            </div>
                        </div>
                        <?php

                        //storing all clients' last updated client_stat by the particular user in a associative array with keys as clients' unique ids

                        require '../constant/db_connect.php';
                        $clientStatData1 = [];
                        $clientStatData2 = [];

                        try {
                            switch ($desgCode) {
                                case 'PRO':
                                    $_sql_clientUId = "SELECT `uniq_id`, `client_name` FROM `crm_master_table` WHERE `1st_resp`= '$user_name'";
                                    $_res_clientUId = mysqli_query($conn, $_sql_clientUId);
                                    while ($_row_clientUId = mysqli_fetch_assoc($_res_clientUId)) {
                                        $id = $_row_clientUId['uniq_id'];
                                        // echo "for " . $id . "<br>";
                                        $_sql_clientData = "WITH LatestEntry AS(SELECT `uniq_id`,`dt`,`client_stat_1`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= $id  AND `client_stat_1` IS NOT NULL) SELECT `client_stat_1`,`entry_seq` FROM `LatestEntry` WHERE `client_stat_1` IS NOT NULL ORDER BY `entry_seq`";
                                        $_res_clientData = mysqli_query($conn, $_sql_clientData);
                                        // $i = 0;
                                        while ($_row_clientData = mysqli_fetch_assoc($_res_clientData)) {
                                            if (!empty($_row_clientData)) {
                                                // echo($i . "-" . $_row_clientData['client_stat_1'] . '<br>');
                                                if ($_row_clientData['client_stat_1'] != ' ') {
                                                    // echo $_row_clientData['client_stat_1']. '<br>';
                                                    $clientStatData1[$id] = $_row_clientData['client_stat_1'];
                                                    break;
                                                } else {
                                                    continue;
                                                }
                                                // $i++;
                                            }
                                        }
                                    }
                                    // var_dump($clientStatData1);
                                    break;

                                case '2NDRESP':
                                    $_sql_clientUId = "SELECT `uniq_id`, `client_name` FROM `crm_master_table` WHERE `2nd_resp`= '$user_name'";
                                    $_res_clientUId = mysqli_query($conn, $_sql_clientUId);
                                    while ($_row_clientUId = mysqli_fetch_assoc($_res_clientUId)) {
                                        $id = $_row_clientUId['uniq_id'];
                                        // echo "for " . $id . "<br>";
                                        $_sql_clientData = "WITH LatestEntry AS(SELECT `uniq_id`,`dt`,`client_stat_2`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= $id  AND `client_stat_2` IS NOT NULL) SELECT `client_stat_2`,`entry_seq` FROM `LatestEntry` WHERE `client_stat_2` IS NOT NULL ORDER BY `entry_seq`";
                                        $_res_clientData = mysqli_query($conn, $_sql_clientData);
                                        // $i = 0;
                                        while ($_row_clientData = mysqli_fetch_assoc($_res_clientData)) {
                                            if (!empty($_row_clientData)) {
                                                // echo ($i . "-" . $_row_clientData['client_stat_2'] . '<br>');
                                                if ($_row_clientData['client_stat_2'] != ' ') {
                                                    // echo $_row_clientData['client_stat_2']. '<br>';
                                                    $clientStatData2[$id] = $_row_clientData['client_stat_2'];
                                                    break;
                                                } else {
                                                    continue;
                                                }
                                                // $i++;
                                            }
                                        }
                                    }
                                    // var_dump($clientStatData2);
                                    break;

                                default:
                                    throw new Exception("Invalid User Designation Code!");
                                    // break;
                            }
                        } catch (Exception $e) {
                            echo "Error:" . $e->getMessage();
                        }
                        ?>

                        <?php


                        //iterate the associative array for segregation based on client_stat
                        $clientstatCounts = [];

                        if (!empty($clientStatData1)) {
                            $clientstatCounts = array_count_values($clientStatData1);
                            // var_dump($clientstatCounts);
                        } elseif (!empty($clientStatData2)) {
                            $clientstatCounts = array_count_values($clientStatData2);
                            // var_dump($clientstatCounts);
                        } else {
                            echo "no data to display";
                        }
                        //assigning values to variable => value is the no. of clients for each client_stat category
                        $dnr;
                        $nr;
                        $nftf;
                        $dtc;
                        $nrsp;
                        $ni;
                        $nint;
                        $hg;
                        $ful;
                        $nc;
                        $npps;
                        $ltf;
                        $ncp;
                        $sp;
                        $c;
                        $mlc;
                        $apd;
                        $sit;
                        $ptv;
                        $it_tdnr;
                        $it_bnrfd;
                        $wit_bcdtc;
                        $sprop;
                        $nfi;
                        $sfi;
                        $aufs;
                        $li;
                        $bmn;
                        foreach ($clientstatCounts as $clientStat => $totalNum) {
                            try {
                                switch ($clientStat) {
                                    case "Did Not Receive":
                                        $dnr = $totalNum;
                                        break;
                                    case "Not Reachable":
                                        $nr =  $totalNum;
                                        break;
                                    case "Not From This Field":
                                        $nftf = $totalNum;
                                        break;
                                    case "Declined The Call":
                                        $dtc = $totalNum;
                                        break;
                                    case "Not Responding":
                                        $nrsp = $totalNum;
                                        break;
                                    case "Number Invalid":
                                        $ni = $totalNum;
                                        break;
                                    case "Not Interested":
                                        $nint = $totalNum;
                                        break;
                                    case "Having Grievances":
                                        $hg = $totalNum;
                                        break;
                                    case "Follow Up Later":
                                        $ful = $totalNum;
                                        break;
                                    case "Negative Client":
                                        $nc = $totalNum;
                                        break;
                                    case "NI-Post Profile Sharing":
                                        $npps = $totalNum;
                                        break;
                                    case "Left The Field/Trade":
                                        $ltf = $totalNum;
                                        break;
                                    case "No Current Proposal":
                                        $ncp = $totalNum;
                                        break;
                                    case "Shared Profile":
                                        $sp = $totalNum;
                                        break;
                                    case "Client":
                                        $c = $totalNum;
                                        break;
                                    case "Mediator/Liaisoner/Co-ordinator":
                                        $mlc = $totalNum;
                                        break;
                                    case "Awaiting Proposal Detail":
                                        $apd = $totalNum;
                                        break;
                                    case "Senior In-touch":
                                        $sit = $totalNum;
                                        break;
                                    case "Planning To Visit":
                                        $ptv = $totalNum;
                                        break;
                                    case "In-touch,But Today Did Not Receive":
                                        $it_tdnr = $totalNum;
                                        break;
                                    case "In-touch,But Not Receiving Few Days":
                                        $it_bnrfd = $totalNum;
                                        break;
                                    case "Was In-touch, But Currently Declining The Call":
                                        $wit_bcdtc = $totalNum;
                                        break;
                                    case "Shared Proposal":
                                        $sprop = $totalNum;
                                        break;
                                    case "No Fees,Investment":
                                        $nfi = $totalNum;
                                        break;
                                    case "Seeking For Investor":
                                        $sfi = $totalNum;
                                        break;
                                    case "Awaiting Update From Senior":
                                        $aufs = $totalNum;
                                        break;
                                    case "Language Issue":
                                        $li = $totalNum;
                                        break;
                                    case "Blocked My Number":
                                        $bmn = $totalNum;
                                        break;
                                    default:
                                        throw new Exception("Error: Not a client_stat category");
                                        // break;
                                }
                            } catch (Exception $e) {
                                echo "Error:" . $e->getMessage();
                            }
                        }
                        // echo $totalClientNum;
                        ?>

                        <div style="display: block;">
                            <div class="row gutters-sm">
                                <div class="col-sm-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <?php
                                            function percentageCal($part, $whole)
                                            {
                                                global $percentage;
                                                if ($whole == 0) {
                                                    return "Undefined!";
                                                } else {
                                                    $percentage = ($part / $whole) * 100;
                                                    return $percentage;
                                                }
                                            }
                                            ?>
                                            <h6 class="d-flex align-items-center justify-content-center mb-3" id="chh1">Client's Status:</h6>
                                            <small>Did Not Receive: <?php echo $dnr; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($dnr, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Not Reachable: <?php echo $nr; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($nr, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Not From This Field: <?php echo $nftf; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($nftf, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Declined The Call: <?php echo $dtc; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($dtc, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Not Responding: <?php echo $nrsp; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($nrsp, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Number Invalid: <?php echo $ni; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($ni, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Not Interested: <?php echo $nint; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($nint, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Having Grievances: <?php echo $hg; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($hg, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Follow Up Later: <?php echo $ful; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($ful, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Negative Client: <?php echo $nc; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($nc, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>NI-Post Profile Sharing: <?php echo $npps; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($npps, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Left The Field/Trade: <?php echo $ltf; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($ltf, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>No Current Proposal: <?php echo $ncp; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($ncp, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Language Issue: <?php echo $li; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($li, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="d-flex align-items-center justify-content-center mb-3" id="chh2">Client's Status:</h6>
                                            <small>Shared Profile: <?php echo $sp; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($sp, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Client: <?php echo $c; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($c, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Mediator/Liaisoner/Co-ordinator: <?php echo $mlc; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($mlc, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Awaiting Proposal Detail: <?php echo $apd; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($apd, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Senior In-touch: <?php echo $sit; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($sit, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Planning To Visit: <?php echo $ptv; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($ptv, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>In-touch,But Today Did Not Receive: <?php echo $it_tdnr; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($it_tdnr, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>In-touch,But Not Receiving Few Days: <?php echo $it_bnrfd; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($it_bnrfd, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Was In-touch, But Currently Declining The Call: <?php echo $wit_bcdtc; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($wit_bcdtc, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Shared Proposal: <?php echo $sprop; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($sprop, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>No Fees,Investment: <?php echo $nfi; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($nfi, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Seeking For Investor: <?php echo $sfi; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($sfi, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Awaiting Update From Senior: <?php echo $aufs; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($aufs, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                            <small>Blocked My Number: <?php echo $bmn; ?></small>
                                            <div class="progress mb-3" style="height: 20px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php percentageCal($bmn, $totalClientNum);
                                                                                                                        echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage . '%'; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php require '../layout/footer.php' ?>



    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../script/passReset.js" type="text/javascript"></script>
    <script src="../script/activity_stat.js" type="text/javascript"></script>
</body>

</html>