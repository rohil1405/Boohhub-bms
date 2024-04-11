<?php
header('Content-type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST');
$data = json_decode(file_get_contents("php://input"),true); 
$bookId = $data['id'];
$name = $data['name'];
$image= $data['image'];
$quantity= $data['quantity'];
$buyerId = $data['buyerId'];
$totalPrice = $data['totalprice'];
$sellerId = $data['sellerId'];
include "../config/connection.php";
$sql = "insert into orders(book_id,name,image,quantity,buyer_id,totalprice,seller_id) values('$bookId','$name','$image','$quantity','$buyerId','$totalPrice','$sellerId')";

$result = $conn->query($sql);
if($result){
  echo json_encode(["message"=>"inserted successfully"]);
}
else{
  echo json_encode(["message"=>"not inserted"]);
}
?>