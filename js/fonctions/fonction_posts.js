function GetFormulaire(id_nom_form,input1,valeur1,valeur2,input2,boutton,valeur_btn,valeur3,input3){
    var form = $(id_nom_form).get(0);
    var data = new FormData(form);

    data.append(valeur1,$(input1).val())
    data.append(valeur2, $(input2).val())
    data.append(boutton,$(valeur_btn).val())
    data.append(valeur3,$(input3).val())
    return data;
  
}
function RegisterPost(){
    $("#toto").empty()
   
    var form = GetFormulaire('#form_post','#message',"message","files",'#files',"valider",'#btn_valider',"type","#type_media");

   
    $.ajax({
        url : 'php/traitement_messages.php',
        type : 'POST',
        enctype: 'multipart/form-data',
        data: form, 
        contentType: false,
        processData: false,
        
    
        success: function(data){
        console.log(data);
            if (data == 1){
                console.log("ici")
               
                $("#toto").append("Post envoyé !")
                $("#toto").css('color','green')
            
                form.delete("message");
                form.delete("files");
                form.delete("valider");
                form.delete("type");
                $("#message").text('De quoi souhaitez-vous discuter ?')
                $("#input_form").empty();

                $("#form_post")[0].reset();
                $("#modale2").css('display',"none");
                
                
               
            }else {
                let json_datas = JSON.parse(data);

                if ( json_datas.erreur !== ""){
                
                    $("#message_erreur").empty();
                    $("#message_erreur").append( json_datas.erreur );
                    $("#message_erreur").addClass('color',"red")
                }
            }

            

        }
    })
    

 

}

function registerPostUrl(){
    
    // $("#message_post").empty();
    let url = $("#files").val();
    let valider = $("#btn_valider").val();
    let message = $("#message").val();
    
    

    
    $.ajax({
        url : 'php/traitement_messages.php',
        type : 'POST',
        dataType: "json",
        data: {files: url ,valider:valider,  message: message, action: "url"},
      

        success: function(data){
            console.log(data);
          
            if (data == 1){
                console.log("ici")
                $("#toto").empty();
                $("#toto").append("Message Envoyé !");
               
               
                $("#form_post")[0].reset();
                $("#modale2").css('display',"none");

                $("#message").text('De quoi souhaitez-vous discuter ?')
                $("#input_form").empty();
            }
            if (data == 0){
                console.log("la");
                $("#message_erreur").empty();
                $("#message_erreur").text("Le champs ne peut pas etre vide !");
            }

            if (data.erreur){
                $("#message_erreur").empty();
                $("#message_erreur").text(data.erreur);
            }
        },
        
    })
}

function SavePost(template){
    $("#input_form").empty();
    $("#input_form").append(template);
}

function ChangeInputForm(champs1,type,format,label,champs2,name){
    
    $(champs1).attr('type',type);
    $(champs1).attr('accept',format)
    $("#label").append(label);
    $(champs2).attr("value",name)
}

function AlertError(element,input1,input2){
    $(element).css("color","red");
    $(input1).css('background',"red!important")
    $(input2).css('background',"red!important")
}

function NewPosts(){  
    $.ajax({
        url: "php/traitement_posts_feed.php",
        type: "POST",
        
        success: function(data){

           var datas = JSON.parse(data);
            
            if (datas.post !== undefined){
                if ($("#btn_new_post").length == 0 ){
                    $("#section_affichage_posts").prepend("<button id='btn_new_post'>Nouveaux messages</button>")
                }

                var val = JSON.stringify(datas.post);
                localStorage.setItem('post', val);
            }

        }   
    
})
}
