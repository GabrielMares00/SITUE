<?php
    //DEBUGGING FILE TO TEST SERVER CONNECTION
    //BASIC
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "situe";
    
    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
    }
    
    echo "Connected successfully";
?>
