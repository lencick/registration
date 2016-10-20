<?php 
	session_start(); 
	if ($_SESSION["email"] == false) {
    	$url = $_SESSION['url'];
		header("Location: $url");
    die;
	}
	require_once("authorization.php");	
	if($_POST['exit']){
		$obj = new Autorization;
		$form = $obj -> ExitUser();
	}		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration</title>
	<link rel="stylesheet" href="all.css">
</head>
<body>
	<h2>Home</h2>	
	<div>
		<p>Welcome, Your mail: <?=($_SESSION["email"]);?></p>
	<form action="" method="POST">
		<input type="submit" id="submit" name = "exit" value="Exit">
	</form>
	</div>
</body>
</html>