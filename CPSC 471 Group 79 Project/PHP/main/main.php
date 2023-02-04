<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Norman Hospital</title>
  <link rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@600&display=swap" rel="stylesheet">
  <link rel="icon" href="images/favicon.ico">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>

<body>
    <nav class="nav">
        <div class="logo">
            <h4><a href="Home.html">Norman Hospital</a></h4>
        </div>
        <ul class="nav-links">
            <li><a href="About.html">About</a></li>
<!--            <li><a href="Services.html">Services</a></li>
            <li><a href="Contact.php">Contact</a></li>
            <li><a href="shop.html">Shop</a></li>-->
            <li><a href="login.php">Login</a></li>
<!--            <li><a href="register.html">Register</a></li>
            <li><a href="myProfile.html">My Profile</a></li>-->
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>

    <div class="about-row-one">
        <img class="dog-img" src="images/dog-bg-home.png" alt="dog-img">
        <div class="about-heading">
            <h1>Norman Hospital</h1>
            <p>Get In Touch With Us</p>
            <button type="button" class="btn" onclick="location.href='Contact.html'">CONTACT</button>
        </div>
    </div>
    <div class="about-row-two">
        <div class="about-us">
            <h1>About Us</h1>
            <p>Get to know more about us and our team</p>
            <button type="button" class="btn" onclick="location.href='About.html'">ABOUT US</button>
        </div>
        <img class="about-img" src="images/doctor.png" alt="dog-img">
    </div>
    
    <div class="container">
        <h1>Our Clients</h1>
        <div class="gallery"> <img src="/images/Gallery/g1.jpg" alt="Description 1"> </div>
        <div class="gallery"> <img src="/images/Gallery/g2.jpg" alt="Description 2"> </div>
        <div class="gallery"> <img src="/images/Gallery/g3.jpg" alt="Description 3"> </div>
        <div class="gallery"> <img src="/images/Gallery/g4.jpg" alt="Description 4"> </div>
        <div class="gallery"> <img src="/images/Gallery/g5.jpg" alt="Description 5"> </div>
        <div class="gallery"> <img src="/images/Gallery/g6.jpg" alt="Description 6"> </div>
    </div>
    
    <div class="testimonials">
        <div class="inner">
            <h1>Testimonials</h1>
            <div class="border"></div>
            <div class="row">
                <div class="col">
                    <div class="testimonial">
                        <img src="images/testimonials/t1.PNG" alt="testimonial-profile-picture">
                        <div class="name">Tu Asnappar</div>
                        <div class="stars">
                            <i class="fas fa-star fa-9x"></i>
                            <i class="fas fa-star fa-9x"></i>
                            <i class="fas fa-star fa-9x"></i>
                            <i class="fas fa-star fa-9x"></i>
                            <i class="fas fa-star fa-9x"></i>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sem tellus, convallis at nulla vel, lacinia rhoncus leo. Sed fermentum sed metus in aliquam. Morbi lacus metus, blandit non congue sed, gravida non velit. Nulla dapibus, ante nec sodales tempus, nisi augue consectetur justo, eget volutpat purus metus eget arcu.
                        </p>
                    </div>
                </div>

                <div class="col">
                    <div class="testimonial">
                        <img src="images/testimonials/t2.PNG" alt="testimonial-profile-picture">
                        <div class="name">Emilija Nataša</div>
                        <div class="stars">
                            <i class="fas fa-star fa-9x"></i>
                            <i class="fas fa-star fa-9x"></i>
                            <i class="fas fa-star fa-9x"></i>
                            <i class="far fa-star fa-9x"></i>
                            <i class="far fa-star fa-9x"></i>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sem tellus, convallis at nulla vel, lacinia rhoncus leo. Sed fermentum sed metus in aliquam. Morbi lacus metus, blandit non congue sed, gravida non velit. Nulla dapibus, ante nec sodales tempus, nisi augue consectetur justo, eget volutpat purus metus eget arcu.
                        </p>
                    </div>
                </div>

                <div class="col">
                    <div class="testimonial">
                        <img src="images/testimonials/t3.PNG" alt="testimonial-profile-picture">
                        <div class="name">Lilien Roza</div>
                        <div class="stars">
                            <i class="fas fa-star fa-9x"></i>
                            <i class="fas fa-star fa-9x"></i>
                            <i class="fas fa-star fa-9x"></i>
                            <i class="fas fa-star fa-9x"></i>
                            <i class="far fa-star fa-9x"></i>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sem tellus, convallis at nulla vel, lacinia rhoncus leo. Sed fermentum sed metus in aliquam. Morbi lacus metus, blandit non congue sed, gravida non velit. Nulla dapibus, ante nec sodales tempus, nisi augue consectetur justo, eget volutpat purus metus eget arcu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <h3>Reach Out!!</h3>
            <p>We are avaliable on all these amazing social media platforms.</p>
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

</html>