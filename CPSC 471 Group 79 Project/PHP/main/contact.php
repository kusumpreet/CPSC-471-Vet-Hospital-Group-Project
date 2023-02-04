<?php 
$client_ID = $_GET['client_ID'];

$question = $_POST['question'];
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
        if (isset($question))
            {
            $sql = "call addQuestion($client_ID, '$question')";
            $result = mysqli_query($con,$sql);
            }

        if ($_GET["job"] == "delete")
        {
        $ques_ID = $_GET['ques_ID'];
        $sql = "DELETE FROM question WHERE id=$ques_ID";
        $result = mysqli_query($con,$sql);
        
        header("Location: ../Client/getClient.php?id=$client_ID");
        }
        
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Contact</title>
        <link rel="stylesheet" href="contact.css">
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@600&display=swap" rel="stylesheet">
        <link rel="icon" href="images/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    </head>

    <body line-height=1.5>
        <nav class="nav">
            <div class="logo">
                <h4><a href="Home.html">Norman Hospital</a></h4>
            </div>
            <ul class="nav-links">
                <li><a href="../Client/getClient.php?id=<?php echo $client_ID;?>">My Profile</a></li>
                <li><a href="../appointment/book.php?client_ID=<?php echo $client_ID;?>">Book Appointment</a></li>
                <li><a href="../shop/shop.php?client_ID=<?php echo $client_ID;?>">Shop</a></li>
                <li><a href="login.php">Sign out</a></li>
            </ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </nav>

        <section class="contact-section">
            <div class="contact-bg">
                <h2>ask a question</h2>
                <p class="text">Let us know about any of your queries, and we will try to answer you as soon as possible</p>
            </div>

            <div class="Contact-form">
                <form id="questionForm" action="contact.php?client_ID=<?php echo $client_ID;?>" method="post">
                    <textarea name="question" rows="5" placeholder="Message" class="form-control"></textarea>
                    <input type="submit" class="btn" value="submit your question">
                </form>
            </div>
            
            <div class="contact-body">
                <div class="contact-info">
                    <div>
                        <span><i class="fas fa-mobile-alt"></i></span>
                        <span>Phone No.</span>
                        <span class="text">+1-234-8522-6005</span>
                    </div>
                    <div>
                        <span><i class="fas fa-envelope-open"></i></span>
                        <span>E-mail</span>
                        <span class="text">NormanHospitals@cal.ca</span>
                    </div>
                    <div>
                        <span><i class="fas fa-map-marker-alt"></i></span>
                        <span>Address</span>
                        <span class="text">297 west Norton street, Salt Lake City, UT, Unites States</span>
                    </div>
                    <div>
                        <span><i class="fas fa-clock"></i></span>
                        <span>Open Hours</span>
                        <span class="text">7 Days A Week (8:00 AM to 5:00 PM)</span>
                    </div>
                </div>
                

            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193365.04859357257!2d-112.06057155730724!3d40.77678325656754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87523d9488d131ed%3A0x5b53b7a0484d31ca!2sSalt%20Lake%20City%2C%20UT%2C%20USA!5e0!3m2!1sen!2sca!4v1637818217937!5m2!1sen!2sca" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

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
        </section>

        <script src="app.js"></script>
    </body>
</html>



