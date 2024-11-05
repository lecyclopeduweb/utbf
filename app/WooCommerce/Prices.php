<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

/**
 * Prices
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Prices
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get Canteen price
     *
     * @param int $post_id      Post ID
     *
     * @return int
     */
    public function get_canteen($post_id = null):int
    {

        $canteen_option_price_default = get_field('theme_settings_product_canteen_option_price','option');

        if($post_id):
            $canteen_option_price = get_field('product_canteen_option_price',$post_id);
            return ($canteen_option_price)? (int)$canteen_option_price : (($canteen_option_price_default)? (int)$canteen_option_price_default : (int)UTBF_CANTEEN_PRICE);
        else:
            return (int)$canteen_option_price_default;
        endif;

    }

    /**
     * Get Daycare price
     *
     * @param int $post_id      Post ID
     *
     * @return int
     */
    public function get_daycare($post_id = null):int
    {

        $daycare_option_price_default = get_field('theme_settings_product_daycare_option_price','option');

        if($post_id):
             $daycare_option_price = get_field('product_daycare_option_price',$post_id);
            return ($daycare_option_price)? (int)$daycare_option_price : (($daycare_option_price_default)? (int)$daycare_option_price_default : (int)UTBF_DAYCARE_PRICE);
        else:
            return (int)$daycare_option_price_default;
        endif;

    }

    /**
     * Get Decreasing Rate Percentage
     *
     * @param int $post_id      Post ID
     *
     * @return int
     */
    public function get_decreasing_rate_percentage($post_id = null):int
    {

        $decreasing_rate_percentage_default = get_field('theme_settings_product_decreasing_rate_percentage','option');


        if($post_id):
            $decreasing_rate_percentage = get_field('product_decreasing_rate_percentage',$post_id);
            return ($decreasing_rate_percentage)? (int)$decreasing_rate_percentage : (($decreasing_rate_percentage_default)? (int)$decreasing_rate_percentage_default : (int)UTBF_DECREASING_RATE_PERCENTAGE);
        else:
            return (int)$decreasing_rate_percentage_default;
        endif;

    }


}