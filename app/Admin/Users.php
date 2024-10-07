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

        ob_start();

            load_template( UTBF_THEME_PATH . '/template-parts/admin/users/custom-tabs.php',null,[]);
            $template_part = ob_get_contents();

        ob_end_clean();
        echo $template_part;

    }

}
