<?php

require "../class/Config.php";

//mettre une condition pour ne pas avoir ce resultat tout le temps
// recuperation users
$users = $user->GetUsers();
echo json_encode($users);

//suppr user
if ($_POST['action'] === "supprimer"){
    //requete de suppression
}



?>