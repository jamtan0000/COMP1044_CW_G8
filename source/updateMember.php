<?php
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";
	
	//If user click edit button.
	if(isset($_GET['editdata'])){
		//Get data input.
		$member_id=$_GET['member_id'];
		$sql1 = "SELECT * FROM member 
				JOIN type USING (type_id)
				WHERE member_id='$member_id'";
		$result=mysqli_query($con,$sql1);
		$row=mysqli_fetch_array($result);
		$member_id=htmlspecialchars($row['member_id'],ENT_QUOTES);
		$firstname=htmlspecialchars($row['firstname'],ENT_QUOTES);
		$lastname=htmlspecialchars($row['lastname'],ENT_QUOTES);
		$gender=htmlspecialchars($row['gender'],ENT_QUOTES);
		$address=htmlspecialchars($row['address'],ENT_QUOTES);
		$contact=htmlspecialchars($row['contact'],ENT_QUOTES);
		$borrowertype=htmlspecialchars($row['borrowertype'],ENT_QUOTES);
		$borrowertypeid=htmlspecialchars($row['type_id'],ENT_QUOTES);
		$year_level=htmlspecialchars($row['year_level'],ENT_QUOTES);
		$status=htmlspecialchars($row['status'],ENT_QUOTES);
		
		
		//Get borrower type name.
		$sqlTypeName = "SELECT type_id, borrowertype FROM type WHERE type_id!=$borrowertypeid ORDER BY borrowertype";
		$resultTypeName = mysqli_query($con,$sqlTypeName);

			echo "<head>";
			require "menu1.php";
			echo "</head>";
?>
<html>
	<head>
		<title>Update member data</title>
		<script>
			function validateForm(){
				var firstName = document.getElementById("firstName").value;
				var lastName = document.getElementById("lastName").value;
				var gender = document.getElementById("gender").value;
				var address = document.getElementById("address").value;
				var contact = document.getElementById("contact").value;
				var borrowerType = document.getElementById("borrowerType").value;
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
				}else if (borrowerType == "") {
					alert("Please select user type.");
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
		<h1><ins>Update member data</ins><h1>
		<form method="POST">
		<table>
			<tr><td>Member ID:</td> <td><b><?php print $member_id;?></b></td></tr>
			<tr><td><input id="memberId" type="hidden" name="memberid" value='<?php print $member_id;?>'></td>
			</tr>
			<tr><td>First Name:</td> 
				<td><input id="firstName" name="firstname" type="text" value='<?php print $firstname;?>'>*</td>
			</tr>
			<tr><td>Last Name:</td> 
				<td><input id="lastName" name="lastname" type="text" value='<?php print $lastname;?>'>*</td>
			</tr>
			<tr>
				<td>Gender:</td>
					<td><select id="gender" name="gender">
					<option value="<?php print $gender;?>"><?php print $gender;?></option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					</td>
			</tr>
			<tr><td>Address:</td> 
				<td><input id="address" name="address" type="text" value='<?php print $address;?>'>*</td>
			</tr>
			<tr><td>Contact:</td> 
				<td><input id="contact" name="contact" type="text" value='<?php print $contact;?>'>*</td>
			</tr>
			<tr>
				<td>Borrower Type:</td>
					<td><select id="borrowerType" name="borrowertype">
					<option value="<?php print $borrowertypeid;?>"><?php print $borrowertype;?></option>
					<?php
					while($rowTypeName=mysqli_fetch_array($resultTypeName)):
					?>
						<option value='<?php echo $rowTypeName[0]?>'><?php echo $rowTypeName[1]?></option>
					<?php
						endwhile;
					?>
					</td>
			</tr>
			<tr>
				<td>Year level:</td>
					<td><select id="yearLevel" name="yearLevel">
					<option value="<?php print $year_level;?>"><?php print $year_level;?></option>
					<option value="Faculty">Faculty</option>
					<option value="First Year">First Year</option>
					<option value="Second Year">Second Year</option>
					<option value="Third Year">Third Year</option>
					<option value="Fourth Year">Fourth Year</option>
					</td>
			</tr>
			<tr>
				<td>Status:</td>
					<td><select id="status" name="status">
					<option value="<?php print $status;?>"><?php print $status;?></option>
					<option value="Active">Active</option>
					<option value="Banned">Banned</option>
					</td>
			</tr>
			<tr><td>* Must put.</td></tr>
		</table>	
		<button class="footer-button-1" name="edit" onclick="return validateForm()" type="submit" name="Update" value="Update">Update</button> 
		<button class="footer-button-2" formaction="memberList.php">Back</button>

</form>

	</body>
</html>
<?php
	}
	
	if(isset($_POST['edit'])){
		//Get data.
		$member_id=$_POST['memberid'];
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$gender=$_POST['gender'];
		$address=$_POST['address'];
		$contact=$_POST['contact'];
		$TypeId=$_POST['borrowertype'];
		$yearLevel=$_POST['yearLevel'];
		$status=$_POST['status'];			
		
		//Update data.	
		$sql2 = "UPDATE member SET firstname='$firstname', lastname='$lastname', gender='$gender', 
				address='$address', contact='$contact', type_id='$TypeId',
				year_level='$yearLevel', status='$status' 
				WHERE member_id='$member_id'";
		mysqli_query($con, $sql2);	
		echo("<script language='javascript'>
		window.alert('Member update succesfully.');
		window.location.href='memberList.php';</script>");
		
	}
	
	mysqli_close($con);
?>