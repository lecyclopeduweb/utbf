<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

use AppUtbf\WooCommerce\Cart;
use AppUtbf\WooCommerce\Notice;
use AppUtbf\WooCommerce\Buttons;
use AppUtbf\WooCommerce\Account;
use AppUtbf\WooCommerce\Products;
use AppUtbf\WooCommerce\Checkout;
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
        new Notice;
        new Buttons;
        new Account;
        new Products;
        new Checkout;
        new WooCommerce;
        new SingleProduct;

    }

}
