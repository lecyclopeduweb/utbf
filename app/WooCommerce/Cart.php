<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

use AppUtbf\Users\Childs;
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

        add_filter('woocommerce_add_to_cart_validation', [$this, 'validation_users_get_childs'], 10, 3);

    }

    /**
     * User Form
     *
     * @param bool $passed Whether the validation has passed.
     * @param int $product_id The ID of the product being added to the cart.
     * @param int $quantity The quantity of the product being added.
     *
     * @return bool Whether the product can be added to the cart.
     */
    public function validation_users_get_childs($passed, $product_id, $quantity):bool
    {

        $childs = new Childs;
        $get_childs = $childs->get_childs();

        if(empty($get_childs)):

            $my_account_url = wc_get_page_permalink('myaccount');

            $notice =  __( 'Error', UTBF_TEXT_DOMAIN ).' : ';
            $notice .=  __( 'You do not have any children attached to your account. Please add one.' , UTBF_TEXT_DOMAIN );
            $notice .=  '<br>';
            $notice .=  __( "Go to your children's section account" , UTBF_TEXT_DOMAIN ).'. ';
            $notice .=  '<a style="color:white" href="'.$my_account_url.'edit-childs/">'. __( 'Go to my account' , UTBF_TEXT_DOMAIN ) . '</a>';

            wc_add_notice($notice , 'error');
            return false;

        endif;

        return $passed;

    }

}