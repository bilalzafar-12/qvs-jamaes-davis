<?php

include('assets/db/database.php');

if(!isset($_SESSION["username"])){
	echo '<p style="color: #C60000;font-size: 14pt;font-weight: 500;">Access Denied: Please <a href="login.php">sign in!</a></p>';
	die();
}

$loggedInUserID = $_SESSION["loggedInUserID"];
$userID = $_GET['user_id'];

$sql = "UPDATE users SET blockstatus ='1' WHERE id='$userID'";
if ($connection->query($sql) === TRUE) {

	if($userID == $loggedInUserID) {
		session_destroy();
		header('Location: login.php');
	} else {
		header('Location: account.php');
	}
 		
} else {
	echo "Error: " . $sql . "<br>" . $connection->error;
	die();
}