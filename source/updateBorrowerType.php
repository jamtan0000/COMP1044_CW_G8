<?php
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";
	
	//If user click edit button.
	if(isset($_GET['update'])){
		//Get data input.
		$type_id=$_GET['type_id'];
		$sql1 = "SELECT * FROM type 
				WHERE type_id='$type_id'";
		$result=mysqli_query($con,$sql1);
		$row=mysqli_fetch_array($result);
		$type_id=htmlspecialchars($row['type_id'],ENT_QUOTES);
		$borrowertype=htmlspecialchars($row['borrowertype'],ENT_QUOTES);

	echo "<head>";
	require "menu1.php";
	echo "</head>"; 
?>
<html>
	<head>
		<title>Update Borrower Type</title>
		<script>
			function validateForm(){
				var borrowertype = document.getElementById("borrowertype").value;
				
				if (borrowertype.indexOf("'")!=-1) {
					alert("Simbol ' is not allowed.");
					return false;
				}else if (borrowertype == "") {
					alert("Please key in borrower type name.");
					return false;
				}else  {
					return true;
				}
			}
		</script>
	</head>
	<body>
		<h1><ins>Update Borrower Type</ins><h1>
		<form method="POST">
		<table>
			<tr>
				<td>Type ID:</td> <td><b><?php print $type_id;?></b></td></tr>
				<tr><td><input name="typeid" type="hidden" size="50" value='<?php print $type_id;?>'></td>
			</tr>
			<tr>
				<td>Borrower Type:</td> 
				<td><input id="borrowertype" name="borrowertype" type="text" size="50" value='<?php print $borrowertype;?>'></td>
				<td><p>*</p></td>
			</tr>
			<tr><td>* Must put.</td></tr>
		</table>
		<button class="footer-button-1" name="edit" onclick="return validateForm()" type="submit" name="Update" value="Update">Update</button> 
		<button class="footer-button-2"formaction="borrowerTypeList.php">Back</button>
</form>

	</body>
</html>
<?php
	}
	
	if(isset($_POST['edit'])){
		//Get data.
		$type_id=$_POST['typeid'];
		$borrowertype=$_POST['borrowertype'];
		
		//Update data.	
		$sql = "UPDATE type SET borrowertype='$borrowertype' 
				WHERE type_id='$type_id'";
		mysqli_query($con, $sql);	
		echo("<script language='javascript'>
		window.alert('Borrower type update succesfully.');
		window.location.href='borrowerTypeList.php';</script>");
		
	}
	
	mysqli_close($con);
?>