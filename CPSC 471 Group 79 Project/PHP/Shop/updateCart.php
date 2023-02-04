
<?php

$item_ID   = $_GET["item_ID"];
$client_ID = $_GET["client_ID"];

// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 $sql = "SELECT * FROM cart where client_ID=$client_ID AND item_ID=$item_ID";
 echo $sql;
  
 $result = mysqli_query($con,$sql);
 
 $row = mysqli_fetch_array($result);
 ?>
 
 <form action="viewCart.php?job=update&client_ID=<?php echo $client_ID;?>&item_ID=<?php echo $item_ID;?>" method="post">
   Quantity: <input type="text" name="quantity" value=<?php echo $row['quantity'];?>><br>
   <input type="submit" value="Update">
</form>
  
<?php


mysqli_close($con);
?>




