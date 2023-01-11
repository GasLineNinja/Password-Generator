<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
	<div class="header">
		<h1>INFOST 385 Password Generator</h1>
	</div>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@1,800&family=Open+Sans&display=swap" rel="stylesheet">
	<style type="text/css">
		*{
			margin: auto;
			font-family: 'Open Sans', sans-serif;
		}
		body{
			background-color: lightgray;
		}
		h1{
			text-align: center;
		}
		.header{
			margin: auto;
			width: 100%;
			height: 50px;
			display: block;
			background-color: #ff8000;
			color: white;
		}
	 	.topnav-centered{
			width: 100%;
			height: 35px;
			display: block;
			background-color: #000000;
  			float: center;
  			text-align: center;
			color: white;
		}
		a:link{
			text-decoration: none;
			color: white;
		}
		a:visited{
			text-decoration: none;
			color: white;
		}
		a:hover{
			text-decoration: underline;
			color: blue;
		}
		a:active{
			text-decoration: none;
			color: blue;
		}
		div a{
			float: center;
			text-align: center;
  			padding: 14px 16px;
  			font-size: 17px;
		}
	</style>
</head>
<body>
<div class="topnav">
	<div class="topnav-centered">
		<a class="active" href="index.php">Sign Up/Login</a>
		<a href="generator.php">Pass Generator</a>
		<a href="view_pass.php">View Passwords</a>
		<a href="update_pass.php">Update Password</a>
		<a href="sign_out.php">Sign Out</a>
	</div>
</div>
</body>
</html>