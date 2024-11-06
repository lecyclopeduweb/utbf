<?php
/**
 * Menu Edit Add Child
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args              Args
 */
?>
<div class="wrapper-item-child" data-child="data_number">
    <div class="utbf-user-child-form">
        <div class="item-child-header">
            <h2 class="space-mt-0 space-mb-0">
                <?= __('New Child',UTBF_TEXT_DOMAIN); ?>
            </h2>
            <div class="item-child-delete" data-child="data_number">
                <?= file_get_contents(UTBF_IMG_PATH . '/delete.svg'); ?>
            </div>
        </div>
        <div class="utbf-form__row space-mt-20">
            <div class="utbf-form__half-col form-row">
                <label>
                    <?=  __('First name',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                </label>
                <input class="input-text" type="text" name="user__childs_repeater_number_user__child__first_name" value="">
                <div class="error user__childs_repeater_number_user__child__first_name"></div>
            </div>
            <div class="utbf-form__half-col form-row">
                <label>
                    <?=  __('Last name',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                </label>
                <input class="input-text" type="text" name="user__childs_repeater_number_user__child__last_name" value="">
                <div class="error user__childs_repeater_number_user__child__last_name"></div>
            </div>
        </div>
        <div class="utbf-form__row">
            <div class="utbf-form__full-col form-row">
                <label>
                    <?= __('Classroom',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                </label>
                <select name="user__childs_repeater_number_user__child__classroom">
                    <option value=""><?= __('--Please choose an option--',UTBF_TEXT_DOMAIN); ?></option>
                    <?php foreach($args['classroom'] as $key => $value): ?>
                        <option value="<?= $value; ?>"><?= $value; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="error user__childs_repeater_number_user__child__classroom"></div>
            </div>
        </div>
        <div class="utbf-form__row">
            <div class="utbf-form__full-col form-row">
                <label>
                    <?= __('School',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                </label>
                <select class="user__child__school" name="user__childs_repeater_number_user__child__school">
                    <option value=""><?= __('--Please choose an option--',UTBF_TEXT_DOMAIN); ?></option>
                    <?php foreach($args['school'] as $key => $value): ?>
                        <option value="<?= $value; ?>"><?= $value; ?></option>
                    <?php endforeach; ?>
                    <option value="Autre">Autre</option>
                </select>
                <div class="error user__childs_repeater_number_user__child__school"></div>
            </div>
        </div>
        <div class="utbf-form__row user__child__other_school">
            <div class="utbf-form__full-col form-row">
                <label>
                    <?= __('Specify the name of the school',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                </label>
                <input class="input-text" type="text" name="user__childs_repeater_number_user__child__other_school" value="">
                <div class="error user__childs_repeater_number_user__child__other_school"></div>
            </div>
        </div>
        <div class="utbf-form__row">
            <div class="utbf-form__half-col form-row">
                <label>
                    <?= __('Birthday',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                </label>
                <input class="input-text" type="date" name="user__childs_repeater_number_user__child__birthday" value="">
                <div class="error user__childs_repeater_number_user__child__birthday"></div>
            </div>
            <div class="utbf-form__half-col form-row">
                <label>
                    <?= __('Medical treatment in progress',UTBF_TEXT_DOMAIN);   ?>&nbsp;<span class="required">*</span>
                </label>
                <div class="d-flex h-100 align-items-center">
                    <label class="space-mr-10">
                        <input type="radio" name="user__childs_repeater_number_user__child__medical_treatments" value="yes" />
                        <?= __('Yes',UTBF_TEXT_DOMAIN); ?>
                    </label>
                    <label>
                        <input type="radio" name="user__childs_repeater_number_user__child__medical_treatments" value="no" />
                        <?= __('No',UTBF_TEXT_DOMAIN); ?>
                    </label>
                </div>
                <div class="error user__childs_repeater_number_user__child__medical_treatments"></div>
            </div>
        </div>
        <div class="utbf-form__row">
            <div class="utbf-form__half-col form-row">
                <label>
                    <?= __('Special items to report (food allergies, asthma, etc.)',UTBF_TEXT_DOMAIN); ?>
                </label>
                <input class="input-text" type="text" name="user__childs_repeater_number_user__child__specific_aspects" value="">
                <div class="error user__childs_repeater_number_user__child__specific_aspects"></div>
            </div>
            <div class="utbf-form__half-col form-row">
                <label>
                    <?= __('Any useful recommendations/comments to know about the child?',UTBF_TEXT_DOMAIN); ?>
                </label>
                <input class="input-text" type="text" name="user__childs_repeater_number_user__child__recommendations" value="">
                <div class="error user__childs_repeater_number_user__child__recommendations"></div>
            </div>
        </div>
    </div>
</div>