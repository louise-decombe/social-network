//creation du tableau user
function tableauUsers(){
    return `<thead>
    <tr>
        <td>Prénom</td>
        <td>Nom</td>
        <td>Statut</td>
        <td>Cursus</td>
        <td>Supprimer</td>
    </tr>
</thead>`;
}


//creation de la partie du tableau
function tableau(donnee,data,i){
   
    if (donnee === "initialisation" || donnee === "tout" || donnee === "ORDER BY" ){
     
        if (data[i].droits === "administrateur"){
            return `<tr>
                        <td>${data[i].firstname}</td>
                        <td>${data[i].lastname}</td>
                        <td class="icon-tools"><button class="upgrade icon-up-fat" value="upgrade" id="${data[i].id}"></button></td>
                        <td>${data[i].name_cursus}</td>
                        <td><button  class="supp icon-trash" value='supprimer_users' id="${data[i].id}"></button></td>
                    </tr>`;
        }
        else{ 
            return `<tr>
                        <td>${data[i].firstname}</td>
                        <td>${data[i].lastname}</td>
                        <td class="icon-user"><button class="upgrade icon-up-fat" value="upgrade" id="${data[i].id}"></button></td>
                        <td>${data[i].name_cursus}</td>
                        <td><button  class="supp icon-trash" value='supprimer_users' id="${data[i].id}"></button></td>
                    </tr>`;
        }
        
    }
    else if (donnee === "utilisateur"){
        
            return `<tr>
        <td>${data[i].firstname}</td>
        <td>${data[i].lastname}</td>
        <td class="icon-user"><button class="upgrade icon-up-fat" value="upgrade" id="${data[i].id}"></button></td>
        <td>${data[i].name_cursus}</td>
        <td><button  class="supp icon-trash" value='supprimer_users' id="${data[i].id}"></button></td>
        </tr>`;
    }
    else if (donnee === "administrateur") {
        
        return `<tr>
        <td>${data[i].firstname}</td>
        <td>${data[i].lastname}</td>
        <td class="icon-tools"><button class="upgrade icon-up-fat" value="upgrade" id="${data[i].id}"></button></td>
        <td>${data[i].name_cursus}</td>
        <td><button  class="supp icon-trash" value='supprimer_users' id="${data[i].id}"></button></td>
        </tr>`;
    }
    else  {
       
        if (data[i].droits === "administrateur"){
            return `<tr>
                        <td>${data[i].firstname}</td>
                        <td>${data[i].lastname}</td>
                        <td class="icon-tools"><button class="upgrade icon-up-fat" value="upgrade" id="${data[i].id}"></button></td>
                        <td>${data[i].name_cursus}</td>
                        <td><button  class="supp icon-trash" value='supprimer_users' id="${data[i].id}"></button></td>
                    </tr>`;
        }
        else{ 
            
            return `<tr>
                        <td>${data[i].firstname}</td>
                        <td>${data[i].lastname}</td>
                        <td class="icon-user"><button class="upgrade icon-up-fat" value="upgrade" id="${data[i].id}"></button></td>
                        <td>${data[i].name_cursus}</td>
                        <td><button  class="supp icon-trash" value='supprimer_users' id="${data[i].id}"></button></td>
                </tr>`;
        }
    }
    
    
} 

//faire une fonction pou eviter de repeter 3 fois le form
function formConfirmation(donnee){
    $("#action_alert").empty();
    if (donnee == 'users')
    {
        return `<form class="form_admin" method="POST" action='php/traitement_users_admin.php'>
                <span class="icon-cancel"></span>
                <label for="">Etes vous sur de vouloir supprimer cet utilisateur ?</label>
                <div>
                    <input class="form_confirm btn btn-success" type="submit" name='reponse' value='oui'>
                        <input class="form_confirm btn btn-danger" type="submit" name="reponse" value='non'>
                </div>
            </form>`;
    }
    else if (donnee == 'posts') {
        return `<form class="form_admin" method="POST" action='php/traitement_users_admin.php'>
                <span class="icon-cancel"></span>
                <label for="">Etes vous sur de vouloir supprimer ce post ?</label>
                <div>
                    <input class="form_confirm btn btn-success" type="submit" name='oui' value='oui'>
                        <input class="form_confirm btn btn-danger" type="submit" name="non" value='non'>
                </div>
            </form>`;
    }
    else if (donnee == 'cursus') {
        return `<form class="form_admin" method="POST" action='php/traitement_cursus_admin.php'>
                <span class="icon-cancel"></span>
                <label for="">Etes vous sur de vouloir supprimer ce cursus ?</label>
                <div>
                    <input class="form_confirm btn btn-success" type="submit" name='oui' value='oui'>
                    <input class="form_confirm btn btn-danger" type="submit" name="non" value='non'>
                </div>
            </form>`;
    }
    
    else {
        
        return `<form class="form_admin" method="POST" action='php/traitement_users_admin.php'>
                <span class="icon-cancel"></span>
                <label for="">Etes vous sur de vouloir supprimer ce commentaire ?</label>
                <div>
                    <input class="form_confirm btn btn-success" type="submit" name='oui' value='oui'>
                        <input class="form_confirm btn btn-danger" type="submit" name="non" value='non'>
                </div>
            </form>`;
    }
    
}
function template_upgrade(id_user){
    $("#action_alert").empty();
    return `<form class="form_admin" method="POST" action='php/traitement_users_admin.php'> 
                <span class="icon-cancel"></span>
                <label>Choissir le statut de l'utilisateur</label>
                <input type="hidden" id="${id_user}">
                <select class='form-control' name="statut" id="statut">
                    <option value="utilisateur">Utilisateur</option>
                    <option value="administrateur">Administrateur</option>
                </select>
                <input type='submit'  name='action' value='upgrade' id='upgrade' >
            </form>`;
}
// creation du tableau de base pour les post
function tablePost(signal){
    if (signal == "post"){
         return `   <tr>
            <td>Date</td>
            <td>Auteur</td>
            <td>Contenu</td>
        </tr>`;
    }else{
            return `   <tr>
            <td>Date</td>
            <td>Auteur</td>
            <td>Contenu</td>
            <td>Nombre de signalement</td>
            <td>Type</td>
            <td>Annuler</td>
            <td>Supprimer</td>

        </tr>`;
        }
}

