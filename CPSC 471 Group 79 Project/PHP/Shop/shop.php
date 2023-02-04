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
    if(isset($_POST['filterSelect']) )
        {
          $c = $_POST['filterSelect'];
          $filter = "call getAllFiltered($c)";
          if ($c == 0)//means they picked the 'None' option
          {
              $filter = "call getAllItems(5)";
          }
        }
    else
    {
        $filter = "call getAllItems(5)";
    }

    
    echo "<form method=post name=filterProduct action='shop.php?client_ID=$client_ID'>";

    echo '<table border="0" cellspacing="0" > <tr> <td>';
    echo 'Filter By <br>';
    echo'<select id="filter" name="filterSelect">';
    $sql = "SELECT * FROM category";
    $result = mysqli_query($con, $sql);
    
  while ($row = mysqli_fetch_array($result))
    {
    $name = $row['name'];
    $id = $row['id'];
    echo "<option value='$id'> $name </option>";
    }
    echo '</select> </td> </tr> <tr> <td>';
    echo '<input type=submit value=Submit>';
    echo '</form>';
    
    mysqli_next_result($con);
    echo '<br>';
    echo '<br>';
    
    echo 'Items For Sale <br>';
    //echo "{\"name\": \"$name\"}";
    echo "<table border='1'>
    <tr>
    <th>Name</th>
    <th>Price</th>
    <th>Image</th>
    <th>Category</th>
    <th> </th>
    </tr>";

    $result = mysqli_query($con,$filter);
    while ($row = mysqli_fetch_array($result))
      {
      $image = $row['image'];
      $name = $row['name'];
      echo "<tr>";
      echo "<td>" . $name . "</td>";
      echo "<td> $" . $row['price'] . "</td>";
      echo "<td><img src='$image' alt='$name' height='100' style='text-align:center;'></td>";
      echo "<td>" . $row['category'] . "</td>";
      echo "<td><a href='cart.php?client_ID=$client_ID&item_ID=" .$row['id']."'>Add to Cart</a></td>";
      echo "</tr>";
      }
      
    echo "</table>";
    echo '<br>';
      
    echo 'Top 3 Best Sellers <br>';
    //echo "{\"name\": \"$name\"}";
    echo "<table border='1'>
    <tr>
    <th>Name</th>
    <th>Price</th>
    <th>Image</th>
    <th>Category</th>
    <th> </th>
    </tr>"; 
    
    //put this between stored procedures
    mysqli_next_result($con);
    $sql = "call getBestSeller(3)";
    $r = mysqli_query($con,$sql);
    
    while ($row = mysqli_fetch_array($r))
      {
      $image = $row['image'];
      $name = $row['name'];
      echo "<tr>";
      echo "<td>" . $name . "</td>";
      echo "<td> $" . $row['price'] . "</td>";
      echo "<td><img src='$image' alt='$name' height='100' style='text-align:center;'></td>";
      echo "<td>" . $row['category'] . "</td>";
      echo "<td><a href='cart.php?client_ID=$client_ID&item_ID=" .$row['id']."'>Add to Cart</a></td>";
      echo "</tr>";
      }
      
      echo "</table>";
      echo '<br>';
      echo "<a href='viewCart.php?client_ID=$client_ID'>View Cart</a>";
      echo '<br>';
      echo "<a href='../Client/getClient.php?id=$client_ID'>Go Back To My Profile</a>";
     }
    echo '<br>';
      
  
  mysqli_close($con);
?>

