<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'CEO' || $_SESSION['desg_code'] == 'CRTR') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
    //$message = $_SESSION['msg'];
} else {
    header("location: ../action/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Assignment</title>
    <link rel="stylesheet" href="../stylesheet/ceo_client_assign.css">
</head>

<body>
    <div id="contentMain">
        <?php require '../layout/sidebar.php'; ?>
        <div id="contentBody">
            <?php
            require '../layout/header_login.php';
            ?>
            <h2 id="H_asgclnt" name="H_asgclnt">Assign Clients</h2>
            <!--Assignation Table-->
            <div id="assignTableCont" class="ceoAsgTable-wrapper">
                <div class="container">
                    <div class="col1">
                        <textarea class="assignTextArea" name="clientAssgInput" id="clientAssgInput" placeholder="Enter bulk data here..">
                        </textarea>
                    </div>
                    <div class="col2">
                        <button class="addRow-btn" id="assg_addRowBtn" name="assg_addRowBtn">Add-Single</button>
                        <button class="addRow-btn" id="assg_addBlkBtn" name="assg_addBlkBtn">Add-Bulk</button>
                    </div>
                </div>

                <br>&nbsp<br>
                <div class="container">
                    <button class="assgUpload-btn" type="submit" id="ceoAssgupload" name="ceoAssgupload">UPLOAD</button>
                </div>
                <br>&nbsp<br>
                <div class="assign_tableDiv" style="overflow-x:auto;">
                    <table id="assign_table" class="ceoAsgTable">
                        <thead>
                            <tr>
                                <th>Slno</th>
                                <th>DOC</th>
                                <th>Client Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Code</th>
                                <th>Period</th>
                                <th>Category</th>
                                <th>Reference</th>
                                <th>DOA-1</th>
                                <th>1Resp</th>
                                <th>DOA-2</th>
                                <th>2Resp</th>
                                <th>DOA-3</th>
                                <th>3Resp</th>
                                <th>comment_3resp</th>
                                <th>BCR</th>
                                <th>verified</th>
                                <th>pcr</th>
                                <th>remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <?php
    require '../layout/footer.php';
    ?>
    <script src="../script/JQuery_2.0.js" type="text/javascript"></script>
    <script src="../script/clientAssignCEOconfig.js" type="text/javascript"></script>

</body>

</html>