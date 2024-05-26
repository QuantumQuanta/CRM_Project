<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../constant/db_connect.php';
    $ex_dateTime = $_POST['exvis_dt'];
    $ex_filledBy = $_POST['exvisfillbyname'];
    $ex_vis_id = $_POST['exvisunqid'];
    $ex_vis_ETA = $_POST['exvisexat'];
    $ex_vis_ATA = $_POST['exvisacat'];
    $ex_vis_assName = $_POST['exvisascname'];
    $exvisitingPerson = '';
    if ($_POST['exvistomeet'] != "Choose...") {
        $exvisitingPerson = $_POST['exvistomeet'];
    } else {
        $exvisitingPerson = '';
    }
    $exvisitingMeetRoom = $_POST['exvismeetroom'];
    $exvisKYCStat = '';
    if ($_POST['exviskycstat'] != "Choose...") {
        $exvisKYCStat = $_POST['exviskycstat'];
    } else {
        $exvisKYCStat = '';
    }
    $ex_visAdd = $_POST['exvisadd'];
    $ex_visEmail = $_POST['exvisemail'];
    $ex_visCom = $_POST['exviscom'];

    //variables Visitor's Associates' Id Proof
    $exvisAssaadhaar = '';
    $exvisAssvoter = '';
    $exvisAsspan = '';
    $exvisAssdl = '';
    $exvisAsspass = '';
    $exvisAssother = '';

    //Exsisting Client's Associates' ID Proof
    if (isset($_POST['exvisAssaadharno'])) {
        for ($i = 0; $i < sizeof($_POST['exvisAssaadharno']); $i++) {
            $exvisAssaadhaar = $exvisAssaadhaar . "Visitor Associate Aadhaar-" . $_POST['exvisAssaadharno'][$i] . " ";
        }
        echo $exvisAssaadhaar;
    }
    if (isset($_POST['exvisAssvoterno'])) {
        for ($i = 0; $i < sizeof($_POST['exvisAssvoterno']); $i++) {
            $exvisAssvoter = $exvisAssvoter . "Visitor Associate Voter-" . $_POST['exvisAssvoterno'][$i] . " ";
        }
        echo $exvisAssvoter;
    }
    if (isset($_POST['exvisAsspanno'])) {
        for ($i = 0; $i < sizeof($_POST['exvisAsspanno']); $i++) {
            $exvisAsspan = $exvisAsspan . "Visitor Associate PAN-" . $_POST['exvisAsspanno'][$i] . " ";
        }
        echo $exvisAsspan;
    }
    if (isset($_POST['exvisAssdlno'])) {
        for ($i = 0; $i < sizeof($_POST['exvisAssdlno']); $i++) {
            $exvisAssdl = $exvisAssdl . "Visitor Associate DL-" . $_POST['exvisAssdlno'][$i] . " ";
        }
        echo $exvisAssdl;
    }
    if (isset($_POST['exvisAsspassno'])) {
        for ($i = 0; $i < sizeof($_POST['exvisAsspassno']); $i++) {
            $exvisAsspass = $exvisAsspass . "Visitor Associate Passport-" . $_POST['exvisAsspassno'][$i] . " ";
        }
        echo $exvisAsspass;
    }
    if (isset($_POST['exvisAssother'])) {
        for ($i = 0; $i < sizeof($_POST['exvisAssother']); $i++) {
            $exvisAssother = $exvisAssother . "Visitor Associate Other-" . $_POST['exvisAssother'][$i] . " ";
        }
        echo $exvisAssother;
    }

    $exvisAssIdNo = '';
    $exarr = array($exvisAssaadhaar, $exvisAssvoter, $exvisAsspan, $exvisAssdl, $exvisAsspass, $exvisAssother);
    foreach ($exarr as $exval) {
        if ($exval != '') {
            $exvisAssIdNo = $exvisAssIdNo . $exval . " | ";
        }
    }

    $resultexVisIn;
    // && $ex_dateTime!="" && $ex_vis_ATA!="" && $ex_vis_assName ="" && $exvisAssIdNo!="" && $exvisKYCStat!="" && $ex_visAdd!=""
    if($ex_vis_id!=""){
        // echo ("dateTime= " . $ex_dateTime . "EX vis_IdNofull= " . $ex_vis_id . "EX vis_ETA= " . $ex_vis_ETA . "EX vis_ATA= " . $ex_vis_ATA . "form_filler= " . $ex_filledBy . "EX visitingPerson= " . $exvisitingPerson . "EX visitingMeetRoom= " . $exvisitingMeetRoom . "EX visAddress= " . $ex_visAdd . "EX visEmail= " . $ex_visEmail . "EX visComment= " . $ex_visCom . "ID Proofs" . $exvisAssIdNo);
        $sqlexVisIn = "INSERT INTO `visitor_log`(`vis_unqidno`, `vis_dt`, `vis_eta`, `vis_ata`, `vis_assname`, `vis_tomeet`, `vis_meetroom`, `vis_assidno`, `vis_kycstat`, `vis_address`, `vis_email`, `vis_comment`) VALUES ('$ex_vis_id','$ex_dateTime','$ex_vis_ETA','$ex_vis_ATA','$ex_vis_assName','$exvisitingPerson','$exvisitingMeetRoom','$exvisAssIdNo','$exvisKYCStat','$ex_visAdd','$ex_visEmail','$ex_visCom')";
        $resultexVisIn = mysqli_query($conn, $sqlexVisIn);
    }

    require '../constant/encrypt_decrypt.php';

    $err = 'Data has been saved but not uploaded successfully!' ;
    $suc = 'Data has been saved and uploaded successfully!';
    $dbni = 'Data has not been saved or uploaded successfully!';

    if ($resultexVisIn == true) {
        $sqlexVisRetriv = "SELECT * FROM `visitor_log_main` WHERE `vis_unq_id` = $ex_vis_id";
        $resexVisRetriv = mysqli_query($conn, $sqlexVisRetriv);
        $rowexVisRetriv = mysqli_fetch_assoc($resexVisRetriv);
        $exVisName = $rowexVisRetriv['vis_name'];
        // File uploads (the ID proofs pics storing in specific folders named as the visitor's name)
        date_default_timezone_set('Asia/Kolkata');
        $exdatestamp = date("d-m-Y");
        $exvis_IdNofull = "ENV-" . $ex_vis_id . "-VSTR-" . $exdatestamp;
        $exparentFolderPath = "../upload/visitorLogBook/";
        $exnewFolderName = $exVisName . "_" . $exvis_IdNofull . "/";
        $exnewFolderPath = $exparentFolderPath . $exnewFolderName;
        //echo $newFolderPath;

        /*$exvisfilesName = $_FILES['visidproofpics']['name'];
        $exvisfilesTName = $_FILES['visidproofpics']['tmp_name'];*/
        $exvisAssfilesName = $_FILES['exvisAssidproofpics']['name'];
        $exvisAssfilesTName = $_FILES['exvisAssidproofpics']['tmp_name'];

        // $exvisfinalDestination = '';
        $exvisAssfinalDestination = '';
        // var_dump($_FILES['exvisAssidproofpics']);
        $temp = 0;
        
        if (!file_exists($exnewFolderPath)) {
            mkdir($exnewFolderPath, 0777, true);
        }
        //Temp variable to hold the loop success value
        for ($i = 0; $i < sizeof($exvisAssfilesName); $i++) {
            $exvisAssfinalDestination = $exnewFolderPath . $exvisAssfilesName[$i];
            move_uploaded_file($exvisAssfilesTName[$i], $exvisAssfinalDestination);
            // echo "loop".$i."completed";
            $temp++;
        }
        
        
        if ($temp == sizeof($exvisAssfilesName) ) {
            $en_suc = encryptData($suc);
            header("location:../action/visitor_log.php?success".$suc);
        } else {
            $en_err = encryptData($err);
            header("location:../action/visitor_log.php?error".$err);
        }
    }
    else{
        $en_dbni = encryptData($dbni);
        header("location:../action/visitor_log.php?dbNI".$dbni);
    }
}
