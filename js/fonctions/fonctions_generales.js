function On_load_data(){
     
    CountSignal();
    $("#tbody").empty();
        
    $.ajax({
        url : "php/traitement_users_admin.php",
        data: {action: "recuperation"},
        method: "POST",
        dataType: "json",

        success: function(data){
            if(data.length != 0){
                let donnee = "initialisation";
                for ( let i = 0 ; i < 6 ; i++){
                    $("#tbody").append(tableau(donnee,data,i));
                }
                pagination(data);
                   
            }
            if(data.length === 0){
                $("#tbody").empty();
                $("#tbody").append("<tr class='text-center'><td colspan = 5 >Aucun utilisateur inscrit</td></tr>");
                
            }      
        }
    })
}


function clickOnbtnSupp(){
        
    //recuperation de l'id
    let id_btn = this.id;
       
    //mettre le btn valider
    let action = this.value;
        
     if ( action == "supprimer_users"){ 
            donnee = "users";
        }else if ( action == "supprimer_post"){ 
            donnee = "posts";
        }else if (action == "supprimer_comment"){ 
            donnee = "commentaire";
        }
        
        $("#action_alert").append(formConfirmation(donnee));
        $("#modale").css("display","flex")
        $(".form_confirm").on("click", function(e){
            e.preventDefault();
            
            if (action == "supprimer_users"){
                
                let action ="supprimer"
                if( $(this).val() == "oui"){
                    
                    //btn validation
                    let reponse = "oui";
                    
                    $.ajax({
                        url: "php/traitement_users_admin.php", 
                        method: "POST",
                        data: {id: id_btn, action: action, reponse: reponse},

                        success: function(data){
                
                        if (data == 1 ){
                    
                        On_load_data();
                        $("#message_admin").text("Utilisateur supprimé");
                        $("#message_admin").addClass("alert");
                        $("#message_admin").addClass("alert-success");
                        }
                
                        },
                        error: function(erreur){
                            console.log(erreur);
                        }
                    });
                    
                    $("#modale").css("display","none");
                    
                }else {
                    $("#modale").css("display","none");
                }   
            }

            if(action == "supprimer_post"){

                 if( $(this).val() == "oui"){
                    
                    let reponse = "oui";
                  
                    $.ajax({
                        url: "php/traitement_posts_admin.php",
                        method: "POST",
                        data: {id: id_btn, action: action, reponse: reponse},

                        success: function(data){
                            
                        if (data == 1 ){
                    
                        recuperationPostsSignal()
                        $("#message_admin").text("Post supprimé");
                        $("#message_admin").addClass("alert");
                        $("#message_admin").addClass("alert-success");
                        }
                
                        },
                        error: function(erreur){
                            console.log(erreur);
                        }
                    });
                    $("#modale").css("display","none");

                    
                }else {
                    $("#modale").css("display","none");
                }  
                
            }
            if (action == "supprimer_comment"){
                if( $(this).val() == "oui"){
                    
                    let reponse = "oui";
                  
                    $.ajax({
                        url: "php/traitement_posts_admin.php",
                        method: "POST",
                        data: {id: id_btn, action: action, reponse: reponse},

                        success: function(data){
                            
                        if (data == 1 ){
                    
                        recuperationPostsSignal()
                        $("#message_admin").text("commentaire supprimé");
                        $("#message_admin").addClass("alert");
                        $("#message_admin").addClass("alert-success");
                        }
                
                        },
                        error: function(erreur){
                            console.log(erreur);
                        }
                    });
                }else{
                    
                    $("#modale").css("display","none");

                }
                    $("#modale").css("display","none");
            }
    });
                  
}

function pagination(data){
    
    $("#pagination").empty();
    //creation des liens pagination
    let total_page = (data.length / 6) + 1;
               
    for (let i = 1 ; i < total_page ; i++){
        $("#pagination").append("<button class='btn page page-link' value='"+i+"'>"+i+"</button>")    
    } 

    $(".page").click(function(){
        $("#tbody").empty();
        let valeur = $(this).val();
        let debut = (valeur - 1 ) * 6 ; /// valeur de depart de la boucle
        let max = 6 * valeur; 
        let donne = null;
   
        for ( let i = debut ; i < max ; i++){
            if (data[i] != undefined){
                $("#tbody").append(tableau(donne,data,i))
            }

        }
    })
}

function CountSignal(){
    $("#signalement").empty();
    $.ajax({
        url: "php/traitement_posts_admin.php",
        dataType: "json",
        data: {action: "compter_signal"},
        method: "POST",

        success: function(data){
            
            //compte le nombre totale de signalement des posts et comments 
            let compteur = data["posts"]+data['comment'];
            
            //si signalement On change la couleur de la cloche et on affiche le chiffre
            if (compteur != 0){
               
                $("#signalement").css("color","red");
                $("#signalement").append("<span>"+compteur+"</span>")
                $("#signalement span").addClass('bell');   
                
            }else{
                $("#signalement").css("color","#FECE66");
            }
        }
    })
}

function ChangementDePage(page,variable){
    $("#page").empty();
    $.ajax({
        url: "page_admin/"+page,

        success: function(data){
           
            $("#page").append(data);
            
            if ( variable == "users"){
                On_load_data();
                
            }else if (variable == "post" ){
                recuperationPost();
            }
            else if (variable == "groupe"){
                recuperationGroupe();
            }
            else if (variable == "signal"){
                recuperationPostsSignal()
            }
            else if ( variable == "langage"){
                RecuperationLangage();
            }
            else if ( variable == "cursus"){
                RecuperationCursus()
            }

            AffichageAlert();
        }
    })
}   