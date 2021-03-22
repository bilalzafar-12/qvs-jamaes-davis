<?php

include('assets/db/database.php');
require 'stripe-php/init.php';
$isSuccess = true;
$stripeAPiKey = "sk_test_51IWF55GJtXWNOZtOp9OeJH0FvkgoN4QjAgRKOZjby91TRDimSDDzOxJt2hv9nOAeUQxL6jRDJ4A44l1glQIedZwE00zD0cFcf4";


$entityBody = file_get_contents('php://input');
$request = json_decode($entityBody);

\Stripe\Stripe::setApiKey($stripeAPiKey);
$stripe = new \Stripe\StripeClient($stripeAPiKey);

header('Content-Type: application/json');

$customerResponse = $stripe->customers->create([
	'source'=>$request->stripeTokenID,
	'email'=>$request->email,
	'name'=>$request->firstName.' '.$request->lastName,
	'description' => '',
]);


try { 
		
	// Charge the Customer instead of the card:
	$chargedResponse = $charge = \Stripe\Charge::create([
		'amount' => $request->price*100,
		'currency' => 'usd',
		'customer' => $customerResponse->id,
	]);

		
} catch(Exception $e) { 
	$isSuccess = false;
	//print_r( $e->getMessage()); 
} 


if($isSuccess) {

	$userID = $_SESSION["loggedInUserID"];
	$subscriptionStartDate = date('Y-m-d');
	if($request->price == "5") {
		$subscriptionExpiryDate = date('Y-m-d', strtotime('+1 month'));
	} else {
		$subscriptionExpiryDate = date('Y-m-d', strtotime('+1 years'));
	}

	$sql = "INSERT INTO user_subscription (user_id, first_name, last_name, email, stripe_customer_id, stripe_charge_id ,  	subscription_start_date, subscription_expiry_date, amount) VALUES ('$userID','$request->firstName', '$request->lastName', '$request->email', '$customerResponse->id', '$chargedResponse->id','$subscriptionStartDate','$subscriptionExpiryDate', '$request->price')";

	if ($connection->query($sql) === TRUE) {
		$isSuccess = true;
	} else {
		$isSuccess = false;
		//$message = "Error: " . $sql . "<br>" . $connection->error;
	}
	

} else {
    $isSuccess = false;
}

if($isSuccess) {

	$response = array('Status' => $isSuccess);
	echo json_encode($response);

} else {

	$response = array('Status' => $isSuccess);
	echo json_encode($response);
}

?>