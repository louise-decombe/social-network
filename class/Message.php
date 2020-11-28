<?php 

Class Message {

    private $db;

    public function __construct($db){
        $this->db = $db;
        $this->connect = $this->db->connectDb();

    }


   
    public function showMessages($search){

    }
    
  

}
