<?php
function clientNamePull($id)
{
    require '../constant/db_connect.php';
    // require '../constant/encrypt_decrypt.php';

    $clDetStr = "";

    try {

        if (!$conn) {
            throw new Exception("Database connection failed: " . mysqli_connect_error());
        }


        $cl_sql = "SELECT `client_name`,`client_contact`,`client_state`,`code` FROM `crm_master_table` WHERE `uniq_id`=?";
        $cl_stmt = mysqli_prepare($conn, $cl_sql);


        if (!$cl_stmt) {
            throw new Exception("Error in preparing SQL statement: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($cl_stmt, "i", $id);
        mysqli_stmt_execute($cl_stmt);


        $cl_res = mysqli_stmt_get_result($cl_stmt);


        while ($cl_row = mysqli_fetch_assoc($cl_res)) {
            // $encID = encryptData($id);
            $clDetStr = $cl_row['client_name'] . "+" . $cl_row['client_contact'] . "+" . $cl_row['client_state'] . "+" . $cl_row['code'] . "+" . $id;
        }


        mysqli_stmt_close($cl_stmt);
    } catch (Exception $e) {

        $clDetStr = "Error: " . $e->getMessage();
    } finally {

        if ($conn) {
            mysqli_close($conn);
        }
    }

    return $clDetStr;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require '../constant/db_connect.php';

    try {
        if (isset($_POST['docLoad']) && ($_POST['docLoad'] == 'yes')) {
            if (!empty($_POST['userDet'])) {
                $userDet = explode("|", $_POST['userDet']);
                $userName = $userDet[0];
                $userDesg = $userDet[1];

                global $sql;

                if ($userDesg == "2NDRESP") {
                    $sql = "SELECT `id`, `name`, `user`, `desg_code` FROM `login_data` WHERE `desg_code`='PRO'";
                } elseif ($userDesg == "PRO") {
                    $sql = "SELECT `id`, `name`, `user`, `desg_code` FROM `login_data` WHERE `desg_code`='2NDRESP'";
                } else {
                    throw new Exception("Error! Invalid user designation.");
                }

                $res = mysqli_query($conn, $sql);

                if (!$res) {
                    throw new Exception("Error executing SQL query: " . mysqli_error($conn));
                }

                $dataArray = [];
                while ($row = mysqli_fetch_assoc($res)) {
                    $dataArray[$row['user']] = $row['id'] . "|" . $row['name'] . "|" . $row['desg_code'];
                }

                echo json_encode($dataArray);
            } else {
                throw new Exception("Error! User Details parameter is empty.");
            }
        } elseif (isset($_POST['flag']) && ($_POST['flag'] == 'up')) {
            if (empty($_POST['emp_details']) || empty($_POST['fdate']) || empty($_POST['ldate']) || empty($_POST['user_details'])) {
                echo json_encode("Invalid input! Please try again or contact with the admin");
            } else {
                try {

                    if (!isset($_POST['fdate']) || !isset($_POST['ldate']) || !isset($_POST['emp_details']) || !isset($_POST['user_details'])) {
                        throw new Exception("Missing POST parameters.");
                    }

                    $fdate = new DateTime($_POST['fdate']);
                    $ldate = new DateTime($_POST['ldate']);
                    $param = "|";
                    $startDt = $fdate->format('Y-m-d H:i:s');
                    $endDt = $ldate->format('Y-m-d H:i:s');

                    if (!$startDt || !$endDt) {
                        throw new Exception("Error converting date.");
                    }

                    $emp_details = explode($param, $_POST['emp_details']);
                    $user_details = explode($param, $_POST['user_details']);


                    if (!isset($emp_details[0]) || !isset($user_details[0]) || !isset($emp_details[1]) || !isset($user_details[1])) {
                        throw new Exception("Error parsing employee and user details.");
                    }

                    $emp_name = $emp_details[0];
                    $user_name = $user_details[0];
                    $emp_dsg = $emp_details[1];
                    $user_dsg = $user_details[1];

                    global $unqID_arr;
                    $i = 0;


                    global $clientSQL, $clientSTMT;
                    if ($emp_dsg == "PRO" && $user_dsg == "2NDRESP") {
                        $clientSQL = "SELECT `uniq_id` FROM `crm_master_table` WHERE `1st_resp`=? AND `2nd_resp`=?";
                        $clientSTMT = mysqli_prepare($conn, $clientSQL);
                        if (!$clientSTMT) {
                            throw new Exception("Error preparing SQL statement for client: " . mysqli_error($conn));
                        }
                        mysqli_stmt_bind_param($clientSTMT, "ss", $emp_name, $user_name);
                    } elseif ($emp_dsg == "2NDRESP" && $user_dsg == "PRO") {
                        $clientSQL = "SELECT `uniq_id` FROM `crm_master_table` WHERE `1st_resp`=? AND `2nd_resp`=?";
                        $clientSTMT = mysqli_prepare($conn, $clientSQL);
                        if (!$clientSTMT) {
                            throw new Exception("Error preparing SQL statement for client: " . mysqli_error($conn));
                        }
                        mysqli_stmt_bind_param($clientSTMT, "ss", $user_name, $emp_name);
                    } elseif ($emp_dsg == "all" && $user_dsg == "2NDRESP") {
                        $clientSQL = "SELECT `uniq_id` FROM `crm_master_table` WHERE `2nd_resp`=?";
                        $clientSTMT = mysqli_prepare($conn, $clientSQL);
                        if (!$clientSTMT) {
                            throw new Exception("Error preparing SQL statement for client: " . mysqli_error($conn));
                        }
                        mysqli_stmt_bind_param($clientSTMT, "s", $user_name);
                    } elseif ($emp_dsg == "all" && $user_dsg == "PRO") {
                        $clientSQL = "SELECT `uniq_id` FROM `crm_master_table` WHERE `1st_resp`=? ";
                        $clientSTMT = mysqli_prepare($conn, $clientSQL);
                        if (!$clientSTMT) {
                            throw new Exception("Error preparing SQL statement for client: " . mysqli_error($conn));
                        }
                        mysqli_stmt_bind_param($clientSTMT, "s", $user_name);
                    } else {
                        throw new Exception("Unexpected Error occurred");
                    }


                    mysqli_stmt_execute($clientSTMT);
                    $clientRES = mysqli_stmt_get_result($clientSTMT);

                    if (!$clientRES) {
                        throw new Exception("Error getting result set for client: " . mysqli_error($conn));
                    }

                    while ($clientROW = mysqli_fetch_assoc($clientRES)) {
                        $unqID_arr[$i] = $clientROW['uniq_id'];
                        $i++;
                    }

                    if (empty($unqID_arr)) {
                        throw new Exception("No data found for the provided criteria.");
                    }

                    $unqID_str = implode(",", $unqID_arr);

                    $dataSQL = "SELECT * FROM `mixed_input_proresp` WHERE `dt` BETWEEN ? AND ? AND `uniq_id` IN ($unqID_str) ORDER BY `dt` DESC";
                    $dataSTMT = mysqli_prepare($conn, $dataSQL);


                    if (!$dataSTMT) {
                        throw new Exception("Error preparing SQL statement for data: " . mysqli_error($conn));
                    }

                    mysqli_stmt_bind_param($dataSTMT, "ss", $startDt, $endDt);
                    mysqli_stmt_execute($dataSTMT);
                    $dataRES = mysqli_stmt_get_result($dataSTMT);

                    if (!$dataRES) {
                        throw new Exception("Error getting result set for data: " . mysqli_error($conn));
                    }

                    $data = [];
                    $j = 0;

                    while ($dataROW = mysqli_fetch_assoc($dataRES)) {
                        $clDetails = clientNamePull($dataROW['uniq_id']);
                        $data[$j] = $dataROW['uniq_id'] . "|" . $dataROW['dt'] . "|" . $dataROW['pro_name'] . "|" . $dataROW['contacted_us'] . "|" . $dataROW['kyc_stat'] . "|" . $dataROW['pcr_priority'] . "|" . $dataROW['pcr_et'] . "|" . $dataROW['call_type'] . "|" . $dataROW['call_stat'] . "|" . $dataROW['category'] . "|" . $dataROW['source'] . "|" . $dataROW['comment_1'] . "|" . $dataROW['client_stat_1'] . "|" . $dataROW['pcr_resp_1'] . "|" . $dataROW['pcr_pt_1'] . "|" . $dataROW['client_rating_1'] . "|" . $dataROW['sec_resp_name'] . "|" . $dataROW['comment_2'] . "|" . $dataROW['client_stat_2'] . "|" . $dataROW['pcr_resp_2'] . "|" . $dataROW['pcr_pt_2'] . "|" . $dataROW['pcr_prc'] . "|" . $dataROW['client_rating_2'] . "|" . $clDetails;
                        $j++;
                    }

                    echo json_encode($data);
                } catch (Exception $e) {
                    echo json_encode("Error: " . $e->getMessage());
                } finally {
                    if (isset($clientSTMT)) {
                        mysqli_stmt_close($clientSTMT);
                    }
                    if (isset($dataSTMT)) {
                        mysqli_stmt_close($dataSTMT);
                    }
                    if (isset($conn)) {
                        mysqli_close($conn);
                    }
                }
            }
        } else {
            throw new Exception("Error! Parameter not set.");
        }
    } catch (Exception $e) {
        echo json_encode("Error: " . $e->getMessage());
    }
}
