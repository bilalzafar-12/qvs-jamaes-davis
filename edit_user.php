<?php

include('assets/db/database.php');

if(!isset($_SESSION["username"])){
	echo '<p style="color: #C60000;font-size: 14pt;font-weight: 500;">Access Denied: Please <a href="login.php">sign in!</a></p>';
	die();
}

$loggedInUserID = $_SESSION["loggedInUserID"];

if($_SESSION['security'] == "0") {
	$emailQ = "SELECT id,subscription_expiry_date  FROM user_subscription WHERE user_id='$loggedInUserID' LIMIT 1";	
	$checkSubsExpiry = $connection->query($emailQ);
	if ($checkSubsExpiry->num_rows > 0) { 
		$checkSubsExpiryy=mysqli_fetch_assoc($checkSubsExpiry); 		
		if($checkSubsExpiryy['subscription_expiry_date'] < date('Y-m-d')) { 
			echo '<p style="color: #C60000;font-size: 13pt;font-weight: 500;">Your subscription expired.</p>';
			die();
		} 
	} else { 
		echo '<p style="color: #C60000;font-size: 13pt;font-weight: 500;">Your do subscription first.</p>';
		die();	
	} 
}


if(isset($_POST['updateUser'])) {
	$userID 			= $_POST['userID'];
	$firstName 			= $_POST['first_name'];
	$lastName 			= $_POST['last_name'];
	$dob 				= $_POST['dob'];
	$phone 				= $_POST['phone'];
	$city 				= $_POST['city'];
	$country 			= $_POST['country'];
	$user_detail    	= $_POST['user_detail'];
	

	$sql = "UPDATE users SET first_name='$firstName', last_name='$lastName', dob='$dob', phone='$phone', city='$city', country='$country', description='$user_detail' WHERE id='$userID'";
	if ($connection->query($sql) === TRUE) {
		header('Location: account.php');
	} else {
		echo "Error: " . $sql . "<br>" . $connection->error;
		die();
	}
}

?>


<!doctype html>
<html lang="en">
	<head>
		<title>Dashboard</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="assets/img/qvs_logo2.png" rel="icon">
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/style_side.css?v=1.42">
		<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
		<!-- stripe integration -->
		<script src="https://js.stripe.com/v3/"></script>
	</head>
  	<body>
		<div class="wrapper d-flex align-items-stretch" >
			<?php include('layouts/sidebar.php'); ?>
			<!-- Page Content  -->
			<div id="content" class="p-4 p-md-5">
				<nav class="navbar navbar-expand-lg navbar-red bg-red" id="navbar">
					<div class="container-fluid" >
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
										<button type="button" class="dashbtn"> 
											<i class="fa fa-user" title="Edit"></i> 
											<?php echo $_SESSION["username"]; ?> 
										</button> 
									</a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
				<h2 class="mb-4">Update User</h2>
                <?php 
                    if(isset($message)) { 
                        echo $message; 
                    }
                ?>
				<div id="main_section">
					<?php 
						$userID = $_GET["id"];
						$sql = "SELECT * FROM users WHERE id='$userID' LIMIT 1";
						$resul = mysqli_query($connection, $sql);
						$result=mysqli_fetch_assoc($resul);
					?>
					<form method="post" class="form-horizontal">
						<input type="hidden" value="<?= $userID; ?>" name="userID" readonly>
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">First Name *</label>
												<div class="col-md-7">
													<input type="text" class="form-control" name="first_name" value="<?= $result['first_name']; ?>" required>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">Last Name *</label>
												<div class="col-md-7">
													<input type="text" class="form-control" name="last_name" value="<?= $result['last_name']; ?>" required>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="row">
										
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">Date of Birth *</label>
												<div class="col-md-7">
													<input type="date" class="form-control" style="width: 100%;" name="dob" value="<?= $result['dob']; ?>" required>
												</div>
											</div>
										</div>
                                        <div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">Phone Number *</label>
												<div class="col-md-7">
													<input type="text" class="form-control" style="width: 100%;" name="phone"  value="<?= $result['phone']; ?>" required>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">City *</label>
												<div class="col-md-7">
													<input type="text" class="form-control" name="city" value="<?= $result['city']; ?>" required>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">Country *</label>
												<div class="col-md-7">
													<input type="text" class="form-control" name="country" value="<?= $result['country']; ?>" required>
												</div>
											</div>
										</div>
									</div>
								</div>
                               <div class="col-md-12">
									<div class="row">
                                        <div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">Detail *</label>
												<div class="col-md-7">
													<textarea class="form-control" name="user_detail" required><?= $result['description']; ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" name="updateUser" class="btn btn-danger">Update User</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>				
			</div>	
		</div>
		<script src="assets/js/popper.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/mainside.js"></script>
  	</body>
</html>