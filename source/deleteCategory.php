<?php 
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";

	//Get data.
	$category_id=$_POST['category_id'];

	//Delete data.
	$sql1="	SELECT borrow_id FROM borrow JOIN book USING (book_id) 
			WHERE category_id = '$category_id'";
	$sql2="	DELETE FROM book 
			WHERE category_id='$category_id'";
	$sql3="	DELETE FROM category 
			WHERE category_id='$category_id'";
	$message="Category succesfully delete.";
		
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
		window.location.href='categoryList.php';</script>";
		mysqli_close($con);
	}
?>
