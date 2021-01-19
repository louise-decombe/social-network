function CreateForm(label,type,value,accept){
    return`<div class="text-center" >
                <label class="form-label " for='files' >${label}</label>
                <input class="form-control w-75 m-auto" id="files" type=${type} name="files" accept=${accept} >
                <input id="type_media" type="hidden" name="type" value=${value} >
           </div>
           `;
}
function template_affichage_post(donnees,i,media,classe,reaction,nbr_suivis){
    let dateJour = Formatdate(donnees[i].created_at)

    if (donnees[i].photo == null ){
        var image_profile = "default_avatar.png";
    }else {
        var image_profile = donnees[i].photo;
    }

    //contenue
    var content;
    if (donnees[i].content != null && donnees[i].content.length  > 400){
        content= `<p id="p_${donnees[i].id_post}" class="p_content"> ${donnees[i].content.substr(0, 400)} <a class="plus plus_${donnees[i].id_post}" id ="${donnees[i].id_post}" href="fil_actu.php?id=${donnees[i].id_post}#section_${donnees[i].id_post}" >... Voir plus</a></p>
                        `;
    }else if (donnees[i].content != null && donnees[i].content.length  < 400){
        content = ` <p class="p_content">${donnees[i].content} </p>`; 
    }else {
        content = ``;
    }
    console.log(donnees[i][1])
    return `<section class="section_posts" id='section_${donnees[i].id_post}'>
                <div class="infos_user">
                    <img src="${image_profile}" >
                    <div class="div_flex">
                        <div class="div_first">
                            <p> <a href='profile_public.php?id=${donnees[i].id_user}'>${donnees[i].firstname}  ${donnees[i].lastname}</a></p>
                            <p>Suivis par ${nbr_suivis} personne(s) </p>
                            <p>${ dateJour }</p>
                         </div>
                        <div class="div2">
                            <div>
                                <p class="menu_signal menu_signal_${donnees[i].id_post}" data-id_post='${donnees[i].id_post}' >°°°</p>
                                <div class='none div_signal div_signal_${donnees[i].id_post}' data-id_post='${donnees[i].id_post}'>
                                    <a href="" >Signaler le post</a>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
                <div>
                    ${content}
                    ${media}
                <div>
                
        
                <div>
                    <!-- Les likes , recation et nombre commentaire -->
                    <a href=''><div class="reactions_miniatures reactions_miniatures_${donnees[i].id_post}" data-id_post='${donnees[i].id_post}'>
                    </div></a>
                    <p class="p_commentaires p_commentaires_${donnees[i].id_post}" data-id_post='${donnees[i].id_post}'></p>
                    <hr>
                    <div class="reactions">
                    <!-- Reactions -->
                        <div class="modale_reaction modale_reaction_${donnees[i].id_post}">
                            <div>
                                <span class="jaime span_titre_reaction">J'aime</span>
                                <a href="" ><img id="jaime" class="icon_block" src="images/pouce.png" alt="j'aime" data-id_post='${donnees[i].id_post}'></a>
                            </div> 
                            <div>  
                                <span class="bravo span_titre_reaction">Bravo</span>
                                <a href=""  ><img id="bravo" class="icon_block" src="images/bravo.png" alt="bravo" data-id_post='${donnees[i].id_post}'></a>
                            </div>
                            <div>    
                                <span class="soutien span_titre_reaction">Soutien</span>
                                <a href=""  ><img id="soutien" class="icon_block" src="images/soutien.png" alt="soutien" data-id_post='${donnees[i].id_post}'></a>
                            </div>
                            <div>    
                                <span class="jadore span_titre_reaction">J'adore</span>
                                <a href="" ><img id="jadore" class="icon_block" src="images/jadore.png" alt="j'adore" data-id_post='${donnees[i].id_post}'></a>
                            </div>
                            <div>    
                                <span class="instructif span_titre_reaction">Instructif</span>
                                <a href="" ><img id="instructif" class="icon_block" src="images/instructif.png" alt="instructif" data-id_post='${donnees[i].id_post}'></a>
                            </div>    
                            <div>     
                                <span class="interressant span_titre_reaction">Interressant</span>
                                <a href="" ><img id="interressant" class="icon_block" src="images/interressant.png" alt="interressant" data-id_post='${donnees[i].id_post}'></a>
                            </div>
                        </div>
                        <div class='${classe} div_icon  div_icon-thumbs-up${donnees[i].id_post}' data-react='modale_reaction_${donnees[i].id_post}' data-id_post='${donnees[i].id_post}'><span class="icon-thumbs-up"></span>${reaction}</div>
                            <div class="icon-c icon-c${donnees[i].id_post}" data-id_post='${donnees[i].id_post}'><span class="icon-chat-1"></span>Commenter</div>
                            </div>
                        </div>
                    </div>
                    <section  id="section_liste_reactions_${donnees[i].id_post}"  >
                
                    </section>
    
                    <section id="section_form_commentaire_p${donnees[i].id_post}">
    
                    </section>
                    <section id='formulaire_ajout_commentaire_${donnees[i].id_post}'>
    
                </section>
    
           
            </section>`;
   
}




