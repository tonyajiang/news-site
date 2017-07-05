<!DOCTYPE html>
	<html>
		<head>
			<title>
				Comment Section
			</title>
			<link rel = "stylesheet" type="text/css" href = "style.css">
		</head>
		<body>
			<h1>Comments!</h1>
			<?php
				require 'database.php';
				//get the variable from index.php so you can select the right comments correlating
				//to the right story
				//and put the related link at the top too
				$link = (string)$_GET['link'];
				$story_id = (string)$_GET['story_id'];
							
				
				echo htmlentities($description);
				echo '<br/>';
				echo '<a href="'. $link .'">'. $link .'</a>';
				//Select comments relevant to the story (known through story_id)
				$stmt = $mysqli->prepare("SELECT username, story_id, comment FROM comments WHERE story_id =?");
				if(!$stmt){
					printf("Query Prep Failed: %s\n", $mysqli->error);
					exit;
				}
				$stmt->bind_param('s', $story_id);
				
				$stmt->execute();
			 
				$stmt->bind_result($username, $link, $comment);
		 
				echo "<ul>\n";
				while($stmt->fetch()){
					printf("\t<li>%s commented: %s</li>\n",
						htmlspecialchars($username),
						htmlspecialchars($comment)
					);
				}
				echo "</ul>\n";
 
				$stmt->close();
			?>
			<form name = "input" action = "index.php">
				<input type="submit" value="Back to the Front Page"/>
			</form>
		</body>
	</html>
				