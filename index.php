<?php $page_selected = 'index_1'; 
session_start();
require 'class/Config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>social_network - index</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="#">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style-forms.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"></script>
</head>
<body>
<header>
    <?php
    include("includes/header.php");
   ?>
</header>
<main id="main-index">

    <div class="ovale_1"></div>
    <div class="ovale_2"></div>
    <div class="ovale_3"></div>

    <!--<div class="wavy-line wavy-line-green" data-text="xxx"></div>-->

    <svg class="right-wave">
        <path d="M10,10 L50,100 L90,50"></path>
    </svg>


    <div class="container-fluid sh-100 d-flex flex-column justify-content-center index_content">
         <div class="row">
            <div class="col d-flex">
                <h1 class="title1_index">Echanger,</h1>
            </div>
        </div>
        <div class="row flex-column">
            <div class="col text-center">
                <h1 class="title2_index"> Plateformer_ !<h1>
            </div>
           <div class="col text-center mb-3">
                <span class="subtitle_index">Retrouvez vos partenaires de code sur le réseau social de la Plateforme_</span>
            </div>
            <?php if(empty($_SESSION['user'])){ ?>
            <div class="col text-center">
                <a class="index_button" href="inscription.php">
                    nous rejoindre
                </a>
            </div>
            <?php } ?>
            <?php if(!empty($_SESSION['user']) && isset($_SESSION['user'])){ ?>
            <div class="col text-center">
                <a class="index_button" href="profile.php">
                    mon profil
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</main>
<footer>
    <?php
    include("includes/footer.php") 
    ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/wave.js"></script>
<!-- <script type="text/javascript" src="js/transition.js"></script> -->
<!-- <script type="text/javascript" src="js/form_connexion.js"></script> -->
<!-- <script type="text/javascript" src="js/form_inscription.js"></script> -->
</body>
</html>