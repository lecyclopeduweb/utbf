<?php
/**
 * Childs Form
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args              Args
 */
?>
<?php if(!empty($args['childs'])): ?>
    <div class="single-product-childs">
        <?php for($i = 0; $i < $args['count']; $i++): ?>
            <div class="single-product-childs__item">
                <h2>
                    <?= __('Child',UTBF_TEXT_DOMAIN); ?> <?= __('number',UTBF_TEXT_DOMAIN); ?> <span class="number"><?= $i + 1; ?></span>
                </h2>
                <?php
                /**
                 *
                 * Child
                 *
                 */
                ?>
                <div class="utbf-form__row single-product-childs__name">
                    <div class="utbf-form__full-col form-row">
                        <label>
                            <?= __('Name',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <select class="child-name" name="childs[<?= $i; ?>][name]">
                            <?php $select = (isset($_POST['childs']))? $_POST['childs'][$i]['name']: '';?>
                            <option value="">--<?=  __( 'Select a child', UTBF_TEXT_DOMAIN ); ?>--</option>
                            <?php foreach($args['childs'] as $key => $child): ?>
                                <option
                                first-name="<?= $child['first_name']; ?>"
                                last-name="<?= $child['last_name']; ?>"
                                birthday="<?= $child['birthday']; ?>"
                                medical-treatments="<?= $child['medical_treatments']; ?>"
                                specific-aspects="<?= $child['specific_aspects']; ?>"
                                recommendations="<?= $child['recommendations']; ?>"
                                value="<?= $child['first_name'] . ' ' . $child['last_name']; ?>" <?php if( $select == $child['first_name'] . ' ' . $child['last_name']): echo 'selected'; endif; ?>>
                                    <?= $child['first_name'] . ' ' . $child['last_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input class="child-first-name" type="hidden" name="childs[<?= $i; ?>][first_name]" value="">
                    <input class="child-last-name" type="hidden" name="childs[<?= $i; ?>][last_name]" value="">
                    <input class="child-birthday" type="hidden" name="childs[<?= $i; ?>][birthday]" value="">
                    <input class="child-medical-treatments" type="hidden" name="childs[<?= $i; ?>][medical_treatments]" value="">
                    <input class="child-specific-aspects" type="hidden" name="childs[<?= $i; ?>][specific_aspects]" value="">
                    <input class="child-recommendations" type="hidden" name="childs[<?= $i; ?>][recommendations]" value="">
                </div>
                <?php
                /**
                 *
                 * Classroom
                 *
                 */
                ?>
                <div class="utbf-form__row single-product-childs__classroom">
                    <div class="utbf-form__full-col form-row">
                        <label>
                            <?= __('Classroom',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <select name="childs[<?= $i; ?>][classroom]">
                            <?php $select = (isset($_POST['childs']))? $_POST['childs'][$i]['classroom']: '';?>
                            <option value="">--<?=  __( 'Select a classroom', UTBF_TEXT_DOMAIN ); ?>--</option>
                            <?php foreach($args['classroom'] as $key => $value): ?>
                                <option value="<?= $value; ?>" <?php if( $select == $value): echo 'selected'; endif; ?>>
                                    <?= $value; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php
                /**
                 *
                 * Canteen
                 *
                 */
                ?>
                <?php if(!empty($args['canteen'])): ?>
                    <div class="utbf-form__row single-product-childs__canteen">
                        <div class="utbf-form__full-col form-row">
                            <label>
                                <?= __('Canteen',UTBF_TEXT_DOMAIN); ?> <i>(<?= $args['canteen_price'];?>€ /<?= __('day',UTBF_TEXT_DOMAIN); ?>)</i>
                            </label>
                            <div class="single-product-childs__canteen-checkboxs">
                                <?php foreach($args['canteen'] as $key => $value): ?>
                                    <?php $checked = (isset($_POST['childs']))? ((isset($_POST['childs'][$i]['canteen'][$value['value']]))? true : false) : false;?>
                                    <label>
                                        <input type="checkbox" name="childs[<?= $i; ?>][canteen][<?= $value['value']; ?>]" value="<?= $value['label']; ?>" <?php if(!empty($checked)): echo 'checked'; endif;?>> <?= $value['label']; ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                /**
                 *
                 * Daycare
                 *
                 */
                ?>
                <?php if(!empty($args['daycare'])): ?>
                    <div class="utbf-form__row single-product-childs__daycare">
                        <div class="utbf-form__full-col form-row">
                            <label>
                                <?= __('Daycare',UTBF_TEXT_DOMAIN); ?> <i>(<?= $args['daycare_price'];?>€ /<?= __('half day',UTBF_TEXT_DOMAIN); ?>)</i>
                            </label>
                            <div class="single-product-childs__daycare-checkboxs">
                                <?php foreach($args['daycare'] as $key => $value): ?>
                                    <?php $checked = (isset($_POST['childs']))? ((isset($_POST['childs'][$i]['daycare'][$value['value']]))? true : false) : false;?>
                                    <label>
                                        <input type="checkbox" name="childs[<?= $i; ?>][daycare][<?= $value['value']; ?>]" value="<?= $value['label']; ?>" <?php if(!empty($checked)): echo 'checked'; endif;?>> <?= $value['label']; ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                /**
                 *
                 * Emergency
                 *
                 */
                ?>
                <div class="space-mt-20 space-mb-10 single-product-childs__title">
                    <?= __('Emergency contact person',UTBF_TEXT_DOMAIN); ?>
                </div>
                <div class="utbf-form__row single-product-childs__emergency">
                    <div class="utbf-form__half-col form-row">
                        <label>
                            <?= __('Last name',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <input class="input-text" type="text" name="childs[<?= $i; ?>][last_name_emergency]" value="<?= (isset($_POST['childs']))? $_POST['childs'][$i]['last_name_emergency']: '';?>">
                    </div>
                    <div class="utbf-form__half-col form-row">
                        <label>
                            <?=  __('First name',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <input class="input-text" type="text" name="childs[<?= $i; ?>][first_name_emergency]" value="<?= (isset($_POST['childs']))? $_POST['childs'][$i]['first_name_emergency']: '';?>">
                    </div>
                </div>
                <div class="utbf-form__row">
                    <div class="utbf-form__full-col form-row">
                        <label>
                            <?=  __('Phone',UTBF_TEXT_DOMAIN); ?>&nbsp;<span class="required">*</span>
                        </label>
                        <input class="input-text" type="number" name="childs[<?= $i; ?>][phone_emergency]" value="<?= (isset($_POST['childs']))? $_POST['childs'][$i]['phone_emergency']: '';?>">
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
<?php endif; ?>
