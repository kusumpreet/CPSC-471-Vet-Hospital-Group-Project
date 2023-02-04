<?php

$id = $_GET ['id'];
$client_ID = $id;

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

    //echo '<a href="../main/login.php">Logout</a> <br>';
    
    $client = mysqli_fetch_array($result);
    $id = $client['id'];
    $username = $client['username'];
    $client_name = $client['name'];

  
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
//mysqli_next_result($con);
//  $result = mysqli_query($con,"SELECT * From pet WHERE owner_id = $id");
//  
////  echo "<table border='1'>
////    <tr>
////    <th>ID</th>
////    <th>Name</th>
////    </tr>";
//  
//  echo 'My Pets <br>';
//  echo '<br>';
//  
//  while ($row = mysqli_fetch_array($result))
//  {
//$pet = $row['id'];
//$profile_img = "uploads/pet$pet.jpg";
//$default = "uploads/profiledefault.png";
//
//if (file_exists($profile_img))
//    {
//    $random = mt_rand();
//    $image = $profile_img.'?'.$random;
//    //echo '<a href="uploadMain.php?id='.$id.'" width=100 height=100> Change Profile Picture </a>';
//    }
//else
//    {
//    $image= $default;
//    //echo '<a href="uploadMain.php?id='.$id.'" width=100 height=100> Upload a Profile Picture </a>';
//    }
//    
//  // mysqli_next_result($con);
//  
//  $sql = "SELECT * FROM appointment WHERE appType=2 AND pet_ID= $pet AND date > date_sub(curdate(), Interval 3 month)" ;
//  $r = mysqli_query($con,$sql);
//  $num_rows = mysqli_num_rows($r);

//  if ($num_rows == 0)
//    {
//     echo '<p><span style="color:red;"> Check Up Needed!</p>' ;

