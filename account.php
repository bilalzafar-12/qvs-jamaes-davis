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

// if(!isset($_SESSION["security"])|| $_SESSION["security"] != "0"){
// 		echo '<p style="color: #C60000;font-size: 13pt;font-weight: 500;">
// 		You do not have permission to access this page, please refer to your system administrator.</p>';
// 		die();
		
// 	}
?>


<!doctype html>
<html lang="en">
	<head>
	<title>Accounts</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="assets/img/qvs_logo2.png" rel="icon">
		<link href="assets/css/all.css" rel="stylesheet"> 
		<script defer src="assets/js/all.js"></script>
		
		<link rel="stylesheet" href="assets/css/style_side.css?v=1.52">
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

        <h2 class="mb-4">User Accounts</h2>
		<div id="main_section">
			<center>
				<ul style="list-style-type: none;">
					<li class="nav-item active">
						<a href="add_user.php"> 
							<button type="button" class="createacbtn">  
								<i class="fa fa-user-plus" title="Edit"name="edit"></i> 
								Create Account 
							</button> 
						</a>
					</li>
				</ul>
			</center>
			<?php 
				
				$sql = "SELECT * FROM users";
				$result = mysqli_query($connection, $sql);

				if (mysqli_num_rows($result) > 0) { ?>
					<table class="table table-fluid" id="records_tab_view" style="border-color:#104080;">
						<thead>
							<tr>
								<th>Firstname</th>
								<th>Lastname</th>
								<th>EmailLastname</th>
								<th>Security Group</th>
								<th>Account Status</th>
								<th>Action</th>
								</tr>
						</thead>
						<?php 	
						while($row = mysqli_fetch_assoc($result)) { ?>
							<tr>
								<td><?= $row["first_name"] ?></td>
								<td><?= $row["last_name"] ?></td>
								<td><?= $row["email"] ?></td>
								<td><?= $row["securitygroup"] ?></td>
								<td><?= $row["blockstatus"] ?></td>
								<td>
									<a href="edit_user.php?id=<?= $row['id']; ?>">
										<i class="fa fa-edit" title="Edit"></i>
									</a> \
									<?php if($row["blockstatus"] == "0") { ?> 
										<a href="disable_account.php?user_id=<?= $row['id'];?>">
											Mark Account as Disable
										</a>
									<?php } else { ?>
										<a href="enable_account.php?user_id=<?= $row['id'];?>">
											Mark Account as Enable
										</a>
									<?php } ?> 
								</td>
							</tr>
						<?php }
				} else {
					echo "0 results";
				}
	
				echo '</tbody></table>';				
			?>
		<script type="text/javascript">
			$(document).ready( function () {
				$('#records_tab_view').DataTable();
			});
		</script>
</div>			


      </div>
		</div>
		
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/mainside.js"></script>
  </body>
</html>