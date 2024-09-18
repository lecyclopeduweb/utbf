<?php

declare (strict_types = 1);

namespace AppUtbf\Divi;

/**
 * Divi
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Divi
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_action('after_setup_theme', [$this, 'init']);

    }

    /**
     * Init
     *
     * @return void
     */
    public function init():void
    {

		  require_once UTBF_DIVI_PATH . '/divi-custom-modules.php';

    }

}
