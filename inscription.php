<?php $page_selected = 'inscription'; 
session_start();

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/transition.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<header>
    <?php
    include("includes/header.php");
    require 'class/Options.php';
    $options = new Options($db);
    $cursus = $options->cursus_list();
    //var_dump($cursus);
   ?>
</header>
<main id="main-register">
    <div class="container">
        <div class="d-flex justify-content-center">
            <form id="form-register" method="POST" action="php/form_inscription.php">
                <h1 id="form-title"><img src="img/PICT_LOGO_BLACK.png" width="70" height="50" alt="blacl_logo_plateformer_">PLATEFORMER_</h1>
                <h2>Formulaire d'inscription</h2>
                <section>
                    <div class="form-group">
                        <label for="firstname">prénom</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname">nom</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastname">
                    </div>
                    <div class="form-group">
                        <label for="mail">email</label>
                        <small id="emailHelp" class="form-text text-muted">Rejoignez Plateformer_ avec votre adresse email @laplateforme.io</small>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="mail" class="form-control" class="col-xs-4" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">@laplateforme.io</span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Cursus</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="cursus">
                            <option selected>Sélectionner</option>
                            <?php foreach ($cursus as $all_cursus){ ?>
                                <option value="<?= $all_cursus['id_cursus'];?>"><?= $all_cursus['name_cursus'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="check_password">confirmez le password</label>
                        <input type="password" name="check_password" class="form-control" id="check_password">
                    </div>
                </section>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>
<footer>
    <?php
    include("includes/footer.php") ?>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>