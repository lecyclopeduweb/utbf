<?php
/**
 * Item orders
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>*
 *
 * @var Array     $order              Order
 */
?>
<tr>
    <td class="column" data-colname="<?= __('Order',UTBF_TEXT_DOMAIN); ?>">
        <strong>
            <a href="<?= site_url(); ?>/wp-admin/admin.php?page=wc-orders&action=edit&id=<?= $args->get_id(); ?>">
                #<?= $args->get_id(); ?>
            </a>
        </strong>
    </td>
    <td class="column" data-colname="<?= __('Date',UTBF_TEXT_DOMAIN); ?>">
        <?php $order_date = $args->get_date_created(); ?>
        <?php if ( $order_date ): ?>
            <?= date_i18n( 'j M Y', $order_date->getTimestamp()); ?>
        <?php else: ?>
            -
        <?php endif; ?>
    </td>
    <td class="column" data-colname="<?= __('State',UTBF_TEXT_DOMAIN); ?>">
       <mark class="order-status status-<?= $args->get_status(); ?>"><span><?= __(wc_get_order_status_name($args->get_status()),'woocommerce'); ?></span></mark>
    </td>
    <td class="column" data-colname="<?= __('Total',UTBF_TEXT_DOMAIN); ?>">
       <?= wc_price($args->get_total()); ?>
    </td>
</tr>