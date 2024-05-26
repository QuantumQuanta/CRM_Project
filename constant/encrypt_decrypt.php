<?php

// session_start();

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
//     header("location: ../action/index.php");
// } else if ($_SESSION['desg_code'] == 'CRTR') {
//     $user_id = $_SESSION['username'];
//     $user_name = $_SESSION['name'];
// } else {
//     header("location: ../action/index.php");
// }
?>

<?php
//encryption method
$encrypt_method = "AES-256-CBC";

//key delclaration
$secret_key = "PDNR-ATNAUQ-BALDR-ATLOVNE";

//initial-vector
$iv = "RDTDLAB30SOL7EDRS97";


function encryptData($data)
{
    try {
        // Key encryption
        $key = hash('sha256', $GLOBALS['secret_key']);

        // IV encryption (16-bit)
        $iv = substr(hash('sha256', $GLOBALS['iv']), 0, 16);

        // Data encryption
        $encryptedData = openssl_encrypt($data, $GLOBALS['encrypt_method'], $key, 0, $iv);

        // Base64 encoding
        $encryptedData = base64_encode($encryptedData);

        return $encryptedData;
    } catch (Exception $e) {
        // Handle encryption error
        error_log("Encryption error: " . $e->getMessage());
        return false;
    }
}

function decryptData($data)
{
    try {
        // Key encryption
        $key = hash('sha256', $GLOBALS['secret_key']);

        // IV encryption (16-bit)
        $iv = substr(hash('sha256', $GLOBALS['iv']), 0, 16);

        // Base64 decoding
        $decodedData = base64_decode($data);

        // Data decryption
        $decryptedData = openssl_decrypt($decodedData, $GLOBALS['encrypt_method'], $key, 0, $iv);

        return $decryptedData;
    } catch (Exception $e) {
        // Handle decryption error
        error_log("Decryption error: " . $e->getMessage());
        return false;
    }
}
// if($_SERVER['REQUEST_METHOD']=='POST'){
//     if(isset($_POST['trig']) && ($_POST['trig']=='dwr_data')){
//         $str = $_POST['id'];
//         $encStr = encryptData($str);
//         // echo json_encode($encStr);
//     }
    
// }

?>
