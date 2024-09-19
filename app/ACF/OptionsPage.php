<?php

declare(strict_types=1);

namespace AppUtbf\ACF;

/**
 * ACF Options Page
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class OptionsPage
{

    /**
     * Constructeur.
     *
     * @return void
     */
    public function __construct()
    {

       add_action( 'init', [ $this, 'add_options_page' ] );

    }

    /**
	 * Add options page
	 *
	 * @return 		void
	 */
	public function add_options_page():void
	{

	    if (function_exists('acf_add_options_page')) {

            acf_add_options_page([
                'page_title'            => __( 'Theme settings',UTBF_TEXT_DOMAIN),
                'menu_title'            => __( 'Theme settings',UTBF_TEXT_DOMAIN),
                'menu_slug'             => 'theme-general-settings',
                'parent'                => 'options-general.php',
                'capability'            => 'edit_posts',
                'update_button'         => __( 'Update',UTBF_TEXT_DOMAIN),
                'updated_message'       => __( 'Settings updated',UTBF_TEXT_DOMAIN),
            ]);

        }

	}

}
