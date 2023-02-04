<?php

$vet_ID   = $_GET['vet_ID'];
$pet_ID   = $_GET['pet_ID'];
$owner_ID = $_GET['owner_ID'];
$pet_name = $_GET['pet_name'];
// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
if ($_GET["job"] == "update"){

$name = filter_input (INPUT_POST, 'name');
$sex = filter_input (INPUT_POST, 'sex');
$species = filter_input (INPUT_POST, 'species');
$height = filter_input (INPUT_POST, 'height');
$weight = filter_input (INPUT_POST, 'weight');
$color = filter_input (INPUT_POST, 'color');
$age = filter_input (INPUT_POST, 'age');
$owner_ID = filter_input (INPUT_POST, 'owner_ID');
 
$result = mysqli_query($con,"update pet set name='".$name. "', sex = '".$sex."', species = '".$species."', height = '".$height."', weight = '".$weight."', color = '".$color."', age = '".$age."', owner_ID = '".owner_ID."' where id=". $id);

} 
  
if ($_GET["job"] == "delete"){
$id = $_GET["id"];
$result = mysqli_query($con,"Delete from pet where id=". $id );

}

$result = mysqli_query($con,"SELECT * FROM petmedical WHERE pet_ID=$pet_ID AND client_ID=$owner_ID ORDER BY date DESC");


echo "<table border='1'>
<tr>
<th>Client ID</th>
<th>Pet ID</th>
<th>Pet name</th>
<th>Description</th>
<th>Date</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['client_ID'] . "</td>";
  echo "<td>" . $row['pet_ID'] . "</td>";
  echo "<td>" . $pet_name . "</td>";
  echo "<td>" . $row['description'] . "</td>";
  echo "<td>" . $row['date'] . "</td>";
  
  
  echo "</tr>";
  }
echo "</table>";
//echo '<br> <a href="addMedical.php?id='.$vet_ID.'&pet_ID='.$pet_ID.'">Add To Medical History</a>';
echo "<br> <a href='addMedical.php?vet_ID=$vet_ID&pet_ID=$pet_ID&client_ID=$owner_ID'>Add To Medical History</a>";
echo '<br>';
echo '<br> <a href="../Employee/getEmployee.php?id='.$vet_ID.'">Go Back to My Profile</a>';
mysqli_close($con);
?>


