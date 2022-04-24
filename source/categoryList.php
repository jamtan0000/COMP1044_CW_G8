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
		<title>Category</title>
	</head>
	<script language="JavaScript" type="text/javascript">
		function checkDelete(){
			return confirm('Please be informend that the relevent data in book list and borrow list will also be deleted. Are you sure you want to delete this book?');
		}
	</script>
	<body>
		<h1><ins>Category<ins></h1>
	<form action="categoryList.php" method="POST">
      <input class="searchbar" type="text" placeholder="Search any thing..." name="search">
      <button class="search-button" type="submit"><ion-icon name="search-circle-outline"></button>
    </form>
<?php
	// Making table.
	print "<table border='1'>";
	print "<tr>";
	print "<th>Category ID</th>";
	print "<th>Category Name</th>";
	print "<th colspan='2'>      </th>";
	
	if(isset($_POST['search'])){
		$item=$_POST['search'];
		
		$sql=mysqli_query($con,"SELECT * FROM category 
								WHERE category_id LIKE '%$item%' OR classname LIKE '%$item%'
								ORDER BY classname");
	}else{
		$sql=mysqli_query($con,"SELECT * FROM category ORDER BY classname");
	}
	
	while($row=mysqli_fetch_array($sql)):
	$category_id=$row['category_id'];

	//Display data.
	print "<tr>";
	print "<td>".$row['category_id']."</td>";
	print "<td>".$row['classname']."</td>";
	
?>
	<!--Creating button.-->
	<td>
		<form name="editdata" action="updateCategory.php" method="GET">
			<input type="hidden" name="category_id" value="<?php echo $category_id; ?>"/>
			<input type="submit" name="update" value="Edit"/>
		</form>
	</td>
	<td>
		<form name="deletedata" action="deleteCategory.php" method="POST">
			<input type="hidden" name="category_id" value="<?php echo $category_id; ?>"/>
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
		<!--Creating add category and menu button.-->
		<form method="POST">

			<button class="footer-button-1" formaction="addCategory.php" type="submit" value="Add Category">Add Category</button> 

		</form>
	</body>
</html>