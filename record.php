<?php

include('assets/db/database.php');

if(!isset($_SESSION["username"])){
	echo '<p style="color: #C60000;font-size: 14pt;font-weight: 500;">Access Denied: Please <a href="login.php">sign in!</a></p>';
	die();
	
}

if(isset($_SESSION["security"]) && $_SESSION["security"] == "0"){
	echo '<p style="color: #C60000;font-size: 13pt;font-weight: 500;">
	You do not have permission to access this page, please refer to your system administrator.</p>';
	die();
	
}

$loggedInUserID = $_SESSION["loggedInUserID"];

function csvToArray($filename = '', $delimiter = ',') {
	

	$header = null;
	$data = array();
	if (($handle = fopen($filename, 'r')) !== false) {
		while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
			if (!$header)
				$header = $row;
			else
				$data[] = array_combine($header, $row);
		}
		fclose($handle);
	}

	return $data;
}



if(isset($_POST['uploadCsvBtn'])) {
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Allow certain file formats
	if($imageFileType != "csv") {
		$message =  "Sorry, only CSV files are allowed.";
		$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$message = "Sorry, your file was not uploaded.";
	} else {

		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$listingsArr = csvToArray($target_file);
			// echo "<pre>";
			// print_r($listingsArr);
			foreach($listingsArr as $listingArr) { 
				$firstname 		= $listingArr['firstname'];
				$lastname 		= $listingArr['lastname'];
				$certificateno 	= $listingArr['certificateno'];
				$country 		= $listingArr['country'];
				$dateofaward 	= date("Y-m-d", strtotime($listingArr['dateofaward']));
				$dob 			= date("Y-m-d", strtotime($listingArr['dob']));
				$institution 	= $listingArr['institution'];
				$qualification 	= $listingArr['qualification'];
				$gradyear 		= $listingArr['gradyear'];







				$sql = "INSERT INTO tblcandidate (firstname, lastname, certificateno, country, date_of_award, dob, institution, qualification, gradyear) VALUES ('$firstname', '$lastname', '$certificateno', '$country', '$dateofaward', '$dob', '$institution', '$qualification','$gradyear')";

				if ($connection->query($sql) === TRUE) {
					$message = '<label class="success_label" style="color: #FFF;">Csv Imported </label>';
				} else {
					$message = "Error: " . $sql . "<br>" . $connection->error;
				}

			}
			
		} else {
			$message = "Sorry, there was an error uploading your file.";
		}
	}
	
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
		
		<link rel="stylesheet" href="assets/css/style_side.css?v=1.54">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
	</head>
  	<body>
		
	<div class="wrapper d-flex align-items-stretch" >
		<?php include('layouts/sidebar.php'); ?>

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
							</br>
							<li class="nav-item active">
								<a  href="dashboard.php"> 
									<button type="button" class="dashbtn"> 
										<i class="fa fa-home" title="home" value="'.$row['"candidateid"].'" name="home"></i> 
										Home 
									</button> 
								</a>
								<a href="editaccount.php"> 
									<button type="button" class="dashbtn"> 
										<i class="fa fa-user" title="Edit" value="'.$row["candidateid"].'" name="edit"></i> 
										<?php echo $_SESSION["username"]; ?> 
									</button> 
								</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<h2 class="mb-4">Records Management</h2>
			<div id="main_section" style="font-size:1vw;">
				<center>
					<ul style="list-style-type: none;">
						<li class="nav-item active">
							<a href="add_record.php"> 
								<button type="button" class="addrecordbtn">  
									<i class="fa fa-plus" title="Edit"name="edit"></i> 
									Add Record 
								</button> 
							</a>
							<hr>
							<h3 style="text-align: left;">Import Records </h3>
							<?php if(isset($message)) { echo $message; } ?>
							<form class="form-inline" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<input type="file" name="fileToUpload" class="form-control" required>
								</div>
								<button type="submit" name="uploadCsvBtn" class="btn btn-danger">upload csv</button>
							</form>
							<hr> 
						</li>
					</ul>
				</center>
				
				<?php 
					// if($_SESSION["security"] === "0"){
						$query = "SELECT * FROM tblcandidate";
						$data = $connection->query($query); ?>
						<table class="table table-fluid" id="records_tab_view" style="font-size:0.8vw;">
							<thead style="background-color: #ECFEFF;">
								<tr>
									<th>Candidate ID</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Certificate ID</th>
									<th>Institution</th>
									<th>Qualification</th>
									<th>Graduation Year</th>
									<th>Country</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php	foreach($data as $row) { ?>
								<tr>
									<td><?= $row["id"] ?></td>
									<td><?= $row["firstname"] ?></td>
									<td><?= $row["lastname"] ?></td>
									<td><?= $row["certificateno"] ?></td>
									<td><?= $row["institution"] ?></td>
									<td><?= $row["qualification"] ?></td>
									<td><?= $row["gradyear"] ?></td>
									<td><?= $row["country"]?></td>
									<td>
										<a href="edit_record.php?id=<?= $row["id"];?>">
											<i class="fa fa-edit" title="Edit"></i>
										</a>
										&nbsp;\&nbsp;
										<a href="delete_record.php?id=<?= $row["id"];?>">
											<i class="fa fa-trash" name="delete" title="Delete" value="<?=$row["candidateid"]?>"></i>
										</a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
								
					
			</div>			
		</div>
	</div>
		
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/mainside.js"></script>
	<script type="text/javascript">
		$(document).ready( function () {
			$('#records_tab_view').DataTable();
		});
	</script>
	
  </body>
</html>