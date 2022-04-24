<?php
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";

	echo "<head>";
	require "menu1.php";
	echo "</head>"; 
?>
<html>
	<head>
		<title>Borrow List</title>
	</head>
	<script language="JavaScript" type="text/javascript">
		function checkDelete(){
			return confirm('Are you sure you want to delete this record?');
		}
	</script>
	<body>
		<h1><ins>Borrow List<ins></h1>
	<form action="borrowList.php" method="POST">
      <input class="searchbar" type="text" placeholder="Search any thing..." name="search">
      <button class="search-button" type="submit"><ion-icon name="search-circle-outline"></button>
    </form>
<?php
	// Making table.
	print "<table border='1'>";
	print "<tr>";
	print "<th>Borrow ID</th>";
	print "<th>Book Title</th>";
	print "<th>Borrower First Name</th>";
	print "<th>Borrower Last Name</th>";
	print "<th>Date Borrow</th>";
	print "<th>Due Date</th>";
	print "<th>Borrow Status</th>";
	print "<th>Date Return</th>";
	print "<th colspan='3'>      </th>";
	
	if(isset($_POST['search'])){
		$item=$_POST['search'];
		
		$sql=mysqli_query($con,"SELECT * FROM borrow JOIN member USING (member_id) JOIN book USING (book_id) 
								WHERE borrow_id LIKE '%$item%' OR book_title LIKE '%$item%' OR 
								firstname LIKE '%$item%' OR lastname LIKE '%$item%' OR 
								due_date LIKE '%$item%' OR borrow_status LIKE '%$item%' OR 
								date_return LIKE '%$item%' OR date_borrow LIKE '%$item%'
								ORDER BY book_title, firstname, lastname");
	}else{
		$sql=mysqli_query($con,"SELECT * FROM borrow JOIN member USING (member_id) JOIN book USING (book_id) ORDER BY book_title, firstname, lastname");
	}
	
	while($row=mysqli_fetch_array($sql)):
	$borrow_id=$row['borrow_id'];

	//Display data.
	print "<tr>";
	print "<td>".$row['borrow_id']."</td>";
	print "<td>".$row['book_title']."</td>";
	print "<td>".$row['firstname']."</td>";
	print "<td>".$row['lastname']."</td>";
	print "<td>".$row['date_borrow']."</td>";
	print "<td>".$row['due_date']."</td>";
	print "<td>".$row['borrow_status']."</td>";
	print "<td>".$row['date_return']."</td>";
	
?>
	<!--Creating button.-->
	<td>
		<form name="returnBook" action="bookReturn.php" method="POST">
			<input type="hidden" name="borrow_id" value="<?php echo $borrow_id; ?>"/>
			<input type="submit" name="returnBook" value="Return Book"/>
		</form>
	</td>
	<td>
		<form name="bookPending" action="bookPending.php" method="POST">
			<input type="hidden" name="borrow_id" value="<?php echo $borrow_id; ?>"/>
			<input type="submit" name="bookPending" value="Set to Pending"/>
		</form>
	</td>
	<td>
		<form name="deletedata" action="deleteBorrow.php" method="POST">
			<input type="hidden" name="borrow_id" value="<?php echo $borrow_id; ?>"/>
			<input type="submit" name="deletedata" value="Delete" onclick="return checkDelete();"/>
		</form>
	</td>
<?php
	echo "</tr>\n";
	endwhile;
	mysqli_free_result($sql);
	mysqli_close($con);
	?>
		</table>
		<!--Creating borrow book and menu button.-->
		<form method="POST">

				<button class="footer-button-1" formaction="addBorrow.php" type="submit" value="Borrow book">Borrow a Book</button> 

		</form>
	</body>
</html>