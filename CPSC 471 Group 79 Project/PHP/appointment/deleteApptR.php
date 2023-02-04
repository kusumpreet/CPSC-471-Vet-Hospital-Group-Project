<html>
    <head>
     <?php
      $client_ID = $_GET['client_ID'];?> 
     
     <meta http-equiv="refresh" content="5; url = ../Client/getClient.php?id=<?php echo $client_ID; ?>"
      />
      
    </head>
<body>

<?Php
$client_ID = $_GET['client_ID'];
$pet_ID = $_GET['pet_ID'];
$date = $_GET['date'];
$time = $_GET['time'];



// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

else
  {
    $sql = "call deleteAppt($client_ID, $pet_ID,'$date', $time)";
    echo $sql.'<br>';
    $result = mysqli_query($con,$sql);
    
    mysqli_next_result($con);
    
    $sql = "call deleteBillingA($pet_ID,$client_ID,'$date', $time)";
    echo $sql.'<br>';
    $result = mysqli_query($con,$sql);

    echo 'Your appointment has been successfully deleted, and you have received a refund. Returning you back to your profile...';
  }
?>


