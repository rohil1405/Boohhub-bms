<?php
$servername = "localhost";
$username = 'root';
$password = '';
$database = 'bms';

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error) {
    die('Connected failed: ' . $conn->connect_error);
}
?>