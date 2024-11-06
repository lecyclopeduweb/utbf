<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

/**
 * Buttons
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Buttons
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

       add_action('woocommerce_is_purchasable', [$this, 'remove_add_to_cart_if_not_logged_in'], 10, 2);
       add_action('woocommerce_single_product_summary', [$this, 'show_message_if_not_logged_in'], 25);

    }

    /**
     * Disable the Add to Cart button if the user is not logged in.
     *
     * @param bool $purchasable  Whether the product is purchasable.
     * @param WC_Product $product The product object.
     *
     * @return bool False if the user is not logged in, true otherwise.
     */
    public function remove_add_to_cart_if_not_logged_in($purchasable, $product)
    {

        if (!is_user_logged_in()) :
            return false;
        endif;

        return $purchasable;

    }


    /**
     * Display a custom message if the user is not logged in.
     *
     * @return void
     */
    public function show_message_if_not_logged_in() {

        if (!is_user_logged_in()):

            ob_start();

                load_template( UTBF_THEME_PATH . '/template-parts/woocommerce/single-product/not-logged-in.php',null,[]);
                $template_part = ob_get_contents();

            ob_end_clean();
            echo $template_part;


        endif;

    }

}
