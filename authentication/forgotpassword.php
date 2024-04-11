<?php
include "../config/connection.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $_SESSION['email'] = $email;
    $otp = rand(1000,10000);
    $sql = "update users set otp='$otp' where email='$email';";
    $result = $conn->query($sql);
    if($result) {
        header("Location: otppass.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub||ForgotPassword</title>
    <link rel="stylesheet" href="../assets/css/register.css">
    <script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js">
    </script>
    <script defer src="../assets/js/registervalidation.js"></script>
</head>
</head>
<body class="container">
    <form class="registerform" id="register" method="post" autocomplete="off">
    <img  height="80px" width="100px" src="../assets/images/bookhub-high-resolution-logo-transparent.png">
    <h2>Forgot Password</h2>
    <input class="forminput" type="email" name="email" placeholder="Enter Your Email">
    <input id="registerbtn" type="submit" name="submit" value="Submit email">
    </form>
</body>
</html>