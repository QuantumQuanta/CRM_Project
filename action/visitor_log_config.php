<?php
//UPDATE `vistor_log` SET vis_name = CONCAT(vis_name,'Shubham Nath') WHERE vis_unqidno = 1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../constant/db_connect.php';
    // $visIdPic = $_FILES['visidpic'];
    // $visIdPicCont = file_get_contents($visIdPic['tmp_name']);
    $dateTime = $_POST['vis_dt'];
    /*$dom->getElementsByTagName('input[type="text"]'*/
    //Concatinated full string for Visitor Id No.-->
    // $vis_IdNo_1 = $_POST['prt1_visid'];
    // $vis_IdNo_2 = $_POST['prt2_visid'];
    // $vis_IdNo_3 = $_POST['prt3_visid'];
    // $vis_IdNofull = $vis_IdNo_1 . "-" . $vis_IdNo_2 . "-" . $vis_IdNo_3;
    $vis_name = $_POST['visname'];
    $vis_ETA = $_POST['visexat'];
    $vis_ATA = $_POST['visacat'];
    $vis_assName = $_POST['visascname'];
    //Form filled up by -->
    $form_filler = $_POST['visfillbyname'];
    // Visiting to meet with -->
    $visitingPerson = '';
    if ($_POST['vistomeet'] != "Choose...") {
        $visitingPerson = $_POST['vistomeet'];
    } else {
        $visitingPerson = '';
    }

    //Meeting room -->
    $visitingMeetRoom = $_POST['vismeetroom'];
    //variables Visitor's Id Proof -->
    $visaadhaar = '';
    $visvoter = '';
    $vispan = '';
    $visdl = '';
    $vispass = '';
    $visother = '';
    //variables Visitor's Associates' Id Proof
    $visAssaadhaar = '';
    $visAssvoter = '';
    $visAsspan = '';
    $visAssdl = '';
    $visAsspass = '';
    $visAssother = '';

    //Visitor's Id Proof -->
    if (isset($_POST['visaadharno'])) {;
        for ($i = 0; $i < sizeof($_POST['visaadharno']); $i++) {
            $visaadhaar = $visaadhaar . "Visitor Aadhaar-" . $_POST['visaadharno'][$i] . " ";
        }
    }
    if (isset($_POST['visvoterno'])) {;
        for ($i = 0; $i < sizeof($_POST['visvoterno']); $i++) {
            //print_r("visitor Voter-" . $visvoter[$i] . " ");
            $visvoter = $visvoter . "Visitor Voter-" . $_POST['visvoterno'][$i] . " ";
        }
    }


    if (isset($_POST['vispanno'])) {;
        for ($i = 0; $i < sizeof($_POST['vispanno']); $i++) {

            $vispan = $vispan . "Visitor PAN-" . $_POST['vispanno'][$i] . " ";
        }
    }


    if (isset($_POST['visdlno'])) {;
        for ($i = 0; $i < sizeof($_POST['visdlno']); $i++) {

            $visdl = $visdl . "Visitor DL-" . $_POST['visdlno'][$i] . " ";
        }
    }


    if (isset($_POST['vispassno'])) {;
        for ($i = 0; $i < sizeof($_POST['vispassno']); $i++) {

            $vispass = $vispass . "Visitor Passport-" . $_POST['vispassno'][$i] . " ";
        }
    }


    if (isset($_POST['visother'])) {;
        for ($i = 0; $i < sizeof($_POST['visother']); $i++) {

            $visother = $visother . "Visitor Other-" . $_POST['visother'][$i] . " ";
        }
    }

    $visIdNo = '';
    $arr = array($visaadhaar, $visvoter, $vispan, $visdl, $vispass, $visother);
    foreach ($arr as $val) {
        if ($val != '') {
            $visIdNo = $visIdNo . $val . " | ";
        }
    }
    //Visitor's Associates' Id Proof
    if (isset($_POST['visAssaadharno'])) {;
        for ($i = 0; $i < sizeof($_POST['visAssaadharno']); $i++) {

            $visAssaadhaar = $visAssaadhaar . "Visitor Associate Aadhaar-" . $_POST['visAssaadharno'][$i] . " ";
        }
    }


    if (isset($_POST['visAssvoterno'])) {;
        for ($i = 0; $i < sizeof($_POST['visAssvoterno']); $i++) {

            $visAssvoter = $visAssvoter . "Visitor Associate Voter-" . $_POST['visAssvoterno'][$i] . " ";
        }
    }


    if (isset($_POST['visAsspanno'])) {;
        for ($i = 0; $i < sizeof($_POST['visAsspanno']); $i++) {

            $visAsspan = $visAsspan . "Visitor Associate PAN-" . $_POST['visAsspanno'][$i] . " ";
        }
    }

    if (isset($_POST['visAssdlno'])) {;
        for ($i = 0; $i < sizeof($_POST['visAssdlno']); $i++) {

            $visAssdl = $visAssdl . "Visitor Associate DL-" . $_POST['visAssdlno'][$i] . " ";
        }
    }


    if (isset($_POST['visAsspassno'])) {;
        for ($i = 0; $i < sizeof($_POST['visAsspassno']); $i++) {

            $visAsspass = $visAsspass . "Visitor Associate Passport-" . $_POST['visAsspassno'][$i] . " ";
        }
    }

    if (isset($_POST['visAssother'])) {;
        for ($i = 0; $i < sizeof($_POST['visAssother']); $i++) {

            $visAssother = $visAssother . "Visitor Associate Other-" . $_POST['visAssother'][$i] . " ";
        }
    }

    $visAssIdNo = '';
    $arr1 = array($visAssaadhaar, $visAssvoter, $visAsspan, $visAssdl, $visAsspass, $visAssother);
    foreach ($arr1 as $val2) {
        if ($val2 != '') {
            $visAssIdNo = $visAssIdNo . $val2 . " | ";
        }
    }

    // echo $visIdNo;
    // echo $visAssIdNo;

    //Visitor KYC Status -->
    $visKYCStat = '';
    if ($_POST['viskycstat'] != "Choose...") {
        $visKYCStat = $_POST['viskycstat'];
    } else {
        $visKYCStat = '';
    }

    //Visitor Address -->
    $visAddress = $_POST['visadd'];
    //Visitor Email -->
    $visEmail = $_POST['visemail'];
    //Visitor Comment -->
    $visComment = $_POST['viscom'];

    // echo ("dateTime= " . $dateTime . "vis_IdNofull= " . $vis_IdNofull . "vis_name= " . $vis_name . "vis_ETA= " . $vis_ETA . "vis_ATA= " . $vis_ATA . "form_filler= " . $form_filler . "visitingPerson= " . $visitingPerson . "visitingMeetRoom= " . $visitingMeetRoom . "visKYCStat= " . $visKYCStat . "visAddress= " . $visAddress . "visEmail= " . $visEmail . "visComment= " . $visComment.$visaadhaar.$visvoter.$vispan.$visdl.$visother."||".$visAssaadhaar.$visAssvoter.$visAsspan.$visAssdl.$visAsspass.$visAssother);

    // $sqlVisIn = "INSERT INTO `vistor_log`(`vis_dt`, `vis_name`, `vis_eta`, `vis_ata`, `vis_assname`, `vis_filledby`, `vis_tomeet`, `vis_meetroom`, `vis_idno`, `vis_assidno`, `vis_kycstat`, `vis_address`, `vis_email`, `vis_comment`) VALUES ('$dateTime','$vis_name','$vis_ETA','$vis_ATA','$vis_assName','$form_filler','$visitingPerson','$visitingMeetRoom','$visIdNo','$visAssIdNo','$visKYCStat','$visAddress','$visEmail','$visComment')";
    $sqlVisIn1 = "INSERT INTO `visitor_log_main`(`vis_name`, `vis_filledby`) VALUES ('$vis_name','$form_filler')";
    $resultVisIn1 = mysqli_query($conn, $sqlVisIn1);

    if ($resultVisIn1 == true) {
        $sqlVisRetriv = "SELECT * FROM `visitor_log_main` WHERE `vis_name` = '$vis_name' ";
        $resultVisRetriv = mysqli_query($conn, $sqlVisRetriv);
        $rowVisRetriv = mysqli_fetch_assoc($resultVisRetriv);
        $visUNQID = $rowVisRetriv['vis_unq_id'];
        $sqlVisIn2 = "INSERT INTO `visitor_log`(`vis_unqidno`, `vis_dt`, `vis_eta`, `vis_ata`, `vis_assname`, `vis_tomeet`, `vis_meetroom`, `vis_idno`, `vis_assidno`, `vis_kycstat`, `vis_address`, `vis_email`, `vis_comment`) VALUES ('$visUNQID','$dateTime','$vis_ETA','$vis_ATA','$vis_assName','$visitingPerson','$visitingMeetRoom','$visIdNo','$visAssIdNo','$visKYCStat','$visAddress','$visEmail','$visComment')";
        $resultVisIn2 = mysqli_query($conn, $sqlVisIn2);
    }


    /*$sqlVisUnqId = "SELECT `vis_unqidno` FROM `vistor_log` WHERE `vis_dt`='$dateTime' AND `vis_name`='$vis_name'";
        $resultVisUnqId = mysqli_query($conn, $sqlVisUnqId);
        $rowVisUnqId = mysqli_fetch_assoc($resultVisUnqId);
        $visUnqId = $rowVisUnqId['vis_unqidno'];*/
    // echo $visUnqId;
    if ($resultVisIn2 == true) {
        // File uploads (the ID proofs pics storing in specific folders named as the visitor's name)
        date_default_timezone_set('Asia/Kolkata');
        $datestamp = date("d-m-Y");
        $vis_IdNofull = "ENV-" . $visUNQID . "-VSTR-" . $datestamp;
        $parentFolderPath = "../upload/visitorLogBook/";
        $newFolderName = $vis_name . "_" . $vis_IdNofull . "/";
        $newFolderPath = $parentFolderPath . $newFolderName;
        //echo $newFolderPath;

        $visfilesName = $_FILES['visidproofpics']['name'];
        $visfilesTName = $_FILES['visidproofpics']['tmp_name'];

        $visAssfilesName = $_FILES['visAssidproofpics']['name'];
        $visAssfilesTName = $_FILES['visAssidproofpics']['tmp_name'];

        $visfinalDestination = '';
        $visAssfinalDestination = '';

        // Create a new folder if it doesn't exist
        if (!file_exists($newFolderPath)) {
            mkdir($newFolderPath, 0777, true);
        }
        //Temp variable to hold the loop success value
        $vis_temp = 0;
        $visass_temp = 0;

        for ($i = 0; $i < sizeof($visfilesName); $i++) {
            $visfinalDestination = $newFolderPath . $visfilesName[$i];
            move_uploaded_file($visfilesTName[$i], $visfinalDestination);
            $vis_temp++;
        }
        for ($j = 0; $j < sizeof($visAssfilesName); $j++) {
            $visAssfinalDestination = $newFolderPath . $visAssfilesName[$j];
            move_uploaded_file($visAssfilesTName[$j], $visAssfinalDestination);
            $visass_temp++;
        }
        

        if ($vis_temp == sizeof($visfilesName) && $visass_temp == sizeof($visAssfilesName)) {
            header("location:../action/visitor_log.php?True");
        } else {
            header("location:../action/visitor_log.php?Error");
        }
    }
}
