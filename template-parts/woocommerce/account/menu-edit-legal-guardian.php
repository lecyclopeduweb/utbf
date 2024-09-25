<?php
/**
 * Menu Edit Legal Guardian
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args              Args
 */
?>
<div class="woocommerce-message-error">
    <?=  __( 'Your form contains errors', UTBF_TEXT_DOMAIN ); ?>
</div>
<div class="woocommerce-message-error-ajax">
    <?=  __( 'Ajax registration has a problem. Please contact the site administrator', UTBF_TEXT_DOMAIN ); ?>
</div>
<form id="woocommerce-EditLegalGuardianAccountForm" class="edit-account" method="post" action="">

    <div class="utbf-form__row">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_first_name']))? $args['props']['label_legal_guardian_first_name'] : __('First name',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user__legal_guardian__first_name" value="<?= get_user_meta($args['user_id'], 'user__legal_guardian__first_name',true); ?>">
            <div class="error user__legal_guardian__first_name"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_last_name']))? $args['props']['label_legal_guardian_last_name'] : __('Last name',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user__legal_guardian__last_name" value="<?= get_user_meta($args['user_id'], 'user__legal_guardian__last_name',true); ?>">
            <div class="error user__legal_guardian__last_name"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__full-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_address']))? $args['props']['label_legal_guardian_address'] : __('Address',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user__legal_guardian__address" value="<?= get_user_meta($args['user_id'], 'user__legal_guardian__address',true); ?>">
            <div class="error user__legal_guardian__address"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_zip_code']))? $args['props']['label_legal_guardian_zip_code'] : __('Zip code',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="number" name="user__legal_guardian__zip_code" value="<?= get_user_meta($args['user_id'], 'user__legal_guardian__zip_code',true); ?>">
            <div class="error user__legal_guardian__zip_code"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_city']))? $args['props']['label_legal_guardian_city'] : __('City',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user__legal_guardian__city" value="<?= get_user_meta($args['user_id'], 'user__legal_guardian__city',true); ?>">
            <div class="error user__legal_guardian__city"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_phone']))? $args['props']['label_legal_guardian_phone'] : __('Phone',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="number" name="user__legal_guardian__phone" value="<?= get_user_meta($args['user_id'], 'user__legal_guardian__phone',true); ?>">
            <div class="error user__legal_guardian__phone"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_phone_2']))? $args['props']['label_legal_guardian_phone_2'] : __('Phone 2',UTBF_TEXT_DOMAIN); ?>
            </label>
            <input type="number" name="user__legal_guardian__phone_2" value="<?= get_user_meta($args['user_id'], 'user__legal_guardian__phone_2',true); ?>">
            <div class="error user__legal_guardian__phone_2"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__full-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_email']))? $args['props']['label_legal_guardian_email'] : __('Email',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="email" name="user__legal_guardian__email" value="<?= get_user_meta($args['user_id'], 'user__legal_guardian__email',true); ?>">
            <div class="error user__legal_guardian__email"></div>
        </div>
    </div>
    <button id="EditLegalGuardianAccountForm-send" type="button" class="space-mt-20 woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
</form>
