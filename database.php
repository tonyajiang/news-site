<?php
//connect to the database
$mysqli = new mysqli('localhost', 'JIANGT', 'Tjbreez11!', 'users');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>