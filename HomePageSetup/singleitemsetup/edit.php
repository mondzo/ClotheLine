<?php
	require 'ClotheLinedatabase.php';

	session_start();
    ini_set("session.cookie_httponly", 1);
      $token = $_POST['token'];
      if(!hash_equals($_SESSION['token'], $token)){
        die();
      }
    
    $itemname = htmlentities($_POST['itemname']);
    $itemname = $mysqli->real_escape_string($itemname);
    $price = htmlentities($_POST['price']);
    $price = $mysqli->real_escape_string($price);
    $itemid = htmlentities($_POST['itemid']);
    $itemid = $mysqli->real_escape_string($itemid);
    $query = "UPDATE item SET item_price = '$price', item_name = '$itemname' WHERE item_id = '$itemid'";
	$stmt = $mysqli->prepare($query);
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->execute();
    $stmt->close();
?>