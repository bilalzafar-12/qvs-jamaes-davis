<?php 
	header('content-type: text/css;');
?>

/**
* Name: QVS
*/

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/
body {
  font-family: "Open Sans", sans-serif;
  color: #444444;
  background: url("../img/loginbackground.png");
  background-repeat: no-repeat;
  font-size: 0.9rem;
  
}

a {
  color: #0064F5;
  text-decoration: none;
}

a:hover {
  color: #fff;
  text-decoration: none;
}

h1, h2, h3, h4, h5, h6 {
  font-family: "Raleway", sans-serif;
}

#main {
  margin-top: 5%;
  z-index: 3;
  position: relative;
}


/*--------------------------------------------------------------
# Back to top button
--------------------------------------------------------------*/
.back-to-top {
  position: fixed;
  visibility: hidden;
  opacity: 0;
  right: 15px;
  bottom: 15px;
  z-index: 996;
  background: #0064F5;
  width: 40px;
  height: 40px;
  border-radius: 4px;
  transition: all 0.4s;
}

.back-to-top i {
  font-size: 28px;
  color: #fff;
  line-height: 0;
}

.back-to-top:hover {
  background: #a6ca63;
  color: #fff;
}

.back-to-top.active {
  visibility: visible;
  opacity: 1;
}

/*--------------------------------------------------------------
# Disable AOS delay on mobile
--------------------------------------------------------------*/
@media screen and (max-width: 768px) {
  [data-aos-delay] {
    transition-delay: 0 !important;
  }
}

/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/
#header {
  height: 70px;
  z-index: 997;
  transition: all 0.5s ease-in-out;
  background: #fff;
  box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
}

#header .logo h1 {
  font-size: 32px;
  font-family: Lucida Bright;
  margin: 0;
  line-height: 0;
  font-weight: 600;
  letter-spacing: 1px;
}

#header .logo h1 a, #header .logo h1 a:hover {
  color: #0064F5;
  text-decoration: none;
}

#header .logo img {
  padding: 0;
  margin: 0;
  max-height: 40px;
}

/*--------------------------------------------------------------
# Navigation Menu
--------------------------------------------------------------*/
/**
* Desktop Navigation 
*/
.navbar {
  padding: 0;
}

.navbar ul {
  margin: 0;
  padding: 0;
  display: flex;
  list-style: none;
  align-items: center;
}

.navbar li {
  position: relative;
}

.navbar a {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 0 10px 30px;
  font-family: "Raleway", sans-serif;
  font-size: 15px;
  font-weight: 600;
  color: #565e49;
  white-space: nowrap;
  transition: 0.3s;
}

.navbar a i {
  font-size: 12px;
  line-height: 0;
  margin-left: 5px;
}

.navbar a:hover, .navbar .active, .navbar li:hover > a {
  color: #104080;
}

.navbar .getstarted {
  background: #A77C51;
  padding: 8px 25px;
  margin-left: 30px;
  border-radius: 50px;
  color: #FFF;
  
}

.navbar .getstarted:hover {
  opacity: 0.8;
  color: #fff;
}

.navbar .dropdown ul {
  display: block;
  position: absolute;
  left: 28px;
  top: calc(100% + 30px);
  margin: 0;
  padding: 10px 0;
  z-index: 99;
  opacity: 0;
  visibility: hidden;
  background: #fff;
  box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
  transition: 0.3s;
}

.navbar .dropdown ul li {
  min-width: 200px;
}

.navbar .dropdown ul a {
  padding: 10px 20px;
  font-size: 15px;
  text-transform: none;
}

.navbar .dropdown ul a i {
  font-size: 12px;
}

.navbar .dropdown ul a:hover, .navbar .dropdown ul .active:hover, .navbar .dropdown ul li:hover > a {
  color: #0064F5;
}

.navbar .dropdown:hover > ul {
  opacity: 1;
  top: 100%;
  visibility: visible;
}

.navbar .dropdown .dropdown ul {
  top: 0;
  left: calc(100% - 30px);
  visibility: hidden;
}

.navbar .dropdown .dropdown:hover > ul {
  opacity: 1;
  top: 0;
  left: 100%;
  visibility: visible;
}

@media (max-width: 1366px) {
  .navbar .dropdown .dropdown ul {
    left: -90%;
  }
  .navbar .dropdown .dropdown:hover > ul {
    left: -100%;
  }
}

/**
* Mobile Navigation 
*/
.mobile-nav-toggle {
  color: #3c4133;
  font-size: 28px;
  cursor: pointer;
  display: none;
  line-height: 0;
  transition: 0.5s;
}

