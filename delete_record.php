<?php

include('assets/db/database.php');

if(!isset($_SESSION["username"])){
	echo '<p style="color: #C60000;font-size: 14pt;font-weight: 500;">Access Denied: Please <a href="login.php">sign in!</a></p>';
	die();
}



$loggedInUserID = $_SESSION["loggedInUserID"];

$recordID = $_GET['id'];


	
$sql = "DELETE FROM tblcandidate WHERE id='$recordID'";
if ($connection->query($sql) === TRUE) {
	header('Location: record.php');
} else {
	$message = "Error: " . $sql . "<br>" . $connection->error;
}