<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'PRO' || $_SESSION['desg_code'] == 'CEO' || $_SESSION['desg_code'] == '2NDRESP') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
    $desgCode = $_SESSION['desg_code'];
    $user_uniqueId = $_SESSION['user_id_no'];
} else {
    header("location: ../action/index.php");
}
?>
<?php
require '../constant/userActivityfn.php';
$_SESSION['LAST_ACTIVE_TIME'] = time();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../script/backPre.js" type="text/javascript"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheet/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="../stylesheet/statistics_table.css">
    <link rel="stylesheet" href="../stylesheet/statistics_style.css">
    <link rel="stylesheet" href="../stylesheet/statistic_PRO_2ndResp.css">
    <link rel="stylesheet" href="../stylesheet/ceo_stat.css">
    <title>statistics</title>
</head>

<body>
    <div id="contentMain">
        <?php require '../layout/sidebar.php'; ?>
        <div id="contentBody">
            <!--heder top body End-->
            <?php
            require '../layout/header_login.php';
            ?>
            <p id="userNameP" style="display: none;"><?php echo $user_name; ?></p>
            <?php
            // segregation based on user desg_code
            try {
                switch ($desgCode) {
                    case "PRO":
                        require '../action/statisticPages/statistic_PRO.php';
                        break;
                    case "2NDRESP":
                        require '../action/statisticPages/statistic_2RESP.php';
                        break;
                    case "CEO":
                        require '../action/statisticPages/statistic_CEO.php';
                        break;
                    default:
                        throw new Exception("Invalid User Designation Code!");
                        break;
                }
            } catch (Exception $e) {
                echo "Error:" . $e->getMessage();
            }


            ?>
            <!--Table Div Start-->
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-center">
                    <h3 id="statTableHeading" class="tableheading">~:Data will be displayed in tabular format:~</h3>
                </div>
                <div id="statTableDiv" class="df-css" style="display: none;">
                    <div id="statTablebtnDiv">
                        <input type="text" class="cd-search table-filter" data-table="order-table" placeholder="Search..." />
                    </div>
                    <table id="statDataDisTable" class="order-table">

                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="../script/jQuery3.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" type="text/javascript"></script> -->
    <script src="../script/statTableFn.js" type="text/javascript"></script>
    <script src="../script/statistics_scripts.js" type="text/javascript"></script>
    <script src="../script/ceo_statistic.js" type="text/javascript"></script>
    <script src="../script/ceo_statistic2.js" type="text/javascript"></script>
    <script src="../script/ceoRespStat_config.js" type="text/javascript"></script>
    <script src="../script/activity_stat.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dropDown').click(function() {
                $('.drop-down').toggleClass('drop-down--active');
            });
        });
    </script>
</body>

</html>