<?php
	require 'ClotheLinedatabase.php';
	session_start();
  ini_set("session.cookie_httponly", 1);
      $token = $_POST['token'];
      if(!hash_equals($_SESSION['token'], $token)){
        die();
      }
    $itemid = htmlentities($_POST['itemid']);
    $itemid = $mysqli->real_escape_string($itemid);

    $stmt = $mysqli->prepare("DELETE FROM item WHERE item_id = '$itemid'");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->close();


?>