
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<link rel="stylesheet" type="text/css" href="Menu.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	
	</head>
	<body>
		<script>
			function out() {
				return confirm('Do you want to log out?');
			}
		</script>

	<form method="POST">
		<div class="wrapper">
			<nav>
			<input type="checkbox" id="show-search">
			<input type="checkbox" id="show-menu">
			<label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
			<div class="content">
			<div class="logo"><a href="#">Library Menu</a></div>
				<ul class="links">
				<li>
					<a href="#" class="desktop-link">Book</a>
					<input type="checkbox" id="show-book">
					<label for="show-book">Book</label>
					<ul>
						<li><input class="btn" id = "bookList" formaction = "bookList.php" value="Book List" type="submit"></li>
						<li><input class="btn" id = "addBook" formaction = "addBook.php" value="Add New Book" type="submit"></li>
					</ul>
				</li>

				<li>
					<a href="#" class="desktop-link">Borrow</a>
					<input type="checkbox" id="show-borrow">
					<label for="show-borrow">Borrow</label>
					<ul>
						<li><input class="btn" id = "borrowList" formaction = "borrowList.php" value="Borrow List" type="submit"></li>
						<li><input class="btn" id = "addBorrow" formaction = "addBorrow.php" value="Borrow & Request" type="submit"></li>
					</ul>
				</li>

				<li>
					<a href="#" class="desktop-link">Member</a>
					<input type="checkbox" id="show-member">
					<label for="show-member">Member</label>
					<ul>
						<li><input class="btn" id = "memberList" formaction = "memberList.php" value="Member List" type="submit"></li>
						<li><input class="btn" id = "borrowerTypeList" formaction = "borrowerTypeList.php" value="Borrower Type" type="submit"></li>
						<li><input class="btn" id = "addBorrowerType" formaction = "addBorrowerType.php" value="Add New Borrower Type" type="submit"></li>
						<li><input class="btn" id = "addMember" formaction = "addMember.php" value="Add New Member" type="submit"></li>
					</ul>
				</li>
			
				<li>
					<a href="#" class="desktop-link">Category</a>
					<input type="checkbox" id="show-category">
					<label for="show-category">Category</label>
					<ul>
						<li><input class="btn" id = "categoryList"formaction = "categoryList.php" value="Category" type="submit"></li>
						<li><input class="btn" id = "addCategory" formaction = "addCategory.php" value="Add New Category" type="submit"></li>
					</ul>
				</li>

				<li>
					<input class="logoutbutton" id="destroy" formaction="destroy.php" value="Log Out" type="submit" onclick="return out()">
				</li>
			</div>
			</nav>
		</div>
	</form>
	</body>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>