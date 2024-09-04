<?php

declare (strict_types = 1);

namespace AppUtbf;

use AppUtbf\Assets\Assets;
use AppUtbf\Theme\ThemeServiceProvider;
use AppUtbf\Divi\DiviServiceProvider;

/**
 * App Services Providers
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class AppServiceProvider
{

    /**
     * {@inheritdoc}
     */
    public function boot()
    {

        new Assets;

        $divi_service_provider = new DiviServiceProvider;
        $divi_service_provider->boot();

        $theme_service_provider = new ThemeServiceProvider;
        $theme_service_provider->boot();

    }

}
