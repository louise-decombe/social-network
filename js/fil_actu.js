$(document).ready(function(){

    //FUNCTIONS

    
    //GESTION AFFICHAGE EN CAS ERREUR FORMULAIRE
    // voir pour la librairie pour les url
    //GERER AFFICHAGE POSTE SI CONTENT ==> NULL 
    // ajouter les picto en bas de l image
    //changer le chanmps toto
    //VOIR POST FAIT PAR LE USER CA MARCHE PAS
    
   

  
    //VIDER LE TEXTAREA 
    $("#message").blur( function(){
        if ($("#message").val()== "")
        {
            $("#message").val("De quoi souhaitez-vous discuter ?") ;
        }
    });

    $("#message").focus(function(){
        if ($("#message").val() == "De quoi souhaitez-vous discuter ?")
        {
            $("#message").val("");
        }
    });
   
 
    //FERMETURE DE LA MODALE
    $("#form_close").click(function(){
        $("#modale2").css("display","none")
    })

    //formulaire de post
    $("#btn_form_form").click(function(){

        $("#modale2").css("display","block");

        $(".source").click(function(){
            // recuperation de l'id des pictos
            var id = $(this).attr("id");
           
            if ( id == "photo"){
                console.log("photo")
                SavePost(CreateForm("Vote image","file","photo","image/png , image/jpg , image/jpeg , image/gif "))
            }
            else if ( id == "video" ){
                console.log("video")
                SavePost(CreateForm("Votre vidéo","file","video","video/mp4 , video/mpeg , video/avi"))
             }
            else{
                console.log("url")
                SavePost(CreateFormUrl())
            }
        })
    })
 
     
 
    //bouton valider
    $("#btn_valider").click(function(e){
        e.preventDefault();

        //Si message different du placeholder du textarea
        if ($("#message").val() !== "De quoi souhaitez-vous discuter ?"){
            //si pas vide
            if ($("#message").val() !== ""){
                
                // enrigistrement en fonction du media 
                if ( $("#type_media").val() === "photo" || $("#type_media").val() === "video"){
                    
                    RegisterPost();  
                    
                }
                else if  ($("#type_media").val() === "url"){
                    registerPostUrl()
                }
                else {
                    RegisterPost();  
                }
                    
            }else{
                console.log('vide')
                   
            }
        }else{
            //SI MESSAGE VIDE MAIS IMAGE OK
            console.log($("#files").val());
            if ($("#message").val() == "" || $("#message").val() == "De quoi souhaitez-vous discuter ?" && $("#files").val() !== undefined ){
                console.log("message vide mais image ok")
                $("#message").empty();
                if ( $("#type_media").val() === "photo" || $("#type_media").val() === "video"){
                    RegisterPost(); 
                } else if  ($("#type_media").val() === "url"){
                    registerPostUrl()
                }
                else {
                    RegisterPost();  
                }
            }else {

                // console.log("au moins un des deux champs doit etre remplis");
               
            }
              
        }
           
    })
          

});