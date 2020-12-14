<?php session_start();

require '../class/Config.php';

// A METTRE EN DYNAMIQUE
$id_user = 101;
//  echo json_encode($_POST);
//  echo json_encode($_FILES);

//function
function PictureVerify($name, $type , $size){
    //controle de l image et upload
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png" , "mp4" => "video/mp4" , "mpeg" => "video/mpeg" , "avi" => "video/avi");

    $filename = strtolower($name); //$_FILES["files"]["name"]
    $filetype = $type ; //$_FILES["files"]["type"];
    $filesize = $size; //$_FILES["files"]["size"];

    // Vérifie l'extension du fichier
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)){
        return false;
    }
        // die(json_encode(["erreur"=>"Erreur : Veuillez sélectionner un format de fichier valide.</br>"]));

    // Vérifie la taille du fichier - 50Mo maximum
    $maxsize = 50 * 1024 * 1024;
    
    if($filesize > $maxsize){
        return false;
    } //die(json_encode(["Error: La taille du fichier est supérieure à la limite autorisée.</br>"]));

    // Vérifie le type MIME du fichier
    if(in_array($filetype, $allowed)){
    
        move_uploaded_file($_FILES["files"]["tmp_name"], "upload_media_post/" . $_FILES["files"]["name"]);
        //$image = $_FILES["files"]["name"];
        return true;
    }
    else{
        return false;
    }
}

if (isset($_POST['valider'])){
  

    if (!isset($_POST['action'])) {

        if (!empty($_POST["message"]) || !empty($_FILES['files']['name']) ) { //<== || !empty($_FILES['files']['name'])
            
            if (!empty($_POST["message"])){
                $message = $_POST['message'];
            }
            else{
                $message = NULL;
            }
                  //<==
                
            
           
            
            if (!empty($_FILES['files']['name'])){
                if($_POST['type'] == "photo" || $_POST['type'] == "video"){
               
                    // echo "verifif photo et enregistrement </br>";
        
                    $verification =PictureVerify($_FILES["files"]["name"], $_FILES["files"]["type"] , $_FILES["files"]["size"]);
        
                    if ($verification == true ){
                        $image = $_FILES["files"]["name"];
                       
                        if ($_POST['type'] == "photo" ){
                            $type= 1;
                        }
    
                        if ( $_POST['type'] == "video" ){
                            $type = 2 ;
                        }
                        
                    //    $post->setPost($message,$image,$id_user,$type);
                    //     echo true;
                    }
                    else{
                        echo json_encode(["erreur" => "Probleme de téléchargement de l'image , veuillez imopter une image de type jpg , jpeg , gif , png , mp4 , mpeg, avi et de taille inferieur a 50M" ]);
                    }
        
                    
                }
        
              
            }else{
                $image = NULL;
                $type = 4; //<== null
                //  echo json_encode(["erreur" => " Tout les champs doivent etre remplis !"]);
            }

            $post->setPost($message,$image,$id_user,$type);
            echo true;

        
        }else {
            echo json_encode(["erreur" => " Au moins un des champs doit etre remplis !"]);
        }
    }
            
    

    if(isset($_POST['action'])){
        
        if (!empty($_POST['message']) ||  !empty($_POST['files'])){
            
            if (!empty($_POST['message'])){
                $message = $_POST['message'];
            }
            else{
                $message = NULL;
            }

            if (!empty($_POST['files'])){
                $url = $_POST['files'];
                $type = 3;
            }else{
                $url = NULL;
                $type = 4;  
            }
            
           
           

            //verification url
            if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
                $post->setPost($message,$url,$id_user,$type);
                echo  true;
            }
            else {
                echo json_encode(["erreur" => "URL non valide !"]);
            }

           

        }
        
        if (empty($_POST['files'])){
            echo "false";
        }
    }
   

   
    
    
    
    
    
}





?>