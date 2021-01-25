    <div class="profile_title">
        <img class="underline_wave" src="img/wave.png" alt="underline_wave">
        <h2>vos paramètres personnels...</h2>
    </div>
    <form id="form_firstname" method="post" action="">
        <label> ▪ Modifier le prénom</label>
        <input type="hidden" name="id_user" class="id_user" value="<?= $_POST['id_user']?>">
        <input type="text" id="modify_firstname" name="modify_firstname" placeholder="prénom">
        <button type="submit" id="submit_firstname"><i class="far fa-check-circle"></i></button>
    </form>
    <div id="message_firstname"></div>

    <form id="form_lastname" method="post" action="">
        <label> ▪ Modifier le nom</label>
        <input type="hidden" name="id_user" class="id_user" value="<?= $_POST['id_user'] ?>">
        <input type="text" id="modify_lastname" name="modify_lastname" placeholder="nom">
        <button type="submit" id="submit_lastname"><i class="far fa-check-circle"></i></button>
    </form>
    <div id="message_lastname"></div>


    <form id="form_password" method="post" action="">
        <label> ▪ Modifier votre password</label>
        <input type="hidden" name="id_user" class="id_user" value="<?= $_POST['id_user']?>">
        <input type="password" id="modify_password" name="modify_password" placeholder="nouveau password">
        <input type="password" id="modify_confirmation_password" name="modify_confirmation_password" placeholder="confirmer le nouveau password">
        <button type="submit" id="submit_password"><i class="far fa-check-circle"></i></button>
    </form>
    <div id="message_password"></div>

<script type="text/javascript" src="js/profile_personal_parameters.js"></script>
