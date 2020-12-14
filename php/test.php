<?php

if (isset($_POST['valider'])){

    if (!empty($_POST["message"]) && !empty($_FILES['files']['name']) ){
      
        $message = $_POST['message'];

        //controle de l image et upload
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png" , "mp4" => "video/mp4" , "mpeg" => "video/mpeg" , "avi" => "video/avi");

      
        
        $filename = strtolower($_FILES["files"]["name"]);
        $filetype = $_FILES["files"]["type"];
        $filesize = $_FILES["files"]["size"];

        // Vérifie l'extension du fichier
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed))die(json_encode(["erreur"=>"Erreur : Veuillez sélectionner un format de fichier valide.</br>"]));

        // Vérifie la taille du fichier - 50Mo maximum
        $maxsize = 50 * 1024 * 1024;
         
        if($filesize > $maxsize) die(json_encode(["Error: La taille du fichier est supérieure à la limite autorisée.</br>"]));
        
        // Vérifie le type MIME du fichier
        if(in_array($filetype, $allowed)){
          
            move_uploaded_file($_FILES["files"]["tmp_name"], "upload_media_post/" . $_FILES["files"]["name"]);
            $image = $_FILES["files"]["name"];
                
            // Enregistrement
         
             $post->setPost($message,$image,$id_user);
            echo json_encode(["success"=> "Message Postée !"]); 
            //header("location: ../fil_actu.php");
            
        } else{
               
            echo json_encode(["erreur"=> "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.</br>"]); 
          
        }
    
    
    }else {
        //url renseignée
        if (isset($_POST['action']) && $_POST['action'] == "url" && !empty($_POST['message'])){
           
            $url = $_POST['files'];
            $message = $_POST['message'];

            //verification de l'url
            if (!filter_var($url, FILTER_VALIDATE_URL) === false){
              
                $post->setPost($message,$url,$id_user);
                echo true;
            }else{
                echo json_encode(["erreur" => "Tout les champs doivent etre remplis !"]);
            }
        }else{
           
            echo json_encode(["erreur" => "Tout les champs doivent etre remplis !"]);
        }
        
       
        
    }

   

    
}

// :::::: js

    //On click sur le picto et on recupere le texte de l'input
    $(".source").click(function(){
        $("#label").empty()
        $("#toto").empty()
        var id = this.id;
       
        if (id == "photo"){
            ChangeInputForm("#files","file","image/png , image/jpg , image/jpeg , image/gif ",'Votre image')
        }

        if (id == "video"){
            ChangeInputForm("#files","file","video/mp4 , video/mpeg , video/avi",'Votre video')
        }

        if (id == "url"){
            ChangeInputForm("#files","url","",'Votre url')
        }

        $(".div_form").css('display',"flex");
         

         //remet a zero le message d erreur
        $("#message_post").empty();
        
        //Enregistrement du post sans rechargement de la page
        //si enregistrement photo ou video
        
        if (id === "photo" ){
            $("#btn_valider").click(function(e){
                e.preventDefault();
               
                
                
                RegisterPost();
                $(".div_form").css('display','none');
                
                //$("#form_post")[0].reset();
            });
        }
        if ( id === "video" ){
            $("#btn_valider").click(function(e){
                e.preventDefault();
                $("#message_post").empty();
                
                RegisterPost();
                $(".div_form").css('display','none');
            });
        }
        if ( id === "url"){
            console.log('url pp');
            $("#btn_valider").click(function(e){
               e.preventDefault();
               $("#message_post").empty();


                registerPostUrl();
                // $("#form_post")[0].reset();
           
              $(".div_form").css('display','none');
            });
        }
       


    })



 
?>