<!DOCTYPE html>
	<html>
		<head>
			<title>Messages</title>
			<link rel = "stylesheet" type="text/css" href = "style.css">
		</head>
		<body>
			<h1>Messages</h1>
			<form name ="newMessages" action="sendMessage.php" method="POST">
				To: <input type="text" name="to"/>
				Message: <input type="text" name="message"/>
				<input type="submit" value="Submit"/>
			</form>
			<h2>Inbox:</h2>
			<br/>
						
				<?php
				require 'database.php';
				session_start();
				$user_id = $_SESSION['user_id'];
				
				//select any messages that were sent to the user
				$stmt = $mysqli->prepare("SELECT from_user, to_user, message FROM messages WHERE to_user=?");
				if(!$stmt){
					printf("Query Prep Failed: %s\n", $mysqli->error);
					exit;
				}
				$stmt->bind_param('s', $user_id);
				$stmt->execute();
			 
				$stmt->bind_result($to, $from, $message);

				echo "<ul>\n";
				while($stmt->fetch()){
					printf('<li>from: %s</br>%s',
						htmlspecialchars($to),
						htmlspecialchars($message)
					);
				}
				echo "</ul>\n";
 
				$stmt->close();
			?>
			<form name = "input" action = "profile.php">
				<input type="submit" value="Back to Profile"/>
			</form>
			<br/><br/>
			<form name = "input" action = "registered.php">
				<input type="submit" value="Take me Home"/>
			</form>
			<br/><br/>
			<form name = "input" action = "logout.php">
				<input type="submit" value="Log Out"/>
			</form>
			
		</body>
	</html>
	