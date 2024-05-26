<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'PRO' || $_SESSION['desg_code'] == '2NDRESP') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
} else {
    header("location: ../action/index.php");
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ((isset($_POST['token1'])) && ($_POST['token1'] == 'insertPRO')) {
        // echo json_encode($_POST['contact_stat'], $_POST['kyc_stat'], $_POST['call_stat'], $_POST['call_type'], $_POST['category'], $_POST['source'], $_POST['pcr_priority_1'], $_POST['pcr_et_1'], $_POST['client_stat_1'], $_POST['pcr_resp_1'], $_POST['pcr_pt_1'], $_POST['client_rating_1'], $_POST['date_time_1'], $_POST['pro_name'], intval($_POST['client_uniq_id_trans']), $_POST['comment_1']);
        pro_input($_POST['contact_stat'], $_POST['kyc_stat'], $_POST['call_stat'], $_POST['call_type'], $_POST['category'], $_POST['source'], $_POST['pcr_priority_1'], $_POST['pcr_et_1'], $_POST['client_stat_1'], $_POST['pcr_resp_1'], $_POST['pcr_pt_1'], $_POST['client_rating_1'], $_POST['date_time_1'], $_POST['pro_name'], intval($_POST['client_uniq_id_trans']), $_POST['comment_1']);
    } elseif ((isset($_POST['token2'])) && ($_POST['token2'] == 'insertRESP')) {
        secresp_input($_POST['client_stat_2'], $_POST['pcr_resp_2'], $_POST['pcr_pt_2'], $_POST['pcr_prc'], $_POST['client_rating_2'], $_POST['date_time_2'], $_POST['secresp_name'], intval($_POST['client_uniq_id_trans_2']), $_POST['comment_2']);
        // echo json_encode("From 2ndResp");
    } else {
        echo json_encode('Bad Request!');
    }
}

function processString(&$inputVariable)
{
    // Check if the variable is a string
    if (is_string($inputVariable)) {
        // Check if the string contains the word "Choose"
        if (strpos($inputVariable, 'Choose') !== false) {
            // If true, set the variable to NULL
            $inputVariable = "";
        }
    }
    // Return the processed variable
    return $inputVariable;
}
//Table new data 
function fetchWorkData($client_uniq_id)
{
    require '../constant/db_connect.php';
    $client_uniq_id = intval($client_uniq_id);
    $sql_mixed_output = "SELECT * FROM `mixed_input_proresp` WHERE uniq_id=? ORDER BY dt DESC";
    $stmt_mixed_output = mysqli_prepare($conn, $sql_mixed_output);
    mysqli_stmt_bind_param($stmt_mixed_output, "i", $client_uniq_id);
    mysqli_stmt_execute($stmt_mixed_output);
    $res_mixed_output = mysqli_stmt_get_result($stmt_mixed_output);
    $data = [];
    $response = [];
    // echo json_encode($mixed_rowNum);
    if ($res_mixed_output != false) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($res_mixed_output)) {
            $data['dt'] = date('g:i A d.m.y', strtotime($row['dt']));
            $data['contacted_us'] = $row['contacted_us'];
            $data['kyc_stat'] = $row['kyc_stat'];
            $data['pcr_priority'] = $row['pcr_priority'];
            $data['pcr_et'] = $row['pcr_et'];
            $data['call_type'] = $row['call_type'];
            $data['call_stat'] = $row['call_stat'];
            $data['category'] = $row['category'];
            $data['source'] = $row['source'];
            $data['comment_1'] = $row['comment_1'];
            $data['client_stat_1'] = $row['client_stat_1'];
            $data['pcr_resp_1'] = $row['pcr_resp_1'];
            $data['pcr_pt_1'] = $row['pcr_pt_1'];
            $data['client_rating_1'] = $row['client_rating_1'];
            $data['comment_2'] = $row['comment_2'];
            $data['client_stat_2'] = $row['client_stat_2'];
            $data['pcr_resp_2'] = $row['pcr_resp_2'];
            $data['pcr_pt_2'] = $row['pcr_pt_2'];
            $data['pcr_prc'] = $row['pcr_prc'];
            $data['client_rating_2'] = $row['client_rating_2'];
            $response[$i] = $data;
            $i++;
        }
        echo json_encode($response);
    } else {
        echo json_encode(["error" => mysqli_error($conn)]);
    }
}


