<?php
	require 'database.php';
	session_start();
	if($_SESSION['token'] !== $_POST['token']){
		die("Request forgery detected");
	}
	$story_id= (int)$_POST['story_id'];
	$newDesc= (string)$_POST['newDesc'];
	//update the story description 
	$stmt = $mysqli->prepare("update story set story=? where id=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	 
	$stmt->bind_param('ss', $newDesc, $story_id);
	 
	$stmt->execute();
	
	$stmt->close();
	
	header("Location: registered.php");
?>