function RecuperationCursus(){
    $("#tbody").empty();
   let action = "recuperation";
   $.ajax({
       url: "php/traitement_cursus_admin.php",
       data: {action: action},
       dataType: "JSON",
       method: "POST",
       success: function(data){
          
           if (data.length != 0){
               for (let i = 0 ; i < data.length ; i++){
                   $("#tbody").append(tabCursus(data,i));
                }
           }else{
            $("#tbody").append("<tr class='text-center'><td colspan=3>Aucun cursus</td></tr>");
           }
       }
   })
}

//suppression cursus
function deleteCursus(id_cursus){
    $(".form_confirm").click(function(e){
        e.preventDefault();
        let val = $(this).val();
        
        if(val == "oui"){
            //on supprime
            
            $.ajax({
                url: "php/traitement_cursus_admin.php",
                data: {oui: val, id: id_cursus},
                method: "POST",
                success: function(data){
                    console.log(data);
                    $("#modale").css("display","none");
                    $("#action_alert").empty();
               
                    RecuperationCursus();

                    if (data == 1 ){
                        $("#message_admin").text("Formation supprimée!");
                        $("#message_admin").addClass("alert");
                        $("#message_admin").addClass("alert-success");
                        
                    }
                }
            })

        }else{
            $("#action_alert").empty();
            $("#modale").css("display","none"); 
        }
    })
}

function insertCursus(){

    let btn = $("#btn_submit").val();
    let nom_cursus = $("#nom_cursus").val();
   
    $.ajax({
        url: "php/traitement_cursus_admin.php",
        data: {submit_cursus: btn , nom_cursus: nom_cursus },
        method: "POST",

        success: function(data){
           
            if (data == 1){
                 $("#message_admin").removeClass("alert-danger");
                 $("#message_admin").addClass("alert-success");
                 $("#message_admin").addClass("alert");
                 $("#nom_cursus").css("border","none")
                 $("#message_admin").text("Cursus enregistré");
                 //recuperation des données a jour
                 RecuperationCursus();
                 //reinitialisation du form
                 $("#form_ajout_cursus")[0].reset();
             }
             else{
                 $("#message_admin").text(data);
                 $("#message_admin").addClass("alert-danger");
                 $("#message_admin").addClass("alert");
                 $("#nom_cursus").css("border","1px solid red")
             }
        }
    })
}

function UpdateCursus(id,btn,nom){
       
    $.ajax({
        url: "php/traitement_cursus_admin.php",
        method: "POST",
        data: {btn_update_cursus: btn , id: id, updtate_nom_cursus: nom },

        success: function(data){
        
         if ( data == 1 ){
             RecuperationCursus();
             $("#modale").css("display","none");
             $("#action_alert").empty();
         }
        }
    })

}