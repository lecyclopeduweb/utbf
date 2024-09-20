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
<div class="woocommerce-message-error">
    <?=  __( 'Your form contains errors', UTBF_TEXT_DOMAIN ); ?>
</div>
<form id="woocommerce-EditChildsAccountForm" class="edit-account" method="post" action="">
    <div id="ChildsAccountForm" data-count="<?= $args['count']; ?>">
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
                            <div class="error <?= $repeater.'user__child__first_name'; ?>"></div>
                        </div>
                        <div class="utbf-form__half-col form-row">
                            <label>
                                <?=  __('Last name',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                            </label>
                            <input class="input-text" type="text" name="<?= $repeater; ?>user__child__last_name" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__last_name',true); ?>">
                            <div class="error <?= $repeater.'user__child__last_name'; ?>"></div>
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
                            <div class="error <?= $repeater.'user__child__classroom'; ?>"></div>
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
                                    <option value="<?= $value; ?>" <?php if($school == $value): echo 'selected'; endif; ?>><?= $value; ?></option>
                                <?php endforeach; ?>
                                <option value="Autre" <?php if($school == 'Autre'): echo 'selected'; endif; ?>>Autre</option>
                            </select>
                            <div class="error <?= $repeater.'user__child__school'; ?>"></div>
                        </div>
                    </div>
                    <?php $other_school = get_user_meta($args['user_id'], $repeater.'user__child__other_school',true); ?>
                    <div class="utbf-form__row user__child__other_school <?php if(!empty($other_school)): echo 'show'; endif;?>">
                        <div class="utbf-form__full-col form-row">
                            <label>
                                <?= __('Other',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                            </label>
                            <input class="input-text" type="text" name="<?= $repeater; ?>user__child__other_school" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__other_school',true); ?>">
                            <div class="error <?= $repeater.'user__child__other_school'; ?>"></div>
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
                            <div class="error <?= $repeater.'user__child__birthday'; ?>"></div>
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
                            <div class="error <?= $repeater.'user__child__medical_treatments'; ?>"></div>
                        </div>
                    </div>
                    <div class="utbf-form__row">
                        <div class="utbf-form__half-col form-row">
                            <label>
                                <?= __('Special items to report (food allergies, asthma, etc.)',UTBF_TEXT_DOMAIN); ?>
                            </label>
                            <input class="input-text" type="text" name="<?= $repeater; ?>user__child__specific_aspects" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__specific_aspects',true); ?>">
                            <div class="error <?= $repeater.'user__child__specific_aspects'; ?>"></div>
                        </div>
                        <div class="utbf-form__half-col form-row">
                            <label>
                                <?= __('Any useful recommendations/comments to know about the child?',UTBF_TEXT_DOMAIN); ?>
                            </label>
                            <input class="input-text" type="text" name="<?= $repeater; ?>user__child__recommendations" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__recommendations',true); ?>">
                            <div class="error <?= $repeater.'user__child__recommendations'; ?>"></div>
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
                            <div class="error <?= $repeater.'user__child__last_name_emergency'; ?>"></div>
                        </div>
                        <div class="utbf-form__half-col form-row">
                            <label>
                                <?=  __('First name',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                            </label>
                            <input class="input-text" type="text" name="<?= $repeater; ?>user__child__first_name_emergency" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__first_name_emergency',true); ?>">
                            <div class="error <?= $repeater.'user__child__first_name_emergency'; ?>"></div>
                        </div>
                    </div>
                    <div class="utbf-form__row">
                        <div class="utbf-form__full-col form-row">
                            <label>
                                <?=  __('Phone',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                            </label>
                            <input class="input-text" type="number" name="<?= $repeater; ?>user__child__phone_emergency" value="<?= get_user_meta($args['user_id'], $repeater.'user__child__phone_emergency',true); ?>">
                            <div class="error <?= $repeater.'user__child__phone_emergency'; ?>"></div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
    <div class="buttons d-flex space-mb-20">
        <div id="button-add-child" class="button button-primary d-inline-flex ml-auto">
            <?=  __('Add Child',UTBF_TEXT_DOMAIN); ?>
        </div>
    </div>
    <button id="EditChildsAccountForm-send" type="button" class="woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
    <input type="hidden" name="action" value="save_childs_account" />
    <input id="input_user__childs_repeater" type="hidden" name="user__childs_repeater" value="<?= $args['count']; ?>" />
</form>
<div id="template-add-child" class="d-none">
    <?= load_template( UTBF_THEME_PATH . '/template-parts/admin/account/menu-edit-add-child.php',null,$args); ?>
</div>