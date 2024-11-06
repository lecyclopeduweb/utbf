<?php
/**
 * Back End Product Classrooms Checkbox
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args              Args
 */
 wp_nonce_field('classroom_products_meta_box_nonce', 'classroom_products_meta_box_nonce_field');
?>
<?php if(!empty($args)): ?>

    <ul class="acf-checkbox-list acf-bl">
        <?php if(!empty($args['classrooms'])): ?>
            <?php foreach($args['classrooms'] as $classroom): ?>
                <?php $value = $classroom['classroom'];?>
                <li>
                    <label>
                        <input type="checkbox" name="classroom_products_meta_box[<?= sanitize_title($value); ?>]" value="<?= $value; ?>" <?php if(!empty($args['selected'][sanitize_title($value)])): echo 'checked="checked"'; endif;?>>
                        <?= $value; ?>
                    </label>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

<?php endif; ?>
