<?php $page_selected = 'chat'; 
session_start();
?>
<html>
<body>

<?php
    include("includes/header.php");
   ?>


<main>
<div class="container">Chat</div>

<div class="container">
    <div class="row">
        <div class="col-sm-3">
    
<img src="images/default-profile.png" class="circle-profile" alt="image-profil">
<h4>Prénom Nom</h4>
<h3>MESSAGERIE...</h3>
<input type="text" placeholder="chercher dans message">

<div class="open-discussion">
<img src="images/default-profile.png" class="circle-profile" alt="image-profil">
<p>Nom prénom</p>
<p>dernier message il y a 2 jours</p>

</div>


</div>
        
        <div class="col-sm-9">
        <img src="images/default-profile.png" class="circle-profile" alt="image-profil">
        <h2>Prénom Nom</h2>
        

        <form action="post">
<textarea name="" placeholder="votre message..." id="mytext">
</textarea>
<button class="btn-envoyer"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
</form>

<div class="box-message"></div>

</div>
    </div>
</div>

</div>





</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
<script src="js/chat.js"></script>
<?php include('includes/footer.php') ?>
