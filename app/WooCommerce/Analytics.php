<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

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

        add_action( 'after_switch_theme',  [$this,'create_database_table']);

    }

    /**
     * Create Database Table
     *
     * @return void
     */
    public function create_database_table():void
    {

        global $wpdb;

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $table_name = $wpdb->prefix . 'woocommerce_utbf_products_analytics';
        $charset_collate = $wpdb->get_charset_collate();

        $query = "CREATE TABLE $table_name (
            id int NOT NULL AUTO_INCREMENT,
            user_id bigint NOT NULL,
            user_first_name text,
            user_last_name text,
            year int NOT NULL,
            month int NOT NULL,
            customer text,
            calendar text,
            overtimes text,
            attachment text,
            signing text,
            date_signing int DEFAULT NULL,
            state varchar(20) DEFAULT '0' NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate ENGINE = InnoDB;";

        dbDelta($query);

    }


}
