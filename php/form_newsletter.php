<?php
session_start();
require '../class/Config.php';

/*----------------------------------------------------*/
/* NEWSLETTER - ENREGISTREMENT EMAIL
------------------------------------------------------ */
if (isset($_POST['email_newsletter']) && !empty($_POST['email_newsletter'])){

    $email_newsletter = $_POST['email_newsletter'];
    // on fait appel à la class user pour enregistrer les infos passées dans la table newsletter
    $register_newsletter = $user->newsletter($email_newsletter);

}
     
?>