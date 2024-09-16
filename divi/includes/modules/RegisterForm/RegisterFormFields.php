<?php
/**
 * Fields
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @since 1.0.0
 */
function get_fields_utbf_register_form() {
    return array(
        'label_first_name' => array(
            'label'           => __( 'Label first name', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_last_name' => array(
            'label'           => __( 'Label last name', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_address' => array(
            'label'           => __( 'Label address', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_zip_code' => array(
            'label'           => __( 'Label zip code', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_city' => array(
            'label'           => __( 'Label city', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_phone' => array(
            'label'           => __( 'Label phone', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_mail' => array(
            'label'           => __( 'Label mail', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'text_button' => array(
            'label'           => __( 'Text Button', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
    );
}