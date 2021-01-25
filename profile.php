<?php 
$page_selected = 'profile'; 
session_start();
if(isset($_SESSION['user'])){

require 'class/Db.php';
require 'class/User.php';
require 'class/Options.php';
$db = new DB();
$user = new User($db);
$options = new Options($db);
$cursus = $options->cursus_list();
$technos = $options->tech_list();
//var_dump($technos);
$date = new DateTime();
$id_user = $_SESSION['user']['id'];
//var_dump($id_user);
$user_details = $user->test($id_user);
//var_dump($user_details);
$user_followers = $user->followers($id_user);
//var_dump($user_followers);
$count_followers = $user->count_followers($id_user);
//var_dump($count_followers);
$post_users = $user->post_users($id_user);
$tech_name = $options->techno($id_user);
//var_dump($techn_name);

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>social_network - profile</title>
    <meta 
    rset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="#">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style-profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!--<script src="js/form_profile.js"></script>-->
    
</head>
<body>
<header>
    <?php
    include("includes/header.php");
    ?>
</header>
<main id="main-profile">

    <!--<div class="ovale_1"></div>-->
    <div class="ovale_2"></div>
    <div class="ovale_3"></div>

    <?php if(!empty($_SESSION['user'])){ ?>
    <section id="cover-pic">
        <img class="cover-pic" src="php/<?= $user_details['cover']?>" alt="cover-picture">
        <div id="profile_name">@
            <span id="profile_firstname"><?= $user_details['firstname'] ?></span> 
            <span id="profile_lastname"><?= $user_details['lastname'] ?></span>
        </div>
        <div class="p-cover">
            <form class="form_cover_upload" method="post" action="php/upload_cover.php" enctype="multipart/form-data">
                <i class="fa fa-camera upload-cover"></i>
                <button id="button_cover" type="submit" name='submit_cover'>
                    <i class="far fa-check-circle submit-cover">&nbsp valider la photo de cover</i>
                </button>
                <input type="hidden" name="id_user" class="id_user" value="<?= $id_user ?>">
                <input class="cover-upload" id="image1" type="file" name="cover" placeholder="Photo" required="" capture>
            </form>
        </div>
    </section>

    <div class="row container_pic_profile">
        <div class="small-12 medium-2 large-2 columns">
            <div class="circle">
                 <!--User Profile Image-->
                <img class="profile-pic" src="php/<?= $user_details['photo']?>" alt="profile-mini-pic" width="112.5">
            </div>
            <div class="p-image">
                <form class="form_pic_upload" method="post" action="php/upload_pics.php" enctype="multipart/form-data">
                    <i class="fa fa-camera upload-button"></i>
                    <button id="button_pic_profile" type="submit" name='submit_pic'>
                        <i class="far fa-check-circle submit-pic">&nbsp valider la photo de profil</i>
                    </button>
                    <input type="hidden" name="id_user" class="id_user" value="<?= $id_user ?>">
                    <input class="file-upload" id="image" type="file" name="photo" placeholder="Photo" required="" capture>
                    <!--input class="file-upload" type="file" name="pic" accept="image/png, image/jpeg"/-->
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid sh-100 d-flex flex-column justify-content-center index_content">
        <div class="row">
            <div class="col-4">
                <article class="infos_user_profile">
                    <span data-text="vos informations">
                        VOS INFORMATIONS &nbsp; 

                        <!-- Link to open the modal -->
                        <?php if(isset($_SESSION['user'])){ ?>
                            <p><a href="#ex1" rel="modal:open"><i class="fas fa-pen-alt"></i></a></p>
                        <?php } ?>
                        
                         <!-- Modal HTML embedded directly into document -->
                        <div id="ex1" class="modal">
                            <div id="form_user_informations">
                                <p>modifier vos informations personnelles</p>
                                <div class="modify_input">
                                    <form id="user_birthday" method="POST" action="">
                                        <label>▪ ajouter ou modifier un anniversaire</label>
                                        <div class="container_input">
                                            <input type="hidden" name="id_user" class="id_user" value="<?= $id_user ?>">
                                            <input type="date" id="modify_birthday" class="modify_input_details" name="modify_birthday" placeholder="<?= $user_details['birthday']?>">
                                            <button type="submit" id="submit_birthday"><i class="far fa-check-circle"></i></button>
                                        </div>
                                        <div id="message_birthday"></div>
                                    </form>
                                </div>

                                <div class="modify_input">
                                    <form id="user_localite" method="POST" action="">
                                        <label>▪ ajouter ou modifier la localité</label>
                                        <div class="container_input">
                                            <input type="text" class="modify_input_details" id="modify_city" name="modify_city" placeholder="<?= $user_details['localite']?>">
                                            <input type="hidden" name="id_user" class="id_user" value="<?= $id_user ?>">
                                            <button type="submit" id="submit_localite"><i class="far fa-check-circle"></i></button>
                                        </div>
                                    </form>
                                    <div id="message_city"></div>
                                </div>
                                
                                <div id="result_city">
                                    <ul></ul>
                                </div>

                                <div class="modify_input">
                                    <form id="user_cursus" method="post" action="">
                                        <label>▪ ajouter ou modifier le cursus</label>
                                        <div class="container_input">
                                            <input type="hidden" name="id_user" class="id_user" value="<?= $id_user ?>">
                                            <select id="modify_cursus" class="modify_input_details" name="modify_cursus" required>
                                                <option selected>Sélectionner le cursus</option>
                                                <?php foreach ($cursus as $all_cursus){ ?>
                                                <option value="<?= $all_cursus['id_cursus'];?>" name="<?= $all_cursus['name_cursus'];?>"><?= $all_cursus['name_cursus'];?></option>
                                                <?php } ?>
                                            </select>
                                            <button type="submit" id="submit_cursus"><i class="far fa-check-circle"></i></button>
                                        </div>
                                    </form>
                                    <div id="message_cursus"></div>
                                </div>

                                <div class="modify_input">
                                    <form id="user_tech" method="post" action="">
                                        <span>▪ technologies</span>
                                        <?php
                                        foreach ($technos as $tech) { //var_dump($tech);
                                        ?>
                                            <input type="hidden" name="id_user" class="id_user" value="<?= $id_user ?>">
                                            <input class="techCheckbox" type="checkbox" id="<?= $tech['id'] ?>" name="<?= $tech['nom']?>" value="<?= $tech['id']?>">
                                            <label for="<?= $tech['id'] ?>"><?= $tech['nom']?></label>
                                        <?php
                                        } ?>
                                        <button type="submit" id="submit_tech"><i class="far fa-check-circle"></i></button>
                                    </form>
                                </div>

                                <div class="modify_input">
                                    <form id="user_entreprise" method="post" action="">
                                        <label>▪ ajouter ou modifier l'entreprise</label>
                                        <div class="container_input">
                                            <input type="hidden" name="id_user" class="id_user" value="<?= $id_user ?>">
                                            <input type="text" id="modify_entreprise" class="modify_input_details" name="modify_entreprise" placeholder="entreprise">
                                            <button type="submit" id="submit_entreprise"><i class="far fa-check-circle"></i></button>
                                        </div>
                                    </form>
                                    <div id="message_entreprise"></div>
                                </div>
                                <div class="modify_input">
                                    <form id="user_site" method="post" action="">
                                        <label>▪ ajouter ou modifier le site internet</label>
                                        <div class="container_input">
                                            <input type="hidden" name="id_user" class="id_user" value="<?= $id_user ?>">
                                            <input type="text" id="modify_website" class="modify_input_details" name="modify_website" placeholder="website">
                                            <button type="submit" id="submit_site"><i class="far fa-check-circle"></i></button>
                                        </div>
                                    </form>
                                    <div id="message_site"></div>
                                </div>
                                <div class="modify_input">
                                    <form id="user_hobbies" method="post" action="">
                                        <label>▪ ajouter ou modifier les centres d'intérêt</label>
                                        <div class="container_input">
                                            <input type="hidden" name="id_user" class="id_user" value="<?= $id_user ?>">
                                            <input type="text" id="modify_hobbies" class="modify_input_details" name="modify_hobbies" placeholder="centres d'intérêt" maxlength="40" size="0">
                                            <button type="submit" id="submit_hobbies"><i class="far fa-check-circle"></i></button>
                                        </div>
                                    </form>
                                    <div id="message_hobbies"></div>
                                </div>
                                <div class="modify_input">
                                    <form id="user_bio" method="post" action="">
                                        <label>▪ ajouter ou modifier la bio</label>
                                        <div class="container_input">
                                            <input type="hidden" name="id_user" class="id_user" value="<?= $id_user ?>">
                                            <input type="textarea" id="modify_bio"name="modify_bio" placeholder="bio" rows="5" cols="33">
                                            <button type="submit" id="submit_bio"><i class="far fa-check-circle"></i></button>
                                        </div>
                                    </form>
                                    <div id="message_bio"></div>
                                </div>
                            </div>
                        
                            <a href="#" rel="modal:close">Close</a>
                        </div>
                    </span>
                    <img class="underline_wave" src="img/wave.png" alt="underline_wave">
           

                    <div id="user_details1">
                        <div class="personal_details">
                            <?php if(!empty($user_details['birthday'] )){ $birth = $user_details['birthday']?>
                            <div class="user_details1"><i class="fas fa-birthday-cake" id="user_birth">&nbsp;<?= (new DateTime($birth))->format('d-m-Y')?></i></div>
                            <?php } ?>

                            <?php if(!empty($user_details['localite'] )){ ?>
                            <div class="user_details1"><i class="fas fa-map-marker-alt" id="user_city">&nbsp;<?= $user_details['localite']?></i></div>
                            <?php } ?>

                            <?php if(!empty($user_details['entreprise'] )){ ?>
                            <div class="user_details1"><i class="far fa-building" id="user_cie">&nbsp<?= $user_details['entreprise'] ?></i></div>
                            <?php } ?>
                        </div>
                 
                        <div class="personal_details">
                            <?php if(!empty($user_details['cursus'] )){ ?>
                            <div class="user_details1"><i class="fas fa-info-circle" id="user_role">&nbsp<?= $user_details['name_cursus']?></i></div>
                            <?php } ?>

                            <?php if(!empty($user_details['website'] )){ ?>
                            <div class="user_details1"><i class="fas fa-globe-americas" id="user_website">&nbsp<?= $user_details['website'] ?></i></div>
                            <?php } ?>
                        </div>

                        <div class="personal_details">
                            <?php if(!empty($user_details['hobbies'] )){ ?>
                            <div class="user_details1"><i class="far fa-heart" id="user_loisirs">&nbsp<?= $user_details['hobbies']?>&nbsp</i></div>
                            <?php } ?>
                        </div>
                       
                        <?php if(!empty($user_details['bio'] )){ ?>
                            <strong>À PROPOS DE MOI</strong>
                            <div class="personal_details">
                                <div id="user_details_bio"> &nbsp<?= $user_details['bio']?></div>
                            </div>
                        <?php } ?>
                    </div>
                
                    <?php if(!empty($tech_name)){ ?>
                    <aside class="infos_user_skills">
                        <span data-text="vos skills"> SKILLS </span>
                        <img class="underline_wave" src="img/wave.png" alt="underline_wave">
                        <div class="category_details">
                        <?php
                        if(!empty($tech_name)){ 
                        foreach ($tech_name as $technologies){ //var_dump($technologies);
                        ?>
                            <span id="technologies"><i class="fas fa-check"></i>&nbsp<?= $technologies['nom']?></span>
                        <?php }; }; ?>
                        </div>
                    </aside>
                    <?php }; ?>
                </article>

               
                <article class="infos_user_profile">
                    <span data-text="vos informations">VOS RELATIONS</span>
                    <img class="underline_wave" src="img/wave.png" alt="underline_wave">
                    <?php if(!empty($user_followers)){ ?>
                    <div id="user_followers">
                        <?php 
                        foreach ($user_followers as $followers){ ?>
                        <div class="followers">
                            <a href="profile_public.php?id=<?= $followers['id'] ?>"><img class="followers_img" src="php/<?=$followers['photo']?>" alt="follower_mini_pic"></a>
                            <a href="profile_public.php?id=<?= $followers['id'] ?>"><?=$followers['firstname']?>&nbsp<?=$followers['lastname']?></a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php } else {?>
                    <span> vous n'avez pas encore de relations ! </span>
                    <?php } ?>
                </article>
            </div>
            <div class="col-8">
                <div class="profile_category">
                    <button class="link_content" onclick="show('operation1')">Publications</button>
                    <button class="link_content" onclick="show('operation2')">Relations &nbsp<span id="count_followers"><?= $count_followers[0]?></span></button>
                    <button class="link_content" id="contentParameters" >Paramètres personnels</button>           
                </div>
                <div id="operation1">
                    <div class="profile_title">
                        <img class="underline_wave" src="img/wave.png" alt="underline_wave">
                        <h2>vos publications...</h2>
                    </div>
                    <?php if(!empty($post_users)) : ?>
                    <div id="profile_post">
                    <?php foreach($post_users as $post){ 
                        $date_post =  $post['created_at'];
                        $id_post = $post['id'];
                    ?>
                        <div id="user_post">
                            <div>
                                <img class="pic_post" src="php/<?= $user_details['photo']?>" alt="input-pic">
                                <?php
                                $date_origin = new DateTime($date_post);
                                $date_target = new DateTime();
                                $interval = $date_origin->diff($date_target);
                                ?>
                                <span class="days">
                                    <?= $interval->format('%a j'); ?> • 
                                    <i class="fas fa-globe-americas"></i>
                                <span>
                            </div>
                            <div class="post_content">"<?= $post['content'] ?>"</div>
                                <div class="post_media">
                                <?php if(!empty($post['media'])){ ?>
                                    <?= $post['media'] ?>
                                <?php } ?>
                            </div>
                            <div class="post_reactions">
                                <?php 
                                $likes = $user->count_like($id_post); 
                                $com = $user->count_comments($id_post); 
                                ?>    
                                <span>
                                    <?php if($likes[0] > 0){ ?>
                                        <?= $likes[0];?> 
                                    <?php } ?>
                                    <i class="far fa-thumbs-up"></i>
                                <span>
                                <span>
                                    <?php if($com[0] > 0){ ?>
                                        <?= $com[0];?> 
                                    <?php } ?>
                                    <i class="far fa-comment-dots"></i>
                                <span>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                    <?php else: ?>
                        <a href="fil_actu.php"> Participez, plateformez dès maintenant sur le wall</a>
                    <?php endif; ?>
                </div>

                <div id="operation2">
                    <div class="profile_title">
                        <img class="underline_wave" src="img/wave.png" alt="underline_wave">
                        <h2>vos relations...</h2>
                    </div>
                    <?php if(!empty ($user_followers )) : ?>
                    <div id="container_followers">
                        <?php foreach ($user_followers as $followers){ ?>
                        <div class="followers">
                            <a href="profile_public.php?id=<?= $followers['id'] ?>" target="_blank">
                                <img class="followers_img_section" src="php/<?=$followers['photo'] ?>" alt="follower_mini_pic">
                            </a>
                            <span><?=$followers['firstname']?> <?=$followers['lastname']?></span>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php else : ?>
                    <span>Vous n'avez pas encore de relations !</span>
                    <?php endif; ?>
                    <!-- <section id="remove-row"> -->
                        <!-- <button id="load_more" data-id="<?= $id;?>" data-id_page="<?= $id_page;?>">LOAD MORE</button> -->
                    <!-- </section> -->
                </div>
                <div class="profile_content">
                    <div id="profile_publications">
                        <div class="profile_title">
                            <img class="underline_wave" src="img/wave.png" alt="underline_wave">
                            <h2>vos publications...</h2>
                        </div>
                        <?php if(!empty($post_users)): ?>
                        <div id="profile_post">
                            <?php foreach($post_users as $post){ //var_dump($post);
                            $date_post = $post['created_at'];
                            $id_post = $post['id'];
                            ?>
                            <div id="user_post">
                                <div>
                                    <img class="pic_post" src="php/<?= $user_details['photo']?>" alt="input-pic">
                                    <!--<span class="date_post">le : <?= (new DateTime($date_post))->format('d-m-Y')?></span>-->
                                    <?php
                                        $date_origin = new DateTime($date_post);
                                        $date_target = new DateTime();
                                        $interval = $date_origin->diff($date_target);
                                    ?>
                                    <span class="days">
                                        <?= $interval->format('%a j'); ?> 
                                         • 
                                        <i class="fas fa-globe-americas"></i>
                                    <span>
                                </div>
                                <div class="post_content">"<?= $post['content'] ?>"</div>
                                <div class="post_media">
                                <?php if(!empty($post['media'])){ ?>
                                    <?= $post['media'] ?>
                                <?php } ?>
                                </div>
                                <div class="post_reactions">
                                    <?php 
                                    $likes = $user->count_like($id_post); 
                                    $com = $user->count_comments($id_post); 
                                    ?>
                                        
                                    <span>
                                        <?php if($likes[0] > 0) : ?>
                                            <?= $likes[0];?> 
                                        <?php endif; ?>
                                        <i class="far fa-thumbs-up"></i>
                                    <span>

                                    <span>
                                        <?php if($com[0] > 0){ ?>
                                            <?= $com[0];?> 
                                        <?php } ?>
                                        <i class="far fa-comment-dots"></i>
                                    <span>
   
                                </div>
                                
                                </div>
        
                           <?php } ?>
                            <?php else:?>
                                <a href="fil_actu.php"> Participez, plateformez dès maintenant sur le wall !</a>
                            <?php endif; ?>
                     

                    <?php }else{?>
                        <span class="info_connected"> vous devez être connecté pour accéder à cette page !</span>
                    <?php } ?>
</main>
<footer>
    <?php
    include("includes/footer.php") ?>
</footer>
<script>
  function show(param_div_id) {
    document.getElementById('profile_publications').innerHTML = document.getElementById(param_div_id).innerHTML;
  }
</script>
<script src="js/profile_informations.js"></script>     
</body>
</html>