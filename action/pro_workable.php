<?php
// require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'PRO' || $_SESSION['desg_code'] == 'CRTR') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
    $client_uniq_id = $_SESSION['client_uniq_id'];
    $client_Name = $_SESSION['client_name'];
    $client_state = $_SESSION['client_state'];
    $client_city = $_SESSION['client_city'];
    $client_Code = $_SESSION['client_Code'];
    $userDsg = $_SESSION['desg_code'];
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
    <!--Data Table CSS-->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../stylesheet/pro_workable.css">
    <!--CSS for datatables-->
    <title>pro_workable</title>
</head>

<body>
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
                        <a href="../action/crm.php" type="button" class="btn btn-sm btn-success" style="vertical-align:middle" id="backBtn"><span>Back</span></a>
                    </div>
                    <div class="client_col2">
                            <?php echo '<h3>' . $client_Code . " " . $client_Name . " " . $client_state . " " . $client_city . '</h3>' ?>
                    </div>
                    <div class="visitor-log">
                        <div class="vis-sub_div">
                            <label for="proposeDateVis">EST- Visit Date:</label>
                            <input type="date" name="proposeDateVis" id="proposeDateVis">
                        </div>
                        <div class="vis-sub_div">
                            <label for="actualDateVis">ACT- Visit Date:</label>
                            <input type="date" name="actualDateVis" id="actualDateVis">
                        </div>
                        <button class="okBtn-vislog" id="okBtn-visitor-log">OK</button>
                        
                        <div class="vis-sub_div">
                            <label for="">Finalize</label>
                            <div class="checkbox-wrapper-31">
                                <input type="checkbox" id="visVerifyCheck"/>
                                <svg viewBox="0 0 35.6 35.6">
                                    <circle class="background" cx="17.8" cy="17.8" r="17.8"></circle>
                                    <circle class="stroke" cx="17.8" cy="17.8" r="14.37"></circle>
                                    <polyline class="check" points="11.78 18.12 15.55 22.23 25.17 12.87"></polyline>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="data-content">
                    <div class="table-content">
                        <div class="container " style="overflow-x:auto;">
                            <!-- <table id="pro_show_data" class="resizable-table"> -->
                            <table id="pro_show_data" class="table resizable-table">
                                <thead>
                                    <tr class="table">
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
                        <div id="form-heading">
                            <p>Please fill up and submit the Data(only once)</p>
                        </div>
                        <div class="formDiv">
                            <input type="hidden" id="proDesg" name="proDesg" value="<?php echo $userDsg; ?>">
                            <div class="container-row">
                                <div class="container-col50">
                                    <label for="contact_stat">Contacted Us</label>
                                    <select id="contact_stat" name="contact_stat">
                                        <option value="" selected>Choose...
                                        </option>
                                        <option value="YES">Yes
                                        </option>
                                        <option value="NO">No
                                        </option>
                                    </select>
                                </div>
                                <div class="container-col50">
                                    <label for="kyc_stat">KYC Status</label>
                                    <select id="kyc_stat" name="kyc_stat">
                                        <option value="" selected>Choose...
                                        </option>
                                        <option value="YES">Yes
                                        </option>
                                        <option value="NO">No
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="container-row">
                                <div class="container-col50">
                                    <label for="call_stat">Call Status</label>
                                    <select id="call_stat" name="call_stat">
                                        <option value="" selected>Choose...
                                        </option>
                                        <option value="ANS">ANS
                                        </option>
                                        <option value="DNC">DNC
                                        </option>
                                        <option value="FU">FU
                                        </option>
                                        <option value="NA">NA
                                        </option>
                                    </select>
                                </div>
                                <div class="container-col50">
                                    <label for="call_type">Call Type</label>
                                    <select id="call_type" name="call_type">
                                        <option value="" selected>Choose...
                                        </option>
                                        <option value="Fresh Call">Fresh Call
                                        </option>
                                        <option value="Follow Up call">Follow Up call
                                        </option>
                                        <option value="New Live call">New Live call
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="container-row">
                                <div class="container-col50">
                                    <label for="category">Category</label>
                                    <select id="category" name="category">
                                        <option value="" selected>Choose...
                                        </option>
                                        <option value="M">M
                                        </option>
                                        <option value="MA">MA
                                        </option>
                                        <option value="UR">UR
                                        </option>
                                        <option value="ESC">ESC
                                        </option>
                                    </select>
                                </div>
                                <div class="container-col50">
                                    <label for="source">Source</label>
                                    <select id="source" name="source">
                                        <option value="" selected>Choose...
                                        </option>
                                        <option value="O/I">O/I
                                        </option>
                                        <option value="C/M">C/M
                                        </option>
                                        <option value="WEB">WEB
                                        </option>
                                        <option value="UN">UN
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="container-row">
                                <div class="container-col50">
                                    <label for="pcr_priority_1">PCR Priority</label>
                                    <select id="pcr_priority_1" name="pcr_priority_1">
                                        <option value="" selected>Choose...
                                        </option>
                                        <option value="H">H
                                        </option>
                                        <option value="M">M
                                        </option>
                                        <option value="A">A
                                        </option>
                                    </select>
                                </div>
                                <div class="container-col50">
                                    <label for="pcr_et_1">PCR E.T.</label>
                                    <select id="pcr_et_1" name="pcr_et_1">
                                        <option value="" selected>Choose...
                                        </option>
                                        <option value="H">H
                                        </option>
                                        <option value="M">M
                                        </option>
                                        <option value="A">A
                                        </option>
                                        <option value="Critical">Critical
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="container-row2">
                                <label for="client_stat_1">Client Status</label>
                                <select id="client_stat_1" name="client_stat_1">
                                    <option value="" selected>Choose...
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
                                    <option value="In-touch">In-touch</option>
                                    <option value="Senior In-touch">Senior In-touch
                                    </option>
                                    <option value="Planning To Visit">Planning To Visit
                                    </option>
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
                                <div class="container-col30">
                                    <label for="pcr_resp_1">PCR Resp.</label>
                                    <input type="text" placeholder="Enter within 1-100" id="pcr_resp_1" name="pcr_resp_1">
                                </div>
                                <div class="container-col30">
                                    <label for="pcr_pt_1">PCR P.T.</label>
                                    <input type="text" placeholder="Enter within 1-100" id="pcr_pt_1" name="pcr_pt_1">
                                </div>
                                <div class="container-col30">
                                    <label for="client_rating_1">Client Rating</label>
                                    <select id="client_rating_1" name="client_rating_1">
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
                            $date = date("Y-m-d H:i:s"); //dS F Y, g:i A
                            // print_r($date);
                            echo '
                                        <input type="hidden" id="date_time_1" name="date_time_1" value="' . $date . '">
                                        <input type="hidden" id="pro_name" name="pro_name" value="' . $user_id . '">
                                        <input type="hidden" name="client_uniq_id_trans" id="client_uniq_id_trans" value="' . $client_uniq_id . '">
                                        <input type="hidden" id="proOG_name" name="proOG_name" value ="' . $user_name . '">';
                            ?>
                            <div class="container-row2">
                                <label for="comment_1">Comments</label>
                                <textarea type='text' id="comment_1" name="comment_1" minlength="10" style="min-height:30px;resize: none;" placeholder='Drop some comments...'></textarea>
                            </div>
                            <!--<div class="container-row">
                                    <div class="container-col50">
                                        <label for="uploadFile-2ndresp">Upload File</label>
                                        <input type="file">
                                    </div>
                                    <div class="container-col50">
                                        <label for="Client_loc">Location</label>
                                        <select id="Client_loc" name="Client_loc" class="form-control">
                                            <option value="" selected>Choose loaction</option>
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
                                <div class="container-row">
                                    <div class="container-col50">
                                        <label for="reminder_d&T">Reminder Date&Time</label>
                                        <input type="datetime-local" id="remin_d&T" name="remin_d&T">
                                         <input type="date" class="form-control datepicker"  name='remin_d&T' placeholder="dd-mm-yyyy" required> 
                                    </div>
                                    <div class="container-col50">
                                        <label for="reminder_color">Reminder type</label>
                                        <select id="reminder_color" name="reminder_color">
                                            <option selected disabled>Choose...</option>

                                             <option value="alert-success">Green</option> 
                                            <option value="alert-info">Normal</option>
                                            <option value="alert-danger">Emergency</option>
                                        </select>
                                         <input type="date" class="form-control datepicker"  name='remin_d&T' placeholder="dd-mm-yyyy" required> 
                                    </div>
                                </div>
                                <div class="container-row2">
                                    <label for="reminder_cmt">Reminder comment</label>
                                    <textarea style="min-height:30px;resize: none;"  id="reminder_cmnt" name="reminder_cmnt" maxlength="250" placeholder='Drop Reminder comments...'></textarea>
                                </div>-->
                            <div id="saveChangeBtn">
                                <button type="submit" id="submit_pro_input" name="submit_pro_input" class="btn btn-primary">
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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <!-- <script src="../script/JQuery_2.0.js" type="text/javascript"></script> -->
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--JQuery CDN-->
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../script/uniq_id_trans.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--script for data table-->
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script>
        // let table = new DataTable('#pro_show_data');
    </script>
    <script src="../script/workable.js" type="text/javascript"></script>
    <!-- <script src="../script/row_colResizing.js" type="text/javascript"></script> -->
    <script src="../script/activity_stat.js" type="text/javascript"></script>
    <script src="../script/visDate-script.js" type="text/javascript"></script>
    
</body>

</html>