function PictoReactions(data,j){
    if (data.reaction[j].id_reactions == "2"){
        var react = "Bravo";
    }
    else if (data.reaction[j].id_reactions == "3"){
        react = "Soutien";
    }
    else if (data.reaction[j].id_reactions == "4"){
        react = "J'adore";
    }
    else if (data.reaction[j].id_reactions == "5"){
        react = "Instructif";
    }
    else if (data.reaction[j].id_reactions == "6"){
        react = "Interressant";
    }
    else if (data.reaction[j].id_reactions == "1"){
        react = "J'aime";
    }

    return react ;
}

function AffichagePostReaction(data,i,classe,react){
    console.log(data)
    if (data.post[i].type_media == "1"){
                   
        $("#section_affichage_posts").append(template_affichage_post(data.post,i,`<div class="media">
        <img src="php/upload_media_post/${data.post[i].media}" ?>
        </div>`,classe,react,data.suivis))
    
    }
    else if(data.post[i].type_media == "2"){
    
        $("#section_affichage_posts").append(template_affichage_post(data.post,i,`<div class='media'>
        <video  controls src="php/upload_media_post/${data.post[i].media}">Ici la description alternative</video>
        </div>`,classe,react,data.suivis));
    
    }
    else if(data.post[i].type_media == "3") {
    
        $("#section_affichage_posts").append(template_affichage_post(data.post,i,'',classe,react,data.suivis));
    
    }
}

//template
function templateImagePicto(source){
                 
    return `<div>
            <img src='images/${source}' alt='$image'>
            </div>`;

}


function TemplateFormCommentaire(id_post){
    return `<form class="form_feed_comm" action="php/traitement_formulaire_commentaire.php" method='POST'>
                
                <textarea class="textarea"  name="commentaire" id="comm_${id_post}" placeholder=' Votre commentaire... ' rows="1" ></textarea >

                <input class='btn btn_form_comm' type="submit" value="Envoyer" name="enregistrer">
            </form>`;
}

function AddStyles(id_post,img){
    $("#section_"+id_post+" .div_icon").empty();
    $(".modale_reaction").css("display","none")
    $("#section_"+id_post+" .div_icon").append('<span class="icon-thumbs-up"></span>'+img);
}

function fermetureModale(){
    $(".modale_reaction").css("display","none")
}

