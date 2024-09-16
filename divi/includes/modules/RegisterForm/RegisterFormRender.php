<?php
/**
 * Render
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args      Args
 *
 * @since 1.0.0
 */
if(empty($args))
    return;
?>
<form class="utbf-form" id="utbf-register-form" method="post" action="">
    <div class="utbf-form__row">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_first_name']))? $args['props']['label_first_name'] : __('First name',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="first-name" value="">
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_last_name']))? $args['props']['label_last_name'] : __('Last name',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="last-name" value="">
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__full-col">
            <label>
                <?= (!empty($args['props']['label_address']))? $args['props']['label_address'] : __('Address',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="address" value="">
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_zip_code']))? $args['props']['label_zip_code'] : __('Zip code',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="zip-code" value="">
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_city']))? $args['props']['label_city'] : __('City',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="city" value="">
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_phone']))? $args['props']['label_phone'] : __('Phone',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="phone" value="">
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_mail']))? $args['props']['label_mail'] : __('Mail',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="mail" value="">
        </div>
    </div>
    <div class="utbf-form__row justify-content-center align-items-center space-mt-30">
        <div class="button button-primary button-large">
            <?= (!empty($args['props']['text_button']))? $args['props']['text_button'] : __('Register',UTBF_TEXT_DOMAIN); ?>
        </div>
    </div>
</form>