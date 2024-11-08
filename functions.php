<?php
include('env.php');
include('autoload.php');

/**
 * App Services Providers
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
use AppUtbf\AppServiceProvider;

$AppServiceProvider = new AppServiceProvider;
$AppServiceProvider->boot();

// Ajoutez ce code dans le fichier functions.php de votre thème enfant ou dans une extension personnalisée
function add_recaptcha_script() {
    ?>
    <!-- Ajout du script Google reCAPTCHA v3 -->
    <script src="https://www.google.com/recaptcha/api.js?render=6Lf2BWQqAAAAABa953yuSEHJ5MrIPshkWVtY29Gp"></script>
    <?php
}
add_action('wp_head', 'add_recaptcha_script');