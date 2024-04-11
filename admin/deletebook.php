<?php
include "../config/connection.php";


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_GET['id'];
$sql = "DELETE FROM books WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: books.php");
} else {
    header("Location: admin.php");
}
$conn->close();    
?>