<?php
session_start();
require '../class/Config.php';
//isset($_POST['submit_connexion']) && 
if (!empty($_POST['mail']) && isset($_POST['mail']) && !empty($_POST['password']) && isset($_POST['password'])){

    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $connect_user = $user->connect($mail, $password);
    $_SESSION['user'] = $connect_user;
    echo "success";
    //header('location:../profile.php');

}else{
    echo "false";
}

?>

