<?php
if (isset($_POST['action_title'])) {
  require '../constant/db_connect.php';
  $pres_val = $_POST['orig_Text'];
  $update_val = $_POST['current_Text'];
  $th_name = $_POST['header_col'];
  $clientUId = $_POST['clientUId'];
  $res_val1;
  $sql_activity_stat1;

  if ($th_name === '1st_resp') {
      $sql_activity_stat1 = !$pres_val ?
          "UPDATE `crm_master_table` SET `1st_resp`=? WHERE (`1st_resp` IS NULL OR `1st_resp`='') AND `uniq_id`=?" :
          "UPDATE `crm_master_table` SET `1st_resp`=? WHERE `1st_resp`=? AND `uniq_id`=?";
  } elseif ($th_name === '2nd_resp') {
      $sql_activity_stat1 = !$pres_val ?
          "UPDATE `crm_master_table` SET `2nd_resp`=? WHERE (`2nd_resp` IS NULL OR `2nd_resp`='') AND `uniq_id`=?" :
          "UPDATE `crm_master_table` SET `2nd_resp`=? WHERE `2nd_resp`=? AND `uniq_id`=?";
  } elseif ($th_name === '3rd_resp') {
      $sql_activity_stat1 = !$pres_val ?
          "UPDATE `crm_master_table` SET `3rd_resp`=? WHERE (`3rd_resp` IS NULL OR `3rd_resp`='') AND `uniq_id`=?" :
          "UPDATE `crm_master_table` SET `3rd_resp`=? WHERE `3rd_resp`=? AND `uniq_id`=?";
  }

  // Prepare and bind parameters
  $stmt = mysqli_prepare($conn, $sql_activity_stat1);
  if ($stmt) {
      if (!$pres_val) {
          mysqli_stmt_bind_param($stmt, "si", $update_val, $clientUId);
      } else {
          mysqli_stmt_bind_param($stmt, "ssi", $update_val, $pres_val, $clientUId);
      }

      // Execute the statement
      mysqli_stmt_execute($stmt);

      // Close the statement
      mysqli_stmt_close($stmt);

      $res_val1 = 'Successfully inserted';
  } else {
      $res_val1 = 'fail';
  }

  echo json_encode($sql_activity_stat1);
}
if ($_POST['client_ddUpdate']) {
    if($_POST['clientid']){
        require '../constant/db_connect.php';
        $id = $_POST['clientid'];
        $name=$_POST['name'];
        $code=$_POST['code'];
        $state=$_POST['state'];
        $sql = "UPDATE `crm_master_table` SET `client_name`='$name',`client_state`='$state',`code`='$code'  WHERE  `uniq_id`=$id";
        $query = mysqli_query($conn, $sql);
        
        if ($query) {
            $data=array('Successfully updated');
            echo json_encode($data);
        } else {
            // No users are available to chat
            $Result = array("No client");
            echo json_encode($Result);
        }
    }   

}