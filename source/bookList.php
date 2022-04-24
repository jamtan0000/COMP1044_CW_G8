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
		<title>Book List</title>


	</head>
	<script language="JavaScript" type="text/javascript">
		function checkDelete(){
			return confirm('Please be informend that the relevent data in borrow list will also be deleted. Are you sure you want to delete this book?');
		}
	</script>
	<body>

		<h1><ins>Book List<ins></h1>

	<div class="search">
	<form action="bookList.php" method="POST">
		<input class="searchbar" type="text" placeholder="Search any thing..." name="search">
		<button class="search-button" type="submit" size="large"><ion-icon name="search-circle-outline"></ion-icon></button>
	</form>
</div>

<?php
	// Making table.
	print "<table border='1'>";
	print "<tr>";
	print "<th>Book ID</th>";
	print "<th>Book Title</th>";
	print "<th>Category</th>";
	print "<th>Author</th>";
	print "<th>Book Copies</th>";
	print "<th>Book Pub</th>";
	print "<th>Publisher Name</th>";
	print "<th>ISBN</th>";
	print "<th>Copyright Year</th>";
	print "<th>Date Recieve</th>";
	print "<th>Date Added</th>";
	print "<th>Status</th>";
	print "<th colspan='2'>      </th>";
	
	if(isset($_POST['search'])){
		$item=$_POST['search'];
		
		$sql=mysqli_query($con,"SELECT * FROM book JOIN category USING (category_id)
								WHERE book_id LIKE '%$item%' OR book_title LIKE '%$item%' OR 
								classname LIKE '%$item%' OR author LIKE '%$item%' OR 
								book_copies LIKE '%$item%' OR book_pub LIKE '%$item%' OR 
								publisher_name LIKE '%$item%' OR isbn LIKE '%$item%' OR 
								copyright_year LIKE '%$item%' OR date_receive LIKE '%$item%' OR 
								date_added LIKE '%$item%' OR status LIKE '%$item%'
								ORDER BY book_title, classname");
	}else{
		$sql=mysqli_query($con,"SELECT * FROM book JOIN category USING (category_id) ORDER BY book_title, classname");
	}
	
	while($row=mysqli_fetch_array($sql)):
	$book_id=$row['book_id'];

	//Display data.
	print "<tr>";
	print "<td>".$row['book_id']."</td>";
	print "<td>".$row['book_title']."</td>";
	print "<td>".$row['classname']."</td>";
	print "<td>".$row['author']."</td>";
	print "<td>".$row['book_copies']."</td>";
	print "<td>".$row['book_pub']."</td>";
	print "<td>".$row['publisher_name']."</td>";
	print "<td>".$row['isbn']."</td>";
	print "<td>".$row['copyright_year']."</td>";
	print "<td>".$row['date_receive']."</td>";
	print "<td>".$row['date_added']."</td>";
	print "<td>".$row['status']."</td>";
	
?>
	<!--Creating button.-->
	<td>
		<form name="editdata" action="updateBook.php" method="GET">
			<input type="hidden" name="book_id" value="<?php echo $book_id; ?>"/>
			<input type="submit" name="update" value="Edit"/>
		</form>
	</td>
	<td>
		<form name="deletedata" action="deleteBook.php" method="POST">
			<input type="hidden" name="book_id" value="<?php echo $book_id; ?>"/>
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
		<!--Creating add book and menu button.-->
		<form method="POST">
			
					<button class="footer-button-1" formaction="addBook.php" type="submit" value="Add book">Add Book</button> 
		</form>
	</body>
</html>