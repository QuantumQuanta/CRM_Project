<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
} else {
    $loggedin = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheet/ReminAtTime.css">
    <title>Document</title>
</head>

<body>
    <div class="toast-container  end-0 p-3" style="display:none;" id="notify_container">
    </div>
</body>

</html>