<?php 
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";

	//Get data.
	$borrow_id=$_POST['borrow_id'];

	//Delete data.
	$sql1="	DELETE FROM borrow 
			WHERE borrow_id='$borrow_id'";
	$message="Record succesfully delete.";
	
	if(isset($_POST['deletedata'])){
		mysqli_query($con, $sql1);
		echo "<script type='text/javascript'>
		alert('$message');
		window.location.href='borrowList.php';</script>";
		mysqli_close($con);
	}
?>