//<?php      
//  
//echo '<br>';
//  }
//  
//
//   $result = mysqli_query($con,"SELECT name,cost,quantity,timeStamp,itemPrice From billing WHERE client_ID = $id ORDER BY timeStamp DESC");
//
//  while ($row = mysqli_fetch_array($result))
//  {
//  echo "<tr>";
//  echo "<td>" . $row['name'] . "</td>";
//  echo "<td> $" . $row['cost'] . "</td>";
//  echo "<td>" . $row['quantity'] . "</td>";
//  echo "<td> $" . $row['itemPrice'] . "</td>";
//  echo "<td>" . $row['timeStamp']. "</td>";
//  echo "</tr>";
//  }
//
//
//   
//   $result = mysqli_query($con,"SELECT * From billingA WHERE client_ID = $id");
//   
//   while ($row = mysqli_fetch_array($result))
//   {
//   
//   $pet_ID = $row['pet_ID'];
//   $r = mysqli_query($con,"SELECT name From pet WHERE owner_ID=$id AND id=$pet_ID");
//   $rr = mysqli_fetch_array($r);
//   $pet_name = $rr['name'];
//   $apType = $row['appType'];
//   $s = mysqli_query($con,"SELECT name From appType WHERE id=$apType");
//   $ss = mysqli_fetch_array($s);
//   $time = $row['time'];
//   
//       $type = "PM";
//    if ($time < 12)
//    {
//        $type = "AM";
//    }
//    else if ($time > 12)
//    {
//        $time = $time - 12;
//    }   
//   
//   $app_name = $ss['name'];
//   echo "<tr>";
//   echo "<td>" . $app_name . "</td>";
//   echo "<td>" . $pet_name . "</td>";
//   echo "<td>" . $row['date'] . "</td>";
//   echo "<td>" .$time . ":00 $type</td>";
//   echo "<td> $" . $row['cost']. "</td>";
//   echo "</tr>";
//   }
//
//  
//  
//  echo '<a href="../Shop/shop.php?client_ID='.$client_ID.'">Go To Shop</a>';
//  echo '<br>';
//  echo '<br>';
//  echo '<a href="../appointment/book.php?client_ID='.$client_ID.'">Book an Appointment</a>';
//  
//  echo '<br>';
//  echo '<br>';
//  mysqli_next_result($con);
//  echo 'Upcoming Appointments';
//  $sql = "call getAppt($id)";
//  echo '<br>';
//  //echo $sql.'<br>';
//  
//  $result = mysqli_query($con,$sql);
//
//  echo "<table border='1'>
//    <tr>
//    <th>Appointment Type</th>
//    <th>Pet Name</th>
//    <th>Date</th>
//    <th>Time</th>
//    <th>Need to Cancel?</th>
//    </tr>";
//  
//  while ($row = mysqli_fetch_array($result))
//    {
//      $type = "PM";
//      $original_time = $row['time'];
//      $time = $original_time;
//      if ($time < 12)
//      {
//          $type = "AM";
//      }
//      else if ($time > 12)
//      {
//          $time = $time - 12;
//      }    
//    $pet_ID = $row['pet_ID'];
//    $appt_date = $row['date'];
//
//    $today_date = date("Y-m-d");
//    //echo '<br> appointment date: '.$appt_date.'<br>';
//    //echo "pet id: $pet_ID <br>";
//    //echo "todays date: $today_date <br>";
//    //echo "original time: $original_time <br>";
//    //echo "time: $time <br>";
//
//    $date1 = (strtotime($appt_date));
//   // echo " date1: $date1 <br>";
//    $date2 = (strtotime($today_date));
//   // echo " date2: $date2 <br>";
//    $interval = ($date1 - $date2)/60/60/24;
//    
//   // $interval = $appt_date->diff($today_date);
//    //echo "interval: $interval <br>";
//    //echo "difference: $difference <br>";
//    if ($interval > 0)
//        {
//        //shows the total amount of days (not divided into years, months and days like above)
//        echo "<tr>";
//        echo "<td>" . $row['appointment_name'] . "</td>";
//        echo "<td>" . $row['pet_name'] . "</td>";
//        echo "<td>" . $appt_date . "</td>";
//        echo "<td>" . $time . ":00 ". $type." </td>";
//        echo "<td><a href=\"javascript:cancelAppt('$appt_date', $interval, $original_time, $pet_ID)\">CANCEL</a></td>";
//        echo "</tr>";
//        }
//    }
//
//  echo "</table>";
//  echo '<br>';
//  
//  echo '<a href="../main/contact.php?client_ID='.$client_ID.'">Ask a Question</a>';
//  
//  echo '<br> My questions <br>';
//  
//  $result = mysqli_query($con,"SELECT * From question WHERE client_ID = $id");
//  while ($row = mysqli_fetch_array($result))
//    {
//    $ques_ID = $row['id'];
//    $answer = $row['answer'];
//    $vet_ID = $row['vet_ID'];
//    if ($vet_ID > -1)
//    {
//    $r = mysqli_query($con,"SELECT * From vet WHERE vet_ID = $id");
//    $vet = mysqli_fetch_array($r);
//    $vet_name = $vet['f_name'] . ' ' . $vet['l_name'];
//    }
// else {
//        $answer = "Question not answered yet";
//        $vet_name = "-----";
//    }
//    
//    echo "<tr>";
//    echo "<td>" . $row['question'] . "</td>";
//    echo "<td> " . $answer . "</td>";
//    echo "<td> " . $vet_name. "</td>";
//    echo "<td><a onClick= \"return confirm('Do you want to delete this question?')\" href='../main/contact.php?job=delete&amp;ques_ID=$ques_ID&client_ID=$id'>DELETE</a></td>";
//    echo "</tr>";
//    }


?>

