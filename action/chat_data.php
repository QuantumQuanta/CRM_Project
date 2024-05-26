<?php
require '../constant/db_connect.php';
require '../constant/encrypt_decrypt.php';

while ($row = mysqli_fetch_assoc($query)) {
    $userId = mysqli_real_escape_string($conn, $row['user']);
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = ? OR outgoing_msg_id = ?) 
                AND (outgoing_msg_id = ? OR incoming_msg_id = ?) ORDER BY msg_id DESC LIMIT 1";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, "ssss", $userId, $userId, $outgoing_id, $outgoing_id);
    mysqli_stmt_execute($stmt2);
    $query2 = mysqli_stmt_get_result($stmt2);
    $row2 = mysqli_fetch_assoc($query2);

    // $output .=$sql2;
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";
    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
    } else {
        $you = "";
    }
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['user']) ? $hid_me = "hide" : $hid_me = "";

    $enc_userId = encryptData($row['user']);
    $output .= '<li class="active">
                    <a href="../action/chat_box.php?chatuser_id=' . $enc_userId . '" class="unread-msg-user">
                        <div class="content d-flex align-items-center">
                            <div class="chat-user-img online align-self-center me-2 ms-0">
                                <img src="' . $row['user_pic'] . '" alt="" class="rounded-circle avatar-xs">
                                <span class="status-dot  ' . $offline . '"></span>
                            </div>
                        
                            <div class="details overflow-hidden me-2">
                                <p class="text-truncate chat-username mb-0">' . $row['name'] . '</p>
                                <p class="text-truncate text-muted fs-13 mb-0">' . $you . $msg . '</p>
                            </div>
                        </div>
                    </a>
                </li>';
}
