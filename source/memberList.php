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
		<title>Member List</title>
	</head>
	<script language="JavaScript" type="text/javascript">
		function checkDelete(){
			return confirm('Please be informed that the data relevent to this member in borrow list will also deleted. Are you sure you want to delete this record?');
		}
	</script>
	<body>
		<h1><ins>Member List<ins></h1>
	<form action="memberList.php" method="POST">
      <input class="searchbar" type="text" placeholder="Search any thing..." name="search">
      <button class="search-button" type="submit"><ion-icon name="search-circle-outline"></button>
    </form>
<?php
	// Making table.
	print "<table border='1'>";
	print "<tr>";
	print "<th>Member ID</th>";
	print "<th>First Name</th>";
	print "<th>Last Name</th>";
	print "<th>Gender</th>";
	print "<th>Address</th>";
	print "<th>Contact</th>";
	print "<th>Member Type</th>";
	print "<th>Year Level</th>";
	print "<th>Status</th>";	
	print "<th colspan='2'>      </th>";

	if(isset($_POST['search'])){
		$item=$_POST['search'];
		
		$sql=mysqli_query($con,"SELECT * FROM member JOIN type USING (type_id) 
								WHERE member_id LIKE '%$item%' OR  
								firstname LIKE '%$item%' OR lastname LIKE '%$item%' OR 
								gender LIKE '%$item%' OR address LIKE '%$item%' OR 
								contact LIKE '%$item%' OR borrowertype LIKE '%$item%'OR 
								year_level LIKE '%$item%' OR status LIKE '%$item%'
								ORDER BY firstname, lastname, gender, address, contact, borrowertype, year_level, status");
	}else{
		$sql=mysqli_query($con,"SELECT * FROM member JOIN type USING (type_id) ORDER BY firstname, lastname, gender, address, contact, borrowertype, year_level, status");
	}
	
	while($row=mysqli_fetch_array($sql)):
	$member_id=$row['member_id'];

	//Display data.
	print "<tr>";
	print "<td>".$row['member_id']."</td>";
	print "<td>".$row['firstname']."</td>";
	print "<td>".$row['lastname']."</td>";
	print "<td>".$row['gender']."</td>";
	print "<td>".$row['address']."</td>";
	print "<td>".$row['contact']."</td>";
	print "<td>".$row['borrowertype']."</td>";
	print "<td>".$row['year_level']."</td>";
	print "<td>".$row['status']."</td>";
	
?>
	<!--Creating button.-->
	<td>
		<form name="editdata" action="updateMember.php" method="GET">
			<input type="hidden" name="member_id" value="<?php echo $member_id; ?>"/>
			<input type="submit" name="editdata" value="Edit"/>
		</form>
	</td>
	<td>
		<form name="deletedata" action="deleteMember.php" method="POST">
			<input type="hidden" name="member_id" value="<?php echo $member_id; ?>"/>
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
		<!--Creating add member and menu button.-->
		<form method="POST">

			<button class="footer-button-1" input formaction="addMember.php" type="submit" value="Add Member">Add Member</button> 

		</form>
	</body>
</html>