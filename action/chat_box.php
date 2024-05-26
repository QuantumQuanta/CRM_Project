<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'PRO' || $_SESSION['desg_code'] == 'CEO' || $_SESSION['desg_code'] == '2NDRESP') {
    $user_id_no = $_SESSION['user_id_no'];
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
} else {
    header("location: ../action/index.php");
}
?>
<?php
require '../constant/userActivityfn.php';
$_SESSION['LAST_ACTIVE_TIME'] = time();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../script/backPre.js" type="text/javascript"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../stylesheet/chat.css" type="text/css">
    <link rel="stylesheet" href="../stylesheet/chattemp.css" type="text/css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Jost&display=swap');
    </style>

    <title>chat_box</title>
</head>

<body>
    <!-- page body with sidenav start -->
    <div id="contentMain">
        <?php require '../layout/sidebar.php'; ?>
        <div id="contentBody">
            <!--heder top body End-->
            <?php
            require '../layout/header_login.php';
            ?>
            <div class="wrapper layout-wrapper d-lg-flex">
                <div class="users chat-leftsidebar">
                    <div class="tab-content">
                        <div class="tab-pane show active">
                            <div>
                                <div class="px-4 pt-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-4">
                                                <?php
                                                require '../constant/db_connect.php';
                                                // echo $user_id;
                                                // Assuming $conn is your database connection object

                                                $userDataSql = "SELECT COUNT(`msg_id`) as total_messages FROM `messages` WHERE (incoming_msg_id = ? OR outgoing_msg_id = ?)";
                                                $stmt = mysqli_prepare($conn, $userDataSql);

                                                // Bind parameters
                                                mysqli_stmt_bind_param($stmt, "ss", $user_id, $user_id);

                                                // Execute the statement
                                                mysqli_stmt_execute($stmt);

                                                // Bind the result
                                                mysqli_stmt_bind_result($stmt, $totalMessages);

                                                // Fetch the result
                                                mysqli_stmt_fetch($stmt);

                                                // Close the statement
                                                mysqli_stmt_close($stmt);

                                                // $userDataSql = "SELECT COUNT(`msg_id`) as total_messages FROM `messages` WHERE (incoming_msg_id = '{$user_id}' OR outgoing_msg_id = '{$user_id}')";
                                                // $chatUseResult = mysqli_query($conn, $userDataSql);
                                                // if (mysqli_num_rows($chatUseResult) > 0) {
                                                //     $row = mysqli_fetch_assoc($chatUseResult);
                                                //     $totalMessages = $row['total_messages']; // Retrieve the count from the associative array
                                                // }
                                                // echo $userDataSql
                                                ?>
                                                Messages
                                                <span class="text-primary fs-13">(<?php echo $totalMessages; ?>)</span>

                                            </h4>
                                            <div class="incoming_uniqid">
                                                <input type="hidden" id="<?php echo $user_id; ?>" value="messege_val" />
                                                <p hidden id="<?php echo $user_id; ?>"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search">
                                        <div class="input-group search-panel mb-3">
                                            <!-- <span class="text">Select an user to start chat</span> -->
                                            <input type="text" class="form-control" placeholder="Enter name to search...">
                                            <button class="btn p-0">
                                                <i class="fas fa-search bx bx-search align-middle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="activeUsers-list">
                                </div>
                                <div class="chat-room-list" data-simplebar="init">
                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                        <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer"></div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                <h5 class="mb-3 px-4 mt-4 fs-11 text-muted text-uppercase">Chat</h5>
                                                <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                                                    <div class="simplebar-content" style="padding: 0px;">
                                                        <div class="users-list  chat-message-list">

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="simplebar-placeholder" style="width: auto; height: 1147px;"></div>
                                        </div>
                                    </div>

                                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                        <div class="simplebar-scrollbar" style="width: 0px; display: none;">
                                        </div>
                                    </div>
                                    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                        <div class="simplebar-scrollbar" style="height: 254px; transform: translate3d(0px, 0px, 0px); display: block;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="user-chat w-100 overflow-hidden">

                    <div class="chat-content d-lg-flex">
                        <!-- start chat conversation section -->
                        <div class="w-100 overflow-hidden position-relative">
                            <!-- conversation user start-->
                            <div id="users-chat" class="position-relative">
                                <div class="py-3 user-chat-topbar">
                                    <div class="row align-items-center">
                                        <div class="col-sm-4 col-8">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                            <?php
                                                            require '../constant/db_connect.php';
                                                            require '../constant/encrypt_decrypt.php';

                                                            global $dec_incomingId, $chatrName_row;

                                                            // Assuming $conn is your database connection object

                                                            if (isset($_GET['chatuser_id'])) {
                                                                $dec_incomingId = decryptData($_GET['chatuser_id']);
                                                                $chatuser_id = mysqli_real_escape_string($conn, $dec_incomingId);
                                                                $chatrNameSql = "SELECT * FROM `login_data` WHERE `user` = ?";
                                                                $stmt = mysqli_prepare($conn, $chatrNameSql);
                                                                mysqli_stmt_bind_param($stmt, "s", $chatuser_id);
                                                            } else {
                                                                $chatrNameSql = "SELECT * FROM `login_data` WHERE `user` = ?";
                                                                $stmt = mysqli_prepare($conn, $chatrNameSql);
                                                                mysqli_stmt_bind_param($stmt, "s", $user_id);
                                                            }

                                                            // Execute the statement
                                                            mysqli_stmt_execute($stmt);

                                                            // Get the result
                                                            $result = mysqli_stmt_get_result($stmt);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                $chatrName_row = mysqli_fetch_assoc($result);
                                                            ?>
                                                                <img src="<?php echo htmlspecialchars($chatrName_row['user_pic']); ?>" class="rounded-circle avatar-sm" alt="">
                                                                <span class="user-status <?php echo htmlspecialchars($chatrName_row['status']); ?>"></span>
                                                            <?php
                                                            } else {
                                                                header("location: ../action/chat_box.php");
                                                            }

                                                            // Close the statement
                                                            mysqli_stmt_close($stmt);
                                                            ?>
                                                        </div>

                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h6 class="text-truncate mb-0 fs-18">
                                                                <a href="#" class="user-profile-show text-reset">
                                                                    <?php echo htmlspecialchars($chatrName_row['name']); ?>
                                                                </a>
                                                            </h6>
                                                            <p class="text-truncate text-muted mb-0"><small><?php echo htmlspecialchars($chatrName_row['status']); ?></small></p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-area">
                                    <div class="chat-box">
                                        <!-- <ul class="list-unstyled chat-conversation-list" id="users-conversation">
                                            <li class="chat-list left" id="10">
                                                <div class="conversation-list">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/avatar-2.jpg" alt="">
                                                    </div>
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="message-img mb-0">
                                                                <div class="message-img-list">
                                                                    <div>
                                                                        <iframe src="https://www.youtube.com/embed/PHcgN1GTjdU" title="YouTube video" class="w-100 rounded" autoplay allowfullscreen></iframe>
                                                                    </div>

                                                                    <div class="message-img-link">
                                                                        <ul class="list-inline mb-0">
                                                                            <li class="list-inline-item dropdown">
                                                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="assets/images/small/img-1.jpg" download="">
                                                                                        Download <i class="bx bx-download ms-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="collapse" data-bs-target=".replyCollapse">
                                                                                        Reply <i class="bx bx-share ms-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="modal" data-bs-target=".forwardModal">
                                                                                        Forward <i class="bx bx-share-alt ms-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                                                                                        Bookmark <i class="bx bx-bookmarks text-muted ms-2"></i>
                                                                                    </a>
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between delete-image" href="#">
                                                                                        Delete <i class="bx bx-trash ms-2 text-muted"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name">
                                                            <small class="text-muted time">11:45 am</small>
                                                            <span class="text-success check-message-icon"><i class="bx bx-check-double"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="chat-list left" id="11">
                                                <div class="conversation-list">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/avatar-2.jpg" alt="">
                                                    </div>
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="message-img mb-0">
                                                                <div class="message-img-list">
                                                                    <audio controls>
                                                                        <source src="http://w3codegenerator.com/audio/audio.mp3" type="audio/mpeg">
                                                                    </audio>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name">
                                                            <small class="text-muted time">11:45 am</small>
                                                            <span class="text-success check-message-icon"><i class="bx bx-check-double"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul> -->
                                        <ul class="list-unstyled chat-conversation-list" id="users-conversation">
                                            <!-- <li class="chat-list left">
                                                <div class="conversation-list">
                                                    <div class="chat-avatar">
                                                        <img src="../image/logo.png" alt="">
                                                    </div>
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <p class="mb-0 ctext-content">
                                                                    Good morning 😊
                                                                </p>
                                                            </div>
                                                            <div class="align-self-start message-box-drop d-flex">
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle show" href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                                                                    <div class="dropdown-menu show" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 34.4px, 0px);" data-popper-placement="bottom-start">
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="assets/images/small/img-1.jpg" download="">
                                                                            Download <i class="bx bx-download ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="collapse" data-bs-target=".replyCollapse">
                                                                            Reply <i class="bx bx-share ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="modal" data-bs-target=".forwardModal">
                                                                            Forward <i class="bx bx-share-alt ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                                                                            Bookmark <i class="bx bx-bookmarks text-muted ms-2"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between delete-image" href="#">
                                                                            Delete <i class="bx bx-trash ms-2 text-muted"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name">
                                                            <small class="text-muted time">11:45 am</small>
                                                            <span class="text-success check-message-icon"><i class="bx bx-check-double"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="chat-list left">
                                                <div class="conversation-list">
                                                    <div class="chat-avatar">
                                                        <img src="../image/logo.png" alt="">
                                                    </div>
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <p class="mb-0 ctext-content">
                                                                    Good morning 😊
                                                                </p>
                                                            </div>
                                                            <div class="align-self-start message-box-drop d-flex">
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle show" href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                                                                    <div class="dropdown-menu show" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 34.4px, 0px);" data-popper-placement="bottom-start">
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="assets/images/small/img-1.jpg" download="">
                                                                            Download <i class="bx bx-download ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="collapse" data-bs-target=".replyCollapse">
                                                                            Reply <i class="bx bx-share ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="modal" data-bs-target=".forwardModal">
                                                                            Forward <i class="bx bx-share-alt ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                                                                            Bookmark <i class="bx bx-bookmarks text-muted ms-2"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between delete-image" href="#">
                                                                            Delete <i class="bx bx-trash ms-2 text-muted"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name">
                                                            <small class="text-muted time">11:45 am</small>
                                                            <span class="text-success check-message-icon"><i class="bx bx-check-double"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="chat-list left">
                                                <div class="conversation-list">
                                                    <div class="chat-avatar">
                                                        <img src="../image/logo.png" alt="">
                                                    </div>
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <p class="mb-0 ctext-content">
                                                                    Good morning 😊.chat:hover: This part of the code selects an element with the class "chat" when it is being hovered over. The colon and "hover" pseudo-class (:hover) indicates that the styles within the curly braces will be applied only when the element is in the hover state.

                                                                    .dots: This represents a class that is likely present within the "chat" element or its children.

                                                                    display: block;: This CSS property is used to change the display behavior of the selected element. Here, when the "chat" element is being hovered over, the "dots" class within it will have its display changed to "block".

                                                                    In this case, when the user hovers over the "chat" element, the "dots" class (presumably an icon or some sort of visual element) will be displayed. The display: block; style is one way to ensure that the element is visible and takes up space in the layout.

                                                                    You can replace the display: block; with other appropriate CSS styles based on your specific requirements. For example, you can use display: inline-block; to make the element display as an inline block, or display: flex; to apply a flex layout to the element. You can also use display: none; to hide the element when it's not being hovered over.

                                                                    Make sure that the class "dots" has appropriate CSS rules defined outside this snippet to control its appearance when it is displayed.
                                                                </p>
                                                            </div>
                                                            <div class="align-self-start message-box-drop d-flex">
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle show" href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                                                                    <div class="dropdown-menu show" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 34.4px, 0px);" data-popper-placement="bottom-start">
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="assets/images/small/img-1.jpg" download="">
                                                                            Download <i class="bx bx-download ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="collapse" data-bs-target=".replyCollapse">
                                                                            Reply <i class="bx bx-share ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="modal" data-bs-target=".forwardModal">
                                                                            Forward <i class="bx bx-share-alt ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                                                                            Bookmark <i class="bx bx-bookmarks text-muted ms-2"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between delete-image" href="#">
                                                                            Delete <i class="bx bx-trash ms-2 text-muted"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name">
                                                            <small class="text-muted time">11:45 am</small>
                                                            <span class="text-success check-message-icon"><i class="bx bx-check-double"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="chat-list right">
                                                <div class="conversation-list">
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <p class="mb-0 ctext-content">
                                                                    Good morning 😊
                                                                </p>
                                                            </div>
                                                            <div class="align-self-start message-box-drop d-flex">
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle show" href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                                                                    <div class="dropdown-menu show" style="position: absolute; inset: 0px auto auto 0px; margin-left:-151px; transform: translate3d(0px, 34.4px, 0px);" data-popper-placement="bottom-start">
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="assets/images/small/img-1.jpg" download="">
                                                                            Download <i class="bx bx-download ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="collapse" data-bs-target=".replyCollapse">
                                                                            Reply <i class="bx bx-share ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="modal" data-bs-target=".forwardModal">
                                                                            Forward <i class="bx bx-share-alt ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                                                                            Bookmark <i class="bx bx-bookmarks text-muted ms-2"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between delete-image" href="#">
                                                                            Delete <i class="bx bx-trash ms-2 text-muted"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name">
                                                            <small class="text-muted time">11:45 am</small>
                                                            <span class="text-success check-message-icon"><i class="bx bx-check-double"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="chat-list right">
                                                <div class="conversation-list">
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <p class="mb-0 ctext-content">
                                                                    Good morning 😊.chat:hover: This part of the code selects an element with the class "chat" when it is being hovered over. The colon and "hover" pseudo-class (:hover) indicates that the styles within the curly braces will be applied only when the element is in the hover state.

                                                                    .dots: This represents a class that is likely present within the "chat" element or its children.

                                                                    display: block;: This CSS property is used to change the display behavior of the selected element. Here, when the "chat" element is being hovered over, the "dots" class within it will have its display changed to "block".

                                                                    In this case, when the user hovers over the "chat" element, the "dots" class (presumably an icon or some sort of visual element) will be displayed. The display: block; style is one way to ensure that the element is visible and takes up space in the layout.

                                                                    You can replace the display: block; with other appropriate CSS styles based on your specific requirements. For example, you can use display: inline-block; to make the element display as an inline block, or display: flex; to apply a flex layout to the element. You can also use display: none; to hide the element when it's not being hovered over.

                                                                    Make sure that the class "dots" has appropriate CSS rules defined outside this snippet to control its appearance when it is displayed.
                                                                </p>
                                                            </div>
                                                            <div class="align-self-start message-box-drop d-flex">
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle show" href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                                                                    <div class="dropdown-menu show" style="position: absolute; inset: 0px auto auto 0px; margin-left:-151px; transform: translate3d(0px, 34.4px, 0px);" data-popper-placement="bottom-start">
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="assets/images/small/img-1.jpg" download="">
                                                                            Download <i class="bx bx-download ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="collapse" data-bs-target=".replyCollapse">
                                                                            Reply <i class="bx bx-share ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="modal" data-bs-target=".forwardModal">
                                                                            Forward <i class="bx bx-share-alt ms-2 text-muted"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                                                                            Bookmark <i class="bx bx-bookmarks text-muted ms-2"></i>
                                                                        </a>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-between delete-image" href="#">
                                                                            Delete <i class="bx bx-trash ms-2 text-muted"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name">
                                                            <small class="text-muted time">11:45 am</small>
                                                            <span class="text-success check-message-icon"><i class="bx bx-check-double"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> -->
                                            <!-- <li class="chat-list left" id="10">
                                                <div class="conversation-list">
                                                    <div class="chat-avatar">
                                                        <img src="../image/logo.png" alt="">
                                                    </div>
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="message-img mb-0">
                                                                <div class="message-img-list">
                                                                    <div>
                                                                        <iframe src="https://www.youtube.com/embed/PHcgN1GTjdU" title="YouTube video" class="w-100 rounded" autoplay allowfullscreen></iframe>
                                                                    </div>

                                                                    <div class="message-img-link">
                                                                        <ul class="list-inline mb-0">
                                                                            <li class="list-inline-item dropdown">
                                                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="assets/images/small/img-1.jpg" download="">
                                                                                        Download <i class="bx bx-download ms-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="collapse" data-bs-target=".replyCollapse">
                                                                                        Reply <i class="bx bx-share ms-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="modal" data-bs-target=".forwardModal">
                                                                                        Forward <i class="bx bx-share-alt ms-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                                                                                        Bookmark <i class="bx bx-bookmarks text-muted ms-2"></i>
                                                                                    </a>
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between delete-image" href="#">
                                                                                        Delete <i class="bx bx-trash ms-2 text-muted"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name">
                                                            <small class="text-muted time">11:45 am</small>
                                                            <span class="text-success check-message-icon"><i class="bx bx-check-double"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="chat-list left" id="11">
                                                <div class="conversation-list">
                                                    <div class="chat-avatar">
                                                        <img src="../image/logo.png" alt="">
                                                    </div>
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="message-img mb-0">
                                                                <div class="message-img-list">
                                                                    <audio controls>
                                                                        <source src="http://w3codegenerator.com/audio/audio.mp3" type="audio/mpeg">
                                                                    </audio>
                                                                    <div class="message-img-link">
                                                                        <ul class="list-inline mb-0">
                                                                            <li class="list-inline-item dropdown">
                                                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="assets/images/small/img-1.jpg" download="">
                                                                                        Download <i class="bx bx-download ms-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="collapse" data-bs-target=".replyCollapse">
                                                                                        Reply <i class="bx bx-share ms-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" data-bs-toggle="modal" data-bs-target=".forwardModal">
                                                                                        Forward <i class="bx bx-share-alt ms-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                                                                                        Bookmark <i class="bx bx-bookmarks text-muted ms-2"></i>
                                                                                    </a>
                                                                                    <a class="dropdown-item d-flex align-items-center justify-content-between delete-image" href="#">
                                                                                        Delete <i class="bx bx-trash ms-2 text-muted"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name">
                                                            <small class="text-muted time">11:45 am</small>
                                                            <span class="text-success check-message-icon"><i class="bx bx-check-double"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> -->
                                        </ul>
                                    </div>
                                    <div class="position-relative chatInputSec">
                                        <div class="chat-input-section p-4 border-top chat_inputSec">
                                            <form id="chatinput-form" enctype="multipart/form-data" action="#" class="typing-area">
                                                <div class="row g-0 align-items-center">
                                                    <div class="file_Upload" id="file_Upload">
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="chat-input-links me-md-2">
                                                            <div class="links-list-item">
                                                                <button id="showMore_InputOpt" class="tooltip btn btn-link text-decoration-none btn-lg waves-effect">
                                                                    <i class="fa-solid fa-paperclip"></i>
                                                                    <span class="tooltiptext">
                                                                        More
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="position-relative">
                                                            <input type="text" class="incoming_id" name="incoming_id" 
                                                            value="<?php
                                                                    if ($dec_incomingId !== "") {
                                                                        echo $dec_incomingId;
                                                                    } else {
                                                                        echo $user_id;
                                                                    } ?>" hidden>
                                                            <textarea style="min-height:10px;resize: none;" type="text" name="message" class="input-field form-control  bg-light border-0 chat-input" autofocus id="chat-input" placeholder="Type your message..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="chat-input-links ms-2 gap-md-1">
                                                            <div class="links-list-item">
                                                                <button type="submit" id="chat_sendMsg" class="btn btn-primary ">
                                                                    <i class="fab fa-telegram-plane"></i>
                                                                </button>
                                                                <button type="submit" id="chat_MediaSendBtn" class="btn btn-primary " style="display:none;">
                                                                    <i class="fab fa-telegram-plane"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="chat-input-collapse chat-input-collapse1 collapse" id="mediaInput_list">
                                                <div class="card mb-0">
                                                    <div class="card-body py-3">
                                                        <div class="swiper chatinput-links">
                                                            <div class="swiper-wrapper">
                                                                <div class="swiper-slide">
                                                                    <div class="text-center px-2 position-relative">
                                                                        <div>
                                                                            <input type="file" name="any_file" id="send_anyfile" accept=".zip,.rar,.7zip,.pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" hidden />
                                                                            <label for="galleryfile-input" class="avatar-sm mx-auto ">
                                                                                <span class="avatar-title fs-18 bg-primary-subtle  text-primary  text-primary rounded-circle">
                                                                                    <i class="fa-solid fa-file" id="select_anyfile"></i>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                        <h5 class="fs-11 text-uppercase text-truncate mt-3 mb-0">Attached
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <div class="text-center px-2 position-relative">
                                                                        <div>
                                                                            <input type="file" name="audio_file" id="send_audio" accept="audio/*" hidden />
                                                                            <label for="galleryfile-input" class="avatar-sm mx-auto ">
                                                                                <span class="avatar-title fs-18 bg-primary-subtle  text-primary  text-primary rounded-circle">
                                                                                    <i class="fa-solid fa-headphones" id="select_audio"></i>
                                                                                </span>
                                                                            </label>

                                                                        </div>
                                                                        <h5 class="fs-11 text-uppercase text-truncate mt-3 mb-0">Audio
                                                                        </h5>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="text-center px-2 position-relative">
                                                                        <div>
                                                                            <input type="file" name="video_file" id="send_video" accept="video/*" hidden />
                                                                            <label for="galleryfile-input" class="avatar-sm mx-auto ">
                                                                                <span class="avatar-title fs-18 bg-primary-subtle  text-primary  text-primary rounded-circle">
                                                                                    <i class="fa-solid fa-video" id="select_video"></i>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                        <h5 class="fs-11 text-uppercase text-truncate mt-3 mb-0">Video
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <div class="text-center px-2 position-relative">
                                                                        <div>
                                                                            <input type="file" name="image_file" id="send_image" accept="image/*" hidden />
                                                                            <label for="galleryfile-input" class="avatar-sm mx-auto ">
                                                                                <span class="avatar-title fs-18 bg-primary-subtle  text-primary  text-primary rounded-circle">
                                                                                    <i class="fa-solid fa-image" id="select_image"></i>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                        <h5 class="fs-11 text-uppercase text-truncate mt-3 mb-0">Gallery
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- conversation user end-->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php
    require '../layout/footer.php';
    ?>


    <script src="../script/fontawesomeJS.js"></script>
    <script src="../script/chat_action.js"></script>
    <script src="../script/chat_conversation.js"></script>
    <script>
        function toggleDropdown() {
            // console.log("toggleDropdown");
            var dropdownMenu = document.querySelector('.dropdown-menu');
            console.log("toggleDropdown", dropdownMenu.style.display);
            if (dropdownMenu.style.display === "none") {
                dropdownMenu.style.display = "block";
            } else {
                dropdownMenu.style.display = "none";
            }
        }
    </script>

</body>

</html>