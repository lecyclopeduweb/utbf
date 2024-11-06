<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

use AppUtbf\Validate\Phone;
/**
 * Account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Account
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        //Endpoint
        add_action('init', [$this,'add_endpoint']);
        add_action('woocommerce_account_menu_items', [$this,'add_menus']);

        //Edit childs
        add_action('woocommerce_account_edit-childs_endpoint', [$this,'render_menu_edit_childs']);

        //Edit Legal Guardia
        add_action('woocommerce_account_edit-legal-guardian_endpoint', [$this,'render_menu_edit_legal_guardian']);

        //User profile Add Billing Phone 2
        add_action('show_user_profile',[$this,'add_user_profile_billing_phone_2']);
        add_action('edit_user_profile',[$this,'add_user_profile_billing_phone_2']);

        //User profile Add Shipping Phone 2
        add_action('show_user_profile',[$this,'add_user_profile_shipping_phone_2']);
        add_action('edit_user_profile',[$this,'add_user_profile_shipping_phone_2']);

        //User profile Save Billing && Shipping Phone 2
        add_action('personal_options_update', [$this,'save_user_profile_billing_shipping_phone_2']);
        add_action('edit_user_profile_update', [$this,'save_user_profile_billing_shipping_phone_2']);

        //Account Add Billing Phone 2
        add_filter('woocommerce_billing_fields', [$this,'add_account_billing_phone_2'], 10, 1);

        //Account Add shipping Phone 2
        add_filter('woocommerce_shipping_fields', [$this,'add_account_shipping_phone_2'], 10, 1);

        //Account Validate Billing && shipping Phone 2
        add_action('woocommerce_after_save_address_validation', [$this,'validate_account_billing_shipping_phone_2'], 10, 3);

    }

    /**
     * Menu Account
     *
     * Add Endpoint
     *
     * @return void
     */
    public function add_endpoint():void
    {

        add_rewrite_endpoint( 'edit-legal-guardian', EP_ROOT | EP_PAGES );
        add_rewrite_endpoint( 'edit-childs', EP_ROOT | EP_PAGES );

    }

    /**
     * Menu Account
     *
     * Add Menus
     *
     * @param array $menu_links        The menu links on the "My Account" page.
     *
     * @return array The menu modified with the addition of a new tab.
     */
    public function add_menus(array $menu_links):array
    {

        $new_link = [
            'edit-legal-guardian'   => __('Legal guardian',UTBF_TEXT_DOMAIN) . ' 2',
            'edit-childs'           => __('My children',UTBF_TEXT_DOMAIN),
        ];
        $menu_links = array_slice( $menu_links, 0, 4, true )
                    + $new_link
                    + array_slice( $menu_links, 4, NULL, true );

        return $menu_links;

    }

    /**
     * Menu Account : Page
     *
     * Render Menu Edit Childs
     *
     * @return void
     */
    public function render_menu_edit_childs():void
    {

        $user_id = get_current_user_id();

        //Childs count
        $childs_repeater = get_field('user__childs_repeater', 'user_'.$user_id);
        $count = (!empty($childs_repeater)) ? ((is_array($childs_repeater))? count($childs_repeater) : $childs_repeater) : 0;

        //Theme settings : classroom
        $classroom = [];
		if( have_rows('theme_settings_classroom','option') ):
			while( have_rows('theme_settings_classroom','option') ) : the_row();
				$classroom[] = get_sub_field('classroom');
			endwhile;
		endif;

        //Theme settings : School
		$school = [];
		if( have_rows('theme_settings_school','option') ):
			while( have_rows('theme_settings_school','option') ) : the_row();
				$school[] = get_sub_field('school');
			endwhile;
		endif;

        ob_start();

            load_template( UTBF_THEME_PATH . '/template-parts/woocommerce/account/menu-edit-childs.php',null,[
                'user_id'       => $user_id,
                'count'         => $count,
                'classroom'    	=> $classroom,
				'school'    	=> $school,
            ]);
            $template_part = ob_get_contents();

        ob_end_clean();
        echo $template_part;

    }

    /**
     * Menu Account : Page
     *
     * Render Menu Edit Legal Guardian
     *
     * @return void
     */
    public function render_menu_edit_legal_guardian():void
    {

        $user_id = get_current_user_id();

        ob_start();

            load_template( UTBF_THEME_PATH . '/template-parts/woocommerce/account/menu-edit-legal-guardian.php',null,[
                'user_id'       => $user_id,
            ]);
            $template_part = ob_get_contents();

        ob_end_clean();
        echo $template_part;

    }

    /**
     * Add user Back End
     *
     * Add Billing Phone 2
     *
     * @param object $user    user
     *
     * @return void
     */
    public function add_user_profile_billing_phone_2($user):void
    {

        ob_start();

            load_template( UTBF_THEME_PATH . '/template-parts/admin/users/billing-phone-2.php',null,[
                'user'=>$user
            ]);
            $template_part = ob_get_contents();

        ob_end_clean();
        echo $template_part;

    }

    /**
     * Add user Back End
     *
     * Add Shipping Phone 2
     *
     * @param object $user    user
     *
     * @return void
     */
    public function add_user_profile_shipping_phone_2($user):void
    {

        ob_start();

            load_template( UTBF_THEME_PATH . '/template-parts/admin/users/shipping-phone-2.php',null,[
                'user'=>$user
            ]);
            $template_part = ob_get_contents();

        ob_end_clean();
        echo $template_part;

    }

    /**
     * Add user Back End
     *
     * Save billing && shipping Phone_2
     *
     * @param int $user_id    user_id
     *
     * @return void|bool
     */
    public function save_user_profile_billing_shipping_phone_2($user_id)
    {

        if (!current_user_can('edit_user', $user_id)):
            return false;
        endif;
        update_user_meta($user_id, 'billing_phone_2', $_POST['billing_phone_2']);
        update_user_meta($user_id, 'shipping_phone_2', $_POST['shipping_phone_2']);

    }

    /**
     * Add WooCommerce form checkout
     *
     * Add Account billing Phone_2
     *
     * @param array $fields    user_id
     *
     * @return array
     */
    public function add_account_billing_phone_2(array $fields): array
    {

        $fields['billing_phone_2'] = [
            'type'        => 'number', // Type of filed
            'label'       => __('Phone 2', UTBF_TEXT_DOMAIN), // The field label
            'required'    => false, // Is this field required?
            'class'       => ['form-row-wide'], // CSS class of the field
            'clear'       => true, // Reset flow after this field
            'priority'    => 105, // Position of the field in the form
        ];

        return $fields;

    }

    /**
     * Add WooCommerce form checkout
     *
     * Add Account shipping Phone_2
     *
     * @param array $fields    user_id
     *
     * @return array
     */
    public function add_account_shipping_phone_2(array $fields): array
    {

        $fields['shipping_phone'] = [
            'type'        => 'number', // Type of filed
            'label'       => __('Phone', UTBF_TEXT_DOMAIN), // The field label
            'required'    => true, // Is this field required?
            'class'       => ['form-row-wide'], // CSS class of the field
            'clear'       => true, // Reset flow after this field
            'priority'    => 75, // Position of the field in the form
        ];
        $fields['shipping_phone_2'] = [
            'type'        => 'number', // Type of filed
            'label'       => __('Phone 2', UTBF_TEXT_DOMAIN), // The field label
            'required'    => false, // Is this field required?
            'class'       => ['form-row-wide'], // CSS class of the field
            'clear'       => true, // Reset flow after this field
            'priority'    => 75, // Position of the field in the form
        ];

        return $fields;

    }

    /**
     * Add WooCommerce form checkout
     *
     * Validate Account billing && shipping Phone_2
     *
     * @param int    $user_id      The ID of the user whose address is being updated.
     * @param string $load_address The type of address being updated (e.g., 'billing' or 'shipping').
     * @param array  $address      The array containing the address data submitted by the user.
     *
     * @return void
     */
    public function validate_account_billing_shipping_phone_2(int $user_id, string $load_address, array $address): void
    {

        $validate = new Phone;

        if ($load_address === 'billing') :
            if (!empty($_POST['billing_phone_2'])):
                $error = $validate->error($_POST['billing_phone_2']);
                if($error):
                    wc_add_notice(__('Phone 2', UTBF_TEXT_DOMAIN).' : '.$error, 'error');
                endif;
            endif;
        endif;
        if ($load_address === 'shipping') :
            if (!empty($_POST['shipping_phone'])):
                $error = $validate->error($_POST['shipping_phone']);
                if($error):
                    wc_add_notice(__('Phone', UTBF_TEXT_DOMAIN).' : '.$error, 'error');
                endif;
            endif;
            if (!empty($_POST['shipping_phone_2'])):
                $error = $validate->error($_POST['shipping_phone_2']);
                if($error):
                    wc_add_notice( __('Phone 2', UTBF_TEXT_DOMAIN).' : '.$error, 'error');
                endif;
            endif;
        endif;

    }

}
