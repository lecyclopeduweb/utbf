<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

use AppUtbf\WooCommerce\Account;
use AppUtbf\WooCommerce\WooCommerce;

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
        new WooCommerce;

    }

}
