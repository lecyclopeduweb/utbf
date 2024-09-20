<?php

declare (strict_types = 1);

namespace AppUtbf\Forms;

use AppUtbf\Validate\ValidateRegister;
/**
 * Register
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Register
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_action('wp_ajax_nopriv_utbf_ajax_register_form', [$this,'create_user']);
        add_action('wp_ajax_utbf_ajax_register_form', [$this,'create_user']);

    }

    /**
     * Validates form data and creates user
     *
     * @return void
     */
    public function create_user():void
    {

        $validate = new ValidateRegister;
        $error = $validate->check($_POST);
        $response = [];

        if(!empty($error)):
            $response['error'] = $error;
            echo json_encode($response);
            die;
        endif;

        $user_id = $this->process_user_creation();
        $this->user_notification($user_id);

        echo json_encode($response);
        die;

    }

    /**
     * Processes user creation after validation
     *
     * @return int|false The created user ID on success, or false on failure.
     */
    public function process_user_creation()
    {

        global $wpdb;

        $user_data = array_merge(
            $_POST,
            [
                'role'              => 'subscriber',
            ]
        );
        unset($user_data['zip-code'], $user_data['address'], $user_data['city'], $user_data['phone'], $user_data['action']);

        $user_id = wp_insert_user($user_data);

        // Return false if there is an error
        if (is_wp_error($user_id)):
            return false;
        endif;

        /**
         *
         * Informations
         *
         */
        $infos_single_fields = [
            'first_name' => 'shipping_first_name',
            'last_name'  => 'shipping_last_name'
        ];
        foreach ($infos_single_fields as $post_key => $meta_key):
            if (isset($_POST[$post_key])):
                update_user_meta($user_id, $meta_key, $_POST[$post_key]);
            endif;
        endforeach;
        $infos_double_fields = [
            'address'    => ['billing_address_1', 'shipping_address_1'],
            'city'       => ['billing_city', 'shipping_city'],
            'zip_code'   => ['billing_postcode', 'shipping_postcode'],
            'phone'      => ['billing_phone', 'shipping_phone'],
            'phone_2'    => ['billing_phone_2', 'shipping_phone_2']
        ];
        foreach ($infos_double_fields as $post_key => $meta_keys):
            if (isset($_POST[$post_key])):
                foreach ($meta_keys as $meta_key):
                    update_user_meta($user_id, $meta_key, $_POST[$post_key]);
                endforeach;
            endif;
        endforeach;
        $country = 'FR';
        update_user_meta($user_id, 'billing_country', $country);
        update_user_meta($user_id, 'shipping_country', $country);
        /**
         *
         * Legal guardian
         *
         */
        $legal_guardian_fields = [
            'user__legal_guardian__first_name',
            'user__legal_guardian__last_name',
            'user__legal_guardian__address',
            'user__legal_guardian__zip_code',
            'user__legal_guardian__city',
            'user__legal_guardian__email',
            'user__legal_guardian__phone',
            'user__legal_guardian__phone_2'
        ];
        foreach ($legal_guardian_fields as $field):
            if (isset($_POST[$field])):
                update_user_meta($user_id, $field, $_POST[$field]);
            endif;
        endforeach;
        /**
         *
         * Child
         *
         */
        $child_fields = [
            'user__child__first_name',
            'user__child__last_name',
            'user__child__classroom',
            'user__child__school',
            'user__child__other_school',
            'user__child__birthday',
            'user__child__medical_treatments',
            'user__child__specific_aspects',
            'user__child__recommendations',
            'user__child__last_name_emergency',
            'user__child__first_name_emergency',
            'user__child__phone_emergency',
        ];
        foreach ($child_fields as $field):
            if (isset($_POST[$field])):
                if($field=='user__child__medical_treatments' && $_POST['user__child__medical_treatments']=='no'):
                    continue;
                endif;
                add_user_meta($user_id, 'user__childs_repeater_0_' . $field, $_POST[$field], false);
            endif;
        endforeach;
        /**
         *
         * Repeater : nb child = 1
         *
         */
        add_user_meta($user_id, 'user__childs_repeater', 1,false);

        // Return the created user ID
        return $user_id;

    }

    /**
     * Sends notification emails after user account creation
     *
     * @param int $user_id The ID of the newly created user.
     *
     * @return void
     */
    public function user_notification(int $user_id):void
    {

        wp_new_user_notification($user_id);//Admin
        wp_new_user_notification($user_id, null, 'user');//User

    }

}
