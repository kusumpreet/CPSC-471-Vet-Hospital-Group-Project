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
    
    if ($_GET["job"] == "delete")
    {
     $item_ID = $_GET['item_ID'];
     $sql = "DELETE FROM cart WHERE client_ID=$client_ID AND item_ID=$item_ID";
     $result = mysqli_query($con,$sql);
    }
    if ($_GET["job"] == "update")
    {
       $item_ID = $_GET['item_ID']; 
       $quantity = $_POST['quantity'];
       $sql = "UPDATE cart SET quantity=$quantity WHERE client_ID=$client_ID AND item_ID=$item_ID";
       $result = mysqli_query($con,$sql);
    }
    $sql = "call viewCart($client_ID)";
    $result = mysqli_query($con,$sql);
    
    echo 'My Cart <br>';
    //echo "{\"name\": \"$name\"}";
    echo "<table border='1'>
    <tr>
    <th>Name</th>
    <th>Image</th>
    <th>Price per item</th>
    <th>Quantity</th>
    <th>Price for your quantity</th>
    <th> </th>
    </tr>";
    $total_price = 0;
    
    while ($row = mysqli_fetch_array($result))
      {
      $item_ID = $row['id'];
      $price = $row['price'];
      $quantity = $row['quantity'];
      $image = $row['image'];
      $item_price = $price * $quantity;
      $total_price = $total_price + $item_price;
      echo "<tr>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td><img src='$image' alt='$name' height='100' style='text-align:center;'></td>";
      echo "<td> $" . $price . "</td>";
      echo "<td>" . $quantity . "</td>";
      echo "<td> $" . $item_price . "</td>";
      echo "<td><a href='updateCart.php?client_ID=" . $client_ID . "&item_ID=$item_ID'>Edit Quantity </a></td>";
      echo "<td><a href='viewCart.php?job=delete&client_ID=" . $client_ID . "&item_ID=$item_ID'>Remove </a></td>";
      
      echo "</tr>";
      }
    
    echo "</table>";
    echo '<br>';  
    
    echo 'Total Price: $'.$total_price.'<br>';
    
    echo "<a href='shop.php?client_ID=$client_ID'>Back to Shop</a>";
    echo '<br>';
    echo "<a href='buy.php?client_ID=$client_ID'>Checkout</a>";
    echo '<br>';
    echo '<br>';
    echo "<a href='../Client/getClient.php?id=$client_ID'>Go Back To My Profile</a>";
    }

  mysqli_close($con);
?>



