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
<div class="woocommerce-message-error-ajax">
    <?=  __( 'Ajax registration has a problem. Please contact the site administrator', UTBF_TEXT_DOMAIN ); ?>
</div>
<form id="woocommerce-EditChildsAccountForm" class="edit-account" method="post" action="">
    <div class="button-add-child__wrapper buttons d-flex space-mb-20">
        <a id="button-add-child" class="button button-primary d-inline-flex ml-auto">
            <?=  __('Add a new child',UTBF_TEXT_DOMAIN); ?>
        </a>
    </div>
    <div id="ChildsAccountForm" data-count="<?= $args['count']; ?>">
        <?php if($args['count']>0): ?>
            <?php for ($i = 1; $i <= $args['count']; $i++):
                $nb = $i-1;
                $repeater = 'user__childs_repeater_'.$nb.'_';
                $first_name = get_user_meta($args['user_id'], $repeater.'user__child__first_name', true);
                $last_name = get_user_meta($args['user_id'], $repeater.'user__child__last_name', true);
                $classroom = get_user_meta($args['user_id'], $repeater.'user__child__classroom',true);
                $school = get_user_meta($args['user_id'], $repeater.'user__child__school',true);
                $other_school = get_user_meta($args['user_id'], $repeater.'user__child__other_school',true);
                $birthday = get_user_meta($args['user_id'], $repeater.'user__child__birthday',true);
                $medical_treatments = get_user_meta($args['user_id'], $repeater.'user__child__medical_treatments',true);
                $specific_aspects = get_user_meta($args['user_id'], $repeater.'user__child__specific_aspects',true);
                $recommendations = get_user_meta($args['user_id'], $repeater.'user__child__recommendations',true);
                ?>
                <div class="wrapper-item-child" data-child="<?= $nb; ?>">
                    <div class="item-child-header">
                        <h2 class="toggle-button space-mt-0 space-mb-0" data-child="<?= $nb; ?>">
                            <div class="toggle-ico">
                                <?= file_get_contents(UTBF_IMG_PATH . '/arrow.svg'); ?>
                            </div>
                            <div class="toggle-title">
                               <?php
                                if (!empty($first_name) || !empty($last_name)): ?>
                                    <?= esc_html($first_name); ?> <?= esc_html($last_name); ?>
                                <?php else: ?>
                                    <?= __('Unknown', UTBF_TEXT_DOMAIN); ?>
                                <?php endif; ?>
                            </div>
                        </h2>
                        <div class="item-child-delete" data-child="<?= $nb; ?>">
                            <?= file_get_contents(UTBF_IMG_PATH . '/delete.svg'); ?>
                        </div>
                    </div>
                    <div class="item-child toggle-item utbf-user-child-form" data-child="<?= $nb; ?>">
                        <div class="utbf-form__row">
                            <div class="utbf-form__half-col form-row">
                                <label>
                                    <?=  __('First name',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                                </label>
                                <input class="input-text" type="text" name="<?= $repeater; ?>user__child__first_name" value="<?= !empty($first_name)? $first_name : ''; ?>">
                                <div class="error <?= $repeater.'user__child__first_name'; ?>"></div>
                            </div>
                            <div class="utbf-form__half-col form-row">
                                <label>
                                    <?=  __('Last name',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                                </label>
                                <input class="input-text" type="text" name="<?= $repeater; ?>user__child__last_name" value="<?= !empty($last_name)? $last_name : ''; ?>">
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
                                    <?php if(!empty($args['classroom'])): ?>
                                        <?php foreach($args['classroom'] as $key => $value): ?>
                                            <option value="<?= $value; ?>" <?php if($classroom == $value): echo 'selected'; endif; ?>><?= $value; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
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
                                    <?php if(!empty($args['school'])): ?>
                                        <?php foreach($args['school'] as $key => $value): ?>
                                            <option value="<?= $value; ?>" <?php if($school == $value): echo 'selected'; endif; ?>><?= $value; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <option value="Autre" <?php if($school == 'Autre'): echo 'selected'; endif; ?>>Autre</option>
                                </select>
                                <div class="error <?= $repeater.'user__child__school'; ?>"></div>
                            </div>
                        </div>
                        <div class="utbf-form__row user__child__other_school <?php if(!empty($other_school)): echo 'show'; endif;?>">
                            <div class="utbf-form__full-col form-row">
                                <label>
                                    <?= __('Specify the name of the school',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                                </label>
                                <input class="input-text" type="text" name="<?= $repeater; ?>user__child__other_school" value="<?= !empty($other_school)? $other_school: ''; ?>">
                                <div class="error <?= $repeater.'user__child__other_school'; ?>"></div>
                            </div>
                        </div>
                        <div class="utbf-form__row">
                            <div class="utbf-form__half-col form-row">
                                <label>
                                    <?= __('Birthday',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                                </label>
                                <?php
                                if(!empty($birthday)):
                                    if (strpos($birthday, '-') === false):
                                        $birthday = substr($birthday, 0, 4) . '-' . substr($birthday, 4, 2) . '-' . substr($birthday, 6, 2);
                                    endif;
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
                                <input class="input-text" type="text" name="<?= $repeater; ?>user__child__specific_aspects" value="<?= !empty($specific_aspects)? $specific_aspects : ''; ?>">
                                <div class="error <?= $repeater.'user__child__specific_aspects'; ?>"></div>
                            </div>
                            <div class="utbf-form__half-col form-row">
                                <label>
                                    <?= __('Any useful recommendations/comments to know about the child?',UTBF_TEXT_DOMAIN); ?>
                                </label>
                                <input class="input-text" type="text" name="<?= $repeater; ?>user__child__recommendations" value="<?= !empty($recommendations)? $recommendations : ''; ?>">
                                <div class="error <?= $repeater.'user__child__recommendations'; ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
    <button id="EditChildsAccountForm-send" type="button" class="woocommerce-Button space-mt-20 button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
    <input id="input_user__childs_repeater" type="hidden" name="user__childs_repeater" value="<?= $args['count']; ?>" />
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
<div id="template-add-child" class="d-none">
    <?= load_template( UTBF_THEME_PATH . '/template-parts/woocommerce/account/menu-edit-add-child.php',null,$args); ?>
</div>