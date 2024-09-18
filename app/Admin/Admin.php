<?php

declare (strict_types = 1);

namespace AppUtbf\Admin;

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

        $user = wp_get_current_user();
        if ( ! empty( $user->roles ) ) :
            $classes .= ' role-' . esc_attr( $user->roles[0] );
        endif;

        return $classes;

    }

}
