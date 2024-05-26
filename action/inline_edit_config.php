<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  require '../constant/db_connect.php';
  $orig_Text = $_POST['orig_Text'];
  $current_Text = $_POST['current_Text'];
  $th_name = $_POST['header_col'];
  $clientUId = $_POST['clientUId'];
  $res_val;
  $sql_activity_stat;


  // echo json_encode($orig_Text . ' ' . $current_Text . ' ' . $th_name . ' ' . $clientUId);
  if ($th_name === 'doc') {
    $sql_activity_stat = !$orig_Text ?
      "UPDATE `crm_master_table` SET `doc`='$current_Text' WHERE  (`doc` IS NULL OR `doc`='') AND `uniq_id`='$clientUId'"
      :
      "UPDATE `crm_master_table` SET `doc`='$current_Text' WHERE  `doc`='$orig_Text' AND `uniq_id`='$clientUId'";
  }
  if ($th_name === 'doa_1') {
    $sql_activity_stat = !$orig_Text ?
      "UPDATE `crm_master_table` SET `doa_1`='$current_Text' WHERE  (`doa_1` IS NULL OR `doa_1`='') AND `uniq_id`='$clientUId'"
      :
      "UPDATE `crm_master_table` SET `doa_1`='$current_Text' WHERE  `doa_1`='$orig_Text' AND `uniq_id`='$clientUId'";
  }
  if ($th_name === 'period') {
    $sql_activity_stat = !$orig_Text ?
      "UPDATE `crm_master_table` SET `period`='$current_Text' WHERE  (`period` IS NULL OR `period`='') AND `uniq_id`='$clientUId'"
      :
      "UPDATE `crm_master_table` SET `period`='$current_Text' WHERE  `period`='$orig_Text' AND `uniq_id`='$clientUId'";
  }
  if ($th_name === 'client_contact') {
    $sql_activity_stat = !$orig_Text ?
      "UPDATE `crm_master_table` SET `client_contact`='$current_Text' WHERE  (`client_contact` IS NULL OR `client_contact`='') AND `uniq_id`='$clientUId'"
      :
      "UPDATE `crm_master_table` SET `client_contact`='$current_Text' WHERE  `client_contact`='$orig_Text' AND `uniq_id`='$clientUId'";
  }
  if ($th_name === 'bcr') {
    $sql_activity_stat = !$orig_Text ?
      "UPDATE `crm_master_table` SET `bcr`='$current_Text' WHERE  (`bcr` IS NULL OR `bcr`='') AND `uniq_id`='$clientUId'"
      :
      "UPDATE `crm_master_table` SET `bcr`='$current_Text' WHERE  `bcr`='$orig_Text' AND `uniq_id`='$clientUId'";
  }
  if ($th_name === 'verified') {
    $sql_activity_stat = !$orig_Text ?
      "UPDATE `crm_master_table` SET `verified`='$current_Text' WHERE  (`verified` IS NULL OR `verified`='') AND `uniq_id`='$clientUId'"
      :
      "UPDATE `crm_master_table` SET `verified`='$current_Text' WHERE  `verified`='$orig_Text' AND `uniq_id`='$clientUId'";
  }
  if ($th_name === 'pcr') {
    $sql_activity_stat = !$orig_Text ?
      "UPDATE `crm_master_table` SET `pcr`='$current_Text' WHERE  (`pcr` IS NULL OR `pcr`='') AND `uniq_id`='$clientUId'"
      :
      "UPDATE `crm_master_table` SET `pcr`='$current_Text' WHERE  `pcr`='$orig_Text' AND `uniq_id`='$clientUId'";
  }

  if ($th_name === 'doa_2') {
    $sql_activity_stat = !$orig_Text ?
      "UPDATE `crm_master_table` SET `doa_2`='$current_Text' WHERE  (`doa_2` IS NULL OR `doa_2`='') AND `uniq_id`='$clientUId'"
      :
      "UPDATE `crm_master_table` SET `doa_2`='$current_Text' WHERE  `doa_2`='$orig_Text' AND `uniq_id`='$clientUId'";
  }

  if ($th_name === 'doa_3') {
    $sql_activity_stat = !$orig_Text ?
      "UPDATE `crm_master_table` SET `doa_3`='$current_Text' WHERE  (`doa_3` IS NULL OR `doa_3`='') AND `uniq_id`='$clientUId'"
      :
      "UPDATE `crm_master_table` SET `doa_3`='$current_Text' WHERE  `doa_3`='$orig_Text' AND `uniq_id`='$clientUId'";
  }

  if ($th_name === 'remarks') {
    $sql_activity_stat = !$orig_Text ?
      "UPDATE `crm_master_table` SET `remarks`='$current_Text' WHERE  (`remarks` IS NULL OR `remarks`='') AND `uniq_id`='$clientUId'"
      :
      "UPDATE `crm_master_table` SET `remarks`='$current_Text' WHERE  `remarks`='$orig_Text' AND `uniq_id`='$clientUId'";
  }
  if ($th_name === 'client_email') {
    $sql_activity_stat = !$orig_Text ?
      "UPDATE `crm_master_table` SET `client_email`='$current_Text' WHERE  (`client_email` IS NULL OR `client_email`='') AND `uniq_id`='$clientUId'"
      :
      "UPDATE `crm_master_table` SET `client_email`='$current_Text' WHERE  `client_email`='$orig_Text' AND `uniq_id`='$clientUId'";
  }




  // echo json_encode($sql_activity_stat);
  $result_activity_stat = mysqli_query($conn, $sql_activity_stat);
  if ($result_activity_stat) {
    $res_val = 'Successfully inserted';
  } else {
    $res_val = 'fail';
  }
  // $res_val['orig_Text']=$orig_Text;
  // $res_val['current_Text']=$current_Text;
  // $res_val['th_name']=$th_name;
  // $res_val['clientUId']=$clientUId;

  echo json_encode($sql_activity_stat);

  
}
