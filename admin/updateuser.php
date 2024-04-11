<?php
include "../config/connection.php";
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE user_id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_POST['user_id'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $mobilenumber = $_POST['mobilenumber'];

        $updateSql = "UPDATE users SET fullname='$fullname', email='$email', mobilenumber='$mobilenumber' WHERE user_id=$id";

        if ($conn->query($updateSql) === TRUE) {
            header("Location: admin.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update-User</title>
  <link rel="stylesheet" href="../assets/css/updateuser.css">
</head>
</head>
<body class="container">
<h4></h4>
    <form class="updateuser" method="post">
    <img  height="80px" width="100px" src="../assets/images/bookhub-high-resolution-logo-transparent.png">
    <input class="forminput" type="text" name="fullname" value="<?php echo $row['fullname']; ?>">
    <input class="forminput" type="email" name="email" value="<?php echo $row['email']; ?>">

    <input class="forminput" type="tel" name="mobilenumber" value="<?php echo $row['mobilenumber']; ?>">
    <button id="updateprofile"  type="submit">Update</button>
    <a id="updateprofile" href="admin.php">Back to Records</a>
    </form>
</body>
</html>

