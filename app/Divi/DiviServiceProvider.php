<?php

declare (strict_types = 1);

namespace AppUtbf\Divi;

/**
 * Divi Services Providers
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class DiviServiceProvider
{

    /**
     * {@inheritdoc}
     */
    public function boot()
    {

       add_action('et_builder_ready', 'divi_module_register_form');

    }

}
