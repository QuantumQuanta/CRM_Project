<?php
// require '../action/session_control.php';
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="../stylesheet/crm2.css" rel="stylesheet">
    <link rel="stylesheet" href="../stylesheet/c_req2.css">
    <link rel="stylesheet" href="../stylesheet/cReqDiv.css">
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
            <a href="../action/dateWiseRec_proresp.php" class="button-link" id="dateWiseRec" style="vertical-align:middle"><span>Date Wise Records</span></a>
            <div class="container-fluid">
                <table class="table resizable-table secresp_client_table" id="secresp_client_table" name="secresp_client_table" width="100%">
                    <thead>
                        <tr class="table">
                            <th class="slno" id="slno" scope="col">CID</th>
                            <th class="doa" id="doa" scope="col">DOA</th>
                            <th class="clientDetails" id="clientDetails" scope="col">Client's Name with State & Code</th>
                            <th class="contactNo" id="contactNo" scope="col">Contact No.</th>
                            <th class="bcr" id="bcr" scope="col">BCR</th>
                            <th class="verifi" id="verifi" scope="col">Verified</th>
                            <th class="first_resp" id="first_resp" scope="col">1st Responded</th>
                            <th class="remarks" id="remarks" scope="col">Remarks</th>
                            <th class="doa_3rdresp" id="doa_3rdresp" scope="col">DOA for 3rd Responded</th>
                            <th class="thirdresp" id="thirdresp" scope="col">3rd Responded</th>
                            <th class="doa_4thresp" id="doa_4thresp" scope="col">DOA-4th Res</th>
                            <th class="fourthresp" id="fourthresp" scope="col">4th Responded</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Database connection
                        require '../constant/db_connect.php';
                        //Data fetch from crm_master_table for 2nd Resp.
                        $sql_2resp_fetch = "SELECT * FROM `crm_master_table` WHERE `2nd_resp`='$user_name'";//ORDER BY `doa_1` DESC
                        $result_2resp_fetch = mysqli_query($conn, $sql_2resp_fetch);
                        while ($row_2 = mysqli_fetch_assoc($result_2resp_fetch)) {
                            $formattedDate = date('d.m.Y', strtotime($row_2['doa_1']));
                            echo '<tr>
                                <td class="slno" scope="row">' . $row_2['sl_no'] . '</td>
                                <td class="doa">' . $formattedDate . '</td>
                                <td class="clientDEtailstd clientDetails">    
                                <a data-bs-toggle="offcanvas" href="#client_offcanvas_2" id="offcanvas_toggler" name="offcanvas_toggler" onclick="uniq_id_input_2(' . $row_2['uniq_id'] . ');" role="button" aria-controls="offcanvasExample");">'
                                . $row_2['code'] . " " . $row_2['client_name'] . " " . $row_2['client_state'] . '
                                </a>
                                </td>
                                <td class="contactNo">' . $row_2['client_contact'] . '</td>
                                <td class="bcr">' . $row_2['bcr'] . '</td>
                                <td class="verifi">CEO Sir Table</td>
                                <td class="first_respTd first_resp">' . $row_2['1st_resp'] . '</td>
                                <td class="remarksTd remarks">'. $row_2['remarks'] .'</td>
                                <td class="doa_3rdresp">' . $row_2['doa_3'] . '</td>
                                <td class="third_respTd thirdresp">' . $row_2['3rd_resp'] . '</td>
                                <td class="doa_4thresp">NO Data</td>
                                <td class="fourthresp">NO Data</td>
                                </tr> ';
                        } ?>
                    </tbody>
                </table>
            </div>



            <!--Off-canvas menu-->
            <div>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="client_offcanvas_2" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <div class="col-5 ms-auto">
                            <img src="../image/logo.png" alt="" height="150px" width="150px">
                        </div>
                        <div class="offcanvasClient-details">
                            <div class="subRow">
                                <h5 class="text-center" id="offcanvas_client_name_2">'</h5>
                                <label for="more_options">
                                    <!--More Options-->
                                    <!-- Button to open pro_workable page -->
                                    <img src="../image/crm_icon/arrow1.png" alt="" height="30px" width="30px" srcset="">
                                    <button type="submit" class="btn btn-success" id="btn_uniq_id_2" name="btn_uniq_id_2">
                                        More Options
                                    </button>
                                </label>
                                <button id="sub_cReqRESP">C-Requirement</button>

                            </div>
                            <div class="container">
                                <div class="sub-container">
                                    <div class="row justify-content-md">
                                        <div class="col col-lg-2">
                                            <img src="../image/crm_icon/email1.png" alt="" height="15px" width="15px" srcset="">
                                        </div>
                                        <div class="col col-lg-2">
                                            <label for="" id="offcanvas_client_email_2">

                                            </label>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md">
                                        <div class="col col-lg-2">
                                            <img src="../image/crm_icon/call1.png" alt="" height="15px" width="15px" srcset="">
                                        </div>
                                        <div class="col col-lg-2">
                                            <label for="" id="offcanvas_client_contact_2">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md">
                                        <div class="col col-lg-2">
                                            <img src="../image/crm_icon/location.png" alt="" height="20px" width="20px" srcset="">
                                        </div>
                                        <div class="col col-lg-4">
                                            <label for="" id="offcanvas_client_state_2">

                                            </label>
                                        </div>
                                        <div class="col col-lg-4">
                                            <label for="" id="offcanvas_client_city_2">

                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-container" style="width: 21.5%;">
                                    <div class="col">
                                        Client ID:
                                        <label for="" id="offcanvas_uniq_id_2" name="offcanvas_uniq_id_2">

                                        </label>
                                        <br>&nbsp<br>
                                        <label for="" id="offcanvas_1st_resp_2">

                                        </label>
                                        <br>&nbsp<br>
                                        Code:
                                        <label for="" id="offcanvas_code_2">

                                        </label>

                                    </div>

                                    <div class="col">
                                        <label for="" id="offcanvas_reference_2">

                                        </label>
                                        <label for="" id="offcanvas_category_2">

                                        </label>
                                    </div>
                                    <div class="col col-lg-4">
                                        <label for="" id="offcanvas_doa_1_2">

                                        </label>
                                    </div>
                                    <!-- <div class="col col-lg-4">
                                        <label for="" id="offcanvas_2nd_resp_2">

                                        </label>
                                    </div>
                                    <div class="col col-lg-4">
                                        <label for="" id="offcanvas_doa_3_2">

                                        </label>
                                    </div>
                                    <div class="col col-lg-4">
                                        <label for="" id="offcanvas_3rd_resp_2">

                                        </label>
                                    </div> -->
                                </div>
                                <div id="c_REQ" class="sub-container box">

                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" data-bs-keyboard="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="offcanvas-Innerbody">
                            <div class="body-container">
                                <div class="SubBodyContainer" id="currentNoteData">


                                </div>
                            </div>
                            <div class="currentNoteArea">
                                <textarea style="min-height:80%;resize: none;height: 235px;border-radius: 12px;" id="currentNote" name="currentNote" placeholder='Add your personal note on this client...'></textarea>
                                <input type="hidden" name="respUname" id="respUname" value="<?php echo $user_id; ?>">
                                <br>
                                <div class="currNoteBtnDiv">
                                    <button id="currentNoteBtn">Add-Note</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--C-Requirement-->
                    <div id="creqDiv" class="creqModal">
                        <div class="creqModal-content">
                            <span class="creqModalclose" id="creqDivClose">&times;</span>
                            <label id="cReqClientID"></label>
                            <br>
                            <br>
                            <div class="form">
                                <input type="hidden" name="throughName" id="throughName">
                                <div class="form-ele">
                                    <label class="CREQlbl" for="priority">Priority:</label>
                                    <select name="priority" id="prioritySel">
                                        <option value="" selected>Choose..</option>
                                        <option value="Urgent">Urgent</option>
                                        <option value="Most Urgent">Most Urgent</option>
                                        <option value="Moderate">Moderate</option>
                                        <option value="Whenever you can">Whenever you can</option>
                                    </select>
                                </div>
                                <div class="form-ele">
                                    <label class="CREQlbl" for="proposalSharedOn">Proposal Shared On:</label>
                                    <input type="date" id="proposalSharedOn" name="proposalSharedOn">
                                </div>
                                <div class="form-ele">
                                    <label class="CREQlbl" for="proposalDetails">Proposal Details:</label>
                                    <textarea id="proposalDetails" name="proposalDetails"></textarea>
                                </div>
                                <div class="form-ele">
                                    <div class="form-subele">
                                        <label class="CREQlbl" for="proposalSite">Proposal Site:</label>
                                        <input type="text" id="proposalSite" name="proposalSite">
                                    </div>
                                    <br>
                                    <div class="form-subele">
                                        <label class="CREQlbl" for="proposalState">Proposal State:</label>
                                        <select name="proposalState" id="proposalState">
                                            <option value="" selected>Choose..</option>
                                            <option value="AN">Andaman and Nicobar Islands</option>
                                            <option value="AP">Andhra Pradesh</option>
                                            <option value="AR">Arunachal Pradesh</option>
                                            <option value="AS">Assam</option>
                                            <option value="BR">Bihar</option>
                                            <option value="CG">Chhattisgarh</option>
                                            <option value="CH">Chandigarh</option>
                                            <option value="DD">Daman and Diu</option>
                                            <option value="DN">Dadra & Nagar Haveli</option>
                                            <option value="DL">Delhi</option>
                                            <option value="GA">Goa</option>
                                            <option value="GJ">Gujarat</option>
                                            <option value="HP">Himachal Pradesh</option>
                                            <option value="HR">Haryana</option>
                                            <option value="JH">Jharkhand</option>
                                            <option value="JK">Jammu and Kashmir</option>
                                            <option value="KA">Karnataka</option>
                                            <option value="KL">Kerala</option>
                                            <option value="LA">Ladakh</option>
                                            <option value="LD">Lakshadweep</option>
                                            <option value="MH">Maharashtra</option>
                                            <option value="ML">Meghalaya</option>
                                            <option value="MN">Manipur</option>
                                            <option value="MP">Madhya Pradesh</option>
                                            <option value="MZ">Mizoram</option>
                                            <option value="NL">Nagaland</option>
                                            <option value="OR">Orissa/ Odisha</option>
                                            <option value="PB">Punjab</option>
                                            <option value="PY">Pondicherry/ Puducherry</option>
                                            <option value="RJ">Rajasthan</option>
                                            <option value="SK">Sikkim</option>
                                            <option value="TG">Telangana</option>
                                            <option value="TN">Tamil Nadu</option>
                                            <option value="TR">Tripura</option>
                                            <option value="UK">Uttarakhand</option>
                                            <option value="UP">Uttar Pradesh</option>
                                            <option value="WB">West Bengal</option>
                                            <option value="NP">Nepal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-ele" id="flexElementDiv1">
                                    <div class="form-subele">
                                        <label class="CREQlbl" for="quote">Quote:</label>
                                        <input type="number" id="quote" name="quote">
                                    </div>
                                    &nbsp;
                                    <div class="form-subele">
                                        <label class="CREQlbl" for="currency">Currency:</label>
                                        <select name="currency" id="currency">
                                            <option value="" selected>Choose..</option>
                                            <option value="USD">USD - United States Dollar</option>
                                            <option value="EUR">EUR - Euro</option>
                                            <option value="JPY">JPY - Japanese Yen</option>
                                            <option value="GBP">GBP - British Pound Sterling</option>
                                            <option value="AUD">AUD - Australian Dollar</option>
                                            <option value="CAD">CAD - Canadian Dollar</option>
                                            <option value="INR">INR - Indian Rupee</option>
                                            <option value="CNY">CNY - Chinese Yuan</option>
                                            <option value="CHF">CHF - Swiss Franc</option>
                                            <option value="AED">AED - United Arab Emirates Dirham</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-ele">
                                    <label class="CREQlbl" for="fsaDetails">F.S.A Details:</label>
                                    <textarea id="fsaDetails" name="fsaDetails"></textarea>
                                </div>
                                <div class="form-ele">
                                    <textarea id="ownRemarks" name="ownRemarks" placeholder="Any comments?"></textarea>
                                </div>
                                <div class="form-submit">
                                    <button id="subBtnCREQ" type="submit">SUBMIT</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--C-Requirement Edit-->
                    <div id="creqEditDiv" class="creqModal">
                        <div class="creqModal-content">
                            <span class="creqModalclose" id="creqEditDivClose">&times;</span>
                            <label id="cReqEditClientID"></label>
                            <br>
                            <br>
                            <div class="form">
                                <input type="hidden" name="dateForEdit" id="dateForEdit">
                                <input type="hidden" name="editThroughname" id="editThroughname">
                                <div class="form-ele">
                                    <label class="CREQlbl" for="priority">Priority:</label>
                                    <select name="priority" id="prioritySelEdit">
                                        <option value="" selected>Choose..</option>
                                        <option value="Urgent">Urgent</option>
                                        <option value="Most Urgent">Most Urgent</option>
                                        <option value="Moderate">Moderate</option>
                                        <option value="Whenever you can">Whenever you can</option>
                                    </select>
                                </div>
                                <div class="form-ele">
                                    <label class="CREQlbl" for="proposalSharedOn">Proposal Shared On:</label>
                                    <input type="date" id="proposalSharedOnEdit" name="proposalSharedOn">
                                </div>
                                <div class="form-ele">
                                    <label class="CREQlbl" for="proposalDetails">Proposal Details:</label>
                                    <textarea id="proposalDetailsEdit" name="proposalDetails"></textarea>
                                </div>
                                <div class="form-ele">
                                    <div class="form-subele">
                                        <label class="CREQlbl" for="proposalSite">Proposal Site:</label>
                                        <input type="text" id="proposalSiteEdit" name="proposalSite">
                                    </div>
                                    <br>
                                    <div class="form-subele">
                                        <label class="CREQlbl" for="proposalState">Proposal State:</label>
                                        <select name="proposalState" id="proposalStateEdit">
                                            <option value="" selected>Choose..</option>
                                            <option value="AN">Andaman and Nicobar Islands</option>
                                            <option value="AP">Andhra Pradesh</option>
                                            <option value="AR">Arunachal Pradesh</option>
                                            <option value="AS">Assam</option>
                                            <option value="BR">Bihar</option>
                                            <option value="CG">Chhattisgarh</option>
                                            <option value="CH">Chandigarh</option>
                                            <option value="DD">Daman and Diu</option>
                                            <option value="DN">Dadra & Nagar Haveli</option>
                                            <option value="DL">Delhi</option>
                                            <option value="GA">Goa</option>
                                            <option value="GJ">Gujarat</option>
                                            <option value="HP">Himachal Pradesh</option>
                                            <option value="HR">Haryana</option>
                                            <option value="JH">Jharkhand</option>
                                            <option value="JK">Jammu and Kashmir</option>
                                            <option value="KA">Karnataka</option>
                                            <option value="KL">Kerala</option>
                                            <option value="LA">Ladakh</option>
                                            <option value="LD">Lakshadweep</option>
                                            <option value="MH">Maharashtra</option>
                                            <option value="ML">Meghalaya</option>
                                            <option value="MN">Manipur</option>
                                            <option value="MP">Madhya Pradesh</option>
                                            <option value="MZ">Mizoram</option>
                                            <option value="NL">Nagaland</option>
                                            <option value="OR">Orissa/ Odisha</option>
                                            <option value="PB">Punjab</option>
                                            <option value="PY">Pondicherry/ Puducherry</option>
                                            <option value="RJ">Rajasthan</option>
                                            <option value="SK">Sikkim</option>
                                            <option value="TG">Telangana</option>
                                            <option value="TN">Tamil Nadu</option>
                                            <option value="TR">Tripura</option>
                                            <option value="UK">Uttarakhand</option>
                                            <option value="UP">Uttar Pradesh</option>
                                            <option value="WB">West Bengal</option>
                                            <option value="NP">Nepal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-ele" id="flexEditElementDiv1">
                                    <div class="form-subele">
                                        <label class="CREQlbl" for="quote">Quote:</label>
                                        <input type="number" id="quoteEdit" name="quote">
                                    </div>
                                    &nbsp;
                                    <div class="form-subele">
                                        <label class="CREQlbl" for="currency">Currency:</label>
                                        <select name="currency" id="currencyEdit">
                                            <option value="" selected>Choose..</option>
                                            <option value="USD">USD - United States Dollar</option>
                                            <option value="EUR">EUR - Euro</option>
                                            <option value="JPY">JPY - Japanese Yen</option>
                                            <option value="GBP">GBP - British Pound Sterling</option>
                                            <option value="AUD">AUD - Australian Dollar</option>
                                            <option value="CAD">CAD - Canadian Dollar</option>
                                            <option value="INR">INR - Indian Rupee</option>
                                            <option value="CNY">CNY - Chinese Yuan</option>
                                            <option value="CHF">CHF - Swiss Franc</option>
                                            <option value="AED">AED - United Arab Emirates Dirham</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-ele">
                                    <label class="CREQlbl" for="fsaDetails">F.S.A Details:</label>
                                    <textarea id="fsaDetailsEdit" name="fsaDetails"></textarea>
                                </div>
                                <div class="form-ele">
                                    <textarea id="ownRemarksEdit" name="ownRemarks" placeholder="Any comments?"></textarea>
                                </div>
                                <div class="form-submit">
                                    <button id="subBtnCREQEdit" type="submit">EDIT</button>
                                </div>
                            </div>
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
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../script/main_2.js" type="text/javascript"></script>
    <script src="../script/uniq_id_trans_2.js" type="text/javascript"></script>
    <script src="../script/crm_tblsResponsive.js" type="text/javascript"></script>
    <script src="../script/currNote.js" type="text/javascript"></script>
    <!-- <script src="../script/row_colResizing.js" type="text/javascript"></script> -->
    <script src="../script/cRequirement.js" type="text/javascript"></script>
    <script src="../script/activity_stat.js" type="text/javascript"></script>

</body>

</html>