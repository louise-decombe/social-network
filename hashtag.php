<body>
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
         
            var_dump($result);
            echo '<p>'.$result->created_at.'</p>';
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