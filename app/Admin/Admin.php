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

}
