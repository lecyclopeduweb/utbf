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
        'title' => array(
            'label'           => __( 'Title', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => __( 'Text entered here will appear as title.', UTBF_TEXT_DOMAIN ),
            'toggle_slug'     => 'main_content',
        ),
    );
}