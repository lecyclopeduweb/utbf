<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

/**
 * Account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Account
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_action('init', [$this,'add_endpoint']);
        add_action('woocommerce_account_menu_items', [$this,'add_menus']);
        add_action('woocommerce_account_edit-childs_endpoint', [$this,'render_menu_edit_childs']);

    }

    /**
     * Add Endpoint
     *
     * @return void
     */
    public function add_endpoint():void
    {

        add_rewrite_endpoint( 'edit-childs', EP_ROOT | EP_PAGES );

    }

    /**
     * Add Menus
     *
     * @param array $menu_links        The menu links on the "My Account" page.
     *
     * @return array The menu modified with the addition of a new tab.
     */
    public function add_menus(array $menu_links):array
    {

        $new_link = [
            'edit-childs' => __('Childs',UTBF_TEXT_DOMAIN),
        ];
        $menu_links = array_slice( $menu_links, 0, 5, true )
                    + $new_link
                    + array_slice( $menu_links, 5, NULL, true );

        return $menu_links;

    }

    /**
     * Render Menu Edit Childs
     *
     * @return void
     */
    public function render_menu_edit_childs():void
    {


        ob_start();

            load_template( UTBF_THEME_PATH . '/template-parts/admin/account/menu-edit-childs.php',null,[
            ]);
            $template_part = ob_get_contents();

        ob_end_clean();
        echo $template_part;

    }

}
