<?php

class User{
    private $id_user;
    public $firstname;
    public $lastname;
    public $password;
    public $mail;
    public $cursus;
    public $date_promo;
    public $photo;
    public $birthday;
    public $entreprise;
    public $localite;
    public $website;
    public $hobbies;
    public $droits;

    public function __construct($db)
    {
    $this->db = $db;
    }

}


?>