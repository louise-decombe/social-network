function recuperationGroupe(){
       
    $.ajax({
        url: "php/traitement_groupe_admin.php",
        data: {action: "recuperation"},
        method: "POST",
        dataType: "json",

        success: function(data){
            
           if( data.length != 0){
               for (let i = 0 ; i < 5 ; i++){
                    $("#tbody").append(tabGroupe(data,i));
               }
               paginationGroupe(data);
           }
           else{
                $("#tbody").append("<tr class='text-center'><td colspan = 2>Aucun groupe crée</td></tr>");
           }
        }
    })
}

function paginationGroupe(data){
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
            $("#tbody").append(tabGroupe(data,i));
        }
    })

}

function recuperationTopGroupe(){
    $.ajax({
        url: "php/traitement_groupe_admin.php",
        data: {action: "recuperation top groupe"},
        method: "POST",
        dataType: "json",

        success: function(data){
           
            if ( data.length != 0){
                for (let i = 0 ; i < data.length ; i++){
                    $("#tbody2").append(tabTopGroup(data,i))
                }
                
            }
        }
    })
}