<!DOCTYPE html>
	<html>
		<head>
			<title>News</title>
			<link rel = "stylesheet" type="text/css" href = "style.css">
		</head>
		<body>
			<h1>News!</h1>
			<br/>
			<form name ="input" action="login.php" method="POST">
				Username: <input placeholder="ex. Sproull330" type="text" name="username" required="required"/>
				Password: <input type="password" name="password" required="required"/>
				<input type="submit" value="Log In"/>
			</form>
			<br/>
			<p>New user? No problem!</p>
			<form name="input" action="newUser.php" method="POST">
				Create Username: <input placeholder="ex. Sproull330" type="text" name="newUser" required="required"/>
				Create Password: <input type="password" name="newPassword" required="required"/>
				<input type="submit" value="Create an Account"/>
			</form>
						
				<?php
				require 'database.php';
				//get the links from mysql so unregistered users can also see whats up
				$stmt = $mysqli->prepare("SELECT id, link, story FROM story");
				if(!$stmt){
					printf("Query Prep Failed: %s\n", $mysqli->error);
					exit;
				}
			 
				$stmt->execute();
			 
				$stmt->bind_result($id, $link, $description);
		 
				echo "<ul>\n";
				//each story has a comment section
				//using get method to send the link and id to the comments.php page so it knows
				//which comments to get and also what link to put at the top i.e. like reddit
				while($stmt->fetch()){
					if($link == null){
						printf('<li>%s <br/><a href="comments.php?link='. $link .'&story_id='. $id .'&desc='. $description .'">comments</a></li>',
						htmlspecialchars($description)
					);
					}
					else{
						printf('<li><a href="%s" target="_blank">%s</a>
						   <br/><a href="comments.php?link='. $link .'&story_id='. $id .'">comments</a></li>',
						htmlspecialchars($link),
						htmlspecialchars($description)
					);
					}	
				}
				echo "</ul>\n";
 
				$stmt->close();
			?>
		</body>
	</html>
	