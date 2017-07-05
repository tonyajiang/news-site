<!DOCTYPE html>
	<html>
		<head>
			<title>Profile</title>
			<link rel = "stylesheet" type="text/css" href = "style.css">
		</head>
		<body>					
				<?php
				require 'database.php';
				session_start();
				$user_id = $_SESSION['user_id'];
				echo '<h1>Hi, '. $user_id .'</h1>';
				echo '<h2>Here are all the links you have posted</h2>';
				$stmt = $mysqli->prepare("SELECT id, username, link, story FROM story WHERE username=?");
				if(!$stmt){
					printf("%s", htmlentities("Query Prep Failed: %s\n", $mysqli->error));
					exit;
				}
				$stmt->bind_param('s', $user_id);
			 
				$stmt->execute();
			 
				$stmt->bind_result($id, $user, $link, $description);

				//how can i capture this $link into a variable for other pages???
				echo "<ul>\n";
				while($stmt->fetch()){
					printf('<li><a href="%s" target="_blank">%s</a> <br/>description: %s
						   <br/><a href="commentsR.php?link='. $link .'&story_id='. $id .'">comments</a></li>',
						htmlspecialchars($link),
						htmlspecialchars($link),
						htmlspecialchars($description)
					);
					printf('<a href="deleteLink.php?sid=%s&user=%s">delete</a>',
							   htmlspecialchars($id),
							   htmlspecialchars($user_id)
					);
					printf('</br><a href="editStory.php?sid=%s&user=%s">edit</a>',
							   htmlspecialchars($id),
							   htmlspecialchars($user_id)
					);
				}
				echo "</ul>\n";
 
				$stmt->close();
			?>
			<form name = "input" action = "messages.php">
				<input type="submit" value="Inbox"/>
			</form>
			<form name = "input" action = "registered.php">
				<input type="submit" value="Take me Home"/>
			</form>
			<br/>
			<form name = "input" action = "logout.php">
				<input type="submit" value="Log Out"/>
			</form>
			
		</body>
	</html>
	