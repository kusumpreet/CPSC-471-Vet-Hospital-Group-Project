<html>
 PHP test program
<?php



// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $sql = "SELECT client_ID, Name From client";

$result = mysqli_query($con,$sql);

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Name</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['client_ID'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysqli_close($con);

?>
</html>
