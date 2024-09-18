<?php

declare (strict_types = 1);

namespace AppUtbf\Admin;

/**
 * Users
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Users
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_action('show_user_profile',[$this,'add_billing_phone_2']);
        add_action('edit_user_profile',[$this,'add_billing_phone_2']);

        add_action('show_user_profile',[$this,'add_shipping_phone_2']);
        add_action('edit_user_profile',[$this,'add_shipping_phone_2']);

        add_action('personal_options_update', [$this,'save_custom_fields']);
        add_action('edit_user_profile_update', [$this,'save_custom_fields']);

    }

    /**
     * Add Billing Phone 2
     *
     * @param object $user    user
     *
     * @return void
     */
    public function add_billing_phone_2($user):void
    {

        ob_start();

            load_template( UTBF_THEME_PATH . '/template-parts/admin/users/billing-phone-2.php',null,[
                'user'=>$user
            ]);
            $template_part = ob_get_contents();

        ob_end_clean();
        echo $template_part;

    }

    /**
     * Add Shipping Phone 2
     *
     * @param object $user    user
     *
     * @return void
     */
    public function add_shipping_phone_2($user):void
    {

        ob_start();

            load_template( UTBF_THEME_PATH . '/template-parts/admin/users/shipping-phone-2.php',null,[
                'user'=>$user
            ]);
            $template_part = ob_get_contents();

        ob_end_clean();
        echo $template_part;

    }

    /**
     * Save Custom Fields
     *
     * @param int $user_id    user_id
     *
     * @return void|bool
     */
    public function save_custom_fields($user_id)
    {

        if (!current_user_can('edit_user', $user_id)):
            return false;
        endif;
        update_user_meta($user_id, 'billing_phone_2', $_POST['billing_phone_2']);
        update_user_meta($user_id, 'shipping_phone_2', $_POST['shipping_phone_2']);

    }

}
