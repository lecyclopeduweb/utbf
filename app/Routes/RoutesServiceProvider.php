<?php

declare (strict_types = 1);

namespace AppUtbf\Routes;

use AppUtbf\Routes\Urls;

/**
 * Routes Services Providers
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class RoutesServiceProvider
{

    /**
     * {@inheritdoc}
     */
    public function boot()
    {

        new Urls;

    }

}
