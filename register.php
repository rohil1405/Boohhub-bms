<?php
include "./config/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $mobilenumber = $_POST["mobilenumber"];
    $userType = $_POST["userType"];
    $otp = rand(1000,10000);
    if (empty($fullname) || empty($email) || empty($password) || empty($confirmpassword) || empty($mobilenumber) || empty($userType) || empty($otp)) {
        header("Location: register.php");
        exit;
    }
    if ($password != $confirmpassword) {
        header("Location: register.php");
        exit;
    }

    $hashedPassword = md5($password);

    $sql = "INSERT INTO users (fullname, email, password, mobilenumber, user_type_id,otp) VALUES ('$fullname', '$email', '$hashedPassword', '$mobilenumber', '$userType','$otp')";

    if($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION['email'] = $email;
        header("Location: ./authentication/verificationemail.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub||Registration</title>
    <link rel="stylesheet" href="./assets/css/register.css">
    <script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js">
    </script>
    <script defer src="./assets/js/registervalidation.js"></script>
</head>
</head>
<body class="container">
    <form class="registerform" id="register" method="post" autocomplete="off">
    <img  height="80px" width="100px" src="./assets/images/bookhub-high-resolution-logo-transparent.png">
    <h2>Registration</h2>
    <input class="forminput" type="text" name="fullname" placeholder="Enter Your FullName">
    <input class="forminput" type="email" name="email" placeholder="Enter Your Email">
    <input class="forminput" type="password" name="password" placeholder="Enter Your Password">
    <input class="forminput" type="password" name="confirmpassword" placeholder="Enter Confirm Password">
    <input class="forminput" type="tel" name="mobilenumber" placeholder="Enter Your PhoneNumber">
    <select id="options" name="userType">
    <option value="">Select Role</option>
    <option value="1">Seller</option>
    <option value="2">Buyer</option>
    </select>
    <pre>Have an account?<a href="login.php">Log in</a></pre>
    <input id="registerbtn" type="submit" name="submit" value="Register">
    </form>
</body>
</html>