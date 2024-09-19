<?php

declare (strict_types = 1);

namespace AppUtbf\Validate;

use AppUtbf\Validate\Date;
use AppUtbf\Validate\Email;
use AppUtbf\Validate\Phone;
use AppUtbf\Validate\ZipCode;
use AppUtbf\Validate\Password;
use AppUtbf\Validate\Username;
use AppUtbf\Validate\Utilities;
/**
 * Register
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class ValidateRegister
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
        $password = new Password;
        $username = new Username;
        $utilities = new Utilities;

        $response = [];

        foreach($fields as $key => $field):
            if(
                ($key=='phone_2' && empty($field))||
                ($key=='user__legal_guardian__phone_2' && empty($field))||
                ($key=='user__child__specific_aspects' && empty($field))||
                ($key=='user__child__recommendations' && empty($field))
            ):
                continue;
            elseif($utilities->empty_field($field) ):
                $response[$key] = __('The field is empty',UTBF_TEXT_DOMAIN);
            elseif(
                ($key=='zip_code' && $zipcode->error($field))||
                ($key=='user__legal_guardian__zip_code' && $zipcode->error($field))
            ):
                $response[$key] = $zipcode->error($field);
            elseif(
                ($key=='phone' && $phone->error($field)) ||
                ($key=='phone_2' && $phone->error($field))||
                ($key=='user__legal_guardian__phone' && $phone->error($field))||
                ($key=='user__legal_guardian__phone_2' && $phone->error($field))||
                ($key=='user__child__phone_emergency' && $phone->error($field))
            ):
                $response[$key] = $phone->error($field);
            elseif(
                ($key=='user_email' && $email->register($field))||
                ($key=='user__legal_guardian__email' && $email->register($field))
            ):
                $response[$key] = $email->register($field);
            /* elseif($key=='password' && $password->error_pass($field)):
                $response[$key] = $password->error_pass($field); */
            elseif($key=='user_login' && $username->error($field)):
                $response[$key] = $username->error($field);
            elseif($key=='user__child__birthday' && $date->en($field)):
                $response[$key] = $date->en($field);
            endif;
        endforeach;

        return $response;

    }


}
