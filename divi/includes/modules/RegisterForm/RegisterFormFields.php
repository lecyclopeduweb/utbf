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
        /**
         *
         * Informations
         *
         */
        'title_informations' => array(
            'label'           => __( 'Title informations', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_user_login' => array(
            'label'           => __( 'Label login', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_password' => array(
            'label'           => __( 'Label password', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
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
        'label_phone_2' => array(
            'label'           => __( 'Label phone 2', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_user_email' => array(
            'label'           => __( 'Label email', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        /**
         *
         * Legal guardian
         *
         */
        'title_legal_guardian' => array(
            'label'           => __( 'Title legal guardian', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_legal_guardian_first_name' => array(
            'label'           => __( 'Label legal guardian first name', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_legal_guardian_last_name' => array(
            'label'           => __( 'Label legal guardian last name', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_legal_guardian_address' => array(
            'label'           => __( 'Label legal guardian address', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_legal_guardian_zip_code' => array(
            'label'           => __( 'Label legal guardian zip code', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_legal_guardian_city' => array(
            'label'           => __( 'Label legal guardian city', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_legal_guardian_phone' => array(
            'label'           => __( 'Label legal guardian phone', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_legal_guardian_phone_2' => array(
            'label'           => __( 'Label legal guardian phone 2', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_legal_guardian_email' => array(
            'label'           => __( 'Label legal guardian email', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        /**
         *
         * Child
         *
         */
        'title_child' => array(
            'label'           => __( 'Title child', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'infos_bloc_child' => array(
            'label'           => __( 'Infos bloc child', UTBF_TEXT_DOMAIN ),
            'type'            => 'textarea',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_child_first_name' => array(
            'label'           => __( 'Label first name child', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_child_last_name' => array(
            'label'           => __( 'Label last name child', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_child_classroom' => array(
            'label'           => __( 'Label classroom child', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_child_school' => array(
            'label'           => __( 'Label school child', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_child_other_school' => array(
            'label'           => __( 'Label other school child', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_child_birthday' => array(
            'label'           => __( 'Label birthday child', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_child_medical_treatments' => array(
            'label'           => __( 'Label medical treatments child', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_child_specific_aspects' => array(
            'label'           => __( 'Label specific aspects child', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_child_recommendations' => array(
            'label'           => __( 'Label recommendations child', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        /**
         *
         * Emergency
         *
         */
        'title_emergency' => array(
            'label'           => __( 'Title emergency', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_emergency_first_name' => array(
            'label'           => __( 'Label emergency first name', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_emergency_last_name' => array(
            'label'           => __( 'Label emergency last name', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        'label_emergency_phone' => array(
            'label'           => __( 'Label emergency phone', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
        /**
         *
         * Button
         *
         */
        'text_button' => array(
            'label'           => __( 'Text button', UTBF_TEXT_DOMAIN ),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => '',
            'toggle_slug'     => 'main_content',
        ),
    );
}