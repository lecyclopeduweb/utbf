<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

/**
 * Checkout
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Checkout
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {


        //Childs Item Datas
        add_action('woocommerce_checkout_create_order_line_item', [$this,'save_data_in_order'], 10, 4);

        //Consent
        add_action('woocommerce_review_order_before_submit', [$this, 'add_consent']);
        add_action('woocommerce_checkout_process', [$this, 'validate_consent']);
        add_action('woocommerce_checkout_update_order_meta', [$this, 'save_consent']);
        add_action('woocommerce_thankyou', [$this, 'display_consent_order'], 10, 1);
        add_action('woocommerce_admin_order_data_after_order_details', [$this, 'display_consent_order'], 10, 1);

    }

    /**
     * Childs Item Datas
     *
     * Save custom data to order item meta.
     *
     * @param WC_Order_Item_Product $item         The order item object.
     * @param string                $cart_item_key The unique cart item key.
     * @param array                 $values       The cart item data array.
     * @param WC_Order              $order        The order object.
     *
     * @return void
     */
    function save_data_in_order($item, $cart_item_key, $values, $order): void
    {

        if (isset($values['childs']) && is_array($values['childs'])):
            foreach ($values['childs'] as $key => $child):

                if (is_array($child)):

                    $item->update_meta_data( $child['name'],  $child['classroom'] );

                    if(!empty($child['canteen'])):
                        $implode_canteen = '<ul>';
                        foreach ($child['canteen'] as $canteen):
                             $implode_canteen .= '<li>' . $canteen . '</li>';
                        endforeach;
                        $implode_canteen .= '</ul>';
                        $item->update_meta_data(__('Canteen', UTBF_TEXT_DOMAIN) . ' ' . __('child', UTBF_TEXT_DOMAIN) . ' ' . ($key+1),  $implode_canteen);
                    endif;

                    if(!empty($child['daycare'])):
                        $implode_daycare = '<ul>';
                        foreach ($child['daycare'] as $daycare):
                             $implode_daycare.= '<li>' . $daycare . '</li>';
                        endforeach;
                        $implode_daycare .= '</ul>';
                        $item->update_meta_data(__('Daycare', UTBF_TEXT_DOMAIN) . ' ' . __('child', UTBF_TEXT_DOMAIN) . ' ' . ($key+1),  $implode_daycare);
                    endif;

                    $item->update_meta_data( __('Emergency contact person', UTBF_TEXT_DOMAIN) . ' ' . __('child', UTBF_TEXT_DOMAIN) . ' ' . ($key+1),  $child['first_name_emergency'] . ' ' . $child['last_name_emergency'] . ' / ' . $child['phone_emergency'] );

                endif;

            endforeach;
        endif;

    }

    /**
     * Consent Checkboxs
     *
     * Adds a consent checkbox on the checkout page
     *
     * @return void
     */
    public function add_consent():void
    {

        ob_start();

            get_template_part( 'template-parts/woocommerce/checkout/consent',null, []);
            $template_part = ob_get_contents();

        ob_end_clean();

        echo $template_part;

    }

    /**
     * Consent Checkboxs
     *
     * Validate that the checkbox is checked before placing the order.
     *
     * @return void
     */
    public function validate_consent():void
    {

        if (empty($_POST['consent-blog']) || empty($_POST['consent-communication'])) :

            $notice =  __( 'Error', UTBF_TEXT_DOMAIN ).' : ';
            $notice .=  __( 'Consent not selected.' , UTBF_TEXT_DOMAIN );
            wc_add_notice($notice, 'error');

        endif;

    }

    /**
     * Consent Checkboxs
     *
     * Saves the value of the checkbox in the command metadata.
     *
     * @param int $order_id The order ID.
     *
     * @return void
     */
    public function save_consent($order_id): void
    {

        if (!empty($_POST['consent-blog'])) :
            update_post_meta($order_id, 'consent_blog', $_POST['consent-blog']);
        endif;

        if (!empty($_POST['consent-communication'])) :
            update_post_meta($order_id, 'consent_communication', $_POST['consent-communication']);
        endif;

    }

    /**
     * Consent Checkboxs
     *
     * Shows the status of the checkbox in the order summary.
     *
     * @param int $order_id The order ID.
     *
     * @return void
     */
    public function display_consent_order($order_id): void
    {

        $admin_template = false;

        if (is_object($order_id)):
            $admin_template = true;
            $order_id = $order_id->get_id();
        endif;

        $consent_blog = get_post_meta($order_id, 'consent_blog', true);
        $consent_communication = get_post_meta($order_id, 'consent_communication', true);

        ob_start();

            get_template_part( 'template-parts/woocommerce/order/consent',null, [
               'consent-blog'               => $consent_blog,
               'consent-communication'      => $consent_communication,
               'admin-template'             => $admin_template,
            ]);
            $template_part = ob_get_contents();

        ob_end_clean();

        echo $template_part;

    }

}