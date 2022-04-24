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
		<title>Type</title>
	</head>
	<script language="JavaScript" type="text/javascript">
		function checkDelete(){
			return confirm('Please be informend that the relevent data in member list and borrow list will also be deleted. Are you sure you want to delete this book?');
		}
	</script>
	<body>
		<h1><ins>Borrower Type<ins></h1>
	<form action="borrowerTypeList.php" method="POST">
      <input class="searchbar" type="text" placeholder="Search any thing..." name="search">
      <button class="search-button" type="submit"><ion-icon name="search-circle-outline"></button>
    </form>
<?php
	// Making table.
	print "<table border='1'>";
	print "<tr>";
	print "<th>Type ID</th>";
	print "<th>Borrower Type</th>";
	print "<th colspan='2'>      </th>";
	
	if(isset($_POST['search'])){
		$item=$_POST['search'];
		
		$sql=mysqli_query($con,"SELECT * FROM type 
								WHERE type_id LIKE '%$item%' OR borrowertype LIKE '%$item%'
								ORDER BY borrowertype");
	}else{
		$sql=mysqli_query($con,"SELECT * FROM type ORDER BY borrowertype");
	}
	
	while($row=mysqli_fetch_array($sql)):
	$type_id=$row['type_id'];

	//Display data.
	print "<tr>";
	print "<td>".$row['type_id']."</td>";
	print "<td>".$row['borrowertype']."</td>";
	
?>
	<!--Creating button.-->
	<td>
		<form name="editdata" action="updateBorrowerType.php" method="GET">
			<input type="hidden" name="type_id" value="<?php echo $type_id; ?>"/>
			<input type="submit" name="update" value="Edit"/>
		</form>
	</td>
	<td>
		<form name="deletedata" action="deleteBorrowerType.php" method="POST">
			<input type="hidden" name="type_id" value="<?php echo $type_id; ?>"/>
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

					<button class="footer-button-1" formaction="addBorrowerType.php" type="submit" value="Add Borrower type">Add Borrower type</button> 

		</form> 
	</body>
</html>