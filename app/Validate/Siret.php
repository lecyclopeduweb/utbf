<?php

declare (strict_types = 1);

namespace AppUtbf\Validate;

use AppUtbf\Validate\Utilities;
/**
 * Siret
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Siret
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

        if(!$utilities->check_only_numeric($field)):
            $response = __('The Siret number must consist only of numbers',UTBF_TEXT_DOMAIN);
        elseif(!$utilities->check_size_egal($field,14)):
            $response = __('The Siret number must contain 14 digits',UTBF_TEXT_DOMAIN);
        endif;

        return $response;

    }

}
