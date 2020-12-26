function CreateForm(label,type,value,accept){
    return`<div class="text-center" >
                <label class="form-label " for='files' >${label}</label>
                <input class="form-control w-75 m-auto" id="files" type=${type} name="files" accept=${accept} >
                <input id="type_media" type="hidden" name="type" value=${value} >
           </div>
           `;
}
function CreateFormUrl(){
    return` <div class="text-center" >
                <label class="form-label " for='files' >Votre url</label>
                <input class="form-control w-75 m-auto " id="files" type='url' name="files" placeholder=' www.exemple.fr'  >
                <input id="type_media" type="hidden" name="type" value='url' >
            </div>
           `;
}
function templateWithImage(donnees,i){
    return `<section class="section_posts">
    <div class="infos_user">
            <img src="${donnees[i][0].photo}" alt="Photo par defaut">
        <div>
            <p>${donnees[i][0].firstname}  ${donnees[i][0].lastname}</p>
             <p>Suivis par </p>
            <p></p>
             <!-- Date -->
           
        </div>
    </div>
    <div>
        <p class="p_content">${donnees[i][0].content.substr(0, 200)} </p>
        <a id ="${donnees[i][0].id}" href="fil_actu.php?id=${donnees[i][0].id}#section_${donnees[i][0].id}" >... Voir plus</a>
        <div class="media">
            <img src="php/upload_media_post/${donnees[i][0].media}" ?>
        </div>
        <div>
        </div>

        <div>
            <!-- Les likes , recation et nombre commentaire -->
            <hr>
            <div class="reactions">
                <!-- Reactions -->
                <div><span class="icon-thumbs-up"></span>J'aime</div>
                <div><span class="icon-chat-1"></span>Commenter</div>
                <div><spanv class="icon-share"></span>Partager</div>
                <div><span class="icon-paper-plane"></span>Envoyer</div>
            </div>
        </div>
    </div>    
       
</section>`
}

function templateWithVideo(donnees,i){
    return `<section class="section_posts">
    <div class="infos_user">
            <img src="${donnees[i][0].photo}" alt="Photo par defaut">
        <div>
            <p>${donnees[i][0].firstname}  ${donnees[i][0].lastname}</p>
             <p>Suivis par </p>
            <p></p>
             <!-- Date -->
           
        </div>
    </div>
    <div>
        <p class="p_content">${donnees[i][0].content.substr(0, 200)} </p>
        <a id ="${donnees[i][0].id}" href="fil_actu.php?id=${donnees[i][0].id}#section_${donnees[i][0].id}" >... Voir plus</a>
        <div class='media'>
            <video  controls src="php/upload_media_post/${donnees[i][0].media}">Ici la description alternative</video>
        </div>
        <div>
        </div>

        <div>
            <!-- Les likes , recation et nombre commentaire -->
            <hr>
            <div class="reactions">
                <!-- Reactions -->
                <div><span class="icon-thumbs-up"></span>J'aime</div>
                <div><span class="icon-chat-1"></span>Commenter</div>
                <div><spanv class="icon-share"></span>Partager</div>
                <div><span class="icon-paper-plane"></span>Envoyer</div>
            </div>
        </div>
    </div>    
       
</section>`
}
function templatePost(donnees,i){
    if (donnees[i][0].photo == null ){
        return `<section class="section_posts">
        <div class="infos_user">
                <img src="images/default_avatar.png" alt="Photo par defaut">
            <div>
                <p>${donnees[i][0].firstname}  ${donnees[i][0].lastname}</p>
                 <p>Suivis par </p>
                <p></p>
                 <!-- Date -->
              
            </div>
        </div>
        <div>
            <p class="p_content">${donnees[i][0].content.substr(0, 200)} </p>
            <a id ="${donnees[i][0].id}" href="fil_actu.php?id=${donnees[i][0].id}#section_${donnees[i][0].id}">... Voir plus</a>

            <div>
            </div>

            <div>
                <!-- Les likes , recation et nombre commentaire -->
                <hr>
                <div class="reactions">
                    <!-- Reactions -->
                    <div><span class="icon-thumbs-up"></span>J'aime</div>
                    <div><span class="icon-chat-1"></span>Commenter</div>
                    <div><spanv class="icon-share"></span>Partager</div>
                    <div><span class="icon-paper-plane"></span>Envoyer</div>
                </div>
            /div>
        </div>    
    </section>`

    }
    else{
        return `<section class="section_posts">
        <div class="infos_user">
                <img src="${donnees[i][0].photo}" alt="Photo par defaut">
            <div>
                <p>${donnees[i][0].firstname}  ${donnees[i][0].lastname}</p>
                 <p>Suivis par </p>
                <p></p>
                 <!-- Date -->
               
            </div>
        </div>
        <div>
            <p class="p_content">${donnees[i][0].content.substr(0, 200)} </p>
            <a id ="${donnees[i][0].id}" href="fil_actu.php?id=${donnees[i][0].id}#section_${donnees[i][0].id}" >... Voir plus</a>

            <div>
            </div>

            <div>
                <!-- Les likes , recation et nombre commentaire -->
                <hr>
                <div class="reactions">
                    <!-- Reactions -->
                    <div><span class="icon-thumbs-up"></span>J'aime</div>
                    <div><span class="icon-chat-1"></span>Commenter</div>
                    <div><spanv class="icon-share"></span>Partager</div>
                    <div><span class="icon-paper-plane"></span>Envoyer</div>
                </div>
            </div>
        </div>    
           
    </section>`
    }
    
}