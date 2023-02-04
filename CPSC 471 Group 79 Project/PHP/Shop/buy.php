<?php

$client_ID = $_GET ['client_ID'];

// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
else
    {
       
    $cart = "call getCartw($client_ID)";
    $result = mysqli_query($con,$cart);
    $total = 0;
    while ($row = mysqli_fetch_array($result))
      {
        $name = $row['name'];
        $quantity = $row['quantity'];
        $times_purchased = $row['times_purchased'];
        $total_times = $times_purchased + $quantity;
        $id = $row['item_ID'];
        $price = $row['price'];
        $img = $row['image'];
        $itemPrice = $price * $quantity;
        $sql[$total++] = "call updateItem( $id,'$name', $price, '$img',$total_times)";
        $sql[$total++] = "call addBilling($client_ID, '$name', $quantity, $price, $itemPrice)";
      }
    mysqli_next_result($con);
    for ($i = 0; $i < $total; $i++)
        {
        echo $sql[$i]. '<br/>';
        $r = mysqli_multi_query($con,$sql[$i]); 
        mysqli_next_result($con);
        } 
    echo 'Checkout successful';  
    
    $sql = "DELETE FROM cart WHERE client_ID=$client_ID";
    $result = mysqli_query($con,$sql);
    
    echo 'Redirecting you to your profile in 3 seconds...';
     header("refresh:15; url=../Client/getClient.php?id=$client_ID");
     }

  mysqli_close($con);
?>


