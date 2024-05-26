<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'PRO' || $_SESSION['desg_code'] == 'CRTR') {
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

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../stylesheet/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../stylesheet/visitor_log.css">
    <title>visitor_log</title>
    <style>

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
            <div class="vis_container">
                <div class="container visitorlogTable">
                    <table id="visitor_log_table" class="table resizable-table" style="overflow-x:auto;">
                        <thead>
                            <tr>
                                <th>Visitor's Id No.</th>
                                <th>Visitor's Name</th>
                                <th>Data Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../constant/db_connect.php';
                            require '../constant/encrypt_decrypt.php';

                            $sqlvisDataFetch = "SELECT * FROM `visitor_log_main` WHERE `vis_filledby` = '$user_name'";
                            $resultvisDataFetch = mysqli_query($conn, $sqlvisDataFetch);
                            date_default_timezone_set('Asia/Kolkata');
                            $visitorUnqData;
                            while ($rowVis = mysqli_fetch_assoc($resultvisDataFetch)) {
                                $visitorUnqData = encryptData($rowVis['vis_unq_id']);
                                echo '
                                <tr>
                                    <td>ENV-' . $rowVis['vis_unq_id'] . '-' . 'VSTR</td>
                                    <td><a href="" id="visName' . $rowVis['vis_unq_id'] . '" data-bs-toggle="modal" data-bs-target="#visDataModal" onclick="visDataDisplay(' . $rowVis['vis_unq_id'] . ')">' . $rowVis['vis_name'] . '</a></td>
                                    <td>
                                    <a href="../action/downloadVisData.php?data=' . $visitorUnqData . '">
                                        Download
                                    </a>
                                    </td>
                                </tr>
                                ';
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <!-- <div id="dbInsertMsg">

                </div> -->
                <div class="subVis_container">
                    <div class="subVis_buttons">
                        <button id="newVisTrig" class="formBtn btn-primary"><span>Make New Entry</span></button>
                        <button id="exVisTrig" class="formBtn btn-success"><span>Update Existing Entry</span></button>
                    </div>
                </div>
            </div>

            <div class="container visitorlogInput" id="new_entry" style="display: none;">
                <h3 for="">Make a New Visitor Entry Here</h3>
                <form action="../action/visitor_log_config.php" method="post" id="visLogForm" name="visLogForm" enctype="multipart/form-data">
                    <div>
                        <?php
                        date_default_timezone_set('Asia/Kolkata');
                        $dateTime = date("d-m-Y H:i ");
                        echo '
                        <input type="hidden" id="vis_dt" name="vis_dt" value="' . $dateTime . '">
                        ';
                        ?>
                    </div>
                    <div class="vis_fullRow">
                        <label for="visname">Visitor's Name :</label>
                        <input type="text" id="visname" name="visname">
                    </div>
                    <div class="vis_row">
                        <div class="vis_col1">
                            <label for="visidproof">Choose an ID proof :</label>
                            <div id="visidproof">
                                <input type="radio" id="aadharc" name="idproof" value="AADHAR CARD">
                                <label for="aadharc">Aadhar Card</label><br>
                                <input type="radio" id="voterc" name="idproof" value="VOTER CARD">
                                <label for="voterc">Voter Card</label><br>
                                <input type="radio" id="panc" name="idproof" value="PAN CARD">
                                <label for="panc">Pan Card</label><br>
                                <input type="radio" id="dl" name="idproof" value="DRIVING LICENCE">
                                <label for="dl">Driving Licence</label><br>
                                <input type="radio" id="passport" name="idproof" value="PASSPORT">
                                <label for="passport">Passport</label><br>
                                <input type="radio" id="other" name="idproof" value="OTHER">
                                <label for="other">Other</label><br>
                            </div>
                            <!-- <button id="addMoreBtn" name="addMoreBtn" style="display: none;">+Add More</button> -->
                            <div id="visidprooffiles">
                                <input type="file" name="visidproofpics[]" id="visidproofpics" accept="image/*" multiple>
                            </div>
                        </div>
                        <div class="vis_col2">
                            <div class="vis_col_time">
                                <label for=" visexat">Expected Arrival Date & Time :</label>
                                <input type="datetime-local" id="visexat" name="visexat">
                            </div>
                            <div class="vis_col_time">
                                <label for="visacat">Actual Arrival Date & Time :</label>
                                <input type="datetime-local" id="visacat" name="visacat">
                            </div>
                        </div>
                    </div>
                    <div class="visidproofno">
                        <div id="visidproofno" class="visSubIdproof">
                        </div>
                    </div>
                    <div class="vis2_Name">
                        <label for="visascname">Associates' Name :</label>
                        <input type="text" id="visascname" name="visascname">
                    </div>
                    <div class="vis_row">
                        <div class="vis_col1">
                            <label for="visAssidproof">Choose an ID proof :</label>
                            <div id="visAssidproof">
                                <input type="radio" id="ass_aadharc" name="visAssidproof" value="ASS AADHAR CARD">
                                <label for="ass_aadharc">Aadhar Card</label><br>
                                <input type="radio" id="ass_voterc" name="visAssidproof" value="ASS VOTER CARD">
                                <label for="ass_voterc">Voter Card</label><br>
                                <input type="radio" id="ass_panc" name="visAssidproof" value="ASS PAN CARD">
                                <label for="ass_panc">Pan Card</label><br>
                                <input type="radio" id="ass_dl" name="visAssidproof" value="ASS DRIVING LICENCE">
                                <label for="ass_dl">Driving Licence</label><br>
                                <input type="radio" id="ass_passport" name="visAssidproof" value="ASS PASSPORT">
                                <label for="ass_passport">Passport</label><br>
                                <input type="radio" id="ass_other" name="visAssidproof" value="ASS OTHER">
                                <label for="ass_other">Other</label><br>
                            </div>
                            <div id="visAssidprooffiles">
                                <input type="file" name="visAssidproofpics[]" id="visAssidproofpics" accept="image/*" multiple>
                            </div>
                        </div>
                        <!-- <button id="addMoreBtn" name="addMoreBtn" style="display: none;">+Add More</button> -->
                        <div class="vis_col2">
                            <div class="subCol1">
                                <?php
                                echo '<input type="hidden" id="visfillbyname" name="visfillbyname" value="' . $user_name . '">';
                                ?>
                                <div class="subRow1">
                                    <label for="vistomeet">To Meet :</label>
                                    <select id="vistomeet" name="vistomeet" class="neumorphism-container">
                                        <option selected>Choose...</option>
                                        <option value="CEO">CEO</option>
                                        <option value="ROS">ROS</option>
                                        <option value="AJG">AJG</option>
                                        <option value="SM">SM</option>
                                        <option value="BC">BC</option>
                                        <option value="MK">MK</option>
                                        <option value="JP">JP</option>
                                        <option value="HR">HR</option>
                                        <option value="PUJA">PUJA</option>
                                        <option value="DEBARATI">DEBARATI</option>
                                        <option value="CHAYANIKA">CHAYANIKA</option>
                                        <option value="MITALI">MITALI</option>
                                        <option value="DEBLINA">DEBLINA</option>
                                        <option value="ABHISHEK">ABHISHEK</option>
                                    </select>
                                </div>
                                <div class="subRow2">
                                    <label for="viskycstat">KYC :</label>
                                    <select id="viskycstat" name="viskycstat">
                                        <option selected>Choose...</option>
                                        <option value="YES">Yes</option>
                                        <option value="NO">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="subCol2">
                                <label for="vismeetroom">Meeting Room :</label>
                                <input type="text" id="vismeetroom" name="vismeetroom">
                            </div>
                        </div>
                    </div>
                    <div class="visidproofno">
                        <div id="visAssidproofno" class="visSubIdproof">
                        </div>
                    </div>
                    <div class="vis2_Row">
                        <div class="vis2_col">
                            <label for="visadd">Address :</label>
                            <input type="text" id="visadd" name="visadd">
                        </div>
                        <div class="vis2_col">
                            <label for="visemail">Email :</label>
                            <input type="email" id="visemail" name="visemail">
                        </div>
                    </div>
                    <div class="vis_RowComm">
                        <label for="viscom">Comments :</label>
                        <input type="text" id="viscom" name="viscom">
                    </div>
                    <br>
                    <div class="vis_submitBtn">
                        <button id="vissubbtn" name="vissubbtn">SUBMIT</button>
                    </div>
                </form>
            </div>
            <br>
            <div class="container visitorlogInput2" id="exist_entry" style="display: none;">
                <h3 for="">Update Existing Visitor's Entry</h3>
                <form action="../action/existing_visitor_log_config.php" method="post" id="visLogForm2" name="visLogForm2" enctype="multipart/form-data">
                    <div>
                        <?php
                        date_default_timezone_set('Asia/Kolkata');
                        $dateTime = date("d-m-Y H:i ");
                        echo '
                        <input type="hidden" id="exvis_dt" name="exvis_dt" value="' . $dateTime . '">
                        <input type="hidden" id="exvisfillbyname" name="exvisfillbyname" value="' . $user_name . '">
                        ';
                        ?>
                    </div>
                    <br>
                    <div class="vis2_ID">
                        <label for="exvisunqid">Visitor's ID :</label>
                        <input type="text" id="exvisunqid" name="exvisunqid">
                    </div>
                    <br>
                    <div class="vis2_dates">
                        <div class="dates_col">
                            <label for="exvisexat">Expected Arrival Date & Time:</label>
                            <input type="datetime-local" id="exvisexat" name="exvisexat">
                        </div>
                        <div class="dates_col">
                            <label for="exvisacat">Actual Arrival Date & Time:</label>
                            <input type="datetime-local" id="exvisacat" name="exvisacat">
                        </div>
                    </div>
                    <br>
                    <div class="vis2_Name">
                        <label for="exvisascname">Associates' Name:</label>
                        <input type="text" id="exvisascname" name="exvisascname">
                    </div>
                    <br>
                    <div class="vis_row">
                        <div class="vis_col1">
                            <label for="exvisAssidproof">Choose an ID proof:</label>
                            <div id="exvisAssidproof">
                                <input type="radio" id="ex_ass_aadharc" name="exvisAssidproof" value="EX ASS AADHAR CARD">
                                <label for="ex_ass_aadharc">Aadhar Card</label><br>
                                <input type="radio" id="ex_ass_voterc" name="exvisAssidproof" value="EX ASS VOTER CARD">
                                <label for="ex_ass_voterc">Voter Card</label><br>
                                <input type="radio" id="ex_ass_panc" name="exvisAssidproof" value="EX ASS PAN CARD">
                                <label for="ex_ass_panc">Pan Card</label><br>
                                <input type="radio" id="ex_ass_dl" name="exvisAssidproof" value="EX ASS DRIVING LICENCE">
                                <label for="ex_ass_dl">Driving Licence</label><br>
                                <input type="radio" id="ex_ass_passport" name="exvisAssidproof" value="EX ASS PASSPORT">
                                <label for="ex_ass_passport">Passport</label><br>
                                <input type="radio" id="ex_ass_other" name="exvisAssidproof" value="EX ASS OTHER">
                                <label for="ex_ass_other">Other</label><br>
                            </div>
                            <div id="exvisAssidprooffiles">
                                <input type="file" name="exvisAssidproofpics[]" id="exvisAssidproofpics" accept="image/*" multiple>
                            </div>
                        </div>
                        <div class="vis_col2">
                            <div class="subCol1">
                                <div class="subRow1">
                                    <label for="exvistomeet">To Meet:</label>
                                    <select id="exvistomeet" name="exvistomeet" class="neumorphism-container">
                                        <option selected>Choose...</option>
                                        <option value="CEO">CEO</option>
                                        <option value="ROS">ROS</option>
                                        <option value="AJG">AJG</option>
                                        <option value="SM">SM</option>
                                        <option value="BC">BC</option>
                                        <option value="MK">MK</option>
                                        <option value="JP">JP</option>
                                        <option value="HR">HR</option>
                                        <option value="PUJA">PUJA</option>
                                        <option value="DEBARATI">DEBARATI</option>
                                        <option value="CHAYANIKA">CHAYANIKA</option>
                                        <option value="MITALI">MITALI</option>
                                        <option value="DEBLINA">DEBLINA</option>
                                        <option value="ABHISHEK">ABHISHEK</option>
                                    </select>
                                </div>
                                <div class="subRow2">
                                    <label for="exviskycstat">KYC:</label>
                                    <select id="exviskycstat" name="exviskycstat">
                                        <option selected>Choose...</option>
                                        <option value="YES">Yes</option>
                                        <option value="NO">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="subCol2">
                                <label for="exvismeetroom">Meeting Room:</label>
                                <input type="text" id="exvismeetroom" name="exvismeetroom">
                            </div>
                        </div>
                    </div>
                    <div class="visidproofno">
                        <div id="exvisAssidproofno" class="visSubIdproof">
                        </div>
                    </div>
                    <br>
                    <div class="vis2_Row">
                        <div class="vis2_col">
                            <label for="exvisadd">Address:</label>
                            <input type="text" id="exvisadd" name="exvisadd">
                        </div>
                        <div class="vis2_col">
                            <label for="exvisemail">Email:</label>
                            <input type="email" id="exvisemail" name="exvisemail">
                        </div>
                    </div>
                    <br>
                    <div class="vis_RowComm">
                        <label for="exviscom">Comments:</label>
                        <input type="text" id="exviscom" name="exviscom">
                    </div>
                    <br>
                    <div class="vis_submitBtn">
                        <button id="exvissubbtn" name="exvissubbtn">SUBMIT</button>
                    </div>
                </form>
            </div>

            <!-- Visitor Data Display MOdal-->
            <div class="modal fade" id="visDataModal" aria-labelledby="visDataModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title" id="visDataModalLabel">Visitor Visits</p>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body">
                            <div class="card" id="visDataModalbody"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="modalClosebtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

    require '../layout/footer.php';
    ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../script/jQuery3.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" type="text/javascript">
        $(document).ready(function() {
            let table = new DataTable('#visitor_log_table');
        })
    </script>
    <script src="../script/visitorLog.js" type="text/javascript"></script>
    <script src="../script/visitorDataDisplay.js" type="text/javascript"></script>
    <script src="../script/activity_stat.js" type="text/javascript"></script>
</body>

</html>