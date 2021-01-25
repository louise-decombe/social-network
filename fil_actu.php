<?php session_start();
    $_SESSION["new_post"] = [];
    $_SESSION['posts']= [];
    $_SESSION['tab_user'] = [];
    $_SESSION['erreur'] = [];

    require 'class/Config.php' ;
    require 'php/traitement_feed.php'; 
    require 'php/functions/functions_feed.php';
 
    

?>
<!DOCTYPE html>

<html lang="fr">
<head>
    <title>Fil d'actualité</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- liens css (css) -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/hashtag.css">
    <link rel="stylesheet" href="css/chat.css">

    <link  rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/fontello/css/fontello.css">

    <!-- <link rel="stylesheet" href="css/chat.css"> -->
    <link rel="stylesheet" type="text/css" href="css/style-forms.css">
    <!-- liens css (bootstrap, fontawesome) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="#">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- liens script, jquery ajax -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> 
    
    <!-- FONCTIONS JS-->
    <script src="js/fonctions/fonction_posts.js"></script>
    <script src="js/fonctions/fonctions_reactions.js"></script>

    <!-- TEMPLATE JS  -->
    <script src="js/template_feed.js"></script>

    <script src="js/search.js"></script>
    <script src="js/chat.js"></script>
    <script src="js/search_chat.js"></script>
    <script src="js/envoi_message.js"></script>
    <script src="js/fil_actu.js"></script>
    <script src="js/reactions.js"></script>



    </head>
    
     <!-- HEADER ------------------------->
    <?php require 'includes/header.php'; ?>
    <!------------------------------------>

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
                
                <h2><?= ucfirst(htmlspecialchars($infos_user[0]["firstname"]))." ".ucfirst(htmlspecialchars($infos_user[0]["lastname"])) ?></h2>
            </div>
            <h3 class="titre_h3_feed">Relations</h3>
            
            <p class="p_relations"><?= $infos_user[0]["nbr"] ?> relations</p>
            
            <section class="section_amis_en_communs">
                <h3 class="titre_h3_feed">Vous connessez peut etre ?</h3>
        
                
                <!-- A RENDRE DYNAMIQUE METTRE LE NOM EN LIEN VERS LE PROFIL -->
                <?php if (isset($amis_en_communs)) : ?>
                    <?php foreach($amis_en_communs as $key => $valeur) :?> 
                    
                        <div class="div_amis_communs">
                            <?php   $info = $user->GetUserById($valeur);   ?>
                            <?php if ($info['photo'] == NULL) :?>
                                <img  src="php/upload/default_avatar.png" alt="<?= $info['firstname']." ".$info['lastname'] ?>">
                            <?php else :?>
                            <!-- A RENDRE DINAMIQUE -->
                                <img  src="php/<?= $info['photo'] ?>" alt="<?= $info['firstname']." ".$info['lastname'] ?>">
                            <?php endif ;?>
                            <div class="div_suggestion_amis">
                                <a href="profile_public.php?id=<?= $info['id'] ?>"><h4><?= ucfirst($info['firstname'])." ".ucfirst($info['lastname']) ?></h4></a>
                                <p><?php echo  $tab1[$key] ?> ami(s) en commun</p>
                                
                            </div>
                        </div>
                    <?php endforeach ;?>
                <?php else :?>
                    <?php $info = $user->GetRandomUsers($id_user) ; ?>
                        <?php for ($i = 0 ; $i < COUNT($info) ; $i++) :?>
                            <div class="div_amis_communs">
                                <?php if ($info[$i]['photo'] == NULL) :?>
                                    <img  src="images/default_avatar.png" alt="<?= $info[$i]['firstname']." ".$info[$i]['lastname'] ?>">
                                    <?php else :?>
                                    <img  src="php/<?= $info[$i]['photo'] ?>" alt="<?= $info[$i]['firstname']." ".$info[$i]['lastname'] ?>">
                                <?php endif ;?>
                                <div class="div_suggestion_amis">
                                    <a href="profile_public.php?id=<?= $info[$i]['id']?>"><h4><?= ucfirst($info[$i]['firstname'])." ".ucfirst($info[$i]['lastname']) ?></h4></a>                            
                                </div>
                            </div>
                        <?php endfor ;?>
                <?php endif ;?>
            </section>
        </section>
        <!-- ------------------------ ESPACE PERSO MOBILE ------------------------------ -->

        
        <section class="section_perso_mobile">
            <span class="btn_nav_bar_mobile_fermeture icon-cancel"></span>
            <!-- A RENDRE DYNAMIQUE -->
            <?php if ($infos_user[0]["photo"] == NULL) :?>
                <img class="photo_profil_feed" src="images/defaut.jpg" alt="">
            <?php else :?>
                <img class="photo_profil_feed" src="images/defaut.jpg" alt="">
            <?php endif ;?>

            <h2><?= ucfirst(htmlspecialchars($infos_user[0]["firstname"]))." ".ucfirst(htmlspecialchars($infos_user[0]["lastname"])) ?></h2>
            <section>
                <h3 class="titre_h3_feed">Vous connessez peut etre ?</h3>
       
            
                <!-- A RENDRE DYNAMIQUE METTRE LE NOM EN LIEN VERS LE PROFIL -->
            
                <?php if (isset($amis_en_communs)) :?>
                    <?php foreach($amis_en_communs as $key => $valeur) :?>  
                        <div class="div_amis_communs">
                            <?php   $info = $user->GetUserById($valeur);   ?>
                            <?php if ($info['photo'] == NULL) :?>
                                <img  src="php/uploads/default_avatar.png" alt="<?= $info['firstname']." ".$info['lastname'] ?>">
                            <?php else :?>
                            <!-- A RENDRE DINAMIQUE -->
                                <img  src="php/<?=$info['photo']?>" alt="<?= $info['firstname']." ".$info['lastname'] ?>">
                            <?php endif ;?>
                            <div class="div_suggestion_amis">
                                <a href="profile_public.php?id=<?= $info['id'] ?>"><h4><?= ucfirst($info['firstname'])." ".ucfirst($info['lastname']) ?></h4></a>
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
                                    <img  src="<?= $info['photo'] ?>" alt="<?= $info[$i]['firstname']." ".$info[$i]['lastname'] ?>">
                                <?php endif ;?>
                                <div class="div_suggestion_amis">
                                    <a href=""><h4><?= ucfirst($info[$i]['firstname'])." ".ucfirst($info[$i]['lastname']) ?></h4></a>                            
                                </div>
                            </div>
                        <?php endfor ;?>
                <?php endif ;?>
            </section>
        </section>

        <!-- ---------------------------------------------------------------------------  -->
    
        <section class="feed">
        <span class="btn_nav_bar_mobile icon-menu"></span>
            <section class="section_post">
                <div class="div_post">
                    <img src="images/defaut.jpg" alt=""> 
                    <button id="btn_form_form"> <span class="icon-chat"></span>  Que voulez - vous partagez @<?= ucfirst(htmlspecialchars($infos_user[0]["firstname"])) ?> ?</button> 
                </div>
                <div id="formulaire_post" class="w-75 text-center m-auto"></div>
                
            </section>
            <div id='btn_new_message'></div>
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
                        <img src="php/<?= htmlspecialchars($posts[$i]['photo']) ?>" alt=" Photo de <?= htmlspecialchars($posts[$i]['firstname']) ?> <?= htmlspecialchars($posts[$i]['lastname']) ?>">
                    <?php endif ;?>
                    <div class="div_flex">
                        <div class="div_first">
                            <p><a href='profile_public.php?id=<?= $posts[$i]['id_user'] ?>'><?= ucfirst(htmlspecialchars($posts[$i]['firstname'])) ?> <?= ucfirst(htmlspecialchars($posts[$i]['lastname'])) ?></a></p>
                            <p>Suivis par <?= htmlspecialchars($follow->FollowedBy($posts[$i]['id'])) ?> personne(s)</p>
                            <p><?= htmlspecialchars($posts[$i]['date_created']) ?></p>
                        </div>
                        <div class="div2">
                            <div>
                                <p class=" menu_signal menu_signal_<?= $posts[$i]['id_post'] ?>" data-id_post='<?= $posts[$i]['id_post'] ?>' data-statut='off'>°°°</p>
                                <div class='none div_signal div_signal_<?= $posts[$i]['id_post'] ?>' data-id_post='<?= $posts[$i]['id_post'] ?>' >
                                    <a href="" >Signaler le post</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div>
                    <?php if (strlen($posts[$i]['content']) > 400) : ?>
                        <?php if (!isset($_GET['id']) || $_GET['id'] !== $posts[$i]['id_post']) :?>
                            <p class="p_content" id="p_<?= htmlspecialchars($posts[$i]['id_post']) ?>"><?= htmlspecialchars(mb_strimwidth($posts[$i]['content'],0,400,'...'))  ?>   <a class="plus plus_<?= htmlspecialchars($posts[$i]['id_post']) ?>" id="<?= htmlspecialchars($posts[$i]['id_post']) ?>" href="fil_actu.php?id=<?= htmlspecialchars($posts[$i]['id_post']) ?>#section_<?= htmlspecialchars($posts[$i]['id_post']) ?>">... Voir plus</a></p>
                          
                        <?php else:?>
                            <p class="p_content" id="p_<?= htmlspecialchars($posts[$i]['id_post']) ?>"><?= htmlspecialchars($posts[$i]['content'])  ?> </p>
                            <a class="moins" id="<?= htmlspecialchars($posts[$i]['id_post']) ?>" href="fil_actu.php#section_<?= htmlspecialchars($posts[$i]['id_post']) ?>">... Voir moins</a>
                        <?php endif ;?>
                    <?php else :?>
                        <p class="p_content"><?= htmlspecialchars($posts[$i]['content'])  ?> </p>
                    <?php endif ;?>
                    
                    
                     <div class="media">
                        
                        <?php if ($posts[$i]['type_media'] == 1 ) :?>
                            <img src="php/upload_media_post/<?= htmlspecialchars($posts[$i]['media']) ?>" alt="Image/photo">
                        <?php elseif ($posts[$i]['type_media'] == 2 ) :?>
                            <video controls src="php/upload_media_post/<?= htmlspecialchars($posts[$i]['media']) ?>" width="50">Ici la description alternative</video>
                        <?php elseif ($posts[$i]['type_media'] == 3 ) :?>
                            <a href="<?= htmlspecialchars($posts[$i]['media']) ?>"><?= htmlspecialchars($posts[$i]['media']) ?></a>
                        <?php endif ;?>

                    </div>
                    
                <div>
                
                    <a  href='#'><div class="reactions_miniatures reactions_miniatures_<?= htmlspecialchars($posts[$i]['id_post']) ?>" data-id_post="<?= htmlspecialchars($posts[$i]['id_post']) ?>">
                           
                        <?php 
                        for ($c = 1 ; $c <= 6 ; $c ++){
                            $react[$c] = $reaction->GetreactionByReaction($posts[$i]['id_post'],$c);
                            
                        }?>
                       
                       <?php   
                            affichage_pictogramme($react,1,'pouce.png');
                            affichage_pictogramme($react,2,'bravo.png');
                            affichage_pictogramme($react,3,'soutien.png');
                            affichage_pictogramme($react,4,'jadore.png');
                            affichage_pictogramme($react,5,'instructif.png');
                            affichage_pictogramme($react,6,'interressant.png');
                       ?>
                      
                       <?php if ($react[1][0]['nbr'] == 0 && $react[2][0]['nbr'] == 0 && $react[3][0]['nbr'] == 0 && $react[4][0]['nbr'] == 0 && $react[5][0]['nbr'] == 0 && $react[5][0]['nbr'] == 0 ) :?>
                           <p class='p_reaction'>Soyez le premier a réagir a ce post !</p>
                       <?php endif ;?>   

                    </div></a>
                    <p class="p_commentaires p_commentaires_<?=$posts[$i]['id_post']?>" data-id_post='<?=$posts[$i]['id_post']?>'><?= COUNT($comment->GetCommentByIdPost($posts[$i]['id_post'])) ?> Commentaire(s)</p>
                        <!-- Les likes , recation et nombre commentaire -->
                        <hr>
                        <div class="reactions">
                            <!-- Reactions -->
                            <div class="modale_reaction modale_reaction_<?= htmlspecialchars($posts[$i]['id_post']) ?>">
                               
                                <div>
                                    <span class="jaime span_titre_reaction">J'aime</span>
                                    <a href="" ><img id="jaime" class="icon_block" src="images/pouce.png" alt="j'aime" data-id_post=<?= htmlspecialchars($posts[$i]['id_post']) ?>></a>
                                </div> 
                                <div>  
                                    <span class="bravo span_titre_reaction">Bravo</span>
                                    <a href=""  ><img id="bravo" class="icon_block" src="images/bravo.png" alt="bravo" data-id_post=<?= htmlspecialchars($posts[$i]['id_post']) ?>></a>
                                </div>
                                <div>    
                                    <span class="soutien span_titre_reaction">Soutien</span>
                                    <a href=""  ><img id="soutien" class="icon_block" src="images/soutien.png" alt="soutien" data-id_post=<?= htmlspecialchars($posts[$i]['id_post']) ?>></a>
                                </div>
                                <div>    
                                    <span class="jadore span_titre_reaction">J'adore</span>
                                    <a href="" ><img id="jadore" class="icon_block" src="images/jadore.png" alt="j'adore" data-id_post=<?= htmlspecialchars($posts[$i]['id_post']) ?>></a>
                                </div>
                                <div>    
                                    <span class="instructif span_titre_reaction">Instructif</span>
                                    <a href="" ><img id="instructif" class="icon_block" src="images/instructif.png" alt="instructif" data-id_post=<?= htmlspecialchars($posts[$i]['id_post']) ?>></a>
                                </div>    
                                <div>     
                                    <span class="interressant span_titre_reaction">Interressant</span>
                                    <a href="" ><img id="interressant" class="icon_block" src="images/interressant.png" alt="interressant" data-id_post=<?= htmlspecialchars($posts[$i]['id_post']) ?>></a>
                                </div>
                            </div>
                             
                            <?php if (isset($reaction_post)) : $reactions = false; ?>
                                <?php for ($j = 0 ; $j < COUNT($reaction_post) ; $j++) :  ?>
                                            
                                    <?php if ($reaction_post[$j]['id_post'] == $posts[$i]['id_post'] && $reaction_post[$j]['id_user'] == $posts[$i]['id_user']) :?>
                                        
                                        <?php $reactions = true; $id_reaction = $reaction_post[$j]['id_reactions']; ?>
                                           
                                    <?php endif ;?>
                                <?php endfor ;?>
                                      
                                <?php if ($reactions == true ) :?>
                                    
                                    <?php if ($id_reaction == '1') :?>
                                        <div class="bleu div_icon  div_icon-thumbs-up<?= htmlspecialchars($posts[$i]['id_post']) ?>" data-react='modale_reaction_<?= htmlspecialchars($posts[$i]['id_post']) ?>' data-id_post='<?= htmlspecialchars($posts[$i]['id_post']) ?>'><span class="icon-thumbs-up"></span>J'aime</div>
                                    <?php elseif ($id_reaction == '2'):?>
                                        <div class="bleu div_icon  div_icon-thumbs-up<?= htmlspecialchars($posts[$i]['id_post']) ?>" data-react='modale_reaction_<?= htmlspecialchars($posts[$i]['id_post']) ?>' data-id_post='<?= htmlspecialchars($posts[$i]['id_post']) ?>'><span class="icon-thumbs-up"></span>Bravo</div>
                                    <?php elseif ($id_reaction == '3'):?>
                                        <div class="bleu div_icon  div_icon-thumbs-up<?= htmlspecialchars($posts[$i]['id_post']) ?>" data-react='modale_reaction_<?= htmlspecialchars($posts[$i]['id_post']) ?>' data-id_post='<?= htmlspecialchars($posts[$i]['id_post']) ?>'><span class="icon-thumbs-up"></span>Soutien</div>
                                    <?php elseif ($id_reaction == '4'):?>
                                        <div class="bleu div_icon  div_icon-thumbs-up<?= htmlspecialchars($posts[$i]['id_post']) ?>" data-react='modale_reaction_<?= htmlspecialchars($posts[$i]['id_post']) ?>' data-id_post='<?= htmlspecialchars($posts[$i]['id_post']) ?>'><span class="icon-thumbs-up"></span>J'adore</div>
                                    <?php elseif ($id_reaction == '5'):?>
                                        <div class="bleu div_icon  div_icon-thumbs-up<?= htmlspecialchars($posts[$i]['id_post']) ?>" data-react='modale_reaction_<?= htmlspecialchars($posts[$i]['id_post']) ?>' data-id_post='<?= htmlspecialchars($posts[$i]['id_post']) ?>'><span class="icon-thumbs-up"></span>Instructif</div>
                                    <?php elseif ($id_reaction == '6'):?>
                                        <div class="bleu div_icon  div_icon-thumbs-up<?= htmlspecialchars($posts[$i]['id_post']) ?>" data-react='modale_reaction_<?= htmlspecialchars($posts[$i]['id_post']) ?>' data-id_post='<?= htmlspecialchars($posts[$i]['id_post']) ?>'><span class="icon-thumbs-up"></span>Interressant</div>
                                    <?php endif ;?>
                                    
                                <?php else : ?>
                                    <div class=" div_icon  div_icon-thumbs-up<?= htmlspecialchars($posts[$i]['id_post']) ?>" data-react='modale_reaction_<?= htmlspecialchars($posts[$i]['id_post']) ?>' data-id_post='<?= htmlspecialchars($posts[$i]['id_post']) ?>'><span class="icon-thumbs-up"></span>J'aime</div>
                                <?php endif ;?>
                            <?php endif ;?>
                          
 
                            <div class="icon-c icon-c<?= htmlspecialchars($posts[$i]['id_post']) ?>" data-id_post='<?= htmlspecialchars($posts[$i]['id_post']) ?>'><span class="icon-chat-1"></span>Commenter</div>
                        </div>
                    </div>

                </div>
                
                <section class="" id="section_liste_reactions_<?= htmlspecialchars($posts[$i]['id_post']) ?>"  >
                    
                </section>
                
                <section id="section_form_commentaire_p<?= htmlspecialchars($posts[$i]['id_post']) ?>">

                </section>
                <section id='formulaire_ajout_commentaire_<?= htmlspecialchars($posts[$i]['id_post']) ?>'>
                <?php if (!empty($_SESSION['erreur'])) :?>
                    <p><?= $_SESSION['erreur'] ?></p>
                <?php endif ;?>
                </section> 
            </section>
           
            <?php endfor ;?>  
            
            <?php if ( COUNT($posts) >4 ) : ?>            
                <button id="More_post">Voir plus</button>
            <?php endif ;?>
        <?php else : ?>
            <p class="p_default">Aucuns posts pour le moment !</p>
        <?php endif ;?>
 
        </section>

    </section>
    <div class="popupChat"></div>
  
</main>

<footer>
    <?php include 'includes/footer.php'; ?>
</footer>

<?php unset($_SESSION['erreur']) ;?>
<script type="text/javascript" src="js/chat.js"></script>
<script src="js/envoi_message.js"></script>
</body>
</html>