<html>
    <head>
        <title> </title>
        <link rel="stylesheet" type ="text/css" href="profile.css">
    </head>
</html>


<?php

$id = $_GET["id"];

// Create connection
$con=mysqli_connect("localhost","root","alishalalani","animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
$sql = "SELECT * from client WHERE id=$id";
echo '<br> sql:'.$sql;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
if ($row)
    {
    $username = $row['username'];
    //echo '<br> user:'.$username;
    }

$sqlImg = "SELECT * FROM profileimg WHERE user_ID=$id";
//echo '<br> img:'.$sqlImg;
$resultImg = mysqli_query($con, $sqlImg);
$rowImg = mysqli_fetch_assoc($resultImg);
echo "<div class='user-container'>";
if ($rowImg)
    {
    if ($rowImg['status'] == 0) //this means an image has been uploaded
        {
        echo "<img src='uploads/profile".$id.".jpg?'".mt_rand().">";
        }
    else //image has not been uploaded yet 
        {
        echo "<img src='uploads/profiledefault.png'>";
        }
    }
else //image has not been uploaded yet 
    {
    echo "<img src='uploads/profiledefault.png'>";
    }
echo "<p>".$username."</p>";
echo "</div>";


 ?>
 
 <form action="view.php?job=update" method="post">
   <input name="id" type="hidden" value=<?php echo $row['id'];?>>
   Name: <input type="text" name="name" value=<?php echo $row['name'];?>><br>
   Username: <input type="text" name="username" value=<?php echo $row['username'];?>><br>
   Password: <input type="password" name="password" value=<?php echo $row['password'];?>><br>
   <input type="submit" value="Update">
</form>

<form action="upload.php?id=2" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit"> UPLOAD </button>
    
</form>

<?php 
//$profile_img = "uploads/client$id.jpg";
//if (file_exists($profile_img))
//    {
//    echo "<img src=$profile_img> <br>";
//    echo '<a href="uploadMain.php?id='.$id.'" width=100 height=100> Change Profile Picture </a>';
//    }
//else
//    {
//    echo '<a href="uploadMain.php?id='.$id.'" width=100 height=100> Upload a Profile Picture </a>';
//    }
?>

  
<?php


mysqli_close($con);
?>


