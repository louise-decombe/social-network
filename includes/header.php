
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
      <link rel="stylesheet" type="text/css" href="css/style-forms.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
      <link rel="shortcut icon" type="image/x-icon" href="#">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

            <!-- polices caractère -->
      <link href="" rel="stylesheet">
      <!-- liens script, jquery ajax  -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/search.js"></script>
    <script src="js/chat.js"></script>
    <script src="js/search_chat.js"></script>
    <script src="js/hashtag.js"></script>
    <script src="js/envoi_message.js"></script>




    </head>

<header>
<!--  Include de la navbar -->

<?php 
if(isset($_SESSION['id'])){

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


<?php

}else{ ?>

<header>
    <?php
    //if($page_selected == ('index_1') OR $page_selected == ('connexion') OR $page_selected == ('inscription') ){
    ?>

    <nav class="navbar navbar-dark" style="background-color: #000000;">
        <a class="navbar-brand" href="index.php">
            <img src="img/PICT_LOGO_WHITE_TEXT.png" width="60" height="45" class="d-inline-block align-top" alt="white_logo_plateformer_" loading="lazy">
        </a>
        <ul id="nav-forms">
            <li><a class="icon-responsive" href="connexion.php"><i class="fas fa-user-circle"></i></a>
            <li><a class="icon-responsive" href="inscription.php"><i class="fas fa-user-plus"></i></a>
            <li><a class="link-navbar" class="link-active" href="inscription.php">s'inscrire</a></li>
            <li><div class="vl"></div></li>
            <li><a class="link-navbar" href="connexion.php">se connecter</a></li>
        </ul>
    </nav>

</header>
    
<?}   ?> 
