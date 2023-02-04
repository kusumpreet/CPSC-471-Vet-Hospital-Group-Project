
<?php

$id = $_GET["id"];

// Create connection
$con=mysqli_connect("localhost","root","alishalalani","animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$result = mysqli_query($con,"SELECT * FROM vet where vet_ID=".$id);

 if($row = mysqli_fetch_array($result))
  {
 
 ?>
 
 <form action="viewEmp.php?job=update&id=<?php echo $id;?>" method="post">
   <input name="id" type="hidden" value=<?php echo $row['vet_ID'];?>>
   First Name: <input type="text" name="firstName" value=<?php echo $row['f_name'];?>><br>
   Last Name: <input type="text" name="lastName" value=<?php echo $row['l_name'];?>><br>
   Username: <input type="text" name="username" value=<?php echo $row['username'];?>><br>
   Password: <input type="password" name="password" value=<?php echo $row['password'];?>><br>
   <input type="submit" value="Update">
</form>
  
<?php

}

mysqli_close($con);
?>



