<?php

include('assets/db/database.php');



if(!isset($_SESSION["username"])){
	echo '<p style="color: #C60000;font-size: 14pt;font-weight: 500;">Access Denied: Please <a href="login.php">sign in!</a></p>';
	die();
}

// if(!isset($_SESSION["security"])|| $_SESSION["security"] != "0"){
// 	echo '<p style="color: #C60000;font-size: 13pt;font-weight: 500;">
// 	You do not have permission to access this page, please refer to your system administrator.</p>';
// 	die();
	
// }
	
$loggedInUserID = $_SESSION["loggedInUserID"];
	

 


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

				<div id="main_section" >
					
                    <h3 style="text-align: center;margin-bottom: 35px;font-weight: bold;">Validation Report</h3>
                    <?php 
                        $candidateID = $_GET['id'];	
                        $sql = "SELECT * FROM tblcandidate WHERE id='$candidateID' LIMIT 1";
						$resul = mysqli_query($connection, $sql);
						$result=mysqli_fetch_assoc($resul);
                    ?>
                    <table class="table table-fluid" style="width: 50%;margin: 0 auto;border: 1px solid #ccc;" id="records_tab_view" style="font-size:0.8rem;">
                        <tbody>
                            <tr>
                                <td><strong>Candidate</strong></td>
                                <td><?= $result['firstname'].' '.$result['lastname']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Certificate No </strong></td>
                                <td><?= $result['certificateno']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Country</strong></td>
                                <td><?= $result['country']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Date Of Award</strong></td>
                                <td><?= $result['date_of_award']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Date Of Birth</strong></td>
                                <td><?= $result['dob']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Institution </strong></td>
                                <td><?= $result['institution']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Qualification</strong></td>
                                <td><?= $result['qualification']; ?></td>
                            </tr> 
                            <tr>
                                <td><strong>Year Of Grade</strong></td>
                                <td><?= $result['gradyear']; ?></td>
                            </tr>    
                        </tbody>
                    </table>
				</div>
		
			
			</div>	
      	</div>
	  
		<script src="assets/js/popper.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/mainside.js"></script>
  	</body>
</html>