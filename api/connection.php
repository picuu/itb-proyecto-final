<?php
    $servername = "timebankdb.caitegozrkp2.us-east-1.rds.amazonaws.com";
    $database = "time_bank_db";
    $username = "root";
    $password = "root.itb";

    $conn = mysqli_connect($servername, $username, $password, $database);
    mysqli_set_charset($conn, "utf8");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>