<?php
/**
 * User Form
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
                        <select name="childs[<?= $i; ?>][name]">
                            <?php $select = (isset($_POST['childs']))? $_POST['childs'][$i]['name']: '';?>
                            <option value="">--<?=  __( 'Select a child', UTBF_TEXT_DOMAIN ); ?>--</option>
                            <?php foreach($args['childs'] as $key => $child): ?>
                                <option value="<?= $child['first_name'] . ' ' . $child['last_name']; ?>" <?php if( $select == $child['first_name'] . ' ' . $child['last_name']): echo 'selected'; endif; ?>>
                                    <?= $child['first_name'] . ' ' . $child['last_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
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
<?php else: ?>
    <?php if ( is_user_logged_in() ) : ?>
        <div class="single-product-childs__no-childs utbf-form__row space-mb-10">
            <?=  __( 'You do not have any children attached to your account. Please add one from your space.', UTBF_TEXT_DOMAIN ); ?>
            <?=  __( "Go to your children's section account" , UTBF_TEXT_DOMAIN ); ?>
            <a class="button" href="<?=wc_get_page_permalink('myaccount'); ?>edit-childs/">
                <?=  __( 'Parent space' , UTBF_TEXT_DOMAIN ); ?>
            </a>
        </div>
    <?php else : ?>
        <?= load_template( UTBF_THEME_PATH . '/template-parts/woocommerce/single-product/not-logged-in.php',null,[]); ?>
    <?php endif; ?>
<?php endif; ?>
