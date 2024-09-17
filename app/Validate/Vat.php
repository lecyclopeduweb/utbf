<?php

declare (strict_types = 1);

namespace AppUtbf\Validate;

use AppUtbf\Validate\Utilities;
/**
 * Vat
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Vat
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
     * @param string $field
     *
     * @return bool|string
     */
    public function error(string $field)
    {

        $utilities = new Utilities;

        $response = false;

        if(!$utilities->check_only_numeric($field)):
            $response = __('The VAT number must consist of numbers only',UTBF_TEXT_DOMAIN);
        elseif(!$utilities->check_size_egal($field,11)):
            $response = __('The VAT number must contain 11 digits',UTBF_TEXT_DOMAIN);
        endif;

        return $response;

    }

}
