<?php
    include 'class/Config.php';
    
    // ID de session en Dur à supprimer plus tard.
    $_SESSION['user']['id'] = 1;
?>

<!DOCTYPE html>

<html lang="en">
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

    <?php include('includes/header.php');?>
   
</header>
<main>

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
