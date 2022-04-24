<?php
	session_start();
	// If user come here without login, this will sent him to login page.
	if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
		header("location:login.php");
		exit;
	}
	// Destroy session.
	session_unset();
	Session_destroy();
	header ('location:login.php');
?>