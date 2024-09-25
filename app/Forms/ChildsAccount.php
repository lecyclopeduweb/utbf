<?php

declare (strict_types = 1);

namespace AppUtbf\Forms;

use AppUtbf\Validate\ValidateEditChilds;
/**
 * Childs Account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class ChildsAccount
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_action('wp_ajax_nopriv_utbf_ajax_childs_account_form', [$this,'ajax']);
        add_action('wp_ajax_utbf_ajax_childs_account_form', [$this,'ajax']);

        add_action('wp_loaded', [$this,'wc_add_notice'] );

    }

    /**
     * Ajax
     *
     * @return void
     */
    public function ajax():void
    {

        //Init
        $user_id = get_current_user_id();
        $response = [];

        //Validate
        $error = $this->validate();
        if(!empty($error)):
            $response['error'] = $error;
            echo json_encode($response);
            die;
        endif;

        //Delete
        $user__childs_repeater = get_user_meta($user_id, 'user__childs_repeater',true);
        if($user__childs_repeater > $_POST['user__childs_repeater']):
            $this->delete();
        endif;

        //update
        $this->update();

        // Set success message in WooCommerce session
        if (class_exists( 'WooCommerce' )):
            if (WC()->session) :
                WC()->session->set('success', __( 'Your form has been submitted successfully', UTBF_TEXT_DOMAIN ));
            endif;
        endif;
        $response['success'] = true;
        echo json_encode($response);
        die;
    }

    /**
     * Delete
     *
     * @return void
     */
    public function delete():void
    {

        //init
        global $wpdb;
        $user_id = get_current_user_id();
        $user__childs_repeater = get_user_meta($user_id, 'user__childs_repeater',true);

        //DataBase
        $table_name = $wpdb->usermeta;

        //iteration
        $lengt = ($user__childs_repeater - $_POST['user__childs_repeater']);
        $start = $_POST['user__childs_repeater'];

        for ($i = 0; $i < $lengt; $i++) {

            $nb_delete = $start + $i;
            $meta_key = 'user__childs_repeater_' . $nb_delete . '%';
            //Request
            $wpdb->query(
                $wpdb->prepare(
                    "DELETE FROM $table_name WHERE meta_key LIKE %s",
                    $meta_key
                )
            );
        }

    }

    /**
     * Update
     *
     * @return void
     */
    public function update():void
    {
        //Init
        $post = $_POST;
        $user_id = get_current_user_id();

        //Unset
        unset($post['action']);

        //update_user_meta
        foreach($post as $key => $value):
            if (strpos($key, 'medical_treatments') !== false):
                $value = ($value == 'yes')? 1 : 0;
            endif;
            update_user_meta( $user_id, $key, $value );
        endforeach;
    }

    /**
     * Validate
     *
     * @return array
     */
    public function validate():array
    {

        //Init
        $post = $_POST;
        $validate = new ValidateEditChilds;

        //Unset
        unset($post['action']);
        unset($post['user__childs_repeater']);
        foreach($post as $key => $value):
            if (strpos($key, 'school') !== false):
                if($value != 'Autre'):
                    $repeater = str_replace('user__child__school', '', $key);
                    unset($post[$repeater.'user__child__other_school']);
                endif;
            endif;
        endforeach;

        return $validate->check($post);
    }

    /**
     * Add Notice
     *
     * @return void
     */
    public function wc_add_notice():void
    {

        if (class_exists( 'WooCommerce' )):
            if (strpos(UTBF_CURRENT_URL, wc_get_account_endpoint_url('edit-childs')) !== false):
                //empty
                $notices = wc_get_notices();
                $user_id = get_current_user_id();
                $user__childs_repeater = get_user_meta($user_id, 'user__childs_repeater',true);
                $has_childs = (!empty($user__childs_repeater))? (($user__childs_repeater!='0')? true : false): false;
                if(!$has_childs && !$notices):
                    wc_add_notice(__('No children attached to the account', UTBF_TEXT_DOMAIN), 'notice');
                endif;
            endif;
        endif;

    }

}
