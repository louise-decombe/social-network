<?php 

<<<<<<< HEAD
require 'Db.php';
$db = new DB();

=======

require 'Db.php';
$db = new DB();

>>>>>>> main
    require 'User.php';
   $user = new User($db);

    require 'Post.php';
    $post = new Post($db);

<<<<<<< HEAD
    require 'Search.php';
    $search = new Search($db);

    // require 'Message.php';
    // $message = new Message($db);

    // require 'Hashtag.php';
    // $tendance = new Hashtag($db);
=======
    require 'Searchs.php';
    $search = new Search($db);

    require 'Message.php';
    $message = new Message($db);

    require 'Hashtag.php';
    $tendance = new Hashtag($db);
>>>>>>> main

    //traitement de la déconnexion
if (isset($_POST["deco"])) {
    $user->disconnect();
}
<<<<<<< HEAD
    
?>
=======
>>>>>>> main
    
