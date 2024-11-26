<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

use AppUtbf\Logs\Logs;
/**
 * Analytics
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Analytics
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_action('after_switch_theme', [$this,'create_product_analytics_database_table']);
        add_action('woocommerce_checkout_update_order_meta', [$this,'insert_product_analytics_entry'], 10, 2);

    }

    /**
     * Create Database Table
     *
     * @return void
     */
    public function create_product_analytics_database_table():void
    {

        global $wpdb;

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $table_name = $wpdb->prefix . 'woocommerce_utbf_products_analytics';
        $charset_collate = $wpdb->get_charset_collate();

        $query = "CREATE TABLE $table_name (
            id int NOT NULL AUTO_INCREMENT,
            product_id bigint NOT NULL,
            order_id bigint NOT NULL,
            tax_product_school text,
            child text,
            canteen text,
            daycare text,
            consents text,
            legal_guardian text,
            emergency text,
            PRIMARY KEY (id)
        ) $charset_collate ENGINE = InnoDB;";

        dbDelta($query);

    }

    /**
     * Hook to retrieve and handle order data upon creation.
     *
     * @param int $order_id The ID of the order.
     * @param WC_Order $order The order object.
     *
     * @return void
     */
    public function insert_product_analytics_entry($order_id, $data) {

        global $wpdb;

        $order = wc_get_order($order_id);

        if (!$order)
            return;

        //childs
        $childs = get_post_meta($order_id, 'childs', true);

        //Consent
        $consent_communication = get_post_meta($order_id, 'consent_communication', true);
        $consent_blog = get_post_meta($order_id, 'consent_blog', true);

        //legal guardian
        $legal_guardian = [
            'legal_guardian' => [
                'first_name'   => $order->get_billing_first_name(),
                'last_name'    => $order->get_billing_last_name(),
                'address_1'    => $order->get_billing_address_1(),
                'address_2'    => $order->get_billing_address_2(),
                'city'         => $order->get_billing_city(),
                'postcode'     => $order->get_billing_postcode(),
                'country'      => $order->get_billing_country(),
                'state'        => $order->get_billing_state(),
                'email'        => $order->get_billing_email(),
                'phone'        => $order->get_billing_phone(),
            ],
            '$legal_guardian_2' => get_post_meta($order_id, 'legal_guardian_2', true),
        ];

        // Retrieve order items
        foreach ($order->get_items() as $item_id => $item) :

            //Product
            $product = $item->get_product();
            $product_id = $product ? $product->get_id() : null;

            //Childs
            $childs_product = (!empty($childs[(int)$product_id])) ? $childs[(int)$product_id] : false;

            if($childs_product):

                foreach ($childs_product as $child):

                    $insert =  [
                            'product_id' => $product_id,
                            'order_id' => $order_id,
                            'tax_product_school' => serialize(get_the_terms($product_id, 'product_cat')),
                            'child' => serialize([
                                'first_name' => $child['first_name'],
                                'last_name' => $child['last_name'],
                                'classroom' => $child['classroom'],
                                'birthday' => $child['birthday'],
                                'medical_treatments' => $child['medical_treatments'],
                                'specific_aspects' => $child['specific_aspects'],
                            ]),
                            'canteen' => (!empty($child['canteen'])) ? serialize($child['canteen']): '',
                            'daycare' => (!empty($child['daycare']))? serialize($child['daycare']): '',
                            'consents' => serialize([
                                'communication' => $consent_communication,
                                'blog' => $consent_blog,
                            ]),
                            'legal_guardian' => serialize($legal_guardian),
                            'emergency' =>serialize([
                                'last_name' =>  $child['last_name_emergency'],
                                'first_name' =>  $child['first_name_emergency'],
                                'phone' =>  $child['phone_emergency'],
                            ]),
                    ];

                    $wpdb->insert(
                        $wpdb->prefix .'woocommerce_utbf_products_analytics',
                        $insert
                    );

                endforeach;
            endif;

        endforeach;

    }


}
