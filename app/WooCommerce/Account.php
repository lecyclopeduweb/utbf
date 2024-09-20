<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

use AppUtbf\Validate\ValidateEditChilds;
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

        add_action('init', [$this,'add_endpoint']);
        //add_action('init', [$this,'session_start'], 1 );
        add_action('woocommerce_account_menu_items', [$this,'add_menus']);
        add_action('woocommerce_account_edit-childs_endpoint', [$this,'render_menu_edit_childs']);
        add_action('template_redirect', [$this,'save_account_childs'] );

    }

    /**
     * Add Endpoint
     *
     * @return void
     */
    public function add_endpoint():void
    {

        add_rewrite_endpoint( 'edit-childs', EP_ROOT | EP_PAGES );

    }

    /**
     * Add Menus
     *
     * @param array $menu_links        The menu links on the "My Account" page.
     *
     * @return array The menu modified with the addition of a new tab.
     */
    public function add_menus(array $menu_links):array
    {

        $new_link = [
            'edit-childs' => __('Childs',UTBF_TEXT_DOMAIN),
        ];
        $menu_links = array_slice( $menu_links, 0, 5, true )
                    + $new_link
                    + array_slice( $menu_links, 5, NULL, true );

        return $menu_links;

    }

    /**
     * Render Menu Edit Childs
     *
     * @return void
     */
    public function render_menu_edit_childs():void
    {

        $user_id = get_current_user_id();

        //Childs count
        $childs_repeater = get_field('user__childs_repeater', 'user_'.$user_id);
        $count = (!empty($childs_repeater)) ? count(get_field('user__childs_repeater', 'user_'.$user_id)) : 0;

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

            load_template( UTBF_THEME_PATH . '/template-parts/admin/account/menu-edit-childs.php',null,[
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
     * Save Account Childs
     *
     * @return void
     */
    public function save_account_childs():void
    {

        if ( isset( $_POST['action'] ) && $_POST['action'] === 'save_account_childs' ):

            //Init
            $validate = new ValidateEditChilds;
            $user_id = get_current_user_id();

            //Unset
            unset($_POST['save_account_details']);
            unset($_POST['action']);
            foreach($_POST as $key => $value):
                if (strpos($key, 'school') !== false):
                    if($value != 'Autre'):
                        $repeater = str_replace('user__child__school', '', $key);
                        unset($_POST[$repeater.'user__child__other_school']);
                    endif;
                endif;
            endforeach;

            //Validate
            if($validate->check($_POST));
            if(!empty( WC()->session->get( 'form_errors', [] ))):
                wc_add_notice( __( 'Your form contains errors',UTBF_TEXT_DOMAIN ), 'error' );
                return;
            endif;

            foreach($_POST as $key => $value):
                if (strpos($key, 'medical_treatments') !== false):
                    $value = ($value == 'yes')? 1 : 0;
                endif;
                update_user_meta( $user_id, $key, $value );
            endforeach;

            //Results
            wc_add_notice( __( 'Your form has been submitted successfully', UTBF_TEXT_DOMAIN ), 'success' );

        endif;

    }

    /**
     * Session start
     *
     * @return void
     */
    public function session_start():void
    {

        if ( !session_id() ) :
            session_start();
        endif;

    }

}
