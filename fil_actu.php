<?php session_start();

    require 'class/Config.php' ;
    require 'php/traitement_feed.php'; 
    //require 'php/traitement_posts_feed.php'; 
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
    <!-- <script src="js/hashtag.js"></script> -->


    </head>
    <header>
    
    </header>

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
            
            <h3 class="titre_h3_feed">Groupes</h3>
            <ul>
                <?php if (!empty($groupes)) :?>
                    <?php foreach ($groupes as $nom) : ?>
                        <li><?= $nom['nom'] ?></li>
                    <?php endforeach ;?>
                <?php else : ?>
                    <li>Vous n'etes dans auncun groupe</li>
                <?php endif ;?>
            </ul>
            <h3 class="titre_h3_feed">Vous connessez peut etre ?</h3>
       
            
            <!-- A RENDRE DYNAMIQUE METTRE LE NOM EN LIEN VERS LE PROFIL -->
            <?php if (isset($amis_en_communs)) :?>
                <?php foreach($amis_en_communs as $key => $valeur) :?>  
                    <div class="div_amis_communs">
                        <?php   $info = $user->GetUserById($valeur);   ?>
                        <?php if ($info['photo'] == NULL) :?>
                            <img  src="uploads/default_avatar.png" alt="<?= $info['firstname']." ".$info['lastname'] ?>">
                        <?php else :?>
                        <!-- A RENDRE DINAMIQUE -->
                            <img  src="uploads/default_avatar.png" alt="<?= $info['firstname']." ".$info['lastname'] ?>">
                        <?php endif ;?>
                        <div class="div_suggestion_amis">
                            <a href=""><h4><?= $info['firstname']." ".$info['lastname'] ?></h4></a>
                            <p><?php echo  $tab1[$key] ?> ami(s) en commun</p>
                            
                        </div>
                    </div>
                <?php endforeach ;?>
            <?php else :?>
                <?php $info = $user->GetRandomUsers($id_user) ;  ?>
                    <?php for ($i = 0 ; $i < COUNT($info) ; $i++) :?>
                        <div class="div_amis_communs">
                            <?php if ($info[$i]['photo'] == NULL) :?>
                                <img  src="images/default_avatar.png" alt="<?= $info[$i]['firstname']." ".$info[$i]['lastname'] ?>">
                                <?php else :?>
                            <!-- A RENDRE DINAMIQUE -->
                                <img  src="images/default_avatar.png" alt="<?= $info[$i]['firstname']." ".$info[$i]['lastname'] ?>">
                            <?php endif ;?>
                            <div class="div_suggestion_amis">
                                <a href=""><h4><?= $info[$i]['firstname']." ".$info[$i]['lastname'] ?></h4></a>                            
                            </div>
                        </div>
                    <?php endfor ;?>
                <!-- faire uen selection de personne au hazard -->
            <?php endif ;?>
            
       
 
    </section>
    <!-- A RENDRE DYNAMIQUE -->
    <section class="feed">
        
        <section class="section_post">
            <div class="div_post">
                <img src="images/defaut.jpg" alt=""> 
                <button id="btn_form_form"> <span class="icon-chat"></span>  Que voulez - vous partagez @<?= htmlspecialchars($infos_user[0]["firstname"]) ?> ?</button> 
            </div>
            <div id="toto" class="w-75 text-center m-auto"></div>
            
        </section>
        
        <section id="modale2">
            <div class="div_form">
                <div class="header_modal">
                    <h2>Créer un post</h2>
                    <button id="form_close"><span class="icon-cancel-1"></span></button>
                </div>
                <form id="form_post" action="php/traitement_messages.php"  method="POST" enctype="multipart/form-data"> 
                    <p class="text-center w-75 m-auto" id="form_erreur"></p>
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
            
        <?php if (isset($posts)) : ?>
            <?php for ($i = 0 ; $i < COUNT( $posts ) ; $i++) :?>
                
            <section class="section_posts" id="section_<?= htmlspecialchars($posts[$i]['id_post']) ?>">
                <div class="infos_user">
                    <?php if ($posts[$i]['photo'] == NULL ) :?>
                        <img src="images/default_avatar.png" alt="Photo par defaut">
                    <?php else : ?>
                        <img src="<?= htmlspecialchars($posts[$i]['photo']) ?>" alt=" Photo de <?= htmlspecialchars($posts[$i]['firstname']) ?> <?= htmlspecialchars($posts[$i]['lastname']) ?>">
                    <?php endif ;?>
                    <div>
                        <p><?= htmlspecialchars($posts[$i]['firstname']) ?> <?= htmlspecialchars($posts[$i]['lastname']) ?></p>
                         <p>Suivis par <?= htmlspecialchars($follow->FollowedBy($posts[$i]['id'])) ?> personne(s)</p>
                        <p></p>
                         <!-- Date -->
                        <p><?= htmlspecialchars($posts[$i]['date_created']) ?></p>
                    </div>
                </div>
                <div>
                    <?php if (strlen($posts[$i]['content']) > 200) : ?>
                        <?php if (!isset($_GET['id']) || $_GET['id'] !== $posts[$i]['id_post']) :?>
                            <p class="p_content" id="p_<?= htmlspecialchars($posts[$i]['id_post']) ?>"><?= htmlspecialchars(mb_strimwidth($posts[$i]['content'],0,200,'...'))  ?> </p>
                            <a class="plus plus_<?= htmlspecialchars($posts[$i]['id_post']) ?>" id="<?= htmlspecialchars($posts[$i]['id_post']) ?>" href="fil_actu.php?id=<?= htmlspecialchars($posts[$i]['id_post']) ?>#section_<?= htmlspecialchars($posts[$i]['id_post']) ?>">... Voir plus</a>
                        <?php else:?>
                            <p class="p_content" id="p_<?= htmlspecialchars($posts[$i]['id_post']) ?>"><?= htmlspecialchars($posts[$i]['content'])  ?> </p>
                            <a class="moins" id="<?= htmlspecialchars($posts[$i]['id_post']) ?>" href="fil_actu.php#section_<?= htmlspecialchars($posts[$i]['id_post']) ?>">... Voir moins</a>
                        <?php endif ;?>
                    <?php else :?>
                        <p class="p_content"><?= htmlspecialchars($posts[$i]['content'])  ?> </p>
                    <?php endif ;?>
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
                        <div class="reactions">
                            <!-- Reactions -->
                            <div><span class="icon-thumbs-up"></span>J'aime</div>
                            <div><span class="icon-chat-1"></span>Commenter</div>
                            <div><spanv class="icon-share"></span>Partager</div>
                            <div><span class="icon-paper-plane"></span>Envoyer</div>
                        </div>
                    </div>

                </div>
            </section>
            <?php endfor ;?>

        <?php else : ?>
            <p>Aucun posts</p>
        <?php endif ;?>
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