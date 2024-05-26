<?php

use function PHPSTORM_META\type;

//function for Username from userId:
function getUserName($userIDEN)
{   global $EMPNAME;
    require('../constant/db_connect.php');
    $sqlEmp = "SELECT `name` FROM `login_data` WHERE `user`= ?";
    $stmtEmp = mysqli_prepare($conn,$sqlEmp);
    mysqli_stmt_bind_param($stmtEmp,"s",$userIDEN);
    mysqli_stmt_execute($stmtEmp);
    $resEmp = mysqli_stmt_get_result($stmtEmp);
    if($resEmp){
        while($rowEmp = mysqli_fetch_assoc($resEmp)){
            $EMPNAME = $rowEmp['name'];
        } 
    }
    return $EMPNAME;
}
//function to handle all the sql's based on the input parameters
/*fn for Response Wise*/

function clientDataProcess_resp($key, $value, $identity, $desgCode)
{
    require('../constant/db_connect.php');
    if (!empty($key) && !empty($identity)) {
        if ($desgCode === "2NDRESP") {
            $sql_AllClients = "SELECT `uniq_id` FROM `crm_master_table` WHERE `2nd_resp`= '$identity'";
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
                global $result_arr, $response_RR;
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
                $response_RR['prfl'] = "2resp_ceoStat";
                $response_RR['count'] = $count;
                $response_RR['finalResp'] = $finalResponseArr;
                //Response for the ajax callback from 2nd Resp->
                echo json_encode($response_RR);
            }
        } elseif ($desgCode === "PRO") {
            $sql_AllClients = "SELECT `uniq_id` FROM `crm_master_table` WHERE `1st_resp`= '$identity'";
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
                global $pro_finalResponseArr, $response_RP;
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
                $response_RP['prfl'] = "pro_ceoStat";
                $response_RP['count'] = $count;
                $response_RP['finalResp'] = $pro_finalResponseArr;
                //Response for the ajax callback from pro->
                echo json_encode($response_RP);
            }
        } else {
            echo json_encode("Designation Code N/A");
        }
    }
}

