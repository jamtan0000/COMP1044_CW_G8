<?php
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";
	
	//If user click edit button.
	if(isset($_GET['update'])){
		//Get data input.
		$category_id=$_GET['category_id'];
		$sql1 = "SELECT * FROM category 
				WHERE category_id='$category_id'";
		$result=mysqli_query($con,$sql1);
		$row=mysqli_fetch_array($result);
		$category_id=htmlspecialchars($row['category_id'],ENT_QUOTES);
		$classname=htmlspecialchars($row['classname'],ENT_QUOTES);


	echo "<head>";
	require "menu1.php";
	echo "</head>"; 


?>
<html>
	<head>
		<title>Update Book</title>
		<script>
			function validateForm(){
				var category = document.getElementById("category").value;
				
				if (category.indexOf("'")!=-1) {
					alert("Simbol ' is not allowed.");
					return false;
				}else if (category == "") {
					alert("Please key in category name.");
					return false;
				}else  {
					return true;
				}
			}
		</script>
	</head>
	<body>
		<h1><ins>Update Category</ins><h1>
		<form method="POST">
		<table>
			<tr>
				<td>Category ID:</td> <td><b><?php print $category_id;?></b></td></tr>
				<tr><td><input name="categoryid" type="hidden" size="50" value='<?php print $category_id;?>'></td>
			</tr>
			<tr>
				<td>Category Name:</td> 
				<td><input id="category" name="category" type="text" size="50" value='<?php print $classname;?>'></td>
				<td><p>*</p></td>
			</tr>
			<tr><td>* Must put.</td></tr>
		</table>	
		<button class="footer-button-1" name="edit" onclick="return validateForm()" type="submit" name="Update" value="Update">Update Category</button> 
		<button class="footer-button-2" formaction="categoryList.php">Back</button>
</form>

	</body>
</html>
<?php
	}
	
	if(isset($_POST['edit'])){
		//Get data.
		$category_id=$_POST['categoryid'];
		$classname=$_POST['category'];
		
		//Update data.	
		$sql = "UPDATE category SET classname='$classname' 
				WHERE category_id='$category_id'";
		mysqli_query($con, $sql);	
		echo("<script language='javascript'>
		window.alert('Category update succesfully.');
		window.location.href='categoryList.php';</script>");
		
	}
	
	mysqli_close($con);
?>