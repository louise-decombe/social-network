<?php 

    // $page_selected = 'feed'; 
   

    // // A RENDRE DINAMIQUE
    // $id_user = 93;
    // $_SESSION['user']['id'] = 93;

    // if (!isset($id_user)){
    //     $_SESSION['erreur'] = "Vous devez etre connecté pour acceder à cette page";
    //     header("location: connexion.php");
    // }
var_dump($_POST['action']);
if ($_POST["action"] != 'refresh'){
   
    // require 'class/Groupe.php';
    // require 'class/Follower.php';

    // $groupe = new Groupe($db);
    // $follow = new Follower($db);


    //recuperation des infos de bases
    //infos perso + nombre de personne suivis
    // $infos_user = $user->Recuperation_personnes_suivis($id_user);

    // //recuperation groupe
    // $groupes = $groupe->getNameGroupeByUser($id_user);

    // //recuperation de toutes les personnes suivi par l utilisateur
    // $followers = $follow->GetFollowerUser($id_user);

     //on boucle sur les id des personnes suivi
    //  if (!empty($followers)){
    //     for ($i = 0 ; $i < COUNT($followers) ; $i++){
    //     //requete avec les id des amis de l'utilisateurs
    //     //on recupere les personnes qui suive ces personnes
    //     if (!isset($nbr)){
    //         $nbr=[];
    //         $nbr[]= $follow->Get_follow($followers[$i]['id_user_follow'],$id_user);
            
    //     }else{
    //         $nbr[]= $follow->Get_follow($followers[$i]['id_user_follow'],$id_user);
    //     }
      


    //     //tab des amis
    //     $tab_user=[];
    //     for ($i=0 ; $i < count($followers); $i++){
    //         $tab_user[$i]=$followers[$i]['id_user_follow'];
    //     }
       

    //     //tab des personne qui suive les meme personne

    //     for ($i=0 ; $i < count($nbr); $i++){
    //         for ($j=0 ; $j < count($nbr[$i]); $j++){
    //             $tab_communs[]=$nbr[$i][$j]['id_user'];
    //         }
    //     }

    //     //comparer les 2 Tab //On supprime les valeurs identique car cela nous indique que l utilisateur sur deja la personne
    //     $amis_en_communs = array_unique(array_diff($tab_communs,$tab_user));
        

    //     //recuperation de tous les amis de cette personnes
    //     for ($i = 0 ; $i < COUNT($amis_en_communs) ; $i++){
    //         $tab1[$i] = count($follow->GetFollowerUser($amis_en_communs[$i]));
    //     }
            
    
    // }

      
}



    // RECUPERATION DE TOUT LES POST
    $All_posts = $post->GetPostsByIdUser();
   //var_dump($All_posts);
  
    //recuperation des posts des tout les amis et les siens 
    
    if (!empty($followers)){
        for ($i = 0 ; $i < COUNT($tab_user) ; $i ++){
       
            for ($j = 0 ; $j < COUNT($All_posts) ; $j++){
                
                if ($tab_user[$i] == $All_posts[$j]['id_user'] ){
                    $posts[] = $All_posts[$j];
                    $tab_id_posts[] = $posts[$j]['id_post'];
                    if (!isset($_SESSION['posts'])){
                        $_SESSION['posts'] = [];
                        $_SESSION['posts'] = $tab_id_posts;
                    }else{
                        $_SESSION['posts'] = $tab_id_posts;
                    }
                   
                }
                if ($All_posts[$j]['id_user'] == $id_user){
                    $posts[] = $All_posts[$i];
                    $tab_id_posts = $posts[$i]['id_post'];
                    if (!isset($_SESSION['posts'])){
                        $_SESSION['posts'] = [];
                        $_SESSION['posts'] = $tab_id_posts;
                    }else{
                        $_SESSION['posts'] = $tab_id_posts;
                    } 
                }
            }
        }
        //recuperation des posts de l'utilosateur
        for ($i = 0 ; $i < COUNT($All_posts) ; $i++){
            
        }

    }





 }

 //ajax
else {
    echo "ici";
    // echo json_encode($_SESSION['posts']);
    // var_dump($_SESSION['posts']);
}
//     require '../class/Groupe.php';
//     require '../class/Follower.php';
//     require '../class/Config.php';

//     $groupe = new Groupe($db);
//     $follow = new Follower($db);

//     // A RENDRE DINAMIQUE
//     // $id_user = 93;
//     // $_SESSION['user']['id'] = 93;

//        //recuperation des infos de bases
//     //infos perso + nombre de personne suivis
//     $infos_user = $user->Recuperation_personnes_suivis($id_user);
    
    

    

