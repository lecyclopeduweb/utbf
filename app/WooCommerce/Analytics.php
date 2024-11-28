<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

use AppUtbf\CSV\CSV;
use AppUtbf\CSV\Products;
/**
 * Analytics
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Analytics
{

    private $table_name;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        $this->table_name = 'woocommerce_utbf_products_analytics';

        add_action('after_switch_theme', [$this,'create_product_analytics_database_table']);
        add_action('woocommerce_checkout_update_order_meta', [$this,'insert_product_analytics_entry'], 10, 2);

        add_action('wp_ajax_nopriv_utfb_export_product_analytics', [$this,'export_product_analytics']);
        add_action('wp_ajax_utfb_export_product_analytics', [$this,'export_product_analytics']);

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

        $table_name = $wpdb->prefix . $this->table_name;
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

        $table_name = $wpdb->prefix . $this->table_name;
        if(!$wpdb->get_var("SHOW TABLES LIKE '{$table_name}'"))
            return;

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
                'phone_2'      => $order->get_meta('_billing_phone_2'),
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
                                'recommendations' => $child['recommendations'],
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
                        $wpdb->prefix . $this->table_name,
                        $insert
                    );

                endforeach;
            endif;

        endforeach;

    }

    /**
     * Export Data
     *
     *
     * @return void
     */
    public function export_product_analytics() {

        global $wpdb;


        $table_name = $wpdb->prefix . $this->table_name;
        if(!$wpdb->get_var("SHOW TABLES LIKE '{$table_name}'")):
              wp_send_json_error(
                ['message' =>  __('The table in the database does not exist.', UTBF_TEXT_DOMAIN)]
            );
            die;
        endif;

        $products = [];
        $product_id = $_POST['product_id'];
        $product_title = get_the_title($product_id);
        $table_name = $wpdb->prefix . $this->table_name;

        if(empty($product_id)):
             wp_send_json_error(
                ['message' =>  __('Product invalid.', UTBF_TEXT_DOMAIN)]
            );
            die;
        endif;

        $query = $wpdb->prepare(
            "SELECT * FROM $table_name WHERE product_id = %d",
            $product_id
        );

        $results = $wpdb->get_results($query);

        if(empty($results)):
            wp_send_json_error(
                ['message' =>  __('No children added to this product.', UTBF_TEXT_DOMAIN)]
            );
            die;
        endif;

        foreach($results as $product):
            $order_id = $product->order_id;
            $order = wc_get_order( $order_id );

            if ( !$order )
                continue;

            $status = $order->get_status();

            if($status != 'completed')
                continue;

            $deserialized_product = [];
            foreach ($product as $key => $value) :
                if(
                    $key == 'id' ||
                    $key == 'product_id' ||
                    $key == 'order_id'
                ):
                    $deserialized_product[$key] = $value;
                else:
                    $deserialized_product[$key] = unserialize($value);
                endif;
            endforeach;

            $products[] = $deserialized_product;

        endforeach;

         if(empty($deserialized_product)):
            wp_send_json_error(
                ['message' =>  __('No order has status completed.', UTBF_TEXT_DOMAIN)]
            );
            die;
        endif;

        $title_csv = 'Statistiques du stage '.$product_title;
        $this->create_csv_analytics($products,$title_csv);
        die;

    }

    /**
     * create CVS
     *
     * @param array $products   list of product
     * @param string $csv_title  title of CSV
     *
     * @return void
     */
    public function create_csv_analytics($products,$csv_title) {


        $csv = new CSV;
        $csv_products = new Products;

        $header = $csv_products->header_analytics();
        $items = $csv_products->items_analytics($products);
        $create = $csv->create($header, $items, $csv_title);

        if(isset($create['file_url'])):
            wp_send_json_success(
                array_merge(
                    $create,
                    ['message' =>  __('Export completed.', UTBF_TEXT_DOMAIN)]
                )
            );
        else:
            wp_send_json_error($create);
        endif;

    }


}
