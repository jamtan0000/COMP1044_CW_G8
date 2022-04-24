<?php 
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";

	//Get data.
	$member_id=$_POST['member_id'];

	//Delete data.
	$sql1="	DELETE FROM borrow 
			WHERE member_id='$member_id'";
	$sql2="	DELETE FROM member 
			WHERE member_id='$member_id'";
	$message="Record succesfully delete.";
	if(isset($_POST['deletedata'])){
		mysqli_query($con, $sql1);
		mysqli_query($con, $sql2);
		echo "<script type='text/javascript'>
		alert('$message');
		window.location.href='memberList.php';</script>";
		mysqli_close($con);
	}
?>
