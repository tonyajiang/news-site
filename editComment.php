<!DOCTYPE html>
	<html>
		<head>
			<title>Edit comment</title>
			<link rel = "stylesheet" type="text/css" href = "style.css">
		</head>
		<body>
			<form action="reallyEditComment.php" method="POST">
				Edit comment:<input type=text name="editComment">
				<input type="hidden" name="comment_id" value="<?php echo $_GET['commentID']?>" />
				<input type="hidden" name="story_id" value="<?php echo $_GET['story_id']?>" />
				<input type="hidden" name="link" value="<?php echo $_GET['link']?>" />
				<input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token'];?>" />
				<input type="submit" value="Submit">
			</form>
		</body>
	</html>
