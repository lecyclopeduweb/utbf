<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

/**
 * Products
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Products
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_action('add_meta_boxes',[$this,'add_classroom_meta_box']);
        add_action('save_post',[$this,'save_classroom_meta_box']);

    }

    /**
     * In Back End products
     *
     * Add sidebar metabox classroom checkbox
     *
     * @return void
     */
    public function add_classroom_meta_box():void
    {

        add_meta_box(
            'classroom_products_meta_box',                      // Unique ID for the meta box
            __('Classrooms authorized', UTBF_TEXT_DOMAIN),      // Title of the meta box
            [$this,'classroom_meta_box_render'],                // Callback function to display
            'product',                                          // Post type (WooCommerce product)
            'side',                                             // Context of the sidebar
            'default'                                           // Priority
        );

    }

    /**
     * In Back End products
     *
     * Render sidebar metabox classroom checkbox
     *
     * @param object $post      Post
     *
     * @return void
     */
    public function classroom_meta_box_render($post):void
    {

        $classrooms = get_field('theme_settings_classroom','options');
        $selected = get_post_meta($post->ID, 'classroom_products_meta_box', true);

        ob_start();

            get_template_part( 'template-parts/admin/woocommerce/products/classrooms-checkbox',null, [
                'classrooms'       =>  $classrooms,
                'selected'         =>  $selected,
            ]);
            $template_part = ob_get_contents();

        ob_end_clean();

        echo $template_part;

    }

    /**
     * In Back End products
     *
     * Save sidebar metabox classroom checkbox
     *
     * @param int $post_id      Post ID
     *
     * @return void
     */
    public function save_classroom_meta_box($post_id):void
    {

        if (!isset($_POST['classroom_products_meta_box_nonce_field']) || !wp_verify_nonce($_POST['classroom_products_meta_box_nonce_field'], 'classroom_products_meta_box_nonce'))
            return;

        if (!current_user_can('edit_post', $post_id))
            return;

        if (isset($_POST['classroom_products_meta_box'])):
            update_post_meta($post_id, 'classroom_products_meta_box', $_POST['classroom_products_meta_box']);
        endif;

    }

}