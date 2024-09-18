<?php
/**
 * Custom Fields Shipping phone 2
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args              Args
 */
?>
<table id="fieldset-shipping-phone-2" class="form-table">
    <tr>
        <th><label for="shipping_phone_2"><?= __('Phone 2',UTBF_TEXT_DOMAIN); ?></label></th>
        <td>
            <input type="text" name="shipping_phone_2" id="shipping_phone_2" value="<?= esc_attr(get_the_author_meta('shipping_phone_2', $args['user']->ID)); ?>" class="regular-text" /><br />
        </td>
    </tr>
</table>