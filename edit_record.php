<?php

include('assets/db/database.php');

if(!isset($_SESSION["username"])){
	echo '<p style="color: #C60000;font-size: 14pt;font-weight: 500;">Access Denied: Please <a href="login.php">sign in!</a></p>';
	die();
}



$loggedInUserID = $_SESSION["loggedInUserID"];





// if(!isset($_SESSION["security"])|| $_SESSION["security"] != "0"){
// 	echo '<p style="color: #C60000;font-size: 13pt;font-weight: 500;">
// 	You do not have permission to access this page, please refer to your system administrator.</p>';
// 	die();
	
// }


if(isset($_POST['searchBtn'])) {
	$recordID 			= $_POST['recordID'];
	$firstName 			= $_POST['firstName'];
	$lastName 			= $_POST['lastName'];
	$certificateNo 		= $_POST['certificateNo'];
	$tertiary 			= $_POST['tertiary'];
	$dateOfAward    	= $_POST['dateOfAward'];
	$dateOfBirth 		= $_POST['dateOfBirth'];
	$nameOfInstitution 	= $_POST['nameOfInstitution'];
	$qualification 		= $_POST['qualification'];
	$gradyear 			= $_POST['gradyear'];

	$sql = "UPDATE tblcandidate SET firstname='$firstName', lastname='$lastName', certificateNo='$certificateNo', country='$tertiary', date_of_award='$dateOfAward', dob='$dateOfBirth', institution='$nameOfInstitution', qualification='$qualification', gradyear='$gradyear' WHERE id='$recordID'";
	if ($connection->query($sql) === TRUE) {
		header('Location: record.php');
	} else {
		$message = "Error: " . $sql . "<br>" . $connection->error;
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
				<h2 class="mb-4">Edit Record</h2>
				<div id="main_section">

					<?php 
						$recordID = $_GET['id'];
						$sql = "SELECT * FROM tblcandidate WHERE id='$recordID' LIMIT 1";
						$resul = mysqli_query($connection, $sql);
						$result=mysqli_fetch_assoc($resul);
					?>
					<form method="post" class="form-horizontal">
						<input type="hidden" value="<?= $recordID; ?>" name="recordID" readonly>
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">First Name *</label>
												<div class="col-md-7">
													<input type="text" class="form-control" name="firstName" value="<?= $result['firstname']; ?>" required>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">Last Name *</label>
												<div class="col-md-7">
													<input type="text" class="form-control" name="lastName" value="<?= $result['lastname']; ?>" required>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">Certificate No *</label>
												<div class="col-md-7">
													<input type="text" class="form-control" name="certificateNo" value="<?= $result['certificateno']; ?>" required>
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">Tertiary *</label>
												<div class="col-md-7">
													<input type="text" class="form-control" name="tertiary" value="<?= $result['country']; ?>" required>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">Date of Award *</label>
												<div class="col-md-7">
													<input type="date" class="form-control" style="width: 100%;" name="dateOfAward" value="<?= $result['date_of_award']; ?>" required>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">Date of Birth *</label>
												<div class="col-md-7">
													<input type="date" class="form-control" style="width: 100%;" name="dateOfBirth" value="<?= $result['dob']; ?>" required>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">Name of Institution *</label>
												<div class="col-md-7">
													<input type="text" class="form-control" name="nameOfInstitution" value="<?= $result['institution']; ?>" required>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">Qualification *</label>
												<div class="col-md-7">
													<input type="text" class="form-control" name="qualification" value="<?= $result['qualification']; ?>" required>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-md-4 col-form-label hide-label">Grade Year *</label>
												<div class="col-md-7">
													<input type="text" class="form-control" name="gradyear" value="<?= $result['gradyear']; ?>" required>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" name="searchBtn" class="btn btn-danger">Edit Record</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>


				<!-- validation search result -->
			<?php if(isset($_POST['searchBtn'])) { ?>
				
				<div id="main_section" >
					<?php 
						
						if (mysqli_num_rows($validationSearchResult) > 0) { ?>
							<table class="table table-fluid" id="records_tab_view" style="font-size:0.8rem;">
								<thead style="background-color: #ECFEFF;">
									<tr>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Date of Award</th>
										<th>Name of Institution</th>
										<th>Territory</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								if (mysqli_num_rows($validationSearchResult) > 0) {
									// output data of each row
									while($row = $validationSearchResult->fetch_assoc()) { 
										
										$firstname				= $row["firstname"];
										$lastname				= $row["lastname"];
										$certificateno			= $row["certificateno"];
										$country				= $row["country"];
										$date_of_award			= $row["date_of_award"];
										$dob					= $row["dob"];
										$institution			= $row["institution"];
										$qualification			= $row["qualification"];
										$gradyear				= $row["gradyear"];

										$sql = "INSERT INTO tblhistory (user_id, firstname, lastname, certificateno, country, date_of_award, dob, institution, qualification, gradyear) VALUES ('$loggedInUserID','$firstname', '$lastname', '$certificateno', '$country', '$date_of_award', '$dob', '$institution', '$qualification','$gradyear')";

										if ($connection->query($sql) === TRUE) {} ?>

										<tr>
											<td><?= $firstname; ?></td>
											<td><?= $lastname; ?></td>
											<td><?= $date_of_award; ?></td>
											<td><?= $institution; ?></td>
											<td><?= $gradyear; ?></td>
											<td>
												<a href="generate_validation_report.php"> 
													<button class="dashbtn">
														<i class="fa fa-eye" title="report" name="report"></i> 
														View Report
													</button> 
												</a>
											</td>
										</tr>
									
									<?php	}
								} else {
									echo "0 results";
								} ?>
												
								</tbody>
							</table>
						<?php } else { ?>	
							
							
							<div style="text-align: center;">
								<label class="error_label" style="color:red;">
									No Validation History Found.
								</label>
							</div>	
										
					<?php } ?>
					<script type="text/javascript">
						$(document).ready( function () {
							$('#records_tab_view').DataTable();
						});
					</script>
				</div>
	<?php 	} ?>
				
			</div>	
		</div>
	  
		<script src="assets/js/popper.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/mainside.js"></script>
  	</body>
</html>