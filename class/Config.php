<?php 

    require 'Db.php';
    $db = new DB();

    require 'User.php';
    $user = new User($db);
    
?>