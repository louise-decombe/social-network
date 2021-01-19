<?php session_start();

require '../class/Config.php';
require '../class/ClassLangages.php';

$langague = new ClassLangages($db);


if ($_POST["action"] == "enregistrer"){

    if (isset($_POST['valider'])) {
     
        if (!empty($_POST['nom']) && !empty($_FILES) ) {
            //controle de l image et upload
           
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["logo"]["name"];
            $filetype = $_FILES["logo"]["type"];
            $filesize = $_FILES["logo"]["size"];
    
            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");
    
            // Vérifie la taille du fichier - 5Mo maximum
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");
    
            // Vérifie le type MIME du fichier
            if(in_array($filetype, $allowed)){
                // Vérifie si le fichier existe avant de le télécharger.
                if(file_exists("upload/" . $_FILES["logo"]["name"])){
                    echo "La photo existe deja !";
                   
                } 
                else{
                    move_uploaded_file($_FILES["logo"]["tmp_name"], "upload/" . $_FILES["logo"]["name"]);
                    
                    $nom = $_POST['nom'];
                    $image = $_FILES["logo"]["name"];
                    $resultat =$langague->GetCountLangageByName($nom);
                    if ($resultat['nbre'] == 0) {
                        //Le nom n existe pas
                        $langague->RegisterLangage($nom,$image);
                        echo true;

                    }else{
                        echo "le langague existe dejas !";
                    }
                       
                } 
            } else{
                echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
              
            }
        
        }else {
            echo "Tout les champs doivent etre remplis !";
        }
    }

}

if( $_POST['action'] == "recuperation"){
    $resultat = $langague->GetLangage();
    echo json_encode($resultat);
}

if ($_POST['action'] == "recuperation d'un langage"){
    $id = $_POST['id'];
    $resultat = $langague->GetLangageById($id);
    echo json_encode($resultat);
}

if ($_POST['action'] == "delete"){
    $logo = $_POST['logo'];
    $id = $_POST['id'];

    $resultat = $langague->DeleteLangage($id);
    unlink("upload/".$logo);
    echo $resultat;
}

?>