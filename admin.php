<?php $page_selected = 'index'; 
session_start();
include('class/Config.php');

?>
<!DOCTYPE html>
<html>
<head>
    <title>social_network - admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="#">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/fontello/css/fontello.css">
</head>
<body>
<header class="header_admin">
    <h1>DashBord</h1>
</header>
<main class="admin_main">
    <section class="nav_admin">
        <img src="images/dashbord.png" alt="Logo">
        <nav>
            <a href="">Utilisateurs</a>
            <a href="">Les Post</a>
            <a href="">Les groupe</a>
            <a href="">Signalements</a>
            <a href="">Statistiques du site</a>
        </nav>

    </section>
    <section class="section_infos">
        <section class="infos_admin">
            <div id="users">
                <h3>Nombre d'inscrits</h3>
                <div class="rond">13</div>
            </div>
            <div id="alert">
                <h3>Nombre de signalement</h3>
                <div class="rond">1</div>
            </div>
            <div id="posts">
                <h3>Nombre de post</h3>
                <div class="rond">300</div>
            </div>
        </section>
        <section id="page">
            <div id="action_alert" >
                
            </div>
            <h2>Utilisateurs</h2>
            <span id="message_admin"></span>
            <section id="search_admin">
                <form action="POST">
                    
                    <select name="selection" id="selection" >
                        <option class="selection" value="">Trier par</option>
                        <option class="selection" value="ordre_alpha">Par ordre alphabetique</option>
                        <option class="selection" value="admins">Administrateurs</option>
                        <option class="selection" value="users">Utilisateurs</option>
                    </select>
                </form>
                <button id="init">Tout voir</button>
                <form action="POST">
                    <input type="search">
                </form>
            </section>
            <table class="table table-active table_admin">
                <thead>
                    <tr>
                        <td>Prénom</td>
                        <td>Nom</td>
                        <td>Statut</td>
                        <td>Supprimer</td>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>
            <div id="pagination"></div>
        </section>
        
    </section>
</main>
<footer>
    <?php
    include("includes/footer.php") ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="js/admin_users.js"></script>
</body>
</html>