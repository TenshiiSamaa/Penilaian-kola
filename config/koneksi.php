<?php

    /// Object Oriented 
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "penilaian";

    // error_reporting(0);
    // mysqli_report(MYSQLI_REPORT_OFF);

    $conn = new mysqli($host, $username, $password, $database);

    if($conn->connect_errno>0) {
        die("Koneksi Bermasalah : ".$conn->connect_error);
    }

?>