<?php 
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";

	//Get data.
	$type_id=$_POST['type_id'];

	//Delete data.
	$sql1="	SELECT borrow_id FROM borrow JOIN member USING (member_id) 
			WHERE type_id = '$type_id'";
	$sql2="	DELETE FROM member 
			WHERE type_id='$type_id'";
	$sql3="	DELETE FROM type 
			WHERE type_id='$type_id'";
	$message="Borrower type succesfully delete.";
		
	if(isset($_POST['deletedata'])){
		$releventBorrow = mysqli_query($con, $sql1);
		while($rowReleventBorrow = mysqli_fetch_array($releventBorrow)):
			$sqlDeleteBorrow="	DELETE FROM borrow WHERE borrow_id='$rowReleventBorrow[0]'";
			mysqli_query($con, $sqlDeleteBorrow);
		endwhile;
		mysqli_query($con, $sql2);
		mysqli_query($con, $sql3);
		echo "<script type='text/javascript'>
		alert('$message');
		window.location.href='borrowerTypeList.php';</script>";
		mysqli_close($con);
	}
?>
