<?php session_start();

$_SESSION['user']['droits'] = "administrateur";

if ($_SESSION['user']['droits'] != "administrateur"){
    header('location: index.php');
}
$page_selected = 'admin'; 

require 'class/Config.php';


?>
<!DOCTYPE html>
<html>
<head>
    <title>social_network - admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="#">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/fontello/css/fontello.css">
    
    <!-- SCRIPT JAVASCRIPT -->
    <script src="js/fonctions/fonctions_generales.js"></script>
    <script src="js/fonctions/fonctions_users.js"></script>
    <script src="js/fonctions/fonctions_posts.js"></script>
    <script src="js/fonctions/fonctions_groupe.js"></script>
    <script src="js/fonctions/fonctions_langages.js"></script>
    <script src="js/fonctions/fonctions_cursus.js"></script>
    
    <script src="js/admin.js"></script>

    <!-- template -->
    <script src="js/template_js.js"></script>

</head>
<body>
<header class="header_admin">
    <h1>DashBord</h1>
    <div class="icones_menu">
        <p><a id="signalement"class="icon-bell-alt"href='#' title="Signalement"></a> </p>
        <p><a class="icon-home" href="index.php"></a></p>
    </div>
</header>
<main class="admin_main">
    <section class="nav_admin">
        <img class="admin_main_img"src="images/dashbord.png" alt="Logo">
        <nav>
            <button id="utilisateurs" class="btn btn-info admin_main_button">Utilisateurs</button>
            <button id="posts"class="btn btn-info admin_main_button">Les Posts</button>
            <button id="btn_signal" class="btn btn-info admin_main_button">Signalements</button>
            <button id="groupe" class="btn btn-info admin_main_button">Les groupes</button>
            <button id="langages" class="btn btn-info admin_main_button">Les langages</button>
            <button id="cursus" class="btn btn-info admin_main_button">Les Cursus</button>
        </nav>

    </section>
    <section class="section_infos">
        <div id="modale">
            <div id="action_alert" >
                
            </div>
        </div>
        
        <section id="page">
            <div class="div_entete">
                <img class="logo_admin" src="images/logo_users.png" alt="">
                <h2 >Utilisateurs</h2>
            </div>
           
      
        
            <span id="message_admin"></span>
            <section id="search_admin">
                <form action="POST">
                    
                    <select class="form-control" name="selection" id="selection" >
                        <option class="selection" value="">Trier par</option>
                        <option class="selection" value="ordre_alpha">Nom par ordre alphabetique</option>
                        <option class="selection" value="admins">Administrateurs</option>
                        <option class="selection" value="users">Utilisateurs</option>
                        <!-- recuperation des cursus -->
                        <?php for ($i = 0 ; $i < COUNT($formations) ; $i++) :?>
                            <option class="selection" value="<?= $formations[$i]["name_cursus"] ?>"><?= $formations[$i]["name_cursus"] ?></option>
                        <?php endfor ;?>
                    </select>
                </form>
               
                <form action="POST">
                    <input class="form-control" id="search_users_admin" type="text" placeholder=' Rechercher un utilisateur '>
                </form>
            </section>
            <table class="table table_admin table-responsive">
                <thead>
                    <tr>
                        <td>Prénom</td>
                        <td>Nom</td>
                        <td>Statut</td>
                        <td>Cursus</td>
                        <td>Supprimer</td>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>

            <div class="div_infos">
            <div id="pagination" class="pagination text-center"></div>
            <aside>
                <p> <span class="icon-user"></span> : Utilisateurs</p>
                <p> <span class="icon-tools"></span> : Administrateurs</p>
            </aside>
        </div>
            
            
            
        </section>
       
    </section>
</main>
<footer>
    <?php
    include("includes/footer.php") ?>
</footer>




</body>
</html>