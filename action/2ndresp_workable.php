<?php
// require '../action/session_control.php';

session_start();
global $client_uniq_id2, $url_var;
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == '2NDRESP' || $_SESSION['desg_code'] == 'CRTR') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
    $client_uniq_id2 = $_SESSION['client_uniq_id2'];
    $client_name2 = $_SESSION['client_name2'];
    $client_state2 = $_SESSION['client_state2'];
    $client_city2 = $_SESSION['client_city2'];
    $client_Code2 = $_SESSION['client_Code2'];
    $userDsg = $_SESSION['desg_code'];
    $url_var = "../action/crm2.php";
}
else {
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
    <!--CSS for datatables-->
    <!--Data Table CSS-->
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="../stylesheet/secresp_workable.css">

    <title>2ndresp_workable</title>
</head>
 
<body>
    <?php
    if (isset($_REQUEST['cid'])) {
        $client_uniq_id2 = $_REQUEST['cid'];
        $url_var = "../action/dateWiseRec_proresp.php";
    }
    ?>
    <div id="contentMain">
        <?php require '../layout/sidebar.php'; ?>
        <div id="contentBody">
            <!--heder top body End-->
            <?php
            require '../layout/header_login.php';
            ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="client_col1">
                        <a href="<?php echo $url_var; ?>" type="button" class="btn btn-sm btn-success" style="vertical-align:middle" id="backBtn2"><span>Back</span></a>
                    </div>
                    <div class="client_col2">
                        <?php echo '<h3>' . $client_Code2 . " " . $client_name2 . " " . $client_state2 . " " . $client_city2 . '</h3>' ?>
                    </div>
                    <div class="visitor-log-resp">
                        <div class="vis-sub_div-resp">
                            <label for="proVisDT">EST- Visit Date:</label>
                            <textarea name="proVisDT" id="proVisDT" cols="2" rows="1"></textarea>
                        </div>
                        <div class="vis-sub_div-resp">
                            <label for="actVisDT">ACT- Visit Date:</label>
                            <textarea name="actVisDT" id="actVisDT" cols="2" rows="1"></textarea>
                        </div>
                        <div class="class">

                        </div>
                    </div>
                </div>
                <br>
                <div class="data-content">
                    <div class="table-content">
                        <div class="container">
                            <table id="secresp_show_data" class="table resizable-table">
                                <thead>
                                    <tr>
                                        <th id="pro_dT">D&T</th>
                                        <th id="pro_contact">Contacted Us</th>
                                        <th id="pro_kyc">KYC</th>
                                        <th id="pro_PCR_prt">(PCR)-Priority</th>
                                        <th id="pro_PCR_et">(PCR)-E.T</th>
                                        <th id="pro_callTy">Call-Type</th>
                                        <th id="pro_callSt">Call-Status</th>
                                        <th id="pro_category">Category</th>
                                        <th id="pro_source">Source</th>
                                        <th id="Comment_1">Comment-1</th>
                                        <th id="pro_clientST1">Client Status-1</th>
                                        <th id="pro_PCRresp1">(PCR)-Resp.-1</th>
                                        <th id="pro_PCR_pt1">(PCR)-P.T-1</th>
                                        <th id="pro_rat1">Client Rating-1</th>
                                        <th id="Comment_2">Comment-2</th>
                                        <th id="pro_clientST2">Client Status-2</th>
                                        <th id="pro_PCRresp2">(PCR)-Resp.-2</th>
                                        <th id="pro_PCR_pt2">(PCR)-P.T-2</th>
                                        <th id="pro_PCR_prc">(PCR)-P.R.C.</th>
                                        <th id="pro_rat2">Client Rating-2</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="container-form">
                        <div id="form-heading2">
                            <p>Please fill up and submit the Data(only once)</p>
                        </div>
                        <div class="form_div">
                            <input type="hidden" id="respDesg" name="respDesg" value="<?php echo $userDsg; ?>">
                            <div class="container-row2">
                                <label for="client_stat_2">Client Status</label>
                                <select id="client_stat_2" name="client_stat_2">
                                    <option value="">Choose...
                                    </option>
                                    <option value="Did Not Receive">Did Not Receive
                                    </option>
                                    <option value="Not Reachable">Not Reachable
                                    </option>
                                    <option value="Not From This Field">Not From This Field
                                    </option>
                                    <option value="Declined The Call">Declined The Call
                                    </option>
                                    <option value="Not Responding">Not Responding
                                    </option>
                                    <option value="Number Invalid">Number Invalid
                                    </option>
                                    <option value="Not Interested">Not Interested
                                    </option>
                                    <option value="Having Grievances">Having Grievances
                                    </option>
                                    <option value="Follow Up Later">Follow Up Later
                                    </option>
                                    <option value="Negative Client">Negative Client
                                    </option>
                                    <option value="NI-Post Profile Sharing">NI-Post Profile Sharing
                                    </option>
                                    <option value="Left The Field/Trade">Left The Field/Trade
                                    </option>
                                    <option value="No Current Proposal">No Current Proposal
                                    </option>
                                    <option value="Shared Profile">Shared Profile
                                    </option>
                                    <option value="Client">Client
                                    </option>
                                    <option value="Mediator/Liaisoner/Co-ordinator">Mediator/Liaisoner/Co-ordinator
                                    </option>
                                    <option value="Awaiting Proposal Detail">Awaiting Proposal Detail
                                    </option>
                                    <option value="Senior In-touch">Senior In-touch
                                    </option>
                                    <option value="Planning To Visit">Planning To Visit
                                    </option>
                                    <option value="In-touch">In-touch</option>
                                    <option value="In-touch,But Today Did Not Receive">In-touch,But Today Did Not Receive
                                    </option>
                                    <option value="In-touch,But Not Receiving Few Days">In-touch,But Not Receiving Few Days
                                    </option>
                                    <option value="Was In-touch, But Currently Declining The Call">Was In-touch, But Currently Declining The Call
                                    </option>
                                    <option value="Shared Proposal">Shared Proposal
                                    </option>
                                    <option value="No Fees,Investment">No Fees,Investment
                                    </option>
                                    <option value="Seeking For Investor">Seeking For Investor
                                    </option>
                                    <option value="Awaiting Update From Senior">Awaiting Update From Senior
                                    </option>
                                    <option value="Language Issue">Language Issue
                                    </option>
                                    <option value="Blocked My Number">Blocked My Number
                                    </option>
                                </select>
                            </div>
                            <div class="container-row">
                                <div class="container-col50">
                                    <label for="pcr_resp_2">PCR Resp.</label>
                                    <input type="text" placeholder="Enter within 1-100" id="pcr_resp_2" name="pcr_resp_2">
                                </div>
                                <div class="container-col50">
                                    <label for="pcr_pt_2">PCR P.T.</label>
                                    <input type="text" placeholder="Enter within 1-100" id="pcr_pt_2" name="pcr_pt_2">
                                </div>
                            </div>
                            <div class="container-row">
                                <div class="container-col50">
                                    <label for="pcr_prc">PCR P.R.C</label>
                                    <input type="text" placeholder="Enter within 1-100" id="pcr_prc" name="pcr_prc">
                                </div>
                                <div class="container-col50">
                                    <label for="client_rating_2">Client Rating</label>
                                    <select id="client_rating_2" name="client_rating_2">
                                        <option value="" selected>Choose...</option>
                                        <option value="A++">A++</option>
                                        <option value="A+">A+</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                    </select>
                                </div>
                            </div>
                            <?php
                            date_default_timezone_set('Asia/Kolkata');
                            $date = date("Y-m-d H:i:s"); //dS F Y, g:i A  g:i A d.m.y
                            echo '
                                <input type="hidden" id="date_time_2" name="date_time_2" value="' . $date . '">
                                <input type="hidden" id="secresp_name" name="secresp_name" value="' . $user_id . '">
                                <input type="hidden" name="client_uniq_id_trans_2" id="client_uniq_id_trans_2" value="' . $client_uniq_id2 . '">
                                <input type="hidden" id="srespOG_name" name="srespOG_name" value ="' . $user_name . '">';
                            ?>
                            <div class="container-row2">
                                <label for="comment_2">Comments</label>
                                <textarea id="comment_2" name="comment_2" minlength="10" style="min-height:100px;resize: none;" placeholder='Drop some comments...'></textarea>
                            </div>
                            <div id="saveChangeBtn">
                                <button type="submit" id="submit_2resp_input" name="submit_2resp_input">
                                    SUBMIT
                                </button>
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
    <!--<div class="container-row">
        <div class="container-col50">
            <label for="uploadFile-2ndresp">Upload File</label>
            <div class="uploadFile-2ndresp" id="uploadFile_2ndresp">
                <input type="file" class="custom-file-input" id="userPic" name="userPic" onchange="displayFileName()">                                   
                <label class=" custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <div class="container-col50">
            <label for="Client_loc">Location</label>
            <select id="Client_loc" name="Client_loc" class="form-control">
                <option value="" selected>Choose location</option>
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
    </div>-->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--JQuery CDN-->
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../script/uniq_id_trans_2.js" type="text/javascript"></script>
    <!--script for data table-->
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script>
        // let table = new DataTable('#secresp_show_data');
    </script>
    <script src="../script/workable.js" type="text/javascript"></script>
    <!-- <script src="../script/row_colResizing.js" type="text/javascript"></script> -->
    <script src="../script/activity_stat.js" type="text/javascript"></script>
</body>

</html>