<html>
    <head>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

<?php 
//if(isset($_SESSION['id_user'])){

 ?>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <a class="navbar-brand" href="#">
  </a>
  
  <ul class="navbar-nav">

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      <img src="images/default-profile.png" alt="Logo" style="width:40px;">
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Profil</a>
        <a class="dropdown-item" href="#">Paramètres</a>
        <div class="dropdown-divider"></div>
                     <form action="index.php" method="post">
                        <center><input class="btn btn-danger" id="dropdown-deco" name="deco" value="DECONNEXION" type="submit"/></center>
                     </form>      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"> <button class="btn btn-primary"> Messages <i class="far fa-comments" width=""></i></button>

</a>
    </li>
    
    <li class="nav-item">
    <a class="nav-link" href="#"> <button class="btn btn-primary">   MUR</button> </a>
    </li>
    <form class="form-inline my-2 my-lg-0" action="/action_page.php">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-primary" type="submit">Chercher</button>
  </form>
  </ul>
</nav>

<?php //}else{ ?>

  <!--  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</div 
    
<? //} ?> 

</html>