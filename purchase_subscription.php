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

?>

	


<!doctype html>
<html lang="en">
	<head>
		<title>Purchase Subscription</title>
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
			<nav id="sidebar">
				<p></p>
				<img src="assets/img/qvs_logo4.png" id="sidebar_logo" >
				<div class="p-4 pt-5" style="margin-top:-35%;">
					<a href="dashboard.php" class="img logo rounded-circle mb-5" style="background-image: url(assets/images/logo.jpg);"></a>
					<ul class="list-unstyled components mb-5">
						<li class="active">
							<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> 
								<i class="fa fa-home" style="margin: 0% 1% 0% 1%;"> </i> 
								Dashboard
							</a>
							<ul class="collapse list-unstyled" id="homeSubmenu" style="margin-left: 5%;">
								<li>
									<a href="#"> 
									<i class="fa fa-plus" style="margin: 0% 1% 0% 1%;"> </i> 
									New Validation
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="record.php"> 
								<i class="fa fa-file" style="margin: 0% 1% 0% 1%;"></i> 
								Records
							</a>
						</li>
						<li>
							<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> 
								<i class="fa fa-shield-alt" style="margin-left: 1%;"> </i> Security
							</a>
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
								</br>
								<li class="nav-item active">
									<a  href="dashboard.php"> <button type="button" class="dashbtn"> <i class="fa fa-home" title="home" value="'.$row["candidateid"].'" name="home"></i> Home </button> </a>
									<a href="editaccount.php"> <button type="button" class="dashbtn"> <i class="fa fa-user" title="Edit" value="'.$row["candidateid"].'" name="edit"></i> <?php echo $_SESSION["username"]; ?> </button> </a>
								</li>
							</ul>
						</div>
					</div>
				</nav>

				<h2 class="mb-4">Purchase Subscription</h2>
				
				<div id="main_section" >
					<form id="customer-subscription-form" class="form-horizontal">
						<div class="container">
							<div class="row justify-content-center">
							
								<div class="col-md-12">
									<!-- Display errors returned by createToken -->
									<div id="paymentResponse" style="color: red;"></div>
									<div id="customer-info" class="form-horizontal customer-info">
										<label><h4>Personal Info</h4></label>
										<div class="form-group row justify-content-center">
											<label for="lastName" class="col-sm-2 col-form-label hide-label">Choose Subscription Plan *</label>
											<div class="col-sm-8">
												<select class="form-control" id="subscriptionType" name="subscriptionType" required>
													<option value="">Choose Subscription</option>
													<option value="20">Yearly</option>
													<option value="5">Monthly</option>
												</select>
											</div>
										</div>
										<div class="form-group row justify-content-center">
											<label class="col-sm-2 col-form-label hide-label">Subscription Price</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="subscriptionPrice" placeholder="Choose Subscription Price First" readonly required>
											</div>
										</div>

										<div class="form-group row justify-content-center   ">
											<label for="firstName" class="col-sm-2 col-form-label hide-label">First Name *</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="firstName" placeholder="First Name" required>
											</div>
										</div>

										<div class="form-group row justify-content-center">
											<label for="lastName" class="col-sm-2 col-form-label hide-label">Last Name *</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="lastName" placeholder="Last Name" required>
											</div>
										</div>

										<div class="form-group row justify-content-center">
											<label for="staticEmail" class="col-sm-2 col-form-label hide-label">Email *</label>
											<div class="col-sm-8">
												<input type="email" class="form-control" id="staticEmail"  placeholder="Enter email" required>
											</div>
										</div>

										

										<label><h4>Credit Card Info</h4></label>
										<div class="form-group row justify-content-center">
											<label for="card_number" class="col-sm-2 col-form-label hide-label">Credit Card</label>
											<div class="col-sm-4">
												<div id="card_number" class="field"></div>
											</div>
											<div class="col-sm-2">
												<div id="card_expiry" class="field"></div>
											</div>

											<div class="col-sm-2">
												<div id="card_cvc" class="field"></div>
											</div>
										</div>

										
										<div class="form-group row">
											<div class="col-md-8 text-center">
												<div class="text-center">
													<!-- id="stripe-button-payment" -->
													<button style="content-align: center;margin-top: 10px" type="submit" class="btn btn-success col-md-3 stripe-button" id="subscribePayment">Subscribe</button>
													<p id="processingPaymentText" style="display: none;">Processing Payment...</p>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
	
			</div>	
		</div>
	  
	  
	  <script type="text/javascript">
       
        var stripe = Stripe("pk_test_51IWF55GJtXWNOZtOtDKqWKCNSjl2Qa7dy2Z3R5nDzddXyeOil7i5KKf0Bc6Vbm7jnsl7L9iUIsQCNUHQCFJBnUL900AMWeUvaY");
        // Create an instance of elements
        var elements = stripe.elements();

        var style = {
            base: {
                fontWeight: 400,
                fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
                fontSize: '16px',
                lineHeight: '1.4',
                color: '#555',
                backgroundColor: '#fff',
                '::placeholder': {
                    color: '#888',
                },
            },
            invalid: {
                color: '#eb1c26',
            }
        };

        var cardElement = elements.create('cardNumber', {
            style: style
        });
        cardElement.mount('#card_number');

        var exp = elements.create('cardExpiry', {
            'style': style
        });
        exp.mount('#card_expiry');

        var cvc = elements.create('cardCvc', {
            'style': style
        });
        cvc.mount('#card_cvc');

        // Validate input of the card elements
        var resultContainer = document.getElementById('paymentResponse');
        cardElement.addEventListener('change', function(event) {
            if (event.error) {
                resultContainer.innerHTML = '<p>' + event.error.message + '</p>';
            } else {
                resultContainer.innerHTML = '';
            }
        });

		$(document).ready(function() {
			$("#subscriptionType").change(function() {
				if($(this).val() != "" ) {
					var currentVal = $(this).val();
					$("#subscriptionPrice").val(currentVal+"$");
				} else {
					$("#subscriptionPrice").val("");
				}
			});

			$("#customer-subscription-form").on('submit',function(e) {
                var stripeTokenID;
                var errorMessage;
                var isValid = true;
				

                if ($("#subscriptionType").val() == '') {
                    $('#stripe-donation-error').show();
                    return false;
                } else {
                    $('#stripe-donation-error').hide()
                }

                
                var subscriptionType = $("#subscriptionType").val();

                stripe.createToken(cardElement).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        errorMessage = result.error.message;
                        resultContainer.innerHTML = '<p>' + errorMessage + '</p>';
                
                        isValid = false;
                    } else {
						$("#subscribePayment").hide();
						$("#processingPaymentText").show();
                        // Send the token to your server
                        stripeTokenID = result.token.id;
                        isValid = true;

                        var data = {
                            "stripeTokenID": stripeTokenID,
                            "price": subscriptionType,
                            "firstName": $("#firstName").val(),
                            "lastName": $("#lastName").val(),
                            "email": $("#staticEmail").val(),
                        };
                        data = JSON.stringify(data);
						
                        fetch("create-checkout-session.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: data
                        }).then((response) => {
							return response.json();
						}).then(function(result) {
                            console.log(result);
							if(result.Status) {
								alert("Payment successful");
								window.location.replace("http://localhost/QVS/dashboard.php");
							} else {
								alert("Payment not successful");
								window.location.replace("http://localhost/QVS/dashboard.php");
							}
                        });
                    }
                });

                if (!isValid) {
                    resultContainer.innerHTML = '<p>' + errorMessage + '</p>';
                    return false;
                }
				return false;
            });
		});
   </script>
	
		
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/mainside.js"></script>

  </body>
</html>