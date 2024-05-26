<?php

use function PHPSTORM_META\map;

// session_start();

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
//   header("location: ../action/index.php");
// } else if ($_SESSION['desg_code'] == 'PRO' || $_SESSION['desg_code'] == 'CRTR') {
//   $user_id = $_SESSION['username'];
//   $user_name = $_SESSION['name'];
// } else {
//   header("location: ../action/index.php");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css">
  <link rel="stylesheet" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
  <!--<div class="table-responsive">
    <table id="client_data" class="table table-bordered table-striped">
      <thead>
        <th id="SlNo" scope="col">Sl No.</th>
        <th id="DOC" scope="col">DOC</th>
        <th id="DOA-1" scope="col">DOA-1</th>
        <th id="Period" scope="col">Period</th>
        <th id="Client-Details" scope="col">Client's Name with State & Code</th>
        <th id="Contact" scope="col">Contact No.</th>
        <th id="BCR" scope="col">BCR</th>
        <th id="Verified" scope="col">Verified</th>
        <th id="PCR" scope="col">PCR</th>
        <th id="1st_resp" scope="col">1st-resp</th>
        <th id="DOA_2" scope="col">DOA-2</th>
        <th id="Resp_2" scope="col">2nd-Resp</th>
        <th id="DOA_3" scope="col">DOA-3</th>
        <th id="Resp_3" scope="col">3rd-Resp</th>
        <th id="Remarks" scope="col">Remarks</th>
        <th id="Email" scope="col">Email</th>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>-->
  <!-- <form action="../action/test.php" method="post"> 
    <input type="email" name="test_input" id="test_input">
    <button type="submit" class="btn btn-primary btn-sm">ENCRYPT</button>
  </form> -->

  <?php

  /*
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../constant/encrypt_decrypt.php';
    $email = $_POST['test_input'];
    $enc_email = encryptData($email);
    $dec_email = decryptData($enc_email);
    echo '<p>' . $enc_email . '</p>';
    echo '<p>' . $dec_email . '</p>';
  }*/
  //if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //$id = $_POST['id'];
  // require '../constant/db_connect.php';
  //Data fetch from crm_master_table for CEO
  // $sql_ceo_data_fetch = "SELECT * FROM `crm_master_table`;";
  // $result_ceo_data_fetch = mysqli_query($conn, $sql_ceo_data_fetch);
  //echo ("SQL data");
  //print_r($sql_ceo_data_fetch);
  // $sl_no = 1;
  //echo ("Result of the query");
  //print_r($result_ceo_data_fetch);
  //echo ("Fetch-assoc data");
  //print_r($row_ceo_data_fetch = mysqli_fetch_assoc($result_ceo_data_fetch))
  /*$array_data;
    $i = 0;
    while ($row_ceo_data_fetch = mysqli_fetch_assoc($result_ceo_data_fetch)) {

      $data['uniq_id'] = $row_ceo_data_fetch['uniq_id'];
      $data['doc'] = $row_ceo_data_fetch['doc'];
      $data['client_name'] = $row_ceo_data_fetch['client_name'];
      $data['client_contact'] = $row_ceo_data_fetch['client_contact'];
      $data['client_email'] = $row_ceo_data_fetch['client_email'];
      $data['client_state'] = $row_ceo_data_fetch['client_state'];
      $data['code'] = $row_ceo_data_fetch['code'];
      $data['period'] = $row_ceo_data_fetch['period'];
      $data['doa_1'] = $row_ceo_data_fetch['doa_1'];
      $data['1st_resp'] = $row_ceo_data_fetch['1st_resp'];
      $data['doa_2'] = $row_ceo_data_fetch['doa_2'];
      $data['2nd_resp'] = $row_ceo_data_fetch['2nd_resp'];
      $data['bcr'] = $row_ceo_data_fetch['bcr'];
      $data['verified'] = $row_ceo_data_fetch['verified'];
      $data['pcr'] = $row_ceo_data_fetch['pcr'];
      $data['remarks'] = $row_ceo_data_fetch['remarks'];
      $json_data = json_encode($data);
      $array_data[$i] = $json_data;
      $i++;
    }
    echo ($array_data);
  //}*/
  ?>

  <!-- <form action="#" method="post">
    <label for="resp">1st Resp:</label>
    <input type="text" id="resp" name="resp">
    <label for="doc">DOC:</label>
    <input type="date" id="doc" name="doc">
    <label for="client_name">Client Name:</label>
    <input type="text" id="client_name" name="client_name">
    <button id="ok" name="ok">OK</button>
  </form> -->
