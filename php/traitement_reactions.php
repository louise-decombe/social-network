<?php session_start();

require '../class/Config.php';
require '../class/Signal.php';

$signal = new Signal($db);
$comment = new Signal_comment($db);



//a rendre dynamique
//$id_user = $_SESSION['user']['id'];
$id_user = 93;


if ($_POST['action'] == "enregistrement"){
    $id_post=$_POST['id_post'];


    $resultats = $reaction->GetreactionByIdUserAndIdPost($id_user,$id_post);


    //Si pas vide c est qu il a deja reagit dessus
    if (count($resultats) == 0){
        $id_reaction= 1 ; // car j aime
        echo $reaction->SetReaction($id_user,$id_post,$id_reaction);

    }
    else {
        echo $reaction->DeleteReaction($id_post,$id_user);
    }
}

if ($_POST['action'] == "enregistrement_reactions"){
    $id_post = $_POST['id_post'];
    $id_img = $_POST['id_reaction'];

    if ($id_img == "jaime"){
        $id_reaction = 1;
    } 
    elseif($id_img == "bravo"){
        $id_reaction = 2;
    }
    elseif($id_img == "soutien"){
        $id_reaction = 3;
    }
    elseif($id_img == "jadore"){
        $id_reaction = 4;
    }
    elseif($id_img == "instructif"){
        $id_reaction = 5;
    }
    elseif($id_img == "interressant"){
        $id_reaction = 6;
    }

    //verification si la personne n'a pas deja reagis
    $resultat = $reaction->GetreactionByIdUserAndIdPost($id_user,$id_post);
    
    if (COUNT($resultat) == 0){
         $reaction->SetReaction($id_user,$id_post,$id_reaction);
         echo "success";
        
    }else {
        //si deja reagis mais clique sur un autr emoji on update la reaction
        if ($resultat[0]['id_reactions'] != $id_reaction ){
            
            $reaction->UpdateReaction($id_reaction,$id_post,$id_user);
            echo "success";
            
        }else {
            echo $reaction->DeleteReaction($id_post,$id_user);
            
        }
    }
}

if ($_POST['action'] == 'recup'){
   
    $id_post = $_POST['id_post'];

    $resultat = $reaction->getAllreactionsByIdPost($id_post);

    echo json_encode($resultat);
}

if ($_POST['action'] == "signal"){
    $id_post = $_POST['id_post'];


    //Verification que l'user n'a pas deja signalé ce post
    $resultat = $signal->GetPostSignal($id_user,$id_post);
    
    if (empty($resultat) ){
        echo $signal->setSignal($id_post,$id_user);
    }else {
        echo "true";
    }

    
 
   
}

if ( $_POST['action'] == 'signal commentaire' ){
    echo "ici";

    $id_comment = $_POST['id_comment'];
    //verification si l utilisateur n'a pas dejas signalé le commentaire
    $commentaires = $comment->GetCommentSignal($id_user,$id_comment);
    var_dump($commentaires);

    if (empty($commentaires)){

        $comment->setCommentSignal($id_user,$id_comment);
    }

}


if ($_POST['action'] == 'update_reactions'){
    $id_post = $_POST['id_post'];
    //echo $id_post;
 
    //on recupere toutes les reactions
    $r = $reaction->getAllreactionsByIdPost($id_post);
    echo json_encode(["reaction" =>$r]);

 }






?>