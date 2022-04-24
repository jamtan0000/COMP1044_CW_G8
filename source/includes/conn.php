<?php
	// Variable to link to database
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "librarydb";

	// Conect to database.
	$con = new mysqli($servername,$username,$password,$db);
	if($con->connect_error){
		//If fail.
		die('Connection to database fail:'.$con->connect_error);
	}
?>