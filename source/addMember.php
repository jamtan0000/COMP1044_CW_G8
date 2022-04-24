<?php	
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";
	
	//Get borrower type name.
	$sqlTypeName = "SELECT type_id, borrowertype FROM type ORDER BY borrowertype";
	$resultTypeName = mysqli_query($con,$sqlTypeName);
	
	echo "<head>";
	require "menu1.php";
	echo "</head>";
?>
<html>
	<head>
		<title>Add new member</title>
		<script>
			function validateForm(){
				var firstName = document.getElementById("firstName").value;
				var lastName = document.getElementById("lastName").value;
				var gender = document.getElementById("gender").value;
				var address = document.getElementById("address").value;
				var contact = document.getElementById("contact").value;
				var type = document.getElementById("type").value;
				var yearLevel = document.getElementById("yearLevel").value;
				
				if (firstName.indexOf("'")!=-1 || lastName.indexOf("'")!=-1 || address.indexOf("'")!=-1 || contact.indexOf("'")!=-1) {
					alert("Simbol ' is not allowed.");
					return false;
				}else if (firstName == "") {
					alert("Please key in your first name.");
					return false;
				}else if (lastName == "") {
					alert("Please key in your last name.");
					return false;
				}else if (gender == "") {
					alert("Please select your gender.");
					return false;
				}else if (address == "") {
					alert("Please key in your address.");
					return false;
				}else if (contact == "") {
					alert("Please key in your contact.");
					return false;
				}else if (type == "") {
					alert("Please select borrower type.");
					return false;
				}else if (yearLevel == "") {
					alert("Please select your year level.");
					return false;
				}else  {
					return true;
				}
			}	
		</script>
	</head>
	<body>
		<h1><ins>Add new member</ins></h1>
		<br>
		<form method="POST">
			<table>
			<tr>
				<td>First name:</td>
				<td><input id="firstName" name="firstname" size="30" type="text"></td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td>Last name:</td>
				<td><input id="lastName" name="lastname" size="30" type="text"></td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td>Gender:</td>
					<td><select id="gender" name="gender">
					<option value="">Chose Gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					</td>
					<td><p>*</p></td>
			</tr>
			<tr>
				<td>Address:</td>
				<td><input id="address" name="address" type="text"></td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td>Contact number:</td>
				<td><input id="contact" name="contact" type="text"></td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td>Borrower type:</td>
					<td><select id="type" name="type">
					<option value="">Chose Type</option>
					<?php
					while($rowTypeName=mysqli_fetch_array($resultTypeName)):
					?>
						<option value='<?php echo $rowTypeName[0]?>'><?php echo $rowTypeName[1]?></option>
					<?php
						endwhile;
					?>
					</td>
					<td><p>*</p></td>
			</tr>
			<tr>
				<td>Year level:</td>
					<td><select id="yearLevel" name="yearLevel">
					<option value="">Chose Year Level</option>
					<option value="Faculty">Faculty</option>
					<option value="First Year">First Year</option>
					<option value="Second Year">Second Year</option>
					<option value="Third Year">Third Year</option>
					<option value="Fourth Year">Fourth Year</option>
					</td>
					<td><p>*</p></td>
			</tr>
			<tr>
				<td><p>* Must put.</p></td>
			</tr>
			</table>
			<button class="footer-button-1" input onclick="return validateForm()" name="submit" value="Add" type="submit">Add Member</button> 

	</form>

	</body>
</html>
<?php
	if(isset($_POST['submit'])){
		
		//Connect to database.
		require "includes/conn.php";
	
		//Get input values.	
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$year_level = $_POST['yearLevel'];
		$typeId = $_POST['type'];
		
		//Set initial status as active.
		$status = 'Active';
		
		$sql = "INSERT INTO member (firstname, lastname, gender, address, contact, type_id, year_level, status)
				VALUES ('$firstname', '$lastname', '$gender', '$address', '$contact', '$typeId', '$year_level', '$status')";
				
		//Insert data.	
		mysqli_query($con, $sql);	
		echo("<script language='javascript'>
		window.alert('Sucess to add new member.');
		window.location.href='addMember.php';</script>");
		
	}
	mysqli_close($con);
?>