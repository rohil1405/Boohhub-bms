<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}
include "../config/connection.php";
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin||Book Hub</title>
  <link rel="stylesheet" href="../assets/css/books.css">
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  <script defer src="../assets/js/adminbooktable.js"></script>
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
  </nav>
  </div>
  </header>
  <main>
    <div class="mainbody">
      <div class="table">
      <table id="getbooks">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Author</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $author = $row['author'];
            $image = $row['image'];
            echo "
              <tr><td>$name</td>
              <td class='description'>$description</td>
              <td>$$price</td>
              <td>$author</td>
              <td><img height='100px' width='100px' src='../assets/images/$image'></td>
              <td style='display:flex;'>
              <div><button class='update' type='button' onclick=\"location.href='updatebook.php?id=" . $id . "'\">Update</button></div>  
              <div><button class='delete' type='button' onclick=\"location.href='deletebook.php?id=" . $id . "'\">🗑</button></div>
              </td>
              </tr>
              ";
          }
          ?>
        </tbody>
      </table>
      </div>
    </div>
  </main>
</body>
</html>