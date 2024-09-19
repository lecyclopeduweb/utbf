<?php

declare (strict_types = 1);

namespace AppUtbf\Validate;

use AppUtbf\Validate\Utilities;
/**
 * Date
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Date
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
     * FR
     *
     * @param string $date    date
     *
     * @return bool|string
     */
    public function fr(string $date)
    {

        $utilities = new Utilities;

        $response = false;

        if($utilities->check_date_format_fr($date)) :
            $response = __("The date is not valid",UTBF_TEXT_DOMAIN);
        endif;

        return $response;

    }

    /**
     * EN
     *
     * @param string $date    date
     *
     * @return bool|string
     */
    public function en(string $date)
    {

        $utilities = new Utilities;

        $response = false;

        if($utilities->check_date_format_en($date)) :
            $response = __("The date is not valid",UTBF_TEXT_DOMAIN);
        endif;

        return $response;

    }

}
