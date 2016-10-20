<?php
session_start();
require_once("db.php");
require_once("routing.php");

class Autorization
{	
	public function ReceiveData($form)
	{
		if ( isset($_POST['submit']) ){
			$form = $_POST['arr'];
			$user = $this -> ExistingUser($form['password'], $form['email'], $form['login']);

			if((!empty($form['email']) || !empty($form['login'])) && $user && !empty($form['password'])){
				$url = $_SESSION['url'].'home.php';
			 	return header("Location: $url");					
			}else {
				echo "Data is entered incorrectly";
				return false;
			}
	 	} else {
     		return false;
      	}
    }

	/*** user database check ***/

	public function ExistingUser($password, $email = false, $login = false)
	{
		$db = new dbConnect;
		$conn = $db -> connect();
		$select_user = $conn->query("SELECT email, login, password FROM user WHERE email = '$email' or login = '$login' and password = '$password'");
		$result = $select_user ->fetch_assoc();
		if($result['email'] == $email || $result['login'] == $login){
			if($result['password'] == $password){
				$_SESSION["email"] = $result['email'];
				return true;
			}
		}else{
			return false;
		}
	}

	/*** exit ***/

	public function ExitUser()
	{
		unset($_SESSION["email"]);
		$url = $_SESSION['url'];
		return header("Location: $url");
	}

}
?>