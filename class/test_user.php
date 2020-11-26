<?php

Class User {

    private $bd;
    private $connect;

    public function __construct($bd){
        $this->bd = $bd;
        $this->connect = $this->bd->connectDb();
    }

    public function GetUsers(){
        $requete = $this->connect->prepare('SELECT * FROM users INNER JOIN cursus on users.cursus = cursus.id_cursus');
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
        if($filtre == "droits" || $filtre == "name_cursus" ){
            $requete = $this->connect->prepare('SELECT * FROM users INNER JOIN cursus on users.cursus = cursus.id_cursus WHERE '.$filtre.' = ?' );
            $requete->execute([$donnee]);
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        }
        else{
            $requete =  $this->connect->prepare('SELECT * FROM users INNER JOIN cursus on users.cursus = cursus.id_cursus ORDER BY '.$donnee.'' );
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        }
        
    }

   
    public function searchAdmin($search){
		$stmt = $this->connect->prepare("SELECT * FROM `users` INNER JOIN cursus ON users.cursus = cursus.id_cursus WHERE `firstname`  LIKE ? OR `lastname` LIKE ? LIMIT 10");
		$stmt->bindValue(1, $search.'%', PDO::PARAM_STR);
		$stmt->bindValue(2, $search.'%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}


?>