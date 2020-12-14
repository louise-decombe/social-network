<?php 

    require 'Db.php';
<<<<<<< HEAD
    require 'User.php';
    $db = new DB();
    $user = new User($db);
=======
    $db = new DB();

    require 'test_user.php';
    $user = new User($db);

    require 'Post.php';
    $post = new Post($db);
>>>>>>> celine
    
?>