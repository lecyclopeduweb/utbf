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
                <?= (!empty($args['props']['label_user_login']))? $args['props']['label_user_login'] : __('Login',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user_login" value="">
            <div class="error user_login"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_password']))? $args['props']['label_password'] : __('Password',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="password" name="password" value="">
            <div class="error password"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_first_name']))? $args['props']['label_first_name'] : __('First name',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="first_name" value="">
            <div class="error first_name"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_last_name']))? $args['props']['label_last_name'] : __('Last name',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="last_name" value="">
            <div class="error last_name"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__full-col">
            <label>
                <?= (!empty($args['props']['label_address']))? $args['props']['label_address'] : __('Address',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="address" value="">
            <div class="error address"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_zip_code']))? $args['props']['label_zip_code'] : __('Zip code',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="number" name="zip-code" value="">
            <div class="error zip-code"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_city']))? $args['props']['label_city'] : __('City',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="city" value="">
            <div class="error city"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_phone']))? $args['props']['label_phone'] : __('Phone',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="number" name="phone" value="">
            <div class="error phone"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_phone_2']))? $args['props']['label_phone_2'] : __('Phone 2',UTBF_TEXT_DOMAIN); ?>
            </label>
            <input type="number" name="phone_2" value="">
            <div class="error phone_2"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__full-col">
            <label>
                <?= (!empty($args['props']['label_user_email']))? $args['props']['label_user_email'] : __('Email',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="email" name="user_email" value="">
            <div class="error user_email"></div>
        </div>
    </div>
    <div class="utbf-form__row justify-content-center align-items-center space-mt-30">
        <div id="utbf-register-form-send" class="button button-primary button-large">
            <?= (!empty($args['props']['text_button']))? $args['props']['text_button'] : __('Register',UTBF_TEXT_DOMAIN); ?>
        </div>
    </div>
    <div class="loader-overlay"></div>
    <div class="wrapper-loader">
        <div class="loader">
            <?= file_get_contents(UTBF_IMG_URI . '/loader.svg'); ?>
        </div>
    </div>
</form>
<div id="utbf-register-form-success" class="align-items-center justify-content-center">
    <?= __('Account created successfully',UTBF_TEXT_DOMAIN); ?>
</div>