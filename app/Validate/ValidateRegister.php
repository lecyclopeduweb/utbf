<?php

declare (strict_types = 1);

namespace AppUtbf\Validate;

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

        $email = new Email;
        $phone = new Phone;
        $zipcode = new ZipCode;
        $password = new Password;
        $username = new Username;
        $utilities = new Utilities;

        $response = [];

        foreach($fields as $key => $field):
            if($utilities->empty_field($field)):
                $response[$key] = __('The field is empty',UTBF_TEXT_DOMAIN);
            elseif($key=='zip-code' && $zipcode->error($field)):
                $response[$key] = $zipcode->error($field);
            elseif($key=='phone' && $phone->error($field)):
                $response[$key] = $phone->error($field);
            elseif($key=='user_email' && $email->register($field)):
                $response[$key] = $email->register($field);
           /*  elseif($key=='password' && $password->error_pass($field)):
                $response[$key] = $password->error_pass($field); */
            elseif($key=='username' && $username->error($field)):
                $response[$key] = $username->error($field);
            endif;
        endforeach;

        return $response;

    }


}
