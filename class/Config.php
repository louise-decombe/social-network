<?php 


require 'Db.php';
$db = new DB();
    
<<<<<<< HEAD
    // require 'User.php';
    // $user = new User($db);
=======
    //require 'User.php';
   // $user = new User($db);
>>>>>>> 108fe620d73db74705f7eb7fac5cef2a9fc48ebc

    require 'test_user.php';
    $user = new User($db);

    require 'Post.php';
    $post = new Post($db);

    // require 'Search.php';
    // $search = new Search($db);

    require 'Message.php';
    $message = new Message($db);

    require 'Hashtag.php';
    $tendance = new Hashtag($db);

    //traitement de la déconnexion
if (isset($_POST["deco"])) {
    $user->disconnect();
}
    
?>