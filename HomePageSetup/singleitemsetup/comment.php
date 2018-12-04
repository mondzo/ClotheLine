<?php
require 'ClotheLinedatabase.php';

session_start();
ini_set("session.cookie_httponly", 1);
      $token = $_POST['token'];
      if(!hash_equals($_SESSION['token'], $token)){
        die();
      }
          $comment = htmlentities($_POST['comment']);
          $comment = $mysqli->real_escape_string($comment);
          $itemid = htmlentities($_POST['itemid']);
          $itemid = $mysqli->real_escape_string($itemid);
          $user = htmlentities($_POST['username']);
          $user = $mysqli->real_escape_string($user);
    
         
            $stmt = $mysqli->prepare("insert into comments(comment, item_id, username) values ('$comment', '$itemid', '$user')");
            if(!$stmt){
              printf("Query Prep Failed: %s\n", $mysqli->error);
              exit;
            }

            $stmt->execute();
            $stmt->close();
            $relocate = true;

            ?>