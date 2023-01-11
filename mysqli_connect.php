<?php
//DEFINE ('DB_HOST','localhost');
//DEFINE ('DB_USER','mdstrand_mdstrand');
//DEFINE ('DB_PASSWORD','Killianismyboy80');
//DEFINE ('DB_NAME','mdstrand_385_final');

//$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
//OR die('Connection failed to server with error: ' .mysqli_connect_error());

$dbc = mysqli_connect("localhost","mdstrand_mdstrand","Killianismyboy80","mdstrand_385_final");

if(mysqli_connect_errno()){
	echo "Connection failed to server with error: " .mysqli_connect_error();
	exit();
}
?>
