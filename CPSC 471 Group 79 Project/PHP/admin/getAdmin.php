<?php

$id = $_GET ['id'];

// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
else
    {
       
    $sql = "SELECT * From admin WHERE id = $id";

    $result = mysqli_query($con,$sql);

    echo '<a href="../main/login.php">Logout</a> <br>';
    
    echo 'My Profile <br>';
    //echo "{\"name\": \"$name\"}";
    echo "<table border='1'>
    <tr>
    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Username</th>
    <th> </th>
    </tr>";
    
 $row = mysqli_fetch_array($result);
 $client_ID = $row['id'];
 $user = $row['username'];
 
  echo "<tr>";
  echo "<td>" . $row['id'] . "</td>";
  echo "<td>" . $row['f_name'] . "</td>";
  echo "<td>" . $row['l_name'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='updateAdmin.php?id=" . $row['id'] . "'>Edit Profile</a></td>";
  echo '<br>';
  
  echo "</tr>";
  
  echo "</table>";
  echo '<br>';

  echo '<a href="../shift/shift.php?id=1">Schedule a New Shift</a> <br>';
  
  echo "<a href='../shift/schedule.php?id=$id&user=$user'>View Schedule </a> <br>";
  
  echo "<a href='../Client/view.php?id=$id&user=$user'>View Clients </a> <br>";
  
  echo "<a href='../Employee/viewAll.php?id=$id&user=$user'>View Employees </a> <br>";
  }
  
?>
  
