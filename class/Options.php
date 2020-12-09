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

}
?>

