<?php
	require 'ClotheLinedatabase.php';
	session_start();
    ini_set("session.cookie_httponly", 1);
      $token = $_POST['token'];
      if(!hash_equals($_SESSION['token'], $token)){
        die();
      }
    $bid = htmlentities($_POST['bid']);
    $bid = $mysqli->real_escape_string($bid);
    $numbids = htmlentities($_POST['numbids']);
    $numbids = $mysqli->real_escape_string($numbids);
    $itemid = htmlentities($_POST['itemid']);
    $itemid = $mysqli->real_escape_string($itemid);
    $query = "UPDATE item SET item_topbid = '$bid', num_bids = '$numbids' WHERE item_id = '$itemid'";
	$stmt = $mysqli->prepare($query);
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->execute();
    $stmt->close();
?>