<?php

//access the session
session_start();
$page_title = 'Sign Out';
include('header.php');
//if no session redirect user
if (!isset($_SESSION['username'])){

	require ("login_functions.php");
	echo '<p><h2>You are currently logged out.<br/>Please <a href="login.php">Login</a> to continue.</p></h2>';
}
else{

	//clear variable
	$_SESSION = array();
	//destroy the session
	session_destroy();

//printing log out message
echo "<p><h2>You have been logged out!</h2></p>";
}

?>
