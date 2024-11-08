<?php

declare (strict_types = 1);

namespace AppUtbf\Assets;

use AppUtbf\Users\Childs;
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
        add_action('wp_enqueue_scripts', [$this, 'dequeue_script']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);

    }

    /**
     * Enqueued styles/scripts.
     *
     * @return void
     */
    public function enqueue_scripts():void
    {

        $childs = new Childs;
        $get_childs = $childs->get_childs();

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

        wp_enqueue_style('theme', UTBF_THEME_URI . '/css/theme.min.css', false, UTBF_SCRIPTS_VERSION, 'all');
        wp_enqueue_script('theme', UTBF_THEME_URI . '/js/theme.min.js', array('jquery'), UTBF_SCRIPTS_VERSION, true);

       // Enqueue React and ReactDOM first
        wp_enqueue_script('react', UTBF_DIVI_URI . '/scripts/react.development.js', [], null, true);
        wp_enqueue_script('react-dom', UTBF_DIVI_URI . '/scripts/react-dom.development.js', ['react'], null, true);

        // Divi
        wp_enqueue_script('builder-bundle.min', UTBF_DIVI_URI . '/scripts/builder-bundle.min.js', ['react', 'react-dom'], UTBF_SCRIPTS_VERSION, true);
        //wp_enqueue_script('frontend-bundle.min', UTBF_DIVI_URI . '/scripts/frontend-bundle.min.js', ['react', 'react-dom'], UTBF_SCRIPTS_VERSION, true);
        //wp_enqueue_script('frontend', UTBF_DIVI_URI . '/scripts/frontend.js', ['react', 'react-dom'], UTBF_SCRIPTS_VERSION, true);

	    wp_localize_script('theme', 'AJAX_URL', [
		    'url'   => admin_url('admin-ajax.php'),
		    'nonce' => wp_create_nonce('ajax_url_nonce')
	    ]);

	    wp_localize_script('theme', 'VAR', [
		    'confirm_delete_child'   => __('Are you sure you want to delete this child?',UTBF_TEXT_DOMAIN),
		    'key_google_recaptcha'   => UTBF_KEY_GOOGLE_RECAPTCHA,
	    ]);

	    wp_localize_script('theme', 'CHILDS', [
		    'count'           => count($get_childs),
	    ]);

    }

    /**
     * dequeue styles/scripts.
     *
     * @return void
     */
    public function dequeue_script():void
    {

        wp_dequeue_script( 'divi-custom-modules-frontend-bundle-js' );
        wp_deregister_script( 'divi-custom-modules-frontend-bundle-js' );

    }

    /**
     * Enqueued Admin styles/scripts.
     *
     * @return void
     */
    public function enqueue_admin_scripts():void
    {

        wp_enqueue_style('admin', UTBF_THEME_URI . '/css/admin.min.css', false, UTBF_SCRIPTS_VERSION, 'all');
        wp_enqueue_script('admin', UTBF_THEME_URI . '/js/admin.min.js', array('jquery'), UTBF_SCRIPTS_VERSION, true);
        wp_enqueue_script('flatpickr', UTBF_THEME_URI . '/js/admin.min.js', array('jquery'), UTBF_SCRIPTS_VERSION, true);

    }

}
