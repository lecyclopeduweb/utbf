<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

/**
 * Cart
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Cart
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_filter('woocommerce_add_cart_item_data', [$this, 'add_cart_item_data'], 10, 2);
        add_filter('woocommerce_get_cart_item_from_session', [$this, 'get_cart_item_from_session'], 10, 2);
        add_filter('woocommerce_get_item_data', [$this, 'display_data_in_cart'], 10, 2);
        add_action('woocommerce_add_order_item_meta', [$this,'save_data_in_order'], 10, 2);

    }

    /**
     * Add custom data to the cart item
     * This hook allows you to add additional information to the product data in the cart.
     *
     * @param array $cart_item_data The current cart item data.
     * @param int $product_id The product ID.
     *
     * @return array The modified cart item data with custom fields.
     */
    public function add_cart_item_data($cart_item_data, $product_id):array
    {

        if (isset($_POST['childs']) && is_array($_POST['childs'])):
            $cart_item_data['childs'] = $_POST['childs'];
            $cart_item_data['childs_key'] = md5(microtime() . rand());
            wc_add_notice(__('Custom data added to cart', UTBF_TEXT_DOMAIN), 'success');
        endif;

        return $cart_item_data;

    }

    /**
     * Ensure the custom data is loaded from the session correctly.
     *
     * @param array $cart_item The current cart item array.
     * @param array $values The session values.
     *
     * @return array The modified cart item array.
     */
    public function get_cart_item_from_session(array $cart_item, array $values): array
    {

        if (isset($values['childs'])):
            $cart_item['childs'] = $values['childs'];
        endif;

        return $cart_item;
    }

    /**
     * Display custom data in the cart and checkout pages.
     *
     * @param array $item_data The current cart item data to display.
     * @param array $cart_item The current cart item array.
     *
     * @return array array The modified cart item data with custom fields for display.
     */
    public function display_data_in_cart($item_data, $cart_item):array
    {

        $product_id = $cart_item['product_id'];

        //Prices
        $canteen_option_price_default = get_field('theme_settings_product_canteen_option_price','option');
        $daycare_option_price_default = get_field('theme_settings_product_daycare_option_price','option');
        $canteen_option_price = get_field('product_canteen_option_price',$product_id);
        $daycare_option_price = get_field('product_daycare_option_price',$product_id);
        $canteen_price = ($canteen_option_price)? $canteen_option_price : (($canteen_option_price_default)? $canteen_option_price_default : 6);
        $daycare_price = ($daycare_option_price)? $daycare_option_price : (($daycare_option_price_default)? $daycare_option_price_default : 2);

        if (isset($cart_item['childs']) && is_array($cart_item['childs'])):
            foreach ($cart_item['childs'] as $key => $child):

                ob_start();

                    get_template_part( 'template-parts/woocommerce/cart/display-data-in-cart',null, $child);
                    $template_part = ob_get_contents();

                ob_end_clean();

                $item_data[] = array(
                    'name'  => __('Child', UTBF_TEXT_DOMAIN) . ' ' . __('number',UTBF_TEXT_DOMAIN) . ' ' . ($key+1),
                    'display' =>$template_part,
                );

                if(!empty($child['canteen'])):
                    $item_data[] = array(
                        'name'  => __('Canteen prices', UTBF_TEXT_DOMAIN) . ' ' . __('number',UTBF_TEXT_DOMAIN) . ' ' . ($key+1),
                        'display' =>count($child['canteen']) * (int)$canteen_price . '€',
                    );
                endif;

                if(!empty($child['daycare'])):
                    $item_data[] = array(
                        'name'  => __('Daycare prices', UTBF_TEXT_DOMAIN) . ' ' . __('number',UTBF_TEXT_DOMAIN) . ' ' . ($key+1),
                        'display' =>count($child['daycare']) * (int)$daycare_price . '€',
                    );
                endif;

            endforeach;
        endif;

        return $item_data;

    }

    /**
     * Save custom data to order item meta.
     *
     * @param int   $item_id The ID of the order item.
     * @param array $values The cart item values.
     *
     * @return void
     */
    function save_data_in_order(int $item_id, array $values): void {

        //Prices
        $canteen_option_price_default = get_field('theme_settings_product_canteen_option_price','option');
        $daycare_option_price_default = get_field('theme_settings_product_daycare_option_price','option');
        $canteen_option_price = get_field('product_canteen_option_price',$item_id);
        $daycare_option_price = get_field('product_daycare_option_price',$item_id);
        $canteen_price = ($canteen_option_price)? $canteen_option_price : (($canteen_option_price_default)? $canteen_option_price_default : 6);
        $daycare_price = ($daycare_option_price)? $daycare_option_price : (($daycare_option_price_default)? $daycare_option_price_default : 2);

        if (isset($values['childs']) && is_array($values['childs'])):
            foreach ($values['childs'] as $key => $child):

                if (is_array($child)):

                    ob_start();

                        get_template_part( 'template-parts/woocommerce/checkout/display-data-in-checkout',null, [
                            'child'             =>  $child,
                            'canteen_price'     =>  $canteen_price,
                            'daycare_price'     =>  $daycare_price
                        ]);
                        $template_part = ob_get_contents();

                    ob_end_clean();

                    wc_add_order_item_meta(
                        $item_id,
                        __('Child', UTBF_TEXT_DOMAIN) . ' ' . __('number',UTBF_TEXT_DOMAIN) . ' ' . ($key+1),
                        $template_part
                    );

                endif;

            endforeach;
        endif;

    }

}