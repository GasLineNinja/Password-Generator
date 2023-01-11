<?php

session_start();

$page_title = 'Update Password';
include("header.php");
include("mysqli_connect.php");

$username = $_POST['username'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

if (!empty($pass1) && !empty($pass2)){

	if ($pass1 != $pass2){
		echo "<p>Passwords do not match.</p>";
	}
	else{

		$query = "UPDATE `users` SET `password`= SHA2('$pass1',256) WHERE `username`='$username'";

		$result = @mysqli_query($dbc, $query);

		if ($result) {
			echo "Your password has been updated.";
		}
		else{
			echo "There was an error ".mysqli_error($dbc);
		}
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Update Password</title>
	
	<style type="text/css">
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
<?php

if (isset($_SESSION['username'])){
	echo '<div class="formheader"><h2>Please fill out the form below to update your password.</h2></div>';
	echo 
		'<div class="mainform">
		<form action="update_pass.php" method="post">
		<fieldset>
			<p><label>Username: <input type="text" name="username" value=""></label></p>
			<p><label>New Password: <input type="password" name="pass1"></label></p>
			<p><label>Confrim Password: <input type="password" name="pass2" value=""></label></p>
		</fieldset>
		<input type="submit" name="submit" value="Submit">
	</form>
	</div>';
}
else{
	echo '<p><h2>Please <a href="login.php">Login</a> to continue.</h2></p>';
}
?>
</body>
</html>