<?php
	require 'database.php';
	session_start();

	if($_SESSION['token'] !== $_POST['token']){
		die("Request forgery detected");
	}
	
	$newLink = (string)$_POST['newLink'];
	$description = (string)$_POST['description'];
	$user_id = (string)$_SESSION['user_id'];
	
	//add a link by inserting a new story into the story table
	$stmt = $mysqli->prepare("insert into story (username, link, story) values (?, ?, ?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	 
	$stmt->bind_param('sss', $user_id, $newLink, $description);
	 
	$stmt->execute();

	$stmt->close();

	header("Location: registered.php");
?>