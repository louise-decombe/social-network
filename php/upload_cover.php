<?php
session_start();
try
{

$connexion=new PDO("mysql:host=localhost;dbname=social-network",'root','');
$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


/*----------------------------------------------------*/
/* UPLOAD COVER 
------------------------------------------------------ */

    // Vérifie si le fichier a été uploadé sans erreur.
    if(isset($_FILES["cover"]) && $_FILES["cover"]["error"] == 0 && empty($_FILES["photo"])){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["cover"]["name"];
        $filetype = $_FILES["cover"]["type"];
        $filesize = $_FILES["cover"]["size"];
        $id_user = $_POST["id_user"];

        // Vérifie l'extension du fichier
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");

        // Vérifie la taille du fichier - 5Mo maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

        // Vérifie le type MIME du fichier
        if(in_array($filetype, $allowed)){
            // Vérifie si le fichier existe avant de le télécharger.
            if(file_exists("upload_cover/" . $_FILES["cover"]["name"])){
                echo $_FILES["cover"]["name"] . " existe déjà.";
            } else{
                move_uploaded_file($_FILES["cover"]["tmp_name"], "upload_cover/" . $_FILES["cover"]["name"]);
               //var_dump($_FILES);
                echo "Votre fichier a été téléchargé avec succès.";
                
                $file_path_cover="upload_cover/" . $_FILES["cover"]["name"];

               // "UPDATE utilisateurs SET cover='$file_path'"; //ajouter id utilisateur
               $update_cov = "UPDATE users SET cover=:cover WHERE id= $id_user ";
               $update_cover= $connexion -> prepare($update_cov);
               $update_cover->bindParam(':cover',$file_path_cover, PDO::PARAM_STR);
               //$update_pic->bindParam(':id',$id_user, PDO::PARAM_INT);
               $update_cover->execute(); 

               header('location:../profile.php');
                
            } 
        } else{
            echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
        }
    } else{
        echo "Error: " . $_FILES["cover"]["error"];
    }
}


catch (PDOException $e)
        {
        echo "Erreur : " . $e->getMessage();
        }



?>
