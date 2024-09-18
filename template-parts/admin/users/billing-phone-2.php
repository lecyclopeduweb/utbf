<?php
/**
 * Custom Fields Billing phone 2
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args              Args
 */
?>
<table id="fieldset-billing-phone-2" class="form-table">
    <tr>
        <th><label for="billing_phone_2"><?= __('Phone 2',UTBF_TEXT_DOMAIN); ?></label></th>
        <td>
            <input type="text" name="billing_phone_2" id="billing_phone_2" value="<?= esc_attr(get_the_author_meta('billing_phone_2', $args['user']->ID)); ?>" class="regular-text" /><br />
        </td>
    </tr>
</table>