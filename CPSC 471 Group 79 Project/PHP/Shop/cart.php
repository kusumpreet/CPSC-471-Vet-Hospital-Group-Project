<?php

$client_ID = $_GET ['client_ID'];
$item_ID = $_GET ['item_ID'];

// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
else
    {
    $sql = "select quantity from cart where client_ID=$client_ID and item_ID=$item_ID";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 0) 
        {
        $quantity = 1;
        $sql = "call addToCart($client_ID, $item_ID, $quantity)";
        } 
    else 
        {
        $quantity = $row['quantity'] + 1;
        $sql = "call updateCart($client_ID, $item_ID, $quantity)";
        }

     echo $sql;
     $result = mysqli_query($con,$sql);
     header("Location: shop.php?client_ID=".$client_ID);
    // header("refresh:5; url=shop.php?client_ID=".$client_ID);
     }

  mysqli_close($con);
?>


