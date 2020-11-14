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

    public function DeletUser($id_user){
        $requete = $this->connect->prepare('DELETE FROM `users` WHERE id = ?');
        $requete->execute([$id_user]);
    }
    
    public function Upgrade_statut($id_user,$droit){
        $requete = $this->connect->prepare("UPDATE `users` SET `droits`=? WHERE id = ?");
        $requete->execute([$droit,$id_user]);
    }
    public function GetUserBy($filtre,$donnee){
        if($filtre == "droits"){
            $requete = $this->connect->prepare('SELECT * FROM users WHERE '.$filtre.' = ?' );
            $requete->execute([$donnee]);
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        }
        else{
            $requete =  $this->connect->prepare('SELECT * FROM users ORDER BY '.$donnee.'' );
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        }
        
    }
}


?>