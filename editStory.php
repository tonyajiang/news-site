<!DOCTYPE html>
	<html>
		<head>
			<title>Edit Story</title>
			<link rel = "stylesheet" type="text/css" href = "style.css">
		</head>
		<body>
			<form action="actuallyEdit.php" method="POST">
				Edit Story:<input type=text name="newDesc">
				<input type="hidden" name="story_id" value="<?php echo $_GET['sid']?>" />
				<input type="hidden" name="user" value="<?php echo $_GET['user']?>" />
				<input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token'];?>" />
				<input type="submit" value="Submit">
			</form>
		</body>
	</html>
