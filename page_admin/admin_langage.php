
<div class="div_entete">
    <img class="logo_admin" src="images/logo_langage.png" alt="">
    <h2>Langages de programmation</h2>
</div>

<table class="table table_admin">
    <thead>
        <tr>
            <td>Logo</td>
            <td>Nom du langage</td>
            <td>Supprimer</td>
        </tr>
    </thead>
    <tbody id="tbody">
    </tbody>
</table>
<div id="pagination" class="pagination text-center"></div>
<button class="btn page m-auto " id="add_langage">Ajouter un langage</button>
<span id="message_admin"></span>
<form id="formlangage" action="php/traitement_langage.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nom">Nom du langage</label>
        <input class="form-control" type="text" id="nom_langage" name="nom">
    </div>
    <div class="form-group">
        <label for="logo">Logo</label>
        <input class="form-control" type="file" id="logo" name="logo">
    </div>

    <input class="btn btn-info" type="submit" name="valider" id="btn_valider">
    <button class="btn btn-danger" id="boutton_fermer_form">Fermer</button>
</form>