/*fn for Client Wise*/
function clientDataProcess_clnt($key, $identity)
{
    require '../constant/db_connect.php';

    if (!empty($key) && !empty($identity)) {
        //global variable(array) declaration
        global $arr_clntwise_resp, $arr_clntwise_pt, $arr_clntwise_prc, $arr_clntwise_cr, $arr_clntwise_cs, $response_C,$proName,$resp2Name;
        switch ($key) {
            case "pcr_resp":
                //for pcr_resp_1
                $sql_clntwise_resp1 = "WITH LatestEntryRESP1 AS(SELECT `uniq_id`,`dt`,`pro_name`,`pcr_resp_1`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `pcr_resp_1` IS NOT NULL) SELECT `pro_name`,`pcr_resp_1`,`entry_seq`,`dt` FROM `LatestEntryRESP1` WHERE `pcr_resp_1` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_clntwise_resp1 = mysqli_prepare($conn, $sql_clntwise_resp1);
                mysqli_stmt_bind_param($stmt_clntwise_resp1, "i", $identity);
                mysqli_stmt_execute($stmt_clntwise_resp1);
                $res_clntwise_resp1 = mysqli_stmt_get_result($stmt_clntwise_resp1);
                if ($res_clntwise_resp1) {
                    while ($row_clntwise_resp1 = mysqli_fetch_assoc($res_clntwise_resp1)) {                   
                        if (!empty($row_clntwise_resp1)) {
                            if ($row_clntwise_resp1['pcr_resp_1'] != ' ' && $row_clntwise_resp1['pro_name'] != ' ') {
                                $proName = getUserName($row_clntwise_resp1['pro_name']);
                                $arr_clntwise_resp['pcr_resp_1'] = $row_clntwise_resp1['pcr_resp_1'] . "|" . $row_clntwise_resp1['dt'] . "|" . $proName;
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }

                //for pcr_resp_2
                $sql_clntwise_resp2 = "WITH LatestEntryRESP2 AS(SELECT `uniq_id`,`dt`,`sec_resp_name`,`pcr_resp_2`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `pcr_resp_2` IS NOT NULL) SELECT `sec_resp_name`,`pcr_resp_2`,`entry_seq`,`dt` FROM `LatestEntryRESP2` WHERE `pcr_resp_2` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_clntwise_resp2 = mysqli_prepare($conn, $sql_clntwise_resp2);
                mysqli_stmt_bind_param($stmt_clntwise_resp2, "i", $identity);
                mysqli_stmt_execute($stmt_clntwise_resp2);
                $res_clntwise_resp2 = mysqli_stmt_get_result($stmt_clntwise_resp2);
                if ($res_clntwise_resp2) {
                    while ($row_clntwise_resp2 = mysqli_fetch_assoc($res_clntwise_resp2)) {
                        if (!empty($row_clntwise_resp2)) {
                            if ($row_clntwise_resp2['pcr_resp_2'] != ' ' && $row_clntwise_resp2['sec_resp_name'] != ' ') {
                                $resp2Name = getUserName($row_clntwise_resp2['sec_resp_name']);
                                $arr_clntwise_resp['pcr_resp_2'] = $row_clntwise_resp2['pcr_resp_2'] . "|" . $row_clntwise_resp2['dt'] . "|" . $resp2Name;
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }
                $response_C['prfl'] = "clnt_ceoStat";
                $response_C['finalResp'] = $arr_clntwise_resp;
                echo json_encode($response_C);
                // echo json_encode("from inside response switch!");
                break;
            case "pcr_pt":
                //for pcr_pt_1
                $sql_clntwise_pt1 = "WITH LatestEntryPT1 AS(SELECT `uniq_id`,`dt`,`pro_name`,`pcr_pt_1`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `pcr_pt_1` IS NOT NULL) SELECT `pro_name`,`pcr_pt_1`,`entry_seq`,`dt` FROM `LatestEntryPT1` WHERE `pcr_pt_1` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_clntwise_pt1 = mysqli_prepare($conn, $sql_clntwise_pt1);
                mysqli_stmt_bind_param($stmt_clntwise_pt1, "i", $identity);
                mysqli_stmt_execute($stmt_clntwise_pt1);
                $res_clntwise_pt1 = mysqli_stmt_get_result($stmt_clntwise_pt1);

                if ($res_clntwise_pt1) {
                    while ($row_clntwise_pt1 = mysqli_fetch_assoc($res_clntwise_pt1)) {
                        if (!empty($row_clntwise_pt1)) {
                            if ($row_clntwise_pt1['pcr_pt_1'] != ' ' && $row_clntwise_pt1['pro_name'] != ' ') {
                                $proName = getUserName($row_clntwise_pt1['pro_name']);
                                $arr_clntwise_pt['pcr_pt_1'] = $row_clntwise_pt1['pcr_pt_1'] . "|" . $row_clntwise_pt1['dt'] . "|" . $proName;
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }

                //for pcr_pt_2
                $sql_clntwise_pt2 = "WITH LatestEntryPT2 AS(SELECT `uniq_id`,`sec_resp_name`,`dt`,`pcr_pt_2`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `pcr_pt_2` IS NOT NULL) SELECT `sec_resp_name`,`pcr_pt_2`,`entry_seq`,`dt` FROM `LatestEntryPT2` WHERE `pcr_pt_2` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_clntwise_pt2 = mysqli_prepare($conn, $sql_clntwise_pt2);
                mysqli_stmt_bind_param($stmt_clntwise_pt2, "i", $identity);
                mysqli_stmt_execute($stmt_clntwise_pt2);
                $res_clntwise_pt2 = mysqli_stmt_get_result($stmt_clntwise_pt2);

                if ($res_clntwise_pt2) {
                    while ($row_clntwise_pt2 = mysqli_fetch_assoc($res_clntwise_pt2)) {
                        if (!empty($row_clntwise_pt2)) {
                            if ($row_clntwise_pt2['pcr_pt_2'] != ' ' && $row_clntwise_pt2['sec_resp_name'] != ' ') {
                                $resp2Name = getUserName($row_clntwise_pt2['sec_resp_name']);
                                $arr_clntwise_pt['pcr_pt_2'] = $row_clntwise_pt2['pcr_pt_2'] . "|" . $row_clntwise_pt2['dt'] . "|" . $resp2Name;
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }
                $response_C['prfl'] = "clnt_ceoStat";
                $response_C['finalResp'] = $arr_clntwise_pt;
                echo json_encode($response_C);
                // echo json_encode("from inside PT switch!");
                break;
            case "pcr_prc":
                //for pcr_prc
                $sql_clntwise_prc = "WITH LatestEntryPRC AS(SELECT `uniq_id`,`sec_resp_name`,`dt`,`pcr_prc`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `pcr_prc` IS NOT NULL) SELECT `sec_resp_name`,`pcr_prc`,`entry_seq`,`dt` FROM `LatestEntryPRC` WHERE `pcr_prc` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_clntwise_prc = mysqli_prepare($conn, $sql_clntwise_prc);
                mysqli_stmt_bind_param($stmt_clntwise_prc, "i", $identity);
                mysqli_stmt_execute($stmt_clntwise_prc);
                $res_clntwise_prc = mysqli_stmt_get_result($stmt_clntwise_prc);

                if ($res_clntwise_prc) {
                    while ($row_clntwise_prc = mysqli_fetch_assoc($res_clntwise_prc)) {
                        if (!empty($row_clntwise_prc)) {
                            if ($row_clntwise_prc['pcr_prc'] != ' ' && $row_clntwise_prc['sec_resp_name'] != ' ') {
                                $resp2Name = getUserName($row_clntwise_prc['sec_resp_name']);
                                $arr_clntwise_prc['pcr_prc'] = $row_clntwise_prc['pcr_prc'] . "|" . $row_clntwise_prc['dt'] . "|" . $resp2Name;
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }
                $response_C['prfl'] = "clnt_ceoStat";
                $response_C['finalResp'] = $arr_clntwise_prc;
                echo json_encode($response_C);
                // echo json_encode("from inside PRC switch!");
                break;
            case "pcr_client_rating":
                //for pcr_client_rating_1
                $sql_clntwise_cr1 = "WITH LatestEntryCR1 AS(SELECT `uniq_id`,`pro_name`,`dt`,`client_rating_1`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `client_rating_1` IS NOT NULL) SELECT `pro_name`,`client_rating_1`,`entry_seq`,`dt` FROM `LatestEntryCR1` WHERE `client_rating_1` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_clntwise_cr1 = mysqli_prepare($conn, $sql_clntwise_cr1);
                mysqli_stmt_bind_param($stmt_clntwise_cr1, "i", $identity);
                mysqli_stmt_execute($stmt_clntwise_cr1);
                $res_clntwise_cr1 = mysqli_stmt_get_result($stmt_clntwise_cr1);

                if ($res_clntwise_cr1) {
                    while ($row_clntwise_cr1 = mysqli_fetch_assoc($res_clntwise_cr1)) {
                        if (!empty($row_clntwise_cr1)) {
                            if ($row_clntwise_cr1['client_rating_1'] != ' ' && $row_clntwise_cr1['pro_name'] != ' ') {
                                $proName = getUserName($row_clntwise_cr1['pro_name']);
                                $arr_clntwise_cr['client_rating_1'] = $row_clntwise_cr1['client_rating_1'] . "|" . $row_clntwise_cr1['dt'] . "|" . $proName;
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }

                //for pcr_client_rating_2
                $sql_clntwise_cr2 = "WITH LatestEntryCR2 AS(SELECT `uniq_id`,`sec_resp_name`,`dt`,`client_rating_2`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `client_rating_2` IS NOT NULL) SELECT `sec_resp_name`,`client_rating_2`,`entry_seq`,`dt` FROM `LatestEntryCR2` WHERE `client_rating_2` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_clntwise_cr2 = mysqli_prepare($conn, $sql_clntwise_cr2);
                mysqli_stmt_bind_param($stmt_clntwise_cr2, "i", $identity);
                mysqli_stmt_execute($stmt_clntwise_cr2);
                $res_clntwise_cr2 = mysqli_stmt_get_result($stmt_clntwise_cr2);

                if ($res_clntwise_cr2) {
                    while ($row_clntwise_cr2 = mysqli_fetch_assoc($res_clntwise_cr2)) {
                        if (!empty($row_clntwise_cr2)) {
                            if ($row_clntwise_cr2['client_rating_2'] != ' ' && $row_clntwise_cr2['sec_resp_name'] != ' ') {
                                $resp2Name = getUserName($row_clntwise_cr2['sec_resp_name']);
                                $arr_clntwise_cr['client_rating_2'] = $row_clntwise_cr2['client_rating_2'] . "|" . $row_clntwise_cr2['dt'] . "|" . $resp2Name;
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }
                $response_C['prfl'] = "clnt_ceoStat";
                $response_C['finalResp'] = $arr_clntwise_cr;
                echo json_encode($response_C);
                // echo json_encode("from inside CR switch!");
                break;
            case "client_stat":
                //for pcr_client_stat_1
                $sql_clntwise_cs1 = "WITH LatestEntryCS1 AS(SELECT `uniq_id`,`pro_name`,`dt`,`client_stat_1`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `client_stat_1` IS NOT NULL) SELECT `pro_name`,`client_stat_1`,`entry_seq`,`dt` FROM `LatestEntryCS1` WHERE `client_stat_1` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_clntwise_cs1 = mysqli_prepare($conn, $sql_clntwise_cs1);
                mysqli_stmt_bind_param($stmt_clntwise_cs1, "i", $identity);
                mysqli_stmt_execute($stmt_clntwise_cs1);
                $res_clntwise_cs1 = mysqli_stmt_get_result($stmt_clntwise_cs1);

                if ($res_clntwise_cs1) {
                    while ($row_clntwise_cs1 = mysqli_fetch_assoc($res_clntwise_cs1)) {
                        if (!empty($row_clntwise_cs1)) {
                            if ($row_clntwise_cs1['client_stat_1'] != ' ' && $row_clntwise_cs1['pro_name'] != ' ') {
                                $proName = getUserName($row_clntwise_cs1['pro_name']);
                                $arr_clntwise_cs['client_stat_1'] = $row_clntwise_cs1['client_stat_1'] . "|" . $row_clntwise_cs1['dt'] . "|" . $proName;
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }

                //for client_stat_2
                $sql_clntwise_cs2 = "WITH LatestEntryCS2 AS(SELECT `uniq_id`,`sec_resp_name`,`dt`,`client_stat_2`, ROW_NUMBER() OVER(ORDER BY `dt` DESC)AS entry_seq FROM `mixed_input_proresp` WHERE `uniq_id`= ? AND `client_stat_2` IS NOT NULL) SELECT `sec_resp_name`,`client_stat_2`,`entry_seq`,`dt` FROM `LatestEntryCS2` WHERE `client_stat_2` IS NOT NULL ORDER BY `entry_seq`";
                $stmt_clntwise_cs2 = mysqli_prepare($conn, $sql_clntwise_cs2);
                mysqli_stmt_bind_param($stmt_clntwise_cs2, "i", $identity);
                mysqli_stmt_execute($stmt_clntwise_cs2);
                $res_clntwise_cs2 = mysqli_stmt_get_result($stmt_clntwise_cs2);

                if ($res_clntwise_cs2) {
                    while ($row_clntwise_cs2 = mysqli_fetch_assoc($res_clntwise_cs2)) {
                        if (!empty($row_clntwise_cs2)) {
                            if ($row_clntwise_cs2['client_stat_2'] != ' ' && $row_clntwise_cs2['sec_resp_name'] != ' ') {
                                $resp2Name = getUserName($row_clntwise_cs2['sec_resp_name']);
                                $arr_clntwise_cs['client_stat_2'] = $row_clntwise_cs2['client_stat_2'] . "|" . $row_clntwise_cs2['dt'] . "|" . $resp2Name;
                                break;
                            } else {
                                continue;
                            }
                        }
                    }
                }
                $response_C['prfl'] = "clnt_ceoStat";
                $response_C['finalResp'] = $arr_clntwise_cs;
                echo json_encode($response_C);
                // echo json_encode("from inside CS switch!");
                break;
        }
    }
}
//main|trigger
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $parameter = '|';
    $data_arr = explode($parameter, $_POST['data']);
    global $dataKey, $dataValue, $data_arr, $user_name;
    $dataKey = $data_arr[0];
    $dataValue = $data_arr[1];
    $user_arr = explode($parameter, $_POST['userName']);
    $user_name = $user_arr[0];
    $user_dsgCode = $user_arr[1];
    if ($data_arr[2] === 'ceo_R') {
        // echo json_encode("dataKey:".$dataKey."dataValue:".$dataValue."user_name:".$user_name."userCode:".$user_dsgCode);
        clientDataProcess_resp($dataKey, $dataValue, $user_name, $user_dsgCode);
    } elseif ($data_arr[2] === 'ceo_C') {
        // echo json_encode("dataKey:".$dataKey."ClientNo:".$user_name."userCode:".$user_dsgCode);
        clientDataProcess_clnt($dataKey, $user_name);  /*here $user_name is the client's unique id*/
    }
}
