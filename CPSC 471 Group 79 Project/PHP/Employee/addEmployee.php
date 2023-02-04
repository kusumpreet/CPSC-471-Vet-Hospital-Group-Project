
<?php
$id = $_GET['id'];
$user = $_GET['user'];

$f_name   = $_POST["f_name"];
$l_name   = $_POST["l_name"];
$username = $_POST["username"];
$password = $_POST["password"];
$type     = $_POST["type"];

if (isset($username) & isset($password))
{
// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $sql = "SELECT username from vet where username='$username'";
  $result = mysqli_query($con,$sql);
  
$num_rows = mysqli_num_rows($result);
    if ($num_rows == 0) 
      {
        $sql = "call addVet('$f_name', '$l_name',$type,'$username', '$password')";

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
       $url ="../Employee/viewAll.php?id=$id&user=$user";
       header("refresh:5; url=".$url);
      // echo "<script> refresh_page (5, '$url');</script>";
      } 
    else 
      {
        echo 'This username is taken. Try again. Redirecting you to sign up page...';
        $url ="../Employee/signUp.php?id=$id&user=$user";
        header("refresh:5; url=".$url);
        //echo "<script> refresh_page (5, '$url');</script>";
      }
mysqli_close($con);
}
?>
