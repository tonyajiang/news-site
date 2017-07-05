<?php
	require 'database.php';
	session_start();
	
	$user_id = $_SESSION['id'];
	$comment_id= (int)$_GET['commentID'];
	$story_id = (int)$_GET['story_id'];
	$link =(string)$_GET['link'];
	
	//Delete the undesired comment
	$stmt = $mysqli->prepare("delete from comments where comment_id=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	 
	$stmt->bind_param('s', $comment_id);
	 
	$stmt->execute();
	
	$stmt->close();
	
	header("Location: commentsR.php?link=".$link."&story_id=".$story_id);
?>