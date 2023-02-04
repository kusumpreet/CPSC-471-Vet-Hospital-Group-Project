<?php
$id = $_GET['id'];
$date = $_GET['date'];


    // Create connection
    $con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

    // Check connection
    if (mysqli_connect_errno($con))
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
  
    else
        {
        echo '<br>';
        $sql = "DELETE FROM shift where vet_ID =$id AND date =('$date')";
        //echo $sql.'<br>';
        $result = mysqli_query($con,$sql);
        header("Location: ../Employee/getEmployee.php?id=$id");
        }
        


?>

