<?php
	//Start session.
	require "includes/session.php";
	
	//Connect to database.
	require "includes/conn.php";
	
	//Get category type name.
	$sqlCategoryName = "SELECT category_id, classname FROM category ORDER BY classname";
	$resultCategoryName = mysqli_query($con,$sqlCategoryName);

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
				var category = document.getElementById("category").value;
				var author = document.getElementById("author").value;
				var bookCopies = document.getElementById("bookCopies").value;
				var bookPub = document.getElementById("bookPub").value;
				var publisherName = document.getElementById("publisherName").value;
				var isbn = document.getElementById("isbn").value;
				var copyrightYear = document.getElementById("copyrightYear").value;
				var dateReceive = document.getElementById("dateReceive").value;
				var status = document.getElementById("status").value;
				
				if (bookTitle.indexOf("'")!=-1 || author.indexOf("'")!=-1 || bookPub.indexOf("'")!=-1 || publisherName.indexOf("'")!=-1 || isbn.indexOf("'")!=-1) {
					alert("Simbol ' is not allowed.");
					return false;
				}else if (bookTitle == "") {
					alert("Please insert book title.");
					return false;
				}else if (category == "") {
					alert("Please select book category.");
					return false;
				}else if (author == "") {
					alert("Please insert book's author.");
					return false;
				}else if (bookCopies == "") {
					alert("Please insert number of book copies.");
					return false;
				}else if (bookCopies < 0) {
					alert("Please insert a postive integer for book copies.");
					return false;
				}else if (bookPub == "") {
					alert("Please insert book publication.");
					return false;
				}else if (publisherName == "") {
					alert("Please insert book publisher name.");
					return false;
				}else if (isbn == "") {
					alert("Please insert book ISBN.");
					return false;
				}else if (copyrightYear == "") {
					alert("Please insert copyright year.");
					return false;
				}else if (copyrightYear < 1901 || copyrightYear > 2155) {
					alert("Please insert copyright year between 1900 and 2099.");
					return false;
				}else if (dateReceive == "") {
					alert("Please insert date receive.");
					return false;
				}else if (status == "") {
					alert("Please select book status.");
					return false;
				}else {
					return true;
				}
			}	
		</script>
	</head>
	<body>
		<h1><ins>Add Book</ins></h1>
		<br>
		<form method="POST">
			<table>
			<tr>
				<td>Book Title:</td>
				<td><input id="bookTitle" name="booktitle" size="50" type="text"></td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td>Category:</td>
					<td><select id="category" name="category">
					<option value="">Chose Category</option>
					<?php
					while($rowCategoryName=mysqli_fetch_array($resultCategoryName)):
					?>
						<option value='<?php echo $rowCategoryName[0]?>'><?php echo $rowCategoryName[1]?></option>
					<?php
						endwhile;
					?>
					</td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td>Author:</td>
				<td><input id="author" name="author" size="50" type="text"></td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td>Book copies:</td>
				<td><input id="bookCopies" name="bookcopies" size="12" type="number" min="0" ></td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td>Book pub:</td>
				<td><input id="bookPub" name="bookpub" size="50" type="text"></td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td>Publisher name:</td>
				<td><input id="publisherName" name="publishername" size="50" type="text"></td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td>isbn:</td>
				<td><input id="isbn" name="isbn" size="50" type="text"></td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td>Copyright year:</td>
				<td><input id="copyrightYear" name="copyrightyear" size="4" type="number" min="1901" max="2155" step="1"></td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td>Date receive:</td>
				<td><input id="dateReceive" name="datereceive" type="date"></td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td>Status:</td>
					<td><select id="status" name="status">
					<option value="">Chose Status</option>
					<option value="New">New</option>
					<option value="Archive">Archive</option>
					<option value="Damage">Damage</option>
					<option value="Lost">Lost</option>
					<option value="Old">Old</option>
					</td>
				<td><p>*</p></td>
			</tr>
			<tr>
				<td><p>* Must put.</p></td>
			</tr>
				
			</table>
			<button class="footer-button-1" onclick="return validateForm()" name="submit" value="Add" type="submit">Add</button>
			<button class="footer-button-2"formaction="booklist.php">Back</button>
		</form>
	</body>
</html>
<?php
	if(isset($_POST['submit'])){
		
		//Connect to database.
		require "includes/conn.php";
		
		//Get input values.	
		$booktitle = $_POST['booktitle'];
		$categoryId = $_POST['category'];
		$author = $_POST['author'];
		$bookcopies = $_POST['bookcopies'];
		$bookpub = $_POST['bookpub'];
		$publishername = $_POST['publishername'];
		$isbn = $_POST['isbn'];
		$copyrightyear = $_POST['copyrightyear'];
		$daterecieve = $_POST['datereceive'];
		
		$date = new DateTime("now", new DateTimeZone('Asia/Kuala_Lumpur') );
		$dateadded = $date->format('Y-m-d H:i:s');
		$status = $_POST['status'];
		
		//Insert data.	
		$sql = "INSERT INTO book (book_title, category_id, author, book_copies, book_pub, publisher_name, isbn, copyright_year, date_receive, date_added, status) 
				VALUES ('$booktitle','$categoryId','$author','$bookcopies','$bookpub','$publishername','$isbn','$copyrightyear','$daterecieve','$dateadded','$status')";
		mysqli_query($con, $sql);	
		echo("<script language='javascript'>
		window.alert('Sucess to add new book.');
		window.location.href='addBook.php';</script>");
		
	}
	mysqli_close($con);
?>