
  

<!--  Include de la navbar -->


   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<header>
   <!--  Include de la navbar -->
   <?php 
      if(isset($_SESSION['user']['id'])){
      session_start();
       ?>
   <!-- navbar connect -->
   <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #000000;">
      <a class="navbar-brand" href="home.php">
      <img src="img/PICT_LOGO_WHITE_TEXT.png" width="80" height="65" class="d-inline-block align-top" alt="white_logo_plateformer_" loading="lazy">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
         <!-- lien recherche d'un utilisateur -->
         <li class="nav-item active">
            <input type="text" placeholder="Chercher un utilisateur"  class= "form-control mr-sm-2 search"/>
            <div class="search-result">
            </div>
         </li>
      </ul>
      </div>
      <ul id="nav-forms">
         <li>    <a class="nav-link" href="../index.php"> <i class="fa fa-home" aria-hidden="true"></i></a></li>
         <!-- quand on clique on déclenche le pop up -->
         <li id="messagePopup" class="nav-item"><i class="fa fa-envelope" aria-hidden="true"></i><span id="messages"><span class="span-i"></span></li>
         <a class="nav-link" href="profile.php"> <img src="upload"/></a> 
         <li>
            <div class="vl"></div>
         </li>
         <li>
            <form action="index.php" method="post">
               <input class="" id="dropdown-deco" name="deco" value="DECONNEXION" type="submit"/>
            </form>
         </li>
      </ul>
      </div>
   </nav>


<?php
}else{ 
?>

<!-- navbar non connecté -->
<nav class="navbar navbar-dark" style="background-color: #000000;">
    <a class="navbar-brand" href="index.php">
        <img src="img/PICT_LOGO_WHITE_TEXT.png" width="60" height="45" class="d-inline-block align-top" alt="white_logo_plateformer_" loading="lazy">
    </a>
    <ul id="nav-forms">
        <li>
            <a class="icon-responsive" href="connexion.php"><i class="fas fa-user-circle"></i></a>
        </li>
        <li>
            <a class="icon-responsive" href="inscription.php"><i class="fas fa-user-plus"></i></a>
        </li>
        <li>
            <a class="link-navbar" class="link-active" href="inscription.php">s'inscrire</a>
        </li>
        <li>
            <div class="vl"></div>
        </li>
        <li>
            <a class="link-navbar" href="connexion.php">se connecter</a>
        </li>
    </ul>
</nav>
    
<?php  } ?> 
