<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

use AppUtbf\Users\Childs;
/**
 * SingleProduct
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class SingleProduct
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        ///childs Form
        add_action('woocommerce_after_add_to_cart_quantity', [$this, 'childs_form']);

        ///Button Add To Cart
        add_action('woocommerce_is_purchasable', [$this, 'remove_add_to_cart'], 10, 2);

        ///Messages
        add_action('woocommerce_single_product_summary', [$this, 'show_message_if_not_logged_in'], 25);
        add_action('woocommerce_single_product_summary', [$this, 'show_message_if_not_child'], 25);

    }


    /**
     * Childs Form
     *
     * @return void
     */
    public function childs_form():void
    {

        $childs = new Childs;

        if (!is_user_logged_in())
            return;

        $post_id = get_the_ID();
        $get_childs = $childs->get_childs();

        if(empty($get_childs))
            return;

        $count_childs = (isset($_POST['childs']))? count($_POST['childs']): 1;

        //Theme settings : classroom
        $classroom = [];
		if( have_rows('theme_settings_classroom','option') ):
			while( have_rows('theme_settings_classroom','option') ) : the_row();
				$classroom[] = get_sub_field('classroom');
			endwhile;
		endif;

        //Product post_meta : canteen
        $canteen = get_field('product_canteen_option',$post_id);

        //Product post_meta : Daycare
        $daycare = get_field('product_daycare_option',$post_id);

        //Prices
        $canteen_option_price_default = get_field('theme_settings_product_canteen_option_price','option');
        $daycare_option_price_default = get_field('theme_settings_product_daycare_option_price','option');
        $canteen_option_price = get_field('product_canteen_option_price',$post_id);
        $daycare_option_price = get_field('product_daycare_option_price',$post_id);
        $canteen_price = ($canteen_option_price)? $canteen_option_price : (($canteen_option_price_default)? $canteen_option_price_default : 6);
        $daycare_price = ($daycare_option_price)? $daycare_option_price : (($daycare_option_price_default)? $daycare_option_price_default : 2);

        ob_start();

            get_template_part( 'template-parts/woocommerce/single-product/childs-form',null,[
                'childs'            => $get_childs,
                'count'             => $count_childs,
                'classroom'         => $classroom,
                'canteen'           => $canteen,
                'daycare'           => $daycare,
                'canteen_price'     => $canteen_price,
                'daycare_price'     => $daycare_price,
            ]);
            $template_part = ob_get_contents();

        ob_end_clean();

        echo  $template_part;

    }

    /**
     * Disable the Add to Cart butto.
     *
     * @param bool $purchasable  Whether the product is purchasable.
     * @param WC_Product $product The product object.
     *
     * @return bool False
     */
    public function remove_add_to_cart($purchasable, $product)
    {

        $childs = new Childs;

        if (!is_user_logged_in()) :
            return false;
        endif;

        $get_childs = $childs->get_childs();

        if(empty($get_childs)):
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

    /**
     * Display a custom message if the user has not child.
     *
     * @return void
     */
    public function show_message_if_not_child() {

        $childs = new Childs;

        if (!is_user_logged_in())
            return;

        $get_childs = $childs->get_childs();

        if(empty($get_childs)):

            ob_start();

                load_template( UTBF_THEME_PATH . '/template-parts/woocommerce/single-product/not-childs.php',null,[]);
                $template_part = ob_get_contents();

            ob_end_clean();

            echo $template_part;

         endif;

    }


}
