<?php

//$mysql = mysqli_connect("localhost", "nottscal", "hacknotts", "nottscal");

try
{
	$server = "localhost";
	$username = "nottscal";
	$password = "hacknotts";
	$dbname = "nottscal";

	$db = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) 
{
    die( 'ERROR - could not connect to database :-(	: ' . $e->getMessage() );
}


?>