function recuperationPost(){
        
    $("thead").empty();
    let signal = "post";
    $("thead").append( tablePost(signal) );
    $.ajax({
        url: "php/traitement_posts_admin.php",
        method: "POST",
        dataType: "json",
        data: {action: "recuperation"},

        success:function(data){
            
            if (data.length != 0){
                for (let i = 0 ; i<5 ; i++){
                    $("#tbody").append(tableauPost(data,i));
                }
                paginationPost(data);  
            }
            else{
                $("#tbody").append("<tr class='text-center'><td colspan = 5>Aucun posts aujourd'hui</td></tr>");
            }
        }
    })
}

function paginationPost(data){
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
            let toto = 'posts';
            $("#tbody").append(tableauPost(data,i,toto));
        }
    })
}

function recuperationPostsSignal(){
    $("thead").empty();
    $("#message_admin").empty();
    $("#message_admin").remove('.alert');
    $(".titre_admin").text('Signalements');
    let signal = "signal";

    $("thead").append(tablePost(signal));
    $("h2").empty();
    $("h2").append('Gestion des signalements');
    $.ajax({
        url: "php/traitement_posts_admin.php",
        method: "POST",
        dataType: "json",
        data: {action: "recuperation post signalement"},

        success: function(data){
            
            $("#tbody").empty();
            if (data["signal_posts"].length != 0){
                
                for (let i = 0 ; i < data["signal_posts"].length ; i++){
                   
                    let signal = 'signal';
                    let genre = "posts";
                    $("#tbody").append(tableauPost(data["signal_posts"],i,signal,genre));
                }
            }
            if (data["signal_comment"].length != 0){
                
                for (let i = 0 ; i < data["signal_comment"].length ; i++){
                   
                    let signal = 'signal';
                    let genre = "comment";
                    $("#tbody").append(tableauPost(data["signal_comment"],i,signal,genre));
                }
            }

            if (data["signal_comment"].length == 0 && data["signal_posts"].length == 0){
                $("#tbody").append("<tr class='text-center'><td colspan= 7>Aucun signalement</td></tr>");
            }
        }
    })
}

function AffichageAlert(){
       
    $.ajax({
        url: "php/traitement_posts_admin.php",
        data: {action: "recuperation post signalement"},
        dataType: "json",
        method: "POST",

        success: function(data){
            
            let compteur = data["signal_posts"]+data['signal_comment'];
            if(compteur != 0){
               $("#message_admin").text("Des posts signalés !");
               $("#message_admin").addClass('alert');
               $("#message_admin").addClass('alert-danger');
               $("#message_admin").append('<button id="signal_posts">Voir les posts</button>') 
            }
        }
    })
}

function OnclickBtnRestaure(){
    let actions = $(".annuler_signal").val();
    let btn_id = $(this).attr("id");
   
    $.ajax({
        url: "php/traitement_posts_admin.php",
        data:{action: actions , id: btn_id},
        method: "POST",
        success: function(data){ 
            recuperationPostsSignal()
        }
    })
}
