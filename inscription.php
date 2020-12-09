<?php $page_selected = 'inscription'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>social_network - inscription</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="#">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style-forms.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body class = "body">
<header class = "header">
    <?php
    include("includes/header.php");
    require 'class/Options.php';
    $options = new Options($db);
    $cursus = $options->cursus_list();
    //var_dump($cursus);
   ?>
</header>
<main id="main-index">

    <div class="ovale_1"></div>
    <div class="ovale_2"></div>
    <div class="ovale_3"></div>

    <div class="container-fluid sh-100 d-flex flex-column justify-content-center align-content-center index_content">
        <div class="row flex-column align-content-center">
            <form class="form" id="form-register" method="POST" action="php/form_inscription.php">
                <h1 id="form-title"><img src="img/PICT_LOGO_BLACK.png" width="70" height="50" alt="blacl_logo_plateformer_">PLATEFORMER_</h1>
                <h2>Formulaire d'inscription</h2>
                <section>
                    <div class="form-group">
                        <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="firstname" placeholder="prénom" required>
                        <div id="error_firstname"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastname" placeholder="nom" required>
                        <div id="error_lastname"></div>
                    </div>
                    <div class="form-group">
                        <input id="mail" type="email" name="mail" class="form-control" class="col-xs-4" aria-describedby="mail" placeholder="email@laplateforme.io" required>
                        <small id="emailHelp" class="form-text text-muted">Rejoignez Plateformer_ avec votre adresse email @laplateforme.io</small>
                        <div id="error_email"></div>
                        <div id="error_email1"></div>
                    </div>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-eye-slash" id="eye"></i></div>
                        </div>
                        <input type="password" class="form-control" name="password" id="password" placeholder="mot de passe" required>
                    </div>
                    <div id="error_password"></div>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-eye-slash" id="eye1"></i></div>
                        </div>
                        <input type="password" class="form-control" name="check_password" id="check_password" placeholder="confirmer mot de passe" required>
                    </div>
                    <small id="emailHelp" class="form-text text-muted">Le mot de passe doit contenir:<br>- Entre 8 et 20 caractères dont 1 caractère spécial<br>- Au moins 1 majuscule et 1 minuscule - Au moins 1 chiffre.</small>
                    <div id="error_check"></div>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="inputGroupSelect01" name="cursus" required>
                            <option selected>Sélectionner le cursus</option>
                            <?php foreach ($cursus as $all_cursus){ ?>
                                <option value="<?= $all_cursus['id_cursus'];?>"><?= $all_cursus['name_cursus'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </section>
                <button type="submit" name="submit_register" class="btn btn-primary btn_submit_register">Enregistrer</button>
            </form>
        </div>
    </div>
</main>
<footer>
    <?php
    include("includes/footer.php") ?>
</footer>

<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>-->
<script src="js/form_inscription.js"></script>
<!--<script src="js/transition.js"></script>-->

</body>
</html>