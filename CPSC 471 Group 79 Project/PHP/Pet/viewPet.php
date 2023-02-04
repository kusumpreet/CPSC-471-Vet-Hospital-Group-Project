<?php

$vet_ID = $_GET['vet_ID'];
$user = $_GET['user'];
// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
if ($_GET["job"] == "update"){

//$name = filter_input (INPUT_POST, 'name');
//$sex = filter_input (INPUT_POST, 'sex');
//$species = filter_input (INPUT_POST, 'species');
//$height = filter_input (INPUT_POST, 'height');
//$weight = filter_input (INPUT_POST, 'weight');
//$color = filter_input (INPUT_POST, 'color');
//$age = filter_input (INPUT_POST, 'age');
//$owner_ID = filter_input (INPUT_POST, 'owner_ID');
$pet_ID    = $_POST['pet_ID'];  
$client_ID = $_POST['client_ID'];
$description = $_POST['description'];

$sql         = "call addPetMedical($client_ID, $pet_ID, '$description')";
//echo '<br> '.$sql;

$result = mysqli_query($con,$sql);
} 
  
//if ($_GET["job"] == "delete"){
//$id = $_GET["id"];
//$result = mysqli_query($con,"Delete from pet where id=". $id );
//
//}
mysqli_next_result($con);
$result = mysqli_query($con,"SELECT * FROM pet ORDER BY owner_id");

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Type</th>
<th>Weight</th>
<th>Color</th>
<th>Owner_id</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['id'] . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['type'] . "</td>";
  echo "<td>" . $row['weight'] . "</td>";
  echo "<td>" . $row['color'] . "</td>";
  echo "<td>" . $row['owner_id'] . "</td>";
  
  echo "<td><a href='../medical/view.php?pet_ID=" . $row['id'] . "&owner_ID=" . $row['owner_id'] . "&vet_ID=" . $vet_ID . "&pet_name=" . $row['name'] . "'>View Medical History</a></td>";
  
  
  echo "</tr>";
  }
echo "</table>";
echo '<br> <a href="../Employee/getEmployee.php?id='.$vet_ID.'">Go Back to My Profile</a>';
mysqli_close($con);
?>

