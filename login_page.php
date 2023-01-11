<?php


$page_title = 'Login';
include("header.php");

if (isset($errors) && !empty($errors)){
	echo '<p><h1>Error!</h1></p>
		<p class="error">The following errors occured:<br/>';
	foreach ($errors as $message){
		echo "- $message<br/>\n</p>";
	}
	echo "<p>Try again.</p>";
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<h3>Please enter account information.</h3>
	<style type="text/css">
		body{
			background: lightgrey;
		}
		form{
			width: 20%;
			display: inline-block;
		}
	</style>
</head>
<body>
<form action="login.php" method="post">
	<fieldset>
		<p><label>Username: <input type="text" name="username" value=""></label></p>
		<p><label>Password: <input type="password" name="password" value=""></label></p>
	</fieldset>
	<input type="submit" name="submit" value="Submit">
</form>
</body>
</html>