<?php

declare (strict_types = 1);

namespace AppUtbf\Validate;

use AppUtbf\Validate\Date;
use AppUtbf\Validate\Email;
use AppUtbf\Validate\Phone;
use AppUtbf\Validate\ZipCode;
use AppUtbf\Validate\Utilities;
/**
 * Edit Legal Guardian
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class ValidateEditLegalGuardian
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
     * check
     *
     * @param array $fields    fields
     *
     * @return array
     */
    public function check(array $fields):array
    {

        $date = new Date;
        $email = new Email;
        $phone = new Phone;
        $zipcode = new ZipCode;
        $utilities = new Utilities;

        $response = [];

        foreach($fields as $key => $field):
            if(preg_match('/phone_2/', $key) && empty($field)):
                continue;
            elseif ($utilities->empty_field($field)) :
               $response[$key] = __('The field is empty',UTBF_TEXT_DOMAIN);
            elseif(preg_match('/zip_code/', $key)  && $zipcode->error($field)):
                $response[$key] = $zipcode->error($field);
            elseif(preg_match('/phone/', $key)  && $phone->error($field)):
                $response[$key] = $phone->error($field);
            elseif(preg_match('/email/', $key) && $email->register($field)):
                $response[$key] = $email->register($field);
            endif;
        endforeach;

        return $response;

    }


}
