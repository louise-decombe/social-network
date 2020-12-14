<?php 
<<<<<<< HEAD
    include 'includes/header.php' ;
    require 'php/traitement_feed.php';  
?>

=======
require 'class/Config.php';
require 'php/traitement_feed.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>social_network - index</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="#">
    <link rel="stylesheet" type="text/css" href="css/fontello/css/fontello.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
   
<header>
    <!--  -->
</header>
>>>>>>> 108fe620d73db74705f7eb7fac5cef2a9fc48ebc
<main class="main_feed">
    <div class="ovale_1"></div>
    <div class="ovale_2"></div>
    <div class="ovale_3"></div>

   
    <!-- A RENDRE DYNAMIQUE -->
    <section class="section_perso">
        <div class='div_infos_perso'>

            <!-- A RENDRE DYNAMIQUE -->
            <?php if ($infos_user[0]["photo"] == NULL) :?>
                <img class="photo_profil_feed" src="images/defaut.jpg" alt="">
            <?php else :?>
                <img class="photo_profil_feed" src="images/defaut.jpg" alt="">
            <?php endif ;?>
            
            <h2><?= htmlspecialchars($infos_user[0]["firstname"])." ".htmlspecialchars($infos_user[0]["lastname"]) ?></h2>
        </div>
        <h3 class="titre_h3_feed">Relations</h3>
        <!-- TRANSFORMER EN LIEN QUI AFFICHERA LA LISTE -->
        <p class="p_relations"><?= $infos_user[0]["nbr"] ?> relations</p>
        <h3 class="titre_h3_feed">Posts Recents</h3>
        <?php if (empty($dernier_post)) :?>
            <p>Aucun post</p>
        <?php else :?>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis deserunt eaque fuga iusto voluptatem voluptatibus nisi, at quidem quam adipisci odio aspernatur minus, perspiciatis labore optio unde excepturi possimus provident.</p>
        <?php endif ;?>
        <h3 class="titre_h3_feed">Groupes</h3>
        <ul>
            <?php foreach ($groupes as $nom) :?>
                <li><?= $nom['nom'] ?></li>
            <?php endforeach ;?>
        </ul>
        <h3 class="titre_h3_feed">Vous connessez peut etre ?</h3>
       
            
            <!-- A RENDRE DYNAMIQUE METTRE LE NOM EN LIEN VERS LE PROFIL -->
            <?php foreach($amis_en_communs as $key => $valeur) :?>  
                <div class="div_amis_communs">
                    <?php   $info = $user->GetUserById($valeur);  ?>
                    <?php if ($info['photo'] == NULL) :?>
                        <img  src="images/default_avatar.png" alt="<?= $info['firstname']." ".$info['lastname'] ?>">
                    <?php else :?>
                    <!-- A RENDRE DINAMIQUE -->
                        <img  src="images/default_avatar.png" alt="<?= $info['firstname']." ".$info['lastname'] ?>">
                    <?php endif ;?>
                    <div class="div_suggestion_amis">
                        <h4><?= $info['firstname']." ".$info['lastname'] ?></h4>
                        <p><?php echo  $nbr_amis_commun[$valeur]?> ami(s) en commun</p>
                        
                    </div>
                </div>
            <?php endforeach ;?>
            
       
 
    </section>
    <!-- A RENDRE DYNAMIQUE -->
    <section class="feed">
        
        <section class="section_post">
            <div id="toto" class="w-75 text-center m-auto">
                
            </div>
            <div class="div_post">
                <img src="images/defaut.jpg" alt=""> 
                <button id="btn_form_form"> <span class="icon-chat"></span>  Que voulez - vous partagez @<?= htmlspecialchars($infos_user[0]["firstname"]) ?> ?</button> 
            </div>
            
        </section>
        
        <section id="modale2">
            <div class="div_form">
                <div class="header_modal">
                    <h2>Créer un post</h2>
                    <button id="form_close"><span class="icon-cancel-1"></span></button>
                </div>
                <form id="form_post" action="php/traitement_messages.php"  method="POST" enctype="multipart/form-data"> 
                
                    <textarea name="message" id="message" cols="30" rows="10" >De quoi souhaitez-vous discuter ?</textarea>
                    <div id="input_form">
                        <p id="message_erreur" class="alert"></p>
                    </div>
                    <div class="medias">
                        <div>
                            <span id="photo" class=" source"><i class="icon-picture"></i>Photo</span>
                            <span id="video" class=" source"><i class="icon-youtube-play"></i>Video </span>
                            <span id="url" class=" source"><i class="icon-link"></i>Url</span>
                        </div>
                        <input id="btn_valider" class="btn  form-control " type="submit" name="valider" value="Valider"  >
                    </div>
                </form>
            </div>
        </section>
        <section id="section_affichage_posts">
            <?php for ($i = 0 ; $i < COUNT( $posts ) ; $i++) :?>
            <section class="section_posts">
                <div class="infos_user">
                    <?php if ($posts[$i]['photo'] == NULL ) :?>
                        <img src="images/default_avatar.png" alt="Photo par defaut">
                    <?php else : ?>
                        <img src="<?= htmlspecialchars($posts[0]['photo']) ?>" alt=" Photo de <?= htmlspecialchars($posts[$i]['firstname']) ?> <?= htmlspecialchars($posts[$i]['lastname']) ?>">
                    <?php endif ;?>
                    <div>
                        <p><?= htmlspecialchars($posts[$i]['firstname']) ?> <?= htmlspecialchars($posts[$i]['lastname']) ?></p>
                         <p><?= htmlspecialchars($follow->FollowedBy($posts[$i]['id'])) ?> relations</p>
                        <p></p>
                         <!-- Date -->
                        <p><?= htmlspecialchars($posts[$i]['date_created']) ?></p>
                    </div>
                </div>
                <div>
                    <p class="p_content"><?= htmlspecialchars($posts[$i]['content'])  ?> </p>
                    <a href="#">... Voir plus</a>
                     <!-- ICI TRAITEMENT DU MEDIA -->
                     <div class="media">
                        
                        <?php if ($posts[$i]['type_media'] == 1 ) :?>
                            <img src="php/upload_media_post/<?= htmlspecialchars($posts[$i]['media']) ?>" alt="Image/photo">
                        <?php elseif ($posts[$i]['type_media'] == 2 ) :?>
                            <video controls src="php/upload_media_post/<?= htmlspecialchars($posts[$i]['media']) ?>">Ici la description alternative</video>
                        <?php endif ;?>

                    </div>
                    <div>
                        <!-- Les likes , recation et nombre commentaire -->
                        <hr>
                        <div>
                            <!-- Reactions -->
                        </div>
                    </div>

                </div>
            </section>
            <?php endfor ;?>
        </section>
        
    </section>

</main>
<footer>
    <?php include 'includes/footer.php'; ?>
    
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="js/fonctions/fonction_posts.js"></script>
<script src="js/template_feed.js"></script>
<script src="js/fil_actu.js"></script>

<?php unset($_SESSION['erreur']) ;?>
</body>
</html>