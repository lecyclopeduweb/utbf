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

        //add_action('show_user_profile',[$this,'add_user_profile_custom_tabs']);
        add_action('edit_user_profile',[$this,'add_user_profile_custom_tabs']);
        add_action('edit_user_profile',[$this,'add_user_profile_woo_order']);

    }

    /**
     * Add Custom Tabs
     *
     * @param array $user    user
     *
     * @return void
     */
    public function add_user_profile_custom_tabs($user):void
    {

        if($user->roles[0] != 'administrator'):
            ob_start();

                load_template( UTBF_THEME_PATH . '/template-parts/admin/users/custom-tabs.php',null,[]);
                $template_part = ob_get_contents();

            ob_end_clean();
            echo $template_part;
        endif;

    }

    /**
     * Add Woo Order
     *
     * @param array $user    user
     *
     * @return void
     */
    public function add_user_profile_woo_order($user):void
    {

        $paged      = (isset($_GET['p']))? (int)$_GET['p']: 1;
        $ppp        = (isset($_GET['ppp']))? (int)$_GET['ppp']: UTBF_PPP_USERS_ORDERS;
        $offset     = ($paged - 1) * $ppp;

        $args_count = [
            'customer_id' => $user->ID,
            'status'      => array('wc-completed', 'wc-processing'),
            'limit'       => -1
        ];

        $count = count(wc_get_orders($args_count));

        $args = [
            'customer_id' => $user->ID,
            'status'      => array('wc-completed', 'wc-processing'),
            'limit'       => $ppp,
            'offset'      => $offset
        ];

        $orders = wc_get_orders($args);

        if($user->roles[0] != 'administrator'):
            ob_start();

                load_template( UTBF_THEME_PATH . '/template-parts/admin/users/orders-archive.php',null,[
                    'orders'        => $orders,
                    'paged'         => $paged,
                    'count'         => $count,
                    ///
                    'ppp_init'      => UTBF_PPP_USERS_ORDERS,
                    'ppp_get'       => $ppp,
                    'ppp_array'     => UTBF_PPP_ARRAY_USERS_ORDERS,
                    'slug_ppp'      => 'ppp',
                    'slug_paged'    => 'p',
                    'base_url'      => site_url().'/wp-admin/user-edit.php?user_id='.$user->ID.'&tab=orders',
                    'keep_param'    => ['user_id','tab'],
                ]);
                $template_part = ob_get_contents();

            ob_end_clean();
            echo $template_part;
        endif;

    }

}
