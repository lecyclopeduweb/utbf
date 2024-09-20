<?php

declare (strict_types = 1);

namespace AppUtbf;

use AppUtbf\Divi\Divi;
use AppUtbf\Users\Users;
use AppUtbf\Assets\Assets;
use AppUtbf\ACF\ACFServiceProvider;
use AppUtbf\Forms\FormsServiceProvider;
use AppUtbf\Theme\ThemeServiceProvider;
use AppUtbf\Admin\AdminServiceProvider;
use AppUtbf\WooCommerce\WooCommerceServiceProvider;

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

        new Divi;
        new Users;
        new Assets;

        $acf_service_provider = new ACFServiceProvider;
        $acf_service_provider->boot();

        $forms_service_provider = new FormsServiceProvider;
        $forms_service_provider->boot();

        $theme_service_provider = new ThemeServiceProvider;
        $theme_service_provider->boot();

        $admin_service_provider = new AdminServiceProvider;
        $admin_service_provider->boot();

        $woocommerce_service_provider = new WooCommerceServiceProvider;
        $woocommerce_service_provider->boot();

    }

}
