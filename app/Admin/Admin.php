<?php

declare (strict_types = 1);

namespace AppUtbf\Admin;

use AppUtbf\Users\Search;
/**
 * Admin
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Admin
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_filter('admin_body_class',[$this,'add_user_role_body_class']);
        add_action('admin_menu', [$this,'add_menu_users_search']);

    }

    /**
     * Add user role to body Class
     *
     * @param array $classes    classes
     *
     * @return string
     */
    public function add_user_role_body_class($classes):string
    {

        //Global
        $user = wp_get_current_user();
        if ( ! empty( $user->roles ) ) :
            $classes .= ' role-' . esc_attr( $user->roles[0] );
        endif;

        //Menu user-edit.php
        if (isset($_GET['user_id']) && is_admin() && 'user-edit' === get_current_screen()->id):
            $user_id = intval($_GET['user_id']);
            $user = get_userdata($user_id);
            if ($user) :
                $roles = $user->roles;
                foreach ($roles as $role):
                     $classes .= ' profil-user-role-' . sanitize_html_class($role);
                endforeach;
            endif;
        endif;

        return $classes;

    }

    /**
     * Add menu users search
     *
     * @return void
     */
    public function add_menu_users_search():void
    {

        add_users_page(
            __('Search account',UTBF_TEXT_DOMAIN),     // Title of the page displayed at the top
            __('Search account',UTBF_TEXT_DOMAIN),  // Text of the submenu link
            'manage_options',                       // Required capability to access the submenu
            'users_search',                         // Unique identifier for the submenu
             [$this,'render_menu_users_search'],    // Function to display the content of the page
        );

    }

    /**
     * Render menu users search
     *
     * @return void
     */
    public function render_menu_users_search():void
    {

        $search = new Search;

        $s = (isset($_GET['s']))?$_GET['s']: '';
        $paged = (isset($_GET['p']))? (int)$_GET['p']: 1;
        $ppp = (isset($_GET['ppp']))? (int)$_GET['ppp']: UTBF_PPP_USERS_SEARCH;

        $users =
            $search->parents($s)
                   ->childs($s)
                   ->removeDuplicates()
                   ->setLimite($ppp)
                   ->setPaged($paged)
                   ->getUsers();

        $count =
            $search->getTotalUsers($s);

        $limite =
            $search->getLimite();

        ob_start();

            load_template( UTBF_THEME_PATH . '/template-parts/admin/users/menu-search-archive.php',null,[
                's'             => $s,
                'users'         => $users,
                'paged'         => $paged,
                'count'         => $count,
                'limite'        => $limite,
                ///
                'ppp_init'      => UTBF_PPP_USERS_SEARCH,
                'ppp_get'       => $ppp,
                'ppp_array'     => UTBF_PPP_ARRAY_USERS_SEARCH,
                'slug_ppp'      => 'ppp',
                'slug_paged'    => 'p',
                'base_url'      => site_url().'/wp-admin/users.php?page=users_search',
            ]);
            $template_part = ob_get_contents();

        ob_end_clean();
        echo $template_part;

    }

}
