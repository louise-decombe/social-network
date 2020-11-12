<?php 

    require 'Db.php';
    $db = new DB();

    require 'test_user.php';
    $user = new User($db);
    
?>