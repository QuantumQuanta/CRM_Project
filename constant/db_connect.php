<?php
    //LOCALHOST  CONNECTION
    //connection variables
    // $servername ="localhost";
    // $username ="Subham";
    // $password ="Subham@123@";
    // $database ="crm";
    // $servername ="localhost";
    // $username ="root";
    // $password ="";
    // $database ="crm";

    //SERVER CONNECTION
    #sudrequire '/var/databasesecure.php';

    #$config = parse_ini_file('/etc/config.ini', true);

    #$servername = $config['database']['servername'];
    #$username = $config['database']['username'];
    #$password = $config['database']['password'];
    #$database = $config['database']['database'];
    // $config = parse_ini_file('/etc/config.ini');

    // $servername = $config['servername'];
    // $username = $config['username'];
    // $password = $config['password'];
    // $database = $config['database'];





    #$servername = "localhost";
    #$username = "ckb";
    #$password = "";
    #$database = "crm";
    $servername = 'localhost';
    $username = 'ckb';
    $password = 'Crmenvoltaserver@123@ckb@Subham@123@databasesecurepassword';
    $database = 'crm';

    //database connection
    $conn = mysqli_connect($servername,$username,$password,$database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        
    }
    else{
        $succ="Successful connection established with database!";
    }


?>