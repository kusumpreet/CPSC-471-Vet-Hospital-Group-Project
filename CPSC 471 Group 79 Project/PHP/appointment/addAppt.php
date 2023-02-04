<html>
    <head>
     <?php
      $client_ID = $_GET['client_ID'];?> 
     
     <meta http-equiv="refresh" content="3; url = ../Client/getClient.php?id=<?php echo $client_ID; ?>"
      />
      
    </head>
<body>


<?Php
$client_ID = $_GET['client_ID'];
$time = $_POST['times'];
$pet_ID = $_POST['petSelect'];
$app_ID = $_POST['appSelect'];
$date = $_POST['date'];

//echo "petID: $pet_ID <br>";

echo "Your appointment on $date has been booked successfully! Returning you back to your profile... <br>";

//$appType = 1;
$vet_ID = 2;
//echo "time selected: $time <br>";
//echo "date: $date <br>";

// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

else
  {
    $sql = "call addAppt($client_ID, $pet_ID,'$date', $time, $app_ID, $vet_ID)";
    echo 'sql:'.$sql;
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    
    mysqli_next_result($con);
    $sql = "call addBillingA($client_ID, $pet_ID, '$date', $time, $app_ID)";
    $result = mysqli_query($con,$sql);
  }
?>
