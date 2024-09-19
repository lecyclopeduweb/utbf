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
    <?php
    /**
     *
     * Informations
     *
     */
    ?>
    <h2>
        <?= (!empty($args['props']['title_informations']))? $args['props']['title_informations'] : __('Informations',UTBF_TEXT_DOMAIN); ?>
    </h2>
    <div class="utbf-form__row space-mt-20">
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
            <input type="number" name="zip_code" value="">
            <div class="error zip_code"></div>
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
    <?php
    /**
     *
     * Legal guardian
     *
     */
    ?>
    <h2 class="space-mt-30">
        <?= (!empty($args['props']['title_legal_guardian']))? $args['props']['title_legal_guardian'] : __('Legal guardian',UTBF_TEXT_DOMAIN); ?>
    </h2>
    <div class="utbf-form__row space-mt-20">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_first_name']))? $args['props']['label_legal_guardian_first_name'] : __('First name',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user__legal_guardian__first_name" value="">
            <div class="error user__legal_guardian__first_name"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_last_name']))? $args['props']['label_legal_guardian_last_name'] : __('Last name',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user__legal_guardian__last_name" value="">
            <div class="error user__legal_guardian__last_name"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__full-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_address']))? $args['props']['label_legal_guardian_address'] : __('Address',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user__legal_guardian__address" value="">
            <div class="error user__legal_guardian__address"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_zip_code']))? $args['props']['label_legal_guardian_zip_code'] : __('Zip code',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="number" name="user__legal_guardian__zip_code" value="">
            <div class="error user__legal_guardian__zip_code"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_city']))? $args['props']['label_legal_guardian_city'] : __('City',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user__legal_guardian__city" value="">
            <div class="error user__legal_guardian__city"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_phone']))? $args['props']['label_legal_guardian_phone'] : __('Phone',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="number" name="user__legal_guardian__phone" value="">
            <div class="error user__legal_guardian__phone"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_phone_2']))? $args['props']['label_legal_guardian_phone_2'] : __('Phone 2',UTBF_TEXT_DOMAIN); ?>
            </label>
            <input type="number" name="user__legal_guardian__phone_2" value="">
            <div class="error user__legal_guardian__phone_2"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__full-col">
            <label>
                <?= (!empty($args['props']['label_legal_guardian_email']))? $args['props']['label_legal_guardian_email'] : __('Email',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="email" name="user__legal_guardian__email" value="">
            <div class="error user__legal_guardian__email"></div>
        </div>
    </div>
    <?php
    /**
     *
     * Child
     *
     */
    ?>
    <h2 class="space-mt-30 space-mb-0">
        <?= (!empty($args['props']['title_child']))? $args['props']['title_child'] : __('Child',UTBF_TEXT_DOMAIN); ?>
    </h2>
    <?php if (!empty($args['props']['infos_bloc_child'])): ?>
        <em>
            <?= $args['props']['infos_bloc_child']; ?>
        </em>
    <?php endif; ?>
    <div class="utbf-form__row space-mt-20">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_child_first_name']))? $args['props']['label_child_first_name'] : __('First name',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user__child__first_name" value="">
            <div class="error user__child__first_name"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_child_last_name']))? $args['props']['label_child_last_name'] : __('Last name',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user__child__last_name" value="">
            <div class="error user__child__last_name"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__full-col">
            <label>
                <?= (!empty($args['props']['label_child_classroom']))? $args['props']['label_child_classroom'] : __('Classroom',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <select name="user__child__classroom">
                <option value=""><?= __('--Please choose an option--',UTBF_TEXT_DOMAIN); ?></option>
                <?php foreach($args['classroom'] as $key => $value): ?>
                    <option value="<?= $value; ?>"><?= $value; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="error user__child__classroom"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__full-col">
            <label>
                <?= (!empty($args['props']['label_child_school']))? $args['props']['label_child_school'] : __('School',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <select id="user__child__school" name="user__child__school">
                <option value=""><?= __('--Please choose an option--',UTBF_TEXT_DOMAIN); ?></option>
                <?php foreach($args['school'] as $key => $value): ?>
                    <option value="<?= $value; ?>"><?= $value; ?></option>
                <?php endforeach; ?>
                <option value="Autre">Autre</option>
            </select>
            <div class="error user__child__school"></div>
        </div>
    </div>
    <div id="user__child__other_school" class="utbf-form__row">
        <div class="utbf-form__full-col">
            <label>
                <?= (!empty($args['props']['label_child_other_school']))? $args['props']['label_child_other_school'] : __('Other',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user__child__other_school" value="">
            <div class="error user__child__other_school"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_child_birthday']))? $args['props']['label_child_birthday'] : __('Birthday',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="date" name="user__child__birthday" value="">
            <div class="error user__child__birthday"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_child_medical_treatments']))? $args['props']['label_child_medical_treatments'] : __('Medical treatment in progress',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <div class="d-flex h-100 align-items-center">
                <label class="space-mr-10">
                    <input type="radio" name="user__child__medical_treatments" value="yes" />
                    <?= __('Yes',UTBF_TEXT_DOMAIN); ?>
                </label>
                <label>
                    <input type="radio" name="user__child__medical_treatments" value="no" />
                    <?= __('No',UTBF_TEXT_DOMAIN); ?>
                </label>
            </div>
            <div class="error user__child__medical_treatments"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_child_specific_aspects']))? $args['props']['label_child_specific_aspects'] : __('Special items to report (food allergies, asthma, etc.)',UTBF_TEXT_DOMAIN); ?>
            </label>
            <input type="text" name="user__child__specific_aspects" value="">
            <div class="error user__child__specific_aspects"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_child_recommendations']))? $args['props']['label_child_recommendations'] : __('Any useful recommendations/comments to know about the child?',UTBF_TEXT_DOMAIN); ?>
            </label>
            <input type="text" name="user__child__recommendations" value="">
            <div class="error user__child__recommendations"></div>
        </div>
    </div>
    <?php
    /**
     *
     * Emergency
     *
     */
    ?>
    <h2 class="space-mt-30">
        <?= (!empty($args['props']['title_emergency']))? $args['props']['title_emergency'] : __('Case of emergency',UTBF_TEXT_DOMAIN); ?>
    </h2>
    <div class="utbf-form__row space-mt-20">
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_emergency_last_name']))? $args['props']['label_emergency_last_name'] : __('Last name',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user__child__last_name_emergency" value="">
            <div class="error user__child__last_name_emergency"></div>
        </div>
        <div class="utbf-form__half-col">
            <label>
                <?= (!empty($args['props']['label_emergency_first_name']))? $args['props']['label_emergency_first_name'] : __('First name',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="text" name="user__child__first_name_emergency" value="">
            <div class="error user__child__first_name_emergency"></div>
        </div>
    </div>
    <div class="utbf-form__row">
        <div class="utbf-form__full-col">
            <label>
                <?= (!empty($args['props']['label_emergency_phone']))? $args['props']['label_emergency_phone'] : __('Phone',UTBF_TEXT_DOMAIN); ?>*
            </label>
            <input type="number" name="user__child__phone_emergency" value="">
            <div class="error user__child__phone_emergency"></div>
        </div>
    </div>
    <?php
    /**
     *
     * Button
     *
     */
    ?>
    <div class="utbf-form__row justify-content-center align-items-center space-mt-30">
        <div id="utbf-register-form-send" class="button button-primary button-large">
            <?= (!empty($args['props']['text_button']))? $args['props']['text_button'] : __('Register',UTBF_TEXT_DOMAIN); ?>
        </div>
    </div>
    <div id="utbf-register-form-error" class="error align-items-center justify-content-center">
        <?= __('The form contains errors',UTBF_TEXT_DOMAIN); ?>
    </div>
    <?php
    /**
     *
     * Loader
     *
     */
    ?>
    <div class="wrapper-loader">
        <div class="loader">
            <?= file_get_contents(UTBF_IMG_URI . '/loader.svg'); ?>
        </div>
    </div>
</form>
<?php
/**
 *
 * Success Message
 *
 */
?>
<div id="utbf-register-form-success" class="align-items-center justify-content-center">
    <?= __('Account created successfully',UTBF_TEXT_DOMAIN); ?>
</div>