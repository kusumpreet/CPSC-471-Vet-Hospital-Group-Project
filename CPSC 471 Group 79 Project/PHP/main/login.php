<!--
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Norman Hospital</title>
  <link rel="stylesheet" href="login.css">
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@600&display=swap" rel="stylesheet">
  <link rel="icon" href="images/favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script scr="app.js"></script>
  <script scr="js/login.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">

   Required meta tags 
  <meta name="viewport" content="width=device-width, initial-scale=1">

   Bootstrap CSS 
  

  
</head>

<body>
    <nav class="nav">
        <div class="logo">
            <h4><a href="Home.html">Norman Hospital</a></h4>
        </div>
        <ul class="nav-links">
            <li><a href="main.php">Main</a></li>
            <li><a href="About.html">About</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="signUp.php">Register</a></li>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>

    
        <div class="login-page">
            <form id="loginForm" action="login.php" method="post">
                <h1 class="loginForm-title">Client Login</h1>
                <div class="form-message form-message-error"></div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" autofocus placeholder="Username or email">
                    <div class="form-input-error-message"></div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" autofocus placeholder="Password">
                    <div class="form-input-error-message"></div>
                </div>
                <button class="btn" onclick="location.href='login.php'" type="submit">Continue</button>
                <p class="form-link">
                    <a class="LR" href="signUp.php" id="linkCreateAccount">Don't have an account? Create account</a>
                </p>
                <p class="form-link">
                    <a class="LR" href="empLogin.php" id="linkCreateAccount">Employee Login</a>
                </p>
                <p class="form-link">
                    <a class="LR" href="adminLogin.php" id="linkCreateAccount">Admin Login</a>
                </p>
            </form>
        </div>
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <footer>
        <div class="footer-content">
            <h3>Reach Out!!</h3>
            <p>We are available on all these amazing social media platforms.</p>
            <ul class="socials">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2020 <span>Norman Hospitals</span></p>
        </div>
    </footer>

    <script src="app.js"></script>
</body>

</html>-->





<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Norman Hospital</title>
  <link rel="stylesheet" href="login.css">
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@600&display=swap" rel="stylesheet">
  <link rel="icon" href="images/favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script scr="app.js"></script>
  <script scr="js/login.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">

  <!-- Required meta tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  

  
</head>

<body>
    <nav class="nav">
        <div class="logo">
            <h4><a href="main.php">Norman Hospital</a></h4>
        </div>
        <ul class="nav-links">
            <li><a href="login.php">Login</a></li>
            <li><a href="signUp.php">Register</a></li>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>

    <div class="login-page">
        <form id="loginForm" action="login.php" method="post">
            <h1 class="loginForm-title">Client Login</h1>
            <div class="form-message form-message-error"></div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" autofocus placeholder="Username">
                <div class="form-input-error-message"></div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" autofocus placeholder="Password">
                <div class="form-input-error-message"></div>
            </div>
            <button class="btn" type="submit">Continue</button>
            <p class="form-link">
                <a class="LR" href="signUp.php" id="linkCreateAccount">Don't have an account? Create account</a>
            </p>
            <p class="form-link">
                <a class="LR" href="empLogin.php" id="linkCreateAccount">Employee Login</a>
            </p>
            <p class="form-link">
                <a class="LR" href="adminLogin.php" id="linkCreateAccount">Admin Login</a>
            </p>            
        </form>
    </div>


    
        <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup()">&times;</div>
            <h1>Login Error</h1>
            <p>The Username or Password that you've entered doesn't match any account.</p>
        </div>
    </div>
   

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <footer>
        <div class="footer-content">
            <h3>Reach Out!!</h3>
            <p>We are available on all these amazing social media platforms.</p>
            <ul class="socials">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2020 <span>Norman Hospitals</span></p>
        </div>
    </footer>

    <script src="app.js"></script>
    
<?php 


$username = $_POST['username'];
$password = $_POST['password'];

//echo '<br> username: '.$username;
//echo '<br> password: '.$password;
if (!isset($username))
{
//echo '<br> username not set';

} //end if

 else 
 {
    // Create connection
    //echo 'before connection <br/>';
    $con = mysqli_connect("localhost","root","alishalalani", "animalHospital");

    // Check connection
    //echo 'check connection <br/>';
    if (mysqli_connect_errno($con))
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      
    else
        {


        $result = mysqli_query($con,"SELECT id FROM client where username='".$username."' and password='".$password."'");
        if (!$result)
            {
            echo 'username not found <br/>';
            }
        else
            {
            $num_results = mysqli_num_rows($result);
            //echo '<br> num results: '.$num_results;
            if ($num_results == 0)
                {
                //echo '<br>num results 0 <br>';
                echo "<script> togglePopup(); refresh_page (5, 'login.php');</script>";
                }
            else
                {
                $row = mysqli_fetch_array($result);
                $url = "../Client/getClient.php?id=".$row['id'];
                echo "<script> refresh_page (0, '$url');</script>";
                }
            }
        }  
 }
mysqli_close($con);
?>

</body>

</html>
