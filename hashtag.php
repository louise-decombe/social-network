<body>
   <header>
      <?php
         include("includes/header.php");
         ?>
   </header>
   <main>
     
      <div class="container hashtag">

      <?php $res = $db->query('SELECT * FROM hashtag_trend');
         foreach ($res as $result){
         
             echo '<a href="hashtag.php?id='.$result->id.'">'.$result->hashtag.'</a>';
         
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