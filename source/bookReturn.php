<?php
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";
	
	//Get data input.
	$borrow_id=$_POST['borrow_id'];
		
	//Update data.	
	$sql = "UPDATE borrow SET borrow_status='returned', date_return=CURRENT_TIMESTAMP() WHERE borrow_id = '$borrow_id'";
	$message="Book return.";
	
	//If user click Return Book button.
	if(isset($_POST['returnBook'])){
		mysqli_query($con, $sql);	
		echo "<script type='text/javascript'>
		alert('$message');
		window.location.href='borrowList.php';</script>";
		mysqli_close($con);
	}
?>