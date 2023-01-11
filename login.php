<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//using helper files
	require ('login_functions.php');
	require ('mysqli_connect.php');

	//chcking the login
	list ($check, $data) = check_login($dbc, $_POST['username'], $_POST['password']);

	//If everything is ok
	if ($check){

		//setting session data
		session_start();
		$_SESSION['username'] = $data['username'];

		$_SESSION['user_id'] = $data['user_id'];

		//storing HTTP_USER_AGENT
		$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

		//redirecting to pass generator page after login
		redirect_user('generator.php');
	}
	else{
		$errors = $data;
	}

	//close the database
	mysqli_close($dbc);
}

//creating the login form
$page_title = 'Login';
include("header.php");

//if there are any errors display them
if (isset($errors) && !empty($errors)){
	echo '<p><h1>Error!</h1></p>
		<p class="error">The following errors occured:<br/>';
	foreach ($errors as $message){
		echo "- $message<br/>\n";
	}
	echo "</p><p>Try again.</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style type="text/css">
		body{
			background: lightgrey;
		}
		.formheader{
			width: 950px;
			background-color: rgb(0,0,0,.6);
			margin: auto;
			color: #FFFFFF;
			padding: 10px 0px 10px 0px;
			text-align: center;
			border-radius: 15px 15px 0px 0px;
		}
		.mainform{
			background-color: rgb: (0,0,0,0.5);
			width: 950px;
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
			width: 600px;
		}
	</style>
</head>
<body>
	<div class="formheader"><h3>Please enter account information.</h3></div></br>
	<div class="mainform">
		<form action="login.php" method="post">
			<fieldset>
				<p><label>Username: <input type="text" name="username" value=""></label></p>
				<p><label>Password: <input type="password" name="password" value=""></label></p>
			</fieldset>
				<input type="submit" name="submit" value="Submit">
		</form>
	</div>
</body>
</html>