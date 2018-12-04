<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Item - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-item.css" rel="stylesheet">

  </head>

  <body>
    <script>
      
      $(document).ready(hideEvents);
      function hideEvents(event){
        $("#Edit").css("visibility", "hidden");
        $("#Delete").css("visibility", "hidden");
      }
    </script>

    <?php 
      
      session_start();
      $token = $_SESSION['token'];
      require 'ClotheLinedatabase.php';
      $itemid = $_GET['id'];
      $stmt = $mysqli->prepare("SELECT username, item_name, item_price, item_topbid, num_bids FROM item WHERE item_id='$itemid'");
      if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
      }
      $stmt->execute();

      $stmt->bind_result($itemuser, $itemname, $itemprice, $itemtopbid, $numbids);
      while ($stmt->fetch()) {
        $itemuser = htmlentities($itemuser);
        $itemname = htmlentities($itemname);
        $itemprice = htmlentities($itemprice);
        $itemtopbid = htmlentities($itemtopbid);
        $numbids = htmlentities($numbids);
      }

      $stmt->close();
    ?>
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
              <a class="nav-link" id="Sell">Sell</a>
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

        <div class="col-lg-3">
          <h1 class="my-4">Shop Name</h1>
          <div class="list-group">
            <a id="Bid" class="list-group-item">Bid</a>
            <a id="Comment" class="list-group-item">Comment</a>
            <a id="Edit" class="list-group-item">Edit</a>
            <a id="Delete" class="list-group-item">Delete</a>

          </div>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div class="card mt-4">
            <!-- <img class="card-img-top img-fluid" src="<?php //echo '../../../ClotheLine/HomePageSetup/singleitemsetup/test.jpg'?>" alt=""> -->
            <div class="card-body">
              <h3 class="card-title"><?=$itemname?></h3>
              <h4>Price: <?php echo $itemprice;?> Topbid: <?php echo $itemtopbid;?></h4>
            </div>
          </div>
          <!-- /.card -->

          <div class="card card-outline-secondary my-4">
            <div class="card-header">
              Product Reviews
            </div>
            <div class="card-body">
              <p>
                <?php 
                  $stmt = $mysqli->prepare("select comment, username from comments where item_id='$itemid'");
                  if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                  }
      
                  
                  $stmt->execute();

                  $stmt->bind_result($comment, $user);


      
                  while($stmt->fetch()){
                    echo htmlspecialchars($comment);
                    echo "-by ";
                    echo htmlspecialchars($user);
                    echo "<br>";
                  }

                  $stmt->close();
                ?>
              </p>
              
              <hr>
              
              
            </div>
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <form action="../sellpagesetup/sellpage.php" method="post" id = "myformsell">
          <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        </form>
        <form action="../homepage.php" method="post" id = "myformhome">
           <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        </form>
        <form action="../all_items/buypage.php" method="post" id = "myformbuy">
          <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        </form>
        

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>

    $("#Edit").css("visibility", "hidden");
    $("#Delete").css("visibility", "hidden");
    //alert ("<?php echo $token;?>");
    var itemid = "<?php echo $itemid; ?>";
    var username = "<?php echo $_SESSION['username'];?>";
    //alert (username);
    var itemuser = "<?php echo $itemuser;?>";
    //alert (itemuser);
    if (username === itemuser)
    {
      //alert("hi");
      $("#Edit").css("visibility", "visible");
      $("#Delete").css("visibility", "visible");
    }

    var topbid = "<?php echo $itemtopbid;?>";
    var numbids = "<?php echo $numbids;?>";
    var token = "<?php echo $token;?>";
    $("#Bid").click(function(){
      var bid = parseInt(prompt("Please enter your Bid:", ""));
      if (bid == "" || bid == null || bid <= topbid){
        alert(bid);
        alert("Make a bid higher than top bid");
      }
      else{
        
        numbids++;
        $.ajax({
          type: "POST",
          url: "bids.php",
          data: {
            "token": token,
            "bid": bid,
            "numbids": numbids,
            "itemid": itemid
          },
          success: function(response){    
            alert("you updated BIDS!. Please Refresh the Page");
          }
        
        });
      }

        
    });

    $("#Delete").click(function(){
      // alert ("hi");
      // alert (itemid);
      $.ajax({
        type: "POST",
        url: "delete.php",
        data:{
          "token": token,
          "itemid": itemid
        },
        success: function(response){
          alert("You Deleted the Item. Please Refresh the Page/Go back to buy page.");
          window.location.assign("../all_items/buypage.php");
        }
      });

    });
    

    $("#Edit").click(function(){
      var itemname = prompt("Please enter your new name:", "");
      var price = prompt("Please enter your price:", "");

      if (itemname == "" || itemname==null || price == null || price ==""){
        alert("No changes made. Reenter info");
      }
      else{
      $.ajax({
          type: "POST",
          url: "edit.php",
          data: {
            "token": token,
            "itemname": itemname,
            "price": price,
            "itemid": itemid
          },
          success: function(response){    
            alert("you updated YOUR ITEM!. Please Refresh the Page");
          }
        
        });
    }

    });

    $("#Comment").click(function(){
      var newcomment = prompt("ADD a new comment", "");
      if (newcomment == "" || newcomment == null){
        alert("Make a real comment");
      }
      else{
        $.ajax({
          type: "POST",
          url: "comment.php",
          data: {
            "token": token,
            "username": username,
            "comment": newcomment,
            "itemid": itemid
          },
          success: function(response){    
            alert("you Inserted a Comment!. Please Refresh the Page");
          }
        
        });
      }
      
    });
    // Comment
    // Edit


    // $("#Edit").click(function()){

    // }

    $("#Sell").click(function(){
        $("#myformsell").submit();
      });

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
