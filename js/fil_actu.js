$(document).ready(function(){

    //FUNCTIONS
 
    //puis en ajax ==>
            //renger les template et fonction


    //mettre le btn en fixe pour quil suive au scroll + style
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

        $("#form_erreur").empty();
        $("#message").css('border',"none")
        $("#form_erreur").removeClass("alert-danger")
        $(".source").css('color',"#275FA0")

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
                $("#form_erreur").text('Au moins un des deux champs doit etre remplis, message et/ou media');
                $("#message").css('border',"#E66C78 1px solid")
                $("#message").css('border-radius',"10px")
                $("#form_erreur").addClass("alert-danger")
                $(".source").css('color',"#E66C78")
                
                
            }
              
        }
           
    })

    $(document).on("click","#btn_new_post",function(){
        var donnees = JSON.parse(localStorage.getItem('post'));
        console.log(donnees);
        //on enleve le btn
        $("#btn_new_post").detach();

        //on recupere les postes
        if (donnees.length >= 1){
            for (let i = 0 ; i < donnees.length ; i++){
                if (donnees[i][0].type_media == "1"){
                    console.log('affiche image')
                    $("#section_affichage_posts").prepend(templateWithImage(donnees,i))
                }
                else if(donnees[i][0].type_media == "2"){
                    console.log('affiche video')
                    $("#section_affichage_posts").prepend(templateWithVideo(donnees,i));
                }
                else if (donnees[i][0].type_media == "3"){
                    console.log('affiche url')
                    $("#section_affichage_posts").prepend(templatePost(donnees,i));
                }else {
                    console.log('affiche rien')
                    $("#section_affichage_posts").prepend(templatePost(donnees,i));
                }
                
            }
        }
        
        //on supprime la session
        localStorage.removeItem('post');

     
    })
          
   setInterval(NewPosts,5000);

  //auc click sur le btn voir plus
  $(document).on('click',".plus",function(e){
    e.preventDefault();
 
    //recuperation de l id de l article
    var id_post = $(this).attr("id");
 
    //on efface le contenu du p
    $("#p_"+id_post).empty();

    $(".plus_"+id_post).text("");

    var action = "afficher_plus";
     
     //recuperation du contenu grace a son id
    $.ajax({
        url: "php/traitement_posts_admin.php",
        method: "POST",
       
        data: {action: action , id_post: id_post },
        dataType: "json",
        
        success: function(data){
             
            $("#p_"+id_post).append(data[0]);

            $(".plus_"+id_post).text("Voir moins");
            $(".plus_"+id_post).removeClass("plus");
           
            $(".plus_"+id_post).addClass("moins")
            $(".plus_"+id_post).addClass("moins_"+id_post)

            $(".plus_"+id_post).removeClass("plus_"+id_post);
  
        }
    });

  });

  //au click sur le btn voir moins
  $(document).on("click",'.moins',function(e){
    e.preventDefault();
     
    $(this).text("");

    //on recupere le ID du p et son contenu 
    var id_post = $(this).attr('id');

    //tronquage du texte si supp a 200
    if ($("#p_"+id_post).html().length >= 200 ){
        var content = $("#p_"+id_post).html().substr(0, 197)+'...';
    }else {
        var content = $("#p_"+id_post).html();
    }

    //on efface l ancien p et on le remplace
    $("#p_"+id_post).text('');
    $("#p_"+id_post).text(content);

    $(this).addClass('plus');
    $(this).text("Voir plus");
    $(this).removeClass('moins');
    $(this).addClass("plus_"+id_post);
    $(this).removeClass("moins_"+id_post);

  })


});

