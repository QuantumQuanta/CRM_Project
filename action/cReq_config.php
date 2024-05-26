 <?php
function cReqDataRetri($clientID)
{
    require '../constant/db_connect.php';

    $ret_sql = "SELECT * FROM `c_req` WHERE `cl_id`=?";
    $ret_stmt = mysqli_prepare($conn, $ret_sql);

    if (!$ret_stmt) {
        die('Error in preparing statement: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($ret_stmt, 'i', $clientID);

    $data = [];
    $i = 0;

    try {
        if (mysqli_stmt_execute($ret_stmt)) {
            $ret_res = mysqli_stmt_get_result($ret_stmt);

            if (!$ret_res) {
                throw new Exception('Error in getting result: ' . mysqli_error($conn));
            }

            while ($ret_row = mysqli_fetch_assoc($ret_res)) {
                $data[$i] = $ret_row['date_time'] . "|" . $ret_row['cl_name_wsc'] . "|" . $ret_row['prop_priority'] . "|" . $ret_row['prop_sharedon'] . "|" . $ret_row['prop_details'] . "|" . $ret_row['prop_site'] . "|" . $ret_row['prop_state'] . "|" . $ret_row['quote'] . "|" . $ret_row['currency'] . "|" . $ret_row['remarks_self'] . "|" . $ret_row['fsa_details'] . "|" . $ret_row['verified'] . "|" . $ret_row['verified_by'] . "|" . $ret_row['fur_asg_to'] . "|" . $ret_row['remarks_ceo'] . "|" . $ret_row['cl_id'];
                $i++;
            }
        } else {
            throw new Exception('Error in executing statement: ' . mysqli_error($conn));
        }
    } catch (Exception $e) {

        echo 'Error: ' . $e->getMessage();
    } finally {
        mysqli_stmt_close($ret_stmt);
    }

    echo json_encode($data);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../constant/db_connect.php';
    //for new 
    if ((isset($_POST['keyData'])) && ($_POST['keyData'] == 'SubBtn')) {
        $priority = $_POST["creq_priority"];
        $proposalSharedOn = $_POST["creq_proposalSharedOn"];
        $proposalDetails = $_POST["creq_proposalDetails"];
        $proposalSite = $_POST["creq_proposalSite"];
        $proposalState = $_POST["creq_proposalState"];
        $fsaDetails = $_POST["creq_fsaDetails"];
        $ownRemarks = $_POST["creq_ownRemarks"];
        $quote = $_POST["creq_quote"];
        $currency = $_POST["creq_currency"];
        $throughName = $_POST["creq_throughName"];
        $client = explode(":", $_POST["creq_client"]);
        $clientID = trim($client[0]);
        $clientName = trim($client[1]);
        $nullValue = NULL;
        // $furtherAssignedTo = $_POST["creq_furtherAssignedTo"];
        date_default_timezone_set('Asia/Kolkata');
        $dateTime = date("Y-m-d H:i:s");
        // echo json_encode("clientID:".$clientID."|clientName:".$clientName);
        if ($clientID != '' && $dateTime != '' && $clientName != '') {
            // echo json_encode($priority . "|" . $proposalSharedOn . "|" . $proposalDetails . "|" . $proposalSite . "|" . $proposalState . "|" . $quote . "|" . $currency . "|" . $furtherAssignedTo . "|" . $fsaDetails);
            $creq_sql = "INSERT INTO `c_req`(`cl_id`, `date_time`, `cl_name_wsc`, `prop_priority`, `prop_sharedon`, `prop_details`, `prop_site`, `prop_state`, `quote`, `currency`, `remarks_self`, `fsa_details`, `verified`, `verified_by`, `fur_asg_to`, `remarks_ceo`,`through_name`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $creq_stmt = mysqli_prepare($conn, $creq_sql);
            mysqli_stmt_bind_param($creq_stmt, 'isssssssdssssssss', $clientID, $dateTime, $clientName, $priority, $proposalSharedOn, $proposalDetails, $proposalSite, $proposalState, $quote, $currency, $ownRemarks, $fsaDetails, $nullValue, $nullValue, $nullValue, $nullValue,$throughName);
            // echo json_encode("clientID:".$clientID."|clientName:".$clientName);
            if (mysqli_stmt_execute($creq_stmt)) {
                cReqDataRetri($clientID);
            } else {
                echo json_encode("Unexpected Error in Insertion!");
            }
        }
    }
    //for DocLoaded
    if ((isset($_POST['keyData'])) && ($_POST['keyData'] == 'DocLoad')) {
        $clientID = $_POST["creq_client"];
        cReqDataRetri($clientID);
    }
    //for edit 
    if ((isset($_POST['keyData'])) && ($_POST['keyData'] == 'EditBtn')) {
        $preDate = $_POST["creEdit_preDate"];
        $priority = $_POST["creqEdit_priority"];
        $proposalSharedOn = $_POST["creqEdit_proposalSharedOn"];
        $proposalDetails = $_POST["creqEdit_proposalDetails"];
        $proposalSite = $_POST["creqEdit_proposalSite"];
        $proposalState = $_POST["creqEdit_proposalState"];
        $fsaDetails = $_POST["creqEdit_fsaDetails"];
        $ownRemarks = $_POST["creqEdit_ownRemarks"];
        $quote = $_POST["creqEdit_quote"];
        $currency = $_POST["creqEdit_currency"];
        $client = explode(":", $_POST["creqEdit_client"]);
        $throughName = $_POST["creqEdit_throughName"];
        $clientID = trim($client[0]);
        $clientName = trim($client[1]);
        $nullValue = NULL;
        date_default_timezone_set('Asia/Kolkata');
        $dateTime = date("Y-m-d H:i:s");
        // echo json_encode($preDate . "|" . $priority . "|" . $proposalSharedOn . "|" . $proposalDetails . "|" . $proposalSite . "|" . $proposalState . "|" . $quote . "|" . $currency . "|" . $fsaDetails);
        if ($clientID != '' && $dateTime != '' && $clientName != '') {
            $creqedit_sql = " UPDATE `c_req` SET `cl_id`=?,`date_time`=?,`cl_name_wsc`=?,`prop_priority`=?,`prop_sharedon`=?,`prop_details`=?,`prop_site`=?,`prop_state`=?,`quote`=?,`currency`=?,`remarks_self`=?,`fsa_details`=?,`verified`=?,`verified_by`=?,`fur_asg_to`=?,`remarks_ceo`=?,`through_name`=? WHERE `cl_id` =? AND `date_time`=?";
            $creqedit_stmt = mysqli_prepare($conn, $creqedit_sql);
            mysqli_stmt_bind_param($creqedit_stmt, 'isssssssdssssssssis', $clientID, $dateTime, $clientName, $priority, $proposalSharedOn, $proposalDetails, $proposalSite, $proposalState, $quote, $currency, $ownRemarks, $fsaDetails, $nullValue, $nullValue, $nullValue, $nullValue, $throughName, $clientID, $preDate);
            if (mysqli_stmt_execute($creqedit_stmt)) {
                cReqDataRetri($clientID);
            } else {
                echo json_encode("Unexpected Error in Insertion!");
            }
        }
    }
}