<script>
function cancelAppt(d, diff, t, p)
    {
    if (diff <= 7)
        {
        let conf = confirm('Do you want to cancel this appointment? You will not get a refund');
        if (conf)
            window.location.href = "../appointment/deleteAppt.php?"
                                 + "client_ID=<?php echo $id;?>"
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
                                 + "client_ID=<?php echo $id;?>"
                                 + "&pet_ID=" + p
                                 + "&date=" + d
                                 + "&time=" + t
                                 ;
        }
    }
</script>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Norman Hospital</title>
  <link rel="stylesheet" href="profilePage.css">
  <link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="profile.css">
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@600&display=swap" rel="stylesheet">
  <link rel="icon" href="images/favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script scr="app.js"></script>
  <script scr="js/login.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">

  <!-- Required meta tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  

  
</head>

<body>
    <nav class="nav">
        <div class="logo">
            <h4><a href="Home.html">Norman Hospital</a></h4>
        </div>
        <ul class="nav-links">
            <li><a href="../appointment/book.php?client_ID=<?php echo $id;?>">Book Appointment</a></li>
            <li><a href="../main/contact.php?client_ID=<?php echo $id;?>">Ask Question</a></li>
            <li><a href="../Shop/shop.php?client_ID=<?php echo $id;?>">Shop</a></li>
            <li><a href="../main/login.php">Logout</a></li>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>

    <div class="container">
        <div class="main">
            <div class="topbar" style="margin-top: 120px;">
                <a>My Profile</a>
                <button type="button" class="btn" onclick="location.href='../main/login.php'">Log Out</button>
            </div>
        <div class="row">
            <div class="col-md-4 mt-1">
                <div class="card text-center sidebar">
                    <div class="card-body" style="margin-top: 60px;">

<?php  
$profile_img = "uploads/client$id.jpg";
$default = "uploads/profiledefault.png";

if (file_exists($profile_img))
    {
    $random = mt_rand();
    $toPrint = $profile_img.'?'.$random;
    //echo "<img src=$profile_img?$random> <br>";
    //echo '<a href="uploadMain.php?id='.$id.'" width=100 height=100> Change Profile Picture </a>';
    }
else
    {
    $toPrint = $default;
    //echo "<img src=$default> <br>";
    //echo '<a href="uploadMain.php?id='.$id.'" width=100 height=100> Upload a Profile Picture </a>';
    }
?>
                        
                        
                        <img src=<?php echo $toPrint; ?> class="rounded-circle" width="150">
                    </div>
                </div>
            </div>
        
        <div class="col-md-8 mt-1">
            <div class="card mb-3 content">
                <h1 class="m-3 pt-3">About</h1>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5>Name</h5>
                        </div>
                        <div class="col-md-9 text-secondary">
                            <h6><?php echo $client_name; ?></h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <h5>ID</h5>
                        </div>
                        <div class="col-md-9 text-secondary">
                            <h6><?php echo $id; ?></h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <h5>Username</h5>
                        </div>
                        <div class="col-md-9 text-secondary">
                            <h6><?php echo $username; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="topbar">
<!--            //echo "<td><a href='../Client/updateClient.php?id=" . $row['id'] . "'>Edit Profile</a></td>";-->
            <button type="button" class="btn" onclick="location.href='../Client/updateClient.php?id=<?php echo $id;?>'">Edit Profile</button>
        </div>
        </div>
    </div>

    <div class="shop-page-heading" class="con-mypet" style="padding-left: 80px;">
        <div class="topbar" style="margin-top: 120px;padding-right: 80px;">
            <a>My Pets</a>
            <!--echo '<a href="../Pet/newPet.php?id='.$client_ID.'">addPet</a>';-->
            <button type="button" class="btn" onclick="location.href='../Pet/newPet.php?id=<?php echo $id;?>'">Add Pets</button>
        </div>
        
