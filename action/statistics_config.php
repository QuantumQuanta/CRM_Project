<?php

use function PHPSTORM_META\type;

function client_details_process($key, $value, $profile, $userName)
{
    // require_once(__DIR__ . '/../../constant/db_connect.php');
    require('../constant/db_connect.php');
    // $clientCount = 0;
    // echo $succ; --Debugging statement for db connection check
    if ($profile === "resp") {
        $sql_AllClients = "SELECT `uniq_id` FROM `crm_master_table` WHERE `2nd_resp`= '$userName'";
        $res_AllClients = mysqli_query($conn, $sql_AllClients);
        global $clientUNQId, $arr;
        if ($res_AllClients) {
            while ($row_AllClients = mysqli_fetch_assoc($res_AllClients)) {

                $clientUNQId = intval($row_AllClients['uniq_id']);
                // $type = gettype($clientUNQId);//--debugging statement
                // $clientCount++;

                //SQL Queries-> preparation-> binding params-> excution-> result-> process result

                //for pcr pt->
                $sql_client_PCRPT = "WITH LatestEntryPT AS(SELECT `uniq_id`,`dt`,`pcr_pt_2`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `pcr_pt_2` IS NOT NULL) SELECT `pcr_pt_2`,`entry_seq`,`dt` FROM `LatestEntryPT` WHERE `pcr_pt_2` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_client_PCRPT = mysqli_prepare($conn, $sql_client_PCRPT);
                mysqli_stmt_bind_param($stmt_client_PCRPT, "i", $clientUNQId);
                mysqli_stmt_execute($stmt_client_PCRPT);
                $res_client_PCRPT = mysqli_stmt_get_result($stmt_client_PCRPT);
                if ($res_client_PCRPT) {
                    while ($row_client_PCRPT = mysqli_fetch_assoc($res_client_PCRPT)) {
                        if (!empty($row_client_PCRPT)) {
                            if ($row_client_PCRPT['pcr_pt_2'] != ' ') {
                                $arr['pcr_pt_/' . $clientUNQId] = $row_client_PCRPT['pcr_pt_2'] . "|" . $row_client_PCRPT['dt'];
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }

                //for pcr resp->
                $sql_client_PCRRESP = "WITH LatestEntryRESP AS(SELECT `uniq_id`,`dt`,`pcr_resp_2`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `pcr_resp_2` IS NOT NULL) SELECT `pcr_resp_2`,`entry_seq`,`dt` FROM `LatestEntryRESP` WHERE `pcr_resp_2` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_client_PCRRESP = mysqli_prepare($conn, $sql_client_PCRRESP);
                mysqli_stmt_bind_param($stmt_client_PCRRESP, "i", $clientUNQId);
                mysqli_stmt_execute($stmt_client_PCRRESP);
                $res_client_PCRRESP = mysqli_stmt_get_result($stmt_client_PCRRESP);
                if ($res_client_PCRRESP) {
                    while ($row_client_PCRRESP = mysqli_fetch_assoc($res_client_PCRRESP)) {
                        if (!empty($row_client_PCRRESP)) {
                            if ($row_client_PCRRESP['pcr_resp_2'] != ' ') {
                                $arr['pcr_resp_/' . $clientUNQId] = $row_client_PCRRESP['pcr_resp_2'] . "|" . $row_client_PCRRESP['dt'];
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }

                //for pcr prc->
                $sql_client_PCRPRC = "WITH LatestEntryPRC AS(SELECT `uniq_id`,`dt`,`pcr_prc`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `pcr_prc` IS NOT NULL) SELECT `pcr_prc`,`entry_seq`,`dt` FROM `LatestEntryPRC` WHERE `pcr_prc` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_client_PCRPRC = mysqli_prepare($conn, $sql_client_PCRPRC);
                mysqli_stmt_bind_param($stmt_client_PCRPRC, "i", $clientUNQId);
                mysqli_stmt_execute($stmt_client_PCRPRC);
                $res_client_PCRPRC = mysqli_stmt_get_result($stmt_client_PCRPRC);
                if ($res_client_PCRPRC) {
                    while ($row_client_PCRPRC = mysqli_fetch_assoc($res_client_PCRPRC)) {
                        if (!empty($row_client_PCRPRC)) {
                            if ($row_client_PCRPRC['pcr_prc'] != ' ') {
                                $arr['pcr_prc_/' . $clientUNQId] = $row_client_PCRPRC['pcr_prc'] . "|" . $row_client_PCRPRC['dt'];
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }

                //for pcr client rating-> 
                $sql_client_PCRCR = "WITH LatestEntryCR AS(SELECT `uniq_id`,`dt`,`client_rating_2`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `client_rating_2` IS NOT NULL) SELECT `client_rating_2`,`entry_seq`,`dt` FROM `LatestEntryCR` WHERE `client_rating_2` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_client_PCRCR = mysqli_prepare($conn, $sql_client_PCRCR);
                mysqli_stmt_bind_param($stmt_client_PCRCR, "i", $clientUNQId);
                mysqli_stmt_execute($stmt_client_PCRCR);
                $res_client_PCRCR = mysqli_stmt_get_result($stmt_client_PCRCR);
                if ($res_client_PCRCR) {
                    while ($row_client_PCRCR = mysqli_fetch_assoc($res_client_PCRCR)) {
                        if (!empty($row_client_PCRCR)) {
                            if ($row_client_PCRCR['client_rating_2'] != ' ') {
                                $arr['pcr_client_rating_/' . $clientUNQId] = $row_client_PCRCR['client_rating_2'] . "|" . $row_client_PCRCR['dt'];
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }

                //for client status->
                $sql_client_CS = "WITH LatestEntryCS AS(SELECT `uniq_id`,`dt`,`client_stat_2`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ?  AND `client_stat_2` IS NOT NULL) SELECT `client_stat_2`,`entry_seq`,`dt` FROM `LatestEntryCS` WHERE `client_stat_2` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_client_CS = mysqli_prepare($conn, $sql_client_CS);
                mysqli_stmt_bind_param($stmt_client_CS, "i", $clientUNQId);
                mysqli_stmt_execute($stmt_client_CS);
                $res_client_CS = mysqli_stmt_get_result($stmt_client_CS);
                if ($res_client_CS) {
                    while ($row_client_CS = mysqli_fetch_assoc($res_client_CS)) {
                        if (!empty($row_client_CS)) {
                            if ($row_client_CS['client_stat_2'] != ' ') {
                                $arr['client_stat_/' . $clientUNQId] = $row_client_CS['client_stat_2'] . "|" . $row_client_CS['dt'];
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }
            }
            // echo json_encode($arr);
            global $result_arr, $response;
            foreach ($arr as $arr_key => $arr_value) {
                //exploding the key
                $param = "_/";
                $keyArr = explode($param, $arr_key);
                $clientkeyval = $keyArr[0];
                $clientidval = $keyArr[1];

                //exploding the value
                $param2 = "|";
                $valArr = explode($param2, $arr_value);
                $valValue = $valArr[0];
                $valDt = $valArr[1];

                // $result_arr[$clientidval] = $clientkeyval . "->" . $key; //Debigging statement
                if ($key === $clientkeyval) {
                    // $result_arr[$clientidval] = $clientidval."->".$clientkeyval."=".$arr_value;   //Debugging statement
                    switch ($clientkeyval) {
                        case "pcr_resp":

                            $str_value = explode(",", $value);
                            $from = $str_value[0];
                            $to = $str_value[1];
                            $numArr = range($from, $to);
                            if (in_array($valValue, $numArr)) {
                                $result_arr[$clientidval] = $valValue . "|" . $valDt;
                            }
                            break;

                        case "pcr_pt":

                            $str_value = explode(",", $value);
                            $from = $str_value[0];
                            $to;
                            if ($str_value[1] === '...') {
                                $to = 100;
                            } else {
                                $to = $str_value[1];
                            }
                            $numArr = range($from, $to);
                            if (in_array($valValue, $numArr)) {
                                $result_arr[$clientidval] = $valValue . "|" . $valDt;
                            }
                            break;

                        case "pcr_prc":

                            $str_value = explode(",", $value);
                            $from = $str_value[0];
                            $to;
                            if ($str_value[1] === '...') {
                                $to = 100;
                            } else {
                                $to = $str_value[1];
                            }
                            $numArr = range($from, $to);
                            if (in_array($valValue, $numArr)) {
                                $result_arr[$clientidval] = $valValue . "|" . $valDt;
                            }
                            break;

                        case "pcr_client_rating":

                            $upperCaseVal = strtoupper($valValue);
                            if ($value === $upperCaseVal) {
                                $result_arr[$clientidval] = $valValue . "|" . $valDt;
                            }
                            break;
                        case "client_stat":
                            if ($value === $valValue) {
                                $result_arr[$clientidval] = $valValue . "|" . $valDt;
                            }
                            break;

                        default:
                            $result_arr['default'] = "No data Here!";
                            break;
                    }
                }
            }
            // echo json_encode($result_arr);
            global $finalResponseArr;
            $count = 0;
            foreach ($result_arr as $result_arrKey => $result_arrVal) {
                $sqlforClient = "SELECT `client_name`,`client_contact`,`client_state`,`code` FROM `crm_master_table` WHERE `uniq_id`=?";
                $stmtforClient = mysqli_prepare($conn, $sqlforClient);
                mysqli_stmt_bind_param($stmtforClient, "i", $result_arrKey);
                mysqli_stmt_execute($stmtforClient);
                $resforClient = mysqli_stmt_get_result($stmtforClient);
                while ($rowforClient = mysqli_fetch_assoc($resforClient)) {
                    $finalResponseArr[$result_arrKey] = $result_arrVal . "|" . $rowforClient['code'] . " " . $rowforClient['client_name'] . " " . $rowforClient['client_state'] . "|" . $rowforClient['client_contact'];
                    $count++;
                }
            }
            $response['prfl'] = "2resp";
            $response['count'] = $count;
            $response['finalResp'] = $finalResponseArr;
            //Response for the ajax callback from 2nd Resp->
            echo json_encode($response);
        }
    } elseif ($profile === "pro") {
        $sql_AllClients = "SELECT `uniq_id` FROM `crm_master_table` WHERE `1st_resp`= '$userName'";
        $res_AllClients = mysqli_query($conn, $sql_AllClients);
        global $clientUNQId, $arr_pro;
        if ($res_AllClients) {
            while ($row_AllClients = mysqli_fetch_assoc($res_AllClients)) {

                $clientUNQId = intval($row_AllClients['uniq_id']);
                // $type = gettype($clientUNQId);//--debugging statement

                //SQL Queries-> preparation-> binding params-> excution-> result-> process result

                //for pcr pt->
                $sql_client_PCRPT = "WITH LatestEntryPT AS(SELECT `uniq_id`,`dt`,`pcr_pt_1`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `pcr_pt_1` IS NOT NULL) SELECT `pcr_pt_1`,`entry_seq`,`dt` FROM `LatestEntryPT` WHERE `pcr_pt_1` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_client_PCRPT = mysqli_prepare($conn, $sql_client_PCRPT);
                mysqli_stmt_bind_param($stmt_client_PCRPT, "i", $clientUNQId);
                mysqli_stmt_execute($stmt_client_PCRPT);
                $res_client_PCRPT = mysqli_stmt_get_result($stmt_client_PCRPT);
                if ($res_client_PCRPT) {
                    $i = 0;
                    while ($row_client_PCRPT = mysqli_fetch_assoc($res_client_PCRPT)) {
                        if (!empty($row_client_PCRPT)) {
                            if ($row_client_PCRPT['pcr_pt_1'] != ' ') {
                                $arr_pro['pcr_pt_/' . $clientUNQId] = $row_client_PCRPT['pcr_pt_1'] . "|" . $row_client_PCRPT['dt'];
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }

                //for pcr resp->
                $sql_client_PCRRESP = "WITH LatestEntryRESP AS(SELECT `uniq_id`,`dt`,`pcr_resp_1`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `pcr_resp_1` IS NOT NULL) SELECT `pcr_resp_1`,`entry_seq`,`dt` FROM `LatestEntryRESP` WHERE `pcr_resp_1` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_client_PCRRESP = mysqli_prepare($conn, $sql_client_PCRRESP);
                mysqli_stmt_bind_param($stmt_client_PCRRESP, "i", $clientUNQId);
                mysqli_stmt_execute($stmt_client_PCRRESP);
                $res_client_PCRRESP = mysqli_stmt_get_result($stmt_client_PCRRESP);
                if ($res_client_PCRRESP) {
                    while ($row_client_PCRRESP = mysqli_fetch_assoc($res_client_PCRRESP)) {
                        if (!empty($row_client_PCRRESP)) {
                            if ($row_client_PCRRESP['pcr_resp_1'] != ' ') {
                                $arr_pro['pcr_resp_/' . $clientUNQId] = $row_client_PCRRESP['pcr_resp_1'] . "|" . $row_client_PCRRESP['dt'];
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }

                //for pcr client rating-> 
                $sql_client_PCRCR = "WITH LatestEntryCR AS(SELECT `uniq_id`,`dt`,`client_rating_1`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `client_rating_1` IS NOT NULL) SELECT `client_rating_1`,`entry_seq`,`dt` FROM `LatestEntryCR` WHERE `client_rating_1` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_client_PCRCR = mysqli_prepare($conn, $sql_client_PCRCR);
                mysqli_stmt_bind_param($stmt_client_PCRCR, "i", $clientUNQId);
                mysqli_stmt_execute($stmt_client_PCRCR);
                $res_client_PCRCR = mysqli_stmt_get_result($stmt_client_PCRCR);
                if ($res_client_PCRCR) {
                    while ($row_client_PCRCR = mysqli_fetch_assoc($res_client_PCRCR)) {
                        if (!empty($row_client_PCRCR)) {
                            if ($row_client_PCRCR['client_rating_1'] != ' ') {
                                $arr_pro['pcr_client_rating_/' . $clientUNQId] = $row_client_PCRCR['client_rating_1'] . "|" . $row_client_PCRCR['dt'];
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }

                //for client status->
                $sql_client_CS = "WITH LatestEntryCS AS(SELECT `uniq_id`,`dt`,`client_stat_1`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ?  AND `client_stat_1` IS NOT NULL) SELECT `client_stat_1`,`entry_seq`,`dt` FROM `LatestEntryCS` WHERE `client_stat_1` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_client_CS = mysqli_prepare($conn, $sql_client_CS);
                mysqli_stmt_bind_param($stmt_client_CS, "i", $clientUNQId);
                mysqli_stmt_execute($stmt_client_CS);
                $res_client_CS = mysqli_stmt_get_result($stmt_client_CS);
                if ($res_client_CS) {
                    while ($row_client_CS = mysqli_fetch_assoc($res_client_CS)) {
                        if (!empty($row_client_CS)) {
                            if ($row_client_CS['client_stat_1'] != ' ') {
                                $arr_pro['client_stat_/' . $clientUNQId] = $row_client_CS['client_stat_1'] . "|" . $row_client_CS['dt'];
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }
            }
            // echo json_encode($arr_pro);
            // echo json_encode($cid);
            global $result_arr;
            foreach ($arr_pro as $arr_key => $arr_value) {
                //exploding the key
                $param = "_/";
                $keyArr = explode($param, $arr_key);
                $clientkeyval = $keyArr[0];
                $clientidval = $keyArr[1];

                //exploding the value
                $param2 = "|";
                $valArr = explode($param2, $arr_value);
                $valValue = $valArr[0];
                $valDt = $valArr[1];

                // $result_arr[$clientidval] = $clientkeyval . "->" . $key; //Debigging statement
                if ($key === $clientkeyval) {
                    // $result_arr[$clientidval] = $clientidval."->".$clientkeyval."=".$arr_value;   //Debugging statement
                    switch ($clientkeyval) {
                        case "pcr_resp":

                            $str_value = explode(",", $value);
                            $from = $str_value[0];
                            $to = $str_value[1];
                            $numArr = range($from, $to);
                            if (in_array($valValue, $numArr)) {
                                $result_arr[$clientidval] = $valValue . "|" . $valDt;
                            }
                            break;

                        case "pcr_pt":

                            $str_value = explode(",", $value);
                            $from = $str_value[0];
                            $to;
                            if ($str_value[1] === '...') {
                                $to = 100;
                            } else {
                                $to = $str_value[1];
                            }
                            $numArr = range($from, $to);
                            if (in_array($valValue, $numArr)) {
                                $result_arr[$clientidval] = $valValue . "|" . $valDt;
                            }
                            break;

                        case "pcr_client_rating":

                            $upperCaseVal = strtoupper($valValue);
                            if ($value === $upperCaseVal) {
                                $result_arr[$clientidval] = $valValue . "|" . $valDt;
                            }
                            break;
                        case "client_stat":
                            if ($value === $valValue) {
                                $result_arr[$clientidval] = $valValue . "|" . $valDt;
                            }
                            break;

                        default:
                            $result_arr['default'] = "No data Here!";
                            break;
                    }
                }
            }
            // echo json_encode($result_arr);
            global $pro_finalResponseArr, $response;
            $count = 0;
            foreach ($result_arr as $result_arrKey => $result_arrVal) {
                $sqlforClient = "SELECT `client_name`,`client_contact`,`client_state`,`code` FROM `crm_master_table` WHERE `uniq_id`=?";
                $stmtforClient = mysqli_prepare($conn, $sqlforClient);
                mysqli_stmt_bind_param($stmtforClient, "i", $result_arrKey);
                mysqli_stmt_execute($stmtforClient);
                $resforClient = mysqli_stmt_get_result($stmtforClient);
                while ($rowforClient = mysqli_fetch_assoc($resforClient)) {
                    $pro_finalResponseArr[$result_arrKey] = $result_arrVal . "|" . $rowforClient['code'] . " " . $rowforClient['client_name'] . " " . $rowforClient['client_state'] . "|" . $rowforClient['client_contact'];
                    $count++;
                }
            }
            $response['prfl'] = "pro";
            $response['count'] = $count;
            $response['finalResp'] = $pro_finalResponseArr;
            //Response for the ajax callback from pro->
            echo json_encode($response);
        }
    }
    /* elseif ($profile === "ceo") {
        global $response;
        $count = 0;
        $arr = ['success','on CEO','page'];
        $response['prfl'] = "ceo";
        $response['count'] = $count;
        $response['finalResp'] = $arr ;
        echo json_encode($response);
    } */ 
    else {
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // require '../constant/db_connect.php';
    $parameter = '|';
    $data_arr = explode($parameter, $_POST['data']);
    global $dataKey, $dataValue, $data_arr, $user_name;
    $dataKey = $data_arr[0];
    $dataValue = $data_arr[1];
    $user_name = $_POST['user'];
    if ($data_arr[2] === 'pro') {
        // echo json_encode($dataKey . "->" . $dataValue . "=> From PRO");
        client_details_process($dataKey, $dataValue, $data_arr[2], $user_name);
        // echo json_encode($cl_Nm);
    } elseif ($data_arr[2] === 'resp') {
        // echo json_encode($dataKey . "->" . $dataValue . "=> From 2RESP");
        client_details_process($dataKey, $dataValue, $data_arr[2], $user_name);
        // echo json_encode($cl_Nm);
    } /*elseif ($data_arr[2] === 'ceo') {
        client_details_process($dataKey, $dataValue, $data_arr[2], $user_name);
        // echo json_encode($dataKey . "->" . $dataValue . "=> From CEO");
    }*/ else {
        echo json_encode("No data!At first");
    }
}
