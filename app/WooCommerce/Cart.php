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

        //Childs Item Datas
        add_filter('woocommerce_add_cart_item_data', [$this, 'add_cart_item_data'], 10, 2);
        add_filter('woocommerce_get_cart_item_from_session', [$this, 'get_cart_item_from_session'], 10, 2);
        add_filter('woocommerce_get_item_data', [$this, 'display_data_in_cart'], 10, 2);
        add_action('woocommerce_add_order_item_meta', [$this,'save_data_in_order'], 10, 2);

        //Prices
        add_action('woocommerce_cart_calculate_fees', [$this, 'modify_cart_fees_product_price']);

        //Quantity
        add_filter('woocommerce_cart_item_quantity', [$this,'change_quantity_input'], 10, 3);

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

        $cart_item_data['consent-blog'] = $_POST['consent-blog'];
        $cart_item_data['consent-communication'] = $_POST['consent-communication'];

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
        $cart_item['consent-blog'] = $values['consent-blog'];
        $cart_item['consent-communication'] = $values['consent-communication'];

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
        $prices = new Prices;
        $canteen_price = $prices->get_canteen($product_id);
        $daycare_price = $prices->get_daycare($product_id);

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

        $item_data[] = array(
            'name'  => __('Authorization to publish photos on the secure blog', UTBF_TEXT_DOMAIN),
            'display' => $cart_item['consent-blog'],
        );

        $item_data[] = array(
            'name'  => __("Authorization to publish photos on the association's communication tools (website, FB, IG, etc.)", UTBF_TEXT_DOMAIN),
            'display' => $cart_item['consent-communication'],
        );

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
    function save_data_in_order(int $item_id, array $values): void
    {

        //Prices
        $prices = new Prices;
        $canteen_price = $prices->get_canteen($item_id);
        $daycare_price = $prices->get_daycare($item_id);

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

        wc_add_order_item_meta(
            $item_id,
            __('Authorization to publish photos on the secure blog', UTBF_TEXT_DOMAIN),
            $values['consent-blog']
        );

        wc_add_order_item_meta(
            $item_id,
            __("Authorization to publish photos on the association's communication tools (website, FB, IG, etc.)", UTBF_TEXT_DOMAIN),
            $values['consent-communication']
        );

    }

    /**
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
        static $total_discount = 0;

        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):

            $product = $cart_item['data'];
            $product_id = $product->get_id();

            if (in_array($product_id, $processed_products))
                continue; // Skip if the product has already been processed

            $childs = isset($cart_item['childs']) ? $cart_item['childs'] : '';

            //Prices
            $canteen_price = $prices->get_canteen($product_id);
            $daycare_price = $prices->get_daycare($product_id);
            $decreasing_percentage = $prices->get_decreasing_rate_percentage($product_id);

            if (!empty($childs)):

                //Init Price
                $output_price = $product->get_price();

                // Add decreasing rate
                if( (count($childs)>=2) && ((int)$decreasing_percentage!=0) ):
                    $decreasing = (($output_price * $decreasing_percentage) * (count($childs)-1)) /100;
                    $total_discount += $decreasing;
                endif;

                foreach($childs as $key => $child):

                    // Add Canteen
                    if(!empty($child['canteen'])):
                        $fee_canteens[$key] = (count($child['canteen']) * (int)$canteen_price);
                    endif;

                    // Add Daycare
                    if(!empty($child['daycare'])):
                        $fee_daycares[$key] = (count($child['daycare']) * (int)$daycare_price);
                    endif;

                endforeach;

                // Add the product ID to the processed products table
                $processed_products[] = $product_id;

            endif;
        endforeach;

        $this->apply_wc_cart_add_fees($total_discount, $fee_canteens, $fee_daycares);

    }

    /**
     * Apply WC()->cart->add_fee
     *
     * @param int       $total_discount       Discount
     * @param array     $fee_canteens         Canteens
     * @param array     $fee_daycares         Daycares
     *
     * @return void
     */
    function apply_wc_cart_add_fees($total_discount, $fee_canteens, $fee_daycares): void
    {

        // Discount
        if ($total_discount > 0) :
            WC()->cart->add_fee(__('Discount for multiple children', UTBF_TEXT_DOMAIN), - $total_discount, true);
        endif;

        //Canteen
        if (!empty($fee_canteens)) :
            foreach($fee_canteens as $key => $fee_canteen):
                WC()->cart->add_fee(__('Canteen', UTBF_TEXT_DOMAIN) . ' ' . __('child',UTBF_TEXT_DOMAIN)  . ' ' .  __('number',UTBF_TEXT_DOMAIN)  . ' ' .  ($key + 1) , + $fee_canteen, true);
            endforeach;
        endif;

        //Daycare
        if (!empty($fee_daycares)) :
            foreach($fee_daycares as $key => $fee_daycare):
                WC()->cart->add_fee(__('Daycare', UTBF_TEXT_DOMAIN) . ' ' . __('child',UTBF_TEXT_DOMAIN)  . ' ' .  __('number',UTBF_TEXT_DOMAIN)  . ' ' .  ($key + 1) , + $fee_daycare, true);
            endforeach;
        endif;

    }

    /**
     * Change Quantity Input
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