<?php
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";
	
	//Get data input.
	$borrow_id=$_POST['borrow_id'];
		
	//Update data.	
	$sql = "UPDATE borrow SET borrow_status='pending',date_return=NULL WHERE borrow_id = '$borrow_id'";
	$message="Book pending.";
	
	//If user click Set to Pending button.
	if(isset($_POST['bookPending'])){
		mysqli_query($con, $sql);		
		echo "<script type='text/javascript'>
		alert('$message');
		window.location.href='borrowList.php';</script>";
		mysqli_close($con);
	}
?>