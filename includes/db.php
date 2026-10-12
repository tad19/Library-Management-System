<?php

$host = "localhost";
$port = 3306;
$username = "root";
$password = "tadiruy123";
$database = "libsys_db";

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>