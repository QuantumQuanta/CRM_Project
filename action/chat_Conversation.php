<?php
require '../action/session_control.php';
session_start();
include_once "../constant/db_connect.php";
$outgoing_id = $_SESSION['username'];

if (isset($_GET['action_messageNotification'])) {
    if (isset($_SESSION['username'])) {
        $outgoing_id = mysqli_real_escape_string($conn, $outgoing_id);
        $incomingImg_Sql = "SELECT * FROM login_data WHERE user=?";
        $stmt = mysqli_prepare($conn, $incomingImg_Sql);
        mysqli_stmt_bind_param($stmt, "s", $outgoing_id);
        mysqli_stmt_execute($stmt);
        $outgoing_id_res = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($outgoing_id_res) > 0) {
            while ($row = mysqli_fetch_assoc($outgoing_id_res)) {
                if ($row['date'] != $row['prev_date']) {
                    $date = $row['date'];
                    $sql2 = "UPDATE login_data SET prev_date=? WHERE user=?";
                    $stmt2 = mysqli_prepare($conn, $sql2);
                    mysqli_stmt_bind_param($stmt2, "ss", $date, $outgoing_id);
                    mysqli_stmt_execute($stmt2) or die();
                    echo "new message";
                } else {
                    echo 'No new Message';
                }
            }
        } else {
            $output .= '<div class="text">No messages are available. Once you send a message, they will appear here.</div>';
        }
    }
}

