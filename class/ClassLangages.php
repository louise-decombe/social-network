<?php

class ClassLangages
{
    private $bdd;
    private $connect;

    public function __construct($bdd){
        $this->bdd = $bdd;
        $this->connect = $this->bdd->connectDb();
    }  

    public function GetLangage(){
        $requete = $this->connect->prepare("SELECT * FROM technologies");
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }
    public function GetCountLangageByName($nom){
        $requete = $this->connect->prepare("SELECT count(*) as nbre FROM technologies WHERE nom = ?" );
        $requete->execute([$nom]);
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }
    
    public function RegisterLangage($nom,$image){
        $requete = $this->connect->prepare("INSERT INTO `technologies`(`nom`,`logo`) VALUES (?,?)");
        $requete->execute([$nom,$image]);
        return true;
    }

   public function DeleteLangage($id){
       $requete = $this->connect->prepare("DELETE FROM `technologies` WHERE id = ?");
       $requete->execute([$id]);
       return true;
   }
    // public function GetLangageById($id){
    //     $requete = $this->connect->prepare("SELECT * FROM technologies WHERE id = ?");
    //     $requete->execute([$id]);
    //     $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    //     return $resultat;
    // }
}

?>