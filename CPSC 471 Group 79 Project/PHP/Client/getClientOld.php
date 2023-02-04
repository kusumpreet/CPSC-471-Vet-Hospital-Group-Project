<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="profile.css">
    </head>
    <body>
        
    </body>
 </html>   

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
    if ($_GET["job"] == "delete")
        {
        $pet_ID = $_GET["pet_ID"];
        $sql = "CALL deletePet($id, $pet_ID)";
        $result = mysqli_query($con, $sql);
        }
        
    if ($_GET["job"] == "update"){ //fix
        $pet_ID = $_GET["pet_ID"];
        $name = $_POST["name"];
        $type = $_POST["type"];
        $weight = $_POST["weight"];
        $color = $_POST["color"];
        $result = mysqli_query($con,"call updatePet($pet_ID, $id, '$name', '$type', $weight, '$color')");
        } 
       
    $sql = "SELECT * From client WHERE id = $id";

    $result = mysqli_query($con,$sql);

    echo '<a href="../main/login.php">Logout</a> <br>';
    
        

    echo 'My Profile <br>';
    //echo "{\"name\": \"$name\"}";
    echo "<table border='1'>
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Username</th>
    <th> </th>
    </tr>";
  
 $row = mysqli_fetch_array($result);
 $client_ID = $row['id'];
 
  echo "<tr>";
  echo "<td>" . $row['id'] . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='../Client/updateClient.php?id=" . $row['id'] . "'>Edit Profile</a></td>";
  echo '<br>';
  
  echo "</tr>";
  
  echo "</table>";
  echo '<br>';

  }
  
  
  echo '<br> REMINDERS: <br>';
  echo '<br>';
  mysqli_next_result($con);
  $sql = "call getAppt($id)";
  echo '<br>';
  //echo $sql.'<br>';
  
  $result = mysqli_query($con,$sql);
 while ($row = mysqli_fetch_array($result))
    {
    $appt_date = $row['date'];
    $today_date = date("Y-m-d");

    $date1 = (strtotime($appt_date));
    $date2 = (strtotime($today_date));
    $interval = ($date1 - $date2)/60/60/24;
    if ($interval >0 && $interval <= 7)
        {
        echo "<br> You have an upcoming appointment soon! Appointment Date: $appt_date";
        echo "<br>For more Information, view the upcoming appointments section <br> <br> ";
        }
    }
mysqli_next_result($con);
  $result = mysqli_query($con,"SELECT * From pet WHERE owner_id = $id");
  
