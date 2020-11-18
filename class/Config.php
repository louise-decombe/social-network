<?php 

    require 'Db.php';
    require 'User.php';
    $db = new DB();
    $user = new User($db);
    
?>