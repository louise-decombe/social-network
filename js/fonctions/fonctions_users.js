//UPGRADE USERS
function OnclickUpgrade(){
        
    var id_user = this.id;

    $("#action_alert").append(template_upgrade);
    $("#modale").css("display","flex");

    $("#upgrade").on('click',function(e){
        e.preventDefault();
       
        let statut = $("#statut").val();
        let action = $("#upgrade").val(); // btn
       
        // Up user
   
        $.ajax({
            url: "php/traitement_users_admin.php",
            method: "POST",
            data: {statut: statut, id: id_user, action: action },

            success: function(data){
                $("#modale").css("display","none");
               On_load_data();
            },
            error: function(erre){
                console.log('ok')
            }
        })
    })
 
}

 //SEARCH USERS

 // voir pour nom et prenom
function OnkeyUpSearch(e){

    if ( $("#search_users_admin").val() != "") {
        //on lance une recherche ajax
        let valeur_search = $("#search_users_admin").val().trim();

        let action = "search";

        $.ajax({
            url: "php/traitement_users_admin.php",
            method: "post",
            dataType: "json",
            data: {action: action , valeur: valeur_search},

            success: function(data){
                console.log(data);
                if (data.length != 0){
                    $("#tbody").empty();
                    $("#pagination").empty();
                    //ecouter si changement
                    for (let i = 0 ; i < data.length ; i++){
                        
                        let donne = "";
                        $("#tbody").append(tableau(donne,data,i))  
                    }
                }else {
                     $("#tbody").empty();
                     $("#tbody").append("<tr class='text-center'><td colspan = 5 >Aucunes données</td>")
                } 
            }
         })
     }
     else{
         $("#tbody").empty();
         On_load_data();
    }
 }

 //SELECT USERS
function OnChangeInputSelect(){
    $("#tbody").empty();
    $("#pagination").empty();
    //recuperation users en fonction de la selection
    let action = "filtre";
    let filtre = $("#selection").val();

    if (filtre == "ordre_alpha"){
        var donnee = "ORDER BY";
    } 
    else if(filtre == "admins"){
        var donnee = "administrateur";
    }
    else if (filtre == "users") {
        var donnee = "utilisateur";
    }
    else if (filtre == ""){
        var donnee = "tout";
    } 
    else {
        var donnee = filtre;
    }
   
    $.ajax({
        url: "php/traitement_users_admin.php",
        method: "POST",
        dataType: "json",
        data: {action: action, filtre: filtre, donnee: donnee},
        
        success: function(data){
           
            //Si le resultat n est pas vide on affiche le tableau 
            if (data.length != 0 ){
               
                for ( let i = 0 ; i < 6 ; i++){
                    $("#tbody").append(tableau(donnee,data,i));  
                }
                pagination(data)  
            }
            else{
                $("#tbody").empty();
                $("#tbody").append("<tr class='text-center'><td colspan = 5 >Aucunes données</td>");
            }
        }
    })
}