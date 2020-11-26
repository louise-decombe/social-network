<?php


class Message extends User {


    private $db;

    public function __construct($db){
        $this->db = $db;
        $this->connect = $this->db->connectDb();

    }
  

}

?>