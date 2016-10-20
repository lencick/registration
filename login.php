<?php 
	session_start(); 
	require_once("authorization.php");
	$obj = new Autorization;
	$form = $obj -> ReceiveData($_POST['arr']);	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>login</title>
	<link rel="stylesheet" href="all.css">
</head>
<body>
	<div>
		<a href="<?=($_SESSION['url']);?>">Register</a>
	</div>
	<h2>Login</h2>
	<p>You can log in via the login name or email</p>
	<form action="" method="POST">
		<label for="email">Email:
			<input type="text" id="email" name="arr[email]" placeholder="Email" value="<?=$form['email'];?>">
		</label>
		<label for="login">Login:
			<input type="text" id="login" name="arr[login]" placeholder="Login" value="<?=$form['login'];?>">
		</label>
		<label for="password">Password:
			<input type="password" id="password" name="arr[password]" >
		</label>
		<input type="submit" id="submit" name = "submit" value="Login">
	</form>
</body>
</html>