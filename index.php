<?php 
	session_start(); 
	require_once("registration.php");
	require_once("routing.php");
	if (isset($_SESSION["email"])) {
		$url = $_SESSION['url'].'home.php';
		header("Location: $url");
    die;
	}
	$rout = new Routing;
	$url = $rout -> request_url();
	$_SESSION['url'] = $url;
	$obj = new Register;
	$form = $obj -> ReceiveData($_POST['arr']);
	$err = $obj -> ValidData($_POST['arr']);
	$country = $obj -> Country();
	$log = $_SESSION['url']."login.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration</title>
	<link rel="stylesheet" href="all.css">
</head>
<body>
	<div>
		<a href="<?=$log;?>">Login</a>
	</div>
	<h2>Registration</h2>
	<form action="" method="POST">
		<label for="email">Email:
			<input type="text" id="email" name="arr[email]" placeholder="Email" value="<?=$form['email'];?>">
			<?php if($err['email'] == -1) { echo "<br />не правильная почта <br />"; } 
			else if(isset($err['email'])) {echo "<br />заполните все поля <br />"; } ?>
		</label>
		<label for="login">Login:
			<input type="text" id="login" name="arr[login]" placeholder="Login" value="<?=$form['login'];?>">
			<?php if(isset($err['login'])) {echo "<br />заполните все поля <br />";	} ?>
		</label>
		<label for="name">Real Name:
			<input type="text" id="name" name="arr[name]" placeholder="Name" value="<?=$form['name'];?>">
			<?php if(isset($err['name'])) {echo "<br />заполните все поля <br />";	} ?>
		</label>
		<label for="password">Password:
			<input type="password" id="password" name="arr[password]" >
			<?php if(isset($err['password'])) {echo "<br />заполните все поля <br />";	} ?>
		</label>
		<label for="birthday">Birthday:
			<input type="date" id="birthday" name="arr[birthday]" placeholder="Y-M-D" value="<?=$form['birthday'];?>">
			<?php if($err['birthday'] == -1) { echo "<br />enter the wrong date format (Y-M-D) <br /> <br />"; } 
			else if(isset($err['birthday'])) {echo "<br />заполните все поля <br />";	} ?>
		</label>
		<label for="country">Choose the country:
			<select name="arr[country]">
	    		<option disabled >Country</option>
	    		<?php while ( $coun = $country ->fetch_assoc()) {
	    			echo "<option value='". $coun['country'] . "'> " . $coun['country'] .  "</option>";
	    		} ?>
	   		</select>
	   	</label>	
		<label for="checkbox">
			<?php if(($form['checkbox']) != NULL): ?>
			<input type="checkbox" id="checkbox" name="arr[checkbox]" value="yes" checked>
			agree with terms and conditions
			<?php elseif(isset($_POST["submit"])): ?>
			<?php echo "<br />поставьте галочку <br />"; ?>
			<input type="checkbox" id="checkbox" name="arr[checkbox]" value="yes">
			agree with terms and conditions
			<?php else: ?>
			<input type="checkbox" id="checkbox" name="arr[checkbox]" value="yes">
			agree with terms and conditions
			<?php endif ?>
		</label>
		<input type="submit" id="submit" name = "submit" value="Registration">
	</form>
</body>
</html>