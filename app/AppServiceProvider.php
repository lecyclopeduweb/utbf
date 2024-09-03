<?php

declare (strict_types = 1);

namespace AppUtbf;

use AppUtbf\Assets\Assets;

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

    }

}
