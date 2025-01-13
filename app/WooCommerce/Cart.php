<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

use AppUtbf\WooCommerce\Prices;
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

        //Childs by products in SESSION
        add_action('woocommerce_add_to_cart', [$this,'add_childs_by_product'], 10, 6);
        add_action('woocommerce_cart_item_removed', [$this,'remove_childs_by_product'], 10, 2);

        //Childs Item Datas
        add_filter('woocommerce_add_cart_item_data', [$this, 'add_cart_item_data'], 10, 2);
        add_filter('woocommerce_get_cart_item_from_session', [$this, 'get_cart_item_from_session'], 10, 2);
        add_filter('woocommerce_get_item_data', [$this, 'display_data_in_cart'], 10, 2);

        //Prices
        add_action('woocommerce_cart_calculate_fees', [$this, 'modify_cart_fees_product_price']);
        add_action('woocommerce_before_calculate_totals', [$this,'modify_cart_product_price'], 10, 1);

        //Quantity
        add_filter('woocommerce_cart_item_quantity', [$this,'change_quantity_input'], 10, 3);

    }

    /**
     * Childs by products in SESSION
     *
     * Add childs to session
     *
     * @param string $cart_item_key The unique cart item key.
     * @param int    $product_id The ID of the product being added.
     * @param int    $quantity The quantity of the product.
     * @param int    $variation_id The ID of the product variation, if applicable.
     * @param array  $variation An array of variation attributes, if applicable.
     * @param array  $cart_item_data Additional data for the cart item.
     *
     * @return void
     */
    public function add_childs_by_product($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data) {

        if (isset($_POST['childs']) && is_array($_POST['childs'])) :
            $childs_by_products = [];

            if (class_exists('WooCommerce') && WC()->session) :
                $current_childs[$product_id.'-'.$cart_item_key] = $_POST['childs'];
                if (!empty(WC()->session->get_session_data()['childs_by_products'])) :
                    $existing_childs_data = WC()->session->get('childs_by_products', []);
                    $childs_by_products = $existing_childs_data + $current_childs; // array merge keep key
                else :
                    $childs_by_products = $current_childs;
                endif;
            endif;

            WC()->session->set('childs_by_products', $childs_by_products);

        endif;

    }

    /**
     * Childs by products in SESSION
     *
     * Remove childs to session
     *
     * @param string $cart_item_key The unique cart item key.
     * @param WC_Cart $cart         The WC_Cart object containing all cart items.
     *
     * @return void
     */
    public function remove_childs_by_product($cart_item_key, $cart) {

        $line_item = $cart->removed_cart_contents[ $cart_item_key ];
        $product_id = $line_item[ 'product_id' ];

        if (!empty(WC()->session->get_session_data()['childs_by_products'])) :
            $childs_by_products = unserialize(WC()->session->get_session_data()['childs_by_products']);
            unset($childs_by_products[ $product_id.'-'.$cart_item_key]);
            WC()->session->set('childs_by_products', $childs_by_products);
        endif;

    }

    /**
     * Childs Item Datas
     *
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
        endif;

        return $cart_item_data;

    }

    /**
     * Childs Item Datas
     *
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
     * Childs Item Datas
     *
     * Display custom data in the cart and checkout pages.
     *
     * @param array $item_data The current cart item data to display.
     * @param array $cart_item The current cart item array.
     *
     * @return array array The modified cart item data with custom fields for display.
     */
    public function display_data_in_cart($item_data, $cart_item):array
    {

        if (isset($cart_item['childs']) && is_array($cart_item['childs'])):
            foreach ($cart_item['childs'] as $key => $child):

                $item_data[] = array(
                    'name'  => $child['name'],
                    'display' =>$child['classroom'],
                );
                if(!empty($child['canteen'])):
                    $item_data[] = array(
                        'name'  => __('Canteen', UTBF_TEXT_DOMAIN),
                        'display' =>implode(',', $child['canteen']),
                    );
                endif;
                if(!empty($child['daycare'])):
                    $item_data[] = array(
                        'name'  => __('Daycare', UTBF_TEXT_DOMAIN),
                        'display' =>implode(',', $child['daycare']),
                    );
                endif;
                $item_data[] = array(
                    'name'  => __('Emergency contact person', UTBF_TEXT_DOMAIN),
                    'display' =>$child['first_name_emergency'] . ' ' . $child['last_name_emergency'] . ' / ' . $child['phone_emergency'] ,
                );

            endforeach;
        endif;

        return $item_data;

    }

    /**
     * Add Canteen && Daycare line Fee
     *
     * Modify Cart Product Price
     *
     * @return void
     */
    function modify_cart_fees_product_price(): void
    {

        // Check if cart is not empty
        if (WC()->cart->is_empty())
            return;

        $prices = new Prices;
        static $processed_products = [];
        static $fee_canteens = [];
        static $fee_daycares = [];

        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):


            $product = $cart_item['data'];
            $product_id = $product->get_id();

            /* if (in_array($product_id, $processed_products))
                continue; */

            $childs = isset($cart_item['childs']) ? $cart_item['childs'] : '';

            //Prices
            $canteen_price = $prices->get_canteen($product_id);
            $daycare_price = $prices->get_daycare($product_id);

            if (!empty($childs)):

                foreach($childs as $key => $child):

                    // Add Canteen
                    if(!empty($child['canteen'])):
                        $fee_canteens[$child['name']] = (count($child['canteen']) * (int)$canteen_price);
                    endif;

                    // Add Daycare
                    if(!empty($child['daycare'])):
                        $fee_daycares[$child['name']] = (count($child['daycare']) * (int)$daycare_price);
                    endif;

                endforeach;

                // Add the product ID to the processed products table
                $processed_products[] = $product_id;

            endif;
        endforeach;


        $this->apply_wc_cart_add_fees($fee_canteens, $fee_daycares);

    }


    /**
     * Add Canteen && Daycare line Fee
     *
     * Apply WC()->cart->add_fee
     *
     * @param array     $fee_canteens         Canteens
     * @param array     $fee_daycares         Daycares
     *
     * @return void
     */
    function apply_wc_cart_add_fees($fee_canteens, $fee_daycares): void
    {

        //Canteen
        if (!empty($fee_canteens)) :
            foreach($fee_canteens as $key => $fee_canteen):
                //WC()->cart->add_fee(__('Canteen', UTBF_TEXT_DOMAIN) . ' ' . __('child',UTBF_TEXT_DOMAIN)  . ' ' .  __('number',UTBF_TEXT_DOMAIN)  . ' ' .  ($key + 1) , + $fee_canteen, true);
                WC()->cart->add_fee(__('Canteen', UTBF_TEXT_DOMAIN) . ' ' . $key , + $fee_canteen, true);
            endforeach;
        endif;

        //Daycare
        if (!empty($fee_daycares)) :
            foreach($fee_daycares as $key => $fee_daycare):
                //WC()->cart->add_fee(__('Daycare', UTBF_TEXT_DOMAIN) . ' ' . __('child',UTBF_TEXT_DOMAIN)  . ' ' .  __('number',UTBF_TEXT_DOMAIN)  . ' ' .  ($key + 1) , + $fee_daycare, true);
                WC()->cart->add_fee(__('Daycare', UTBF_TEXT_DOMAIN) . ' ' . $key , + $fee_daycare, true);
            endforeach;
        endif;

    }

    /**
     * Change Price if 2 childs or more
     *
     * Modifies the product price in the cart before the totals are calculated.
     *
     * @param \WC_Cart $cart The cart object.
     *
     * @return void
     */
    function modify_cart_product_price($cart): void
    {

        // Check if the cart is empty
        if (is_admin() && !defined('DOING_AJAX'))
            return;

        $prices = new Prices;

        foreach ($cart->get_cart() as $cart_item_key => $cart_item) :

            $product = $cart_item['data'];
            $product_id = $cart_item['product_id'];

            $childs = isset($cart_item['childs']) ? $cart_item['childs'] : '';

            if (!empty($childs)):

                $product_price = $product->get_price();

                $decreasing_percentage = $prices->get_decreasing_rate_percentage($product_id);

                if( (count($childs)>=2) && ((int)$decreasing_percentage!=0) ):
                    $product_price = $product_price - $decreasing_percentage;
                    $cart_item['data']->set_price($product_price);
                endif;

            endif;

        endforeach;

    }

    /**
     * Change Quantity Input to simple html integer
     *
     * @param string   $product_quantity  HTML content of quantity input.
     * @param string   $cart_item_key     Cart item key.
     * @param array    $cart_item         Cart item data array.
     *
     * @return string  Returns the product quantity as a string.
     */
    function change_quantity_input($product_quantity, $cart_item_key, $cart_item) {

        return $cart_item['quantity'];

    }

}