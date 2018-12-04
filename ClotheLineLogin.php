<?php

    require 'ClotheLinedatabase.php';

    //login back-end functionality
    if (isset($_POST['login']))
    {
        $user = htmlentities($_POST['user']);
        $user = $mysqli->real_escape_string($user);
        $pwd_guess = htmlentities($_POST['pass']);
        $pwd_guess = $mysqli->real_escape_string($pwd_guess);

        ini_set("session.cookie_httponly", 1);
        session_start();
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        $stmt = $mysqli->prepare("SELECT COUNT(*), hashed_password FROM users WHERE username=?");

        // Bind the parameter
        $stmt->bind_param('s', $user);
        $stmt->execute();

        // Bind the results
        $stmt->bind_result($user_id, $pwd_hash);
        $stmt->fetch();

        
        // Compare the submitted password to the actual password hash
        if(password_verify($pwd_guess, $pwd_hash)){
            // Login succeeded!
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $user;
            $status = "valid";
                    
            //header("location: create-task.php");
            // Redirect to your target page
        } else{
            $status = "invalid";
        //    header("Location: loginfailed.php");// Login failed; redirect back to the login screen
        }

        $array = array
        (
            'status' => htmlentities($status),
            'token' => htmlentities($_SESSION['token'])

        );
        echo json_encode($array);
    
    }
    
    //register back-end functionality
    if (isset($_POST['register']))
    {
        $user = htmlentities($_POST['user']);
        $password = htmlentities($_POST['pass']);
        $user = $mysqli->real_escape_string($user);
        $password = $mysqli->real_escape_string($password);

        //checking if user already exists
        $stmt = $mysqli->prepare("SELECT COUNT(*), hashed_password FROM users WHERE username=?");

        $stmt->bind_param('s', $user);
        $stmt->execute();
        $stmt->bind_result($user_id, $pwd_hash);
        $stmt->fetch();
                
                
        if (!empty($pwd_hash))
        {
                   
            $stmt->close();
            $status = "invalid";
            echo json_encode(htmlentities($status));
            exit;
        }
                

        $stmt->close();


        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("insert into users(username, hashed_password) values (?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }

        $stmt->bind_param('ss', $user, $hashed);
        $stmt->execute();
        $stmt->close();
               
        $status = "valid";   

        echo json_encode(htmlentities($status));    
        //header("Refresh:0");
    }

            


?>




