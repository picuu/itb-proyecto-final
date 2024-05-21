<?php
    $db_hostname = "tai.db.elephantsql.com";
    $db_port = "5432";
    $db_database = "esbqluwa";
    $db_username = "esbqluwa";
    $db_password = "sJS9diDu9-e601KT16WPnxYPyr2ilMt8";

    $db_options = "--client_encoding=UTF8";

    $db_conn_str = "host=$db_hostname port=$db_port dbname=$db_database user=$db_username password=$db_password options='$db_options'";

    $conn = pg_connect($db_conn_str);

    if (pg_last_error($conn)) {
        die("Connection failed: " . pg_last_error($conn));
    }
?>