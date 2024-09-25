<?php

declare (strict_types = 1);

namespace AppUtbf\Admin;

use AppUtbf\Admin\Admin;

/**
 * Admin Services Providers
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class AdminServiceProvider
{

    /**
     * {@inheritdoc}
     */
    public function boot()
    {

        new Admin;

    }

}