//  echo "<table border='1'>
//    <tr>
//    <th>ID</th>
//    <th>Name</th>
//    </tr>";
  
  echo 'My Pets <br>';
  echo '<br>';
  
  while ($row = mysqli_fetch_array($result))
  {
$pet = $row['id'];
$profile_img = "uploads/pet$pet.jpg";
$default = "uploads/profiledefault.png";

if (file_exists($profile_img))
    {
    $random = mt_rand();
    $image = $profile_img.'?'.$random;
    //echo '<a href="uploadMain.php?id='.$id.'" width=100 height=100> Change Profile Picture </a>';
    }
else
    {
    $image= $default;
    //echo '<a href="uploadMain.php?id='.$id.'" width=100 height=100> Upload a Profile Picture </a>';
    }
    
  // mysqli_next_result($con);
  
  $sql = "SELECT * FROM appointment WHERE appType=2 AND pet_ID= $pet AND date > date_sub(curdate(), Interval 3 month)" ;
  $r = mysqli_query($con,$sql);
  $num_rows = mysqli_num_rows($r);

 ?>
 
 
    <div class="card">
      <img src=<?php echo $image?> alt="Pet picture" style="width:100%">
      <h1><?php echo $row['name'];?></h1>
      <p>Type: <?php echo $row['type'];?> </p>
      <p>Weight: <?php echo $row['weight'];?> lbs</p>
      <p>Color: <?php echo $row['color'];?> </p>
<?php
  if ($num_rows == 0)
    {
     echo '<p><span style="color:red;"> Check Up Needed!</p>' ;
    }
?>      
      
      <p> <a href = '../Pet/updatePet.php?pet_ID=<?php echo $row['id']; ?>&owner_ID=<?php echo $client_ID; ?>'> <span class="petProfile">Edit</span> </a></p>
    </div>
      
<?php      
  
echo '<br>';
  }
  
   
   echo "</table>";
   echo '<br>';
   echo '<a href="../Pet/newPet.php?id='.$client_ID.'">addPet</a>';
   echo '<br>';
   echo '<br>';
   
   echo 'My Billing History <br>';
   echo '<br>';
   
   $result = mysqli_query($con,"SELECT name,cost,quantity,timeStamp,itemPrice From billing WHERE client_ID = $id ORDER BY timeStamp DESC");
   
     echo "<table border='1'>
    <tr>
    <th>Name</th>
    <th>Cost/item</th>
    <th>Quantity</th>
    <th>Total Cost</th>
    <th>TimeStamp</th>
    </tr>";
  
  echo 'Products Bought';
  
  while ($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td> $" . $row['cost'] . "</td>";
  echo "<td>" . $row['quantity'] . "</td>";
  echo "<td> $" . $row['itemPrice'] . "</td>";
  echo "<td>" . $row['timeStamp']. "</td>";
  echo "</tr>";
  }

  echo "</table>";
  echo '<br>';

   
   $result = mysqli_query($con,"SELECT * From billingA WHERE client_ID = $id");
   
     echo "<table border='1'>
    <tr>
    <th>Appointment Type</th>
    <th>Pet name</th>
    <th>Date</th>
    <th>Time</th>
    <th>Cost</th>
    </tr>";
  
   echo 'Services Bought';
   
   while ($row = mysqli_fetch_array($result))
   {
   
   $pet_ID = $row['pet_ID'];
   $r = mysqli_query($con,"SELECT name From pet WHERE owner_ID=$id AND id=$pet_ID");
   $rr = mysqli_fetch_array($r);
   $pet_name = $rr['name'];
   $apType = $row['appType'];
   $s = mysqli_query($con,"SELECT name From appType WHERE id=$apType");
   $ss = mysqli_fetch_array($s);
   $time = $row['time'];
   
       $type = "PM";
    if ($time < 12)
    {
        $type = "AM";
    }
    else if ($time > 12)
    {
        $time = $time - 12;
    }   
   
   $app_name = $ss['name'];
   echo "<tr>";
   echo "<td>" . $app_name . "</td>";
   echo "<td>" . $pet_name . "</td>";
   echo "<td>" . $row['date'] . "</td>";
   echo "<td>" .$time . ":00 $type</td>";
   echo "<td> $" . $row['cost']. "</td>";
   echo "</tr>";
   }

  echo "</table>";
  echo '<br>';  
  
  
  
  echo '<a href="../Shop/shop.php?client_ID='.$client_ID.'">Go To Shop</a>';
  echo '<br>';
  echo '<br>';
  echo '<a href="../appointment/book.php?client_ID='.$client_ID.'">Book an Appointment</a>';
  
  echo '<br>';
  echo '<br>';
  mysqli_next_result($con);
  echo 'Upcoming Appointments';
  $sql = "call getAppt($id)";
  echo '<br>';
  //echo $sql.'<br>';
  
  $result = mysqli_query($con,$sql);

  echo "<table border='1'>
    <tr>
    <th>Appointment Type</th>
    <th>Pet Name</th>
    <th>Date</th>
    <th>Time</th>
    <th>Need to Cancel?</th>
    </tr>";
  
  while ($row = mysqli_fetch_array($result))
    {
      $type = "PM";
      $original_time = $row['time'];
      $time = $original_time;
      if ($time < 12)
      {
          $type = "AM";
      }
      else if ($time > 12)
      {
          $time = $time - 12;
      }    
    $pet_ID = $row['pet_ID'];
    $appt_date = $row['date'];

    $today_date = date("Y-m-d");
    //echo '<br> appointment date: '.$appt_date.'<br>';
    //echo "pet id: $pet_ID <br>";
    //echo "todays date: $today_date <br>";
    //echo "original time: $original_time <br>";
    //echo "time: $time <br>";

    $date1 = (strtotime($appt_date));
   // echo " date1: $date1 <br>";
    $date2 = (strtotime($today_date));
   // echo " date2: $date2 <br>";
    $interval = ($date1 - $date2)/60/60/24;
    
   // $interval = $appt_date->diff($today_date);
    //echo "interval: $interval <br>";
    //echo "difference: $difference <br>";
    if ($interval > 0)
        {
        //shows the total amount of days (not divided into years, months and days like above)
        echo "<tr>";
        echo "<td>" . $row['appointment_name'] . "</td>";
        echo "<td>" . $row['pet_name'] . "</td>";
        echo "<td>" . $appt_date . "</td>";
        echo "<td>" . $time . ":00 ". $type." </td>";
        echo "<td><a href=\"javascript:cancelAppt('$appt_date', $interval, $original_time, $pet_ID)\">CANCEL</a></td>";
        echo "</tr>";
        }
    }

  echo "</table>";
  echo '<br>';
  
  echo '<a href="../main/contact.php?client_ID='.$client_ID.'">Ask a Question</a>';
  
  echo '<br> My questions <br>';
  mysqli_next_result($con);
  
  echo "<table border='1'>
    <tr>
    <th>Question</th>
    <th>Answer</th>
    <th>Answered By Vet:</th>
    <th>Remove Question</th>
    </tr>";
  
  $result = mysqli_query($con,"SELECT * From question WHERE client_ID = $id");
  while ($row = mysqli_fetch_array($result))
    {
    $ques_ID = $row['id'];
    $answer = $row['answer'];
    $vet_ID = $row['vet_ID'];
    if ($vet_ID > -1)
    {
    $r = mysqli_query($con,"SELECT * From vet WHERE vet_ID = $id");
    $vet = mysqli_fetch_array($r);
    $vet_name = $vet['f_name'] . ' ' . $vet['l_name'];
    }
 else {
        $answer = "Question not answered yet";
        $vet_name = "-----";
    }
    
    echo "<tr>";
    echo "<td>" . $row['question'] . "</td>";
    echo "<td> " . $answer . "</td>";
    echo "<td> " . $vet_name. "</td>";
    echo "<td><a onClick= \"return confirm('Do you want to delete this question?')\" href='../main/contact.php?job=delete&amp;ques_ID=$ques_ID&client_ID=$id'>DELETE</a></td>";
    echo "</tr>";
    }
  
  echo "</table>";
  echo '<br>';
  
