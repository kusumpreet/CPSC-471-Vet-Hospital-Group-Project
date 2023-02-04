<?php

// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
if ($_GET["job"] == "update")
    {

    $id = $_POST["id"];
    $fName = $_POST["firstName"];
    $lName = $_POST["lastName"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "CALL updateAdmin($id,'$fName', '$lName','$username','$password')";
    $result = mysqli_query($con,$sql);
    $url = "getEmployee.php?id=".$id;
    header("Location: getAdmin.php?id=".$id);
    //header("refresh:10; url=".$url);
    } 
  
if ($_GET["job"] == "delete"){
$id = $_GET["id"];
$result = mysqli_query($con,"Delete from admin where vet_ID=". $id );

}

?>



