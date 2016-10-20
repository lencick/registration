<?php

class dbConnect
{	
	public function connect()
	{
		$db = new mysqli('127.0.0.1', 'root', '', 'test');
		if ($db->connect_error) {
    		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
		}
		return $db;
	}
}
	
?>