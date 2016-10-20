<?php
session_start();
require_once("db.php");

class Register
{	
	public function ReceiveData($form)
	{
		if ( isset($_POST['submit']) ){
			$form = $_POST['arr'];
			$err = $this -> ValidData($form);
			$user = $this -> ExistingUser($form['email'], $form['login']);

			if(empty($err) && $user){
				$this -> RegisterDB($form);
				$_SESSION["email"] = $form['email'];
				$url = $_SESSION['url'].'home.php';				
				return header("Location: $url");				
			}else {
				return $form;
			}
	 	} else {
     		return false;
      	}
    }

    /*** validation form ***/

    public function ValidData($mas)
    {
    	if ( isset($_POST['submit']) ){

    		/*** checking for blank lines ***/

			$error = array();
			foreach ($mas as $key => $value) {
				if($value == NULL || $value == ""){
					$error[$key] = 1;
				}
			}

			/*** validation email ***/ 

			$email_validate = filter_var($mas['email'], FILTER_VALIDATE_EMAIL);
			if(empty($error['email']) && $email_validate){
				return $error;
			}else if(empty($error['email']) && ($email_validate == false)){
				$error['email'] = -1;
				return $error;
			}

			/*** validation date ***/

			if(preg_match("/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/", $mas['birthday'])){
				return $error;
			}else{ 
				$error['birthday'] = -1;
				return $error;
			}
		return $error;
		}
    }

    /*** record in the database ***/

	public function RegisterDB($form)
	{
		$email    = $form['email'];
		$login    = $form['login'];
		$name     = $form['name'];
		$password = $form['password'];
		$birthday = $form['birthday'];
		$country  = $form['country'];
		$checkbox = $form['checkbox'];

		$db = new dbConnect;
		$conn = $db -> connect();
		$insert_user = $conn->query("INSERT INTO user (email, login, name, password, birthday, country, checkbox) VALUES ('$email', '$login', '$name', '$password', '$birthday', '$country', '$checkbox')");
	}

	/*** check for existing users ***/

	public function ExistingUser($email, $login)
	{
		$db = new dbConnect;
		$conn = $db -> connect();
		$select_user = $conn->query("SELECT email, login FROM user WHERE email = '$email' or login = '$login'");
		$result = $select_user ->fetch_assoc();

		if($result['email'] == $email || $user['login'] == $login){
			echo "Такой юзер уже есть  <br />";
			return false;
		}else{
			return true;
		}
	}

	public function Country()
	{
		$db = new dbConnect;
		$conn = $db -> connect();
		$country = $conn->query("SELECT * FROM country");
		return $country;
	}
	
}
?>