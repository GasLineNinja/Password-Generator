<?php

session_start();
$page_title = 'View Passwords';
include('header.php');

if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']))){

 	require ('login_functions.php');
 	echo '<p><h2>Please <a href="login.php">Login</a> to continue.</h2></p>';
}
else{
//heading for users page
	echo "<h1>Saved Passwords</h1>";

	//connection to database
	require ('mysqli_connect.php');

	$id = $_SESSION['user_id'];

	$query = "SELECT website_name AS website, site_pass AS password FROM websites WHERE user_id=$id ORDER BY website_name ASC";

	$result = @mysqli_query($dbc, $query);

	$numRows = mysqli_num_rows($result);

	if ($numRows > 0){
		echo "<p align='center'>There are $numRows saved passwords.</p>";

		echo '<table align="center" cellspacing="2" cellpadding="2" width="20%">
			<tr>
				<td align="left"><b>Website</b></td>
				<td align="left"><b>Password</b></td>
			</tr>';

		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo '<tr>
					<td align="left">' . $row['website'] . '</td>
					<td align="left">' . $row['password'] . '</td>
				</tr>';
		}
		echo '</table><br/>';

		mysqli_free_result($result);

	 }
	 else{
		echo '<p class="error">There are no registered passwords.</p>';
	 }

	 mysqli_close($dbc);
}?>
