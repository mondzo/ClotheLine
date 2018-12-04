<?php

$mysqli = new mysqli('localhost', 'aumesh', 'person', 'ClothLine');

if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

?>