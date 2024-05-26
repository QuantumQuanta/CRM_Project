<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function fileFilter($uploadedFile, $fileErr)
{
    if ($fileErr == UPLOAD_ERR_OK) {
        $fileType = mime_content_type($uploadedFile);
        if (strpos($fileType, "image") !== false) {
            return true;
        } else {
            return false;
        }
    } else {

        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    global $ticket, $fileFlag;
    $fileFlag = false;
    require '../constant/db_connect.php';

    // Assuming form fields are present and not empty, you might want to add validation
    $emp_name = $_POST['contact_admin_name'];
    $emp_id = $_POST['contact_admin_empid'];
    $emp_email = $_POST['contact_admin_email'];
    $emp_issue = $_POST['contact_admin_issue'];
    $emp_dt = $_POST['contact_admin_dt'];
    $ticket = mt_rand(10000, 99999);
    $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $image_name = $_FILES['contact_admin_ss']['name'];
    $image_tname = $_FILES['contact_admin_ss']['tmp_name'];
    $file_error = $_FILES['contact_admin_ss']['error'];
    $folder = '/var/www/html/upload/contact_admin_data/';
    // var_dump($_FILES);
    // Create a unique file name based on the ticket number
    $unique_file_name = $ticket . '_' . $image_name;
    $full_path = $folder . $unique_file_name;


    // Prepare the SQL statement with placeholders
    $sql_contact_admin = "INSERT INTO `contact_admin_data`(`emp_name`, `emp_id`, `emp_email`, `emp_issue`, `emp_dt`, `screen_shot`, `sys_name`, `ticket_no`) VALUES (?,?,?,?,?,?,?,?)";

    // Initialize the prepared statement
    $stmt_contact_admin = mysqli_prepare($conn, $sql_contact_admin);

    // Bind parameters
    mysqli_stmt_bind_param($stmt_contact_admin, "sissssss", $emp_name, $emp_id, $emp_email, $emp_issue, $emp_dt, $full_path, $hostname, $ticket);
    // mysqli_stmt_execute($stmt_contact_admin);
    if (mysqli_stmt_execute($stmt_contact_admin)) {
        if (fileFilter($image_tname, $file_error) == true) {
            // Move uploaded file after successful execution
            $moved = move_uploaded_file($image_tname, $full_path);
            if ($moved === true) {
                // echo "Successful upload!";
                $fileFlag = true;
            } else {
                // echo "Unsuccessful upload!";
                $fileFlag = false;
            }
        } else {
            // echo "Error in uploading! Something fishy in the uploaded file";
            $fileFlag = false;
        }
    } else {
        // Handle error, if needed
        echo "Error in prepared statement execution: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt_contact_admin);
    // echo $emp_name . "|" . $emp_id . "|" . $emp_email . "|" . $emp_issue . "|" . $emp_dt . "|" . $ticket . "|" . $hostname . "|" . $full_path;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>issue_ticket</title>
</head>

<body>
    <h1>Your concern has been reported to the administrator.</h1>
    <?php
    if ($fileFlag == true) {
        echo "
            <h5>The administrator will get in touch soon. Keep your specific ticket number close by.</h5>
            <h3>Here is your ticket against the request:<strong> " . $ticket . "</strong></h3>
            ";
    } else {
        echo "
        <h5>Looks like the file you have uploaded is malicious</h5>
        ";
    }
    ?>
    <h3>You will be automatically redirected to the index page in <span id="counterId"></span></h3>
    <script>
        var count = 10;
        setInterval(function() {
            var counterId = document.getElementById('counterId');
            counterId.innerHTML = count;
            count -= 1;
        }, 1000);
        setTimeout(function() {
            window.location.href = '../action/index.php';
        }, 10000);
    </script>
</body>

</html>