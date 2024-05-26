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
function get_mac()
{
    ob_start(); // Turn on output buffering
    system('ipconfig /all'); //Execute external program to display output
    $mycom = ob_get_contents(); // Capture the output into a variable
    ob_clean(); // Clean the output buffer

    $find_word = "Physical";
    $pmac = strpos($mycom, $find_word); // Find the position of Physical text in array
    $mac = substr($mycom, ($pmac + 36), 17); // Get Physical Address

    print_r($mac) ;
}
// $mac = shell_exec("arp -a ".escapeshellarg($_SERVER['REMOTE_ADDR'])." | grep -o -E '(:xdigit:{1,2}:){5}:xdigit:{1,2}'");
// echo $mac;
get_mac();
?>