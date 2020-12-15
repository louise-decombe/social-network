<?php

class Follower
{
    private $bdd;
    private $connect;

    public function __construct($bdd){
        $this->bdd = $bdd;
        $this->connect = $this->bdd->connectDb();
    }

    // recuperation de toute les personnes suivi par l'utilisateur
    public function GetFollowerUser($id_user){
        $requete = $this->connect->prepare('SELECT * FROM follower WHERE id_user = ?');
        $requete->execute([$id_user]);
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    //recuperation du nombre d'amis en communs
    public function Get_follow($id_follow,$id_user){
        $requete = $this->connect->prepare("SELECT * FROM follower  WHERE id_user_follow=? and id_user != ? ");
        $requete->execute([$id_follow,$id_user]);
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function GetAllInfos($id_user){
        $requete = $this->connect->prepare('SELECT * FROM follower INNER JOIN users ON follower.id_user = users.id WHERE id_user = ?');
        $requete->execute([$id_user]);
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    //recuperation de toutes les personnes qui suit un utilisateur
    public function FollowedBy($id_user){
        $requete = $this->connect->prepare('SELECT * FROM follower WHERE id_user_follow= ?');
        $requete->execute([$id_user]);
        $resultat = $requete->fetchall(PDO::FETCH_ASSOC);
        return COUNT($resultat);
    }

 
}



?>