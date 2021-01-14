$(document).ready(function(){
     /////////////////////////////////////////////////////////////////////////////
    //////////////////////// GENERAL ///// ///////////////////////////////////////
    

     //rafraichissemnt des alert
     setInterval(CountSignal, 10000); //15 secondes

     //fermeture de la modale
    $(document).on("click",".icon-cancel",function(){
        $("#modale").css("display","none");
    })

     //au click sur la cloche
     $("#signalement").click(function(e){
        e.preventDefault();
        ChangementDePage("admin_posts.php","signal");
    })

    /////////////////////////////////////////////////////////////////////////////
    //////////////////////// PARTIE USERS ///////////////////////////////////////
    

    //recuperation de tout les users
    On_load_data();

    //suppression user
    $(document).on('click','.supp',clickOnbtnSupp);

    //upgrade user
    $(document).on("click",'.upgrade', OnclickUpgrade);

    //filtration des users
    $(document).on('change',"#selection", OnChangeInputSelect)

    //empeche l envois du form avec la touche entree
    $(document).on("keydown","#search_users_admin",function(e){
        if(e.keyCode == 13) { // KeyCode de la touche entrée
            e.preventDefault(); 
           
         }
    })

    //changement de page
    $("#utilisateurs").click(function(e){
        e.preventDefault();
        $("table").empty();
        $(".titre_admin").text("Utilisateurs");
       ChangementDePage("admin_users.php","users");
        
    })

    //lance la recherche
    $(document).on("keyup", "#search_users_admin",OnkeyUpSearch);
    $("#search_users_admin").val("");

     /////////////////////////////////////////////////////////////////////////////
    //////////////////////// PARTIE POSTS ///////////////////////////////////////


    //changemenet de page en fonction du click sur la nav barre
    $("#posts").on("click",function(){
        ChangementDePage("admin_posts.php","post");
        
    })

    //recup post signaler///////// ===>
    $(document).on("click",'#signal_posts',function(){
        ChangementDePage("admin_posts.php","signal");
    })

    //sup post signalé
    $(document).on("click",".supp_post",clickOnbtnSupp);

    //enlever un post signalé
    $(document).on("click",".annuler_signal",OnclickBtnRestaure)

     /////////////////////////////////////////////////////////////////////////////
    //////////////////////// PARTIE COMMENT ///////////////////////////////////////

    //supp comment signalé
    $(document).on("click",".supp_comment",clickOnbtnSupp);

    //recuperation du commentaire entier
    $(document).on('click',"#voir_comment",function(){
        
      var id_comment = $("#voir_comment").val();

     
        $.ajax({
            url: "php/traitement_posts_admin.php",
            data: {action: "recuperation d'un commentaire",id: id_comment},
            method: "POST",
            dataType: "json",

            success: function(data){
                $("#modale").css("display","flex");
                
                $("#action_alert").append("<div class='comment_affichage' ><p>"+data.content+"</p><button id='fermeture_pop'>Fermer</button></div>");
                $(document).on("click","#fermeture_pop",function(){
                    $("#modale").css("display","none");
                    $("#action_alert").empty();
               })
            }
        })
       
    })

   
     /////////////////////////////////////////////////////////////////////////////
    //////////////////////// PARTIE SIGNALEMENT ///////////////////////////////////////
    

    //changement page signalements
    $("#btn_signal").click(function(e){
        e.preventDefault();
        ChangementDePage("admin_posts.php","signal");
    })

    $(document).on('click','.voir_post',function(){

        var genre = $(this).attr('data-genre');
        //on recupere l'id du post
        var id_post = $(this).attr('data-id');
        $("#page").empty();
        
        if (genre == "post") {
            $.ajax({
                url: 'php/traitement_posts_admin.php',
                type: 'POST',
                dataType: "JSON",
                data: {action:"affichage post signalé" , id:id_post},
    
                success: function(data){
                    //on recupere le contenue du post ainsi que le media
                    console.log(data);
                
                    
                    if (data[0].type_media == 1 ) {
                       var media = `<img class="img_signal" src="php/upload_media_post/${data[0].media}" />`;
                    }
                    else if (data[0].type_media == 2){
                        var media = `<video controls width="250">
                                    <source src="php/upload_media_post/${data[0].media}">
                                </video>`;
                    }else {
                        var media = ``;
                    }
    
                    console.log(media);
                    
                    $("#page").append("<p class='p_post_signal'>"+data[0].content+"</p>");
                    $("#page").append(media);
                    $("#page").append("<button id='fermeture_post_signal'>Fermer</buuton>");
                }
            })
        }
        if (genre == "comment"){
           console.log('toto')
            $.ajax({
                url: 'php/traitement_posts_admin.php',
                type: 'POST',
                dataType: "JSON",
                data: {action:"affichage comment signalé" , id:id_post},
    
                success: function(data){
                    console.log(data);
                    $("#page").append("<p class='p_post_signal'>"+data.content+"</p>");
                    $("#page").append("<button id='fermeture_post_signal'>Fermer</buuton>");
                }
            })

        }
        
    })

    $(document).on('click',"#fermeture_post_signal",function(){
        $("#page").empty();
        ChangementDePage("admin_posts.php","signal");
    })



    /////////////////////////////////////////////////////////////////////////////
    //////////////////////// PARTIE LANGAGE /////////////////////////////////////

    //changement de page ==> langage
    $("#langages").click(function(){
        ChangementDePage("admin_langage.php","langage");
    })

    //effacer langage
    $(document).on("click",".supprimer",function(){
        let id_langage = $(this).attr('id');
        let logo = $(this).attr("data-image");
        DeleteLangage(id_langage,logo);
    })
    
    //affichage du formulaire
    $(document).on("click","#add_langage",function(){
        $("#formlangage").css("display","block");
        $("#add_langage").css("display","none");
    })

    //FORM langage
    $(document).on("click","#btn_valider",function(e){
        e.preventDefault();
        let nom = $("#nom_langage").val();
        RegisterLangage(nom);
    })

    //fermeture du formulaire langague
    $(document).on('click','#boutton_fermer_form',function(e){
        e.preventDefault();
        $("#formlangage").css("display","none");
        $("#add_langage").css('display',"block");
        $("#message_admin").empty();
        $("#message_admin").removeClass("alert");
    })

    /////////////////////////////////////////////////////////////////////////////
    //////////////////////// PARTIE CURSUS //////////////////////////////////////

    //changement de page ==> cursus
    $("#cursus").click(function(){
        //recuperation des cursus
        ChangementDePage("admin_cursus.php","cursus")
        
        

    })
    //ajout cursus
    $(document).on('click', "#btn_submit",function(e){
        e.preventDefault();
        insertCursus();
    })
    //mise a jour de cursus
    $(document).on('click','.update_cursus',function(e){
        e.preventDefault();
        var id_btn = $(this).attr('data-cursus');
        $("#modale").css("display","flex");
        
        //recuperation du nom du cursus pour la mise a jour
        let action= "recuperation cursus par l'id";
        $.ajax({
            url: "php/traitement_cursus_admin.php",
            data: {id: id_btn, action: action},
            method: "POST",
            dataType: "json",

            success: function(data){
                $("#action_alert").empty();
                $("#action_alert").append(FormUpdtate(data));
                 //modification BDD
                $(".btn_update_cursus").click(function(e){
                    e.preventDefault();
                    let btn_update_cursus = $(".btn_update_cursus").val();
                    let valeur_input = $("#updtate_nom_cursus").val();
                    
                   UpdateCursus(data.id_cursus,btn_update_cursus,valeur_input);
                })
            }
        })
       
    })
 
    //suppression cursus
    $(document).on("click",".delete_cursus",function(){
        var id_cursus = this.id;
        
        $("#action_alert").append(formConfirmation("cursus"));
        $("#modale").css("display","flex");
        deleteCursus(id_cursus);
    })


});