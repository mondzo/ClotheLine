<!DOCTYPE html>
<html lang="en">

  <head>
      <!-- ALL STYLING IS DONE IN BOOTSTRAP CREDIT TO https://azmind.com/create-login-page-bootstrap-template/-->


    <?php
      $token = $_POST['token'];

      //echo ($token);
      session_start();
      if(!hash_equals($_SESSION['token'], $token)){
        $token = $_SESSION['token'];
      }
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Half Slider - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/half-slider.css" rel="stylesheet">


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
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="Buy">Buy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id ="Sell">Sell</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="Logout">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('backgroundimages/1.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Shoes</h3>
              <p>Trade and bid with others to cop some shoes.</p>
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('backgroundimages/2.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Accesories</h3>
              <p>Get amazing designer accessories at a cheaper price</p>
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('backgroundimages/3.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Clothes</h3>
              <p>Get designer clothes at a cheaper price by trading or bidding</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <section class="py-5">
      <div class="container">
        <h1>Welcome <?php echo $_SESSION['username'];?></h1>
        <p>Shop at ClotheLine to get designer items at a cheap price.</p>
        <form action="sellpagesetup/sellpage.php" method="post" id = "myformsell">
          <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        </form>
        <form action="all_items/buypage.php" method="post" id = "myformbuy">
          <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        </form>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; ClotheLine 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
      $("#Sell").click(function(){
        $("#myformsell").submit();
      });

      $("#Buy").click(function(){
        $("#myformbuy").submit();
      });

      $("#Logout").click(function(){
        window.location.assign("../CreativeProject.html");
      });
    </script>

  </body>

</html>
