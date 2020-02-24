<?php
require 'config/config.php';

if(isset($_SESSION['username']))
{
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}
else 
{
	header("Location: register.php");
}

?>


<html>
<head>
	<title>Welcom to NYUnited</title>
	<!-- JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="assets/js/bootstrap.js"></script>

	<!-- CSS -->
	<link href="assets/css/fontawesome-free-5.12.1-web/css/all.css" rel="stylesheet"> <!--load all styles -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<div class="top_bar">
		<div class="logo">
			<a href="index.php">NYUnited!</a>
		</div>

		<nav>

			<a href="<?php echo $userLoggedIn?>">
				<?php echo $user['first_name']; ?>
			</a>

			<a href="index.php">
				<i class="fas fa-home"></i> <!-- uses solid style -->
			</a>
			<a href="#">
				<i class="far fa-comments"></i>
			</a>
			<a href="#">
				<i class="fas fa-user-cog"></i>
			</a>
			<a href="#">
				<i class="far fa-bell"></i>
			</a>
			<a href="#">
				<i class="fas fa-users"></i>
			</a>
			<a href="includes/handlers/logout.php">
				<i class="fas fa-sign-out-alt"></i>
			</a>
		</nav>
		
	</div>

	<div class="wrapper">
		
	<!--the closing div is on the index file-->