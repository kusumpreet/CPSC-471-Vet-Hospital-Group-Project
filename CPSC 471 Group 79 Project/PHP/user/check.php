<?php

$id = $_GET ['id'];
$user = $_GET['user'];

// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
else
    {
    $admin = "SELECT * From admin WHERE id = $id AND username='$user'";
    //echo '<br>'.$admin;
    $result_admin = mysqli_query($con,$admin);
    $num_rows_admin = mysqli_num_rows($result_admin);
    //echo '<br> num rows: '.$num_rows_admin;
    if ($num_rows_admin > 0)
    {
    $url ="../admin/getAdmin.php?id=$id";
    header("refresh:0; url=".$url); 
    }

    $vet = "SELECT * From vet WHERE vet_ID = $id AND username='$user'";
    //echo '<br>'.$vet;
    $result_vet = mysqli_query($con,$vet);
    $num_rows_vet = mysqli_num_rows($result_vet);
    if ($num_rows_vet > 0)
    {
    $url ="../Employee/getEmployee.php?id=$id";
    header("refresh:0; url=".$url); 
    }
    
    $client = "SELECT * From client WHERE id = $id AND username='$user'";
    //echo '<br>'.$client;
    $result_client = mysqli_query($con,$client);
    $num_rows_client = mysqli_num_rows($result_client);
    if ($num_rows_client > 0)
    {
    $url ="../Client/getClient.php?id=$id";
    header("refresh:0; url=".$url); 
    } 
 $row = mysqli_fetch_array($result);

  }
  
?>
  

