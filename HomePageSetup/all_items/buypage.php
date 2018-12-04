<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>3 Col Portfolio - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/3-col-portfolio.css" rel="stylesheet">

    <script src="src/lib/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.24.0/babel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.1.0/react.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.1.0/react-dom.min.js"></script>
    <script src="https://unpkg.com/react-image/umd/index.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  </head>

  <body>


   
    <div id="root"></div>

    <script type = "text/babel">
    
    function NavBar() {
      
        return (
            <nav className="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div className="container">
        <a className="navbar-brand" href="#">ClotheLine</a>
        <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="navbarResponsive">
          <ul className="navbar-nav ml-auto">
            <li className="nav-item active">
              <a className="nav-link" href="../homepage.php">Home
                <span className="sr-only">(current)</span>
              </a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="#">Buy</a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="../sellpagesetup/sellpage.php">Sell</a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="../../CreativeProject.html">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

        );
    }

    function ItemBlock(props){
      return (
      <div className="col-lg-4 col-sm-6 portfolio-item">
          <div className="card h-100">
           
            <div className="card-body">
              <h4 className="card-title">
                <a href={"../singleitemsetup/singleitem.php?id="+props.id}>Project {props.num}</a>
              </h4>
              <p className="card-text">Price: {props.price} <br></br> Bid: {props.bid} <br></br> {props.tag}</p>
            </div>
          </div>
      </div>
      );
    }
    
    function RestOfPage(props) {
      var rows = [];
      for (var i = 0; i < props.size; i++){
        rows.push(<ItemBlock num = {props.name[i][0]} price = {props.name[i][1]} bid = {props.name[i][2]} id = {props.name[i][3]} tag = {props.name[i][4]}/>);
      }
      console.log(rows);
        return (
            <div className="container">
      
          

      
      <h1 className="my-4">Buy Page
      </h1>

      <div className="row">
          {rows}
        
      </div>
      
      

    </div>


        );  
    }
    
    
    function Footer() {
        return (
            <footer className="py-5 bg-dark">
            <div className="container">
              <p className="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
            </div>
            </footer>
        );
    }
    


    class Page extends React.Component {
      constructor(props) {
        super(props);
      }

      componentDidMount(){
        axios.get("fetchdata.php")
        .then(response => 
            this.setState(response.data)
        );
      }

      render(){

        if (this.state != null){
  
          const data = this.state[0][0];
          const length = Object.keys(this.state).length;


          return(
            <div>
              <NavBar />
              <RestOfPage name = {this.state} size = {length}/>
              <Footer />  
            </div>
          );

          
        }

        return(

          <div>
              <NavBar />
              <RestOfPage name = "not working"/>
              <Footer />  
            </div>
        );

        
        
        
      
      }
    }

    
    ReactDOM.render( 
            <Page />, 
            document.getElementById('root')
    );

    </script>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
