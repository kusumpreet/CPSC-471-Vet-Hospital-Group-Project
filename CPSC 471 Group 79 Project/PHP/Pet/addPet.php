<html>
    <head>
     <?php
      $owner_ID = $_GET['id'];?> 
     
     <meta http-equiv="refresh" content="3; url = ../Client/getClient.php?id=<?php echo $owner_ID; ?>"
      />
      
    </head>
<body>

<?php
$owner_ID = $_GET['id'];

$name = $_POST["name"];
$type = $_POST["type"];
$weight = $_POST["weight"];
$color = $_POST["color"];
$type = $_POST["type"];

//echo $name. "<br>";


// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $sql = "INSERT INTO pet (Name, owner_ID,type,weight,color) VALUES ('". $name."','". $owner_ID."','". $type."','". $weight."','". $color."');";
  //echo '<br>'.$sql.'<br>';
 
 if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  
echo "1 record added <br/>";
echo "redirecting you back to your profile...";

mysqli_close($con);

?>
      
</body>
</html>