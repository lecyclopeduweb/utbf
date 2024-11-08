<?php

declare (strict_types = 1);

namespace AppUtbf\Validate;

/**
 * Recaptcha
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Recaptcha
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * verify
     *
     * @return bool|string
     */
    public function verify()
    {

        $response = $_POST['recaptcha_response'];
        $remote_ip = $_SERVER['REMOTE_ADDR'];
        $secret_key = UTBF_KEY_GOOGLE_RECAPTCHA;

        $verify_response = wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response&remoteip=$remote_ip");
        $verify_body = wp_remote_retrieve_body($verify_response);
        $verification_result = json_decode($verify_body);

        var_dump($verification_result);

        if ($verification_result->success && $verification_result->score >= 0.5) {
            var_dump('Traitement du formulaire en cas de succès');
        } else {
            var_dump('Message derreur pour lutilisateur');
        }

    }



}
