<?php

declare (strict_types = 1);

namespace AppUtbf\Forms;

use AppUtbf\Validate\ValidateEditLegalGuardian;
/**
 * Legal Guardian Account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class LegalGuardianAccount
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_action('wp_ajax_nopriv_utbf_ajax_legal_guardian_account_form', [$this,'ajax']);
        add_action('wp_ajax_utbf_ajax_legal_guardian_account_form', [$this,'ajax']);

    }

    /**
     * Ajax
     *
     * @return void
     */
    public function ajax():void
    {

        //Init
        $response = [];

        //Validate
        $error = $this->validate();
        if(!empty($error)):
            $response['error'] = $error;
            echo json_encode($response);
            die;
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
        $validate = new ValidateEditLegalGuardian;
        return $validate->check($post);
    }


}
