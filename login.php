<!DOCTYPE html>
	<html>
		<head>
			<title>Welcome Back!</title>
			<link rel = "stylesheet" type="text/css" href = "style.css">
		</head>
		<body>
			<h1>Welcome Back!</h1>
			<?php
				require 'database.php';
				
				// Use a prepared statement
				$stmt = $mysqli->prepare("select username, password FROM users WHERE username=?");
				// Bind the parameter
				$username = (string)$_POST['username'];
				$stmt->bind_param('s', $username);
				
				$stmt->execute();
				// Bind the results
				$stmt->bind_result($user_id, $pwd_hash);
				$stmt->fetch();

				$pwd_guess = (string)$_POST['password'];
				// Compare the submitted password to the actual password hash
				if(crypt($pwd_guess, $pwd_hash)==$pwd_hash){
					session_start();
				// Login succeeded!
					$_SESSION['user_id'] = $user_id;
					$_SESSION['token'] = substr(md5(rand()), 0, 10); // generate a 10-character random string
				
				header("Location: registered.php");
				// Redirect to your target page
				}else{
				// Login failed; redirect back to the login screen
				header("Location: index.php");
				}
			?>
		</body>
	</html>
