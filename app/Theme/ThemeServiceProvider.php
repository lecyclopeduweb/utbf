<?php

declare (strict_types = 1);

namespace AppUtbf\Theme;

use AppUtbf\Theme\Setup;

/**
 * Theme Services Providers
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class ThemeServiceProvider
{

    /**
     * {@inheritdoc}
     */
    public function boot()
    {

        new Setup;

    }

}
