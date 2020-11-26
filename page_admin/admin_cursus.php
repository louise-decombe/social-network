
<div class="div_entete">
    <img class="logo_admin" src="images/logo_cursus.png" alt="">
    <h2>Nos cursus</h2>
</div>
<span id="message_admin" class="d-block m-auto w-50"></span>
<table class="table table_admin table_cursus">

    <thead>
        <tr>
            <td>Nom</td>
            <td>Modifier</td>
            <td>Supprimer</td>
        </tr>
    </thead>
    <tbody id="tbody">

    </tbody>
</table>

<section class="section_form_cursus">
    <span id="message_admin"></span>
    <form id='form_ajout_cursus' action="php/traitement_cursus_admin.php" method="POST">
        <div class="form-group">
            <label for="nom_cursus">Nom de la formation</label>
            <input class="form-control" type="text" id="nom_cursus" name="nom_cursus">
        </div>
        <input id="btn_submit" class="btn btn-info" type="submit" name="submit_cursus">

    </form>
</section>