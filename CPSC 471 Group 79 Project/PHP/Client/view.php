<?php
$admin_id = $_GET['id'];
$admin_user = $_GET['user'];
?>

<html>
    <head>
    <link rel ="stylesheet" href="login.css">
    <script src="calendar.js">
        
    </script>
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
$name = $_POST["name"];
$username = $_POST["username"];
$password = $_POST["password"];
$sql = "CALL updateClient($id, '$name', '$username', '$password')";
$result = mysqli_query($con,$sql);
header("Location: ../Client/getClient.php?id=".$id);
} 
  
if ($_GET["job"] == "delete"){
$client_ID = $_GET["client_ID"];
$result = mysqli_query($con,"Delete from client where id=". $client_ID );

}

$result = mysqli_query($con,"SELECT * FROM client");
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Name</th>
</tr>";
echo '<br> All Clients <br>';

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['id'] . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  //echo "<td><a href='updateClient.php?id=" . $row['id'] . "'>Update</a></td>";
  //echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='view.php?job=delete&amp;id=" . $row['id'] . "'>DELETE</a></td>";
  echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='view.php?job=delete&amp;client_ID=" . $row['id'] . "&user=". $admin_user ."&id=". $admin_id ."'>DELETE</a></td>";

  
  echo "</tr>";
  }
echo "</table>";

mysqli_close($con);
?>

