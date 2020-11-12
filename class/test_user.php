<?php

Class User {

    private $bd;
    private $connect;

    public function __construct($bd){
        $this->bd = $bd;
        $this->connect = $this->bd->connectDb();

    }

    public function GetUsers(){
        $requete = $this->connect->prepare('SELECT * FROM users');
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }
}


?>