//     //recuperation groupe
//     $groupes = $groupe->getNameGroupeByUser($id_user);
    

//     //recuperation de toutes les personnes suivi par l utilisateur
//     $followers = $follow->GetFollowerUser($id_user);
    
   

//     //on boucle sur les id des personnes suivi
//     if (!empty($followers)){
//         for ($i = 0 ; $i < COUNT($followers) ; $i++){
//         //requete avec les id des amis de l'utilisateurs
//         //on recupere les personnes qui suive ces personnes
//         if (!isset($nbr)){
//             $nbr=[];
//             $nbr[]= $follow->Get_follow($followers[$i]['id_user_follow'],$id_user);
            
//         }else{
//             $nbr[]= $follow->Get_follow($followers[$i]['id_user_follow'],$id_user);
//         }
      


//         //tab des amis
//         $tab_user=[];
//         for ($i=0 ; $i < count($followers); $i++){
//             $tab_user[$i]=$followers[$i]['id_user_follow'];
//         }
       

//         //tab des personne qui suive les meme personne

//         for ($i=0 ; $i < count($nbr); $i++){
//             for ($j=0 ; $j < count($nbr[$i]); $j++){
//                 $tab_communs[]=$nbr[$i][$j]['id_user'];
//             }
//         }

//         //comparer les 2 Tab //On supprime les valeurs identique car cela nous indique que l utilisateur sur deja la personne
//         $amis_en_communs = array_unique(array_diff($tab_communs,$tab_user));
        

//         //recuperation de tous les amis de cette personnes
//         for ($i = 0 ; $i < COUNT($amis_en_communs) ; $i++){
//             $tab1[$i] = count($follow->GetFollowerUser($amis_en_communs[$i]));
//         }
            
    
//     }

      
// }

//  //on boucle sur les id des personnes suivi
//  if (!empty($followers)){
//     for ($i = 0 ; $i < COUNT($followers) ; $i++){
//     //requete avec les id des amis de l'utilisateurs
//     //on recupere les personnes qui suive ces personnes
//     if (!isset($nbr)){
//         $nbr=[];
//         $nbr[]= $follow->Get_follow($followers[$i]['id_user_follow'],$id_user);
        
//     }else{
//         $nbr[]= $follow->Get_follow($followers[$i]['id_user_follow'],$id_user);
//     }
  


//     //tab des amis
//     $tab_user=[];
//     for ($i=0 ; $i < count($followers); $i++){
//         $tab_user[$i]=$followers[$i]['id_user_follow'];
//     }
   

//     //tab des personne qui suive les meme personne

//     for ($i=0 ; $i < count($nbr); $i++){
//         for ($j=0 ; $j < count($nbr[$i]); $j++){
//             $tab_communs[]=$nbr[$i][$j]['id_user'];
//         }
//     }

//     //comparer les 2 Tab //On supprime les valeurs identique car cela nous indique que l utilisateur sur deja la personne
//     $amis_en_communs = array_unique(array_diff($tab_communs,$tab_user));
    

//     //recuperation de tous les amis de cette personnes
//     for ($i = 0 ; $i < COUNT($amis_en_communs) ; $i++){
//         $tab1[$i] = count($follow->GetFollowerUser($amis_en_communs[$i]));
//     }
        

// }

  
// }
// //RECUPERATION DE TOUT LES POSTS
// $All_posts2 = $post->GetPostsByIdUser();
// //var_dump($All_posts2);
// //recuperation des posts des tout les amis et les siens 

// if (!empty($followers)){
// for ($i = 0 ; $i < COUNT($tab_user) ; $i ++){

//     for ($j = 0 ; $j < COUNT($All_posts2) ; $j++){
        
      
//         if ($tab_user[$i] == $All_posts2[$j]['id_user'] ){
//             $posts2[] = $All_posts2[$j];
//             $tab_id_posts2[] = $posts2[$j]['id_post'];
            
//         }
//         if ($All_posts2[$j]['id_user'] == $id_user){
//             $posts2[] = $All_posts2[$i];
//             $tab_id_posts2[] = $posts2[$i]['id_post'];  
//         }
//     }
// }


// //var_dump($tab_id_posts);
// //var_dump($tab_id_posts2);
// //on compare les deux tableaux pour recuperer les differences

// $diff_news = array_diff($tab_id_posts2,$tab_id_posts);
// //var_dump($diff_news);

// //Si vide pas de nouveaux posts
// if (empty($diff_news)){
//     echo json_encode(["message" => "Pas de diff"]);
// }
// else {
//     echo json_encode(["message" => "nouveau message"]);
// }
// }




// }





   



    

?>