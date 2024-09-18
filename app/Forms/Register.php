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
     * This method handles the user creation process by validating the form data,
     * creating the user if the data is valid, and sending notifications.
     * It responds with errors if the validation fails or completes the user
     * creation process and sends notifications if the data is valid.
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
     * This method takes user input, validates it, assigns a default role,
     * and inserts a new user into the WordPress database. It returns the
     * created user's ID or false in case of a failure.
     *
     * @return int|false The created user ID on success, or false on failure.
     */
    public function process_user_creation()
    {

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

        // Add additional WooCommerce user meta data
        if (isset($_POST['first_name'])):
            update_user_meta($user_id, 'shipping_first_name', $_POST['first_name']);
        endif;
        if (isset($_POST['last_name'])):
            update_user_meta($user_id, 'shipping_last_name', $_POST['last_name']);
        endif;
        if (isset($_POST['address'])):
            update_user_meta($user_id, 'billing_address_1', $_POST['address']);
            update_user_meta($user_id, 'shipping_address_1', $_POST['address']);
        endif;
        if (isset($_POST['city'])):
            update_user_meta($user_id, 'billing_city', $_POST['city']);
            update_user_meta($user_id, 'shipping_city', $_POST['city']);
        endif;
        if (isset($_POST['zip_code'])):
            update_user_meta($user_id, 'billing_postcode', $_POST['zip_code']);
            update_user_meta($user_id, 'shipping_postcode', $_POST['zip_code']);
        endif;
        if (isset($_POST['phone'])):
            update_user_meta($user_id, 'billing_phone', $_POST['phone']);
            update_user_meta($user_id, 'shipping_phone', $_POST['phone']);
        endif;
        if (isset($_POST['phone_2'])):
            update_user_meta($user_id, 'billing_phone_2', $_POST['phone_2']);
            update_user_meta($user_id, 'shipping_phone_2', $_POST['phone_2']);
        endif;

        $country = 'FR';
        update_user_meta($user_id, 'billing_country', $country);
        update_user_meta($user_id, 'shipping_country', $country);

        // Return the created user ID
        return $user_id;

    }

    /**
     * Sends notification emails after user account creation
     *
     * This method triggers the default WordPress notifications
     * that are sent after a user account has been created.
     * It sends an email to the administrator as well as the newly
     * registered user.
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
