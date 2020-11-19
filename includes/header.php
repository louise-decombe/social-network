<?php include('class/Config.php'); ?>

<header>
    <?php
    if($page_selected = 'connexion'){
    ?>

    <nav class="navbar navbar-dark" style="background-color: #000000;">
        <a class="navbar-brand" href="index.php">
            <img src="img/PICT_LOGO_WHITE.png" width="30" height="30" class="d-inline-block align-top" alt="white_logo_plateformer_" loading="lazy">
            Plateformer_
        </a>
        <ul id="nav-forms">
            <li><a class="link-navbar" href="inscription.php">s'inscrire</a></li>
            <li><div class="vl"></div></li>
            <li><a class="link-navbar" href="connexion.php">se connecter</a></li>
        </ul>
    </nav>

    <?php }; ?>
 
</header>


