<?php

declare (strict_types = 1);

namespace AppUtbf\Validate;

use AppUtbf\Validate\Utilities;
/**
 *Password
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Password
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
     * error pass
     *
     * @param string $pass       pass
     *
     * @return  bool|string
     */
    public function error_pass(string $pass)
    {

        $utilities = new Utilities;

        $response = false;

        $sep = 1;
        if(!$utilities->check_size_up($pass,8)):
            $sep++;
            $response  .= __('have at least 8 characters',UTBF_TEXT_DOMAIN);
        endif;
        if(!$utilities->check_has_number($pass)):
            if($sep>1):  $response  .= ', '; endif;
            $sep++;
            $response  .= __('a number',UTBF_TEXT_DOMAIN);
        endif;
        if(!$utilities->check_has_letter($pass)):
            if($sep>1):  $response  .= ', '; endif;
            $sep++;
            $response  .= __('a letter',UTBF_TEXT_DOMAIN);
        endif;
        if(!$utilities->check_has_uppercase($pass)):
            if($sep>1):  $response  .= ', '; endif;
            $sep++;
            $response  .= __('a capital letter',UTBF_TEXT_DOMAIN);
        endif;
        if(!$utilities->check_has_lowercase($pass)):
            if($sep>1):  $response  .= ', '; endif;
            $sep++;
            $response  .= __('a lowercase letter',UTBF_TEXT_DOMAIN);
        endif;
        if(!$utilities->check_has_special_character($pass)):
            if($sep>1):  $response  .= ', '; endif;
            $sep++;
            $response  .= __('a special character',UTBF_TEXT_DOMAIN);
        endif;
        if(!empty($response)):
            $response  = __('Password must',UTBF_TEXT_DOMAIN).' '.$response ;
        endif;

        return $response;

    }

    /**
     * error pass && confirm
     *
     * @param string $pass       pass
     * @param string $confirm    confirm
     *
     * @return array
     */
    public function error_pass_confirm(string $pass,string $confirm):array
    {

        $utilities = new Utilities;

        $response = [];

        if (!$utilities->empty_field($pass) && !$utilities->empty_field($confirm)) :
            if($pass != $confirm):
                $response['pass']  = __('The fields are different',UTBF_TEXT_DOMAIN);
                $response['confirm'] = __('The fields are different',UTBF_TEXT_DOMAIN);
            else:
                $response_pass = $this->error_pass($pass);
                if($response_pass):
                    $response['pass'] = $this->error_pass($pass);
                endif;
            endif;
        endif;

        return $response;

    }

}
