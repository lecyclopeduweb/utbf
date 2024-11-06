<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

use AppUtbf\Users\Childs;
/**
 * Notice
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Notice
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_filter('woocommerce_add_to_cart_validation', [$this, 'notice_childs_account_empty'], 10, 3);
        add_filter('woocommerce_add_to_cart_validation', [$this, 'notice_childs_selected'], 10, 3);
        add_filter('woocommerce_add_to_cart_validation', [$this, 'notice_classrooms_selected'], 10, 3);
        add_filter('woocommerce_add_to_cart_validation', [$this, 'notice_classrooms_authorized'], 10, 3);
        add_filter('woocommerce_add_to_cart_validation', [$this, 'notice_emergency'], 10, 3);
        add_filter('woocommerce_add_to_cart_validation', [$this, 'notice_child_already_in_cart'], 10, 3);
        add_filter('woocommerce_add_to_cart_validation', [$this, 'notice_child_already_in_orders'], 10, 3);

    }

    /**
     * Notice Empty Childs in account
     *
     * @param bool $passed Whether the validation has passed.
     * @param int $product_id The ID of the product being added to the cart.
     * @param int $quantity The quantity of the product being added.
     *
     * @return bool
     */
    public function notice_childs_account_empty($passed, $product_id, $quantity):bool
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

    /**
     * Notice Selected Childs
     *
     * @param bool $passed Whether the validation has passed.
     * @param int $product_id The ID of the product being added to the cart.
     * @param int $quantity The quantity of the product being added.
     *
     * @return bool
     */
    public function notice_childs_selected($passed, $product_id, $quantity):bool
    {

        if (isset($_POST['childs'])) :
            $childs = $_POST['childs'];

            //Check all child select
            foreach ($childs as $child) :
                if (empty($child['name'])) :

                    $notice =  __( 'Error', UTBF_TEXT_DOMAIN ).' : ';
                    if(count($_POST['childs'])>1):
                        $notice .=  __( 'You have not selected all children.' , UTBF_TEXT_DOMAIN );
                    else:
                        $notice .=  __( 'You have not selected your child.' , UTBF_TEXT_DOMAIN );
                    endif;
                    wc_add_notice($notice, 'error');
                    return false;

                endif;
            endforeach;


            //Check name
            $names = [];
            foreach ($childs as $item):
                $names[] = $item['name'];
            endforeach;

            $same_names = array_count_values($names);
            foreach ($same_names as $name) :
                if ($name > 1) :

                    $notice =  __( 'Error', UTBF_TEXT_DOMAIN ).' : ';
                    $notice .=  __( 'You must select different children.' , UTBF_TEXT_DOMAIN );
                    wc_add_notice($notice, 'error');
                    return false;

                endif;
            endforeach;

        else:

            $notice =  __( 'Error', UTBF_TEXT_DOMAIN ).' : ';
            $notice .=  __( 'No children selected.' , UTBF_TEXT_DOMAIN );
            wc_add_notice($notice, 'error');
            return false;

        endif;

        return $passed;
    }

    /**
     * Notice Selected Classrooms
     *
     * @param bool $passed Whether the validation has passed.
     * @param int $product_id The ID of the product being added to the cart.
     * @param int $quantity The quantity of the product being added.
     *
     * @return bool
     */
    public function notice_classrooms_selected($passed, $product_id, $quantity):bool
    {

        if (isset($_POST['childs'])) :
            $childs = $_POST['childs'];

            foreach ($childs as $child) :
                if (empty($child['classroom'])) :

                    $notice =  __( 'Error', UTBF_TEXT_DOMAIN ).' : ';
                    $notice .=  __( 'You must select a school for each child.' , UTBF_TEXT_DOMAIN );
                    wc_add_notice($notice, 'error');
                    return false;

                endif;
            endforeach;

        endif;

        return $passed;
    }

    /**
     * Notice Classrooms Authorized
     *
     * @param bool $passed Whether the validation has passed.
     * @param int $product_id The ID of the product being added to the cart.
     * @param int $quantity The quantity of the product being added.
     *
     * @return bool
     */
    public function notice_classrooms_authorized($passed, $product_id, $quantity):bool
    {

        if (isset($_POST['childs'])) :

            $childs = $_POST['childs'];
            $classroom_authorized = get_post_meta($product_id, 'classroom_products_meta_box', true);

            if(!empty($classroom_authorized)):
                foreach ($childs as $child) :
                    if (!empty($child['classroom'])) :

                        if(empty($classroom_authorized[sanitize_title($child['classroom'])])):
                            $notice =  __( 'Error', UTBF_TEXT_DOMAIN ).' : ';
                            $notice .=  __( 'This product does not allow the addition of the class' , UTBF_TEXT_DOMAIN ). ' ';
                            $notice .=  $child['classroom'];
                            wc_add_notice($notice, 'error');
                            return false;
                        endif;

                    endif;
                endforeach;
            endif;

        endif;

        return $passed;
    }

    /**
     * Notice Emergency
     *
     * @param bool $passed Whether the validation has passed.
     * @param int $product_id The ID of the product being added to the cart.
     * @param int $quantity The quantity of the product being added.
     *
     * @return bool
     */
    public function notice_emergency($passed, $product_id, $quantity):bool
    {

        if (isset($_POST['childs'])) :
            $childs = $_POST['childs'];

            foreach ($childs as $child) :
                if (
                    empty($child['last_name_emergency'])
                    ||
                    empty($child['first_name_emergency'])
                    ||
                    empty($child['phone_emergency'])
                ) :

                    $notice =  __( 'Error', UTBF_TEXT_DOMAIN ).' : ';
                    $notice .=  __( 'You must complete the contact details of the person to be notified in the event of an emergency for each child.' , UTBF_TEXT_DOMAIN );
                    wc_add_notice($notice, 'error');
                    return false;

                endif;
            endforeach;

        endif;

        return $passed;
    }

    /**
     * Notice Child is already in cart
     *
     * @param bool $passed Whether the validation has passed.
     * @param int $product_id The ID of the product being added to the cart.
     * @param int $quantity The quantity of the product being added.
     *
     * @return bool
     */
    public function notice_child_already_in_cart($passed, $product_id, $quantity):bool
    {

        if ( WC()->cart ) :
            if (isset($_POST['childs'])) :

                $cart = WC()->cart;

                //Get Names of Childs $_POST
                $post_childs = $_POST['childs'];
                $post_childs_names = array_column($post_childs, 'name');

                foreach ( $cart->get_cart() as $cart_item_key => $cart_item ):

                    if($product_id ==  $cart_item['product_id']):

                        //Get Names of Childs cart_item
                        $cart_item_childs_names = array_column($cart_item['childs'], 'name');

                        //Matching Names
                        $matching_names = array_intersect($post_childs_names, $cart_item_childs_names);

                        if (!empty($matching_names)):

                            $notice =  __( 'Error', UTBF_TEXT_DOMAIN ).' : ';
                            $notice .=  __( 'A child is added in the same product in the cart.' , UTBF_TEXT_DOMAIN );
                            wc_add_notice($notice, 'error');
                            return false;

                        endif;

                    endif;

                endforeach;

            endif;
        endif;

        return $passed;

    }

    /**
     * Notice Child is already in Orders
     *
     * @param bool $passed Whether the validation has passed.
     * @param int $product_id The ID of the product being added to the cart.
     * @param int $quantity The quantity of the product being added.
     *
     * @return bool
     */
    public function notice_child_already_in_orders($passed, $product_id, $quantity):bool
    {


        $childs = $_POST['childs'];

        $args = [
            'customer_id' => get_current_user_id( ),
            'status'      => array('wc-completed', 'wc-processing'),
            'limit'       => -1
        ];

        $orders = wc_get_orders($args);

        foreach ($orders as $order) :

            $items = $order->get_items();
            foreach ($items as $item_id => $item) :

                foreach($childs as $child):

                    $meta_value = $item->get_meta($child['name']);
                    if($meta_value!=''):

                        $notice =  __( 'Error', UTBF_TEXT_DOMAIN ).' : ';
                        $notice .=  __( 'A child is added in the same product in the orders.' , UTBF_TEXT_DOMAIN );
                        wc_add_notice($notice, 'error');
                        return false;
                    endif;
                endforeach;
            endforeach;
        endforeach;

        return $passed;

    }

}