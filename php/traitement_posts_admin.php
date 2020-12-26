<?php session_start();

require "../class/Config.php";
//require "../class/Post.php";
require "../class/Signal.php";
require "../class/Comment.php";

$post = new Post($db);
$Signal = new Signal($db);
$comment = new Signal_comment($db);
$commentaire = new Comment($db);

if (isset($_POST['action'])){
    if ($_POST['action'] == "recuperation"){
        $date = date("Y-m-d");
        $result = $post->GetAllPost($date);
        echo json_encode($result);
    }
}


if (isset($_POST["reponse"])){
    if ($_POST['action'] == "supprimer_post"){
        $id = $_POST['id'];
        $post->DeletPost($id);
        echo true;
    }
}

if (isset($_POST["reponse"])){
    if ($_POST['action'] == "supprimer_comment"){
        $id= $_POST['id'];
        $commentaire->DeleteComment($id);
        echo true;
    }
}

if (isset($_POST['action'])){
    if ($_POST['action'] == "compter_signal"){
        $result = COUNT($Signal->GetAllPostSignal());
    
        //compter le nbre de signal comment
        $resultat_comment = COUNT($comment->GetAllCommentSignal());
    
        echo json_encode(["posts"=>$result,"comment"=>$resultat_comment]);
    }

    if ($_POST['action'] == "recuperation post signalement"){

        //RECUPERATION DES POSTS SIGNALES
        $result = $Signal->GetAllPostSignal();
    
        //recuperation des comments signalé
        $resultat = $comment->GetAllCommentSignal();
    
        //envois des deux donnees ajax
        echo json_encode(["signal_posts"=>$result, "signal_comment"=>$resultat]);
    }
    
    if ($_POST['action'] == "recuperation d'un commentaire"){
        $id = $_POST['id'];
        $resultat = $commentaire->GetCommentById($id);
        echo json_encode($resultat);
    }
    
    if ($_POST["action"] == "annuler_signal_post"){
        $id_post = $_POST['id'];
        $Signal->CancelSignalPost($id_post);
        echo true;
    }
    
    if ($_POST["action"] == "annuler_signal_comment"){
        $id_comment = $_POST['id'];
        $comment->CancelSignalComment($id_comment);
        echo true;
    }

    if($_POST['action'] == "afficher_plus"){
        $id = $_POST['id_post'];
        $resultat = $post->GetContentById($id);
        echo json_encode($resultat);
    }
}






?>