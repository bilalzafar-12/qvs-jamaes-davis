<?php

include('assets/db/database.php');

if(!isset($_SESSION["username"])){
		echo '<p style="color: #C60000;font-size: 14pt;font-weight: 500;">Access Denied: Please <a href="login.php">sign in!</a></p>';
		die();
		
	}

if(!isset($_SESSION["security"])|| $_SESSION["security"] != "0"){
		echo '<p style="color: #C60000;font-size: 13pt;font-weight: 500;">
		You do not have permission to access this page, please refer to your system administrator.</p>';
		die();
		
	}
?>


<!doctype html>
<html lang="en">
	<head>
	<title>Records</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="assets/img/qvs_logo2.png" rel="icon" id="sidebar_logo">
		<link href="assets/css/all.css" rel="stylesheet"> 
		<script defer src="assets/js/all.js"></script>
		
		<link rel="stylesheet" href="assets/css/style_side.css?v=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
		
	<style>
		@media print {
			#main_section, .mb-4 {display:none;}
			#main_section {display:block;}
		}
	
	</style>
		
	</head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch" >
			<nav id="sidebar"  >
			<p> </p>
				<img src="assets/img/qvs_logo4.png" id="sidebar_logo" >
				<div class="p-4 pt-5" style="margin-top:-35%;">
		  		<a href="dashboard.php" class="img logo rounded-circle mb-5" style="background-image: url(assets/images/logo.jpg);"></a>
	        <ul class="list-unstyled components mb-5">
	          <li class="active">
	            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <i class="fa fa-home" style="margin: 0% 1% 0% 1%;"> </i> Dashboard</a>
				              <ul class="collapse list-unstyled" id="homeSubmenu" style="margin-left: 5%;">
	          <li>
	              <a href="dashboard.php"> <i class="fa fa-plus" style="margin: 0% 1% 0% 1%;"> </i> New Validation</a>
	          </li>
              </ul>
	          </li>
	          <li>
              <a href="record.php"> <i class="fa fa-file" style="margin: 0% 1% 0% 1%;"> </i> Records</a>
	          </li>
			  	          <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <i class="fa fa-shield-alt" style="margin-left: 1%;"> </i> Security</a>
              <ul class="collapse list-unstyled" id="pageSubmenu" style="margin-left: 5%;">
                <li>
                    <a href="account.php"> <i class="fa fa-users-cog" style="margin: 0% 1% 0% 1%;"> </i> User Accounts</a>
                </li>
              </ul>
			  	<li>
                    <a href="#"> <i class="fa fa-cog" style="margin: 0% 1% 0% 1%;"> </i> Settings </a>
                </li>
				<li>
                    <a href="logout.php"> <i class="fa fa-sign-out-alt" style="margin: 0% 1% 0% 1%;"> </i> Log out</a>
                </li>
	          </li>
	        </ul>


	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5" >

        <nav class="navbar navbar-expand-lg navbar-light bg-light" >
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
              <ul class="nav navbar-nav ml-auto" >
          	  </br><center>
                <li class="nav-item active">
					<a  href="dashboard.php"> <button type="button" class="dashbtn"> <i class="fa fa-home" title="home" value="'.$row["candidateid"].'" name="home"></i> Home </button> </a>
                    <a href="editaccount.php"> <button type="button" class="dashbtn"> <i class="fa fa-user" title="Edit" value="'.$row["candidateid"].'" name="edit"></i> <?php echo $_SESSION["username"]; ?> </button> </a>
                </li>
              </ul>
			  </center>
            </div>
          </div>
        </nav>

        <h4 class="mb-4">Qualification Validation Report</h4>
	<div id="main_section" style="font-size:1rem;">
	
	<center><img src="assets/img/qvs_logo2.png" height=25% width=25% id="reportlogo"/> </center>
	 <p> wqg dguigiufgduf gudguifdg ufg uidgfugfiu gdugud 
	  f ggfg hvd did uifguidg iudgugsdgugd ui giudg u guf
	   rhodgf gufgugfugug eu9g r9g9 egufge9ug 9uegf9g gfrgfgr
	    rihi grghrgg griigiohoighioh io goifg oegofgfgfeoi </p>
		
		
		 <p> wqg dguigiufgduf gudguifdg ufg uidgfugfiu gdugud 
	  f ggfg hvd did uifguidg iudgugsdgugd ui giudg u guf
	   rhodgf gufgugfugug eu9g r9g9 egufge9ug 9uegf9g gfrgfgr
	    rihi grghrgg griigiohoighioh io goifg oegofgfgfeoi </p>
	
	
	
	 <p> wqg dguigiufgduf gudguifdg ufg uidgfugfiu gdugud 
	  f ggfg hvd did uifguidg iudgugsdgugd ui giudg u guf
	   rhodgf gufgugfugug eu9g r9g9 egufge9ug 9uegf9g gfrgfgr
	    rihi grghrgg griigiohoighioh io goifg oegofgfgfeoi </p>
	
	
	
	 <p> wqg dguigiufgduf gudguifdg ufg uidgfugfiu gdugud 
	  f ggfg hvd did uifguidg iudgugsdgugd ui giudg u guf
	   rhodgf gufgugfugug eu9g r9g9 egufge9ug 9uegf9g gfrgfgr
	    rihi grghrgg griigiohoighioh io goifg oegofgfgfeoi </p>
	
	

	</div>			

      </div>
		</div>
		
  
	
	
	
  </body>
</html>