<?php echo
$id     = $_GET['id'];
?>

<html>
    <head>
     
     <meta http-equiv="refresh" content="5; url = shift.php?id=<?php echo $id;?>"
      />
      
    </head>
<body>

<?Php

$vet_ID = $_POST['vet'];
$rec_ID = $_POST['rec'];
$date   = $_POST['date'];

$start_time = 8;
$end_time = 17;

echo "vet ID: $vet_ID <br>";
echo "receptionist ID: $rec_ID <br>";


echo "Your shift selection on $date has been booked successfully! Returning you back to the previous page... <br>";


// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

else
  {
    $sql = "call addShift($vet_ID, '$date', $start_time, $end_time)";
    //echo '<br> '.$sql;
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $sql = "call addShift($rec_ID, '$date', $start_time, $end_time)";
    //echo '<br> '.$sql;
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
//    $sql = "call addShift($dog_ID, '$date', $start_time, $end_time)";
//    $result = mysqli_query($con,$sql);
//    $row = mysqli_fetch_array($result);
  }
?>

