<?php session_start();

require "../class/Config.php";
require "../class/Groupe.php";
require "../class/Membre_groupe.php";

//recuperation des groupes
$groupe = new Groupe($db);
$membre = new Membre_groupe($db);

if ($_POST['action'] == "recuperation"){
    $resultat = $groupe->GetGroupe();
    echo json_encode($resultat);
}

if ($_POST['action'] == "recuperation top groupe"){
    $resultat = $membre->GetTopGroupe();
    echo json_encode($resultat);
}


?>