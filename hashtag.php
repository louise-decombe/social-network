<?php
    include 'class/Config.php';
?>

<!DOCTYPE html>

<html lang="fr">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- liens css (css) -->
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/hashtag.css">
      <link  rel="stylesheet" href="css/styles.css">
      <link rel="stylesheet" type="text/css" href="css/fontello/css/fontello.css">

      <link rel="stylesheet" href="css/chat.css">
      <link rel="stylesheet" type="text/css" href="css/style-forms.css">
     <!-- liens css (bootstrap, fontawesome) -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="shortcut icon" type="image/x-icon" href="#">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- liens script, jquery ajax -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 -->
    <script src="js/search.js"></script>
    <script src="js/chat.js"></script>
    <script src="js/search_chat.js"></script>
    <script src="js/envoi_message.js"></script>
     <script src="js/hashtag.js"></script>


    </head>
   <header>
      <?php
         include("includes/header.php");
         ?>
   </header>
   <main>
     
      <div class="container hashtag">


   
      <?php
      
      $select = $_GET['id'];
      
      $res = $db->query("   SELECT

*
    
  FROM hashtag_liaison_post
  JOIN hashtag_trend
      ON hashtag_liaison_post.id_hashtag = hashtag_trend.id_hashtag
  JOIN post
      ON hashtag_liaison_post.id_post = post.id
      JOIN users 
      ON hashtag_liaison_post.id_user = users.id
      
      WHERE hashtag_trend.id_hashtag =$select" );


         foreach ($res as $result){
         
            echo '<p>'.$result->created_at.'</p>';
            echo '<p>'.$result->firstname.'</p>';
            echo '<p>'.$result->lastname.'</p>';
             echo '<p>'.$result->content.'</p>';
         
         ?>
      <?php
         }
         
         ?>
      </div>
      <div class="popupChat"></div>
   </main>
   <script src="js/envoi_message.js"></script>
   <script src="js/chat.js"></script>
   <script src="js/search.js"></script>
   <script src="js/hashtag.js"></script>
   <!-- c'est cette div qui permet d'ouvrir le pop up du chat -->
   <div class="popupChat"></div>
   <footer>
      <?php
         include("includes/footer.php") ?>
   </footer>