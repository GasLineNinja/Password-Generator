<?php

$page_title = 'Sign Up';
include("header.php");

//Checking if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//connecting to the database
	require ('mysqli_connect.php');

	//Making an array to hold error messages
	$errors = array();

	//checking for form information
	if (empty($_POST['username'])){
		$errors[] = ' You must enter a username.';
	}
	else{
		$username = mysqli_real_escape_string($dbc,trim($_POST['username']));
	}

	//Making sure passwords match
	if (!empty($_POST['pass1'])){
		if ($_POST['pass1'] != $_POST['pass2']){
			$errors[] = 'Your passwords do not match.';
		}
		else{
			$password = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	}
	else{
		$errors[] = 'You need to enter a pasword.';
	}

	//If nothing is worng make query
	if (empty($errors)){

		$query = "INSERT INTO users (username, password) 
		VALUES ('$username', SHA2('$password',256))";

		$result = @mysqli_query($dbc, $query);

		//If the query works relay message
		if ($result){

			echo "<p>Thank you $username you are now signed up!</p>";
			echo '<p>Please <a href="login.php">Login</a> to continue.</P>';
			
		}

		//Otherwise list errors
		else{
			echo "There was an error. ";
			echo mysqli_error($dbc);
		}
		mysqli_close($dbc);

		exit();
	}
	else{

		echo "There were errors.";
		foreach($errors as $message){
			echo "$message";
		}
		echo "Try again";
	}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>385 Final Project</title>
	<style type="text/css">
		body{
			background: lightgrey;
		}
		.formheader{
			width: 800px;
			background-color: rgb(0,0,0,.6);
			margin: auto;
			color: #FFFFFF;
			padding: 10px 0px 10px 0px;
			text-align: center;
			border-radius: 15px 15px 0px 0px;
		}
		.mainform{
			background-color: rgb: (0,0,0,0.5);
			width: 800px;
			margin: auto;
			text-align: left;
		}
		form{
			font-size: 20px;
		}
		label, input{
			display: inline-block;
		}
		label{
			width: 300px;
		}
		.users{
			font-style: oblique;
			font-weight: 700;
		}
	</style>
</head>
<body>
	<div class="formheader"><h3>Please create an account or <a href="login.php">Login</a></h3></div>
	<div class="mainform">
		<form action="index.php" method="post">
			<fieldset>
				<p><label class="username">Username:   </label><input type="text" name="username" size="28" value="<?php if(isset( $_REQUEST['username'])) echo $_REQUEST['username'];?>"></p>
				<p><label class="password">Password:   </label><input type="password" name="pass1" size ="28" value="<?php if(isset($_REQUEST['password'])) echo $_REQUEST['password'];?>"></p>
				<p><label class="cpassword">Confirm Password:   </label><input type="password" name="pass2" size="28" value=""></p>
				
			</fieldset>
				<input type="submit" name="submit" value="Submit">
		</form>
	</div>
	<div class="users">
	</div>
	</body>
	</html>