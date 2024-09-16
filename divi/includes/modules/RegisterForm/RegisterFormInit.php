<?php
/**
 * Init
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @since 1.0.0
 */
function init_utbf_register_form( $module ) {

    $module->name = __( 'UTBF Register form', UTBF_TEXT_DOMAIN );
    $module->icon_path = plugin_dir_path( __FILE__ ) . 'icon.svg';
    $module->settings_modal_toggles = array(
        'general' => array(
            'toggles' => array(
                'main_content' => __( 'Text', UTBF_TEXT_DOMAIN ),
            ),
        ),
    );
}