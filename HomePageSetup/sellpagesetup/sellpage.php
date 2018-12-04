<!DOCTYPE html>
<html lang="en">

  <head>
    <?php
      session_start();
      $token = $_POST['token'];
      if(!hash_equals($_SESSION['token'], $token)){
        
        $token = $_SESSION['token'];
      }
    ?>

    <!-- ALL STYLING IS DONE IN BOOTSTRAP CREDIT TO https://azmind.com/create-login-page-bootstrap-template/-->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bare - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
      body {
        padding-top: 54px;
      }
      @media (min-width: 992px) {
        body {
          padding-top: 56px;
        }
      }

    </style>


    <!-- ALL STYLING IS DONE IN BOOTSTRAP CREDIT TO https://azmind.com/create-login-page-bootstrap-template/-->

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">ClotheLine</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" id="home">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="Buy">Buy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Sell</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="Logout">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="mt-5">Sell Your Item</h1>
          <p class="lead">
            <div class = "forms">
                
              <form enctype="multipart/form-data" method="POST" id = "allforms"> 
                  Item Name: <input type ="text" id = "itemname" name = "itemname"/> <br>
                  Price: <input type ="number" placeholder="0.00" min="0" value="0" step="0.01" id = "price" name = "price"/> 
                  Tag: <input type = "text" id = "tag" name = "tag"/> <br>
                  <script> parseFloat($("#price").val()).toFixed(2) </script> <br>
                  <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
                  <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
<!--                   <label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" /> -->
                  <input type="submit" value="Upload Item" id = "submit" name ="submit"/>
              </form>

              <form action="../homepage.php" method="post" id = "myformhome">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
              </form>
              <form action="../all_items/buypage.php" method="post" id = "myformbuy">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
              </form>

            </div>
    
          </p>
          <!-- <ul class="list-unstyled">
            <li>Bootstrap 4.0.0</li>
            <li>jQuery 3.3.0</li>
          </ul> -->
        </div>
      </div>

    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <?php
      $username = $_SESSION['username'];
      if (isset($_POST['submit'])){
          require 'ClotheLinedatabase.php';
          $itemname = htmlentities($_POST['itemname']);
          $itemname = $mysqli->real_escape_string($itemname);
          $itemprice = htmlentities($_POST['price']);
          $itemprice = $mysqli->real_escape_string($itemprice);
          $tag = htmlentities($_POST['tag']);
          $tag = $mysqli->real_escape_string($tag);
          $user = htmlentities($_SESSION['username']);
          $user = $mysqli->real_escape_string($user);
    
         
            $stmt = $mysqli->prepare("insert into item(username, item_name, item_price, item_tag) values ('$user', '$itemname', '$itemprice', '$tag')");
            if(!$stmt){
              printf("Query Prep Failed: %s\n", $mysqli->error);
              exit;
            }

            $stmt->execute();
            $stmt->close();
            $relocate = true;
          
      }
    ?>

    <script>
      $("#home").click(function(){
        $("#myformhome").submit();
      });

      $("#Buy").click(function(){
        $("#myformbuy").submit();
      });

      $("#Logout").click(function(){
        window.location.assign("../../CreativeProject.html");
      });
    </script>
  </body>

</html>
