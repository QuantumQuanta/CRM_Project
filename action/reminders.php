<?php
require '../action/session_control.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: ../action/index.php");
} else {
  $user_id = $_SESSION['username'];
  $user_name = $_SESSION['name'];
  $user_desg = $_SESSION['desg_code'];
  $user_unqId = $_SESSION['user_id_no'];
}
?>
<?php
// require '../constant/userActivityfn.php';
// $_SESSION['LAST_ACTIVE_TIME'] = time();
?>
<!doctype html>
<html lang="en">

<head>
  <script src="../script/backPre.js" type="text/javascript"></script>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>reminders</title>
  <link rel="stylesheet" href="../stylesheet/reminders.css">
</head>

<body>
  <!-- page body with sidenav start -->
  <div id="contentMain">
    <?php require '../layout/sidebar.php'; ?>
    <div id="contentBody">
      <!--heder top body End-->
      <?php
      require '../layout/header_login.php';
      ?>
      <div class="rem-div">
        <div class="reminForm-popup" id="myForm" style="display: none;">
          <!-- <form onsubmit="return validateForm()" required> -->
          <div class="form-container1">
            <!-- <div class="reminSubContainer"> -->
              <div class="reminFormHeader">
                <p>Add Your Reminder</p>
                <button type="button" class="reminFormHeadBtn cancel" onclick="closeForm()"><i class="fa-solid fa-xmark"></i></button>
              </div>
              <div class="reminSubBody">
                <div class="reminFormBody" style="overflow: scroll;">
                  <?php
                  date_default_timezone_set('Asia/Kolkata');
                  $date = date("Y-m-d H:i:s");
                  echo '
                      <input type="hidden" id="userid" name="userid" value="' . $user_id . '">
                      <input type="hidden" id="user_name" name="user_name" value="' . $user_name . '">
                      <input type="hidden" id="userUnqId" name="userUnqId" value="' . $user_unqId . '">'
                  ?>
                  <div class="remincontain-row1">
                    <div class="reminForm__icon"><i class="fas fa-calendar-alt"></i></div>
                    <label for="remin_dT">SET DATE_TIME </label>
                    <input type="datetime-local" id="remin_dT" name="remin_dT" placeholder="dd-mm-yyyy" required>
                  </div>
                  <div class="remincontain-row3">
                    <div class="reminForm__icon"><i class="fas fa-star"></i></div>
                    <label for="priority">PRIORITY</label>
                    <select id="priority" name="priority">
                      <option selected disabled>Choose...</option>
                      <option value="alert-info">Normal</option>
                      <option value="alert-danger">Emergency</option>
                    </select>
                  </div>
                  <div class="remincontain-row3">
                    <div class="reminForm__icon"><i class="fas fa-star"></i></div>
                    <label for="remType">Reminder Type</label>
                    <select id="remType" name="remType">
                      <option selected disabled>Choose Type...</option>
                      <option value="Meeting">Meeting</option>
                      <option value="Others">Others</option>
                    </select>
                  </div>
                  <div class="remincontain-row2">
                    <div class="reminForm__icon"><i class="fa-solid fa-id-card"></i></div>
                    <label for="rem_title">Subject</label>
                    <input type='text' id="rem_title" name="rem_title" placeholder='Reminder title...'>
                  </div>
                  <div class="remincontain-row4">
                    <div class="reminForm__icon"><i class="fa-solid fa-comment"></i></div>
                    <label for="rem_details">DESCRIPTION</label>
                    <textarea style="min-height:2px;resize: none;" type='text' id="rem_details" name="rem_details" maxlength="250" placeholder='Drop Reminder Description...'></textarea>

                    <!-- <input type='text' id="reminder_cmnt" name="reminder_cmnt" maxlength="250" placeholder='Drop Reminder Description...'> -->
                  </div>
                  <div class="remincontain-row3">
                    <div class="reminForm__icon"><i class="fas fa-user-group"></i></div>
                    <label for="sharewith">SHARE PEOPLE</label>
                    <?php
                    require '../constant/db_connect.php';

                    $shareWith_sql = "SELECT * FROM `login_data` WHERE NOT `user` = ?";
                    $stmt_shareWith = mysqli_prepare($conn, $shareWith_sql);

                    if ($stmt_shareWith) {
                      // Bind parameters
                      mysqli_stmt_bind_param($stmt_shareWith, "s", $user_id);

                      // Execute the statement
                      mysqli_stmt_execute($stmt_shareWith);

                      // Get result
                      $shareWith_res = mysqli_stmt_get_result($stmt_shareWith);

                      if ($shareWith_res->num_rows > 0) {
                        echo '<select name="sherewith[]" id="sherewith" multiple data-live-search="false" >';

                        while ($row = mysqli_fetch_assoc($shareWith_res)) {
                          echo '<option name="sherewith[]" value="' . htmlspecialchars($row["id"]) . '">' . htmlspecialchars($row["name"]) . '</option>';
                        }

                        echo '</select>';
                      }
                    }

                    // Close the database connection if needed
                    mysqli_close($conn);
                    ?>
                  </div>
                  <div class="remincontain-row3">
                    <div class="reminForm__icon"><i class="fa-solid fa-list-ul"></i></div>
                    <div id="selectedItems">Selected items:</div>
                  </div>
                  <br>
                  <br>
                </div>
                <div class="remincontain-row3" style="color: red; justify-content: center;font-size: 15px;font-weight: 600;">
                  <div id="errorText"></div>
                </div>
              </div>
              <hr>
              <div class="formButton_div">
                <button type="submit" id="submit_remine_input" name="submit_remine_input" class="btn1">
                  SAVE
                </button>
              </div>
            <!-- </div> -->
          </div>
          <!-- </form> -->
        </div>
        <div class='col-md-4'>
          <div class='Subcol_md4'>
            <div class="openButton_div">
              <button class="open-button" onclick="openForm()">
                <span class="icon"><i class="fa-sharp fa-solid fa-plus"></i></span>
                Create
              </button>
            </div>
            <div class="wrapper">
              <header>
                <p class="current-date"></p>
                <div class="icons">
                  <span id="prev"><i class="fa-solid fa-chevron-left"></i></span>
                  <span id="next"><i class="fa-solid fa-chevron-right"></i></span>
                </div>
              </header>
              <div class="calendar">
                <ul class="weeks">
                  <li>S</li>
                  <li>M</li>
                  <li>T</li>
                  <li>W</li>
                  <li>T</li>
                  <li>F</li>
                  <li>S</li>
                </ul>
                <ul class="days"></ul>
              </div>
            </div>
            <h2 class="today_reminHead">Today's Schedule</h2>
            <div class="today_reminDiv" id="todayReminDiv">
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <h3>Reminders Log</h3>
          <table class="table_thead">
            <thead style="border-bottom: 1px solid;">
              <tr>
                <th class="slTh">Sl no.</th>
                <th class="DandTTh">Date AND Time</th>
                <th class="idTh">Subject</th>
                <th class="reminTh">Reminder Description</th>
                <th class="shareTh">Share With</th>
                <th class="delTh"></th>
              </tr>
            </thead>
          </table>
          <div class="col-md-1" id="rem_table1">
            <table class="table_thead2" style="overflow-y: auto; height:100%">
            </table>
          </div>

          <h3>Reminders Received</h3>
          <table class="table_thead">
            <thead style="border-bottom: 1px solid;">
              <tr>
                <th class="slTh">Sl no.</th>
                <th class="DandTTh">Date AND Time</th>
                <th class="idTh">Subject</th>
                <th class="reminTh">Reminder Description</th>
                <th class="shareTh">Share By</th>
                <th class="delTh"></th>
              </tr>
            </thead>
          </table>
          <div class="col-md-1" id="rem_table2">
            <table class="table_thead2" style="overflow-y: auto; height:100%">
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
  <?php
  require '../layout/footer.php';
  ?>



</body>
<script src="../script/bootstrap-select.js"></script>
<script src="../script/bootstrap_min.js"></script>
<script src="../script/fontawesomeJS.js"></script>

<script src="../script/activity_stat.js" type="text/javascript"></script>
<script src="../script/reminders_action.js" type="text/javascript"></script>
<script src="../script/reminderTable.js" type="text/javascript"></script>


</html>