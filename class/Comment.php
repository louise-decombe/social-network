<?php

class Comment{
    private $bdd;
    private $connect;

    public function __construct($bdd){
        $this->bdd = $bdd;
        $this->connect = $this->bdd->connectDb();
    }

    public function SetComment($id_post,$commentaire,$id_user){
        $requete = $this->connect->prepare('INSERT INTO `comment`( `id_user`, `content`, `created_at`, `id_post`) VALUES (?,?, NOW() ,?)');
        $requete->execute([$id_user,$commentaire,$id_post]);
        return true;
    }

    public function DeleteComment($id){
        $requete = $this->connect->prepare("DELETE FROM `comment` WHERE id = ?");
        $requete->execute([$id]);
        return true;
    }

    public function GetCommentById($id){
        $requete = $this->connect->prepare("SELECT * FROM comment WHERE id= ?");
        $requete->execute([$id]);
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function GetCommentByIdPost($id_post){
        $requete = $this->connect->prepare("SELECT *, comment.id AS id_comment FROM comment INNER JOIN users ON comment.id_user = users.id  WHERE id_post= ? ORDER BY comment.id DESC");
        $requete->execute([$id_post]);
        $resultat = $requete->fetchall(PDO::FETCH_ASSOC);
        return $resultat;
    }

    
}