if (isset($_POST['action_sendMsg'])) {
    if (isset($_SESSION['username'])) {
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y-m-d H:i:s");
        if (!empty($message)) {
            $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, media_url) 
                    VALUES (?, ?, ?, 'text', '')";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $incoming_id, $outgoing_id, $message);
            mysqli_stmt_execute($stmt) or die();

            $sql2 = "UPDATE login_data SET date = ? WHERE user = ?";
            $stmt2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt2, "ss", $date, $incoming_id);
            mysqli_stmt_execute($stmt2) or die();
        }
    }
} else if (isset($_GET['action_GetMsg'])) {
    if (isset($_SESSION['username'])) {
        $userImg = $_SESSION['user_pic'];

        $incoming_id = mysqli_real_escape_string($conn, $_GET['incoming_id']);
        $output = "";

        // First query
        $sql = "SELECT * FROM messages 
        LEFT JOIN login_data ON login_data.user = messages.outgoing_msg_id 
        WHERE (outgoing_msg_id = ? AND incoming_msg_id = ?) OR (outgoing_msg_id = ? AND incoming_msg_id = ?) 
        ORDER BY msg_id";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $outgoing_id, $incoming_id, $incoming_id, $outgoing_id);
        mysqli_stmt_execute($stmt);
        $query = mysqli_stmt_get_result($stmt);

        // Second query
        $outgoingImg_Sql = "SELECT user_pic FROM login_data WHERE user=?";
        $stmt2 = mysqli_prepare($conn, $outgoingImg_Sql);
        mysqli_stmt_bind_param($stmt2, "s", $outgoing_id);
        mysqli_stmt_execute($stmt2);
        $outgoingImg_res = mysqli_stmt_get_result($stmt2);
        $outgoingImg_row = mysqli_fetch_assoc($outgoingImg_res);
        $outgoingImg_path = $outgoingImg_row['user_pic'];

        // Third query
        $incomingImg_Sql = "SELECT user_pic FROM login_data WHERE user=?";
        $stmt3 = mysqli_prepare($conn, $incomingImg_Sql);
        mysqli_stmt_bind_param($stmt3, "s", $incoming_id);
        mysqli_stmt_execute($stmt3);
        $incomingImg_res = mysqli_stmt_get_result($stmt3);
        $incomingImg_row = mysqli_fetch_assoc($incomingImg_res);
        $incomingImg_path = $incomingImg_row['user_pic'];


        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                if ($row['msg_type'] == 'text') {
                    if ($row['outgoing_msg_id'] === $outgoing_id) {
                        $output .= '<li class="chat-list right">
                                    <div class="conversation-list">
                                        <div class="user-chat-content">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0 ctext-content">' . $row['msg'] . '</p>
                                                </div>
                                                <div class="align-self-start message-box-drop d-flex">
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle" onclick="toggleDropdown()" href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                                                        <div class="dropdown-menu " style="position: absolute; inset: 0px auto auto 0px; margin-left:-151px; transform: translate3d(0px, 34.4px, 0px);" data-popper-placement="bottom-start">
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
                                </li>';
                    } else {
                        $output .= '<li class="chat-list left">
                                    <div class="conversation-list">
                                        <div class="chat-avatar">
                                            <img src="' . $incomingImg_path . '" alt="">
                                        </div>
                                        <div class="user-chat-content">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0 ctext-content">' . $row['msg'] . '</p>
                                                </div>
                                                <div class="align-self-start message-box-drop d-flex">
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle" href="#" onclick="toggleDropdown()"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                                                        <div class="dropdown-menu " style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 34.4px, 0px);" data-popper-placement="bottom-start">
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
                                </li>';
                    }
                } else if ($row['msg_type'] == 'image') {
                    if ($row['outgoing_msg_id'] === $outgoing_id) {
                        // echo $outgoingImg_path;
                        $output .= '<li class="chat outgoing"> 
                                        <div class="dots">
                                            <div class="dropdown">
                                                <button class="btn nav-btn " type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none user-profile-show" href="#">View Profile <i class="bx bx-user text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".audiocallModal">Audio <i class="bx bxs-phone-call text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".videocallModal">Video <i class="bx bx-video text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Archive <i class="bx bx-archive text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Muted <i class="bx bx-microphone-off text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Delete <i class="bx bx-trash text-muted"></i></a>
                                                </div>
                                            </div>
                                        </div>                               
                                        <div class="Media_details">
                                            <img src="' . $row['media_url'] . '" alt="" class="media-Image" style="width:150px;height:150px;">                                   
                                        </div>                                        
                                    </li>';
                    } else {
                        $output .= '<li class="chat incoming">
                                        <img src="' . $incomingImg_path . '" alt="" class="rounded-circle avatar-sm">
                                        <div class="incoming-midDiv">   
                                            <div class="Media_details">
                                                <img src="' . $row['media_url'] . '" alt="" class="media-Image" style="width:150px;height:150px;">
                                            </div>
                                            <div class="dots">
                                                <div class="dropdown">
                                                    <button class="btn nav-btn " type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none user-profile-show" href="#">View Profile <i class="bx bx-user text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".audiocallModal">Audio <i class="bx bxs-phone-call text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".videocallModal">Video <i class="bx bx-video text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Archive <i class="bx bx-archive text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Muted <i class="bx bx-microphone-off text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Delete <i class="bx bx-trash text-muted"></i></a>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                    </li>';
                    }
                } else if ($row['msg_type'] == 'audio') {
                    $url = $row['media_url'];
                    $extension = pathinfo($url, PATHINFO_EXTENSION);
                    if ($row['outgoing_msg_id'] === $outgoing_id) {
                        // echo $outgoingImg_path;

                        $output .= '<li class="chat outgoing">  
                                        <div class="dots">
                                            <div class="dropdown">
                                                <button class="btn nav-btn " type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none user-profile-show" href="#">View Profile <i class="bx bx-user text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".audiocallModal">Audio <i class="bx bxs-phone-call text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".videocallModal">Video <i class="bx bx-video text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Archive <i class="bx bx-archive text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Muted <i class="bx bx-microphone-off text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Delete <i class="bx bx-trash text-muted"></i></a>
                                                </div>
                                            </div>
                                        </div>                               
                                        <div class="Media_details">
                                            <audio controls>
                                                <source src="' . $row['media_url'] . '" type="audio/' . $extension . '">
                                            </audio >
                                        </div>                                        
                                    </li>';
                    } else {
                        $output .= '<li class="chat incoming">
                                        <img src="' . $incomingImg_path . '" alt="" class="rounded-circle avatar-sm">
                                        <div class="incoming-midDiv">   
                                            <div class="Media_details">
                                                <audio controls>
                                                    <source src="' . $row['media_url'] . '" type="audio/' . $extension . '">
                                                </audio >
                                            </div>
                                            <div class="dots">
                                                <div class="dropdown">
                                                    <button class="btn nav-btn " type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none user-profile-show" href="#">View Profile <i class="bx bx-user text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".audiocallModal">Audio <i class="bx bxs-phone-call text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".videocallModal">Video <i class="bx bx-video text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Archive <i class="bx bx-archive text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Muted <i class="bx bx-microphone-off text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Delete <i class="bx bx-trash text-muted"></i></a>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>   
                                    </li>';
                    }
                } else if ($row['msg_type'] == 'video') {
                    $url = $row['media_url'];
                    $extension = pathinfo($url, PATHINFO_EXTENSION);
                    if ($row['outgoing_msg_id'] === $outgoing_id) {
                        $output .= '<li class="chat outgoing">
                                        <div class="dots">
                                            <div class="dropdown">
                                                <button class="btn nav-btn " type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none user-profile-show" href="#">View Profile <i class="bx bx-user text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".audiocallModal">Audio <i class="bx bxs-phone-call text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".videocallModal">Video <i class="bx bx-video text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Archive <i class="bx bx-archive text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Muted <i class="bx bx-microphone-off text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Delete <i class="bx bx-trash text-muted"></i></a>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="Media_details">
                                            <video controls width="250" height="120">
                                                <source src="' . $url . '" type="video/' . $extension . '">
                                            </video >
                                        </div>                                        
                                    </li>';
                    } else {

                        $output .= '<li class="chat incoming">
                                        <img src="' . $incomingImg_path . '" alt="" class="rounded-circle avatar-sm">
                                        <div class="incoming-midDiv">   
                                            <div class="Media_details">
                                                <video controls width="250" height="120">
                                                    <source src="' . $url . '" type="video/' . $extension . '">
                                                </video >
                                            </div>
                                            <div class="dots">
                                                <div class="dropdown">
                                                    <button class="btn nav-btn " type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none user-profile-show" href="#">View Profile <i class="bx bx-user text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".audiocallModal">Audio <i class="bx bxs-phone-call text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".videocallModal">Video <i class="bx bx-video text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Archive <i class="bx bx-archive text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Muted <i class="bx bx-microphone-off text-muted"></i></a>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Delete <i class="bx bx-trash text-muted"></i></a>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>    
                                    </li>';
                    }
                } else {
                    $path = $row['media_url'];
                    $filename = basename($path);
                    $filesize = filesize($path);
                    if ($row['outgoing_msg_id'] === $outgoing_id) {
                        // echo $outgoingImg_path;                        
                        $output .= '<li class="chat outgoing">  
                                        <div class="dots">
                                            <div class="dropdown">
                                                <button class="btn nav-btn " type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none user-profile-show" href="#">View Profile <i class="bx bx-user text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".audiocallModal">Audio <i class="bx bxs-phone-call text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".videocallModal">Video <i class="bx bx-video text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Archive <i class="bx bx-archive text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Muted <i class="bx bx-microphone-off text-muted"></i></a>
                                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Delete <i class="bx bx-trash text-muted"></i></a>
                                                </div>
                                            </div>
                                        </div>                                            
                                        <div class="conversation-list outgoing-left">
                                                <div class="user-chat-content">
                                                    <div class="ctext-wrap">
                                                        <div class="ctext-wrap-content">
                                                            <div class="p-3 border rounded-3">
                                                                <div class="d-flex align-items-center attached-file">
                                                                    <div class="flex-shrink-0 avatar-sm me-3 ms-0 attached-file-avatar">
                                                                        <div class="avatar-title  rounded-circle fs-20 bg-soft-white">
                                                                            <i class="fa-solid fa-paperclip"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 overflow-hidden">
                                                                        <div class="text-start">
                                                                            <h5 class="fs-14 text-white mb-1">' . $filename . '</h5>
                                                                            <p class="text-white-50 text-truncate fs-13 mb-0">' . $filesize . ' kb</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-4">
                                                                        <div class="d-flex gap-2 fs-20 d-flex align-items-start">
                                                                            <div class="">
                                                                                <a href="' . $row['media_url'] . '" class="text-white-50" download>
                                                                                    <i class="fa-solid fa-download"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>                                         
                                    </li>';
                    } else {
                        $output .= '<li class="chat incoming">
                                        <img src="' . $incomingImg_path . '" alt="" class="rounded-circle avatar-sm">  
                                        <div class="incoming-midDiv">                                     
                                            <div class="conversation-list incoming-ringt">
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <div class="p-3 border rounded-3">
                                                                    <div class="d-flex align-items-center attached-file">
                                                                        <div class="flex-shrink-0 avatar-sm me-3 ms-0 attached-file-avatar">
                                                                            <div class="avatar-title  rounded-circle fs-20 bg-soft-primary">
                                                                                <i class="fa-solid fa-paperclip"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 overflow-hidden">
                                                                            <div class="text-start">
                                                                            <h5 class="fs-14 text-white mb-1">' . $filename . '</h5>
                                                                                <p class="text-white-50 text-truncate fs-13 mb-0">' . $filesize . ' kb</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-shrink-0 ms-4">
                                                                            <div class="d-flex gap-2 fs-20 d-flex align-items-start">
                                                                                <div class="">
                                                                                    <a href="' . $row['media_url'] . '" class="text-white-50" download>
                                                                                        <i class="fa-solid fa-download"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="dots">
                                                <div class="dropdown">
                                                        <button class="btn nav-btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none user-profile-show" href="#">View Profile <i class="bx bx-user text-muted"></i></a>
                                                            <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".audiocallModal">Audio <i class="bx bxs-phone-call text-muted"></i></a>
                                                            <a class="dropdown-item d-flex justify-content-between align-items-center d-lg-none" href="#" data-bs-toggle="modal" data-bs-target=".videocallModal">Video <i class="bx bx-video text-muted"></i></a>
                                                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Archive <i class="bx bx-archive text-muted"></i></a>
                                                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Muted <i class="bx bx-microphone-off text-muted"></i></a>
                                                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">Delete <i class="bx bx-trash text-muted"></i></a>
                                                        </div>
                                                </div>
                                            </div> 
                                        <div>  
                                    </li>';
                    }
                }
            }
        } else {
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }
}