.mobile-nav-toggle.bi-x {
  color: #fff;
}

@media (max-width: 991px) {
  .mobile-nav-toggle {
    display: block;
  }
  .navbar ul {
    display: none;
  }
}

.navbar-mobile {
  position: fixed;
  overflow: hidden;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  background: rgba(34, 36, 29, 0.9);
  transition: 0.3s;
  z-index: 999;
}

.navbar-mobile .mobile-nav-toggle {
  position: absolute;
  top: 15px;
  right: 15px;
}

.navbar-mobile ul {
  display: block;
  position: absolute;
  top: 55px;
  right: 15px;
  bottom: 15px;
  left: 15px;
  padding: 10px 0;
  background-color: #fff;
  overflow-y: auto;
  transition: 0.3s;
}

.navbar-mobile a {
  padding: 10px 20px;
  font-size: 15px;
  color: #3c4133;
}

.navbar-mobile a:hover, .navbar-mobile .active, .navbar-mobile li:hover > a {
  color: #104080;
}

.navbar-mobile .getstarted {
  margin: 15px;
}

.navbar-mobile .dropdown ul {
  position: static;
  display: none;
  margin: 10px 20px;
  padding: 10px 0;
  z-index: 99;
  opacity: 1;
  visibility: visible;
  background: #fff;
  box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
}

.navbar-mobile .dropdown ul li {
  min-width: 200px;
}

.navbar-mobile .dropdown ul a {
  padding: 10px 20px;
}

.navbar-mobile .dropdown ul a i {
  font-size: 12px;
}

.navbar-mobile .dropdown ul a:hover, .navbar-mobile .dropdown ul .active:hover, .navbar-mobile .dropdown ul li:hover > a {
  color: #0064F5;
}

.navbar-mobile .dropdown > .dropdown-active {
  display: block;
}

/*--------------------------------------------------------------
# Hero Section
--------------------------------------------------------------*/
#hero {
  width: 100%;
  height: 65vh;
  background: url("../img/ui.jpg") top center;
  background-size: cover;
  position: relative;
  margin-bottom: -140px;
  z-index: 1;
}

#hero:before {
  content: "";
  background: rgba(60, 65, 51, 0.4);
  position: absolute;
  bottom: 0;
  top: 0;
  left: 0;
  right: 0;
}

#hero .hero-container {
  position: absolute;
  bottom: 0;
  top: 0;
  left: 0;
  right: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  text-align: center;
}

#hero h1 {
  margin: 0 0 10px 0;
  font-size: 48px;
  font-weight: 700;
  line-height: 56px;
  color: #fff;
}

#hero h2 {
  color: #eee;
  margin-bottom: 50px;
  font-size: 24px;
}

#hero .btn-get-started {
  font-family: "Raleway", sans-serif;
  font-weight: 600;
  font-size: 13px;
  letter-spacing: 1px;
  display: inline-block;
  padding: 8px 28px;
  border-radius: 50px;
  transition: 0.5s;
  margin: 10px;
  border: 2px solid #0064F5;
  text-transform: uppercase;
  color: #fff;
}

#hero .btn-get-started:hover {
  background: #0064F5;
}

@media (min-width: 1024px) {
  #hero {
    background-attachment: fixed;
  }
}

@media (max-width: 768px) {
  #hero {
    height: 100vh;
  }
  #hero h1 {
    font-size: 28px;
    line-height: 36px;
  }
  #hero h2 {
    font-size: 18px;
    line-height: 24px;
    margin-bottom: 30px;
  }
  #hero .hero-container {
    padding: 0 15px;
  }
}

@media (max-height: 500px) {
  #hero {
    height: 120vh;
  }
}

#seperate_top_login {
  width: 100%;
  height: 28vh;
  background-size: cover;
  position: relative;
  margin-bottom: -140px;
  z-index: 1;
}

/*--------------------------------------------------------------
# Sections General
--------------------------------------------------------------*/
section {
  padding-bottom: 60px;
  overflow: hidden;
}

.section-bg {
  background-color: #f9fbf4;
}

.section-title {
  text-align: center;
  padding-bottom: 30px;
}

.section-title h2 {
  font-size: 32px;
  font-weight: 600;
  margin-bottom: 20px;
  padding-bottom: 0;
  font-family: "Poppins", sans-serif;
  color: #646c55;
}

.section-title p {
  margin-bottom: 0;
}

/*--------------------------------------------------------------
# Breadcrumbs
--------------------------------------------------------------*/
.breadcrumbs {
  padding: 0;
}

.breadcrumbs .breadcrumb-hero {
  text-align: center;
  background: #0064F5;
  padding: 20px 0;
  color: #fff;
}

