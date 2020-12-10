<?php $page_selected = 'profile'; 
session_start();

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"></script>
</head>
<body>
<header>
    <?php
    include("includes/header.php");
   ?>
</header>
<main id="main-profile">
<?php var_dump($_SESSION);?>

    <!--<div class="ovale_1"></div>-->
    <div class="ovale_2"></div>
    <div class="ovale_3"></div>

    <section id="cover-pic">
        <div><img id="profile-mini-pic" src="<?= $_SESSION['user']['photo']?>" alt="profile-mini-pic"></div>
        <div id="name_profile"><p><?php $_SESSION['user']['firstname']?></p><div>
    </section>
    
    <!--<h1>hello @ <?= $_SESSION['user']['firstname'] ?> <?= $_SESSION['user']['lastname'] ?></h1>-->
    <div class="container-fluid sh-100 d-flex flex-column justify-content-center index_content">
        <div class="row">
            <div class="col-4">
                <article id="infos_user_profile">
                    <span data-text="vos informations">
                        VOS INFORMATIONS &nbsp; 
                        <i class="fas fa-pen-alt"></i>
                    </span>
                </article>
                <article id="relations_user_profile">relations</article>
            </div>
            <div class="col-8">
                <div class="profile_category">
                    <p>publications</p>
                    <p>relations</p>
                    <p>informations</p>
                </div>
            </div>
        </div>
    </div>



</main>
<footer>
    <?php
    include("includes/footer.php") ?>
</footer>
</body>
</html>