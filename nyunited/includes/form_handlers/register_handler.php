<?php
// Declaring variables to prevent errors
$fname = ""; //first name
$lname = ""; //last name
$em = ""; //email
$em2 = ""; //email 2
$password = ""; //password
$password2 = ""; // confirm password
$date = ""; // signup date
$error_array = array(); // hold any errory messages

if(isset($_POST['register_button']))
{
	//first name
	$fname = strip_tags($_POST['reg_fname']);  // remove html tags
	$fname = str_replace(' ', '', $fname);  // remove spaces
	$fname = ucfirst(strtolower($fname)); // Upper case the first letter only
	$_SESSION['reg_fname'] = $fname;   // Stores first name into seesion variable

	//last name
	$lname = strip_tags($_POST['reg_lname']);  // remove html tags
	$lname = str_replace(' ', '', $lname);  // remove spaces
	$lname = ucfirst(strtolower($lname)); // Upper case the first letter only
	$_SESSION['reg_lname'] = $lname;   // Stores last name into seesion variable

	//email
	$em = strip_tags($_POST['reg_email']);  // remove html tags
	$em = str_replace(' ', '', $em);  // remove spaces
	$em = ucfirst(strtolower($em)); // Upper case the first letter only
	$_SESSION['reg_email'] = $em;   // Stores email into seesion variable

	//email 2
	$em2 = strip_tags($_POST['reg_email2']);  // remove html tags
	$em2 = str_replace(' ', '', $em2);  // remove spaces
	$em2 = ucfirst(strtolower($em2)); // Upper case the first letter only
	$_SESSION['reg_email2'] = $em2;   // Stores email into seesion variable

	//Password
	$password = strip_tags($_POST['reg_password']);  // remove html tags

	//Password 2
	$password2 = strip_tags($_POST['reg_password2']);  // remove html tags

	$date = date("Y-m-d"); // gets the current date

	if($em == $em2){
		//check if email is correct
		if(filter_var($em, FILTER_VALIDATE_EMAIL)){
			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			// check if email exists
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$em'");

			// Count numbers of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0){
				array_push($error_array, "Email already in use<br>");
			}

		}else {
			array_push($error_array, "Invalid formate<br>");
		}



	}else{
		array_push($error_array, "email don't match<br>");
	}


	if(strlen($fname) > 25 || strlen($fname) < 2){
		array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
	}

	if(strlen($lname) > 25 || strlen($lname) < 2){
		array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
	}

	if($password != $password2){
		array_push($error_array, "Your passwords do not match<br>");
	}
	else{
		if(preg_match('/[^A-Za-z0-9]/', $password)){
			array_push($error_array, "Your password can only contain english characters or numbers<br>");
		}
	}

	if(strlen($password) > 30 || strlen($password) < 5)
	{
		array_push($error_array, "Your password must be between 5 and 30<br>");
	}

	if(empty($error_array))
	{
		$password = md5($password); //Encrypt password before sending to database 

		// Generate username by concatenating first name and last name 
		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE  username = '$username' ");

		$i = 0;
		//if username exists add number to username
		while(mysqli_num_rows($check_username_query) != 0)
		{
			$i++; 
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE  username = '$username'");
		}

		//Profile picture assignment
		$rand = rand(1, 2); //Random number between 1 and 2
		if($rand == 1)
		{
			$profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
		}  else if($rand == 2)
		{
			$profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
		}


		$query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

		array_push($error_array, "<span style = 'color: #14C800'> You're all set ! Go agead and login</span><br>");

		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
		

	}

}




?>