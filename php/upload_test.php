<?php
session_start();
extract($_POST);
extract($_FILES);

var_dump($_POST);
var_dump($_FILES);


try
{

$connexion=new PDO("mysql:host=localhost;dbname=social-network",'root','root');
$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    if(isset($_POST["photo"]) && !empty($_POST["photo"]) && isset($_POST['id_user']) && !empty($_POST['id_user'])){

    $id_user = $_POST["id_user"];
    $photo = $_POST["photo"];
    $file_path="upload/" . $photo;
    //$filesize = $_POST['size'];
    //$filetype= $_POST['type'];

        //$_FILES["photo"];
    // Vérifie si le fichier a été uploadé sans erreur.
var_dump($_FILES);
   
                move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $photo);
                echo "fichier";
                
                $file_path="upload/" . $photo;
               

                //récupérer le chemin du serveur soit avec une super globale SERVER ou le taper en dur*/

               $update_image = "UPDATE users SET photo=:photo WHERE id= $id_user ";
               $update_pic= $connexion -> prepare($update_image);
               $update_pic->bindParam(':photo',$file_path, PDO::PARAM_STR);
               //$update_pic->bindParam(':id',$id_user, PDO::PARAM_INT);
               $update_pic->execute(); 

               
               //echo 'photo';
    }
        
        
}


catch (PDOException $e)
        {
        echo "Erreur : " . $e->getMessage();
        }



?>