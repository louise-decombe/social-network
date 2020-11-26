<?php

class Cursus
{
    private $bdd;
    private $connect;

    public function __construct($bdd){
        $this->bdd = $bdd;
        $this->connect = $this->bdd->connectDb();
    }

    public function getCursus(){
        $requete = $this->connect->prepare("SELECT * FROM cursus");
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function DeleteCursus($id){
        $requete = $this->connect->prepare("DELETE FROM `cursus` WHERE id_cursus = ?");
        $requete->execute([$id]);
        return true;
    }

    public function InsertCursus($name){
        $requete = $this->connect->prepare("INSERT INTO `cursus`(`name_cursus`) VALUES (?)");
        $requete->execute([$name]);
        return true;
    }

    public function GetCursusById($id){
        $requete = $this->connect->prepare("SELECT * FROM `cursus` WHERE id_cursus= ?");
        $requete->execute([$id]);
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function UpdateCursus($id,$nom){
        $requete = $this->connect->prepare("UPDATE `cursus` SET `name_cursus`= ? WHERE id_cursus = ?");
        $requete->execute([$nom,$id]);
        return true;
    }
}



?>