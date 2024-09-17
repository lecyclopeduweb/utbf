<?php

declare (strict_types = 1);

namespace AppUtbf\Validate;

use AppUtbf\Validate\Utilities;
/**
 * Username
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Username
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
     * @param string $username    username
     *
     * @return bool|string
     */
    public function error(string $username)
    {

        $utilities = new Utilities;

        $response = false;

        if($utilities->check_database_username($username)):
            $response = __('The login is already registered',UTBF_TEXT_DOMAIN);
        endif;

        return $response;

    }

}