<?php
require '../constant/db_connect.php';
$clientUNQId=1;
$sql_client_PCRPT = "WITH LatestEntryPT AS(SELECT `uniq_id`,`dt`,`pcr_pt_2`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `pcr_pt_2` IS NOT NULL) SELECT `pcr_pt_2`,`entry_seq`,`dt` FROM `LatestEntryPT` WHERE `pcr_pt_2` IS NOT NULL ORDER BY `entry_seq`";
$stmt = mysqli_prepare($conn, $sql_client_PCRPT);
mysqli_stmt_bind_param($stmt, "i", $clientUNQId);
mysqli_stmt_execute($stmt);
$res_client_PCRPT = mysqli_stmt_get_result($stmt);
while($row = mysqli_fetch_assoc($res_client_PCRPT)){
  echo $row['pcr_pt_2'];
  echo '<br>';
  echo $row['entry_seq'];
  echo '<br>';
  echo $row['dt'];
  echo '<br>';
}
?>
</body>
<form id="respRequestForm">
        <label class="CREQlbl" for="priority">Priority:</label>
        <select name="priority" id="prioritySel">
            <option value="Urgent">Urgent</option>
            <option value="Most Urgent">Most Urgent</option>
            <option value="Moderate">Moderate</option>
            <option value="Whenever you can">Whenever you can</option>
        </select><br><br>

        <label class="CREQlbl" for="proposalSharedOn">Proposal Shared On:</label>
        <input type="date" id="proposalSharedOn" name="proposalSharedOn"><br><br>

        <label class="CREQlbl"for="proposalDetails">Proposal Details:</label>
        <textarea id="proposalDetails" name="proposalDetails"></textarea><br><br>
        
        <label class="CREQlbl"for="proposalSite">Proposal Site:</label>
        <input type="text" id="proposalSite" name="proposalSite"><br><br>

        <label class="CREQlbl"for="proposalState">Proposal State:</label>
        <select name="proposalState" id="proposalState">
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
            <option value="OR">Orissa, Odisha</option>
            <option value="PB">Punjab</option>
            <option value="PY">Pondicherry, Puducherry</option>
            <option value="RJ">Rajasthan</option>
            <option value="SK">Sikkim</option>
            <option value="TG">Telangana</option>
            <option value="TN">Tamil Nadu</option>
            <option value="TR">Tripura</option>
            <option value="UK">Uttarakhand</option>
            <option value="UP">Uttar Pradesh</option>
            <option value="WB">West Bengal</option>
            <option value="NP">Nepal</option>
        </select><br><br>

        <label class="CREQlbl"for="quote">Quote:</label>
        <input type="number" id="quote" name="quote">
        <select name="currency" id="currency">
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
        </select><br><br>

        <label class="CREQlbl">Verified:</label><br>
        <input type="radio" id="verifiedYes" name="verified" value="Yes">
        <label class="CREQlbl" for="verifiedYes">Yes</label>
        <input type="radio" id="verifiedNo" name="verified" value="No">
        <label for="verifiedNo">No</label><br><br>

        <label class="CREQlbl" for="verifiedBy">Verified By:</label>
        <input type="text" id="verifiedBy" name="verifiedBy"><br><br>

        <label class="CREQlbl" for="furtherAssignedTo">Further Assigned To:</label>
        <input type="text" id="furtherAssignedTo" name="furtherAssignedTo"><br><br>

        <label class="CREQlbl" for="fsaDetails">F.S.A Details:</label>
        <textarea id="fsaDetails" name="fsaDetails"></textarea><br><br>

        <input id="subBtnCREQ" type="submit" value="Submit">
    </form>
<!-- <script src="../script/JQuery_2.0.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>
<script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
<script src="../script/test.js" type="text/javascript"></script> -->

</html>