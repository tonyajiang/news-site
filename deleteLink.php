<?php
	require 'database.php';
	session_start();
	
	$user_id = (int)$_SESSION['id'];
	$story= (int)$_GET['sid'];
	//test echoes
	echo htmlentities($user_id);
	echo htmlentities($story);
	
	//realized I had to delete the comments first and then delete the database
	$cstmt = $mysqli->prepare("delete from comments where story_id=?");
	$cstmt->bind_param('s', $story);
		 
	$cstmt->execute();

	$cstmt->close();
	$stmt = $mysqli->prepare("delete from story where id=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	 
	$stmt->bind_param('s', $story);
	 
	$stmt->execute();

	$stmt->close();
	
	header("Location: profile.php");
?>