<?php

declare (strict_types = 1);

namespace AppUtbf\Validate;

/**
 * Utilities
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Utilities
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
     * Check Empty Field
     *
     * @param string $field    ield
     *
     * @return bool
     */
    public function empty_field(string $field):bool
    {
        return($field=='') ? true : false;
    }

    /**
     *  Check Pass exist In database
     *
     * @param string $userPass    userPass
     * @param string $userId      userId
     *
     * @return bool
     */
    public function check_database_pass(string $userPass,string $userId):bool
    {
        $userdata = get_user_by( 'login', $userId );
        return(wp_check_password( $userPass, $userdata->data->user_pass, $userId )) ?  true : false;
    }

    /**
     *  Check Pass exist In database
     *
     * @param string $userPass    userPass
     * @param string $userId      userId
     *
     * @return bool
     */
    public function check_database_pass_email(string $userPass,string $userId):bool
    {
        $userdata = get_user_by( 'email', $userId );
        return(wp_check_password( $userPass, $userdata->data->user_pass, $userId )) ?  true : false;
    }

    /**
     * Check User Id exist In database
     *
     * @param string $username      username
     *
     * @return bool
     */
    public function check_database_username(string $username):bool
    {
        $exist = false;
        $all_users = get_users();
        foreach ($all_users as $user):
            if (esc_html($user->user_login)==$username):
                $exist = true;
            endif;
        endforeach;
        return $exist;
    }

    /**
     *  Check Mail
     *
     * @param string $userMail      userMail
     *
     * @return bool
     */
    public function check_mail(string $userMail):bool
    {
        return (!filter_var($userMail, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    /**
     *  Check Date Format (FR)
     *  For French date format (dd/mm/yyyy)
     *
     * @param string $date      date
     *
     * @return bool
     */
    public function check_date_format_fr(string $date): bool
    {

        $pattern = "/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/";
        return (preg_match($pattern, $date)) ? false : true;

    }

    /**
     *  Check Date Format (EN)
     *  For French date format (yyyy-mm-dd)
     *
     * @param string $date      date
     *
     * @return bool
     */
    public function check_date_format_en(string $date): bool
    {

        $pattern = "/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
        if (preg_match($pattern, $date)):
            list($year, $month, $day) = explode('-', $date);
            if (checkdate((int)$month, (int)$day, (int)$year)) :
                return false;
            endif;
        endif;

        return true;

    }

    /**
     *  Check mail exist In database
     *
     * @param string $userMail      userMail
     *
     * @return bool|int
     */
    public function check_database_mail(string $userMail)
    {

        $response = false;
        $all_users = get_users();
        foreach ($all_users as $user):
            if(esc_html($user->user_email)==$userMail):
                $response = $user->ID;
            endif;
        endforeach;

        return $response;
    }

    /**
     *  Check size UP
     *
     * @param string $field      field
     * @param int    $size       size
     *
     * @return bool
     */
    public function check_size_up(string $field,int $size):bool
    {
        return (strlen($field)<$size)? false: true;
    }

    /**
     *  Check size DOWN
     *
     * @param string $field      field
     * @param int    $size       size
     *
     * @return bool
     */
    public function check_size_down(string $field,int $size):bool
    {
        return (strlen($field)>$size)? false: true;
    }

    /**
     * Check size EGAL
     *
     * @param string $field      field
     * @param int    $size       size
     *
     * @return bool
     */
    public function check_size_egal(string $field,int $size):bool
    {
        return (strlen($field)==$size)? true: false;
    }

    /**
     * Check string has number
     *
     * @param string $field      field
     *
     * @return bool
     */
    public function check_has_number(string $field):bool
    {
        return (preg_match("#[0-9]+#", $field))? true: false;
    }

    /**
     *  Check string has letter
     *
     * @param string $field      field
     *
     * @return bool
     */
    public function check_has_letter(string $field):bool
    {
        return (preg_match("#[a-zA-Z]+#", $field))? true: false;
    }

    /**
     * Check string has uppercase
     *
     * @param string $field      field
     *
     * @return bool
     */
    public function check_has_uppercase(string $field):bool
    {
        return (preg_match("#[A-Z]+#", $field))? true: false;
    }

    /**
     * Check string has lowercase
     *
     * @param string $field      field
     *
     * @return bool
     */
    public function check_has_lowercase(string $field):bool
    {
        return (preg_match("#[a-z]+#", $field)) ? true : false;
    }

    /**
     *  Check string has special character
     *
     * @param string $field      field
     *
     * @return bool
     */
    public function check_has_special_character(string $field):bool
    {
        return (preg_match("#\W+#", $field))? true: false;
    }

    /**
     *  Check string numeric
     *
     * @param string $field      field
     *
     * @return bool
     */
    public function check_only_numeric(string $field):bool
    {
        return (preg_match("/^[0-9]{1,16}$/", $field))? true: false;
    }



}