function pro_input($contact_stat, $kyc_stat, $call_stat, $call_type, $category, $source, $pcr_priority_1, $pcr_et_1, $client_stat_1, $pcr_resp_1, $pcr_pt_1, $client_rating_1, $date_time_1, $pro_name, $client_uniq_id_trans, $comment_1)
{
    require '../constant/db_connect.php';
    $remin_dT = $_POST['remin_d&T'];
    $reminder_cmnt = $_POST['reminder_cmnt'];
    $reminder_color = $_POST['reminder_color'];
    $proOGName = $_POST['proOG_name'];

    $dateAndTime = explode("T", $remin_dT);

    $date = $dateAndTime[0]; // Date
    $time = substr($dateAndTime[1], 0, 5);  

    if ($date_time_1 != '' && $pro_name != '' && $client_uniq_id_trans != '' && $comment_1 != '') {

        // Prepare the SQL statement
        $sql_pro_input = "INSERT INTO `mixed_input_proresp` (`uniq_id`, `dt`, `pro_name`, `contacted_us`, `kyc_stat`, `pcr_priority`, `pcr_et`, `call_type`, `call_stat`, `category`, `source`, `comment_1`, `client_stat_1`, `pcr_resp_1`, `pcr_pt_1`, `client_rating_1`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Initialize the prepared statement
        $stmt_pro_input = mysqli_prepare($conn, $sql_pro_input);

        // Bind parameters
        mysqli_stmt_bind_param($stmt_pro_input, "isssssssssssssss", $client_uniq_id_trans, $date_time_1, $pro_name, $contact_stat, $kyc_stat, $pcr_priority_1, $pcr_et_1, $call_type, $call_stat, $category, $source, $comment_1, $client_stat_1, $pcr_resp_1, $pcr_pt_1, $client_rating_1);
        // Execute as well as Check the result:
        if (mysqli_stmt_execute($stmt_pro_input)) {
            fetchWorkData($client_uniq_id_trans);
        } else {
            echo json_encode('Unsuccess'. mysqli_error($conn));
        }

        // Close the statement
        mysqli_stmt_close($stmt_pro_input);
    } else {
        echo json_encode('Unexpected Error!');
    }
}

function secresp_input($client_stat_2, $pcr_resp_2, $pcr_pt_2, $pcr_prc, $client_rating_2, $date_time_2, $secresp_name, $client_uniq_id_trans_2, $comment_2)
{
    
    require '../constant/db_connect.php';
    $nullValue = NULL;

    if ($date_time_2 != '' && $secresp_name != '' && $client_uniq_id_trans_2 != '' && $comment_2 != '') {
        // echo 'all in';
        $sql_secresp_input = "INSERT INTO `mixed_input_proresp`(`uniq_id`, `dt`, `pro_name`, `contacted_us`, `kyc_stat`, `pcr_priority`, `pcr_et`, `call_type`, `call_stat`, `category`, `source`, `comment_1`, `client_stat_1`, `pcr_resp_1`, `pcr_pt_1`, `client_rating_1`, `sec_resp_name`, `comment_2`, `client_stat_2`, `pcr_resp_2`, `pcr_pt_2`, `pcr_prc`, `client_rating_2`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt_secresp_input = mysqli_prepare($conn, $sql_secresp_input);
        mysqli_stmt_bind_param($stmt_secresp_input, "issssssssssssssssssssss", $client_uniq_id_trans_2, $date_time_2, $nullValue, $nullValue, $nullValue, $nullValue, $nullValue, $nullValue, $nullValue, $nullValue, $nullValue, $nullValue, $nullValue, $nullValue, $nullValue, $nullValue, $secresp_name, $comment_2, $client_stat_2, $pcr_resp_2, $pcr_pt_2, $pcr_prc, $client_rating_2);
        if (mysqli_stmt_execute($stmt_secresp_input)) {
            // echo json_encode("Success!");
            fetchWorkData($client_uniq_id_trans_2);
        } else {
            echo json_encode('Unsuccess'. mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_secresp_input);
    } else {
        echo json_encode('Unexpected Error!');
    }
}

?>

