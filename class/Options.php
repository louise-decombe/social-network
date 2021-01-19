<?php

class Options{

public $db;

public function __construct($db)
	{
	$this->db = $db;
	}

// SELECT CURSUS
public function cursus_list()
    {
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT * FROM cursus");
        $q->execute();
        $cursus_list = $q->fetchAll(PDO::FETCH_ASSOC);
        //PDO::FETCH_ASSOC

        return $cursus_list;
    }


public function tech_list()
    {
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT * FROM technologies");
        $q->execute();
        $tech_list = $q->fetchAll();
        //PDO::FETCH_ASSOC

        return $tech_list;
    }


public function techno($id_user){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT *
                                 FROM technologies
                                 INNER JOIN user_tech
                                 ON technologies.id = user_tech.id_technologie
                                 WHERE user_tech.id_user = $id_user");
        $q->execute();
        $tech_name = $q->fetchAll();
        return  $tech_name;
    }
}
?>

