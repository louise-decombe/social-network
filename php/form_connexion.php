<?php

require '../class/Config.php';

if(isset($_POST['submit'])){

    // on fait appel à la class user pour enregistrer les infos passées dans le formulaire
    $connect_user = $user->connect($_POST['mail'], $_POST['password']);

};

?>