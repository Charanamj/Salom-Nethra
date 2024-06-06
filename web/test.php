
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Salon Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Nova
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nova-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="d-flex align-items-center">Nova</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.html" class="active">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="services.html">Services</a></li>
          <li><a href="portfolio.html">Portfolio</a></li>
          <li><a href="team.html">Team</a></li>
          <li><a href="blog.html">Blog</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
          <li><a class="getstarted scrollto" href="register.php">Registration</a></li>
          <li><a class="getstarted scrollto" href="login.php">Log in</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

<body class="page-index">

  <main id="main">
    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>Customer</h2>
                <p>Register</p>
            </div>

            <div class="row justify-content-center">

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                                        <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control border border-1 border-dark" id="first_name" value="" placeholder="First Name">
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control border border-1 border-dark" name="last_name" id="last_name" placeholder="Last Name">
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="text" class="form-control border border-1 border-dark" name="email" id="email" placeholder="Email">
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="address_line1">Address Line 1</label>
                            <input type="text" class="form-control border border-1 border-dark" name="address_line1" id="address_line1" placeholder="Address Line 1">
                        </div>
                        <div class="form-group mt-3">
                            <label for="address_line2">Address Line 2</label>
                            <input type="text" class="form-control border border-1 border-dark" name="address_line2" id="address_line2" placeholder="Address Line 2">
                        </div>
                        <div class="form-group mt-3">
                            <label for="address_line3">Address Line 3</label>
                            <input type="text" class="form-control border border-1 border-dark" name="address_line3" id="address_line3" placeholder="Address Line 3">
                        </div>
                        <div class="form-group mt-3">
                            <label for="telno">Tel. No.(Home)</label>
                            <input type="text" class="form-control border border-1 border-dark" name="telno" id="telno" placeholder="Tel. No.">
                        </div>
                        <div class="form-group mt-3">
                            <label for="telno">Mobile No.</label>
                            <input type="text" class="form-control border border-1 border-dark" name="mobile_no" id="mobile_no" placeholder="Mobile No">
                        </div>
                        <div class="form-group mt-3">
                            <label>Select Gender</label>
                            <div class="form-check">
                                <input class="form-check-input border border-1 border-dark" type="radio" name="gender" id="male"  value="male">
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input border border-1 border-dark" type="radio" name="gender" id="female" value="female" >
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </div>
                            <div class="text-danger mt-4"></div>
                        </div> 
                        <div class="form-group mt-3">
                                                        <label for="telno">District</label>
                            <select name="district" id="district" onchange="loadDSArea()"  class="form-select form-select-lg mb-3 border border-1 border-dark" aria-label="Large select example">
                                <option value="" >--</option>
                                                                    <option value="1" >Ampara</option>
                                                                        <option value="2" >Anuradhapura</option>
                                                                        <option value="3" >Batticaloa</option>
                                                                        <option value="4" >Badulla</option>
                                                                        <option value="5" >Colombo</option>
                                                                        <option value="6" >Galle</option>
                                                                        <option value="7" >Gampaha</option>
                                                                        <option value="8" >Hambantota</option>
                                                                        <option value="9" >Jaffna</option>
                                                                        <option value="10" >Kalutara</option>
                                                                        <option value="11" >Kandy</option>
                                                                        <option value="12" >Kegalle</option>
                                                                        <option value="13" >Kilinochchi</option>
                                                                        <option value="14" >Kurunegala</option>
                                                                        <option value="15" >Matale</option>
                                                                        <option value="16" >Mannar</option>
                                                                        <option value="17" >Matara</option>
                                                                        <option value="18" >Monaragala</option>
                                                                        <option value="19" >Mullaitivu</option>
                                                                        <option value="20" >Nuwara Eliya</option>
                                                                        <option value="21" >Polonnaruwa</option>
                                                                        <option value="22" >Puttalam</option>
                                                                        <option value="23" >Ratnapura</option>
                                                                        <option value="24" >Trincomalee</option>
                                                                        <option value="25" >Vavuniya</option>
                                                                </select>
                        </div> 
                        <div class="form-group mt-3">
                            <label for="user_name">User Name</label>
                            <input type="text" class="form-control border border-1 border-dark" name="user_name" id="user_name" placeholder="Username">
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control border border-1 border-dark" name="password" id="password" placeholder="Password">
                            <span class="text-danger"></span>
                        </div>

                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Submit</button></div>
                    </form>
                </div>

            </div>

        </div>

    </section><!-- End Contact Us Section -->
</main>
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

<div class="footer-content">
  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-5 col-md-12 footer-info">
        <a href="index.html" class="logo d-flex align-items-center">
          <span>Nova</span>
        </a>
        <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
        <div class="social-links d-flex  mt-3">
          <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>

      <div class="col-lg-2 col-6 footer-links">
        <h4>Useful Links</h4>
        <ul>
          <li><i class="bi bi-dash"></i> <a href="#">Home</a></li>
          <li><i class="bi bi-dash"></i> <a href="#">About us</a></li>
          <li><i class="bi bi-dash"></i> <a href="#">Services</a></li>
          <li><i class="bi bi-dash"></i> <a href="#">Terms of service</a></li>
          <li><i class="bi bi-dash"></i> <a href="#">Privacy policy</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-6 footer-links">
        <h4>Our Services</h4>
        <ul>
          <li><i class="bi bi-dash"></i> <a href="#">Web Design</a></li>
          <li><i class="bi bi-dash"></i> <a href="#">Web Development</a></li>
          <li><i class="bi bi-dash"></i> <a href="#">Product Management</a></li>
          <li><i class="bi bi-dash"></i> <a href="#">Marketing</a></li>
          <li><i class="bi bi-dash"></i> <a href="#">Graphic Design</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
        <h4>Contact Us</h4>
        <p>
          A108 Adam Street <br>
          New York, NY 535022<br>
          United States <br><br>
          <strong>Phone:</strong> +1 5589 55488 55<br>
          <strong>Email:</strong> info@example.com<br>
        </p>

      </div>

    </div>
  </div>
</div>

<div class="footer-legal">
  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>Nova</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nova-bootstrap-business-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </div>
</div>
</footer><!-- End Footer --><!-- End Footer -->

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>