function templatesPosts(donnees,i,media){
    let dateJour = Formatdate(donnees[i][0].created_at)

    if (donnees[i].photo == null ){
        var image_profile = "images/default_avatar.png";
    }else {
        var image_profile = donnees[i].photo;
    }
    var content ;
    if (donnees[i][0].content != null && donnees[i][0].content.length  >= 400){
        content = `<p id="p_${donnees[i][0].id_post}" class="p_content">${donnees[i][0].content.substr(0, 400)} <a class="plus plus_${donnees[i].id_post}" id ="${donnees[i][0].id_post}" href="fil_actu.php?id=${donnees[i][0].id_post}#section_${donnees[i][0].id_post}" >... Voir plus</a></p>`;
    }
    else if (donnees[i][0].content != null && donnees[i][0].content.length  <= 400){
        content = `<p class="p_content">${donnees[i][0].content} </p>`;
    }else {
        content = ``;
    }

    return `<section class="section_posts" id='section_${donnees[i][0].id_post}'>
                <div class="infos_user">
                    <img src="${image_profile}" alt="Photo par defaut">
                    <div class="div_flex">
                        <div class="div_first">
                            <p> <a href='profile_public.php?id=${donnees[i][0].id_user}'>${donnees[i][0].firstname}  ${donnees[i][0].lastname}</a></p>
                            <p>Suivis par ${donnees[i][1]} personne(s) </p>
                            <p>${ dateJour }</p>
                        </div>
                        <div class="div2">
                            <div>
                                <p class="menu_signal menu_signal_${donnees[i][0].id_post}" data-id_post='${donnees[i][0].id_post}' data-statut='off'>°°°</p>
                                <div class=' none div_signal div_signal_${donnees[i][0].id_post}' data-id_post='${donnees[i][0].id_post}' >
                                    <a href="" >Signaler le post</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    ${content}
                    <div class="media">
                        ${media}
                    </div>
                </div>
                <div>
                    <!-- Les likes , recation et nombre commentaire -->
                    <a href=''><div class="reactions_miniatures reactions_miniatures_${donnees[i][0].id_post}" data-id_post='${donnees[i][0].id_post}'>
                    <p class="p_reaction" >Soyez le premier a réagir à ce post !</p></div></a>
                    <p class="p_commentaires p_commentaires_${donnees[i][0].id_post}" data-id_post='${donnees[i][0].id_post}'>0 commentaire(s)</p>
                    <hr>
                    <div class="reactions">
                        <!-- Reactions -->
                        <div class="modale_reaction modale_reaction_${donnees[i][0].id_post}">
    
                            <div>
                                <span class="jaime span_titre_reaction">J'aime</span>
                                <a href="" ><img id="jaime" class="icon_block" src="images/pouce.png" alt="j'aime" data-id_post=></a>
                            </div> 
                            <div>
                                <span class="bravo span_titre_reaction">Bravo</span>
                                <a href=""  ><img id="bravo" class="icon_block" src="images/bravo.png" alt="bravo" data-id_post='${donnees[i][0].id_post}'></a>
                            </div>
                            <div>    
                                <span class="soutien span_titre_reaction">Soutien</span>
                                <a href=""  ><img id="soutien" class="icon_block" src="images/soutien.png" alt="soutien" data-id_post='${donnees[i][0].id_post}'></a>
                            </div>
                            <div>    
                                <span class="jadore span_titre_reaction">J'adore</span>
                                <a href="" ><img id="jadore" class="icon_block" src="images/jadore.png" alt="j'adore" data-id_post='${donnees[i][0].id_post}'></a>
                            </div>
                            <div>    
                                <span class="instructif span_titre_reaction">Instructif</span>
                                <a href="" ><img id="instructif" class="icon_block" src="images/instructif.png" alt="instructif" data-id_post='${donnees[i][0].id_post}'></a>
                            </div>    
                            <div>     
                                <span class="interressant span_titre_reaction">Interressant</span>
                                <a href="" ><img id="interressant" class="icon_block" src="images/interressant.png" alt="interressant" data-id_post='${donnees[i][0].id_post}'></a>
                            </div>
                        </div>
                        <div class='div_icon  div_icon-thumbs-up${donnees[i][0].id_post}' data-react='modale_reaction_${donnees[i][0].id_post}' data-id_post='${donnees[i][0].id_post}'><span class="icon-thumbs-up"></span>J'aime</div>
                            <div class="icon-c icon-c${donnees[i][0].id_post}" data-id_post='${donnees[i][0].id_post}'><span class="icon-chat-1"></span>Commenter</div>
                    
                            </div>
                        </div>
                    </div>  
                <section  id="section_liste_reactions_${donnees[i][0].id_post}"  >
                
                </section>
        
                <section id="section_form_commentaire_p${donnees[i][0].id_post}">
    
                </section>
                <section id='formulaire_ajout_commentaire_${donnees[i][0].id_post}'>
    
                </section>
    
           
           
            </section>` ;
   
}



