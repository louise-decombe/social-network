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
    $("#formulaire_post").empty()
   
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
               
                $("#formulaire_post").append("Post envoyé !")
                $("#formulaire_post").css('color','green')
            
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
            console.log(data)
           var datas = JSON.parse(data);
          
            if (datas.post !== undefined ){
                if ($("#btn_new_post").length == 0 ){
                    $("#btn_new_message").append("<button id='btn_new_post'><span class='icon-up-fat'></span>Nouveaux messages</button>");
                }

                if (val === undefined ){
                    var val = [];
                    var val = JSON.stringify(datas.post);   
                }
                else {
                    val.push(JSON.stringify(datas.post));
                }
               
                localStorage.setItem('post', val);

            }

        }   
    
    })

}

function Formatdate(dateDujour){
    let maDate = new Date(dateDujour);
    let jour = maDate.getDate(); //Jour
    let annee = maDate.getFullYear(); //annee
    let mois = (maDate.getMonth()) +1; //Mois (commence à 0, donc +1);
    let retour  = jour+'/'+mois+'/'+annee
    return retour;
}
