<?php
//function for retriving note data:~
function retriveNoteData($clnt_uid, $sec_resp)
{   try{
        require '../constant/db_connect.php';
        global $data;
        if(empty($clnt_uid) && empty($sec_resp)){
            throw new Exception("Parameters not found to retrive!");
        }
        if (!$conn) {
            throw new Exception("Database connection failed: " . mysqli_connect_error());
        }
        $responseSQL = "SELECT `date_time`,`note` FROM `curr_note` WHERE `client_unqid`=? AND`resp_name`=?";
        $responseStmt = mysqli_prepare($conn, $responseSQL);
        if (!$responseStmt) {
            throw new Exception("Error in preparing SQL statement: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($responseStmt, "is", $clnt_uid, $sec_resp);
        mysqli_stmt_execute($responseStmt);
        $data = [];
        $i = 0;
        $responseRes = mysqli_stmt_get_result($responseStmt);
        if (!$responseRes) {
            throw new Exception("Error getting result set for client: " . mysqli_error($conn));
        }
        while ($responseROW = mysqli_fetch_assoc($responseRes)) {
            $data[$i] =$clnt_uid . "|" .  $responseROW["date_time"] . "|" . $responseROW["note"];
            $i++;
        }
        
    }catch(Exception $e){
        $data['error'] = "Error: " . $e->getMessage();
    }finally{
        if ($conn) {
            mysqli_close($conn);
        }
    }
    return($data);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{
        global $retrivDT, $Clntid, $respname,$cndata;
        if (isset($_POST["ID"])) {
            require '../constant/db_connect.php';
            if (!$conn) {
                throw new Exception("Database connection failed: " . mysqli_connect_error());
            }
            $Clntid = $_POST["ID"];
            $Clntnote =  $_POST["NOTE"];
            $respname = $_POST["RESPNAME"];
            date_default_timezone_set('Asia/Kolkata');
            $date = date("Y-m-d H:i:s"); //dS F Y, g:i A
            // $data = "(" . $date . ")" . $Clntid . "->" . $respname . "->" . $Clntnote;
            if(!empty($Clntid) && !empty($Clntnote) && !empty($respname) && !empty($date)){
                $cnSQL = "INSERT INTO `curr_note`(`client_unqid`, `date_time`, `note`, `resp_name`) VALUES (?,?,?,?)";
                $cnStmt = mysqli_prepare($conn, $cnSQL);
                if (!$cnStmt) {
                    throw new Exception("Error in preparing SQL statement: " . mysqli_error($conn));
                }
                mysqli_stmt_bind_param($cnStmt, "isss", $Clntid, $date, $Clntnote, $respname);
                if (mysqli_stmt_execute($cnStmt)) {
                    $cndata = retriveNoteData($Clntid, $respname);
                }
            }
        } elseif (isset($_POST["default"])) {
            $Clntid = $_POST["clnt_id"];
            $respname = $_POST["resp_name"];
            if(empty($Clntid) && empty($respname)){
                throw new Exception("Parameters not found to retrive!");
            }
            $cndata = retriveNoteData($Clntid, $respname);
        }
    }catch(Exception $e){
        $cndata['error'] = "Error: " . $e->getMessage();
    }finally{
        if ($conn) {
            mysqli_close($conn);
        }
    }
    echo json_encode($cndata);
    
}
