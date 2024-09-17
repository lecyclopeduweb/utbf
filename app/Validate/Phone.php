<?php

declare (strict_types = 1);

namespace AppUtbf\Validate;

use AppUtbf\Validate\Utilities;
/**
 * Phone
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Phone
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

        if($utilities->empty_field($field)):
            $response = __('The field is empty',UTBF_TEXT_DOMAIN);
        elseif(!$utilities->check_only_numeric($field)):
            $response = __('The phone must be composed of numbers only',UTBF_TEXT_DOMAIN);
        elseif(!$utilities->check_size_egal($field,10)):
            $response = __('The phone number must be 10 digits long',UTBF_TEXT_DOMAIN);
        endif;

        return $response;

    }



}
