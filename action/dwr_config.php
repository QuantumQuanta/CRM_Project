<?php

function clientNamePull($id){
    require '../constant/db_connect.php';
    global $clDetStr;
    try{
        if (!$conn) {

            throw new Exception("Connection failed: " . mysqli_connect_error());
        }
    
        $cl_sql = "SELECT `client_name`,`client_contact`,`client_state`,`code` FROM `crm_master_table` WHERE `uniq_id`=?";
    
       
        $cl_stmt = mysqli_prepare($conn, $cl_sql);
        if (!$cl_stmt) {
            
            throw new Exception("Error in preparing statement: " . mysqli_error($conn));
        }
    
        mysqli_stmt_bind_param($cl_stmt, "i", $id);
    
        
        if (!mysqli_stmt_execute($cl_stmt)) {
            
            throw new Exception("Error in executing statement: " . mysqli_error($conn));
        }
    
    
        $cl_res = mysqli_stmt_get_result($cl_stmt);
    
    
        if (mysqli_num_rows($cl_res) > 0) {
            
    
    
            while ($cl_row = mysqli_fetch_assoc($cl_res)) {
                $clDetStr = $cl_row['client_name']."+".$cl_row['client_contact']."+".$cl_row['client_state']."+".$cl_row['code'];
            }
    
    
            mysqli_stmt_close($cl_stmt);
    
    
            
        } else {
            throw new Exception("No records found for ID: " . $id);
        }

    }catch(Exception $e){
        $clDetStr = "Error: " . $e->getMessage();
    }finally{
        if ($conn) {
            mysqli_close($conn);
        }
    }
    return $clDetStr;
}



