
<body>
<header>
    <?php
    include("includes/header.php");

   ?>

   
</header>
<main>

<div class="container-l"></div>
<form method="post" action="php/traitement_hashtag.php">
							<textarea class="status"  maxlength="200" name="status" placeholder="entrer le message" rows="" cols=""></textarea>
 						 	<div class="hash-box">
						 		<ul>
  						 		</ul>
						 	</div>						 
						 		<input type="submit" name="" value="envoi"/>
						 </form>
						 
						 <div class="container hashtag">

                   <h2>Tendances du moment</h2>
<?php $res = $db->query('SELECT * FROM hashtag_trend');
   foreach ($res as $result){
   
	   echo '<a href="hashtag.php?id='.$result->id_hashtag.'">'.$result->hashtag.'</a>';

   }
   ?>
</div>
<!-- ouverture du chat -->
<div class="popupChat"></div>

</main>
<script src="js/envoi_message.js"></script>
<script src="js/chat.js"></script>
<script src="js/search.js"></script>
<script src="js/hashtag.js"></script>

<!-- c'est cette div qui permet d'ouvrir le pop up du chat -->

<footer>
    <?php
    include("includes/footer.php") ?>
</footer>
