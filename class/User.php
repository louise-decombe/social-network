<?php

require 'Infos.php';

class User{
    private $id_user;
    public $firstname;
    public $lastname;
    public $password;
    public $mail;
    public $cursus;
    public $date_promo;
    public $photo;
    public $birthday;
    public $entreprise;
    public $localite;
    public $website;
    public $hobbies;
    public $droits;
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // FONCTION CONNEXION USER

    public function connect($mail, $password){

        $connexion = $this->db->connectDb();

        $q = $connexion->prepare("SELECT * FROM users WHERE mail = :mail");
        $q->bindParam(':mail', $mail, PDO::PARAM_STR);
        $q->execute();
        $user = $q->fetch(PDO::FETCH_ASSOC);
        //var_dump($user);

        if (!empty($user)){
            if(password_verify($password, $user['password'])){
                $this->id_user = $user['id'];
                $this->firstname = $user['firstname'];
                $this->lastname = $user['lastname'];
                $this->mail = $user['mail'];
                $this->cursus = $user['cursus'];
                $this->date_promo = $user['date_promo'];
                $this->photo = $user['photo'];
                $this->birthday = $user['birthday'];
                $this->entreprise = $user['entreprise'];
                $this->localite = $user['localite'];
                $this->website = $user['website'];
                $this->hobbies = $user['hobbies'];
                $this->droits = $user['droits'];

                $_SESSION['user']=[
                    'id'=>  
                        $this->id_user,
                    'firstname'=>
                        $this->firstname,
                    'lastname'=>
                        $this->lastname,
                    'mail'=>
                        $this->mail,
                    'cursus'=>
                        $this->cursus,
                    'date_promo'=>
                        $this->date_promo,
                    'photo'=>
                        $this->photo,
                    'birthday'=>
                        $this->birthday,
                    'entreprise'=>
                        $this->entreprise,
                    'localite'=>
                        $this->localite,
                    'website'=>
                        $this->website,
                    'hobbies'=>
                        $this->hobbies,
                    'droits'=>
                        $this->droits
                ];
                header('location:../index.php');
                return $_SESSION['user']; 

            }else{
                $errors[]="le mot de passe est erroné";
                $info = new Infos($errors);
                echo $info->renderInfo();
            }

        }else{
            $errors[]="cette adresse email est introuvable";
            $info = new Infos($errors);
            echo $info->renderInfo();
        }
    }

    // FONCTION DECONNEXION USER

    public function disconnect(){
        $this->id_user = "";
        $this->firstname = "";
        $this->lastname = "";
        $this->mail = "";
        $this->cursus = "";
        $this->date_promo = "";
        $this->photo = "";
        $this->birthday = "";
        $this->entreprise = "";
        $this->localite = "";
        $this->website = "";
        $this->hobbies = "";
        $this->droits = "";
        session_unset();
        session_destroy();
        header('location: ../index.php');
    }

    // FONCTION REGISTER USER

    public function register($firstname, $lastname, $mail, $cursus, $password, $check_pass){
        $connexion = $this->db->connectDb();
        //firstname
        $firstname_required = preg_match("/^(?=.*[A-Za-z]$)[A-Za-z][A-Za-z\-]{2,19}$/", $firstname);
        if (!$firstname_required) {
            $errors[] = "Le prénom doit :<br>- Comporter entre 3 et 19 caractères.<br>- Commencer et finir par une lettre.<br>- Ne contenir aucun caractère spécial (excepté -).";
        }

        //lastname
        $lastname_required = preg_match("/^(?=.*[A-Za-z]$)([A-Za-z]{2,25}[\s]?[A-Za-z]{1,25})$/", $lastname);
        if (!$lastname_required) {
            $errors[] = "Le nom doit:<br>- Comporter entre 3 et 50 caractètres.<br>- Commencer et finir par une lettre.<br>- Ne contenir aucun caractère spécial (excepté un espace).";
        }
        
        //email
        $email_required = preg_match("/^[a-zA-Z0-9]+@laplateforme\.io$/", $mail);
        if (!$email_required) {
            $errors[] = "L'email n'est pas conforme. Vous devez entrer une adresse email se terminant par @laplateforme.io";
        }

        $q = $connexion->prepare("SELECT mail FROM users WHERE mail = :mail");
        $q->bindParam(':mail', $mail, PDO::PARAM_STR);
        $q->execute();
        $email_check = $q->fetch();
        if (!empty($email_check)) {
            $errors[] = "Cette adresse mail est déjà utilisée.";
        }

        //password

        $password_required = preg_match("/^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/",$password);
        if (!$password_required) {
            $errors[] = "Le mot de passe doit contenir:<br>- Entre 8 et 20 caractères<br>- Au moins 1 caractère spécial<br>- Au moins 1 majuscule et 1 minuscule<br>- Au moins un chiffre.";
        }
        if ($password != $check_pass) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        } else {
            $password_modified = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
        }


