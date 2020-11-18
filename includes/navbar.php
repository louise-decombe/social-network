<html>
    <head>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

<?php 
//if(isset($_SESSION['id_user'])){

 ?>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <a class="navbar-brand" href="index.php">
  </a>
  
  <ul class="navbar-nav">

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      <img src="images/default-profile.png" alt="Logo" style="width:40px;">
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="profile.php">Profil</a>
        <a class="dropdown-item" href="#">Paramètres</a>
        <div class="dropdown-divider"></div>
                     <form action="index.php" method="post">
                        <input class="btn btn-danger" id="dropdown-deco" name="deco" value="DECONNEXION" type="submit"/>
                     </form>      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="chat.php"> <button class="btn btn-primary"> Messages <i class="far fa-comments" width=""></i></button>

</a>
    </li>
    
    <li class="nav-item">
    <a class="nav-link" href="index.php"> <button class="btn btn-primary">Mur <i class="fa fa-home" aria-hidden="true"></i></button> </a>
    </li>

    <li class="nav-item">
					<input type="text" placeholder="Chercher un utilisateur"  class= "search form-control mr-sm-2"/>
					<div class="search-result">
					</div>
				</li>
  </ul>
</nav>

<?php //}else{ ?>

  <!--   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <a class="navbar-brand" href="index.php">
  </a>
  
  <ul class="navbar-nav">
    
    <li class="nav-item">
    <a class="nav-link" href="connexion.php"> Connexion </button> </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="inscription.php"> Inscription </button> </a>
    </li>
  </ul>
</nav>
    
<? //} ?> 

</html>
-->
<script src="js/search.js"></script>