function templateCommentaire(data,i){
    if (data[i].photo != null){
        return `<section class="section_commentaire">
               
                <div class="section_commentaire_div">
                    <img src='${data[i].photo}' alt='${data[i].firstname} ${data[i].lastname}' >
                    <div class='div_fist'>
                        <div class="section_commentaire_div2">
                            <p class="p_nom"><a href='profile_public.php?id=${data[i].id_user}'>${data[i].firstname} ${data[i].lastname}</a></p>
                            <div class="div2">
                                
                                    <p class="sous_menu_signal  sous_menu_signal_${data[i].id_post}" data-id_post='${data[i].id_post}' data-position='${i}' data-statut='off'>°°°</p>
                                    <div class='none sous_div_signal sous_div_signal_${data[i].id_post} sous_div_signal_${i}' data-id_comm='${data[i].id_comment}' >
                                        <a href="" >Signaler le commentaire</a>
                                    </div>
                                
                            
                            </div>
                        </div>
                        <hr class='hr_comm'>
                        <p>${data[i].content}</p>
                    </div>
                </div>
                
            </section>`;
    }else{
        return `<section>
                
                <div class="section_commentaire_div">
                    <img src='images/default-profil.png' alt='${data[i].firstname} ${data[i].lastname}' >
                    <div class='div_fist'>                    
                        <div class="section_commentaire_div2">
                            <p><a href='profile_public.php?id=${data[i].id_user}'>${data[i].firstname} ${data[i].lastname}</a></p>
                            <div class="div2">
                             
                                    <p class="sous_menu_signal sous_menu_signal_${i} sous_menu_signal_${data[i].id_post}" data-id_post='${data[i].id_post}' data-statut='off'>°°°</p>
                                    <div class='none sous_div_signal sous_div_signal_${i} sous_div_signal_${data[i].id_post}' data-id_comm='${data[i].id_comment}' >
                                        <a href="" >Signaler le commentaire</a>
                                    </div>
                                
                            
                            </div>
                        </div>
                        <hr class='hr_comm'>
                        <p>${data[i].content}</p>
                    </div>
                    
                </div>
               
            </section>`;
    }
    
}