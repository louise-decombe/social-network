<?php $page_selected = 'connexion'; 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>social_network - connexion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="#">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style-forms.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

</head>
<body>
<header>
    <?php
    include("includes/header.php");
   ?>
</header>
<main>
    <div class="ovale_1"></div>
    <div class="ovale_2"></div>
    <div class="ovale_3"></div>
    <div class="container-fluid sh-100 d-flex flex-column justify-content-center index_content">
        <div class="row flex-column align-content-center">
            <!--<form class="form" id="form_connexion" method="POST" action="">-->
            <div class="form" id="form_connexion">
                <h1 id="form-title"><img src="img/PICT_LOGO_BLACK.png" width="70" height="50" alt="blacl_logo_plateformer_">PLATEFORMER_</h1>
                <h2>Formulaire de connexion</h2>
                <section>
                    <div class="form-group">
                        <input id="mail_connexion" type="email" name="mail" class="form-control" class="col-xs-4" aria-describedby="basic-addon2" placeholder="email@laplateforme.io">
                    </div>
                    <div id="error_email"></div>
                    <div id="error_email1"></div>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-eye-slash" id="eye"></i></div>
                        </div>
                        <input type="password" class="form-control" name="password" id="password_connexion" placeholder="mot de passe">
                    </div>
                    <div id="error_password"></div>
                </section>
                <button id="submit_connexion" type="submit" name="submit_connexion" class="btn btn-primary btn_submit_register">Se connecter</button>
            <!--</form>-->
            </div>
        </div>
    </div>
</main>
<footer>
    <?php
    include("includes/footer.php") 
    ?>
</footer>

<!--<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>-->
<script type="text/javascript" src="js/form_connexion.js"></script>
<script type="text/javascript" src="js/transition.js"></script>

 <script type="text/javascript" src="js/wave.js"></script> 

</body>
</html>