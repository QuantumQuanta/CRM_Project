
<?php
require '../action/session_control.php';
session_start();

global $outgoing_id;
global $incoming_id;
global $allowed_Imgextensions;
global $allowed_Videoextensions;
global $allowed_Audioextensions;

$outgoing_id = $_SESSION['username'];
$allowed_Imgextensions = array('jpg', 'jpeg', 'png', 'gif');
$allowed_Videoextensions = array('mp4', 'mov', 'avi', 'wmv', 'mkv', 'flv');
$allowed_Audioextensions = array('mp3', 'wav', 'ogg', 'flac', 'mpeg');

// functions

function imgVideo_tmpStore($icon, $hidden_input)
{
    // echo $icon;
    $output = $hidden_input . "<div class='profile-media-img image_pre'>
                    <div class='media-img-list' id='remove-image-3'>
                        <a href='#'>" . $icon . "</a>
                        <i class='fa-solid fa-xmark  image-remove' id='remove-attechedFile'></i>
                    </div>
                </div>";
    echo $output;
}
function fileAudio_tmpStore($icon, $name, $media_size, $hidden_input)
{
    $output = $hidden_input . "<div class='card p-2 border attchedfile_pre d-inline-block position-relative'>
				<div class='d-flex align-items-center'>
					<div class='flex-shrink-0 avatar-xs ms-1 me-3'>
						<div class='avatar-title bg-soft-primary text-primary rounded-circle'>" . $icon . "</div>
					</div>
					<div class='flex-grow-1 overflow-hidden' style='margin-top: -8px;'>
						<a href id='a'></a>
						<h5 class='fs-14 text-truncate mb-1'>" . $name . "</h5>
						<input type='hidden' name='downloaddata' value='' />
						<p class='text-muted text-truncate fs-13 mb-0'>" . $media_size . "KB</p>
					</div>
					<div class='flex-shrink-0 align-self-start ms-3'>
						<div class='d-flex gap-2'>
							<i class='fa-solid fa-xmark text-muted attechedFile-remove' id='remove-attechedFile'></i>
						</div>
					</div>
				</div>
			</div>";
    echo $output;
}

function send_mediaMsg($type, $media_url, $otID, $inID)
{
    require '../constant/db_connect.php';
    $msg = 'NA';
    $send_mediaMsg_sql = "INSERT INTO `messages`(`incoming_msg_id`, `outgoing_msg_id`, `msg`, `msg_type`, `media_url`) 
        VALUES (?,?,?,?,?)";
    $send_mediaMsg_stmt = mysqli_prepare($conn, $send_mediaMsg_sql);
    mysqli_stmt_bind_param($send_mediaMsg_stmt, "sssss", $inID, $otID, $msg, $type, $media_url);
    // return $send_mediaMsg_stmt;
    mysqli_stmt_execute($send_mediaMsg_stmt);
    // $sendMedia_result=mysqli_stmt_get_result($send_mediaMsg_stmt);
    if (mysqli_stmt_affected_rows($send_mediaMsg_stmt) > 0) {
        return "1"; // Successful insertion
    } else {
        return "0"; // Insertion failed
    }
}


// all methods
// send image message
if ($_SERVER['REQUEST_METHOD']) {
    require  "../constant/db_connect.php";
    $incoming_id  = $_POST['incoming_id'];
    if ($_FILES['sendfiles']['name'] != '') {
        $name  = $_FILES['sendfiles']['name'];
        $tmp_name = $_FILES['sendfiles']['tmp_name'];
        $file_extension = pathinfo($name, PATHINFO_EXTENSION);
        $sql2 = mysqli_query($conn, "UPDATE `login_data` SET `date` = '$date' WHERE `user` = '$incoming_id'") or die();
        if (in_array($file_extension, $allowed_Imgextensions)) {
            $target_dir = "../image/chatMsg_image/chatImage/";

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file_name = $target_dir . $name;
            $chat_url = "../image/chatMsg_image/chatImage/" . $name;
            $output = send_mediaMsg('image', $chat_url, $outgoing_id, $incoming_id);
            $data['dt'] = $output;

            if ($data) {
                if (move_uploaded_file($tmp_name, $target_file_name)) {
                    echo json_encode($data);
                } else {
                    echo json_encode("Error uploading the file.");
                }
            }
        } else if (in_array($file_extension, $allowed_Videoextensions)) {
            $target_dir = "../image/chatMsg_image/chatVideo/";

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file_name = $target_dir . $name;
            $chat_url = "../image/chatMsg_image/chatVideo/" . $name;
            $output = send_mediaMsg('video', $chat_url, $outgoing_id, $incoming_id);
            $data['dt'] = $output;

            if ($data) {
                if (move_uploaded_file($tmp_name, $target_file_name)) {
                    echo json_encode($data);
                } else {
                    echo json_encode("Error uploading the file.");
                }
            }
        } else if (in_array($file_extension, $allowed_Audioextensions)) {
            $target_dir = "../image/chatMsg_image/chatAudio/";

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file_name = $target_dir . $name;
            $chat_url = "../image/chatMsg_image/chatAudio/" . $name;
            $output = send_mediaMsg('audio', $chat_url, $outgoing_id, $incoming_id);
            $data['dt'] = $output;

            if ($data) {
                if (move_uploaded_file($tmp_name, $target_file_name)) {
                    echo json_encode($data);
                } else {
                    echo json_encode("Error uploading the file.");
                }
            }
        } else {
            $target_dir = "../image/chatMsg_image/chatFiles/";

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file_name = $target_dir . $name;
            $chat_url = "../image/chatMsg_image/chatFiles/" . $name;
            $output = send_mediaMsg('files', $chat_url, $outgoing_id, $incoming_id);
            $data['dt'] = $output;

            if ($data) {
                if (move_uploaded_file($tmp_name, $target_file_name)) {
                    echo json_encode($data);
                } else {
                    echo json_encode("Error uploading the file.");
                }
            }
        }
    }
}

