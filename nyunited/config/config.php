<?php 
ob_start(); // Turns on output buffering
session_start(); // store the variables inside their sessions

$timezone = date_default_timezone_set("America/Chicago"); 

// connection to the database
$con = mysqli_connect("localhost", "root", "", "social");

if(mysqli_connect_errno())
 {
	echo "Failed to connect: " . mysqli_connect_errno();
}


?>