<?php
session_start();

 //$_SESSION['new_post'] = [] ;
// A RENDRE DINAMIQUE
$id_user = 93;
$_SESSION['user']['id'] = 93;

$tab_id_posts = $_SESSION['posts'];
$followers = $_SESSION['followers'];
$tab_user =  $_SESSION['tab_user'];

//echo json_encode($tab_id_posts);

//require '../class/Groupe.php';
require '../class/Follower.php';
require '../class/Config.php';
require '../class/comment.php';
// require '../class/Reactions.php';

//$groupe = new Groupe($db);
$follow = new Follower($db);
$comment = new Comment($db);
// $r = new Reactions($db);
$limit = 0;
$All_posts2 = $post->GetPostsByIdUser($limit);


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
    $id_news_posts = array_diff($tab_id_posts2,$tab_id_posts);
}
else{
   
    for ($j = 0 ; $j < COUNT($All_posts2) ; $j++){
                
        
        if ($All_posts2[$j]['id_user'] == $id_user){
        $posts2[$j] = $All_posts2[$j];
        $tab_id_posts2[$j] = $posts2[$j]['id_post'];
        } 
                           
    }
    // for ($i = 0 ; $i < COUNT($tab_user) ; $i ++){
    
    //     for ($j = 0 ; $j < COUNT($All_posts2) ; $j++){
                
        
    //         if ($All_posts2[$j]['id_user'] == $id_user){
    //         $posts2[$j] = $All_posts2[$j];
    //         $tab_id_posts2[$j] = $posts2[$j]['id_post']; 
                       
    //         }
                    
    //     }
        
    //      $id_news_posts = array_diff($tab_id_posts2,$tab_id_posts);
    // }
}


//   var_dump($tab_id_posts2);

$id_news_posts = array_diff($tab_id_posts2,$tab_id_posts);

 if (!empty($id_news_posts)){
    // var_dump($id_news_posts);
    //on recupere tout les nouveaux posts
    // if (COUNT($id_news_posts) > 1 ){
        for ($i = 0 ; $i < COUNT($id_news_posts) ; $i++ ){
            $posts = $post->getPostByIdPost($id_news_posts[$i]);
            
            //recuperation des follower de l auteur du post
            $fol = $follow->FollowedBy($posts[$i]['id_user']);
            array_push($posts,$fol);
            array_push($_SESSION['new_post'],$posts);  

            //on recupere les reactions des post
            $r[$i] = $reaction->getAllreactionsByIdPost($id_news_posts[$i]);

           
            
            
           
            
          
            
           
            
        }
 
    
        



    // echo json_encode($_SESSION['new_post']);
    $_SESSION["posts"] = $tab_id_posts2;
   
  
   echo json_encode([ "post" =>  $_SESSION['new_post'] , 'reactions' => $r ]);
  
    
   

    
}else{
    echo json_encode(["message" => "pas de nouveaux message" ]);
}



 



?>