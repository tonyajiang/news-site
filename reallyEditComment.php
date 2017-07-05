<?php
	require 'database.php';
	session_start();
	if($_SESSION['token'] !== $_POST['token']){
		die("Request forgery detected");
	}
	$editted= (string)$_POST['editComment'];
	$comment_id= (int)$_POST['comment_id'];
	$link = (string)$_POST['link'];
	$story_id = (int)$_POST['story_id'];
	
	$stmt = $mysqli->prepare("update comments set comment=? where comment_id=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	 
	$stmt->bind_param('ss', $editted, $comment_id);
 
	$stmt->execute();
	
	$stmt->close();
	
	header("Location: commentsR.php?link=".$link."&story_id=".$story_id);
?>