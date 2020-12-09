
<body>
<header>
    <?php
    include("includes/header.php");
   ?>
</header>
<main>

<form method="post" enctype="multipart/form-data">
							<textarea class="status"  maxlength="200" name="status" placeholder="entrer le message" rows="" cols=""></textarea>
 						 	<div class="hash-box">
						 		<ul>
  						 		</ul>
						 	</div>						 
						 		<input type="submit" name="" value="envoi"/>
				 		</form>

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
