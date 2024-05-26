
<?php
if (isset($_POST['action_name'])) {
  require '../constant/db_connect.php';
  $presentname = $_POST['name_data'];
  $output = [];

  // Prepare the SQL statement
  $sql_all_DataFetch = "SELECT `name` FROM `login_data` WHERE NOT `name` = ?";
  
  // Prepare and bind the parameter
  $stmt = mysqli_prepare($conn, $sql_all_DataFetch);
  mysqli_stmt_bind_param($stmt, "s", $presentname);
  mysqli_stmt_execute($stmt);

  // Get the results
  $result_all_DataFetch = mysqli_stmt_get_result($stmt);

  while ($row_all_DataFetch = mysqli_fetch_assoc($result_all_DataFetch)) {
      $output[] = $row_all_DataFetch;
  }

  // Close the statement
  mysqli_stmt_close($stmt);

  echo json_encode($output);
}
