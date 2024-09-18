<?php

declare (strict_types = 1);

namespace AppUtbf\Validate;

use AppUtbf\Validate\Utilities;
/**
 * Email
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Email
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
     * error
     *
     * @param string $field    field
     *
     * @return bool|string
     */
    public function error(string $field)
    {

        $utilities = new Utilities;

        $response = false;

        if($utilities->check_mail($field)) :
            $response = __("Email is not valid",UTBF_TEXT_DOMAIN);
        endif;

        return $response;

    }

    /**
     * register
     *
     * @param string $field    field
     *
     * @return bool|string
     */
    public function register(string $field)
    {

        $utilities = new Utilities;

        $response = false;

        if($utilities->check_mail($field)) :
            $response = __("Email is not valid",UTBF_TEXT_DOMAIN);
        elseif($utilities->check_database_mail($field)):
            $response = __("The email is already registered",UTBF_TEXT_DOMAIN);
        endif;

        return $response;

    }



}
