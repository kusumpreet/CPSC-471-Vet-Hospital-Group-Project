
<?php


$name = $_POST["name"];
$username = $_POST["username"];
$password = $_POST["password"];

if (isset($name) & isset($username) & isset($password))
{
// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $sql = "SELECT username from client where username='$username'";
  $result = mysqli_query($con,$sql);
  
$num_rows = mysqli_num_rows($result);
    if ($num_rows == 0) 
      {
        $sql = "call addClient('$name', '$username', '$password')";

       if (!mysqli_query($con,$sql))
        {
        die('Error: ' . mysqli_error($con));
        }

        
//        $sql = "SELECT * FROM client WHERE username=$username AND name=$name";
//        $result = mysqli_query($con, $sql);
//        
//        if (mysqli_num_rows($result) > 0)
//            {
//
//            }
//        else
//            {
//            //echo 'error';
//            }
       echo 'Your Profile Was Created Successfully! <br/>';
       $url ="../main/login.php";
       header("refresh:5; url=".$url);
       //echo "<script> refresh_page (5, '$url');</script>";
      } 
    else 
      {
        echo 'This username is taken. Try again. Redirecting you to sign up page...';
        $url ="../main/signUp.php";
        header("refresh:5; url=".$url);
        //echo "<script> refresh_page (5, '$url');</script>";
      }
mysqli_close($con);
}
?>