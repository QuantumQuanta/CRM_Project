<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == '2NDRESP' || $_SESSION['desg_code'] == 'CEO') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
    $desgCode = $_SESSION['desg_code'];
} else {
    header("location: ../action/index.php");
}
?>
<?php
require '../constant/userActivityfn.php';
$_SESSION['LAST_ACTIVE_TIME'] = time();
?>

<!doctype html>
<html lang="en">

<head>
    <script src="../script/backPre.js" type="text/javascript"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../stylesheet/c_requirement.css">
    <title>priority_task</title>
</head>

<body>
    <div id="contentMain">
        <?php require '../layout/sidebar.php'; ?>
        <div id="contentBody">
            <?php
            require '../layout/header_login.php';
            ?>
            <div class="container" id="cReqTableDiv">
                <table>
                    <thead>
                        <tr>
                            <th>C-Id</th>
                            <th>Client Name (with S&C)</th>
                            <th>Priority</th>
                            <th>Proposal Shared On</th>
                            <th>Proposal Details</th>
                            <th>Proposal Site</th>
                            <th>Proposal State</th>
                            <th>Quote</th>
                            <th>Remarks</th>
                            <th>Verified</th>
                            <th>Verified by Name</th>
                            <th>Further Assigned To</th>
                            <th>F.S.A. Details</th>
                            <th>Through Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>


        </div>
    </div>
    <?php
    require '../layout/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../script/jQuery3.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../script/activity_stat.js" type="text/javascript"></script>
</body>

</html>