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
		<title>Add New Borrower Type</title>
		<script>
			function validateForm(){
				var typeName = document.getElementById("typeName").value;
				
				if (typeName.indexOf("'")!=-1) {
					alert("Simbol ' is not allowed.");
					return false;
				}else if (typeName == "") {
					alert("Please key in type name.");
					return false;
				}else  {
					return true;
				}
			}			
		</script>
	</head>
	<body>
		<h1><ins>Add Borrower Type</ins></h1>
		<br>
		<form method="POST">
			<table>
			<tr>
				<td>New Borrower Type:</td>
				<td><input id="typeName" name="typename" size="30" type="text"></td>
				<td><p>*</p></td>
			</tr>
			
			<tr>
				<td><p>* Must put.</p></td>
			</tr>

			</table>
			<button class="footer-button-1" input onclick="return validateForm()" name="submit" value="Add" type="submit">Add Borrower type</button> 
	</form>

	</body>
</html>
<?php
	if(isset($_POST['submit'])){
		
		//Connect to database.
		require "includes/conn.php";
	
		//Get input values.	
		$typename = $_POST['typename'];
		
		$sqlSameName = "SELECT * FROM type WHERE borrowertype = '$typename'";
		$rowSameName = mysqli_num_rows(mysqli_query($con,$sqlSameName));
		
		//If same name found.
		if($rowSameName > 0){
			echo '<script type="text/javascript"> 
			window.alert("The type is already exist.")    		
			</script>'; 	
		}else{
			//Insert data.	
			$sql = "INSERT INTO type(borrowertype) VALUES ('$typename')";
			mysqli_query($con, $sql);	
			echo '<script type="text/javascript">
			window.alert("Sucess to add new borrower type.")
			window.location.href="addBorrowerType.php"
			</script>'; 	
		}
		
	}
	mysqli_close($con);
?>