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
		<title>Add new category</title>
		<script>
			function validateForm(){
				var categoryName = document.getElementById("categoryName").value;
				
				if (categoryName.indexOf("'")!=-1) {
					alert("Simbol ' is not allowed.");
					return false;
				}else if (categoryName == "") {
					alert("Please key in category name.");
					return false;
				}else  {
					return true;
				}
			}			
		</script>
	</head>
	<body>
		<h1><ins>Add Category Name</ins></h1>
		<br>
		<form method="POST">
			<table>
			<tr>
				<td>New Category Name:</td>
				<td><input id="categoryName" name="categoryname" size="30" type="text"></td>
				<td><p>*</p></td>
			</tr>
			
			<tr>
				<td><p>* Must put.</p></td>
			</tr>
			</table>
			</table>
		<button class="footer-button-1" onclick="return validateForm()" name="submit" value="Add" type="submit">Add Category</button>
		</form>


	</body>
</html>
<?php
	if(isset($_POST['submit'])){
		//Connect to database.
		require "includes/conn.php";
	
		//Get input values.	
		$categoryname = $_POST['categoryname'];
		
		$sqlSameName = "SELECT * FROM category WHERE classname = '$categoryname'";
		$rowSameName = mysqli_num_rows(mysqli_query($con,$sqlSameName));
		
		//If same name found.
		if($rowSameName > 0){
			echo 
			'<script language="javascript"> 
			window.alert("The category is already exist.")
			</script>'; 	
		}else {
			//Insert data.	
			$sql = "INSERT INTO category (classname) VALUES ('$categoryname')";
			mysqli_query($con, $sql);	
			echo 
			'<script language="javascript">
			window.alert("Sucess to add new category.")
			window.location.href="addCategory.php"
			</script>'; 	
		}
		
	}
	mysqli_close($con);
?>