.breadcrumbs .breadcrumb-hero h2 {
  font-size: 32px;
  font-weight: 500;
}

.breadcrumbs .breadcrumb-hero p {
  font-size: 14px;
  margin-bottom: 0;
}

.breadcrumbs ol {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  padding: 0;
  margin: 30px 0;
}

.breadcrumbs ol li + li {
  padding-left: 10px;
}

.breadcrumbs ol li + li::before {
  display: inline-block;
  padding-right: 10px;
  color: #565e49;
  content: "/";
}

/*--------------------------------------------------------------
# Login Container
--------------------------------------------------------------*/
.ulogin .container {
  padding-bottom: 15px;
  background: none;
}

.ulogin .count-box {
  width: 100%;
}

.ulogin .count-box i {
  display: block;
  font-size: 48px;
  color: #0064F5;
  float: left;
  line-height: 0;
}

.ulogin .count-box span {
  font-size: 28px;
  line-height: 24px;
  display: block;
  font-weight: 700;
  color: #646c55;
  margin-left: 60px;
}

.ulogin .count-box p {
  padding: 5px 0 0 0;
  margin: 0 0 0 60px;
  font-family: "Raleway", sans-serif;
  font-weight: 600;
  font-size: 14px;
  color: #646c55;
}

.ulogin .count-box a {
  font-weight: 600;
  display: block;
  margin-top: 20px;
  color: #646c55;
  font-size: 15px;
  font-family: "Poppins", sans-serif;
  transition: ease-in-out 0.3s;
}

.ulogin .count-box a:hover {
  color: #8b9578;
}

.ulogin .content {
  font-size: 15px;
}

.ulogin .content h3 {
  font-weight: 700;
  font-size: 24px;
  color: #3c4133;
}

.ulogin .content ul {
  list-style: none;
  padding: 0;
}

.ulogin .content ul li {
  padding-bottom: 10px;
  padding-left: 28px;
  position: relative;
}

.ulogin .content ul i {
  font-size: 24px;
  color: #0064F5;
  position: absolute;
  left: 0;
  top: -2px;
}

.ulogin .content p:last-child {
  margin-bottom: 0;
}

