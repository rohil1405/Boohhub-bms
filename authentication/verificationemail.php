<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location:../register.php");
    exit;
}
$userMail = $_SESSION['email'];
require '../vendor/autoload.php';
require '../config/connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$sql = "select otp from users where email='$userMail'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$userOtp = $row['otp'];
$phpmailer = new PHPMailer();
$phpmailer->isSMTP();
$phpmailer->Host = 'sandbox.smtp.mailtrap.io';
$phpmailer->SMTPAuth = true;
$phpmailer->Port = 2525;
$phpmailer->Username = '8ea3469d2d217f';
$phpmailer->Password = '01eb617f58a09b';
$phpmailer->setFrom("rohil1405shah@gmail.com","Rohil Shah");
$phpmailer->addAddress($userMail);
$phpmailer->isHTML(true);                                  
$phpmailer->Subject = 'Verification Email';
$phpmailer->Body    = "Your otp is" .$userOtp.".";
$phpmailer->send();
?>
<?php
include "../config/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputOtp = $_POST['otp'];
    $sql = "select otp from users where otp = '$inputOtp'";
    $result = $conn->query($sql);
    if($result && $result->num_rows > 0) {
        header("Location:../login.php");
        session_destroy();
        exit;
    } else {
        header("Location:verificationemail.php");
        echo `<script>alert('Incorrect OTP. Please Try again')</script>`;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub||Email Verification</title>
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
    <h2>Verify Email</h2>
    <input class="forminput" type="tel" name="otp" placeholder="Enter Your otp">
    <input id="registerbtn" type="submit" name="submit" value="Verify email">
    </form>
</body>
</html>