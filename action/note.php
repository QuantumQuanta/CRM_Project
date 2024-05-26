<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>note</title>
    <link rel="stylesheet" href="../stylesheet/note.css">

</head>

<body>
    <div id="contentMain">
        <?php require '../layout/sidebar.php'; ?>
        <div id="contentBody">
            <!--heder top body End-->
            <?php
            require '../layout/header_login.php';
            ?>
            <div class="container my-3">
                <div class="noteRow">
                    <div class="noteCol1" id="noteCol1">
                        <!-- <hr> -->
                        <!-- <h1>Your Notes</h1> -->
                        <!-- <hr> -->
                        <div id="notes" class="row container-fluid">
                            <?php
                            require '../constant/db_connect.php';
                            $sql_note_data_fetch = "SELECT * FROM `notes_data` where `userId`='$user_id';";
                            $result_note_data_fetch = mysqli_query($conn, $sql_note_data_fetch);
                            $sl_no = 1;
                            while ($row_note_data_fetch = mysqli_fetch_assoc($result_note_data_fetch)) {
                                $note_title = $row_note_data_fetch['note_title'];
                                echo '
                                    <div class="noteCard my-2 mx-2 card" style="width: 18rem;" id="noteCard' . $sl_no . '">
                                    <div class="card-body">';
                                if (empty($note_title) || is_null($note_title)) {
                                    echo '<h4 class="noteCard-title">Note' . $sl_no . '</h4>';
                                } else {
                                    echo '<h4 class="noteCard-title">' . $note_title . '</h4>';
                                }

                                echo '
                                        <p class="noteCardDate">' . $row_note_data_fetch['submitdate'] . '</p>
                                        <p class="noteCardDate">' . $row_note_data_fetch['time'] . '</p>
                                        <p class="card-text">' . $row_note_data_fetch['note'] . '</p>
                                        <a  href="note_delete.php?id=' . $row_note_data_fetch['slno'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are You Sure ?\')"><img src="../image/delete_FILL.png" alt="delete notes Image"></a>
                                    </div>
                                    </div>';
                                $sl_no++;
                            }
                            ?>

                        </div>
                    </div>
                    <div class="noteCol2" id="noteCol2" style="display: none;">
                        <div class="formNote_card">
                            <form action="../action/note_config.php" method="post">
                                <div class="card-body">
                                    <div class="note_headDiv" id="note_headDiv">
                                        <img src="../image/note_Img/notes.png" alt="notes Image">
                                        <h1>Notes</h1>
                                    </div>
                                    <div class="form-group">
                                        <textarea placeholder="Title" class="form-control" id="addTitle" name="addTitle" rows="2" cols="100"></textarea>
                                        <textarea placeholder="Take a note..." class="form-control" id="addTxt" name="addTxt" rows="4" cols="100"></textarea>
                                    </div>
                                    <?php
                                    date_default_timezone_set('Asia/Kolkata');
                                    $date = date("Y-m-d H:i:s"); //dS F Y, g:i A
                                    // print_r($date);
                                    echo '
                                        <input type="hidden" id="pro_name" name="pro_name" value="' . $user_id . '">'
                                    ?>

                                    <button class="btn btn-primary" id="addBtn" name="addNoteBtn">Add Note</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="noteCol3">
                        <button class="btn btn-primary" id="createNoteBtn" name="createNoteBtn"><i class="fa-solid fa-pen-to-square"></i></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php
    require '../layout/footer.php';
    ?>
</body>
<script src="../script/fontawesomeJS.js"></script>
<script src="../script/note.js"></script>

</html>