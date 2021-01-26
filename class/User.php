<?php

require 'Infos.php'; // permets d'afficher les messages d'erreur

class User{
    private $id_user;
    public $firstname;
    public $lastname;
    public $password;
    public $mail;
    public $cursus;
    public $date_promo;
    public $photo;
    public $cover;
    public $birthday;
    public $entreprise;
    public $localite;
    public $website;
    public $hobbies;
    public $bio;
    public $droits;
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*----------------------------------------------------*/
    /* FONCTION CONNEXION USER
    ------------------------------------------------------ */

    public function connect($mail, $password){

        $connexion = $this->db->connectDb();

        $q = $connexion->prepare("SELECT * FROM users WHERE mail = :mail");
        $q->bindParam(':mail', $mail, PDO::PARAM_STR);
        $q->execute();
        $user = $q->fetch(PDO::FETCH_ASSOC);
        //$passwordHash = '$2y$10$dTmqwdrXkXHRwBO/DxMC2OrTllyWooc83UcMVFv.l6fUfkemkfzP2';
        //$passwordHash = substr( $passwordHash, 0, 60 );

        //var_dump($user);

        if (!empty($user)){
            //echo 'avant';
            //.echo password_verify("Password-1", $passwordHash);
            // if (password_verify($password, $passwordHash))
            //     header("Location: www.google.com" );
            if(password_verify($password, $user['password'])){
                $this->id_user = $user['id'];
                $this->firstname = $user['firstname'];
                $this->lastname = $user['lastname'];
                $this->mail = $user['mail'];
                $this->cursus = $user['cursus'];
                $this->date_promo = $user['date_promo'];
                $this->photo = $user['photo'];
                $this->cover = $user['cover'];
                $this->birthday = $user['birthday'];
                $this->entreprise = $user['entreprise'];
                $this->localite = $user['localite'];
                $this->website = $user['website'];
                $this->hobbies = $user['hobbies'];
                $this->bio = $user['bio'];
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
                    'cover'=>
                        $this->cover,
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
                    'bio'=>
                        $this->bio,
                    'droits'=>
                        $this->droits
                ];
                //echo 'test';
                return $_SESSION['user']; 
                // header('location:../profile.php');
                

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

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*----------------------------------------------------*/
    /* FONCTION DECONNEXION USER
    ------------------------------------------------------ */

    public function disconnect(){
        $this->id_user = "";
        $this->firstname = "";
        $this->lastname = "";
        $this->mail = "";
        $this->cursus = "";
        $this->date_promo = "";
        $this->photo = "";
        $this->cover = "";
        $this->birthday = "";
        $this->entreprise = "";
        $this->localite = "";
        $this->website = "";
        $this->hobbies = "";
        $this->bio = "";
        $this->droits = "";
        session_unset();
        session_destroy();
        header('location: index.php');
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*----------------------------------------------------*/
    /* FONCTION ENREGISTREMENT USER
    ------------------------------------------------------ */

    public function register($firstname, $lastname, $mail, $cursus, $password, $check_pass){
        $connexion = $this->db->connectDb();
        //firstname
        $firstname_required = preg_match("/^([a-zA-Z\-]{3,25})$/", $firstname);
        if (!$firstname_required) {
            $errors[] = "Le prénom doit :<br>- Comporter entre 3 et 19 caractères.<br>- Commencer et finir par une lettre.<br>- Ne contenir aucun caractère spécial (excepté -).";
        }

        //lastname
        $lastname_required = preg_match("/^([a-zA-Z\-]{3,25})$/", $lastname);
        if (!$lastname_required) {
            $errors[] = "Le nom doit:<br>- Comporter entre 3 et 50 caractètres.<br>- Commencer et finir par une lettre.<br>- Ne contenir aucun caractère spécial (excepté un espace).";
        }
        
        //email
        $email_required = preg_match("/^[a-zA-Z0-9._%+-]+@laplateforme\.io$/", $mail);
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
            $photo = "upload/default_avatar.png";
            $cover = "upload_cover/cover_default.jpg";
            $q1 = $connexion->prepare(
                "INSERT INTO users (firstname, lastname, password, mail, cursus, photo, cover) VALUES (:firstname,:lastname,:password,:mail,:cursus, :photo, :cover)"
            );
            //var_dump($q1);
            $q1->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $q1->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $q1->bindParam(':password', $password_modified, PDO::PARAM_STR);
            $q1->bindParam(':mail', $mail, PDO::PARAM_STR);
            $q1->bindParam(':cursus', $cursus, PDO::PARAM_INT);
            $q1->bindValue(':photo', $photo, PDO::PARAM_STR);
            $q1->bindValue(':cover', $cover, PDO::PARAM_STR);
            $q1->execute();
            header('location:../connexion.php');
        }else {
            $info = new Infos($errors);
            echo $info->renderInfo();
        }

    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*----------------------------------------------------*/
    /* FONCTION FONCTION CHECK MAIL USER
    ------------------------------------------------------ */

    public function get_mail($mail){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT mail FROM users WHERE mail = :mail");
        $q->bindParam(':mail', $mail, PDO::PARAM_STR);
        $q->execute();
        $user = $q->fetch(PDO::FETCH_ASSOC);
        //return $user;
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*----------------------------------------------------*/
    /* FONCTION FONCTION CHECK PASSWORD USER
    ------------------------------------------------------ */

    public function get_password($mail, $password){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT * FROM users WHERE mail = :mail");
        $q->bindParam(':mail', $mail, PDO::PARAM_STR);
        $q->execute();
        $user = $q->fetch(PDO::FETCH_ASSOC);
        
        if (!empty($user)){

            if(password_verify($password, $user['password'])){

                return 1; 

            }
        }
    }


    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*-------------------------------------------------------------------------------------------*/
    /* FONCTION INFOS PERSONNELLES USER = récupère seulement les infos de la table Users
    ---------------------------------------------------------------------------------------------*/

    public function infos_user($id_user){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT * FROM users WHERE id = :id");
        $q->bindParam(':id', $id_user, PDO::PARAM_INT);
        $q->execute();
        $infos_user = $q->fetch(PDO::FETCH_ASSOC);

    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------------------------------------------------------------------------*/
    /* FONCTION INFOS USER = récupère seulement les infos de la table Users + technos + followers + posts + groupes
    -----------------------------------------------------------------------------------------------------------------*/

    public function all_infos($id_user){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT *
                                  FROM users 
                                  INNER JOIN user_tech
                                  ON users.id = user_tech.id_user
                                  INNER JOIN follower
                                  ON users.id = follower.id_user
                                  INNER JOIN post
                                  ON users.id = post.id_user
                                  WHERE users.id = $id_user");
        $q->bindParam(':id', $id_user, PDO::PARAM_INT);
        $q->execute();
        $all_infos = $q->fetch(PDO::FETCH_ASSOC);
        return $all_infos;
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*------------------------------------------------------------------------------------------------------*/
    /* FONCTION INFOS USER + CURSUS = récupère seulement les infos de la table Users + Cursus
    --------------------------------------------------------------------------------------------------------*/
    public function test($id_user){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT *
                                  FROM users 
                                  INNER JOIN cursus
                                  ON users.cursus = cursus.id_cursus
                                  WHERE users.id = $id_user");
        $q->execute();
        $all_infos = $q->fetch(PDO::FETCH_ASSOC);
        return $all_infos;
    }

    /*---------------------------------------------*/
    /* FONCTION UNFOLLOW
    -----------------------------------------------*/

    public function unfollow ($id_user, $id_user_follow)
    {
        $connexion = $this->db->connectDb(); 
        if(isset($id_user_follow)){
            $del_follow = "DELETE FROM follower WHERE id_user = $id_user AND id_user_follow = $id_user_follow";
            $delete_follower = $connexion -> prepare($del_follow);
            $delete_follower->execute();
        }
    }

    /*---------------------------------------------*/
    /* FONCTION FOLLOW
    -----------------------------------------------*/

    public function follow($id_user, $id_user_follow)
    {
        $connexion = $this->db->connectDb(); 
        if(isset($id_user_follow)){
            $new_follow = "INSERT INTO follower(id_user, id_user_follow) values (:id_user, :id_user_follow)";
            $follower = $connexion -> prepare($new_follow);
            $follower->bindParam(':id_user',$id_user, PDO::PARAM_INT);
            $follower->bindParam(':id_user_follow',$id_user_follow, PDO::PARAM_INT);
            $follower->execute();
        }
    }

    /*---------------------------------------------*/
    /* FONCTION ALREADY FOLLOW
    -----------------------------------------------*/

    public function already_follow($id_user_follow, $id_user){

        $connexion = $this->db->connectDb($id_user); 
        $q = $connexion->prepare("SELECT id_user_follow FROM follower WHERE id_user_follow = :id_user_follow AND id_user = :id_user");
        $q->bindParam(':id_user_follow', $id_user_follow, PDO::PARAM_INT);
        $q->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $q->execute();
        $follow_check = $q->fetch();
        
        return $follow_check;
    }

    /*---------------------------------------------*/
    /* FONCTION LAST POST
    -----------------------------------------------*/

    public function last_post($id_user)
    {
        $connexion = $this->db->connectDb(); 
        if(isset($id_user)){
            $last_p = $connexion -> prepare("SELECT *
                                             FROM users 
                                             INNER JOIN post
                                             ON users.id = post.id_user
                                             WHERE post.id_user = $id_user 
                                             ORDER BY post.created_at DESC");
            $last_p->execute();
            $last_post = $last_p->fetch();
            return $last_post;
        }
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*------------------------------------------------------------------------------------------------------*/
    /* FONCTION INFOS USER + FOLLOWERS = récupère seulement les infos de la table Users + Followers
    --------------------------------------------------------------------------------------------------------*/
    public function followers($id_user){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT *
                                  FROM follower
                                  INNER JOIN users
                                  ON follower.id_user =  users.id
                                  WHERE follower.id_user_follow = $id_user
                                  LIMIT 8");
        $q->execute();
        $followers = $q->fetchAll(PDO::FETCH_ASSOC);
        return $followers;
    }

     // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*------------------------------------------------------------------------------------------------------*/
    /* FONCTION FOLLOWERS = récupère seulement les personnes que vous suivez
    --------------------------------------------------------------------------------------------------------*/
    public function you_follow($id_user){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT *
                                  FROM follower
                                  INNER JOIN users
                                  ON follower.id_user_follow = users.id
                                  WHERE follower.id_user = $id_user");
        $q->execute();
        $you_follow = $q->fetchAll(PDO::FETCH_ASSOC);
        return $you_follow;
    }
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*------------------------------------------------------------------------------------------------------*/
    /* FONCTION FOLLOWERS = récupère seulement les personnes qui vous suivent
    --------------------------------------------------------------------------------------------------------*/
    public function is_follow($id_user){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT *
                                  FROM follower
                                  INNER JOIN users
                                  ON follower.id_user = users.id
                                  WHERE follower.id_user_follow = $id_user");
        $q->execute();
        $is_follow = $q->fetchAll(PDO::FETCH_ASSOC);
        return $is_follow;
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*------------------------------------------------------------------------------------------------------*/
    /* FONCTION COUNT nb de Followers d'un User 
    --------------------------------------------------------------------------------------------------------*/

    public function count_followers($id_user){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT COUNT(*)
                                  FROM follower
                                  WHERE id_user_follow = $id_user");
        $q->execute();
        $count_followers = $q->fetch();
        return $count_followers;
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*------------------------------------------------------------------------------------------------------*/
    /* FONCTION COUNT nb de personnes suivies par un User 
    --------------------------------------------------------------------------------------------------------*/

    public function count_follow($id_user){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT COUNT(*)
                                  FROM follower
                                  WHERE id_user= $id_user");
        $q->execute();
        $count_follow = $q->fetch();
        return $count_follow;
    }


    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*------------------------------------------------------------------------------------------------------*/
    /* FONCTION SELECT POST USER : récupère les posts d'un utilisateur
    --------------------------------------------------------------------------------------------------------*/

    public function post_users($id_user){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT *
                                  FROM post
                                  WHERE id_user = $id_user
                                  ORDER BY created_at DESC");
        $q->execute();
        $post_users = $q->fetchAll(PDO::FETCH_ASSOC);
        return $post_users;
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*------------------------------------------------------------------------------------------------------*/
    /* FONCTION SELECT RÉACTIONS POST USER : récupère les reactions + commentaires selon le post
    --------------------------------------------------------------------------------------------------------*/

    public function post_reactions(){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT *
                                  FROM post
                                  INNER JOIN comment
                                  ON post.id = comment.id_post
                                  INNER JOIN like_post
                                  ON post.id = like_post.id_post");
        $q->execute();
        $post_react = $q->fetchAll();
        return $post_react;
    }

     // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*------------------------------------------------------------------------------------------------------*/
    /* FONCTION COUNT nb de like d'un Post sur la page profil
    --------------------------------------------------------------------------------------------------------*/

    public function count_like($id_post){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT COUNT(*) FROM like_post WHERE id_post = $id_post");
        $q->execute();
        $count_likes = $q->fetch();
        return $count_likes;
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*------------------------------------------------------------------------------------------------------*/
    /* FONCTION COUNT nb de commentaires d'un Post sur la page profil
    --------------------------------------------------------------------------------------------------------*/

    public function count_comments($id_post){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT COUNT(*) FROM comment WHERE id_post = $id_post");
        $q->execute();
        $count_com = $q->fetch();
        return $count_com;
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------*/
    /* UPDATE PROFILE USER = FIRSTNAME + LASTNAME
    -----------------------------------------------*/

    public function modify_firstname($id_user, $new_firstname)
    {  
        $connexion = $this->db->connectDb();

        //UPDATE FIRSTNAME
        if(isset($new_firstname))
        {
            
            $firstname_required = preg_match("/^(?=.*[A-Za-z]$)[A-Za-z][A-Za-z\-]{2,19}$/", $new_firstname);
            if (!$firstname_required) 
            {
                $errors[] = "Le prénom doit :<br>- Comporter entre 3 et 19 caractères.<br>- Commencer et finir par une lettre.<br>- Ne contenir aucun caractère spécial (excepté -).";
            }
            
            if (empty($errors)) 
            {   
            $update_f = "UPDATE users SET firstname=:firstname WHERE id = $id_user ";
            $update_firstname = $connexion -> prepare($update_f);
            $update_firstname->bindParam(':firstname',$new_firstname, PDO::PARAM_STR);
            $update_firstname->execute();
            }
        }
    }

    public function modify_lastname($id_user, $new_lastname)
    {  
        $connexion = $this->db->connectDb();

        //UPDATE LASTNAME
        if(isset($new_lastname))
        {
            $lastname_required = preg_match("/^(?=.*[A-Za-z]$)([A-Za-z]{2,25}[\s]?[A-Za-z]{1,25})$/", $new_lastname);
            if (!$lastname_required) 
            {
                $errors[] = "Le nom doit:<br>- Comporter entre 3 et 50 caractètres.<br>- Commencer et finir par une lettre.<br>- Ne contenir aucun caractère spécial (excepté un espace).";
            }
            
            if (empty($errors)) 
            {
            $update_l = "UPDATE users SET lastname=:lastname WHERE id = $id_user ";
            $update_lastname = $connexion -> prepare($update_l);
            $update_lastname->bindParam(':lastname',$new_lastname, PDO::PARAM_STR);
            $update_lastname->execute();
            }   
        }
          
        if (!empty($errors))
        {
            $message = new messages($errors);
            echo $message->renderMessage();
        }

    }
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------*/
    /* UPDATE PROFILE USER = BIRTHDAY
    -----------------------------------------------*/
    public function modify_birthday ($id_user, $new_birthday)
     {
         $connexion = $this->db->connectDb(); 
         if(isset($new_birthday)){
                 $update_b = "UPDATE users SET birthday=:birthday WHERE id = $id_user ";
                 $update_birthday = $connexion -> prepare($update_b);
                 $update_birthday->bindParam(':birthday',$new_birthday, PDO::PARAM_STR);
                 $update_birthday->execute();
         }
   }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------*/
    /* UPDATE PROFILE USER = PASSWORD
    -----------------------------------------------*/

    public function modify_password ($id_user, $new_password, $new_check_password)
    {
        $connexion = $this->db->connectDb(); 

        if(isset($new_password) && isset($new_check_password)){
            $password_required = preg_match("/^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/",$new_password);
            if (!$password_required) {
                $errors[] = "Le mot de passe doit contenir:<br>- Entre 8 et 20 caractères<br>- Au moins 1 caractère spécial<br>- Au moins 1 majuscule et 1 minuscule<br>- Au moins un chiffre.";
            }
            if ($new_password != $new_check_password) {
                $errors[] = "Les mots de passe ne correspondent pas.";
            } else {
    
                $password_modified = password_hash($new_password, PASSWORD_BCRYPT, array('cost' => 10));

                $update_pass = "UPDATE users SET password=:password WHERE id = $id_user";
                $update_password = $connexion -> prepare($update_pass);
                $update_password->bindParam(':password',$password_modified, PDO::PARAM_STR);
                $update_password->execute();
                
                $this->disconnect();
               
            }
        }
        if (!empty($errors))
        {
            $message = new messages($errors);
            echo $message->renderMessage();
        }
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------*/
    /* UPDATE PROFILE USER = PROMO 
    -----------------------------------------------*/

     public function modify_promo ($id_user, $new_promo)
     {
         $connexion = $this->db->connectDb(); 
         if(isset($new_promo)){
                 $update_prom = "UPDATE users SET date_promo=:date_promo WHERE id = '$id_user' ";
                 $update_promo = $connexion -> prepare($update_prom);
                 $update_promo->bindParam(':date_promo',$new_promo, PDO::PARAM_STR);
                 $update_promo->execute();
         }
   }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------*/
    /* UPDATE PROFILE USER = LOCALITE
    -----------------------------------------------*/

    public function modify_localite ($id_user, $new_localite)
    {
        $connexion = $this->db->connectDb(); 
        if(isset($new_localite)){
                $update_loc = "UPDATE users SET localite=:localite WHERE id = $id_user ";
                $update_localite = $connexion -> prepare($update_loc);
                $update_localite->bindParam(':localite',$new_localite, PDO::PARAM_STR);
                $update_localite->execute();
        }
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------*/
    /* UPDATE PROFILE USER = CURSUS
    -----------------------------------------------*/

     public function modify_cursus ($id_user, $new_cursus)
     {
         $connexion = $this->db->connectDb(); 
         if(isset($new_cursus)){
                 $update_curs = "UPDATE users SET cursus=:cursus WHERE id = $id_user ";
                 $update_cursus = $connexion -> prepare($update_curs);
                 $update_cursus->bindParam(':cursus',$new_cursus, PDO::PARAM_INT);
                 $update_cursus->execute();
         }
     }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------*/
    /* UPDATE PROFILE USER = TECHNOLOGIES
    -----------------------------------------------*/

    public function modify_tech ($id_user, $new_tech)
    {

        $connexion = $this->db->connectDb(); 
        if(isset($new_tech)){
            $new_technologies = "INSERT INTO user_tech(id_user, id_technologie) values (:id_user, :id_technologie)";
            $tech = $connexion -> prepare($new_technologies);
            $tech->bindParam(':id_user',$id_user, PDO::PARAM_INT);
            $tech->bindParam(':id_technologie',$new_tech, PDO::PARAM_INT);
            $tech->execute();
        }
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------*/
    /* UPDATE PROFILE USER = ENTREPRISE
    -----------------------------------------------*/

     public function modify_cie ($id_user, $new_cie)
     {
         $connexion = $this->db->connectDb(); 
         if(isset($new_cie)){
                 $update_cie = "UPDATE users SET entreprise=:entreprise WHERE id = $id_user ";
                 $update_entreprise = $connexion -> prepare($update_cie);
                 $update_entreprise->bindParam(':entreprise',$new_cie, PDO::PARAM_STR);
                 $update_entreprise->execute();
         }
   }


    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------*/
    /* UPDATE PROFILE USER = WEBSITE
    -----------------------------------------------*/
    public function modify_website($id_user, $new_website)
    {  
        $connexion = $this->db->connectDb();

        if(isset($new_website))
        {
        
            /*if (!filter_var($new_website, FILTER_VALIDATE_URL)) 
            {
                $errors[] = "Vous devez entrer une adresse URL";
                $info = new Infos($errors);
                echo $info->renderInfo();
            }
            
            if (empty($errors)) 
            {*/
            $update_w = "UPDATE users SET website=:website WHERE id = $id_user ";
            $update_website = $connexion -> prepare($update_w);
            $update_website->bindParam(':website',$new_website, PDO::PARAM_STR);
            $update_website->execute();
            //}
            
        }

    }

   // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------*/
    /* UPDATE PROFILE USER = BIO
    -----------------------------------------------*/

    public function modify_bio ($id_user, $new_bio)
    {
        $connexion = $this->db->connectDb(); 
        if(isset($new_bio)){
                $update_b = "UPDATE users SET bio=:bio WHERE id = $id_user ";
                $update_bio = $connexion -> prepare($update_b);
                $update_bio->bindParam(':bio',$new_bio, PDO::PARAM_STR);
                $update_bio->execute();
        }
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------*/
    /* UPDATE PROFILE USER = HOBBIES
    -----------------------------------------------*/

     public function modify_hobbies ($id_user, $new_hobbies)
     {
         $connexion = $this->db->connectDb(); 
         if(isset($new_hobbies)){
                 $update_hobbies = "UPDATE users SET hobbies=:hobbies WHERE id = $id_user ";
                 $update_hob = $connexion -> prepare($update_hobbies);
                 $update_hob->bindParam(':hobbies',$new_hobbies, PDO::PARAM_STR);
                 $update_hob->execute();
         }
     }

    


    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------*/
    /* INSCRIPTION NEWSLETTER
    -----------------------------------------------*/

    public function newsletter($email_newsletter){
        $connexion = $this->db->connectDb();
        $q = $connexion->prepare("SELECT email_newsletter FROM newsletter WHERE email_newsletter = :email_newsletter");
        $q->bindParam(':email_newsletter', $email_newsletter, PDO::PARAM_STR);
        $q->execute();
        $email_exist = $q->fetchAll();

        if (!empty($email_exist)) {

            $errors[] = "Cette adresse mail est déjà enregistrée.";
            $info = new Infos($errors);
            echo 'error'; 
        }
        else{

            $q1 = $connexion->prepare("INSERT INTO newsletter(email_newsletter) VALUES (:email_newsletter)");
            $q1->bindParam(':email_newsletter', $email_newsletter, PDO::PARAM_STR);
            $q1->execute();

            echo 'news';

            //header('Location: '.$_SERVER['PHP_SELF']);
        }
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
    /*---------------------------------------------*/
    /* ADMIN
    -----------------------------------------------*/

    public function GetUsers(){
        $connexion = $this->db->connectDb();
        $requete = $connexion->prepare('SELECT * FROM users INNER JOIN cursus on users.cursus = cursus.id_cursus');
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function DeletUser($id_user){
        $connexion = $this->db->connectDb();
        $requete =  $connexion->prepare('DELETE FROM `users` WHERE id = ?');
        $requete->execute([$id_user]);
    }

    public function Upgrade_statut($id_user,$droit){
        $connexion = $this->db->connectDb();
        $requete = $connexion->prepare("UPDATE `users` SET `droits`=? WHERE id = ?");
        $requete->execute([$droit,$id_user]);
    }

    public function GetUserBy($filtre,$donnee){
        $connexion = $this->db->connectDb();
        if($filtre == "droits" || $filtre == "name_cursus" ){
            $requete = $connexion->prepare('SELECT * FROM users INNER JOIN cursus on users.cursus = cursus.id_cursus WHERE '.$filtre.' = ?' );
            $requete->execute([$donnee]);
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        }
        else{
            $requete =  $connexion->prepare('SELECT * FROM users INNER JOIN cursus on users.cursus = cursus.id_cursus ORDER BY '.$donnee.'' );
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        }

         
    }

    public function searchAdmin($search){
        $connexion = $this->db->connectDb();
		$stmt = $connexion->prepare("SELECT * FROM `users` INNER JOIN cursus ON users.cursus = cursus.id_cursus WHERE `firstname`  LIKE ? OR `lastname` LIKE ? LIMIT 10");
		$stmt->bindValue(1, $search.'%', PDO::PARAM_STR);
		$stmt->bindValue(2, $search.'%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function Recuperation_personnes_suivis($id_user){
        $connexion = $this->db->connectDb();
        $requete = $connexion->prepare('SELECT * , count(id_user_follow) AS nbr FROM users INNER JOIN follower ON users.id = follower.id_user WHERE users.id = ?');
        $requete->execute([$id_user]);
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function GetUserById($id){
        $connexion = $this->db->connectDb();
        $requete = $connexion->prepare("SELECT * FROM users WHERE id= ?");
        $requete->execute([$id]);
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    //recuperation aleatoire de 3 personnes
    public function GetRandomUsers($id_user){
        $connexion = $this->db->connectDb();
        $requete = $connexion->prepare(" SELECT * FROM `users`where id != ? ORDER BY RAND() LIMIT 3");
        $requete->execute([$id_user]);
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
       
    }

}


?>
