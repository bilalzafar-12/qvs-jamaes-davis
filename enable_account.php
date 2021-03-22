<?php

include('assets/db/database.php');

if(!isset($_SESSION["username"])){
	echo '<p style="color: #C60000;font-size: 14pt;font-weight: 500;">Access Denied: Please <a href="login.php">sign in!</a></p>';
	die();
}


$userID = $_GET['user_id'];

$sql = "UPDATE users SET blockstatus ='0' WHERE id='$userID'";
if ($connection->query($sql) === TRUE) {
	header('Location: account.php');
} else {
	echo "Error: " . $sql . "<br>" . $connection->error;
	die();
}