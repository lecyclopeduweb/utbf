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

       add_action('woocommerce_before_add_to_cart_button', [$this, 'user_form']);

    }


    /**
     * User Form
     *
     * @return void
     */
    public function user_form():void
    {

        $post_id = get_the_ID();

        $childs = new Childs;
        $get_childs = $childs->get_childs();

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

            get_template_part( 'template-parts/woocommerce/single-product/user-form',null,[
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

}