//  echo 'Recommended For You <br>';
//  mysqli_next_result($con);
//  
//  $sql = "SELECT * FROM appointment WHERE appType=2 AND date > date_sub(curdate(), Interval 3 month)" ;
//  $result = mysqli_query($con,$sql);
//  $num_rows = mysqli_num_rows($result);
//  if ($num_rows == 0)
//    {
//     echo '<br><span style="color:red;"> It is time for you to have a check up for your pet! It has been over 3 months since your last booking </span>' ;
//     echo '<br>';
//     echo '<br>';
//     echo '<br>';
//     echo '<br>';
//    }
  
  mysqli_close($con);
?>

<script>
function cancelAppt(d, diff, t, p)
    {
    if (diff <= 7)
        {
        let conf = confirm('Do you want to cancel this appointment? You will not get a refund');
        if (conf)
            window.location.href = "../appointment/deleteAppt.php?"
                                 + "client_ID=<?php echo $client_ID;?>"
                                 + "&pet_ID=" + p
                                 + "&date=" + d
                                 + "&time=" + t
                                 ;
        }
    else
        {
        let conf = confirm('Do you want to cancel this appointment? You will receive a refund for your purchase');
        if (conf)
            window.location.href = "../appointment/deleteApptR.php?"
                                 + "client_ID=<?php echo $client_ID;?>"
                                 + "&pet_ID=" + p
                                 + "&date=" + d
                                 + "&time=" + t
                                 ;
        }
    }
</script>