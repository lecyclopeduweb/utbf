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

        add_action('admin_menu', [$this,'add_menu_utbf']);
        add_action('admin_menu', [$this,'add_menu_users_search']);
        add_action('admin_menu', [$this,'add_menu_analytics']);
        add_action('admin_menu', [$this,'add_menu_global_analytics']);

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
     * Add menu UTBF
     *
     * @return void
     */
    public function add_menu_utbf():void
    {

       add_menu_page(
            __('UTBF', UTBF_TEXT_DOMAIN),       // Title of the page
            __('UTBF', UTBF_TEXT_DOMAIN),       // Title in the menu
            'manage_options',                   // Required capability
            'menu_utbf',                        // Slug of the page
            [$this,'render_menu_utbf'],         // Function to display the content
            'dashicons-welcome-learn-more',     // Menu icon
            5                                   // Position in the menu
        );
    }

    /**
     * Add menu Users Search
     *
     * @return void
     */
    public function add_menu_users_search():void
    {

        add_submenu_page(
            'menu_utbf',                            // Parent page slug
            __('Search account',UTBF_TEXT_DOMAIN),  // Page title
            __('Search account',UTBF_TEXT_DOMAIN),  // Title in the menu
            'manage_options',                       // Required capability
            'utbf_users_search',                    // Submenu slug
            [$this,'render_menu_users_search']      // Function to display content
        );

    }

    /**
     * Add menu Analytics
     *
     * @return void
     */
    public function add_menu_analytics():void
    {

        add_submenu_page(
            'menu_utbf',                            // Parent page slug
            __('Analytics',UTBF_TEXT_DOMAIN),       // Page title
            __('Analytics',UTBF_TEXT_DOMAIN),       // Title in the menu
            'manage_options',                       // Required capability
            'utbf_analytics',                       // Submenu slug
            [$this,'render_menu_analytics']         // Function to display content
        );

    }

    /**
     * Add menu Global Analytics
     *
     * @return void
     */
    public function add_menu_global_analytics():void
    {

        add_submenu_page(
            'menu_utbf',                                    // Parent page slug
            __('Global analytics',UTBF_TEXT_DOMAIN),        // Page title
            __('Global analytics',UTBF_TEXT_DOMAIN),        // Title in the menu
            'manage_options',                               // Required capability
            'utbf_global_analytics',                        // Submenu slug
            [$this,'render_menu_global_analytics']          // Function to display content
        );

    }


    /**
     * Render menu UTB
     *
     * @return void
     */
    public function render_menu_utbf():void
    {

        ob_start();

            load_template( UTBF_THEME_PATH . '/template-parts/admin/menus/menu-utbf.php',null,[]);
            $template_part = ob_get_contents();

        ob_end_clean();
        echo $template_part;

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

            load_template( UTBF_THEME_PATH . '/template-parts/admin/menus/menu-search-account-archive.php',null,[
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

    /**
     * Render menu Analytics
     *
     * @return void
     */
    public function render_menu_analytics():void
    {

        $args = [
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        ];

        $products = get_posts( $args );

        ob_start();

            load_template( UTBF_THEME_PATH . '/template-parts/admin/menus/menu-analytics.php',null,[
                'products' => $products,
            ]);
            $template_part = ob_get_contents();

        ob_end_clean();
        echo $template_part;

    }

    /**
     * Render menu Global Analytics
     *
     * @return void
     */
    public function render_menu_global_analytics():void
    {

        ob_start();

            load_template( UTBF_THEME_PATH . '/template-parts/admin/menus/menu-global-analytics.php',null,[]);
            $template_part = ob_get_contents();

        ob_end_clean();
        echo $template_part;

    }

}
