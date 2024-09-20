<?php

declare (strict_types = 1);

namespace AppUtbf\Forms;

use AppUtbf\Validate\ValidateEditChilds;
/**
 * ChildsAccount
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

        add_action('wp_ajax_nopriv_utbf_ajax_childs_account_form', [$this,'validate']);
        add_action('wp_ajax_utbf_ajax_childs_account_form', [$this,'validate']);

        add_action('template_redirect', [$this,'save_account_childs'] );
        add_action('wp_loaded', [$this,'wc_add_notice'] );

    }

    /**
     * Validate
     *
     * @return void
     */
    public function validate()
    {

        //Init
        $post = $_POST;
        $validate = new ValidateEditChilds;
        $response = [];

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

        //errors
        $errors = $validate->check($post);
        if(!empty($errors)):
            $response['error'] = $validate->check($post);
        endif;

        echo json_encode($response);
        die;

    }

     /**
     * Save Account Childs
     *
     * @return void
     */
    public function save_account_childs():void
    {

        if ( isset( $_POST['action'] ) && $_POST['action'] === 'save_childs_account' ):

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

            //Message Success
            WC()->session->set( 'success', __( 'Your form has been submitted successfully', UTBF_TEXT_DOMAIN ) );

        endif;

    }

    /**
     * Add Notice
     *
     * @return void
     */
    public function wc_add_notice():void
    {
        if (WC()->session && WC()->session->get('success')):
            wc_add_notice(WC()->session->get('success'), 'success');
            WC()->session->set('success', null);
        endif;

    }



}
