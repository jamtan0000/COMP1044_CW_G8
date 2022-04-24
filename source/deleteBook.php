<?php 
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";

	//Get data.
	$book_id=$_POST['book_id'];

	//Delete data.
	$sql1="	DELETE FROM borrow 
			WHERE book_id='$book_id'";
	$sql2="	DELETE FROM book 
			WHERE book_id='$book_id'";
	$message="Book succesfully delete.";
	
	if(isset($_POST['deletedata'])){
		mysqli_query($con, $sql1);
		mysqli_query($con, $sql2);
		echo "<script type='text/javascript'>
		alert('$message');
		window.location.href='bookList.php';</script>";
		mysqli_close($con);
	}
?>
