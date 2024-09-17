<?php

declare (strict_types = 1);

namespace AppUtbf;

use AppUtbf\Divi\Divi;
use AppUtbf\Assets\Assets;
use AppUtbf\Forms\FormsServiceProvider;
use AppUtbf\Theme\ThemeServiceProvider;

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

        $forms_service_provider = new FormsServiceProvider;
        $forms_service_provider->boot();

        $theme_service_provider = new ThemeServiceProvider;
        $theme_service_provider->boot();

    }

}
