
<html>
	<head>
		<link rel = "stylesheet" type = "text/css" href = "login & newUser.css">
		<title>Sign Up</title>
		<script>
			function validateForm(){
				var username = document.getElementById("UserName").value;
				var firstname = document.getElementById("FirstName").value;
				var lastname = document.getElementById("LastName").value;
				var password = document.getElementById("Password").value;
				var password2 = document.getElementById("Password2").value;
				function containsNumber(str) {
  					return /\d/.test(str);
				}

				if(username.indexOf("'")!=-1 || firstname.indexOf("'")!=-1 || lastname.indexOf("'")!=-1 || password.indexOf("'")!=-1 || password2.indexOf("'")!=-1){
					alert("Symbol ' is not allowed.")
					return false;
				}
				else if (username == "") {
					alert("Please fill in your username.");
					return false;
				}else if (firstname == "") {
					alert("Please fill in your first name.");
					return false;
				}else if (lastname == "") {
					alert("Please fill in your last name.");
					return false;
				}else if (password == "" || password2 == "")  {
					alert("Please fill in your password.");
					return false;
				}else if (password !== password2)  {
					alert("Passwords do not match.");
					return false;
				}else if(password.length < 7){
					alert("Password length must at least have 7 characters.");
					return false;
				}
				else if(!containsNumber(password)){
					alert("Password must at least contain a number.");
					return false;
				}
				else  {
					return true;
				}
			}	
		</script>
	</head>
	<body>
		<div class="center">
		<h1>Signup</h1>
		<form method="POST">
			<div class="txt_field">
				<input id="UserName" name="username" type="text">
				<span></span>
				<label>Username</label>
			</div>
			
			<div class="txt_field">
				<input id="FirstName" name="firstname" type="text">
				<span></span>
				<label>Firstname</label>
			</div>
			
			<div class="txt_field">
				<input id="LastName" name="lastname" type="text">
				<span></span>
				<label>Lastname</label>
			</div>

			<div class="txt_field">
				<input id="Password" name="password" type="password">
				<span></span>
				<label>Password</label>
			</div>
			
			<div class="txt_field">
				<input id="Password2" name="password2" type="password">
				<span></span>
				<label>Confirm Password</label>
			</div>
			
			<div class="btn">
				<input id = "signup" onclick = "return validateForm()" name = "submit" type = "submit" value = "Sign Up">
				&nbsp;
				<input id = "newUser" formaction = "newUser.php" name = "newUser" type = "submit" value = "Erase">
				&nbsp;
				<input id = "return" formaction = "login.php" name = "return" type = "submit" value = "Return to Login">
			</div>
		</form>
		</div>	
	</body>
</html>
<?php
	
	if(isset($_POST['submit'])){
		
		//Connect to database.
		require "includes/conn.php";
		
		
		// Get variable from form by using $_POST.
		$username = $_POST['username'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = $_POST['password'];
		
		// Membuat query SQL.
		$sql = "SELECT * FROM users WHERE username= '".$username."'";
		$numRowSql = mysqli_num_rows(mysqli_query($con,$sql));
		
		// Check error.
		if($numRowSql > 0){
			echo("<script language='javascript'>
			window.alert('This username is already exist.');
			window.location.href='newUser.php';</script>");	
		}else{
			// If sucess
			$sql = "INSERT INTO users (username,password,firstname,lastname)
					VALUES ('$username','$password','$firstname','$lastname')";
			mysqli_query($con, $sql);
			session_start();
			$_SESSION['username'] = $_POST['username'];			
			echo("<script language='javascript'>
			window.alert('New user account created.');
			window.location.href='menu.php';</script>");
		}
		mysqli_close($con);	
	}
?>