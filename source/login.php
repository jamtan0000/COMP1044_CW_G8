<!DOCTYPE html>

<html lang=en>
<head>
	<link rel = "stylesheet" type = "text/css" href = "login & newUser.css">
	<title>Log In</title>
	<script>
		function validateForm() {
			var username = document.getElementById("Username").value;
			var password = document.getElementById("Password").value;
			if (username == "") {
				alert("Please fill in your username.");
				return false;
			}
			else if (password == "") {
				alert("Please fill in your password.");
				return false;
			}
			else {
				return true;
			}
		}
	</script>
</head>
	
<body>
	<div class="center">
      <h1>Login</h1>
      <form method="POST">
        <div class="txt_field">
          <input id="Username" name="username" type="text">
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input id="Password" name="password" type="password">
          <span></span>
          <label>Password</label>
        </div>
		
		<div class="btn">
			<input id="login" onclick="return validateForm()" name="login" type="submit" value="Login">
			&nbsp;
			<input id="signup" formaction="newUser.php" name="newUser" type="submit" value="Sign Up">
        </div>
      </form>
    </div>
</body>
</html>		


<?php
	//If user click login 	
	if (isset($_POST['login'])){
		
	//Connect to database.	
	require "includes/conn.php";
	
	//Get user input for username and password.
	$username = $_POST['username'];
	$password = $_POST['password'];
	$sql1 = "SELECT * FROM users WHERE username= '$username' AND password= '$password'";
	$sql2 = "SELECT * FROM users WHERE username= '".$username."' AND password !='".$password."'";
	$numRowSql1 = mysqli_num_rows(mysqli_query($con,$sql1));
	$numRowSql2 = mysqli_num_rows(mysqli_query($con,$sql2));
	
		//If input empty or other error.
		if($numRowSql2 > 0) {
			echo ("<script language='javascript'>
			window.alert('Incorrect password');
			window.location.href='login.php';</script>");	
		}elseif($numRowSql1 == 0){
			echo("<script language='javascript'>
			window.alert('User does not exist, please sign up');
			window.location.href='login.php';</script>");	
		}elseif($numRowSql1 > 0) {
			// If success
			session_start();
			$_SESSION['username'] = $_POST['username'];
			echo("<script language='javascript'>
			window.alert('Successfully logged in');
			window.location.href='menu.php';</script>");	
		}
	}
?>