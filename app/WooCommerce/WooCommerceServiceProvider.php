<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

use AppUtbf\WooCommerce\Cart;
use AppUtbf\WooCommerce\Account;
use AppUtbf\WooCommerce\WooCommerce;
use AppUtbf\WooCommerce\SingleProduct;

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

        new Cart;
        new Account;
        new WooCommerce;
        new SingleProduct;

    }

}
