<?php 

Class User {

    private $db;

    public function __construct($db){
        $this->db = $db;
        $this->connect = $this->db->connectDb();

    }


    public function checkInput($data){
		$data = htmlspecialchars($data);
		$data = trim($data);
		$data = stripcslashes($data);
		return $data;
	}
    public function search($search){
		$stmt = $this->connect->prepare("SELECT `id`,`firstname`,`lastname`,`photo` FROM `users` WHERE `firstname` LIKE ? OR `lastname` LIKE ?");
		$stmt->bindValue(1, $search.'%', PDO::PARAM_STR);
		$stmt->bindValue(2, $search.'%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
  

}
