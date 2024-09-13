<?php

declare (strict_types = 1);

namespace AppUtbf;

use AppUtbf\Assets\Assets;
use AppUtbf\Theme\ThemeServiceProvider;
use AppUtbf\Divi\Divi;

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
        new Divi;

        $theme_service_provider = new ThemeServiceProvider;
        $theme_service_provider->boot();

    }

}
