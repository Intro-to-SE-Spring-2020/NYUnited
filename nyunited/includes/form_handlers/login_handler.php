<?php 

if(isset($_POST['login_button']))
{
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); // Sanitize email (correct form)
	$_SESSION['log_email'] = $email;  // Stores email into session variable
	$password = md5($_POST['log_password']); // Get password

	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password = '$password' ");
	$check_login_query = mysqli_num_rows($check_database_query);

	if ($check_login_query == 1)
	{
		$row = mysqli_fetch_array($check_database_query); // stores the row value as an array
		$username = $row['username'];  // access the value username in the array row

		$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND user_closed='yes'");
		if (mysqli_num_rows($user_closed_query) == 1)
		{
			$reopen_account = mysqli_query($con, "UPDATE users SET user_closed = 'no' WHERE email = '$email'");
		}

		$_SESSION['username'] = $username;
		header("Location: index.php");  //redirect to index page
		exit();
	} else
	{
		array_push($error_array, "Email or password is not correct<br>");
	}
}

 ?>