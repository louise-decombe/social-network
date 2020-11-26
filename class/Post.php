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

    public function DeletPost($id){
        $requete = $this->connect->prepare("DELETE FROM `post` WHERE id = ?");
        $requete->execute([$id]);
        return true;
    }
    
}





?>