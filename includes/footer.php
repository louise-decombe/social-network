
    <section id="media-footer">
        <span id="social-links">
            <a href="https://www.instagram.com/laplateformeio/"><i class="fab fa-instagram"></i></a>
            <a href="https://www.facebook.com/LaPlateformeIO"> <i class="fab fa-facebook-square"></i></a>
            <a href="https://twitter.com/laplateformeio?lang=fr"><i class="fab fa-twitter-square"></i></a>
            <a href="https://www.linkedin.com/company/laplateformeio/"><i class="fab fa-linkedin"></i></a>
        </span>
        <form id="newsletter-form" method="post" action="php/form_newsletter.php">
            <label>Inscrivez-vous à la newsletter</label>
            <div class="input-email">
                <input type="email" name="email_newsletter" id="email_newsletter" required type="email" spellcheck="false" placeholder="Entrez votre email">
                <button type="submit" name="submit_newsletter" id="submit_newsletter"><i class="fa fa-arrow-right"></i></button>
            </div>
            <div id="message-newsletter"></div>
            <small id="emailHelp" class="form-text text-muted">Retrouvez les news de Plateformer_ </small>
        </form>
    </section>
    <section id="infos-footer">
        <article id="infos-content">
            <?php if($_SESSION['user']['droits'] == "administrateur") : ?>
            <a href="admin.php">Espace Administrateur</a></br>
            <?php endif; ?>
            <span> QUI SOMMES-NOUS ?</span>
            <p>Plateformer_ est l'application dédiée à la communauté de la Plateforme_, école innovante
               dans les métiers du digital au coeur de la Cité Phocéenne. La Plateforme_ est membre du 
               programme Grande Ecole du Numérique. Elle est soutenue par de grandes entreprises du territoire
               marseillais, la Région Sud, le Département des Bouches-du-Rhône.
            </p>
            <address>
                Plateformer_, 8 rue d'Hozier 13002 Marseille
                <a href="tel:+33484894369">Tel : (+33) 04.84.89.43.69</a>
                <a href="mailto:contact@laplateforme.io">contact@laplateforme.io</a>
            </address>
        </article>
    </section>
    <section id="logo-footer">
        <a href="index.php">
            <img src="img/PICT_LOGO_WHITE.png" width="100" height="85" class="d-inline-block align-top" alt="white_logo_plateformer_" loading="lazy">
            PLATEFORMER_
        </a>
        <p>© 2020 Plateformer_ Tous droits réservés</p>
    </section>
    <script type="text/javascript" src="js/form_newsletter.js"></script>
