<?php

declare (strict_types = 1);

namespace AppUtbf\ACF;

use AppUtbf\ACF\Synchro;

/**
 * ACF Services Providers
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class ACFServiceProvider
{

    /**
     * {@inheritdoc}
     */
    public function boot()
    {

        new Synchro;

    }

}
