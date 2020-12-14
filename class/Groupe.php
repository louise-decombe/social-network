<?php

class Groupe {
    private $bdd;
    private $connec;

    public function __construct($bdd){
        $this->bdd = $bdd;
        $this->connect = $this->bdd->connectDb();
    }

    public function GetGroupe(){
        $requete = $this->connect->prepare('SELECT * FROM `groupe` ');
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getNameGroupeByUser($id_user){
        $requete = $this->connect->prepare("SELECT * FROM `groupe` INNER JOIN groupe_membre ON groupe.id = groupe_membre.id_groupe INNER JOIN users ON groupe_membre.id_user = users.id WHERE users.id = ? ");
        $requete->execute([$id_user]);
        $result = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
    }
}

?>