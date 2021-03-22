<?php

	include('assets/db/database.php');

	if(!isset($_SESSION["username"])){
		echo '<p style="color: #C60000;font-size: 14pt;font-weight: 500;">Access Denied: Please <a href="login.php">sign in!</a></p>';
		die();
	}

	if(!isset($_SESSION["security"]) && $_SESSION["security"] != "0"){
		echo '<p style="color: #C60000;font-size: 13pt;font-weight: 500;">
		You do not have permission to access this page, please refer to your system administrator.</p>';
		die();
		
	} 

	$loggedInUserID = $_SESSION["loggedInUserID"];
	$activeTab = "accountUpdate";
	$sql = "SELECT * FROM users WHERE id='$loggedInUserID' LIMIT 1";
	$resul = mysqli_query($connection, $sql);

	if (mysqli_num_rows($resul) > 0) {
		
		$result = mysqli_fetch_assoc($resul);
			
		$email = $result["email"];
		$firstname = $result["first_name"];
		$lastname = $result["last_name"];
		$city = $result["city"];
		$country = $result["country"];
		$phone = $result["phone"];
		$dob = $result["dob"];
		$desc = $result["description"];
		$created_at = $result["created_at"];
	}

	

	// update user profile
	if(isset($_POST["updateProfile"])){
		$activeTab = "accountUpdate";

		$userID 			= $loggedInUserID;
		$firstName 			= $_POST['first_name'];
		$lastName 			= $_POST['last_name'];
		$dob 				= $_POST['dob'];
		$phone 				= $_POST['phone'];
		$city 				= $_POST['city'];
		$country 			= $_POST['country'];
		
		$sql = "UPDATE users SET first_name='$firstName', last_name='$lastName', dob='$dob', phone='$phone', city='$city', country='$country' WHERE id='$userID'";
		if ($connection->query($sql) === TRUE) {
			// getting updated record
			$sql = "SELECT * FROM users WHERE id='$loggedInUserID' LIMIT 1";
			$resul = mysqli_query($connection, $sql);

			if (mysqli_num_rows($resul) > 0) {
				
				$result = mysqli_fetch_assoc($resul);
					
				$email = $result["email"];
				$firstname = $result["first_name"];
				$lastname = $result["last_name"];
				$city = $result["city"];
				$country = $result["country"];
				$phone = $result["phone"];
				$dob = $result["dob"];
				$desc = $result["description"];
				$created_at = $result["created_at"];
			}

			$updateProfileMessage = "Profile updated successfully.";
		} else {
			echo "Error: " . $sql . "<br>" . $connection->error;
			die();
		}
	}

	// update user profile
	if(isset($_POST["changePassword"])){
		$activeTab = "passwordUpdate";
		$currentPassword	= $_POST['currentPassword'];
		$newPassword		= $_POST['newPassword'];
		$confirmPassword	= $_POST['confirmPassword'];
		
		if($newPassword == $confirmPassword) {
			$sql = "SELECT password FROM users WHERE id='$loggedInUserID' LIMIT 1";
			$resul = mysqli_query($connection, $sql);

			if (mysqli_num_rows($resul) > 0) {
				
				$result = mysqli_fetch_assoc($resul);
					
				$userDbCurrentPassword = $result["password"];
				if(md5($currentPassword) == $userDbCurrentPassword)  {

					$changePasswordMessage = "current password correct";
					$newPassword = md5($newPassword);
					$sql = "UPDATE users SET password='$newPassword' WHERE id='$loggedInUserID'";
					if ($connection->query($sql) === TRUE) {
					

						$changePasswordMessage = "Password Changed successfully.";
					} else {
						echo "Error: " . $sql . "<br>" . $connection->error;
						die();
					}
				} else {
					$changePasswordMessage = "please enter correct current password";
				}	
			}

		} else {
			$changePasswordMessage = "please enter new password and confirm password same";
		}

		
	}
?>


