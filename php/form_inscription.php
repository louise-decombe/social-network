<?php

require '../class/Config.php';

if(isset($_POST['submit'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $mail = $_POST['mail'];
    $cursus = $_POST['cursus'];
    $password = $_POST['password'];
    $check_pass = $_POST['check_password'];
  

    // on fait appel à la class user pour enregistrer les infos passées dans le formulaire
    $new_user = $user->register($firstname, $lastname, $mail, $cursus, $password, $check_pass);

};

?>