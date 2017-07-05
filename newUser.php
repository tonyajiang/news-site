<!DOCTYPE html>
	<html>
		<head>
			<title>New User</title>
			<link rel = "stylesheet" type="text/css" href = "style.css">
		</head>
		<body>
			<h1>Cool, welcome!</h1>
			<p>You can now post and edit your own stories and comments!</p>
			<p>Log in to access all these cool functions.</p>
			<?php
				require 'database.php';
				$newUser = (string)$_POST['newUser'];
				$newPassword = (string)crypt($_POST['newPassword']);
				if($newUser !== "" or $newPassword !== ""){
				$stmt = $mysqli->prepare("insert into users(username, password) values (?, ?)");
				if(!$stmt){
					printf("Query Prep Failed: %s\n", $mysqli->error);
					exit;
				}
	 
				$stmt->bind_param('ss', $newUser, $newPassword);
				 
				$stmt->execute();
					
				$stmt->close();
				}
				else{
					echo htmlentities('JK you didn\'t enter a username or password! Try again.');
				}
			?>
			<form name = "input" action = "index.php">
				<input type="submit" value="Back to the Front Page"/>
			</form>
		</body>
	</html>
