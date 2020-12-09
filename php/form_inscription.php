<?php

require '../class/Config.php';

if(isset($_POST['submit_register'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $mail = $_POST['mail'];
    $cursus = $_POST['cursus'];
    $password = $_POST['password'];
    $check_pass = $_POST['check_password'];
  

    // on fait appel à la class user pour enregistrer les infos passées dans le formulaire
    $new_user = $user->register($firstname, $lastname, $mail, $cursus, $password, $check_pass);
    header('location:../profile.php');

};

try
{

$connexion=new PDO("mysql:host=localhost;dbname=social-network",'root','root');
$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

if (!empty($_POST['mail']) && isset($_POST['mail'])){

    $mail = ($_POST['mail']);
    //$user_exist = $user->get_mail($mail);

    $q = $connexion->prepare("SELECT mail FROM users WHERE mail=:mail");
    $q->bindParam(':mail', $mail, PDO::PARAM_STR);
    $q->execute();
    $user = $q->fetch(PDO::FETCH_ASSOC);

    if ($user > 0){
        echo 'exist';
    } 
}

}
catch (PDOException $e){
    echo "Erreur : " . $e->getMessage();
};

?>