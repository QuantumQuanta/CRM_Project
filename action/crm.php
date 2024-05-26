<?php
// require '../action/session_control.php';
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

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- <link rel="stylesheet" href="../stylesheet/crm_inner_modal_table.css"> -->
    <link  href="../stylesheet/crm.css" rel="stylesheet">
    <title>crm</title>
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

            <h2 class="text-center">Assigned Clients</h2>
            <!--Data Table-->
            <!-- <div class="container" id="searchdiv">
            <input type="text" placeholder="Search.." id="searchFilter" onkeyup="filterFunction1()">
            </div> -->
            <a href="../action/dateWiseRec_proresp.php" class="button-link" id="dateWiseRec" style="vertical-align:middle"><span>Date Wise Records</span></a>
            <div class="container-fluid">
                <table class="table resizable-table pro_client_table" style="width:100%" id="pro_client_table" name="pro_client_table">
                    <thead>
                        <tr class="table">
                            <th class="slno" id="slno" scope="col">CID</th>
                            <th class="doa_1" id="doa_1" scope="col">DOA-1</th>
                            <th class="clientDetails" id="clientDetails" scope="col">Client's Name with State & Code</th>
                            <th class="contactNo" id="contactNo" scope="col">Contact No.</th>
                            <th class="bcr" id="bcr" scope="col">BCR</th>
                            <th class="verifi" id="verifi" scope="col">Verified</th>
                            <th class="doa_2" id="doa_2" scope="col">DOA-2</th>
                            <th class="secnd_resp" id="secnd_resp" scope="col">2nd Responded</th>
                            <th class="remarks" class="remarks" scope="col">Remarks</th>
                            <th class="doa_3rdresp" id="doa_3rdresp" scope="col">DOA-3</th>
                            <th class="thirdresp" id="thirdresp" scope="col">3rd Responded</th>
                            <th class="doa_4thresp" id="doa_4thresp" scope="col">DOA-4</th>
                            <th class="fourthresp" id="fourthresp" scope="col">4th Responded</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Database connection
                        require '../constant/db_connect.php';
                        //Data fetch from crm_master_table for PRO
                        
                        $sql_pro_fetch = "SELECT * FROM `crm_master_table` WHERE `1st_resp`='$user_name' ORDER BY `doa_1` DESC";
                        $result_pro_fetch = mysqli_query($conn, $sql_pro_fetch);
                        while ($row = mysqli_fetch_assoc($result_pro_fetch)) {
                            $formattedDate = date('d.m.Y', strtotime($row['doa_1']));
                            echo '<tr>
                                <td class="slno" scope="row">' . $row['sl_no'] . '</td>
                                <td class="doa_1">' . $formattedDate . '</td>
                                <td class="clientDetails clientDEtailstd">    
                                <a data-bs-toggle="offcanvas" href="#client_offcanvas" id="offcanvas_toggler" name="offcanvas_toggler" onclick="uniq_id_input(' . $row['uniq_id'] . ');" role="button" aria-controls="offcanvasExample");">'
                                . $row['code'] . " " . $row['client_name'] . " " . $row['client_state'] . '
                                </a>
                                </td>
                                <td class="contactNo">' . $row['client_contact'] . '</td>
                                <td class="bcr">' . $row['bcr'] . '</td>
                                <td class="verifi">'.$row['verified'].'</td>
                                <td class="doa_2">' . $row['doa_2'] . '</td>
                                <td class="sec_respTd secnd_resp">' . $row['2nd_resp'] . '</td>
                                <td class="remarksTd remarks">'.$row['remarks'].'</td>
                                <td class="doa_3rdresp">' . $row['doa_3'] . '</td>
                                <td class="third_respTd thirdresp">' . $row['3rd_resp'] . '</td>
                                <td class="doa_4thresp">NO Data</td>
                                <td class="fourthresp">NO Data</td>
                                </tr> ';
                                
                        } ?>
                    </tbody>
                </table>
            </div>

            <!--Off-canvas menu-->
            <div>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="client_offcanvas" aria-labelledby="offcanvasExampleLabel" style="visibility: hidden;">
                    <div class="offcanvas-header">
                        <div class="row">
                            <div class="col-5 ms-auto">
                                <img src="../image/logo.png" alt="" height="150px" width="150px">
                            </div>
                        </div>
                        <br>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" data-bs-keyboard="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <h5 class="text-center" id="offcanvas_client_name"></h5>
                        <br>
                        <div class="container text-center">
                            <div class="row justify-content-md">
                                <div class="col col-lg-2">
                                    <img src="../image/crm_icon/call1.png" alt="" height="20px" width="20px" srcset="">
                                </div>
                                <div class="col col-lg-2">
                                    <label for="" id="offcanvas_client_contact">
                                    </label>
                                </div>
                            </div>
                            <div class="row justify-content-md">
                                <div class="col col-lg-2">
                                    <img src="../image/crm_icon/email1.png" alt="" height="20px" width="20px" srcset="">
                                </div>
                                <div class="col col-lg-2">
                                    <label for="" id="offcanvas_client_email">

                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="container text-center">
                            <div class="row justify-content-md">
                                <div class="col col-lg-4">
                                    <div class="badge bg-success text-wrap" style="width: 6rem;">
                                        <labelfor="">CLIENT ID:</label>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <label for="" id="offcanvas_uniq_id" name="offcanvas_uniq_id">

                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-md">
                                <div class="col col-lg-4">
                                    <div class="badge bg-success text-wrap" style="width: 6rem;">
                                        <labelfor="">STATE:</label>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <label for="" id="offcanvas_client_state">

                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-md">
                                <div class="col col-lg-4">
                                    <div class="badge bg-success text-wrap" style="width: 6rem;">
                                        <labelfor="">CITY:</label>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <label for="" id="offcanvas_client_city">
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-md">
                                <div class="col col-lg-4">
                                    <div class="badge bg-success text-wrap" style="width: 6rem;">
                                        <labelfor="">CODE:</label>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <label for="" id="offcanvas_code">

                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-md">
                                <div class="col col-lg-4">
                                    <div class="badge bg-success text-wrap" style="width: 6rem;">
                                        <labelfor="">REFERENCE:</label>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <label for="" id="offcanvas_reference">

                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-md">
                                <div class="col col-lg-4">
                                    <div class="badge bg-success text-wrap" style="width: 6rem;">
                                        <labelfor="">CATEGORY:</label>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <label for="" id="offcanvas_category">

                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-md">
                                <div class="col col-lg-4">
                                    <div class="badge bg-success text-wrap" style="width: 6rem;">
                                        <labelfor="">DOA-1:</label>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <label for="" id="offcanvas_doa_1">

                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-md">
                                <div class="col col-lg-4">
                                    <div class="badge bg-success text-wrap" style="width: 6rem;">
                                        <labelfor="">1ST-RESP.:</label>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <label for="" id="offcanvas_1st_resp">

                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-md">
                                <div class="col col-lg-4">
                                    <div class="badge bg-success text-wrap" style="width: 6rem;">
                                        <labelfor="">DOA-2:</label>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <label for="" id="offcanvas_doa_2">

                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-md">
                                <div class="col col-lg-4">
                                    <div class="badge bg-success text-wrap" style="width: 6rem;">
                                        <labelfor="">2ND-RESP.:</label>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <label for="" id="offcanvas_2nd_resp">

                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-md">
                                <div class="col col-lg-4">
                                    <div class="badge bg-success text-wrap" style="width: 6rem;">
                                        <labelfor="">DOA-3:</label>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <label for="" id="offcanvas_doa_3">

                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-md">
                                <div class="col col-lg-4">
                                    <div class="badge bg-success text-wrap" style="width: 6rem;">
                                        <labelfor="">3RD-RESP.:</label>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <label for="" id="offcanvas_3rd_resp">

                                    </label>
                                </div>
                            </div>
                            <br>


                        </div>
                    </div>
                    <label for="more_options">
                        <!--More Options-->
                        <!-- Button to open pro_workable page -->
                        <img src="../image/crm_icon/arrow1.png" alt="" height="30px" width="30px" srcset="">
                        <button class="btn btn-success" id="btn_uniq_id" name="btn_uniq_id">
                            More Options
                        </button>


                    </label>
                </div>
                <!-- <div class="modal-backdrop fade show"></div> -->
            </div>
        </div>
    </div>

    <?php
    require '../layout/footer.php';
    ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" type="text/javascript"></script>


    <script src="../script/main.js" type="text/javascript"></script>
    <!--pro input script-->
    <!-- <script src="../script/pro_input.js" type="text/javascript"></script> -->
    <script src="../script/uniq_id_trans.js" type="text/javascript"></script>
    <script src="../script/crm_tblsResponsive.js" type="text/javascript"></script>

    <!--script for data table-->

    <!-- <script src="../script/crm_inner_modal_table.js" type="text/javascript"></script> -->
    <!-- <script src="../script/row_colResizing.js" type="text/javascript"></script> -->
    <script src="../script/activity_stat.js" type="text/javascript"></script>
</body>

</html>