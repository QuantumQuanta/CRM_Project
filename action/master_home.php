<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location:../action/index.php");
} else if ($_SESSION['desg_code'] == 'CEO' || $_SESSION['desg_code'] == 'CRTR') {
  $user_id = $_SESSION['username'];
  $user_name = $_SESSION['name'];
} else {
  header("location:../action/index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
  <script src="../script/backPre.js" type="text/javascript"></script>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ceo_home</title>
  <link rel="stylesheet" href="../stylesheet/master_home.css">

</head>

<body>
  <!-- page body with sidenav start -->
  <div id="contentMain">
    <?php require '../layout/sidebar.php'; ?>
    <div id="contentBody">
      <!--heder top body End-->

      <?php
      require '../layout/header_login.php';
      echo '<input id="user_name" value="' . $user_id . '" hidden/>';
      ?>
      <div class="position-relative1">
        <?php
        require '../layout/ReminAtTime.php';
        ?>
        <div class="clock">
          <div>
            <span id="hour">00</span>
            <span class="text">Hours</span>
          </div>

          <div>
            <span id="minute">00</span>
            <span class="text">Minutes</span>
          </div>

          <div>
            <span id="second">00</span>
            <span class="text">Seconds</span>
          </div>

          <div>
            <span id="ampm">AM</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  require '../layout/footer.php';
  ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../script/notificationAtTime.js" type="text/javascript"></script>
  <script src="../script/clock.js" type="text/javascript"></script>
  <script src="../script/fontawesomeJS.js"></script>


</body>

</html>