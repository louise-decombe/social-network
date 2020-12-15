<?php 


require '../php/admin2.php';
//require '../class/Cursus.php';

?>
<div class="div_entete">
                <img class="logo_admin" src="images/logo_users.png" alt="">
                <h2>Utilisateurs</h2>
            </div>
            

            <span id="message_admin"></span>
            <section id="search_admin">
                <form action="POST">
                    
                    <select class="form-control" name="selection" id="selection" >
                        <option class="selection" value="">Trier par</option>
                        <option class="selection" value="ordre_alpha">Par ordre alphabetique</option>
                        <option class="selection" value="admins">Administrateurs</option>
                        <option class="selection" value="users">Utilisateurs</option>
                        <!-- recuperation des cursus -->
                        <?php for ($i = 0 ; $i < COUNT($formations) ; $i++) :?>
                            <option class="selection" value="<?= $formations[$i]["name_cursus"] ?>"><?= $formations[$i]["name_cursus"] ?></option>
                        <?php endfor ;?>
                    </select>
                </form>
               
                <form action="POST">
                    <input class="form-control" id="search_users_admin" type="text" placeholder=' Rechercher un utilisateur'>
                </form>
            </section>
            <table class="table table_admin">
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