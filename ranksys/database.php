<?php
// Database configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "ranksystem";

// Establishing a connection
$conn = mysqli_connect($host, $user, $password, $database);

// Checking the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>