if($_SERVER["REQUEST_METHOD"]=='POST'){
    require '../constant/db_connect.php';
    try{
        if(isset($_POST['docLoad']) && ($_POST['docLoad']=='yes')){
            $sql = "SELECT `id`, `name`, `user`, `desg_code` FROM `login_data` WHERE `desg_code` IN ('PRO','2NDRESP')";
            $res = mysqli_query($conn,$sql);
            if (!$res) {
                throw new Exception("Query failed: " . mysqli_error($conn));
            }
            $dataArray=[];
            while($row = mysqli_fetch_assoc($res)){
                $dataArray[$row['user']] = $row['id']."|".$row['name']."|".$row['desg_code'];
            }
            echo json_encode($dataArray);
        }
        elseif(isset($_POST['flag']) && ($_POST['flag']=='up')){
            $name = $_POST['name'];
            $fdate = new DateTime($_POST['fdate']);
            $ldate = new DateTime($_POST['ldate']);
    
            $startDt = $fdate->format('Y-m-d H:i:s');
            $endDt = $ldate->format('Y-m-d H:i:s');
            // $data = $startDt."    ".$endDt;
            // echo json_encode($data);
            if($name == 'all|all'){
                $all_sql ="SELECT * FROM `mixed_input_proresp` WHERE `dt` BETWEEN ? AND ?";
                $all_stmt = mysqli_prepare($conn,$all_sql);
                if (!$all_stmt) {
                    throw new Exception("Error in preparing statement: " . mysqli_error($conn));
                }
                mysqli_stmt_bind_param($all_stmt,"ss",$startDt,$endDt);
                mysqli_stmt_execute($all_stmt);
                if (!mysqli_stmt_execute($all_stmt)) {
                    
                    throw new Exception("Error in executing statement: " . mysqli_error($conn));
                }
                $all_res = mysqli_stmt_get_result($all_stmt);
                $data=[];
                $i=0;
                if (mysqli_num_rows($all_res) > 0){
                    while($all_row = mysqli_fetch_assoc($all_res)){
                        $clDetailsAll = clientNamePull($all_row['uniq_id']);
                        $data[$i]= $all_row['uniq_id']."|".$all_row['dt']."|".$all_row['pro_name']."|".$all_row['contacted_us']."|".$all_row['kyc_stat']."|".$all_row['pcr_priority']."|".$all_row['pcr_et']."|".$all_row['call_type']."|".$all_row['call_stat']."|".$all_row['category']."|".$all_row['source']."|".$all_row['comment_1']."|".$all_row['client_stat_1']."|".$all_row['pcr_resp_1']."|".$all_row['pcr_pt_1']."|".$all_row['client_rating_1']."|".$all_row['sec_resp_name']."|".$all_row['comment_2']."|".$all_row['client_stat_2']."|".$all_row['pcr_resp_2']."|".$all_row['pcr_pt_2']."|".$all_row['pcr_prc']."|".$all_row['client_rating_2']."|".$clDetailsAll;
                        $i++;
                    }
                    echo json_encode($data);
                }else{
                    throw new Exception("Error for Records/ No records found". mysqli_error($conn));
                }
                
            }
            else{
                $para = "|";
                $arr = explode($para,$name);
                $userName = $arr[0];
                $desg = $arr[1];
                if($desg == "PRO"){
                    $pro_sql = "SELECT * FROM `mixed_input_proresp` WHERE `dt` BETWEEN ? AND ? AND `pro_name`=?";
                    $pro_stmt = mysqli_prepare($conn,$pro_sql);
                    if(!$pro_stmt){
                        throw new Exception("Error in preparing statement: " . mysqli_error($conn));
                    }
                    mysqli_stmt_bind_param($pro_stmt,"sss",$startDt,$endDt,$userName);
                    mysqli_stmt_execute($pro_stmt);
                    if (!mysqli_stmt_execute($pro_stmt)) {
                    
                        throw new Exception("Error in executing statement: " . mysqli_error($conn));
                    }
                    $pro_res = mysqli_stmt_get_result($pro_stmt);
                    $data=[];
                    $i=0;
                    while($pro_row = mysqli_fetch_assoc($pro_res)){
                        $clDetailspro = clientNamePull($pro_row['uniq_id']);
                        $data[$i]=$pro_row['uniq_id']."|".$pro_row['dt']."|".$pro_row['pro_name']."|".$pro_row['contacted_us']."|".$pro_row['kyc_stat']."|".$pro_row['pcr_priority']."|".$pro_row['pcr_et']."|".$pro_row['call_type']."|".$pro_row['call_stat']."|".$pro_row['category']."|".$pro_row['source']."|".$pro_row['comment_1']."|".$pro_row['client_stat_1']."|".$pro_row['pcr_resp_1']."|".$pro_row['pcr_pt_1']."|".$pro_row['client_rating_1']."|".$clDetailspro;
                        $i++;
                    }
                    echo json_encode($data);
                }
                elseif($desg == "2NDRESP"){
                    $resp_sql = "SELECT * FROM `mixed_input_proresp` WHERE `dt` BETWEEN ? AND ? AND `sec_resp_name`=?";
                    $resp_stmt = mysqli_prepare($conn,$resp_sql);
                    if(!$resp_stmt){
                        throw new Exception("Error in preparing statement: " . mysqli_error($conn));
                    }
                    mysqli_stmt_bind_param($resp_stmt,"sss",$startDt,$endDt,$userName);
                    mysqli_stmt_execute($resp_stmt);
                    if (!mysqli_stmt_execute($resp_stmt)) {
                    
                        throw new Exception("Error in executing statement: " . mysqli_error($conn));
                    }
                    $resp_res = mysqli_stmt_get_result($resp_stmt);
                    $data=[];
                    $i=0;
                    while($resp_row = mysqli_fetch_assoc($resp_res)){
                        $clDetailsresp = clientNamePull($resp_row['uniq_id']);
                        $data[$i]=$resp_row['uniq_id']."|".$resp_row['dt']."|".$resp_row['sec_resp_name']."|".$resp_row['comment_2']."|".$resp_row['client_stat_2']."|".$resp_row['pcr_resp_2']."|".$resp_row['pcr_pt_2']."|".$resp_row['pcr_prc']."|".$resp_row['client_rating_2']."|".$clDetailsresp;
                        $i++;
                    }
                    echo json_encode($data);
                }
            }
        }
    }catch(Exception $e){
        echo json_encode("Error: " . $e->getMessage());
    }finally{
        if ($conn) {
            mysqli_close($conn);
        }
    }
}
    

?>