        if (empty($firstname) or empty($lastname) or empty($mail) or empty($cursus) or empty($password) or empty($check_pass)) {
            $errors[] = "Tous les champs doivent être remplis.";
        }

        if (empty($errors)) {
            $photo = "uploads/default_avatar.png";
            $q1 = $connexion->prepare(
                "INSERT INTO users (firstname, lastname, password, mail, cursus, photo) VALUES (:firstname,:lastname,:password,:mail,:cursus, :photo)"
            );
            //var_dump($q1);
            $q1->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $q1->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $q1->bindParam(':password', $password_modified, PDO::PARAM_STR);
            $q1->bindParam(':mail', $mail, PDO::PARAM_STR);
            $q1->bindParam(':cursus', $cursus, PDO::PARAM_INT);
            $q1->bindValue(':photo', $photo, PDO::PARAM_STR);
            $q1->execute();
            header('location:../connexion.php');
        }else {
            $info = new Infos($errors);
            echo $info->renderInfo();
        }

    }

    // FONCTION CHECK MAIL USER

    public function get_mail($mail){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT mail FROM users WHERE mail = :mail");
        $q->bindParam(':mail', $mail, PDO::PARAM_STR);
        $q->execute();
        $user = $q->fetch(PDO::FETCH_ASSOC);
        //return $user;
    }

    // FONCTION NEWSLETTER en cours

    public function check_newsletter($email_newsletter){

        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT email_newsletter FROM newsletter WHERE email_newsletter = :email_newsletter");
        $q->bindParam(':email_newsletter', $email_newsletter, PDO::PARAM_STR);
        $q->execute();
        $email_exist = $q->fetchAll();

        //return $email_exist;

    }

    public function newsletter($email_newsletter){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT email_newsletter FROM newsletter WHERE email_newsletter = :email_newsletter");
        $q->bindParam(':email_newsletter', $email_newsletter, PDO::PARAM_STR);
        $q->execute();
        $email_exist = $q->fetchAll();

        if (!empty($email_exist)) {

            $errors[] = "Cette adresse mail est déjà enregistrée.";
            $info = new Infos($errors);
            echo $info->renderInfo();
        }
        else{

            $q1 = $connexion->prepare("INSERT INTO newsletter(email_newsletter) VALUES (:email_newsletter)");
            $q1->bindParam(':email_newsletter', $email_newsletter, PDO::PARAM_STR);
            $q1->execute();

            header('Location: '.$_SERVER['PHP_SELF']);
        }
    }

    public function infos_user($id_user){

        $q = $connexion->prepare("SELECT * FROM users WHERE id = :id");
        $q->bindParam(':id', $id_user, PDO::PARAM_INT);
        $q->execute();
        $infos_user = $q->fetch(PDO::FETCH_ASSOC);

    }

    public function all_infos($id_user){

        $q = $connexion->prepare("SELECT *
                                  FROM users 
                                  INNER JOIN user_tech
                                  ON users.id = user_tech.id_user
                                  INNER JOIN follower
                                  ON users.id = follower.id_user
                                  INNER JOIN post
                                  ON users.id = post.id_user
                                  INNER JOIN groupe
                                  ON users.id = groupe.id_user
                                  WHERE users.id = $id_user");
        $q->bindParam(':id', $id_user, PDO::PARAM_INT);
        $q->execute();
        $all_infos = $q->fetch(PDO::FETCH_ASSOC);

    }


}


?>