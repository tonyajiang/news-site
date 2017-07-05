<?php
	require 'database.php';
	session_start();
	if($_SESSION['token'] !== $_POST['token']){
		die("Request forgery detected");
	}
	$user_id = (string)$_SESSION['user_id'];
	$newComment = (string)$_POST['newComment'];
	$story_id = (int)$_POST['story_id'];
	$link = (string)$_POST['link'];
	
	//insert comment into comments table
	if($newComment !== ""){
	$stmt = $mysqli->prepare("insert into comments (username, story_id, link, comment) values (?, ?, ?, ?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	 
	$stmt->bind_param('ssss', $user_id, $story_id, $link, $newComment);
	 
	$stmt->execute();
	
	$stmt->close();
	}
	header("Location: commentsR.php?link=".$link."&story_id=".$story_id);


?>