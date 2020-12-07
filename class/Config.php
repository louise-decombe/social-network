<?php 

    require 'Db.php';
    $db = new DB();

    require 'User.php';
    $user = new User($db);

    require 'Message.php';
    $message = new Message($db);

    global $db;

    
?>