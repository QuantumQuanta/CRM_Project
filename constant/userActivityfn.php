<?php
// session_start();

if (session_status() !== PHP_SESSION_ACTIVE) {
  require '../action/session_control.php';
  session_start();
}

if (isset($_SESSION['desg_code']) && ($_SESSION['desg_code'] !== 'CEO')) {
  if ((isset($_POST['type'])) && $_POST['type'] == 'ajax') {
    echo (time() - $_SESSION['LAST_ACTIVE_TIME']) > 2400 ? 'activity_check' : 'none';
  } else {
    if (isset($_SESSION['LAST_ACTIVE_TIME']) && ((time() - $_SESSION['LAST_ACTIVE_TIME']) > 2400)) {
      header("location: ../action/activity_status.php");
      die();
    }
  }
}
?>
