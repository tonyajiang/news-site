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
				//commentsR is specifically for registered users who can edit and delete
				//their comments in the comments page
				require 'database.php';
				
				session_start();
				
				$link = (string)$_GET['link'];
				$id = (int)$_GET['story_id'];
				$user_id = $_SESSION['user_id'];
				
				//echo the link or story that the comments are associated with
				
				echo '<a href="'. $link .'">'. $link .'</a>';
				echo '<br/>';
				
				//select the comments relevant to the story
				$stmt = $mysqli->prepare("SELECT comment_id, username, story_id, comment, link FROM comments WHERE story_id=?");
				if(!$stmt){
					printf("Query Prep Failed: %s\n", $mysqli->error);
					exit;
				}
				$stmt->bind_param('s', $id);
				$stmt->execute();
			 
				$stmt->bind_result($cid, $username, $sid, $comment, $l);
		 
				echo "<ul>\n";
				while($stmt->fetch()){
					//the comment
					printf("\t<li>%s commented: %s</li>\n",
						htmlspecialchars($username),
						htmlspecialchars($comment)
					);
					//delete button
					if($username == $user_id){
					printf('<p><a href="deleteComment.php?commentID=%s&story_id=%s&link=%s">delete</a> / ',
						htmlspecialchars($cid),
						htmlspecialchars($sid),
						htmlspecialchars($l)
						);
					//edit button
					printf('<a href="editComment.php?commentID=%s&story_id=%s&link=%s">edit</a></li></p>',
						htmlspecialchars($cid),
						htmlspecialchars($sid),
						htmlspecialchars($l)
						);
					}
				}
				echo "</ul>\n";
 
				$stmt->close();
			?>
			<form name ="comments" action="addComment.php" method="POST">
				Comment: <input type="text" name="newComment"/>
				<input type="hidden" name="story_id" value="<?php echo $_GET['story_id']?>" />
				<input type="hidden" name="link" value="<?php session_start(); echo $_GET['link']?>" />
				<input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token'];?>" />
				<input type="submit" value="Submit"/>
			</form>
			<br/><br/><br/>
			<form name = "input" action = "registered.php">
				<input type="submit" value="Take me Home"/>
			</form>
			<br/>
			<form name = "input" action = "logout.php" method = "POST">
				<input type="submit" value="Log Out"/>
			</form>
		</body>
	</html>
				