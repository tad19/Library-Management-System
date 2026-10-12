<?php

$host = "sql110.infinityfree.com";
$port = 3306;
$username = "if0_43150362";
$password = "tadiruy123";
$database = "if0_43150362_LibraryManagementSystem";

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>