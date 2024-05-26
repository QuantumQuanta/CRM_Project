src="../script/dateWiseRec.js" type="text/javscript"

2.Dropdown with value implemented for each client segregationdepend upon user input(pcr_pt,pcr_resp,pcr_prc etc.)
<!DOCTYPE html>KBrzH JKHJ561018
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container" id="edit_modal_div">
        <!-- Modal    tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" -->
        <div class="modal fade" id="editModal" style="display: none">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Edit Details</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="#" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="editUniqIds" id="editUniqIds" value="">
                            <label for="editDOC">DOC</label>
                            <input type="date" id="editDOC" name="editDOC" value="">
                            <br>
                            <label for="editDOA1">DOA-1</label>
                            <input type="date" id="editDOA1" name="editDOA1" value="">
                            <br>
                            <label for="editPeriod">Period</label>
                            <input type="text" id="editPeriod" name="editPeriod" value="">
                            <br>
                            <label for="editCode">Code</label>
                            <input type="text" id="editCode" name="editCode" value="">
                            <br>
                            <label for="editClientName">Client Name</label>
                            <input type="text" id="editClientName" name="editClientName" value="">
                            <br>
                            <label for="editClientState">Client State</label>
                            <select id="editClientState" name="editClientState">
                                <option value="#" selected>Choose</option>
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
                                <option value="OR">Orissa/Odisha</option>
                                <option value="PB">Punjab</option>
                                <option value="PY">Pondicherry/Puducherry</option>
                                <option value="RJ">Rajasthan</option>
                                <option value="SK">Sikkim</option>
                                <option value="TG">Telangana</option>
                                <option value="TN">Tamil Nadu</option>
                                <option value="TR">Tripura</option>
                                <option value="UK">Uttarakhand</option>
                                <option value="UP">Uttar Pradesh</option>
                                <option value="WB">West Bengal</option>
                                <option value="NP">Nepal</option>
                                <option value="Mum">Mumbai</option>
                                <option value="Kol">Kolkata</option>
                                <option value="UP(E)">UP(E)</option>
                                <option value="UP(W)">UP(W)</option>
                                <option value="NE">NE</option>
                            </select>
                            <br>
                            <label for="editClientContact">Client Contact</label>
                            <input type="text" id="editClientContact" name="editClientContact" value="">
                            <br>
                            <label for="editBCR">BCR</label>
                            <input type="text" id="editBCR" name="editBCR" value="">
                            <br>
                            <label for="editVerified">Verified</label>
                            <input type="text" id="editVerified" name="editVerified" value="">
                            <br>
                            <label for="editPCR">PCR</label>
                            <input type="text" id="editPCR" name="editPCR" value="">
                            <br>
                            <label for="edit1Resp">1stResp</label>
                            <input type="text" id="edit1Resp" name="edit1Resp" value="">
                            <br>
                            <label for="editDOA2">DOA-2</label>
                            <input type="date" id="editDOA2" name="editDOA2" value="">
                            <br>
                            <label for="edit2Resp">2ndResp</label>
                            <input type="text" id="edit2Resp" name="edit2Resp" value="">
                            <br>
                            <label for="editDOA3">DOA-3</label>
                            <input type="date" id="editDOA3" name="editDOA3" value="">
                            <br>
                            <label for="edit3Resp">3rdResp</label>
                            <input type="text" id="edit3Resp" name="edit3Resp" value="">
                            <br>
                            <label for="editRemarks">Remarks</label>
                            <input type="text" id="editRemarks" name="editRemarks" value="">
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="edit_client_save" name="edit_client_save">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
for (i = 0; i < dataSetNum; i++) { var divExsist=document.getElementById('visitorData' + i) !==null; if (!divExsist) { visitorDataDisplay(i); //Creating New p tags and label for data display targetDiv=document.getElementById('visitorData' + i); let visDataLabel=document.createElement('label'); let visDataETA=document.createElement('p'); let visDataATA=document.createElement('p'); let visDataAssname=document.createElement('p'); let visDataTomeet=document.createElement('p'); let visDataMeetroom=document.createElement('p'); let visDataIdno=document.createElement('p'); let visDataAssIdno=document.createElement('p'); let visDataKyc=document.createElement('p'); let visDataAddr=document.createElement('p'); let visDataEmail=document.createElement('p'); let visDataComment=document.createElement('p'); let visDatabreak=document.createElement('br'); //Setting up value for the created elements visDataETA.textContent="Estimated Time of Arrival :" + visallData['vis_eta' + i]; visDataATA.textContent="Actual Time of Arrival :" + visallData['vis_ata' + i]; visDataAssname.textContent="Associates' Name :" + visallData['vis_assname' + i]; visDataTomeet.textContent="Came To Meet :" + visallData['vis_tomeet' + i]; visDataMeetroom.textContent="Meeting Room :" + visallData['vis_meetroom' + i]; visDataIdno.textContent="Visitor's Identity No. :" + visallData['vis_idno' + i]; visDataAssIdno.textContent="Associates' Identity No. :" + visallData['vis_assidno' + i]; visDataKyc.textContent="KYC Status :" + visallData['vis_kycstat' + i]; visDataAddr.textContent="Visitor's Address :" + visallData['vis_address' + i]; visDataEmail.textContent="Visitor's Email Id :" + visallData['vis_email' + i]; visDataComment.textContent="Some comments on the visit :" + visallData['vis_comment' + i]; visDataLabel.textContent=visallData['vis_dt' + i]; //Appending 'em on the website' s specific division targetDiv.appendChild(visDataLabel); targetDiv.appendChild(visDataETA); targetDiv.appendChild(visDataATA); targetDiv.appendChild(visDataAssname); targetDiv.appendChild(visDataTomeet); targetDiv.appendChild(visDataMeetroom); targetDiv.appendChild(visDataIdno); targetDiv.appendChild(visDataAssIdno); targetDiv.appendChild(visDataKyc); targetDiv.appendChild(visDataAddr); targetDiv.appendChild(visDataEmail); targetDiv.appendChild(visDataComment); targetDiv.appendChild(visDatabreak); } } function visitorDataDisplay(rowNum) { visDiv=document.getElementById('visDataModalbody'); let visDataDis=document.createElement('div'); // visDataDis.setAttribute('class','visitorData'); visDataDis.setAttribute('id', 'visitorData' + rowNum); visDataDis.setAttribute('class','visitorData'); visDiv.appendChild(visDataDis); } <div class="container">
    <div class="container visitorlogTable">
        <table id="visitor_log_table1">
            <thead>
                <tr>
                    <th>Download</th>
                    <th>Visitor's Id No.</th>
                    <th>Visitor's Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require '../constant/db_connect.php';
                require '../constant/encrypt_decrypt.php';

                $sqlVisData1 = "SELECT * FROM `visitor_log_main`";
                $resVisData1 = mysqli_query($conn, $sqlVisData1);
                date_default_timezone_set('Asia/Kolkata');
                while ($rowVisData1 = mysqli_fetch_assoc($resVisData1)) {
                    $unqvisIDno = encryptData($rowVisData1['vis_unq_id']);
                    echo '
                                    <tr>
                                        <td>
                                            <a href="../action/downloadVisData.php?data=' . $unqvisIDno . '">
                                                Download
                                            </a>
                                        </td>
                                        <td>ENV-' . $rowVisData1['vis_unq_id'] . '-' . 'VSTR</td>
                                        <td>' . $rowVisData1['vis_name'] . '</td>
                                    </tr>
                                    ';
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>


    <?php

    if ($res_client_PCRPT) {
        $arr['res_client_PCRPT' . $i] = true;
    } else {
        $arr['res_client_PCRPT' . $i] = false;
    }


    if ($res_client_PCRRESP) {
        $arr['res_client_PCRRESP' . $i] = true;
    } else {
        $arr['res_client_PCRRESP' . $i] = false;
    }


    if ($res_client_PCRPRC) {
        $arr['res_client_PCRPRC' . $i] = true;
    } else {
        $arr['res_client_PCRPRC' . $i] = false;
    }


    if ($res_client_PCRCR) {
        $arr['res_client_PCRCR' . $i] = true;
    } else {
        $arr['res_client_PCRCR' . $i] = false;
    }


    if ($res_client_CS) {
        $arr['res_client_CS' . $i] = true;
    } else {
        $arr['res_client_CS' . $i] = false;
    }
    ?>