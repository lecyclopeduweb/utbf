<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

/**
 * WooCommerce
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class WooCommerce
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

       add_action('wp_loaded', [$this,'wc_add_notice'] );

    }

    /**
     * Add Notice
     *
     * @return void
     */
    public function wc_add_notice():void
    {

        if (class_exists( 'WooCommerce' )):
            if (WC()->session && WC()->session->get('success')):
                wc_add_notice(WC()->session->get('success'), 'success');
                WC()->session->set('success', null);
            endif;
        endif;
    }

}
