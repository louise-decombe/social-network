<?php
session_start();

$_SESSION['new_post'] = [] ;
// A RENDRE DINAMIQUE
$id_user = 93;
$_SESSION['user']['id'] = 93;

$tab_id_posts = $_SESSION['posts'];
$followers = $_SESSION['followers'];
$tab_user =  $_SESSION['tab_user'];

//echo json_encode($tab_id_posts);

require '../class/Groupe.php';
require '../class/Follower.php';
require '../class/Config.php';

$groupe = new Groupe($db);
$follow = new Follower($db);

$All_posts2 = $post->GetPostsByIdUser();


  //recuperation des posts des tout les amis et les siens 
  if (!empty($followers)){
    for ($i = 0 ; $i < COUNT($tab_user) ; $i ++){
    
        for ($j = 0 ; $j < COUNT($All_posts2) ; $j++){
            
            if ($tab_user[$i] == $All_posts2[$j]['id_user'] ){
                $posts2[$j] = $All_posts2[$j];
                $tab_id_posts2[$j] = $posts2[$j]['id_post'];
                
            }

            if ($All_posts2[$j]['id_user'] == $id_user){
                $posts2[$j] = $All_posts2[$j];
                $tab_id_posts2[$j] = $posts2[$j]['id_post'];  
            }
        }
    }
}

//  var_dump($tab_id_posts);
//  var_dump($tab_id_posts2);
 $id_news_posts = array_diff($tab_id_posts2,$tab_id_posts);
//echo json_encode($id_news_posts);
 if (!empty($id_news_posts)){
    //on recupere tout les nouveaux posts
    // if (COUNT($id_news_posts) > 1 ){
        for ($i = 0 ; $i < COUNT($id_news_posts) ; $i++ ){
            $posts = $post->getPostByIdPost($id_news_posts[$i]);
            // var_dump($posts);
            // if ( !isset($_SESSION['new_post'])  ){
            //     $_SESSION['new_post'][0] = $posts;
           
                array_push($_SESSION['new_post'],$posts);
            
           
            
           
            
        }
 
    //else {
    //     $posts = $post->getPostByIdPost($id_news_posts);
    //     var_dump($posts);
    //     if ( !isset($_SESSION['new_post'])){
    //         $_SESSION['new_post'][0] = $posts;
    //     }else {
    //         array_push($_SESSION['new_post'],$posts);
    //     }
        



    // echo json_encode($_SESSION['new_post']);
    $_SESSION["posts"] = $tab_id_posts2;
   
  
   echo json_encode([ "post" =>  $_SESSION['new_post'] ]);
    //session_unset($_SESSION['new_post']);
   

    
}else{
    echo json_encode(["message" => "pas de nouveaux message" ]);
}



 



?>