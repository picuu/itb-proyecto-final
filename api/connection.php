<?php
    $servername = "localhost";
    $database = "time_bank_db";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($servername, $username, $password, $database);
    mysqli_set_charset($conn, "utf8");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>