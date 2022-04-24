<?php
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";
	
	//Get book title.
	$sqlBookTitle = "SELECT book_id, book_title FROM book ORDER BY book_title";
	$resultBookTitle = mysqli_query($con,$sqlBookTitle);
	
	//Get member name.
	$sqlMemberNameId = "SELECT member_id, firstname, lastname FROM member ORDER BY firstname, lastname";
	$resultMemberNameId = mysqli_query($con,$sqlMemberNameId);
		
	
echo "<head>";
require "menu1.php";
echo "</head>"; 
?>
<html>
	<head>
		<title>Add new book</title>
		<script>
			function validateForm(){
				var bookTitle = document.getElementById("bookTitle").value;
				var memberName = document.getElementById("memberName").value;
				var dueDate = document.getElementById("dueDate").value;
				
				if (bookTitle.indexOf("'")!=-1) {
					alert("Simbol ' is not allowed.");
					return false;
				}else if (bookTitle == "") {
					alert("Please select book title.");
					return false;
				}else if (memberName == "") {
					alert("Please select book borrower.");
					return false;
				}else if (dueDate == "") {
					alert("Please select duedate.");
					return false;
				}else  {
					return true;
				}
			}	
		</script>
	</head>
	<body>
		<h1><ins>Borrow Book</ins></h1>
		<form method="POST">
			<table>
			<tr>
				<td>Book Title:</td>
					<td><select id="bookTitle" name="booktitle">
					<option value="">Chose Book</option>
					<?php
					while($rowBookTitle=mysqli_fetch_array($resultBookTitle)):
					?>
						<option value='<?php echo $rowBookTitle[0]?>'><?php echo $rowBookTitle[1]?></option>
					<?php
						endwhile;
					?>
					</td>
					<td><p>*</p></td>
			</tr>
			<tr>
				<td>Borrower Name:</td>
					<td><select id="memberName" name="membername">
					<option value="">Chose Borrower</option>
					<?php
					while($rowMemberNameId=mysqli_fetch_array($resultMemberNameId)):
					?>
						<option value='<?php echo $rowMemberNameId[0]?>'><?php echo $rowMemberNameId[0],'  ', $rowMemberNameId[1], ' ', $rowMemberNameId[2]?></option>
					<?php
						endwhile;
					?>
					</td>
					<td><p>*</p></td>
			</tr>
			<tr>
				<td>Due date:</td>
				<td><input id="dueDate" name="duedate" type="date"></td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td><p>* Must put.</p></td>
			</tr>
		</table>
		<button class="footer-button-1" input onclick="return validateForm()" name="submit" value="Borrow" type="submit">Borrow</button> 

	</form>

	</body>
</html>
<?php
	if(isset($_POST['submit'])){
		
		//Connect to database.
		require "includes/conn.php";
		
		//Get input values.	
		$bookId = $_POST['booktitle'];
		$memberId = $_POST['membername'];
		
		$date = new DateTime("now", new DateTimeZone('Asia/Kuala_Lumpur') );
		$borrowDate = $date->format('Y-m-d H:i:s');
		$duedate = $_POST['duedate'];
		$borrowStatus = 'pending';
		
		//Insert data.	
		$sql = "INSERT INTO borrow(book_id, member_id, date_borrow, due_date, borrow_status) 
				VALUES ('$bookId','$memberId','$borrowDate','$duedate','$borrowStatus')";
		mysqli_query($con, $sql);	
		echo("<script language='javascript'>
		window.alert('Sucess to borrow book.');
		window.location.href='addBorrow.php';</script>");
		
	}
	mysqli_close($con);
?>