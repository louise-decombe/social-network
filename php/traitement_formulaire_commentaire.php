<?php 
session_start();

//A RENDRE DYNAMIQUE
$id_user = 93;

require '../class/Config.php';
require '../class/Comment.php';

$comment = new Comment($db);

if (isset($_POST['enregistrer'])){
   
   if (!empty($_POST['commentaire'])){
       
    $commentaire = $_POST['commentaire'];
    $id_post = $_POST['id_post'];

    echo $comment->SetComment($id_post,$commentaire,$id_user);

   }
   else {
       $_SESSION['erreur'] = "Ce champs ne peut etre vide";
   }
}

if (isset($_POST['action'])){
   
    $id_post = $_POST['id_post'];

    $commentaires = $comment->GetCommentByIdPost($id_post);
  
    echo json_encode($commentaires);
}







?>