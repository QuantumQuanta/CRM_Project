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

<?php
date_default_timezone_set('Asia/Kolkata');
$date = date("g:i A d.m.y "); //dS F Y, g:i A
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

    <!-- <link rel="stylesheet" href="../stylesheet/master_crm.css"> -->
    <link rel="stylesheet" href="../stylesheet/master_crmV2.0.css">
    <!-- <script src="../script/JQuery.js" type="text/javascript"></script> -->
    <link rel="stylesheet" href="../stylesheet/jquery.dataTables.min.css">
    <title>ceo_crm</title>
    <style>
        div.dataTables_wrapper {
            width: 100%;
            /* margin: 0 auto; */
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


            <div id="mastercrmDiv">
                <div class='search-box'>
                    <h3 class="text-center">Assigned Clients' Information</h3>
                </div>
                <br />
                <!--Client Data Table-->
                <div class="hide_dropdown" id="hide_Btn">
                    <a href="../action/dateWiseRecords.php" class="button-link" id="dateWiseRec" style="vertical-align:middle"><span>Date Wise Records</span></a>
                    <!-- <button id="main_cReqCEO_Btn" style="vertical-align:middle"><span></span></button> -->
                    <button type="button" id="inline_editBtn" onClick="inlineEdit(this)"><span id="inline_edit_button">Inline Edit Enable</span></button>

                    <button id="hide_dropbtn" style="vertical-align:middle"> <span>HIDE</span></button>
                    <div id="hide_myDropdown" class="hide_dropdown_content" style="display: none;">
                        <a> <button id="sl_btn" class="tgl_btn_name"></button>SlNo </a>
                        <a> <button id="DOC_btn" class="tgl_btn_name"></button>DOC </a>
                        <a> <button id="DOA_1_btn" class="tgl_btn_name"></button>DOA-1 </a>
                        <a> <button id="Period_btn" class="tgl_btn_name"></button>Period</a>
                        <a> <button id="Clientdetails_btn" class="tgl_btn_name"></button>Client's Name with State & Code </a>
                        <a> <button id="Contact_btn" class="tgl_btn_name"></button>Contact No </a>
                        <a> <button id="BCR_btn" class="tgl_btn_name"></button>BCR</a>
                        <a> <button id="Verified_btn" class="tgl_btn_name"></button>Verified </a>
                        <a> <button id="PCR_btn" class="tgl_btn_name"></button>PCR</a>
                        <a> <button id="firstresp_btn" class="tgl_btn_name"></button>1st-resp</a>
                        <a> <button id="DOA2_btn" class="tgl_btn_name"></button>DOA-2 </a>
                        <a> <button id="secnd_resp_btn" class="tgl_btn_name"></button>2nd-Resp </a>
                        <a> <button id="DOA3_btn" class="tgl_btn_name"></button>DOA-3</a>
                        <a> <button id="third_resp_btn" class="tgl_btn_name"></button>3rd-Resp</a>
                        <a> <button id="Remarks_btn" class="tgl_btn_name"></button>Remarks </a>
                        <a> <button id="Email_btn" class="tgl_btn_name"></button>Email </a>
                    </div>
                </div>
                <br>
                <!-- <div id="sidebarEdit">
                    <div class="container" id="tableFnDiv" style="display: none;">
                        <button type="submit" class="btn btn-primary btn-sm" name="submit_edt" id="submit_edt" style="vertical-align:middle">
                            <span>Edit</span>
                        </button>
                        <button type="submit" class="btn btn-danger btn-sm" name="submit_del" id="submit_del" style="vertical-align:middle">
                            <span>Delete</span>
                        </button>
                    </div>
                </div> -->
                <br>
                <form class="editForm" action="" method="post">
                    <!-- modal trigger data-bs-toggle="modal" data-bs-target="#editModal"-->
                    <div class="masterCrmTblMainContain">
                        <div class="TableContainer">
                            <table id="ceo_master_table" class="ceo_master_table resizable-table">
                                <thead>
                                    <tr>
                                        <th class="SlNo" id="SlNo" scope="col"><!--<input type="checkbox" name="actionAll" id="actionAll" autocomplete="off">-->CID</th>
                                        <th class="DOC" id="DOC" scope="col" accessKey="doc">DOC</th>
                                        <th class="DOA_1" id="DOA_1" scope="col" accessKey="doa_1">DOA-1</th>
                                        <th class="Period" id="Period" scope="col" accessKey="period">Period</th>
                                        <th class="Client_Details" id="Client_Details" scope="col">Client's Name with State & Code</th>
                                        <th class="Contact" id="Contact" scope="col" accessKey="client_contact">Contact No.</th>
                                        <th class="BCR" id="BCR" scope="col" accessKey="bcr">BCR</th>
                                        <th class="Verified" id="Verified" scope="col" accessKey="verified">Verified</th>
                                        <th class="PCR" id="PCR" scope="col" accessKey="pcr">PCR</th>
                                        <th class="first_resp" id="1st_resp" scope="col" accessKey="1st_resp">1st-resp</th>
                                        <th class="DOA_2" id="DOA_2" scope="col" accessKey="doa_2">DOA-2</th>
                                        <th class="Resp_2" id="Resp_2" scope="col" accessKey="2nd_resp">2nd-Resp</th>
                                        <th class="DOA_3" id="DOA_3" scope="col" accessKey="doa_3">DOA-3</th>
                                        <th class="Resp_3" id="Resp_3" scope="col" accessKey="3rd_resp">3rd-Resp</th>
                                        <th class="Remarks" id="Remarks" scope="col" accessKey="remarks">Remarks</th>
                                        <th class="Email" id="Email" scope="col" accessKey="client_email">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //db connection
                                    require '../constant/db_connect.php';
                                    //Data fetch from crm_master_table for CEO
                                    $sql_ceo_data_fetch = "SELECT * FROM `crm_master_table` ORDER BY `doa_1` DESC";
                                    $result_ceo_data_fetch = mysqli_query($conn, $sql_ceo_data_fetch);

                                    $sl_no = 1;
                                    while ($row_ceo_data_fetch = mysqli_fetch_assoc($result_ceo_data_fetch)) {
                                        // $formattedDOC = date("d-m-Y", strtotime($row_ceo_data_fetch['doc']));
                                        // $formattedDOA1 = date("d-m-Y", strtotime($row_ceo_data_fetch['doa_1']));
                                        // $sql_all_DataFetch = "SELECT `name` FROM `login_data`";
                                        // $result_all_DataFetch = mysqli_query($conn, $sql_all_DataFetch);
                                        //<input type="checkbox" class="action_cl " id="action_uniq_id[]" autocomplete="off" value="' . $row_ceo_data_fetch['uniq_id'] . '" name="action_uniq_id[]">
                                        echo '
                                        <tr>
                                            <td  data-id="slno' . $sl_no . '" class="SlNo">                                               
                                                ' . $row_ceo_data_fetch['uniq_id'] . '
                                            </td>
                                            <td data-id="doc' . $sl_no . '" class="DOC" value="' . $row_ceo_data_fetch['uniq_id'] . '">
                                                ' . $row_ceo_data_fetch['doc'] . '
                                            </td>
                                            <td data-id="doa_1' . $sl_no . '" class=" DOA_1" value="' . $row_ceo_data_fetch['uniq_id'] . '">
                                                ' . $row_ceo_data_fetch['doa_1'] . '
                                            </td>
                                            <td data-id="period' . $sl_no . '" class="Period" value="' . $row_ceo_data_fetch['uniq_id'] . '">
                                                ' . $row_ceo_data_fetch['period'] . '
                                            </td>
                                            <td data-id="nameStateCode' . $sl_no . '" class="Client_Detailstd Client_Details" value="' . $row_ceo_data_fetch['uniq_id'] . '">
                                                <a data-bs-toggle="offcanvas" href="#offcanvas" id="offcanvas_toggler" class="offcanvas_toggler" name="offcanvas_toggler" role="button" onclick="client_id_input(' . $row_ceo_data_fetch['uniq_id'] . ');" aria-controls="offcanvasExample");">'
                                            . $row_ceo_data_fetch['code'] . " " . $row_ceo_data_fetch['client_name'] . " " . $row_ceo_data_fetch['client_state'] . '
                                                </a>                                                                           
                                            </td>
                                            <td data-id="contact' . $sl_no . '" class="Contact" value="' . $row_ceo_data_fetch['uniq_id'] . '">
                                                ' . $row_ceo_data_fetch['client_contact'] . '
                                            </td>
                                            <td data-id="bcr' . $sl_no . '" class="BCR" value="' . $row_ceo_data_fetch['uniq_id'] . '">
                                                ' . $row_ceo_data_fetch['bcr'] . '
                                            </td>
                                            <td data-id="verified' . $sl_no . '" class="Verified" value="' . $row_ceo_data_fetch['uniq_id'] . '">
                                                ' . $row_ceo_data_fetch['verified'] . '
                                            </td>
                                            <td data-id="pcr' . $sl_no . '" class="PCR" value="' . $row_ceo_data_fetch['uniq_id'] . '">
                                                ' . $row_ceo_data_fetch['pcr'] . '
                                            </td>
                                            <td data-id="firstResp' . $sl_no . '" class="first_resp" value="' . $row_ceo_data_fetch['uniq_id'] . '">                                                
                                                
                                                ' . $row_ceo_data_fetch['1st_resp'] . '
                                            </td>
                                            <td data-id="doa_2' . $sl_no . '" class="DOA_2" value="' . $row_ceo_data_fetch['uniq_id'] . '">
                                                ' . $row_ceo_data_fetch['doa_2'] . '
                                            </td>
                                            <td data-id="secResp' . $sl_no . '" class="Resp_2" value="' . $row_ceo_data_fetch['uniq_id'] . '">                                                
                                               ' . $row_ceo_data_fetch['2nd_resp'] . ' </td>
                                            <td data-id="doa_3' . $sl_no . '" class="DOA_3" value="' . $row_ceo_data_fetch['uniq_id'] . '">
                                                ' . $row_ceo_data_fetch['doa_3'] . '
                                            </td>
                                            <td data-id="thrResp' . $sl_no . '" class="Resp_3" value="' . $row_ceo_data_fetch['uniq_id'] . '">
                                                ' . $row_ceo_data_fetch['3rd_resp'] . '                                               
                                            </td>
                                            <td data-id="remarks' . $sl_no . '" class="Remarks" value="' . $row_ceo_data_fetch['uniq_id'] . '">
                                            ' . $row_ceo_data_fetch['remarks'] . '
                                            </td>
                                            <td data-id="email' . $sl_no . '" class="Email" value="' . $row_ceo_data_fetch['uniq_id'] . '">
                                                ' . $row_ceo_data_fetch['client_email'] . '
                                            </td>
                                        </tr>
                                        ';

                                        $sl_no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <br>
            <!--edit form-->
            <!-- <div class="modal" id="edit_div" name="edit_div">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form action="" id="editClientModal" name="editClientModal">
                        <div id="editFormDiv">
                            <div class="mb-3 text-container">
                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="editDOC">DOC : </label></div>
                                        <div class="col-75"><input type="date" class="form-control" id="editDOC" name="editDOC" value="" aria-describedby="emailHelp"></div>
                                    </div>
                                </div>
                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="editDOA1">DOA-1 : </label></div>
                                        <div class="col-75"><input type="date" id="editDOA1" name="editDOA1" value="" class="form-control"></div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="mb-3 text-container">
                                <div class="row">
                                    <div class="col-25"><label for="editPeriod">Period : </label></div>
                                    <div class="col-30">
                                        <input type="date" id="str_period" name="str_period" class="form-control-per">
                                    </div>
                                    <div class="col-30">
                                        <input type="date" id="end_period" name="end_period" class="form-control-per2">
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="mb-3 text-container">
                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="editCode">Code : </label></div>
                                        <div class="col-75"><input type="text" id="editCode" name="editCode" value="" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="editClientName">Client Name : </label></div>
                                        <div class="col-75"><input type="text" id="editClientName" name="editClientName" value="" class="form-control"></div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="mb-3 text-container">

                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="editClientState">Client State : </label></div>
                                        <div class="col-75">
                                            <select id="editClientState" name="editClientState" class="form-control">
                                                <option value="" selected>Choose</option>
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
                                                <option value="OR">Orissa/Odisha</option>
                                                <option value="PB">Punjab</option>
                                                <option value="PY">Pondicherry/Puducherry</option>
                                                <option value="RJ">Rajasthan</option>
                                                <option value="SK">Sikkim</option>
                                                <option value="TG">Telangana</option>
                                                <option value="TN">Tamil Nadu</option>
                                                <option value="TR">Tripura</option>
                                                <option value="UK">Uttarakhand</option>
                                                <option value="UP">Uttar Pradesh</option>
                                                <option value="WB">West Bengal</option>
                                                <option value="NP">Nepal</option>
                                                <option value="Mum">Mumbai</option>
                                                <option value="Kol">Kolkata</option>
                                                <option value="UP(E)">UP(E)</option>
                                                <option value="UP(W)">UP(W)</option>
                                                <option value="NE">NE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="editClientContact">Client Contact : </label></div>
                                        <div class="col-75"><input type="text" id="editClientContact" name="editClientContact" value="" class="form-control"></div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="mb-3 text-container">
                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="editBCR">BCR : </label></div>
                                        <div class="col-75"><input type="text" id="editBCR" name="editBCR" value="" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="editVerified">Verified : </label></div>
                                        <div class="col-75"><input type="text" id="editVerified" name="editVerified" value="" class="form-control"></div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="mb-3 text-container">
                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="editPCR">PCR : </label></div>
                                        <div class="col-75"><input type="text" id="editPCR" name="editPCR" value="" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="edit1Resp">1stResp : </label></div>
                                        <div class="col-75"><input type="text" id="edit1Resp" name="edit1Resp" value="" class="form-control"></div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="mb-3 text-container">
                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="editDOA2">DOA-2 : </label></div>
                                        <div class="col-75"><input type="date" id="editDOA2" name="editDOA2" value="" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="edit2Resp">2ndResp : </label></div>
                                        <div class="col-75"><input type="text" id="edit2Resp" name="edit2Resp" value="" class="form-control"></div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="mb-3 text-container">
                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="editDOA3">DOA-3 : </label></div>
                                        <div class="col-75"><input type="date" id="editDOA3" name="editDOA3" value="" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="input_container">
                                    <div class="row">
                                        <div class="col-25"><label for="edit3Resp">3rdResp : </label></div>
                                        <div class="col-75"><input type="text" id="edit3Resp" name="edit3Resp" value="" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3 text-container">
                                <div class="row">
                                    <div class="col-40"><label for="editRemarks">Remarks : </label></div>
                                    <div class="col-70"><input type="text" id="editRemarks" name="editRemarks" value="" class="form-control"></div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <br>
                        <div id="saveChangeBtn">
                            <button type="submit" id="edit_client_save" name="edit_client_save">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div> -->
            <!--offcanvas for particular client -->
            <div id="offcanvas" style="display: none;">
                <div class="offcanvas offcanvas-end" tabindex="-1" id="client_offcanvas_data" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <div class="row-5">
                            <div class="col-5 ms-auto">
                                <img src="../image/logo.png" alt="" height="110px" width="110px" id="search">
                            </div>
                        </div>
                        <!-- <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button> -->
                    </div>
                    <div class="offcanvas-body">
                        <!-- <button id="sub_cReqbtn">C-Requirement</button> -->
                        <h3 class="text-center" id="client_offcanvas_name"></h3>
                        <div class="row1">
                            <a id="sub_cReqCEO">C-Requirement</a>
                        </div>
                        <br>
                        <br>
                        <div class="row1">
                            <div class="col1">
                                <img src="../image/contact_logo.png" alt="" height="15px" width="15px" srcset="">
                            </div>
                            <br>
                            <div class="col2">
                                <label for="" id="client_offcanvas_contact">

                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row1">
                            <div class="col1">
                                <img src="../image/email_logo.png" alt="" height="15px" width="15px" srcset="">
                            </div>
                            <br>
                            <div class="col2">
                                <label for="" id="client_offcanvas_email">

                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-details1">
                                <label for="client_offcanvas_id">
                                    Client ID:
                                </label>
                            </div>
                            <br>
                            <div class="col-details2">
                                <label for="" id="client_offcanvas_id">

                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-details1">
                                <label for="client_offcanvas_state">
                                    STATE:
                                </label>
                            </div>
                            <br>
                            <div class="col-details2">
                                <label for="" id="client_offcanvas_state">

                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-details1">
                                <label for="client_offcanvas_city">
                                    CITY:
                                </label>
                            </div>
                            <br>
                            <div class="col-details2">
                                <label for="" id="client_offcanvas_city">

                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-details1">
                                <label for="client_offcanvas_code">
                                    CODE:
                                </label>
                            </div>
                            <br>
                            <div class="col-details2">
                                <label for="" id="client_offcanvas_code">

                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-details1">
                                <label for="client_offcanvas_ref">
                                    REFERENCE:
                                </label>
                            </div>
                            <br>
                            <div class="col-details2">
                                <label for="" id="client_offcanvas_ref">

                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-details1">
                                <label for="client_offcanvas_cat">
                                    CATEGORY:
                                </label>
                            </div>
                            <br>
                            <div class="col-details2">
                                <label for="" id="client_offcanvas_cat">

                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-details1">
                                <label for="client_offcanvas_doa1">
                                    DOA-1:
                                </label>
                            </div>
                            <br>
                            <div class="col-details2">
                                <label for="" id="client_offcanvas_doa1">

                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-details1">
                                <label for="client_offcanvas_1resp">
                                    1ST-RESP.:
                                </label>
                            </div>
                            <br>
                            <div class="col-details2">
                                <label for="" id="client_offcanvas_1resp">

                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-details1">
                                <label for="client_offcanvas_doa2">
                                    DOA-2:
                                </label>
                            </div>
                            <br>
                            <div class="col-details2">
                                <label for="" id="client_offcanvas_doa2">

                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-details1">
                                <label for="client_offcanvas_2resp">
                                    2ND-RESP.:
                                </label>
                            </div>
                            <br>
                            <div class="col-details2">
                                <label for="" id="client_offcanvas_2resp">

                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-details1">
                                <label for="client_offcanvas_doa3">
                                    DOA-3:
                                </label>
                            </div>
                            <br>
                            <div class="col-details2">
                                <label for="" id="client_offcanvas_doa3">

                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-details1">
                                <label for="client_offcanvas_3resp">
                                    3RD-RESP.:
                                </label>
                            </div>
                            <br>
                            <div class="col-details2">
                                <label for="" id="client_offcanvas_3resp">

                                </label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button id="mixedTableShow" name="mixedTableShow">
                            <span id="mixedTableShow-title">More Options</span>
                            <span id="mixedTableShow_Img"><img src="../image/arrow-right.png" alt="arrowpng" height="auto"></span>
                        </button>
                    </div>
                </div>
                <br>

                <div class="closebtn-div" id="closebtn-div">
                    <div class="offCanvasBtnDiv">
                        <span class="closebtn" id="closebtn" onclick="client_id_input();">&times;</span>
                        <div class="mixhide_dropdown" id="mixhide_dropdown" style="display: none;">
                        </div>
                    </div>
                    <br>
                    <div id="mixedDataTableCont" name="mixedDataTableCont" style="display: none; overflow-x:auto;">
                    </div>
                </div>
            </div>
            <br>
            <!--Client response Data Table-->
        </div>

        <!--<div class="container">
            <table id="mixedTableOutput" name="mixedTableOutput"></table>
        </div>-->


    </div>
    <?php
    require '../layout/footer.php';
    ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <script src="../script/jQuery3.js" type="text/javascript"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- important link for ceo table -->
    <script src="../script/dataTables_min.js" type="text/javascript"></script>
    <!-- important link for ceo table -->

    <script src="../script/ceo_crm.js" type="text/javascript"></script>
    <script src="../script/ceo_dt.js" type="text/javascript"></script>

    <script src="../script/ceo_inline_editV2.0.js" type="text/javascript"></script>
    <script src="../script/row_colResizing.js" type="text/javascript"></script>
    <script src="../script/MasterTable_hideCol.js" type="text/javascript"></script>
    <script src="../script/cRequirement.js" type="text/javascript"></script>
</body>

</html>