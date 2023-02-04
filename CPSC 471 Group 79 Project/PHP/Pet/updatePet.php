<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../client/profile.css">
    </head>
    <body>
        
    </body>
 </html>  
 
<?php

$pet_ID   = $_GET["pet_ID"];
$owner_ID = $_GET["owner_ID"];


// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$result = mysqli_query($con,"SELECT * FROM pet where id=".$pet_ID);

$row = mysqli_fetch_array($result);

echo "<div class='user-container'>";

$profile_img = "../client/uploads/pet$pet_ID.jpg";
$default = "../client/uploads/profiledefault.png";

if (file_exists($profile_img))
    {
    $random = mt_rand();
    echo "<img src=$profile_img?$random> <br>";
    //echo '<a href="uploadMain.php?id='.$id.'" width=100 height=100> Change Profile Picture </a>';
    }
else
    {
    echo "<img src=$default> <br>";
    //echo '<a href="uploadMain.php?id='.$id.'" width=100 height=100> Upload a Profile Picture </a>';
    }

echo "<p>".$row['name']."</p>";
echo "</div>";
         
         
 ?>

 <form action="../Client/getClient.php?job=update&id=<?php echo $owner_ID;?>&pet_ID=<?php echo $pet_ID;?>" method="post">
   <input name="id" type="hidden" value=<?php echo $row['id'];?>>
   Name: <input type="text" name="name" value=<?php echo $row['name'];?>><br>
   Type: <input type="text" name="type" value=<?php echo $row['type'];?>><br>
   Weight (lbs): <input type="text" name="weight" value=<?php echo $row['weight'];?>><br>
   Color: <input type="text" name="color" value=<?php echo $row['color'];?>><br>
   <input name="owner_ID" type="hidden" value=<?php echo $row['owner_ID'];?>><br>-->
   <input type="submit" value="Update">
</form>
  
<?php
echo '<br>';
echo ' Upload a Profile Picture (Only JPG Files Allowed) <br>';
?>
<form action="upload.php?pet_ID=<?php echo $pet_ID;?>&client_ID=<?php echo $owner_ID;?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit"> UPLOAD </button>
    
</form>
 
<?php
echo '<br>';
echo '<a href="../Client/getClient.php?job=delete&id='.$owner_ID.'&pet_ID='.$pet_ID.'">Delete Pet</a>';

mysqli_close($con);
?>



