
      <!---------------------------------------------------------------------------------------------------------- 
      Se trouvent dans cette page, la navbar et tout les liens de script / css nécessaires dans le head + les meta. 
    ---------------------------------------------------------------------------------------------------------------->


<?php
session_start();

include 'class/Config.php';

// pour le moment la var de session est en dur 

$_SESSION['id'] = 1;
?>

<!DOCTYPE html>

<html lang="en">
<head>
      <meta chars   et="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- liens css (bootstrap, fontawesome, css) -->
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/chat.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css">
            <!-- CDN emoji -->
            <script src="jquery.emojiarea.js"></script>

<script type="text/javascript" src="js/jquery.emojis.js"></script>
            <!-- polices caractère -->
      <link href="" rel="stylesheet">
      <!-- liens script, jquery ajax  -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/search.js"></script>
    <script src="js/chat.js"></script>
    <script src="js/search_chat.js"></script>
    <script src="js/hashtag.js"></script>



    </head>

<header>
<!--  Include de la navbar -->

<?php 
//if(isset($_SESSION['id_user'])){

 ?>
 <div class="nav-style">
      <nav class="navbar navbar-expand-lg">
   <a class="navbar-brand" href="index.php">
  </a>
  
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="../index.php" id="" data-toggle="">
      <img src="img/PICT_LOGO_WHITE.png" alt="Logo" style="width:50px;">
      </a>
    </li>
  
    <li class="nav-item">
					<input type="text" placeholder="Chercher un utilisateur"  class= "search form-control mr-sm-2"/>
					<div class="search-result">
					</div>
        </li>

        <!-- quand on clique on déclenche le pop up -->
        <li id="messagePopup" class="nav-item"><i class="fa fa-envelope" aria-hidden="true"></i>Messages<span id="messages"><span class="span-i"></span></li>

    
    <li class="nav-item">
    <a class="nav-link" href="../index.php">Mur <i class="fa fa-home" aria-hidden="true"></i></a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="../profile.php"> <img src="uploads/default_avatar.png" width="5%" alt=""> </i> </a>
    </li>
    <li class="nav-item">
    <form action="../index.php" method="post">
                        <input class="" id="dropdown-deco" name="deco" value="DECONNEXION" type="submit"/>
                     </form>   

    </li>
  </ul>
</nav>
</div>
<script src="js/search.js"></script>
<script src="js/chat.js"></script>
<script src="js/envoi_message.js"></script>

<?php

// ici conditions d'accès si pas connecté

//}else{ ?>

  <!--   <nav class="navbar navbar-expand-lg navbar-dark">
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
    
</header>


