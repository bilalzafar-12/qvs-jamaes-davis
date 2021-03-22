<?php 

include('assets/db/database.php');

//User login
if(isset($_POST["login"])) {

	$usr = $_POST["user"];
	$passwd = md5($_POST["psw"]);
	
	if(empty($_POST["user"]) || empty($_POST["psw"])){
		
		$message = '<label class="error_label">All fields are required</label>';

	} else {

		$sql = "SELECT * FROM users WHERE email='$usr' AND password='$passwd' LIMIT 1";
		$resul = mysqli_query($connection, $sql);

		if (mysqli_num_rows($resul) > 0) {
			$result=mysqli_fetch_assoc($resul);
			
			if($result['blockstatus'] == 0) {
				
				$_SESSION["username"] = $result["first_name"];
				$_SESSION["loggedInUserID"] = $result["id"];
				$_SESSION["uid"] = $result["email"];
				$_SESSION["security"] = $result['securitygroup'];
				header("location:dashboard.php");

			} else {
				$message = '<label class="error_label" style="color: #FFF;"> This Account is Disabled</label>';
			}
		
		} else {
			$message = '<label class="error_label" style="color: #FFF;"> Incorrect Credentials</label>';
		}
	} 
}
	
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>QVS Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style_inner_pages.php?v=1.40" rel="stylesheet">

  <!-- =======================================================
  * Template Name: QVS - v4.0.1
  * Template URL: https://bootstrapmade.com/serenity-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
		<nav id="navbar" class="navbar" >
        <ul>
          <li><a href="index.php"> Home</a></li>
          <li class="dropdown"><a href="#"><span>About</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="about.php">About</a></li>
              <li><a href="team.php">Team</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="subscription.php">Subscription</a></li>
          <li><a href="contact.php">Contact</a></li>

      <div class="logo">
        <!-- <h1 class="text-light"><a href="index.php"> </a></h1> -->
 
      </div>

          <li style="margin-left:160%;"><a class="getstarted" style="color: #FFF;" href="signup.php">Sign Up</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="seperate_top_login">

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    
	<section id="ulogin" class="ulogin">
		
		
      <div class="container">
	  
	  	<div id="login_logo">
			<img src="assets/img/qvs_logo2.png" alt="login logo" class="avatar">
		</div>
		
		<div id="login_seperator">
		</div>

        <div class="row justify-content-end">
          <div class="col-lg-11">
            <div class="row justify-content-end">
			
				<div id="loginfrm" >
				<form method="post" >
				  <div class="imgcontainer" >
					<!-- <img src="assets/img/avatar1.png" alt="Avatar" class="avatar"> -->
					
					<?php
						if(isset($message))
						{
							echo '<label class="error_label">'.$message.'</label>';
						}		
									
					?>
					
				  </div>
					
				  <div class="login_input_container">
					
					<input type="text" placeholder="Enter Username" name="user">
					<input type="password" placeholder="Enter Password" name="psw" >
						
					<input type="submit" name="login" value="&#xf090 &nbsp Login" class="fa fa-sign-in" id="btnlogin"/>
					
				  </div>
					
					<center> <span class="psw"> <a href="forgotpassword.php"> Forget password?</a></span></center>
					</br>
				</form>
				
				</div>
              

            </div>
          </div>
        </div>

    

          <div class="col-lg-6 video-box align-self-baseline position-relative">

          </div>

          <!-- <div class="col-lg-6 pt-3 pt-lg-0 content"> -->

			

			</div>




			</div>
          </div>

        </div>

      </div>
    </section><!-- End About Section -->

   

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
		<div class="copyright">
        Copyright 2021 <strong><span>QVS</span></strong> All Rights Reserved | Designed by Capstone Group
      </div>
    </div>

    

    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>