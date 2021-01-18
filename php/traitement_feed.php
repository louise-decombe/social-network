<?php 

$page_selected = 'feed'; 


// A RENDRE DINAMIQUE
// $id_user = 93;
// $_SESSION['user']['id'] = 93;

$id_user = $_SESSION['user']['id'];

if (!isset($id_user)){
    $_SESSION['erreur'] = "Vous devez etre connecté pour acceder à cette page";
    header("location: connexion.php");
}

if ( !isset($_POST['action'])){
    // require 'class/Groupe.php';
    require 'class/Follower.php';
    require 'class/Comment.php';

    // $groupe = new Groupe($db);
    $follow = new Follower($db);
    $comment = new Comment($db);
}
else{

    // require '../class/Groupe.php';
    require '../class/Follower.php';
    require '../class/Config.php';
    require '../class/Comment.php';

    // $groupe = new Groupe($db);
    $follow = new Follower($db);
    $comment = new Comment($db);

}


//recuperation des infos de bases
//infos perso + nombre de personne suivis
$infos_user = $user->Recuperation_personnes_suivis($id_user);

//recuperation groupe
//$groupes = $groupe->getNameGroupeByUser($id_user);

//recuperation de toutes les personnes suivi par l utilisateur
$followers = $follow->GetFollowerUser($id_user);
$_SESSION['followers'] = $followers;

//on boucle sur les id des personnes suivi
if (!empty($followers)){
    for ($i = 0 ; $i < COUNT($followers) ; $i++){
        //requete avec les id des amis de l'utilisateurs
        //on recupere les personnes qui suive ces personnes
        if (!isset($nbr)){
            $nbr=[];
            $nbr[]= $follow->Get_follow($followers[$i]['id_user_follow'],$id_user);
            
        }else{
            $nbr[]= $follow->Get_follow($followers[$i]['id_user_follow'],$id_user);
        }
    }

    //tab des amis
    $tab_user=[];
    for ($i=0 ; $i < count($followers); $i++){
        $tab_user[$i]=$followers[$i]['id_user_follow'];
        $_SESSION['tab_user'] = $tab_user;
    }

    //tab des personne qui suive les meme personne

    for ($i=0 ; $i < count($nbr); $i++){
        for ($j=0 ; $j < count($nbr[$i]); $j++){
            $tab_communs[]=$nbr[$i][$j]['id_user'];
        }
    }
    if (isset($tab_communs)){
        //comparer les 2 Tab //On supprime les valeurs identique car cela nous indique que l utilisateur sur deja la personne
        $amis_en_communs = array_unique(array_diff($tab_communs,$tab_user));

        //recuperation de tous les amis de cette personnes
        for ($i = 0 ; $i < COUNT($amis_en_communs) ; $i++){
            $tab1[$i] = count($follow->GetFollowerUser($amis_en_communs[$i]));
        }
    }
     
}

// RECUPERATION DE TOUT LES POST

if (!isset($_POST['action'])){
    $limit = 0;
    $All_posts = $post->GetPostsByIdUser($limit);


    if (!isset($reaction_post)){
        $reaction_post = [];
    }
    //recuperation des posts des tout les amis et les siens 
    if (!empty($followers)){
        for ($i = 0 ; $i < COUNT($tab_user) ; $i ++){
       
            for ($j = 0 ; $j < COUNT($All_posts) ; $j++){
                
                if ($tab_user[$i] == $All_posts[$j]['id_user'] ){
                    $posts[$j] = $All_posts[$j];
                   
                    $tab_id_posts[$j] = $posts[$j]['id_post'];
                    $_SESSION['posts'] = $tab_id_posts;
                    
                }
                if ($All_posts[$j]['id_user'] == $id_user){
                    $posts[$j] = $All_posts[$j];
                   
                    $tab_id_posts[$j] = $posts[$j]['id_post'];
                    $_SESSION['posts'] = $tab_id_posts;
                    
                }
            
            }
            
        }
    
    
    }
    else {
        for ($j = 0 ; $j < COUNT($All_posts) ; $j++){

            if ($All_posts[$j]['id_user'] == $id_user){
                $posts[$j] = $All_posts[$j];
            
                $tab_id_posts[$j] = $posts[$j]['id_post'];
                $_SESSION['posts'] = $tab_id_posts;
                
            }
        }

     }

     //on recupere toutes les reactions
     $reaction_post = $reaction->getAllreactions();
 
}

if (isset($_POST['action'])){
 
    if ($_POST['action'] == "More_post"){
        
        $limit = $_POST['limit'];
     
        $tableau_limit = $post->GetPostsByIdUser($limit);
      
        $reaction_post = $reaction->getAllreactions();
       
       


        for ($i = 0 ; $i < COUNT($tableau_limit) ; $i++ ){
           
           for ($c = 1 ; $c <= 6 ; $c ++){
              
                $react[$c] = $reaction->GetreactionByReaction($tableau_limit[$i]['id_post'],$c);
                $tableau[$tableau_limit[$i]['id_post']] = $react;
              
            }
            //compteur nombre commentaire et affichage a coter picto
            $compteurCommentaires[$i] = COUNT($comment->GetCommentByIdPost($tableau_limit[$i]['id_post']));
            // ajout du nombre de personne qui suit l'auteur du post
            $nombre_de_suivis = $follow->FollowedBy($tableau_limit[$i]['id_user']);
            
        }
       
        
        
        echo json_encode(["post" =>  $tableau_limit, "reaction" => $reaction_post , "tableau" => $tableau , "compteurCommenatires" => $compteurCommentaires, "suivis" => $nombre_de_suivis ]);
    }


    if ($_POST['action'] == "Recuperation_Reactions"){
        $id_post = $_POST['id_post'];
        $compteur = Count($reaction->getAllreactionsByIdPost($id_post));
        $all_reactions_byPost = $reaction->getAllreactionsByIdPost($id_post);
      
        echo json_encode(["compteur" => $compteur , "user" => $all_reactions_byPost]);
    }

    if ($_POST['action'] == "Recuperation_commentaires"){
        $id_post= $_POST['id_post'];
        $commentaires = $comment->GetCommentByIdPost($id_post);
        echo json_encode($commentaires);
    }
}



?>