<!doctype html>
<html lang="en">
	<head>
		<title>Records</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="assets/img/logo.png" rel="icon">
		<link href="assets/css/all.css" rel="stylesheet"> 
		<script defer src="assets/js/all.js"></script>
		<link rel="stylesheet" href="assets/css/stylemodal.css?v=1.66">
		<link rel="stylesheet" href="assets/css/style_side.css?v=1.55">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
		<style>
			input[type="text"], input[type="password"], input[type="date"], #inputlist {
				width: 30%;
				padding: 10px 20px;
				margin: 1% 2% 1% 2%;
				display: inline-block;
				border: 1px solid #ccc;
				box-sizing: border-box;
				border-radius: 5px;
				font-size: inherit !important;
			}
		</style>
	</head>
  	<body>
  

		
		<div class="wrapper d-flex align-items-stretch" >
			<?php include('layouts/sidebar.php'); ?>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<button type="button" id="sidebarCollapse" class="btn btn-primary">
					<i class="fa fa-bars"></i>
					<span class="sr-only">Toggle Menu</span>
				</button>
				<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fa fa-bars"></i>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="nav navbar-nav ml-auto">
						<li class="nav-item active">
							<a  href="dashboard.php"> 
								<button type="button" class="dashbtn"> 
									<i class="fa fa-home" title="home"></i> 
									Home 
								</button> 
							</a>
						<a href="editaccount.php">
							<button type="button" class="dashbtn" id="myBtn"> 
								<i class="fa fa-user" title="Edit"></i> 
								<?php echo $_SESSION["username"]; ?> 
								</button> 
							</a>
						</li>
					</ul>
				</div>
			</div>
        </nav>
		
		
		       

		
	   <div id="main_section_usr"  data-keyboard="false" data-backdrop="static">

		

	  <!-- Modal content -->
	  <div class="modalt-content">	
	  
		<div class="modalt-header">
			<span id="title_info"></br>User Profile</span>
		</div>
		
		<div class="modalt-body">
		
			<section id="modal_body_left">
				<center>
					<img src="assets/img/upload.webp" id="imgupload">
					<p style="margin-top: 5%;"> 
						<span style="font-size: 0.8vw;font-weight:bold;"> 
							<?php echo $_SESSION["username"]; ?> 
						</span></br> 
						<span style="font-size: 0.65vw;font-weight:500;color:rgba(0,0,0,0.5);"> 
							<?php echo $desc;?> 
						</span>
					</p>
					
					<ul id="modal_body_left_info"  style="text-align:left;margin-left: 3%; margin-right: 3%;"> 
						<!-- <li> <strong> Subscription: </strong><span style="color: blue;">unlimited </span></li> -->
						<!-- <li> <strong> Last Login: </strong> January 3, 2021 </li> -->
						<li> <strong> Location:</strong> <?php echo $country;?>  </li>
						<li>  
							<strong> Accounted Created:</strong> 
							<?php echo date("M d, Y", strtotime($created_at)); ?></li>
					</ul>
				</center>
			</section>
			
			<section id="modal_body_right">
				<div class="tab">
					<button class="tablinks" onclick="openTab(event, 'frmeditaccount')" <?php if($activeTab =="accountUpdate") { ?>  id="defaultOpen" <?php } ?> >Personal Details</button>
					<button class="tablinks" onclick="openTab(event, 'frmeditsecurity')" <?php if($activeTab =="passwordUpdate") { ?>  id="defaultOpen" <?php } ?>>Account Security</button>
					<button class="tablinks" onclick="openTab(event, 'frmeditsubscription')">Subscription</button>
					<button class="tablinks" onclick="openTab(event, 'frmeditpermission')">Permission</button>	
					
				</div>
				
				
					<div id="frmeditaccount" class="tabcontent">
						<form method="post" >
							<h3 style="color: black;margin-left: 1.7%;"> Edit Profile </h3>
						 	<div class="account_input_container">							 

								<label for="fname"> First Name: </label>
								<input type="text" value=<?php echo $firstname ?> name="first_name"/>
								<label for="lname"> Last Name: </label> 
								<input type="text" value=<?php echo $lastname ?> name="last_name" /> </br>
								<label for="city"> City: </label> 
								<input type="text" value=<?php echo $city ?> name="city" />
								<label for="territory"> Country: </label> 
								<input list="locations" value=<?php echo $country ?> name="country" id="inputlist" /> </br>
								
								<datalist id="locations">
									<option value="Jamaica">
									<option value="Trigoidad & Tobao">
									<option value="Barbados">
								</datalist>
								<label for="phone"> Contact No.: </label> 
								<input type="text" value=<?php echo $phone ?> name="phone" /> 
								<label for="dob"> Date of Birth: </label> 
								<input type="date" name="dob" style="width: 30%;" value=<?php echo $dob ?> >
							
							
								</br>
								<input type="submit" name="updateProfile" value="Update" class="dashbtn" id="btnedit" style="margin: 0px 0px 0px 15px;"/>
								<?php
									if(isset($updateProfileMessage)) {
										echo '<label class="error_label" style="width: auto !important;">'.$updateProfileMessage.'</label>';
									}						
								?>
						  	</div>
						</form>
					</div>

					<!-- change password -->
					<div id="frmeditsecurity" class="tabcontent">
						<form method="post">
						  	<div class="account_input_container">
								<h5 style="color: black;margin-left: 1.7%;"> Change password </h5>				
								<input type="password" placeholder="current password" name="currentPassword" required/></br>
								<input type="password" placeholder="new password" name="newPassword" required/> </br>
								<input type="password" placeholder="confirm password" name="confirmPassword" required/>
								</br>
								<input type="submit" name="changePassword" class="dashbtn" id="btnedit"/>
								<?php if(isset($changePasswordMessage)) {
									echo '<label class="error_label">'.$changePasswordMessage.'</label>';
								} ?>
							</div>
						</form>
					</div>

					<!-- subscription tab -->
					<div id="frmeditsubscription" class="tabcontent">
					
						<form method="post">
						  	<div class="account_input_container">
								<h5 style="color: black;margin-left: 1.7%;"> User Subscription</h5></br>
								<?php 
								$subscriptionQ = "SELECT id,subscription_start_date,subscription_expiry_date  FROM user_subscription WHERE user_id='$loggedInUserID' LIMIT 1";	
								$checkSubsExpiry = $connection->query($subscriptionQ);
								if ($checkSubsExpiry->num_rows > 0) { 
									$checkSubsExpiryy = mysqli_fetch_assoc($checkSubsExpiry); 		
									if($checkSubsExpiryy['subscription_expiry_date'] > date('Y-m-d')) { ?>
										<span style="color: #000;margin: 2%;"> 
											Subscription Start Date: 
											<strong>
												<?php 
													echo date("M d, Y", strtotime($checkSubsExpiryy['subscription_start_date'])); 
												?>
											</strong> 
										</span><br>
										<span style="color: #000;margin: 2%;"> 
											Subscription End Date: 
											<strong>
												<?php
													echo date("M d, Y", strtotime($checkSubsExpiryy['subscription_expiry_date'])); 
												?>
											</strong> 
										</span>
									<?php } else { ?>
										<span style="color: #000;margin: 2%;"> Your Subscription Expired! </span>
									<?php } 
								} else { ?>
									<span style="color: #000;margin: 2%;"> No Subscription Exist </span>	
								<?php } ?>
							
							
						  </div>
							
						</form>
						
					
					</div>
					
					<div id="frmeditpermission" class="tabcontent">
					
						<form method="post" >
						  <div class="account_input_container">
							<h5 style="color: black;margin-left: 1.7%;"> User Roles </h5>				
													
							</br>
							
							<span style="color: #000;margin: 2%;"> This is an administrator account with full access to the system. </span>
							<!-- <input type="submit" name="login" value="Update" class="dashbtn" id="btnedit"/> -->
							
						  </div>
							
						</form>
						
					
					</div>
									

				 
			</section>

		
		</div>
		
		
	  </div>
	  
	  
	<script>

	function openTab(evt, tabName) {
	  var i, tabcontent, tablinks;
	  tabcontent = document.getElementsByClassName("tabcontent");
	  for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	  }
	  tablinks = document.getElementsByClassName("tablinks");
	  for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	  }
	  document.getElementById(tabName).style.display = "block";
	  evt.currentTarget.className += " active";
	}

	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();
	</script>

	  
	  
	</div>
	</div>
	 
		
		
		
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/mainside.js"></script>
	
	
	
  </body>
</html>