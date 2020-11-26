<?php

class Membre_groupe{
    private $bdd;
    private $connect;

    public function __construct($bdd){
        $this->bdd = $bdd;
        $this->connect = $this->bdd->connectDb();
    } 

    public function GetTopGroupe(){
        $requete = $this->connect->prepare("SELECT id_groupe,groupe.nom,count(`id_groupe`) AS nbr FROM `groupe_membre` INNER JOIN groupe ON groupe_membre.id_groupe = groupe.id GROUP by `id_groupe` ORDER BY nbr DESC LIMIT 3");
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;

    }
}

?>