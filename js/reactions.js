$(document).ready(function(){

    $(document).on("mouseenter",".div_icon",function(){
        //on ferme toutes les modales ouvertes
        $(".modale_reaction ").css("display","none");
        $(".span_titre_reaction").css("display","none")
  
        //recuperation des data stocquées dans le btn reactions
        var div =  $(this).attr('data-react');
        $("."+div).css("display","flex");      
      })


    $(document).on("mouseenter",".icon_block",function(){
      
        //On display none les span ouvertes
        $(".span_titre_reaction").css("display","none")
        //on recupere l'id des icones survoler

        let id_reaction = $(this).attr('id');
        $("."+id_reaction).css('display','block');
  
    })


    //au click sur le pouce de base
    $(document).on("click",".div_icon",function(e){
      
        e.preventDefault();
        //recuperation du post
        var idPost = $(this).attr("data-id_post");

       
        $(this).toggleClass("bleu");
        $(this).empty();
        $(this).append('<span class="icon-thumbs-up"></span>J\'aime');
        

        //recuperation de la classe de la modale pour la fermer
        let modale = $(this).attr("data-react");
        $("."+modale).css("display","none");

        let action = "enregistrement";
        
        $.ajax({
            url: 'php/traitement_reactions.php',
            type: "POST",
            data: {action: action, id_post: idPost},

            success:function(data){
              
                //mise a jour des reations
                if (data == 1){
                   //on efface la div et on recupere les nouvelle recations
                  
                   $.ajax({
                       url: 'php/traitement_reactions.php',
                       type: 'POST',
                       dataType: 'JSON',
                       data: {action: 'update_reactions',id_post: idPost},

                       success: function(data){
                      
                           if (data.reaction.length == 0){
                               
                              $(".reactions_miniatures_"+idPost).empty();
                               $(".reactions_miniatures_"+idPost).append('<p class="p_reaction">Soyez le premier à réagir à ce post !</p>')
                           }
                           else {
                                
                                $(".reactions_miniatures_"+idPost).empty();
                                $(".reactions_miniatures_"+idPost).append(templateImagePicto('pouce.png')); 
                           }
                        }
                   })
                }
            }
        })
     
    })
   
    //clique sur une reaction de la modale
    $(document).on("click",".icon_block",function(e){
     
           e.preventDefault();
            var id_post = $(this).attr("data-id_post");
           
            let id_img = $(this).attr("id");
          
            if (id_img == "jadore"){
               var img = "J'adore";
            }
            else if (id_img == "bravo"){
               img = "Bravo";
            }
            else if (id_img == "soutien"){
               img = "Soutien";
            }
            else if (id_img == "instructif"){
               img = "Instructif";
           }
           else if (id_img == "interressant"){
               img = "Interressant";
            }
            else if (id_img == "jaime"){
               img = "J'aime";
            }

            //Changement du texte bleu
           AddStyles(id_post,img);
           $("#section_"+id_post+" .div_icon").addClass('bleu');

           let action= 'enregistrement_reactions';

           $.ajax({
               url: 'php/traitement_reactions.php',
               type: 'POST',

               data: {action: action , id_post: id_post , id_reaction: id_img},

               success:function(data){

                $('.reactions_miniatures_'+id_post).empty();
                $.ajax({
                 url: 'php/traitement_reactions.php',
                 type: 'POST',
                 dataType: 'JSON',
                 data: {action: 'update_reactions',id_post: id_post},
     
                success: function(data){
                    
                    if (data.reaction.length == 0){
      
                        $(".reactions_miniatures_"+id_post).append('<p class="p_reaction">Soyez le premier à réagir à ce post !</p>')
                        $(".div_icon-thumbs-up"+id_post).empty();
                        $(".div_icon-thumbs-up"+id_post).append('<span class="icon-thumbs-up"></span>J\'aime')  
                        $(".div_icon-thumbs-up"+id_post).removeClass('bleu')
                  
                    }
                    else {

                        for (let i = 0 ; i < data.reaction.length ; i++){

                            if(data.reaction[i].id_reactions == 1){
                                $(".reactions_miniatures_"+data.reaction[i].id_post).append(templateImagePicto('pouce.png'))
                            }
                            else if (data.reaction[i].id_reactions==2){
                                $(".reactions_miniatures_"+data.reaction[i].id_post).append(templateImagePicto('bravo.png'))
                            }
                            else if (data.reaction[i].id_reactions==3){
                                $(".reactions_miniatures_"+data.reaction[i].id_post).append(templateImagePicto('soutien.png'))
                            }
                            else if (data.reaction[i].id_reactions==4){
                                $(".reactions_miniatures_"+data.reaction[i].id_post).append(templateImagePicto('jadore.png'))
                            }
                            else if (data.reaction[i].id_reactions==5){
                                $(".reactions_miniatures_"+data.reaction[i].id_post).append(templateImagePicto('instructif.png'))
                            }
                            else if (data.reaction[i].id_reactions==6){
                                $(".reactions_miniatures_"+data.reaction[i].id_post).append(templateImagePicto('interressant.png'))
                            }
                              
                        }
                         
                    }
                }
            })
  
            }
        })

           
    })

    setInterval(fermetureModale,5000)
    //on click pour retirer la modale
   $(document).on("scroll",".main_feed",function(){
       
        $(".modale_reaction").css("display","none")
    });
  
    //au click sur le lien reaction on remplis la div avec toute les personnes qui ont reagis
    $(document).on('click',".reactions_miniatures",function(e){
    e.preventDefault();
    
    let id_post = $(this).attr('data-id_post');

    let action = "Recuperation_Reactions";
    //requete pour allez chercher toutes les reactions
    $.ajax({
        url: 'php/traitement_feed.php',
        type: "POST",
        dataType: "json",
        data: {action: action , id_post: id_post},

        success:function(data){
            $("#section_liste_reactions_"+id_post).empty();
           
            
            if (data.compteur >= 2 ){
                $("#section_liste_reactions_"+id_post).append("<h2>"+data.compteur+" personnes ont réagis à ce post</h2>")
                $("#section_liste_reactions_"+id_post).append("<hr>");
                $("#section_liste_reactions_"+id_post).addClass('section_list')
            }else if (data.compteur == 1) {
                $("#section_liste_reactions_"+id_post).append("<h2>Une personne a réagis à ce post</h2>")
                $("#section_liste_reactions_"+id_post).append("<hr>");
                $("#section_liste_reactions_"+id_post).addClass('section_list')
            }
            
            for (let i = 0 ; i < data.user.length ; i++){
                //////FONCTION OU SWITCH
                if (data.user[i].id_reactions == '1'){
                    $("#section_liste_reactions_"+id_post).append('<div class="reaction_div"><img class="picto_reaction" src="images/pouce.png" /><a href="profile_public.php?id='+data.user[i].id_user+'"><p>'+ data.user[i].firstname + ' ' + data.user[i].lastname +'</p></a></div>')   
                }
                else if(data.user[i].id_reactions == '2'){
                    $("#section_liste_reactions_"+id_post).append('<div class="reaction_div"><img class="picto_reaction" src="images/bravo.png" /><a href="profile_public.php?id='+data.user[i].id_user+'"><p>'+ data.user[i].firstname + ' ' + data.user[i].lastname +'</p></a></div>')
                }
                else if (data.user[i].id_reactions == '3'){     
                    $("#section_liste_reactions_"+id_post).append('<div class="reaction_div"><img class="picto_reaction" src="images/soutien.png" /><a href="profile_public.php?id='+data.user[i].id_user+'"><p>'+ data.user[i].firstname + ' ' + data.user[i].lastname +'</p></a></div>')    
                }
                else if (data.user[i].id_reactions == '4'){    
                    $("#section_liste_reactions_"+id_post).append('<div class="reaction_div"><img class="picto_reaction" src="images/jadore.png" /><a href="profile_public.php?id='+data.user[i].id_user+'"><p>'+ data.user[i].firstname + ' ' + data.user[i].lastname +'</p></a></div>')    
                }
                else if (data.user[i].id_reactions == '5'){
                    $("#section_liste_reactions_"+id_post).append('<div class="reaction_div"><img class="picto_reaction" src="images/instructif.png" /><a href="profile_public.php?id='+data.user[i].id_user+'"><p>'+ data.user[i].firstname + ' ' + data.user[i].lastname +'</p></a></div>')
                }
                else if (data.user[i].id_reactions == '6'){
                    $("#section_liste_reactions_"+id_post).append('<div class="reaction_div"><img class="picto_reaction" src="images/interressant.png" /><a href="profile_public.php?id='+data.user[i].id_user+'"><p>'+ data.user[i].firstname + ' ' + data.user[i].lastname +'</p></a></div>')
                }

                //on supprime le btn si il existe deja
                $(".btn_close").detach();                    
                $("#section_"+id_post).append('<button class="btn_close" data-btn_id_post="'+id_post+'">Reduire</button>')
                }
            }

        })
    })


    //ajout de commentaire
    $(document).on('click','.icon-c',function(){

   
        //recuperation de l'id du post
        let id_post = $(this).attr("data-id_post");

        //creation du form
        $("#formulaire_ajout_commentaire_"+id_post).empty();
        $("#formulaire_ajout_commentaire_"+id_post).append(TemplateFormCommentaire(id_post))
    
        //focus sur l input
        $("#comm_"+id_post).focus();

        $(".btn_close").detach();                    
        $("#section_"+id_post).append('<button class="btn_close" data-btn_id_post="'+id_post+'">Reduire</button>')

        //ajout des commentaires si il y en a 
        $.ajax({
            url: 'php/traitement_formulaire_commentaire.php',
            type: 'POST',
            dataType: "JSON",
            data: {action:'recuperation commentaire',id_post: id_post},

            success:function(data){

                if (data.length != ""){
                
                    for (let i = 0 ; i < data.length ; i++){
                    
                        $("#formulaire_ajout_commentaire_"+id_post).append(templateCommentaire(data,i));
                    }
                }
            }
        })

    

    $(document).on('keyup',"#comm_"+id_post,function(){
    
        //on recupere la valeur de l'input
        let commentaire = $("#comm_"+id_post).val();
    
        if (commentaire != ""){
            //on affiche le btn
            $(".btn_form_comm").addClass('block')
        }
        else {
            $(".btn_form_comm").removeClass('block')
        }

    })

    $(document).on("click",".btn_form_comm",function(e){
       
        var btn = $(".btn_form_comm").val();
        let commentaire = $("#comm_"+id_post).val();
        e.preventDefault();
        $.ajax({
            url: 'php/traitement_formulaire_commentaire.php',
            type: 'POST',
            data: {enregistrer: btn, commentaire: commentaire , id_post: id_post},

            success:function(data){
               
                if (data == 1 ){
                    //on reinitialise le form
                    $("#comm_"+id_post).val('');
                   
                    //on enleve le btn
                    $(".btn_form_comm").removeClass('block')

                    //on va recupere le postv et affichage
                    $.ajax({
                        url: 'php/traitement_formulaire_commentaire.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {action: 'update_commentaires',id_post: id_post},

                        success:function(data){
                           $("#formulaire_ajout_commentaire_"+id_post).empty();

                           for (let i = 0 ; i < data.length ; i++){
                            $("#formulaire_ajout_commentaire_"+id_post).append(templateCommentaire(data,i));
                           }

                           //mise a jour du nombre de commentaires
                           $(".p_commentaires_"+id_post).empty();
                           $(".p_commentaires_"+id_post).append(data.length+" commentaire(s)")
                        
                        }
                    })
                    
                }
            }
        })
    })
    
})

    //au click sur les commentaires
    $(document).on('click','.p_commentaires',function(){
   
        //on recupere l id du poste
        let id_post = $(this).attr('data-id_post');
   
        $.ajax({
            url: 'php/traitement_feed.php',
            type: 'POST',
            dataType: "JSON",
            data: {action: 'Recuperation_commentaires',id_post: id_post},

            success: function(data){
                
                $("#formulaire_ajout_commentaire_"+id_post).empty();
                if (data !== ""){
                    for (let i = 0 ; i < data.length ; i++){
                        $("#formulaire_ajout_commentaire_"+id_post).append(templateCommentaire(data,i));
                        
                    // Si le btn existe
                    $(".btn_close").detach();  
                    $("#section_"+id_post).append('<button class="btn_close" data-btn_id_post="'+id_post+'">Reduire</button>')
                    } 
                }
            }

        })
    
    })

   
    //affichage du menu signal post
    $(document).on('click',".menu_signal",function(){
        //on recupere l id
        let id_post = $(this).attr('data-id_post');
        $(".div_signal_"+id_post).toggleClass('block');

    })

    //affichage du menu signal commentaire
    $(document).on('click','.sous_menu_signal',function(){
        //on recupere l id
        let id_position = $(this).attr('data-position');
        $(".sous_div_signal_"+id_position).toggleClass('block');
    })



    //gestion signal post
    $(document).on('click',".div_signal",function(e){
        e.preventDefault();
        //recuperation id post
        let id_post = $(this).attr('data-id_post');
    
        $.ajax({
            url: 'php/traitement_reactions.php',
            type: 'POST',
            data: { action: 'signal' , id_post: id_post},

            success: function(data){
                if (data == 1 ){
                    $(".div_signal_"+id_post).removeClass('block');
                }else {
                    $(".div_signal_"+id_post).removeClass('block');
                }
            }
        })
    })

    //gestion signal commentaire
    $(document).on('click',".sous_div_signal",function(e){
        e.preventDefault();

        //recuperation id post
        let id_post = $(this).attr('data-id_comm');

        $.ajax({
            url: 'php/traitement_reactions.php',
            type: 'POST',
            data: { action: 'signal commentaire' , id_comment: id_post},

            success: function(data){
                $(".sous_div_signal").removeClass('block')
            }
        })
    })

    // fermeture de la section reaction et commentaires
    $(document).on('click','.btn_close',function(){
        let id_post = $(this).attr('data-btn_id_post');


        //On efface efface le contenu de la section
       
            // $("#section_liste_reactions_"+id_post).empty();
            // $("#formulaire_ajout_commentaire_"+id_post).empty();
            $("#section_liste_reactions_"+id_post).removeClass('section_list')
            // $(".btn_close").detach();
    })

})