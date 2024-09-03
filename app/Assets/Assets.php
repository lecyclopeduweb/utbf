<?php

declare (strict_types = 1);

namespace AppUtbf\Assets;

/**
 * Assets
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Assets
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);

    }

    /**
     * Enqueued styles/scripts.
     *
     * @return void
     */
    public function enqueue_scripts():void
    {

        $parenthandle = 'divi-style';
        $theme = wp_get_theme();
        wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css',
            array(), // if the parent theme code has a dependency, copy it to here
            $theme->parent()->get('Version')
        );
        wp_enqueue_style( 'child-style', get_stylesheet_uri(),
            array( $parenthandle ),
            $theme->get('Version')
        );

	    wp_localize_script('theme', 'AJAX_URL', [
		    'url'   => admin_url('admin-ajax.php'),
		    'nonce' => wp_create_nonce('ajax_url_nonce')
	    ]);

    }

    /**
     * Enqueued Admin styles/scripts.
     *
     * @return void
     */
    public function enqueue_admin_scripts():void
    {
    }


}
