<?php

class Comment{
    private $bdd;
    private $connect;

    public function __construct($bdd){
        $this->bdd = $bdd;
        $this->connect = $this->bdd->connectDb();
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
}