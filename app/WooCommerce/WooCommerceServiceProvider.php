<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

use AppUtbf\WooCommerce\Account;

/**
 * WooCommerce Services Providers
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class WooCommerceServiceProvider
{

    /**
     * {@inheritdoc}
     */
    public function boot()
    {

        new Account;

    }

}
