<?php
/**
 * Menu Edit Childs
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args              Args
 */
?>
<?php $errors = WC()->session->get( 'form_errors', [] ); ?>
<form id="woocommerce-EditAccountForm edit-account" method="post" action="">
    <?php if($args['count']>0): ?>
        <?php for ($i = 1; $i <= $args['count']; $i++):
            $nb = $i-1;
            $repeater = 'user__childs_repeater_'.$nb.'_';
            ?>
            <?php if($i > 1): ?>
                <hr class="space-mt-30 space-mb-30">
            <?php endif; ?>
            <div class="utbf-user-child-form">
                <h2 class="space-mt-0 space-mb-0">
                    <?= get_user_meta($args['user_id'], $repeater.'user__child__first_name',true); ?> <?= get_user_meta($args['user_id'], $repeater.'user__child__last_name',true); ?>
                </h2>
                <div class="utbf-form__row space-mt-20">
                    <div class="utbf-form__half-col form-row">
                        <label>
                            <?=  __('First name',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <input class="input-text" type="text" name="<?= $repeater; ?>user__child__first_name" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__first_name',true); ?>">
                        <?php if (!empty($errors[$repeater.'user__child__first_name'])): ?>
                            <div class="error error-wc">
                                 <?= $errors[$repeater.'user__child__first_name']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="utbf-form__half-col form-row">
                        <label>
                            <?=  __('Last name',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <input class="input-text" type="text" name="<?= $repeater; ?>user__child__last_name" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__last_name',true); ?>">
                        <?php if (!empty($errors[$repeater.'user__child__last_name'])): ?>
                            <div class="error error-wc">
                                 <?= $errors[$repeater.'user__child__last_name']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="utbf-form__row">
                    <div class="utbf-form__full-col form-row">
                        <label>
                            <?= __('Classroom',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <select name="<?= $repeater; ?>user__child__classroom">
                            <option value=""><?= __('--Please choose an option--',UTBF_TEXT_DOMAIN); ?></option>
                            <?php $classroom = get_user_meta($args['user_id'], $repeater.'user__child__classroom',true); ?>
                            <?php foreach($args['classroom'] as $key => $value): ?>
                                <option value="<?= $value; ?>" <?php if($classroom == $value): echo 'selected'; endif; ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors[$repeater.'user__child__classroom'])): ?>
                            <div class="error error-wc">
                                 <?= $errors[$repeater.'user__child__classroom']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="utbf-form__row">
                    <div class="utbf-form__full-col form-row">
                        <label>
                            <?= __('School',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <select class="user__child__school" name="<?= $repeater; ?>user__child__school">
                            <option value=""><?= __('--Please choose an option--',UTBF_TEXT_DOMAIN); ?></option>
                            <?php $school = get_user_meta($args['user_id'], $repeater.'user__child__school',true); ?>
                            <?php foreach($args['school'] as $key => $value): ?>
                                <option value="<?= $value; ?>" <?php if($school == $value && empty($errors[$repeater.'user__child__other_school'])): echo 'selected'; endif; ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                            <option value="Autre" <?php if($school == 'Autre' || !empty($errors[$repeater.'user__child__other_school'])): echo 'selected'; endif; ?>>Autre</option>
                        </select>
                        <?php if (!empty($errors[$repeater.'user__child__school'])): ?>
                            <div class="error error-wc">
                                 <?= $errors[$repeater.'user__child__school']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php $other_school = get_user_meta($args['user_id'], $repeater.'user__child__other_school',true); ?>
                <div class="utbf-form__row user__child__other_school <?php if(!empty($other_school) || !empty($errors[$repeater.'user__child__other_school'])): echo 'show'; endif;?>">
                    <div class="utbf-form__full-col form-row">
                        <label>
                            <?= __('Other',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <input class="input-text" type="text" name="<?= $repeater; ?>user__child__other_school" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__other_school',true); ?>">
                        <?php if (!empty($errors[$repeater.'user__child__other_school'])): ?>
                            <div class="error error-wc">
                                 <?= $errors[$repeater.'user__child__other_school']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="utbf-form__row">
                    <div class="utbf-form__half-col form-row">
                        <label>
                            <?= __('Birthday',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <?php
                        $birthday = get_user_meta($args['user_id'], $repeater.'user__child__birthday',true);
                        if (strpos($birthday, '-') === false):
                            $birthday = substr($birthday, 0, 4) . '-' . substr($birthday, 4, 2) . '-' . substr($birthday, 6, 2);
                        endif;
                        ?>
                        <input class="input-text" type="date" name="<?= $repeater; ?>user__child__birthday" value="<?= $birthday; ?>">
                        <?php if (!empty($errors[$repeater.'user__child__birthday'])): ?>
                            <div class="error error-wc">
                                 <?= $errors[$repeater.'user__child__birthday']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="utbf-form__half-col form-row">
                        <label>
                            <?= __('Medical treatment in progress',UTBF_TEXT_DOMAIN);   ?>&nbsp;<span class="required">*</span>
                        </label>
                        <div class="d-flex h-100 align-items-center">
                            <?php $medical_treatments = get_user_meta($args['user_id'], $repeater.'user__child__medical_treatments',true); ?>
                            <label class="space-mr-10">
                                <input type="radio" name="<?= $repeater; ?>user__child__medical_treatments" <?php if($medical_treatments): echo 'checked'; endif;?> value="yes" />
                                <?= __('Yes',UTBF_TEXT_DOMAIN); ?>
                            </label>
                            <label>
                                <input type="radio" name="<?= $repeater; ?>user__child__medical_treatments" <?php if(!$medical_treatments): echo 'checked'; endif;?> value="no" />
                                <?= __('No',UTBF_TEXT_DOMAIN); ?>
                            </label>
                        </div>
                        <?php if (!empty($errors[$repeater.'user__child__medical_treatments'])): ?>
                            <div class="error error-wc">
                                 <?= $errors[$repeater.'user__child__medical_treatments']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="utbf-form__row">
                    <div class="utbf-form__half-col form-row">
                        <label>
                            <?= __('Special items to report (food allergies, asthma, etc.)',UTBF_TEXT_DOMAIN); ?>
                        </label>
                        <input class="input-text" type="text" name="<?= $repeater; ?>user__child__specific_aspects" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__specific_aspects',true); ?>">
                        <?php if (!empty($errors[$repeater.'user__child__specific_aspects'])): ?>
                            <div class="error error-wc">
                                 <?= $errors[$repeater.'user__child__specific_aspects']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="utbf-form__half-col form-row">
                        <label>
                            <?= __('Any useful recommendations/comments to know about the child?',UTBF_TEXT_DOMAIN); ?>
                        </label>
                        <input class="input-text" type="text" name="<?= $repeater; ?>user__child__recommendations" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__recommendations',true); ?>">
                        <?php if (!empty($errors[$repeater.'user__child__recommendations'])): ?>
                            <div class="error error-wc">
                                 <?= $errors[$repeater.'user__child__recommendations']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                /**
                 *
                 * Emergency
                 *
                 */
                ?>
                <h3 class="space-mt-30">
                    <?=  __('Case of emergency',UTBF_TEXT_DOMAIN); ?>
                </h3>
                <div class="utbf-form__row space-mt-20">
                    <div class="utbf-form__half-col form-row">
                        <label>
                            <?= __('Last name',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <input class="input-text" type="text" name="<?= $repeater; ?>user__child__last_name_emergency" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__last_name_emergency',true); ?>">
                        <?php if (!empty($errors[$repeater.'user__child__last_name_emergency'])): ?>
                            <div class="error error-wc">
                                 <?= $errors[$repeater.'user__child__last_name_emergency']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="utbf-form__half-col form-row">
                        <label>
                            <?=  __('First name',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <input class="input-text" type="text" name="<?= $repeater; ?>user__child__first_name_emergency" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__first_name_emergency',true); ?>">
                        <?php if (!empty($errors[$repeater.'user__child__first_name_emergency'])): ?>
                            <div class="error error-wc">
                                 <?= $errors[$repeater.'user__child__first_name_emergency']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="utbf-form__row">
                    <div class="utbf-form__full-col form-row">
                        <label>
                            <?=  __('Phone',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <input class="input-text" type="number" name="<?= $repeater; ?>user__child__phone_emergency" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__phone_emergency',true); ?>">
                        <?php if (!empty($errors[$repeater.'user__child__phone_emergency'])): ?>
                            <div class="error error-wc">
                                 <?= $errors[$repeater.'user__child__phone_emergency']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    <?php endif; ?>
    <button type="submit" class="woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
    <input type="hidden" name="action" value="save_account_childs" />
</form>