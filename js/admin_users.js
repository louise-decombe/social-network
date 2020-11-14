$(document).ready(function(){

    ///////////// FONCTIONS //////////////
    //creation de la partie du tableau
    function tableau(data,i){
        return `<tr>
        <td>${data[i].firstname}</td>
        <td>${data[i].lastname}</td>
        <td>${data[i].droits}<button class="upgrade" value="upgrade" id="${data[i].id}">Modifier</button></td>
        <td><button class="supp" value='supprimer' id="${data[i].id}">Supprimer</button></td>
        </tr>`;
    } 

    function formConfirmation(){
        $("#action_alert").empty();
        return `<form class="form_admin" method="POST" action='php/traitement_users_admin.php'>
                    <span class="icon-cancel"></span>
                    <label for="">Etes vous sur de vouloir supprimer cet utilisateur ?</label>
                    <div>
                        <input class="form_confirm btn btn-success" type="submit" name='oui' value='oui'>
                         <input class="form_confirm btn btn-danger" type="submit" name="non" value='non'>
                    </div>
                </form>`;
    }
    function template_upgrade(id_user){
        $("#action_alert").empty();
        return `<form class="form_admin" method="POST" action='php/traitement_users_admin.php'> 
                    <span class="icon-cancel"></span>
                    <label>Choissir le statut de l'utilisateur</label>
                    <input type="hidden" id="${id_user}">
                    <select name="statut" id="statut">
                        <option value="utilisateur">Utilisateur</option>
                        <option value="administrateur">Administrateur</option>
                    </select>
                    <input type='submit' name='action' value='upgrade' id='upgrade' >
                </form>`;
    }

    function On_load_data(){
        
        $("#tbody").empty();
        // $("#pagination").empty();

        $.ajax({
            url : "php/traitement_users_admin.php",
            data: {action: "recuperation"},
            method: "POST",
            dataType: "json",
    
            success: function(data){
                
                
                if(data.length != 0){

                    for ( let i = 0 ; i < 6 ; i++){
                        
                        $("#tbody").append(tableau(data,i));
                      
                    }
                    var all= 'tout';
                    pagination(data,all);
                   
                }

                if(data.length === 0){
                    $("#tbody").empty();
                    $("#tbody").append("<tr class='text-center'><td colspan = 4 >Aucun utilisateur inscrit</td></tr>");
                   
                }
                
            }
        })
    }

     //pour supprimer des users
     function clickOnbtnSupp(){
        
        //recuperation de l'id
        let id_btn = this.id;
        console.log(id_btn);
        let action = this.value;
       
        $("#action_alert").append(formConfirmation);
        $("#action_alert").css("display","block")
        $(".form_confirm").on("click", function(e){
            e.preventDefault();
            

            if( $(this).val() == "oui"){
                console.log('suup')
                $.ajax({
                        url: "php/traitement_users_admin.php",
                        method: "POST",
                        data: {id: id_btn, action: action},
            
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
                
                    $("#action_alert").css("display","none");
                    
            }else {
                console.log('np')
                $("#action_alert").css("display","none");
            }

        });
    
   
    }

    function OnclickUpgrade(){
        
        var id_user = this.id;

        $("#action_alert").append(template_upgrade);
        $("#action_alert").css("display","block");

        $("#upgrade").on('click',function(e){
            e.preventDefault();
           
          let statut = $("#statut").val();
          
            console.log(id_user);
            // Up user
       
            $.ajax({
                url: "php/traitement_users_admin.php",
                method: "POST",
                data: {statut: statut, id: id_user, action: "upgrade" },

                success: function(data){
                    $("#action_alert").css("display","none");
                   On_load_data();
                },
                error: function(erre){
                    console.log('ok')
                }
            })
        })

        
    }

    function OnChangeInputSelect(){
        $("#tbody").empty();
        $("#pagination").empty();
        //recuperation users en fonction de la selection
        let action = "filtre";
        let filtre = $("#selection").val();
        console.log(action)
        
        if (filtre == "ordre_alpha"){
            var donnee = "ORDER BY";
        } 
        else if(filtre == "admins"){
            var donnee = "administrateur";
        }
        else if (filtre == "users") {
            var donnee = "utilisateur";
        }
        else{
            var donnee = "tout";
        } 

        $.ajax({
            url: "php/traitement_users_admin.php",
            method: "POST",
            dataType: "json",
            data: {action: action, filtre: filtre, donnee: donnee},

            success: function(data){
                console.log(data)
                // Si le resultat n est pas vide on affiche le tableau 
                if (data.length != 0 ){
                   
                    for ( let i = 0 ; i < 6 ; i++){
                        $("#tbody").append(tableau(data,i));
                       
                    }
                    pagination(data)
                   
                }
                else{
                    $("#tbody").empty();
                    $("#tbody").append("<tr class='text-center'><td colspan = 4 >Aucunes données</td>");
                }
                

                //penser au boutton pour revenir a l etat precedent

                //sinon message : aucun resultat
            }
        })
    }

    function pagination(data){
        $("#pagination").empty();
        //creation des liens pagination
        let total_page = (data.length / 6) + 1;
                    
                   
        for (let i = 1 ; i < total_page ; i++){
            $("#pagination").append("<button class='page' value='"+i+"'>"+i+"</button>")    
        }

        

        $(".page").click(function(){
            $("#tbody").empty();
            let valeur = $(this).val();
            let debut = (valeur - 1 ) * 6 ; /// valeur de depart de la boucle
            let max = 6 * valeur; 
            for ( let i = debut ; i < max ; i++){
                $("#tbody").append(tableau(data,i));
            }
        })
    }

    /////////////////////////////////////


    //recuperation de tout les users
   
    On_load_data();

    //fermeture de la modale
    $(document).on("click",".icon-cancel",function(){
        $("#action_alert").css("display","none");
    })

    //suppression user
    $(document).on('click','.supp',clickOnbtnSupp);

    //upgrade user
    $(document).on("click",'.upgrade', OnclickUpgrade);

    //filtration des users
    $("#selection").on('change', OnChangeInputSelect)

    $("#init").on('click',function(){
        On_load_data();
    })
   


})