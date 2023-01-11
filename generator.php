<?php

session_start();
$page_title = 'Generator';
include('header.php');

if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']))){

 	require ('login_functions.php');
 	echo '<p><h2>Please <a href="login.php">Login</a> to continue.</h2></p>';
}
else{
	
echo "<h3>You are currently logged in as {$_SESSION['username']}.</h3>";
	
$lowercase = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");

$uppercase = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

$special = array("!","@","#","$","%","^","&","*","(",")","?","-","_","+","=");

$characters = array_merge($lowercase, $uppercase, $special);

shuffle($characters);



//Checking if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	//connecting to database
	require('mysqli_connect.php');

	//Making an array to hold error messages
	$errors = array();
	
	$website = $_POST['website'];
	$passlen = $_POST['passlen'];
	$genpass = $_POST['genpass'];
	$count = 0;
	
	
	
	//checking for form information
	if(empty($_POST['website'])){
		$errors[] = 'You must enter a website.';
	}
	if(empty($_POST['passlen'])){
		$errors[] = 'You must enter a length for your password.';
	}
	else if($passlen < 8 || $passlen > 50){
		$errors[] =  'Invalid number for password length.';
	}
	
	else if(isset($_REQUEST['passlen'])){
		while($count < $passlen){
			$genpass[$count] = $characters[$count];
			$count++;
			}
	}
	

	//If nothing is worng make query
	if (empty($errors)){
		
		//$id = "SELECT user_id FROM users WHERE username='{$_SESSION['username']}' ";
		$id = $_SESSION['user_id'];
		
		$query = "INSERT INTO websites (website_name, site_pass, user_id) 
		VALUES ('$website','$genpass', '$id')";

		$result = @mysqli_query($dbc, $query);
		
		//If the query works relay message
		if ($result){

			echo "<p>The password for $website has been saved</p>";
			echo '<p>Click  <a href="view_pass.php">Here</a> to view passwords.</P>';
			
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
}?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
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
			width: 400px;
		}
	
	</style>
</head>
	<body>
		<div class="formheader"><h3>Welcome</h3></div></br>
			<div class="mainform">
				<form action="generator.php" method="post">
					<fieldset>
                        <p><label class="website">Enter Website URL:</label><input type="url" name="website" size="50" value="<?php if(isset($_REQUEST['website'])) echo $_REQUEST['website'];?>"></p>
						<p><label class="passlen">Enter length of password 8-50 characters: </label><input type="text" name="passlen" size="3" value="<?php //if(isset($_REQUEST['passlen'])) echo $_REQUEST['passlen'];?>"></p>
						<p><!--<label class="genpass">Generated Password: </label>--><input type="hidden" name="genpass" size="50" value="<?php if(isset($_REQUEST['passlen'])) foreach($genpass as $value){ echo "$value";}?>"></p>
					</fieldset>
						<input type="submit" name="generate" value="generate">
				</form>
			</div>
	</body>
</html>