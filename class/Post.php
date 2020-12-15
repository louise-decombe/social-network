<?php

class Post
{
    private $bdd;
    private $connect;

    public function __construct($bdd){
        $this->bdd = $bdd;
        $this->connect = $this->bdd->connectDb();
    }

    public function GetAllPost($date){
        $requete = $this->connect->prepare("SELECT post.id, post.content, date_format(post.created_at,'%d/%m/%Y') AS date_created,post.media, users.firstname, users.lastname FROM post INNER JOIN users ON post.id_user = users.id WHERE post.created_at = '$date' ");
        $requete->execute();
        $resultat = $requete->fetchall(PDO::FETCH_ASSOC);

        return $resultat;
    }

    public function GetPostsByIdUser(){
        $requete = $this->connect->prepare("SELECT *, date_format(post.created_at,'%d/%m/%Y') AS date_created,post.media FROM post INNER JOIN users ON post.id_user = users.id  ORDER BY created_at DESC ");
        $requete->execute();
        $resultat = $requete->fetchall(PDO::FETCH_ASSOC);

        return $resultat;
    }

    public function DeletPost($id){
        $requete = $this->connect->prepare("DELETE FROM `post` WHERE id = ?");
        $requete->execute([$id]);
        return true;
    }

    public function GetLastPost($id_user){
        $requete = $this->connect->prepare("SELECT * FROM post INNER JOIN users ON post.id_user = users.id WHERE id_user = ? ORDER BY post.created_at DESC LIMIT 3");
        $requete->execute([$id_user]);
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function setPost($message,$image,$id_user,$type){
        $requete = $this->connect->prepare("INSERT INTO `post`( `id_user`, `content`, `created_at`, `media`, `type_media`) VALUES (?,?,NOW(),?,?)");
        $requete->execute([$id_user,$message,$image,$type]);
        return true;
    }
    
}





?>