<?php         
   mysqli_next_result($con);
  $result = mysqli_query($con,"SELECT * From pet WHERE owner_id = $id");
  
  while ($row = mysqli_fetch_array($result))
  {
    $pet = $row['id'];
    $pet_name    = $row['name'];
    $pet_type    = $row['type'];
    $pet_weight  = $row['weight'];
    $pet_color   = $row['color'];
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
    
  mysqli_next_result($con);
  $sql = "SELECT * FROM appointment WHERE appType=2 AND pet_ID= $pet AND date > date_sub(curdate(), Interval 3 month)" ;
//  echo '<br> sql: '.$sql;
  $r = mysqli_query($con,$sql);
  $num_rows_checkup = mysqli_num_rows($r);
  
    mysqli_next_result($con);
  $sql = "SELECT * FROM appointment WHERE appType=1 AND pet_ID= $pet AND date > date_sub(curdate(), Interval 6 month)" ;
//  echo '<br> sql: '.$sql;
  $r = mysqli_query($con,$sql);
  $num_rows_vacc = mysqli_num_rows($r);

 ?>
 
    <div class="cardP">
      <img src=<?php echo $image?> alt="Pet picture" style="width:100%">
      <h1><?php echo $pet_name;?></h1>
      <p>Type: <?php echo $pet_type;?> </p>
      <p>Weight: <?php echo $pet_weight;?> lbs</p>
      <p>Color: <?php echo $pet_color;?> </p>
      <p> <a href = '../Pet/updatePet.php?pet_ID=<?php echo $pet; ?>&owner_ID=<?php echo $id; ?>'> <span class="petProfile">Edit</span> </a></p>
<?php
//<span style="color:red;"> 
  if ($num_rows_checkup == 0)
    {
     echo '<p>Check Up Needed! It has been over 3 months since this pet received a check up</p>' ;
    }
  if ($num_rows_vacc == 0)
    {
     echo '<p> Vaccination Needed! It has been over 6 months since this pet received a vaccination</p>' ;
    }  
?>      
    </div>
<?php 
  }
  ?>

    </div>
    <p> <p> <p>
    <h1 style="margin-left: 115px; text-align: center;">My Billing History</h1>

    <div class="container">
        <div class="main">
            <div class="topbar" style="margin-top: 120px;">
                <a>Products Bought</a>
                <button type="button" class="btn" onclick="location.href='../Shop/shop.php?client_ID=<?php echo $client_ID;?>'">Go To Shop</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Cost/Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Cost</th>
                            <th scope="col">TimeStamp</th>
                        </tr>
                    </thead>
                    
   <?php 
       $result = mysqli_query($con,"SELECT name,cost,quantity,timeStamp,itemPrice From billing WHERE client_ID = $id ORDER BY timeStamp DESC");

  while ($row = mysqli_fetch_array($result))
  {
                    
      ?>              
                    
                    <tbody>
                        <tr>
                            <td><?php echo $row['name'];?></td>
                            <td>$<?php echo $row['cost'];?></td>
                            <td><?php echo $row['quantity'];?></td>
                            <td>$<?php echo $row['itemPrice'];?></td>
                            <td><?php echo $row['timeStamp'];?></td>
                        </tr>
                    </tbody>
<?php
  }                
                    
?> 
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="main">
            <div class="topbar" style="margin-top: 120px;">
                <a>Services Bought</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Appointment Type</th>
                            <th scope="col">Pet Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Cost</th>
                        </tr>
                    </thead>
                    
                    
<?php
 
   $result = mysqli_query($con,"SELECT * From billingA WHERE client_ID = $id");
   
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
   $time = $time . ":00 $type";
   $app_name = $ss['name'];
?>                    
                    <tbody>
                        <tr>
                            <td><?php echo $app_name;?></td>
                            <td><?php echo $pet_name;?></td>
                            <td><?php echo $row['date'];?></td>
                            <td><?php echo $time;?></td>
                            <td>$<?php echo $row['cost'];?></td>
                        </tr>
                    </tbody>
