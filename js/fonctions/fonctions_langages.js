function RegisterLangage(){

    $("#message_admin").empty();
   var form = $('#formlangage')[0];
   var data = new FormData(form);
   
   data.append("nom",$("#nom_langage").val());
   data.append("logo",$("#logo").val());
   data.append('action',"enregistrer");
   data.append('valider',$("#btn_valider"));
   
    $.ajax({

        url : 'php/traitement_langage.php',
        type : 'POST',
        enctype: 'multipart/form-data',
        data: data,
       
        processData: false,
        contentType: false,
        cache: false,

        success: function(data){

            if (data != "" && data != 1){
               
               $("#message_admin").append(data);
               $("#message_admin").addClass("alert");
               $("#message_admin").addClass("alert-danger");
            }
            else {
                RecuperationLangage();
                $("#formlangage")[0].reset();
                $("#message_admin").append("Langage enregistré !");
                $("#message_admin").addClass("alert");
                $("#message_admin").addClass("alert-success");
            }
           
        }

    })
}

function RecuperationLangage(){
    $("#tbody").empty();
    $.ajax({
        url: "php/traitement_langage.php",
        method: "POST",
        dataType: "JSON",
        data: {action: "recuperation"},

        success: function(data){
         
            if (data.length != 0){
                for (let i = 0 ; i < 5 ; i++){
                    $("#tbody").append(tabLangage(data,i));
                }
                paginationLangage(data);
            }else{
                $("#pagination").empty();
                $("#tbody").append("<tr class='text-center'><td colspan= 4>Aucun langage enregistré !</td></tr>");
            }
        }
    })
}

function paginationLangage(data){
    $("#pagination").empty();
    //creation des liens pagination
    let total_page = (data.length / 5) + 1;
                      
    for (let i = 1 ; i < total_page ; i++){
        $("#pagination").append("<button class='btn page page-link' value='"+i+"'>"+i+"</button>")    
    }

    $(".page").click(function(){
        $("#tbody").empty();
        let valeur = $(this).val();
        let debut = (valeur - 1 ) * 5 ; /// valeur de depart de la boucle
        let max = 5 * valeur; 
        for ( let i = debut ; i < max ; i++){
            $("#tbody").append(tabLangage(data,i));
        }
    })
}

function DeleteLangage(id,logo){
    $.ajax({
        url: "php/traitement_langage.php",
        data: {action: "delete", id: id , logo: logo},
        method: "POST",

        success: function(data){
           
            if (data == 1){
                console.log('ici')
             RecuperationLangage();

            }
        }
    })
}