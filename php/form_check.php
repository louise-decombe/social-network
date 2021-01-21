<?php

//require '../class/Config.php';

/*if (isset($_POST['submit_connexion']) && !empty($_POST['mail']) && isset($_POST['mail']) && !empty($_POST['password']) && isset($_POST['password'])){

    $mail = $_POST['mail'];
    $password = $_POST['password'];

    // on fait appel à la class user pour enregistrer les infos passées dans le formulaire
    $connect_user = $user->connect($mail, $password);
    //header('location:../profile.php');

}*/

try
{

$connexion=new PDO("mysql:host=localhost;dbname=social-network",'root','root');
$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    if (!empty($_POST['mail'] && isset($_POST['mail']))){

        $mail = $_POST['mail'];
    
        $q = $connexion->prepare("SELECT mail FROM users WHERE mail=:mail");
        $q->bindParam(':mail', $mail, PDO::PARAM_STR);
        $q->execute();
        $user = $q->fetch(PDO::FETCH_ASSOC);

        if ($user > 0){
            echo 'exist';
        } 
    }

    if (!empty($_POST['mail']) && isset($_POST['mail']) && !empty($_POST['password']) && isset($_POST['password'])){
        
        $mail = $_POST['mail'];
        $password = $_POST['password'];

        $q1 = $connexion->prepare("SELECT * FROM users WHERE mail=:mail");
        $q1->bindParam(':mail', $mail, PDO::PARAM_STR);
        $q1->execute();
        $pass_check = $q1->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password, $pass_check['password'])){
            echo ' password_correct';
        }
    
    }
 
 
}

catch (PDOException $e)
        {
        echo "Erreur : " . $e->getMessage();
        };

        

?>