<?php
}
?>
                    
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="main">
            <div class="topbar" style="margin-top: 120px;">
                <a>Upcoming Appointments</a>
                <button type="button" class="btn" onclick="location.href='../appointment/book.php?client_ID=<?php echo $id;?>'">Book An Appointment</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Appointment Type</th>
                            <th scope="col">Pet Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Need to Cancel?</th>
                        </tr>
                    </thead>
                    
                    
<?php
$sql = "call getAppt($id)";
$result = mysqli_query($con,$sql);

  
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
    $time = $time . ":00 $type";
    $pet_ID = $row['pet_ID'];
    $appt_date = $row['date'];

    $today_date = date("Y-m-d");
    $date1 = (strtotime($appt_date));
    $date2 = (strtotime($today_date));
    $interval = ($date1 - $date2)/60/60/24;
   // echo 'Interval: '.$interval;
    if ($interval > 0)
        {
 ?>                   
                    <tbody>
                        <tr>
                            <td><?php echo $row['appointment_name'];?></td>
                            <td><?php echo $row['pet_name'];?></td>
                            <td><?php echo $appt_date;?></td>
                            <td><?php echo $time;?></td>
                            <td>
                                <button type="button" class="btn" onclick="location.href='javascript:cancelAppt(\'<?php echo $appt_date;?>\', <?php echo $interval;?>, <?php echo $original_time;?>, <?php echo $pet_ID;?>);'">Cancel</button>
                            </td>
                        </tr>
                    </tbody>
<?php                    
        }
    }
 ?>                       
                    
                    
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="main">
            <div class="topbar" style="margin-top: 120px;">
                <a>My Questions</a>
                <button type="button" class="btn" onclick="location.href='../main/contact.php?client_ID=<?php echo $id;?>'">Ask A Question</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Question</th>
                            <th scope="col">Answer</th>
                            <th scope="col">Answered By Vet</th>
                            <th scope="col">Remove Question</th>
                        </tr>
                    </thead>

<?php     
  mysqli_next_result($con);
  $sql = "SELECT * From question WHERE client_ID = $id";
  //echo '<br> SQL: '.$sql;
  $result = mysqli_query($con,$sql);
  while ($row = mysqli_fetch_array($result))
    {
    $ques_ID = $row['id'];
    $answer = $row['answer'];
    $vet_ID = $row['vet_ID'];
    if ($vet_ID > -1)
        {
        $sql = "SELECT * From vet WHERE vet_ID = $id";
        //echo '<br> SQL: '.$sql;
        $r = mysqli_query($con,$sql);
        $vet = mysqli_fetch_array($r);
        $vet_name = $vet['f_name'] . ' ' . $vet['l_name'];
        }
    else 
        {
        $answer = "Question not answered yet";
        $vet_name = "-----";
        }
    
?>                    
                    
                    <tbody>
                        <tr>
                            <td><?php echo $row['question'];?></td>
                            <td><?php echo $answer;?></td>
                            <td><?php echo $vet_name;?></td>
                            <td>
                                <button type="button" class="btn" onclick="confirm_delete(<?php echo $ques_ID;?>);">Delete</button>
                            </td>
                        </tr>
                    </tbody>
<?php                    
    }                    
?>                       
                    
                    
                </table>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <footer>
        <div class="footer-content">
            <h3>Reach Out!!</h3>
            <p>We are available on all these amazing social media platforms.</p>
            <ul class="socials">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2020 <span>Norman Hospitals</span></p>
        </div>
    </footer>

    <script src="app.js"></script>
    <script>
        function confirm_delete (ques_ID)
            {
            var c = confirm('Do you want to delete this question?');
            if (c)
                {
                var url = '<?php echo "../main/contact.php?job=delete&ques_ID=' + ques_ID + '&client_ID=$id";?>';
                //alert (url);
                refresh_page (0, url);
                }                 
            }
        function refresh_page (seconds, url)
            {
            setTimeout(function ()
                {    
                window.location.href = url; 
                }, seconds*1000);
            }
        </script>
</body>

</html>


<?php 
  }

  mysqli_close($con);
?>
