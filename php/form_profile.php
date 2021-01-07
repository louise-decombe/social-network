<?php
session_start();
extract($_POST);
require '../class/Config.php';

//TRAITEMENT PHP PROFIL UTILISATEUR MODIFICATION LOCALITÉ
if(isset($new_localite) && !empty($new_localite)){

    /*$id_user = $_POST['id_user'];
    $new_localite = $_POST['modify_city'];*/

    // on fait appel à la class user pour enregistrer les infos passées dans le formulaire
    $update_city = $user->modify_localite($id_user, $new_localite);
    echo "city";

}/*else{
    echo "error";
}*/;

/*------------------------------------------------------------------------------------------------------------------------------*/

//TRAITEMENT PHP PROFIL UTILISATEUR MODIFICATION CURSUS
if(isset($new_cursus) && !empty($new_cursus)){

    /*$id_user = $_POST['id_user'];
    $new_cursus = $_POST['modify_cursus'];*/

    // on fait appel à la class user pour enregistrer les infos passées dans le formulaire
    $update_cursus = $user->modify_cursus($id_user, $new_cursus);
    echo "cursus";

}/*else{
    echo "error";
};*/

/*------------------------------------------------------------------------------------------------------------------------------*/

//TRAITEMENT PHP PROFIL UTILISATEUR MODIFICATION ENTREPRISE
if(isset($new_entreprise) && !empty($new_entreprise)){

    /*$id_user = $_POST['id_user'];
    $new_entreprise = $_POST['modify_entreprise'];*/

    // on fait appel à la class user pour enregistrer les infos passées dans le formulaire
    $update_cie = $user->modify_cie($id_user, $new_entreprise);
    echo "entreprise";

}/*else{
    echo "error";
};*/

/*------------------------------------------------------------------------------------------------------------------------------*/

//TRAITEMENT PHP PROFIL UTILISATEUR MODIFICATION WEBSITE
if(isset($new_website) && !empty($new_website)){

    /*$id_user = $_POST['id_user'];
    $new_website = $_POST['modify_website'];*/

    // on fait appel à la class user pour enregistrer les infos passées dans le formulaire
    $update_website = $user->modify_website($id_user, $new_website);
    echo "website";

}/*else{
    echo "error";
};*/

/*------------------------------------------------------------------------------------------------------------------------------*/

//TRAITEMENT PHP PROFIL UTILISATEUR MODIFICATION BIO
if(isset($new_bio) && !empty($new_bio)){

    /*$id_user = $_POST['id_user'];
    $new_bio = $_POST['modify_bio'];*/

    // on fait appel à la class user pour enregistrer les infos passées dans le formulaire
    $update_bio = $user->modify_bio($id_user, $new_bio);
    echo "bio";

}/*else{
    echo "error";
};

/*------------------------------------------------------------------------------------------------------------------------------*/

//TRAITEMENT PHP PROFIL UTILISATEUR MODIFICATION HOBBIES
if(isset($new_hobbies) && !empty($new_hobbies)){

    //$id_user = $_POST['id_user'];
    //$new_hobbies = $_POST['modify_hobbies'];

    // on fait appel à la class user pour enregistrer les infos passées dans le formulaire
    $update_hobbies = $user->modify_hobbies($id_user, $new_hobbies);
    echo "hobbies";

}/*else{
    echo "error";
};

/*------------------------------------------------------------------------------------------------------------------------------*/

//TRAITEMENT PHP PROFIL UTILISATEUR MODIFICATION FIRSTNAME  
if(isset($new_firstname) && !empty($new_firstname)){

    $update_firstname = $user->modify_firstname($id_user, $new_firstname);
    echo "firstname";

}/*else{
    echo "error";
};

/*------------------------------------------------------------------------------------------------------------------------------*/

//TRAITEMENT PHP PROFIL UTILISATEUR MODIFICATION LASTNAME 
if(isset($new_lastname) && !empty($new_lastname)){

    $update_lastname = $user->modify_lastname($id_user, $new_lastname);
    echo "lastname";

}/*else{
    echo "error";
};

/*------------------------------------------------------------------------------------------------------------------------------*/

//TRAITEMENT PHP PROFIL UTILISATEUR MODIFICATION BIRTHDAY
if(isset($new_birthday) && !empty($new_birthday)){

    $update_birthday = $user->modify_birthday($id_user, $new_birthday);
    echo "birthday";

}/*else{
    echo "error";
};


/*------------------------------------------------------------------------------------------------------------------------------*/

//TRAITEMENT PHP PROFIL UTILISATEUR MODIFICATION PASSWORD
if(isset($new_password) && !empty($new_password) && isset($new_check_password) && !empty($new_check_password)){

    $update_pass = $user->modify_password($id_user, $new_password, $new_check_password);
    echo "password";

}/*else{
    echo "error";
};*/

/*------------------------------------------------------------------------------------------------------------------------------*/

//TRAITEMENT PHP PROFIL UTILISATEUR FOLLOW
if(isset($id_user) && !empty($id_user) && isset($id_user_follow) && !empty($id_user_follow)){

    $new_follower = $user->follow($id_user, $id_user_follow);
    echo "follower";

}else{
    echo "error";
};



?>