// for showing user list
// if (isset($_POST['action_userList'])) {
//     $sql = "SELECT * FROM `login_data` WHERE NOT `user` = '{$outgoing_id}' ORDER BY `id` DESC";
//     $query = mysqli_query($conn, $sql);
//     $output = "";
//     if (mysqli_num_rows($query) == 0) {
//         $output .= "No users are available to chat";
//     } elseif (mysqli_num_rows($query) > 0) {
//         include_once "chat_data.php";
//     }
//     echo $output;
// }
if (isset($_POST['action_userList'])) {
    $outgoing_id = mysqli_real_escape_string($conn, $outgoing_id); // Sanitize the variable

    $sql = "SELECT * FROM login_data WHERE NOT user = ? ORDER BY id DESC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $outgoing_id);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
    $output = "";

    if (mysqli_num_rows($query) == 0) {
        $output .= "No users are available to chat";
    } elseif (mysqli_num_rows($query) > 0) {
        include_once "chat_data.php";
    }
    echo $output;
}


// for searching user name

if (isset($_POST['searchText'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $outgoing_id = mysqli_real_escape_string($conn, $outgoing_id); // Sanitize the variable

    $sql = "SELECT * FROM `login_data` WHERE NOT `user` = ? AND (`name` LIKE ?) ";
    $stmt = mysqli_prepare($conn, $sql);
    $searchTerm = "%".$searchTerm."%";
    mysqli_stmt_bind_param($stmt, "ss", $outgoing_id, $searchTerm);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
    $output = "";

    if (mysqli_num_rows($query) > 0) {
        include_once "chat_data.php";
    } else {
        $output .= 'No user found related to your search term';
    }
    echo $output;
}

// for selecting media and store in database

// for selecting media and store in tempstorage
if ($_FILES['files']['name'] != '') {
    $target_dir = "../image/chatMsg_image/tempStorage/";
    $name = $_FILES['files']['name'];
    $media_size = $_FILES['files']['size'];
    $tmp_name = $_FILES['files']['tmp_name'];
    $file_extension = pathinfo($name, PATHINFO_EXTENSION);
    // $icon = "";



    // Remove previous files in the target directory
    $files = glob($target_dir . "*");
    foreach ($files as $file) {
        unlink($file);
    }

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file_name = $target_dir . $name;
    // echo $tmp_name;
    if (move_uploaded_file($tmp_name, $target_file_name)) {
        // Rest of your code
        $chat_url = "../image/chatMsg_image/tempStorage/" . $name;
        $hidden_input = "<input type='text' class='media_type' name='media_type' value='" . $_POST['fileInputId'] . "' hidden>";

        if (in_array($file_extension, $allowed_Imgextensions)) {
            $icon = "<img src='" . $chat_url . "' class='img-fluid' alt='alt'/>";
            imgVideo_tmpStore($icon, $hidden_input);
        } else if (in_array($file_extension, $allowed_Videoextensions)) {
            $icon = "<video controls width='200px' height='100px'>
                        <source src='" . $chat_url . "' type='video/" . $file_extension . "'>
                    </video>";
            // imgVideo_tmpStore($chat_url);
            // $icon=$file_extension;
            imgVideo_tmpStore($icon, $hidden_input);
        } else if (in_array($file_extension, $allowed_Audioextensions)) {
            $icon = "<i class='fa-solid fa-headphones'></i>";
            fileAudio_tmpStore($icon, $name, $media_size, $hidden_input);
        } else {
            $icon = "<i class='fa-solid fa-paperclip'></i>";
            fileAudio_tmpStore($icon, $name, $media_size, $hidden_input);
        }
    } else {
        echo 'may be there is some issue';
    }
}


?>