.ulogin .play-btn {
  width: 94px;
  height: 94px;
  background: radial-gradient(#0064F5 50%, rgba(148, 192, 69, 0.4) 52%);
  border-radius: 50%;
  display: block;
  position: absolute;
  left: calc(50% - 47px);
  top: calc(50% - 47px);
  overflow: hidden;
}

.ulogin .play-btn::after {
  content: '';
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translateX(-40%) translateY(-50%);
  width: 0;
  height: 0;
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  border-left: 15px solid #fff;
  z-index: 100;
  transition: all 400ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
}

.ulogin .play-btn::before {
  content: '';
  position: absolute;
  width: 120px;
  height: 120px;
  -webkit-animation-delay: 0s;
  animation-delay: 0s;
  -webkit-animation: pulsate-btn 2s;
  animation: pulsate-btn 2s;
  -webkit-animation-direction: forwards;
  animation-direction: forwards;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
  -webkit-animation-timing-function: steps;
  animation-timing-function: steps;
  opacity: 1;
  border-radius: 50%;
  border: 5px solid rgba(148, 192, 69, 0.7);
  top: -15%;
  left: -15%;
  background: rgba(198, 16, 0, 0);
}

.ulogin .play-btn:hover::after {
  border-left: 15px solid #0064F5;
  transform: scale(20);
}

.ulogin .play-btn:hover::before {
  content: '';
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translateX(-40%) translateY(-50%);
  width: 0;
  height: 0;
  border: none;
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  border-left: 15px solid #fff;
  z-index: 200;
  -webkit-animation: none;
  animation: none;
  border-radius: 0;
}





/*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/
#footer {
	position: fixed;
	padding: 0 0 0 0;
	color: #fff;
	font-size: 0.9rem;	
	bottom:0;
	left:0;
	right:0;
	
}

#footer .footer-top {
  background: #104080;
    padding: 1.3% 0 1.3% 0;
	text-align: center;
  
}

#footer .footer-top .footer-info {
  margin-bottom: 30px;
  
}

#footer .footer-top .footer-info h3 {
  font-size: 26px;
  margin: 0 0 10px 0;
  padding: 2px 0 2px 0;
  line-height: 1;
  font-weight: 600;
  letter-spacing: 3px;
  color: #0064F5;
  
}

#footer .footer-top .footer-info p {
  font-size: 14px;
  line-height: 24px;
  margin-bottom: 0;
  font-family: "Raleway", sans-serif;
  color: #fff;
  
}

#footer .footer-top .social-links a {
  display: inline-block;
  background: #3c4133;
  color: #fff;
  line-height: 1;
  margin-right: 4px;
  border-radius: 50%;
  text-align: center;
  width: 36px;
  height: 36px;
  transition: 0.3s;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  
}

#footer .footer-top .social-links a i {
  line-height: 0;
  font-size: 16px;
}

#footer .footer-top .social-links a:hover {
  background: #0064F5;
  color: #fff;
  text-decoration: none;
  

}

#footer .footer-top h4 {
  font-size: 14px;
  font-weight: bold;
  color: #fff;
  text-transform: uppercase;
  position: relative;
  padding-bottom: 12px;
  
}

#footer .footer-top h4::before, #footer .footer-top h4::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  height: 2px;
}

#footer .footer-top h4::before {
  right: 0;
  background: #3c4133;
}

#footer .footer-top h4::after {
  background: #0064F5;
  width: 60px;
}

#footer .footer-top .footer-links {
  margin-bottom: 30px;
}

#footer .footer-top .footer-links ul {
  list-style: none;
  padding: 5px 0 0 0;
  margin: 0;
}

#footer .footer-top .footer-links ul li {
  padding: 0 0 15px 0;
}

#footer .footer-top .footer-links ul a {
  color: #fff;
  transition: 0.3s;
}

#footer .footer-top .footer-links ul a:hover {
  color: #0064F5;
}

#footer .footer-top .footer-contact {
  margin-bottom: 30px;
}

#footer .footer-top .footer-contact p {
  line-height: 26px;
}

#footer .footer-top .footer-newsletter {
  margin-bottom: 30px;
}

#footer .footer-top .footer-newsletter input[type="email"] {
  border: 0;
  padding: 6px 8px;
  width: 65%;
  border-radius: 4px 0 0 4px;

}

#footer .footer-top .footer-newsletter input[type="submit"] {
  background: #0064F5;
  border: 0;
  border-radius: 0 4px 4px 0;
  width: 35%;
  padding: 6px 0;
  text-align: center;
  color: #fff;
  transition: 0.3s;
  cursor: pointer;
}

#footer .footer-top .footer-newsletter input[type="submit"]:hover {
  background: #789d35;
}

#footer .copyright: hover {
  text-align: center;
  padding-top: 30px;
}

#footer .credits {
  padding-top: 1px;
  text-align: center;
  font-size: 13px;
  color: #fff;
}

#loginfrm{

	display: block;
	position: relative;
	border:3px solid #fff;
	margin-top: 1%;
	margin-bottom: 3%;
	margin-left: 53%;
	margin-right: auto;
	max-width:40%;
	background-color: #104080;
	border-radius: 2%;
	color: white;
	box-shadow: 0 2px 4px 0 rgba(12,0,0,0.2), 0 1px 5px 0 rgba(12,0,0,0.19);
}

#loginfrm a {
	color: #FFF;
}

#loginfrm a:hover {
	color: silver;
}

input[type=text], input[type=password], input[type=date],input[type=email] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 10px;
  font-size: 0.9rem;
  
}

.user_detail{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 10px;
  font-size: 0.9rem;
}

button, #btnlogin {
  background-color: #065EA3;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  font-size: 12pt;
  border-radius: 12px;
}

button:hover, #btnlogin:hover {
  background-color: #A0CCF0;
  color: #000;
  
}



.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;

}

img.avatar {
  width: 25%;
  border-radius: 5%;
  margin-left: 11%;
}

.container {
  padding: 0;
}



span.psw {
  float: left;
  padding-top: 2px;
  padding-bottom: 16px;
  
  
}

@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}


.error_label{
	color: #07037C;
	font-size: 14pt;
	font-weight: 500;
}

.success_label{
	color: #0500A7;
	font-size: 14pt;
	font-weight: 500;
}


#rightcont {
	position: absolute;
	display: inline-block;
	left: 50%;
	top: 0%;
	width: 30%;
	max-width:30%;
	height: 100%;
	max-height: 100%;
	background-color: #edf9fc;	
	border-radius: 50px;
}

#login_seperator {
  
  border-left: 1px solid #C9F2FF;
  height: 82%;
  position: absolute;
  left: 50%;
  margin-left: -3px;
  top: 2%;
  bottom: 2%;
}

#login_logo{
	position: fixed;
	top: 29%;
	left: 20%;
	height: 100%;
	width: 75%;
}


#navbar ul li a {
	color: #104080;
	font-weight: 600;
}

#navbar ul li a:hover {
	opacity: 0.7;
}
