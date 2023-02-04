<?php
$admin_id = $_GET['id'];
$admin_user = $_GET['user'];
?>

<html>
    <head>
    <link rel ="stylesheet" href="login.css">
    </head>    
    <body>

    <nav class="nav">
        <div class="logo">
            <h4><a href="Home.html">Norman Hospital</a></h4>
        </div>
        <ul class="nav-links">
            <li><a href="About.html">About</a></li>
            <li><a href="../main/login.php">Logout</a></li>
            <li><a href="../user/check.php?id=<?php echo $admin_id;?>&user=<?php echo $admin_user;?>">Go Back to My Profile</a></li>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>
        <p> <p> <p> <p>

<?php

// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
if ($_GET["job"] == "update"){

$id = $_POST["id"];
$f_name = $_POST["f_name"];
$l_name = $_POST["l_name"];
$username = $_POST["username"];
$password = $_POST["password"];
$sql = "CALL updateEmployee($id, '$f_name','$l_name', '$username', '$password')";
$result = mysqli_query($con,$sql);
} 
  
if ($_GET["job"] == "delete"){
$vet_ID = $_GET["vet_ID"];
$result = mysqli_query($con,"Delete from vet where vet_ID=". $vet_ID );

}

$result = mysqli_query($con,"SELECT * FROM vet ORDER BY type");

echo "<table border='1'>
<tr>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Type</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  $t = $row['type'];
 if ($t == 0)
 {
     $type = 'Vet';
 }
 else if ($t ==1)
 {
     $type = 'Receptionist';
 }
    
    
  echo "<tr>";
  echo "<td>" . $row['vet_ID'] . "</td>";
  echo "<td>" . $row['f_name'] . "</td>";
  echo "<td>" . $row['l_name'] . "</td>";
  echo "<td>" . $type          . "</td>";
  echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='viewAll.php?job=delete&amp;vet_ID=" . $row['vet_ID'] . "&user=". $admin_user ."&id=". $admin_id ."'>DELETE</a></td>";
  
  echo "</tr>";
  }
echo "</table>";
echo '<br>';
echo "<a href='signUp.php?id=$admin_id&user=$admin_user'>Add Employee </a> <br>";
mysqli_close($con);
?>


