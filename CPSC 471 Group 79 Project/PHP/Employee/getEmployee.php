<?php

$id = $_GET ['id'];
$today = date("Y-m-d");
// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
  
else
    {
    $sql = "SELECT * From vet WHERE vet_ID = $id";

    $result = mysqli_query($con,$sql);

    echo '<a href="../main/login.php">Logout</a> <br>';
    echo '<br>';
    
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
    $user = $row['username'];
    echo "<tr>";
    echo "<td>" . $row['vet_ID'] . "</td>";
    echo "<td>" . $row['f_name'] . "</td>";
    echo "<td>" . $row['l_name'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td><a href='updateEmployee.php?id=" . $row['vet_ID'] . "'>Edit Profile</a></td>";
    echo '<br>';

    echo "</tr>";

    echo "</table>";
    echo '<br>';
     
    echo '<br>';
    echo 'Upcoming Shifts <br>';
    
    $sql = "call getShift($id)";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result))
        {
        $start_time = $row['start_time'];
        $start_type = "PM";
         if ($start_time < 12)
         {
             $start_type = "AM";
         }
         else if ($start_time > 12)
         {
             $start_time = $start_time - 12;
         }      

         $end_time = $row['end_time'];
         $end_type = "PM";
         if ($end_time < 12)
         {
             $end_type = "AM";
         }
         else if ($end_time > 12)
         {
             $end_time = $end_time - 12;
         }   
        
        
        $date = $row['date'];

        if ($date >= $today)
            {
            echo "<table border='1'>
            <tr>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th> </th>
            </tr>";      
            
            echo "<tr>";
            echo "<td>" . $date . "</td>";
            echo "<td>" . $start_time. ":00 $start_type</td>";
            echo "<td>" . $end_time . ":00 $end_type</td>";
            echo "<td><a href='../shift/deleteShift.php?id=" . $row['vet_ID'] . "&date=" . $date . "'>Cancel Shift</a></td>";
            echo '<br>';            
            }
        }
        
          echo "</table>";
          echo '<br>';  
        
    echo "<a href='../shift/schedule.php?id=$id&user=$user'>View Shift Schedule </a> <br>";
    echo "<a href='../shift/apptSchedule.php?id=$id&user=$user'>View Appointment Schedule </a> <br>";
    echo "<a href='../pet/viewPet.php?vet_ID=$id&user=$user'>View Pets </a> <br>";
        
    echo '<br> Unanswered Questions: <br> ';
    mysqli_next_result($con);
    $sql = "SELECT * FROM question WHERE vet_ID = -1";
    $result = mysqli_query($con,$sql);
    echo "<table border='1'>
    <tr>
    <th>Question</th>
    <th>Client Name</th>
    <th>Client ID</th>
    <th> </th>
    </tr>";  
    
    while ($row = mysqli_fetch_array($result))
    {
        $client_ID = $row['client_ID'];
        $getClient = "SELECT * FROM CLIENT WHERE id=$client_ID";
        $c = mysqli_query($con,$getClient);
        $client = mysqli_fetch_array($c);
        $c_name = $client['name'];
                
        echo "<tr>";
        echo "<td>" . $row['question'] . "</td>";
        echo "<td>" . $c_name . "</td>";
        echo "<td>" . $client_ID . "</td>";
        echo "<td><a href='../main/updateQuestion.php?ques_ID=" . $row['id'] . "&vet_ID=$id'>Answer Question</a></td>";
        echo '<br>';                
        }
        
    echo "</table>";
    echo '<br>';
  }
  
?>
  