function AffichagePosSansContent(data,i){
    return `<tr>
            <td>${data[i].date_created}</td>
            <td>${data[i].lastname} ${data[i].firstname}</td>
            <td><img src='${data[i].media}'</td>
            <td>${data[i].content} </td>
            </tr>`;
}
//tableau post
function tableauPost(data,i,signal,genre){
    if (signal == 'signal'){
        if (genre == "posts"){
            if (data[i].content == null){
                
                return `<tr>
                <td>${data[i].date_created}</td>
                <td>${data[i].lastname} ${data[i].firstname}</td>
                <td>Aucun contenu <button class='voir_post' data-genre= 'post' data-id=${data[i].id_post}> Voir le post</button></td>
                <td>${data[i].nbr}</td>
                <td>Post</td>
                <td><button value='annuler_signal_post' class='annuler_signal icon-cancel-1' id='${data[i].id_signal}'></button></td>
                <td><button value='supprimer_post' class='supp supp_post icon-trash' id='${data[i].id_post}'></button></td>
                </tr>`;
            }else{
            
                return `<tr>
                        <td>${data[i].date_created}</td>
                        <td>${data[i].lastname} ${data[i].firstname}</td>
                        <td>${data[i].content.substring(0, 100)} <button class='voir_post' data-genre= 'post' data-id=${data[i].id_post}> Voir la suite</button></td>
                        <td>${data[i].nbr}</td>
                        <td>Post</td>
                        <td><button value='annuler_signal_post' class='annuler_signal icon-cancel-1' id='${data[i].id_signal}'></button></td>
                        <td><button value=' supprimer_post' class='supp supp_post icon-trash' id='${data[i].id_post}'></button></td>
                        </tr>`;
            }
            

        }
        else{
            
            return `<tr>
            <td>${data[i].date_created}</td>
            <td>${data[i].lastname} ${data[i].firstname}</td>
            <td>${data[i].content.substring(0, 100)} <button class='voir_post'data-genre= 'comment' data-id=${data[i].id_comment}> Voir la suite</button></td>
            <td>${data[i].nbr}</td>
            <td>Commentaire</td>
            <td><button value='annuler_signal_comment' class='annuler_signal icon-cancel-1' id='${data[i].id_signal_comment}'></button></td>
            <td><button value='supprimer_comment' class='supp supp_comment icon-trash' id='${data[i].id_comment}'></button></td>
        </tr>`;
        }
            
    }
    else{
        console.log(data[i].content );
        if (data[i].content == 'null' ){
            return `<tr>
            <td>${data[i].date_created}</td>
            <td>${data[i].lastname} ${data[i].firstname}</td>
            <td>Aucun contenu </td>
            </tr>`;
           
        }else {
            return `<tr>
            <td>${data[i].date_created}</td>
            <td>${data[i].lastname} ${data[i].firstname}</td>
            <td>${data[i].content.substring(0, 100) } </td>
            </tr>`;
            
        }
            
    }
    
}




function tabLangage(data,i){
    return `<tr>
                <td><img class='logo_langage' src='php/upload/${data[i].logo}' /></td>
                <td>${data[i].nom}</td>
                <td><button data-image='${data[i].logo}'id="${data[i].id}"class='icon-trash supprimer'></button></td>
            </tr>`;
}

function tabCursus(data,i){
    return `<tr>
                <td>${data[i].name_cursus}</td>
                <td><button class="btn update_cursus" data-cursus='${data[i].id_cursus}'>Modifier</button></td>
                <td><button class="btn btn-danger delete_cursus" id='${data[i].id_cursus}' value="supprimer_cursus">Supprimer</button></td>
            </tr>`;
}

function FormUpdtate(data){
    return `<form id="form_update_cursus" action='php/traitement_cursus_admin.php'method='POST'>
                <span class="icon-cancel" ></span>
                <div class="form-group">
                    <label for='updtate_nom_cursus'>Nom de la formation</label>
                    <input type='text' id='updtate_nom_cursus' name='updtate_nom_cursus' value='${data.name_cursus}'>
                </div>
                <input type='submit' value='Modifier' name='btn_update_cursus' class="btn btn-info btn_update_cursus">
                
            </form>`;
}

    

 