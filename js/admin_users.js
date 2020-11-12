$(document).ready(function(){

    ///////////// FONCTIONS //////////////
    //creation de la partie du tableau
    function tableau(data,i){
        return `<tr>
        <td>${data[i].firstname}</td>
        <td>${data[i].lastname}</td>
        <td><button class="supp" value='supprimer' id="${data[i].id}">Supprimer</button></td>
        </tr>`;
    } 

    function On_load_data(){
        $.ajax({
            url : "php/traitement_users_admin.php",
            dataType: "json",
    
            success: function(data){
                console.log(data)
                if(data.length != 0){
                    for ( let i = 0 ; i < data.length ; i++){
                        $("tbody").append(tableau(data,i));
                    }
                }else{
                    $("tbody").append("<tr class='text-center'><td colspan=4>Aucun utilisateur enregistré</td></tr>");
                }
                
            }
        })
    }

    /////////////////////////////////////


    //recuperation de tout les users
    On_load_data();

   

 
    

    //pour supprimer des users
    function clickOnbtnSupp(){
        console.log(this.id)
        
        //recuperation de l'id
        let id_btn = this.id;
        let action = this.value;
        //ajax supprimer
        $.ajax({
            url: "php/traitement_users_admin.php",
            data: {id: id_btn, action: action},

            success: function(data){
                console.log(data)
                // si requete ok on ferme la modale et message success au dessus du tableau

                //reload page
            },
            error: function(erreur){
                console.log(erreur);
            }
        })

   
    }
    $(document).on('click','.supp',clickOnbtnSupp);
   


})