<?php $page_selected = 'profile'; 
session_start();
require 'class/Db.php';
require 'class/User.php';
require 'class/Options.php';
$db = new DB();
$user = new User($db);
$options = new Options($db);
$cursus = $options->cursus_list();
$date = new DateTime();
$id_user = $_SESSION['user']['id'];
$id_user_follow = $_GET['id'];
//var_dump($id_user);
$user_details = $user->test($id_user_follow);
//var_dump($user_details);
$user_followers = $user->followers($id_user_follow);
$already_follower = $user->already_follow($id_user_follow, $id_user);
//var_dump($already_follower);
//var_dump($user_followers);
$count_follow = $user->count_follow($id_user_follow);
$count_followers = $user->count_followers($id_user_follow);
//var_dump($count_followers);
$post_users = $user->post_users($id_user_follow);
//var_dump($post_users);
$last_post = $user->last_post($id_user_follow);
$tech_name = $options->techno($id_user);
$is_follow = $user->is_follow($id_user_follow);
$you_follow = $user->you_follow($id_user_follow);
?>
<!DOCTYPE html>
<html>
<head>
    <title>social_network - profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="#">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style-profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="js/profile_transitions.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="js/profile_informations.js"></script>
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

    <?php if(!empty($_SESSION['user'])) : ?>

        <section id="cover-pic">
            <img class="cover-pic" id="cover" src="php/<?= $user_details['cover']?>" alt="cover-picture">
            <div id="profile_name">@
                <span id="profile_firstname"><?= $user_details['firstname'] ?></span> 
                <span id="profile_lastname"><?= $user_details['lastname'] ?></span>
            </div>
        </section>

        <input type="hidden" id="id_user" name="id_user" value="<?= $id_user ?>">
        <input type="hidden" id="id_user_follow" name="id_user_follow" value="<?= $id_user_follow ?>">

        <?php if(!empty ($already_follower)) : ?>
        <div id="follow_container">
            <button type="submit" id="button_unfollow" class="button_follow">Unfollow</button>
        </div>

        <?php else : ?>
        <div id="follow_container">
            <button id="button_follow" type="submit" class="button_follow"><img src="images/icon_follow.png" alt="icon_follow" width=30>Follow</button>
            <span>si vous connaissez @ <?= $user_details['firstname'] ?> <?= $user_details['lastname'] ?> ?</span>
        </div>
        <?php endif; ?>

        <div class="row container_pic_profile">
            <div class="small-12 medium-2 large-2 columns">
                <div class="circle">
                    <!-- User Profile Image -->
                    <img class="profile-pic" src="php/<?= $user_details['photo']?>" alt="profile-mini-pic" width="112.5">
                </div>
            </div>
        </div>

        <div class="container-fluid sh-100 d-flex flex-column justify-content-center index_content">
            <div class="row">
                <div class="col-12 col-md-4">
                    <article class="infos_user_profile">
                        <span data-text="vos informations">INFORMATIONS</span>
                        <img class="underline_wave" src="img/wave.png" alt="underline_wave">

                        <div id="user_details1">
                            <div class="personal_details">
                                <?php if(!empty($user_details['birthday'] )){ $birth = $user_details['birthday']?>
                                <div class="user_details1"><i class="fas fa-birthday-cake" id="user_birth"></i>&nbsp;<?= (new DateTime($birth))->format('d-m-Y')?></div>
                                <?php } ?>

                                <?php if(!empty($user_details['localite'] )){ ?>
                                <div class="user_details1"><i class="fas fa-map-marker-alt" id="user_city"></i>&nbsp;<?= $user_details['localite']?></div>
                                <?php } ?>

                                <?php if(!empty($user_details['entreprise'] )){ ?>
                                <div class="user_details1"><i class="far fa-building" id="user_cie"></i>&nbsp<?= $user_details['entreprise'] ?></div>
                                <?php } ?>
                            </div>
                 
                            <div class="personal_details">
                                <?php if(!empty($user_details['cursus'] )){ ?>
                                <div class="user_details1"><i class="fas fa-info-circle"></i>&nbsp<?= $user_details['name_cursus']?></div>
                                <?php } ?>

                                <?php if(!empty($user_details['website'] )){ ?>
                                <div class="user_details1"><i class="fas fa-globe-americas"></i>&nbsp<?= $user_details['website'] ?></div>
                                <?php } ?>
                            </div>

                            <div class="personal_details">
                                <?php if(!empty($user_details['hobbies'] )){ ?>
                                <div class="user_details1"><i class="far fa-heart" id="user_loisirs"></i>&nbsp<?= $user_details['hobbies']?>&nbsp</div>
                                <?php } ?>
                            </div>
                       
                            <div class="personal_details">
                                <?php if(!empty($user_details['bio'] )){ ?>
                                <div id="user_details_bio"><strong>À PROPOS DE MOI</strong> &nbsp<?= $user_details['bio']?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if(!empty($tech_name)):?>
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
                        <?php endif; ?>
                    </article>

                    <article class="infos_user_profile">
                        <span id="relations_link" data-text="vos informations" onclick="show('operation2')">RELATIONS</span>
                        <img class="underline_wave" src="img/wave.png" alt="underline_wave">
                        <?php if(!empty($user_followers)) : ?>
                        <div id="user_followers">
                            <?php foreach ($user_followers as $followers){ ?>
                                <div class="followers">
                                    <a href="profile_public.php?id=<?= $followers['id'] ?>"><img class="followers_img" src="php/<?=$followers['photo']?>" alt="follower_mini_pic"></a>
                                    <a href="profile_public.php?id=<?= $followers['id'] ?>"><?=$followers['firstname']?>&nbsp<?=$followers['lastname']?></a>
                                </div>
                            <?php } ?>
                        </div>
                        <?php else :?>
                            <span> vous n'avez pas encore de relations ! </span>
                        <?php endif; ?>
                    </article>
                </div>

                <div class="col-12 col-md-8">
                    <div class="profile_category">
                        <button class="link_content" onclick="show('operation1')">Publications</button>
                        <button class="link_content" onclick="show('operation2')">Followers &nbsp;<span id="count_followers"><?= $count_followers[0]?></span></button>
                        <button class="link_content" onclick="show('operation3')">Suivis &nbsp;<span id="count_followers"><?= $count_follow[0]?></span></button>
                    </div>
                
                    <div id="operation1">
                        <div id="profile_title">
                            <img class="underline_wave" src="img/wave.png" alt="underline_wave">
                            <h2> publications...</h2>
                        </div>
                        <?php if(!empty ($already_follower)){
                                if(empty($post_user)){ ?>
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
                                        </span>
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
                                        </span>
                                        <span>
                                            <?php if($com[0] > 0){ ?>
                                                <?= $com[0];?> 
                                            <?php } ?>
                                            <i class="far fa-comment-dots"></i>
                                        </span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <?php } else { ?>
                        <span>@ <?= $user_details['firstname'] ?> <?= $user_details['lastname'] ?> n'a pas encore publié de post ! </span>
                        <?php } }else{ ?>
                        <span> vous devez FOLLOW @ <?= $user_details['firstname'] ?> <?= $user_details['lastname'] ?> pour accèder à ses posts</span>
                        <?php } ?>
                    </div>

                    <div id="operation2">
                        <div id="profile_title">
                            <img class="underline_wave" src="img/wave.png" alt="underline_wave">
                            <h2>FOLLOWERS</h2>
                        </div>
                        <?php if(!empty($is_follow)) : ?>
                        <div id="container-followers">
                            <?php foreach ($is_follow as $is_follows){ ?>
                                <div class="followers">
                                    <a href="profile_public.php?id=<?= $is_follows['id'] ?>"><img class="followers_img_section" src="php/<?=$is_follows['photo'] ?>" alt="follower_mini_pic"></a>
                                    <span><?=$is_follows['firstname']?><?=$is_follows['lastname']?></span>
                                </div>
                            <?php }?>
                        </div>
                        <?php else :?>
                        <span> @ <?= $user_details['firstname'] ?> <?= $user_details['lastname'] ?> n'a pas encore de Followers </span>
                        <?php endif; ?>
                    </div>

                    <div id="operation3">
                        <div id="profile_title">
                            <img class="underline_wave" src="img/wave.png" alt="underline_wave">
                            <h2>SUIVIS...</h2>
                        </div>
                        <?php if(!empty($you_follow)) : ?>
                        <div id="container-followers">
                            <?php foreach ($you_follow as $you_follows){ ?>
                                <div class="followers">
                                    <a href="profile_public.php?id=<?= $you_follows['id'] ?>"><img class="followers_img_section" src="php/<?=$you_follows['photo'] ?>" alt="follower_mini_pic"></a>
                                    <span><?=$you_follows['firstname']?><?=$you_follows['lastname']?></span>
                                </div>
                            <?php }?>
                        </div>
                        <?php else: ?>
                            <span> @ <?= $user_details['firstname'] ?> <?= $user_details['lastname'] ?> ne Follow personne pour l'instant</span>
                        <?php endif; ?>
                    </div>

                    <div class="profile_content">
                        <div id="profile_publications">
                            <div id="profile_title">
                                <img class="underline_wave" src="img/wave.png" alt="underline_wave">
                                <h2>publications...</h2>
                            </div>
                            <?php if(!empty ($already_follower)) : ?>
                            <?php if(!empty($post_users)){ ?>
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
                                        <span class="days"><?= $interval->format('%a j'); ?> • 
                                            <i class="fas fa-globe-americas"></i>
                                        </span>
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
                                    </span>
                                    <span>
                                        <?php if($com[0] > 0){ ?>
                                            <?= $com[0];?> 
                                        <?php } ?>
                                        <i class="far fa-comment-dots"></i>
                                    </span>
                                </div>
                            </div>
                            <?php }  } ?>
                        <?php else : ?>
                        <span>Vous devez suivre @ <?= $user_details['firstname'] ?> <?= $user_details['lastname'] ?> pour accèder à ses publications</span>
                        <?php endif; ?>
                    </div>
    <?php else :?>
        <span class="info_connected"> vous devez être connecté pour accéder à cette page !</span>
    <?php endif; ?>
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
</body>
</html>