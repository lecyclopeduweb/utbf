<?php

declare (strict_types = 1);

namespace AppUtbf\Validate;

use AppUtbf\Validate\Utilities;
/**
 * ZipCode
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class ZipCode
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
            $response = __('The postal code must consist of numbers only',UTBF_TEXT_DOMAIN);
        elseif(!$utilities->check_size_egal($field,5)):
            $response = __('The postal code must contain 5 digits',UTBF_TEXT_DOMAIN);
        endif;

        return $response;

    }

}
