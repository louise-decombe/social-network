$(document).ready(function(){

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
                SavePost(CreateForm("Vote image","file","photo","image/png , image/jpg , image/jpeg , image/gif "))
            }
            else if ( id == "video" ){
                SavePost(CreateForm("Votre vidéo","file","video","video/mp4 , video/mpeg , video/avi"))
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
                
                RegisterPost();         
            }
        }else{
            //SI MESSAGE VIDE MAIS IMAGE OK
            if ($("#message").val() == "" || $("#message").val() == "De quoi souhaitez-vous discuter ?" && $("#files").val() !== undefined ){
                $("#message").empty();
                RegisterPost(); 

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
        $(".p_default").empty();
        //on enleve le btn
        $("#btn_new_post").detach();


        //on recupere les posts
        if (donnees != null && donnees.length >= 1){
            for (let i = 0 ; i < donnees.length ; i++){
                if (donnees[i][0].type_media == "1"){
                    $("#section_affichage_posts").prepend(templatesPosts(donnees,i,`<div class="media">
                    <img src="php/upload_media_post/${donnees[i][0].media}" ?>
                    </div>`))
                }
                else if(donnees[i][0].type_media == "2"){
                    $("#section_affichage_posts").prepend(templatesPosts(donnees,i,`<div class='media'>
                    <video  controls src="php/upload_media_post/${donnees[i][0].media}">Ici la description alternative</video>
                    </div>`));
                }
                else {

                    $("#section_affichage_posts").prepend(templatesPosts(donnees,i,''));
                }
                
            }
        }
        
        //on supprime la session
        localStorage.removeItem('post');

        //on remonte en haut de la section
        $('#section_affichage_posts').animate({scrollTop: 0}, 'slow');

        //on efface le message de success
        $("#formulaire_post").empty();

     
    })
    
    
  setInterval(NewPosts,5000);

  //auc click sur le btn voir plus
  $(document).on('click',".plus",function(e){
      console.log('ici');
    e.preventDefault();
 
    //recuperation de l id de l article
    var id_post = $(this).attr("id");
    console.log(id_post);
   
    

    //$(".plus_"+id_post).text("");

    var action = "afficher_plus";
     
     //recuperation du contenu grace a son id
    $.ajax({
        url: "php/traitement_posts_admin.php",
        method: "POST",
       
        data: {action: action , id_post: id_post },
        dataType: "json",
        
        success: function(data){
            //on efface le contenu du p
            $("#p_"+id_post).empty();
            $("#p_"+id_post).append(data[0]);
            $("#p_"+id_post).append("<a class='moins moins_"+ id_post+" ' id='"+id_post+"'>Voir moins ...</a>")

            //au click sur le btn voir moins
            $(document).on("click",'.moins',function(e){
                e.preventDefault();

                $(this).text("");

                //on recupere le ID du p et son contenu 
                var id_post = $(this).attr('id');
    
                // on vide le p
                $("#p_"+id_post).empty();

                //tronquage du texte si supp a 400
                if (data[0].length >= 400 ){
                    var content = data[0].substr(0, 397)+'...';
                }else {
                    var content = data[0];
                }
    
                //on efface l ancien p et on le remplace
                $("#p_"+id_post).text(content);

                $("#p_"+id_post).append("<a class='plus plus_"+ id_post+" ' id='"+id_post+"'>... Voir plus </a>")
            })



  
            }
        });

    });

         
   
    var limit = 0;
    //btn voir plus de posts
    $(document).on("click","#More_post",function(){
      
      limit = limit + 5;
     
      $("#More_post").detach();
      let data = "More_post";
      $.ajax({
          url : "php/traitement_feed.php",
          type: "POST",
        dataType: "json",
          data: {action: data ,limit : limit},

        success: function(data){
          console.log(data);
             for (let i = 0 ; i < data.post.length ; i++){
                
                var bool = false;
                for (let j = 0 ; j < data.reaction.length ; j++){
                    
                    if (data.post[i].id_post == data.reaction[j].id_post){
                        var react = PictoReactions(data,j)
                        if (data.post[i].id_user == data.reaction[j].id_user){
                            bool = true;
                        }    
                    }
                }

                if (bool == true){
                    let classe = "bleu";
                    AffichagePostReaction(data,i,classe,react)
                    
                }else {
                    let classe = "";
                    let react = "J'aime";
                    AffichagePostReaction(data,i,classe,react)
                }
                
                for (var c = 1 ; c <= 6 ; c++){

                    
                    if (data.tableau[data.post[i].id_post][c][0].nbr != 0){
                        var bool2 = true;
                        if(c == 1){
                            $(".reactions_miniatures_"+data.post[i].id_post).append(templateImagePicto('pouce.png'))
                        }
                        else if (c==2){
                            $(".reactions_miniatures_"+data.post[i].id_post).append(templateImagePicto('bravo.png'))
                        }
                        else if (c==3){
                            $(".reactions_miniatures_"+data.post[i].id_post).append(templateImagePicto('soutien.png'))
                        }
                        else if (c==4){
                            $(".reactions_miniatures_"+data.post[i].id_post).append(templateImagePicto('jadore.png'))
                        }
                        else if (c==5){
                            $(".reactions_miniatures_"+data.post[i].id_post).append(templateImagePicto('instructif.png'))
                        }
                        else if (c==6){
                            $(".reactions_miniatures_"+data.post[i].id_post).append(templateImagePicto('interressant.png'))
                        }

                    }
  
                }

                if (bool2 !== true){
                    $(".reactions_miniatures_"+data.post[i].id_post).append('<p class="p_reaction" >Soyer le premier a réagir a ce post !</p>')
                }

                $(".p_commentaires_"+data.post[i].id_post).append(data.compteurCommenatires[i]+" commentaire(s)")

            }
                   
            if (data.post.length == 5){
                $("#section_affichage_posts").append(" <button id='More_post'>Voir plus</button>")
            }
                     
        }
          
        })
    })

    //affichage du menu signal
   $(document).on('click',".menu_signal",function(){
       
       //on recupere l id
       let id_post = $(this).attr('data-id_post');
        $(".div_signal_"+id_post).toggleClass('none');
        
   })

   $(document).on('click','.sous_menu_signal',function(){

       //on recupere l id
       let id_position = $(this).attr('data-position');
        $(".sous_div_signal_"+id_position).toggleClass('none');
   })

   //gestion signal
   $(document).on('click',".div_signal",function(e){
        e.preventDefault();
       
       //recuperation id post
       let id_post = $(this).attr('data-id_post');
       
       $.ajax({
           url: 'php/traitement_reactions.php',
           type: 'POST',
           data: { action: 'signal' , id_post: id_post},

           success: function(data){
                $(".div_signal_"+id_post).addClass('none');
           }
       })
   })

   $(document).on('click',".sous_div_signal",function(e){
    e.preventDefault();
   

   //recuperation id post
   let id_post = $(this).attr('data-id_comm');
   
   $.ajax({
        url: 'php/traitement_reactions.php',
        type: 'POST',
        data: { action: 'signal commentaire' , id_comment: id_post},

        success: function(data){
            $(".sous_div_signal").addClass('none')
        }
   })
})

// fermeture de la section reaction et commentaires
$(document).on('click','.btn_close',function(){
    let id_post = $(this).attr('data-btn_id_post');


    //On efface efface le contenu de la section
    $("#section_liste_reactions_"+id_post).empty();
    $("#formulaire_ajout_commentaire_"+id_post).empty();
   // $("#section_liste_reactions_"+id_post).removeClass('section_list');
    $(".btn_close").detach();
})

//affichage menu mobile
$(".btn_nav_bar_mobile").click(function(){
    $(".feed").css('display',"none"); 
    $( ".section_perso_mobile" ).fadeIn( "slow", function() {
        // Animation complete
        $(".section_perso_mobile").toggleClass('block');
       
      });
    
})

    // Fermeture menu mobile
    $(".btn_nav_bar_mobile_fermeture").click(function(){
        $( ".section_perso_mobile" ).fadeOut("slow",function(){
            $(".section_perso_mobile").toggleClass('block');
            $(".feed").css('display',"block"); 
        })
    console.log('ok')
    })
});

