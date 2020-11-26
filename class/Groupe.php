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
}

?>