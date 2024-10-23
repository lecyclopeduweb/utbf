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
        add_filter('woocommerce_add_to_cart_validation', [$this, 'notice_emergency'], 10, 3);
        add_filter('woocommerce_add_to_cart_validation', [$this, 'notice_consent'], 10, 3);

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
     * Notice Consent
     *
     * @param bool $passed Whether the validation has passed.
     * @param int $product_id The ID of the product being added to the cart.
     * @param int $quantity The quantity of the product being added.
     *
     * @return bool
     */
    public function notice_consent($passed, $product_id, $quantity):bool
    {

        if (empty($_POST['consent-blog']) || empty($_POST['consent-communication'])) :

            $notice =  __( 'Error', UTBF_TEXT_DOMAIN ).' : ';
            $notice .=  __( 'Consent not selected.' , UTBF_TEXT_DOMAIN );
            wc_add_notice($notice, 'error');
            return false;

        endif;

        return $passed;
    }

}