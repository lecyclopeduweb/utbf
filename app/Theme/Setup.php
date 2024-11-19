<?php

declare (strict_types = 1);

namespace AppUtbf\Theme;

/**
 * Setup
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Setup
{
    /**
     * Setup theme.
     *
     * @return void
     */
    public function __construct()
    {

        //add_action('after_setup_theme', [$this, 'after_setup_theme']);
        add_action('init', [$this, 'init_after_setup_theme']);

    }

    /**
     * Theme initialization.
     *
     * @return void
     */
    public function after_setup_theme()
    {

        load_child_theme_textdomain(UTBF_TEXT_DOMAIN, UTBF_THEME_PATH . '/languages');

    }

    /**
     * Theme initialization.
     *
     * @return void
     */
    public function init_after_setup_theme()
    {

        load_textdomain(UTBF_TEXT_DOMAIN, UTBF_THEME_PATH . '/languages/fr_FR.mo');

    }

}
