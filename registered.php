<!DOCTYPE html>
	<html>
		<head>
			<title>News</title>
			<link rel = "stylesheet" type="text/css" href = "style.css">
		</head>
		<body>
			<h1>News!</h1>
			<form name ="newNews" action="addLink.php" method="POST">
				Post a link: <input type="text" name="newLink"/>
				Description: <input type="text" name="description"/>
				<input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token']?>" />
				<input type="submit" value="Submit"/>
			</form>
			<h2>Here are today's links:</h2>
			<br/>
						
				<?php
				require 'database.php';
				session_start();
				$user_id = $_SESSION['user_id'];
				$stmt = $mysqli->prepare("SELECT id, username,
										 link, story FROM story");
				if(!$stmt){
					printf("Query Prep Failed: %s\n", $mysqli->error);
					exit;
				}
			 
				$stmt->execute();
			 
				$stmt->bind_result($id, $user, $link, $description);
				
				echo "<ul>\n";
				while($stmt->fetch()){
					if($link == null){
						printf('<li>%s<br/><a href="commentsR.php?link='. $link .'&story_id='. $id .'">comments</a></li>',	
						htmlspecialchars($description)
					);
					}
					else{
					printf('<li><a href="%s" target="_blank">%s</a>
						   <br/><a href="commentsR.php?link='. $link .'&story_id='. $id .'">comments</a></li>',	
						htmlspecialchars($link),
						htmlspecialchars($description)
					);
					}
				}
				echo "</ul>\n";
 
				$stmt->close();
			?>
			<form name = "input" action = "profile.php">
				<input type="submit" value="View Profile"/>
			</form>
			<br/><br/>
			<form name = "input" action = "logout.php">
				<input type="submit" value="Log Out"/>
			</form>
			
		</body>
	</html>
	