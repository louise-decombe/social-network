<?php

require "../class/Config.php";




    // recuperation users
    if ($_POST['action'] == "recuperation"){
        $users = $user->GetUsers();
        echo json_encode($users);
    }


    // // //suppr user
    if ($_POST['action'] == "supprimer"){
        $id_user = $_POST['id'];
        //requete de suppression
        $user->DeletUser($id_user);

        echo true;
    }

    // //upgrade
    if($_POST['action'] == "upgrade"){
    
            $id_user = $_POST['id'];
            $droit = $_POST['statut'];
            $user->Upgrade_statut($id_user,$droit);
            return true;
        
    }

    //Filtration
    if($_POST['action'] == "filtre"){
        
        if ($_POST['donnee'] == "utilisateur" || $_POST['donnee'] == "administrateur" ){

            $filtre = "droits";
            $donnee = $_POST['donnee'];
            $result = $user->GetUserBy($filtre,$donnee);
            
            echo json_encode($result);
        }
        else if ($_POST['donnee'] == "ORDER BY") {
            $filtre = "ORDER BY";
            $donnee = "lastname";
            $result = $user->GetUserBy($filtre,$donnee);
            
            echo json_encode($result);
        }
        else if ($_POST['donnee'] == "tout"){
            $result = $user->GetUsers();
            echo json_encode($result);
        }

    }



?>