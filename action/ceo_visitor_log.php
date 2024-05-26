<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'CEO' || $_SESSION['desg_code'] == 'CRTR') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
} else {
    header("location: ../action/index.php");
}

?>


<!doctype html>
<html lang="en">

<head>
    <script src="../script/backPre.js" type="text/javascript"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="../stylesheet/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="../stylesheet/ceo_visitorLog.css">
    <title>visitor_log</title>
    <style>
        #visitor_log_table {
            table-layout: fixed;
        }

        .frozen-column {
            position: sticky;
            left: 0;
            z-index: 1;
            background-color: white;
        }

        .second-column {
            left: 100px;
            /* Adjust this value based on the width of the first column */
        }
    </style>

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
            <div class="vistable1_div">
                <table>
                    <thead>
                        <tr>
                            <th>Download</th>
                            <th>Visitor's Id No.</th>
                            <th>Visitor's Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require '../constant/db_connect.php';
                        require '../constant/encrypt_decrypt.php';
                        $sqlVisitorDet = "SELECT * FROM `visitor_log_main`";
                        $resVisitorDet = mysqli_query($conn, $sqlVisitorDet);
                        while ($rowVisitorDet = mysqli_fetch_assoc($resVisitorDet)) {
                            $en_visitor_unq_id = encryptData($rowVisitorDet['vis_unq_id']);
                            echo '
                            <tr>
                            <td><a href="../action/downloadVisDataceo.php?value=' . $en_visitor_unq_id . '">
                            Download
                            </a></td>
                            <td>' . $rowVisitorDet['vis_unq_id'] . '</td>
                            <td>' . $rowVisitorDet['vis_name'] . '</td>
                            </tr>
                            ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="hide_dropdown" id="hide_editBtn">
                <button id="visHide_dropbtn" style="vertical-align:middle"> <span>HIDE</span></button>
                <div id="visHide_myDropdown" class="hide_dropdown-content" style="display: none;">
                    <a> <button id="visId_no_tgl" class="tgl_btn_name"></button>Visitor's Id No. </a>
                    <a> <button id="visName_tgl" class="tgl_btn_name"></button>Visitor's Name </a>
                    <a> <button id="fillBy_tgl" class="tgl_btn_name"></button>Filled By</a>
                    <a> <button id="fill_DT_tgl" class="tgl_btn_name"></button>Fill Date & Time</a>
                    <a> <button id="exp_DT_tgl" class="tgl_btn_name"></button>Expected Arrival Date & Time</a>
                    <a> <button id="actual_DT_tgl" class="tgl_btn_name"></button>Actual Arrival Date & Time</a>
                    <a> <button id="asso_name_tgl" class="tgl_btn_name"></button>Associates' Name</a>
                    <a> <button id="meet_tgl" class="tgl_btn_name"></button>To Meet</a>
                    <a> <button id="meet_room_tgl" class="tgl_btn_name"></button>Meeting Room</a>
                    <a> <button id="visId_tgl" class="tgl_btn_name"></button>Visitor ID</a>
                    <a> <button id="assoId_tgl" class="tgl_btn_name"></button>Associates' ID</a>
                    <a> <button id="KYC_tgl" class="tgl_btn_name"></button>KYC</a>
                    <a> <button id="Add_tgl" class="tgl_btn_name"></button>Address</a>
                    <a> <button id="Email_tgl" class="tgl_btn_name"></button>Email</a>
                    <a> <button id="Comments_tgl" class="tgl_btn_name"></button>Comments</a>
                </div>
            </div>
            <br>
            <br>
            <div class="vistlogTableOuterContainer">
                <div class="container visitorlogTable">
                    <table id="visitor_log_table" style="overflow-x:auto;">
                        <thead>
                            <tr>
                                <th class="" id='visId_no'>Visitor's Id No.</th>
                                <th class="" id='visName'>Visitor's Name</th>
                                <th class="" id='fillBy'>Filled By</th>
                                <th class="" id='fill_DT'>Fill Date & Time</th>
                                <th class="" id='exp_DT'>Expected Arrival Date & Time</th>
                                <th class="" id='actual_DT'>Actual Arrival Date & Time</th>
                                <th class="" id='asso_name'>Associates' Name</th>
                                <th class="" id='meet'>To Meet</th>
                                <th class="" id='meet_room'>Meeting Room</th>
                                <th class="" id='visId'>Visitor ID</th>
                                <th class="" id='assoId'>Associates' ID</th>
                                <th class="" id='KYC'>KYC</th>
                                <th class="" id='Add'>Address</th>
                                <th class="" id='Email'>Email</th>
                                <th class="" id='Comments'>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../constant/db_connect.php';

                            $sqlallVisData = "SELECT * FROM `visitor_log_main` p INNER JOIN `visitor_log` f ON p.vis_unq_id = f.vis_unqidno";
                            $resallVisData = mysqli_query($conn, $sqlallVisData);
                            date_default_timezone_set('Asia/Kolkata');
                            while ($rowallvis = mysqli_fetch_assoc($resallVisData)) {
                                echo '
                                <tr>
                                    <td class="">ENV-' . $rowallvis['vis_unq_id'] . '-' . 'VSTR</td>
                                    <td class="visName">' . $rowallvis['vis_name'] . '</td>
                                    <td class="fillBy">' . $rowallvis['vis_filledby'] . '</td>
                                    <td class="">' . $rowallvis['vis_dt'] . '</td>
                                    <td class="exp_DT">' . $rowallvis['vis_eta'] . '</td>
                                    <td class="actual_DT">' . $rowallvis['vis_ata'] . '</td>
                                    <td class="asso_name">' . $rowallvis['vis_assname'] . '</td>
                                    <td class="">' . $rowallvis['vis_tomeet'] . '</td>
                                    <td class="">' . $rowallvis['vis_meetroom'] . '</td>
                                    <td class="visId">' . $rowallvis['vis_idno'] . '</td>
                                    <td class="assoId">' . $rowallvis['vis_assidno'] . '</td>
                                    <td class="">' . $rowallvis['vis_kycstat'] . '</td>
                                    <td class="Add">' . $rowallvis['vis_address'] . '</td>
                                    <td class="Email">' . $rowallvis['vis_email'] . '</td>
                                    <td class="Comments">' . $rowallvis['vis_comment'] . '</td>
                                </tr>
                                ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <?php

    require '../layout/footer.php';
    ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <!-- <script src="../script/jQuery3.js" type="text/javascript"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" type="text/javascript">
        // $(document).ready(function () {
        //     let table = new DataTable('#visitor_log_table');
        // })
    </script>
    <script src="../script/visitorLog.js" type="text/javascript"></script>
    <!-- <script src="../script/visitorDataDisplay.js" type="text/javascript"></script> -->
    <script src="../script/visTableHideCol.js" type="text/javascript"></script>


</body>

</html>