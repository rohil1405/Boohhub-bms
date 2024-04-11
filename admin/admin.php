<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}
include "../config/connection.php";
$sql = "SELECT users.*, user_types.type_name 
        FROM users 
        INNER JOIN user_types ON users.user_type_id = user_types.user_type_id 
      ";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin||Book Hub</title>
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  <script defer src="../assets/js/admintable.js"></script>
</head>

<body>
  <header>
    <div class="navbar">
      <div class="logo">
        <a href="admin.php">
          <img height="100px" width="100px" src="../assets/images/bookhub-high-resolution-logo-transparent.png">
        </a>
      </div>
      <nav>
        <ul>
          <li>Welcome Admin</li>
          <li><a href="admin.php">Home</a></li>
          <li><a href="books.php">Books</a></li>
          <li><a class="logout" href="../logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <div class="mainbody">
    <div class="userTable">
    <div id="addusers">
    <a id="adduser" href="../admin/adduser.php">Adduser</a>
    </div>
      <table id="admin">
        <thead>
        <tr>
          <th>Fullname</th>
          <th>Email</th>
          <th>Mobilenumber</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row=mysqli_fetch_assoc($result)){
          $id = $row["user_id"];
          $name = $row["fullname"];
          $email = $row["email"];
          $number = $row["mobilenumber"];
          $user_name = $row['type_name'];
          echo "<tr>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$number</td>
                    <td>$user_name</td>
                    <td style='display:flex;'>
                    <div><button class='update' type='button' onclick=\"location.href='updateuser.php?id=" . $row["user_id"] . "'\">Update</button></div>    
                    <div><button class='delete' type='button' onclick=\"location.href='deleteuser.php?id=" . $row["user_id"] . "'\">🗑</button></div>
                    </td>
                </tr>";
        }
        ?>
        </tbody>
      </table>
      </div>
    </div>
  </main>
</body>

</html>