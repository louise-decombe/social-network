<?php include('class/Config.php'); ?>



    <?php
    if($page_selected == ('index_1') OR $page_selected == ('connexion') OR $page_selected == ('inscription') ){
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

    <?php }; ?>



