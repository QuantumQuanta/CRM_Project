    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        require '../constant/db_connect.php';

        for ($i = 0; $i < sizeof($_POST['uniqId2']); $i++) {
            $delval = $_POST['uniqId2'][$i];
            $sql_delete_client = "DELETE FROM `crm_master_table` WHERE `uniq_id`='$delval'";
            $result_delete_client = mysqli_query($conn, $sql_delete_client);
        }
        if ($result_delete_client) {
            echo json_encode('Records deleted successfully!');
        } else {
            echo json_encode('Deletion interrupted, Not successful!');
        }
    }

    /*   function delete_client()
    {
        require '../constant/db_connect.php';
        if (isset($_POST['action_uniq_id'])) {
            for ($i = 0; $i < sizeof($_POST['action_uniq_id']); $i++) {
                $delval = $_POST["action_uniq_id"][$i];
                $sql_delete_client = "DELETE FROM `crm_master_table` WHERE `uniq_id`='$delval'";
                $result_delete_client = mysqli_query($conn, $sql_delete_client);
            }
        }
        if ($result_delete_client) {
            header('location:../action/master_crm.php');
        }
    }
    /*
    function edit_client()
    {
        require '../constant/db_connect.php';
        if (isset($_POST['edt_uniq_id'])) {
            for ($i = 0; $i < sizeof($_POST['edt_uniq_id']); $i++) {
                /*$edtval = $_POST["edt_uniq_id"][$i];
                    $sql_update_client = "";
                    $result_update_client = mysqli_query($conn, $sql_update_client);
                $values[$i] = $_POST["edt_uniq_id"][$i];
            }
            //print_r($values);
        }
        header('location:../action/master_crm.php');
    }*/



    ?>

