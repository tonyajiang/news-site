<?php
	require 'database.php';
	session_start();
	$user_id = $_SESSION['user_id'];
	$to_user = (string)$_POST['to'];
	$message = (string)$_POST['message'];
	$stmt = $mysqli->prepare("insert into messages (from_user, to_user, message) values (?, ?, ?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	 
	$stmt->bind_param('sss', $user_id, $to_user, $message);
	 
	$stmt->execute();
	
	$stmt->close();

	header("Location: messages.php");

?>