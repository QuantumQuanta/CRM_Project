<?php
require '../action/session_control.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location:../action/index.php");
} else if ($_SESSION['desg_code'] == 'PRO' || $_SESSION['desg_code'] == '2NDRESP') {
	$user_id = $_SESSION['username'];
	$user_name = $_SESSION['name'];
	$user_unqId = $_SESSION['user_id_no'];
} else if ($_SESSION['desg_code'] == 'CEO' || $_SESSION['desg_code'] == 'CRTR') {
	$user_id = $_SESSION['username'];
	$user_name = $_SESSION['name'];
	$user_unqId = $_SESSION['user_id_no'];
} else {
	header("location:../action/index.php");
}
?>

<?php
// require '../constant/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	require '../constant/db_connect.php';
	$curr_time = $_POST['time'];
	$curr_date = $_POST['curr_date'];
	$notifications = array();

	// Assuming $conn is your database connection
	$stmt = $conn->prepare("SELECT * FROM `reminder_table` WHERE `date` = ? AND (userid = ? OR FIND_IN_SET(?, sharewith) > 0) ORDER BY `time` DESC");
	$stmt->bind_param("ssi", $curr_date, $user_id, $user_unqId);

	// Execute the prepared statement
	$stmt->execute();

	// Get the result set
	$result = $stmt->get_result();

	// Fetch data and store in the $notifications array
	while ($row1 = $result->fetch_assoc()) {
		$notifications[] = $row1;
	}

	// Close the statement
	$stmt->close();

	// Return the JSON-encoded array
	echo json_encode($notifications);
}

?>