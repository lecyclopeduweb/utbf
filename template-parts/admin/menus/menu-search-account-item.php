<?php
/**
 * Menu search Account
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>*
 *
 * @var Array     $user              User
 */
?>
<tr id="user-1">
    <td class="parent column-parent" data-colname="<?= __('Parent',UTBF_TEXT_DOMAIN); ?>">
        <strong>
            <a href="<?= site_url(); ?>/wp-admin/user-edit.php?user_id=<?= $args['ID']; ?>&amp;wp_http_referer=%2Fwp-admin%2Fusers.php">
                <?= $args['first_name'][0]; ?> <?= $args['last_name'][0]; ?>
            </a>
        </strong>
    </td>
    <td class="role column-childs" data-colname="<?= __('Childs',UTBF_TEXT_DOMAIN); ?>">
        <?php if( have_rows('user__childs_repeater', 'user_'.$args['ID']) ): ?>
            <ul>
                <?php while( have_rows('user__childs_repeater', 'user_'.$args['ID']) ): the_row(); ?>
                    <li><?= get_sub_field('user__child__first_name'); ?> <?= get_sub_field('user__child__last_name'); ?></li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <?= __('No Childs',UTBF_TEXT_DOMAIN); ?>
        <?php endif; ?>
    </td>
    <td class="phone column-phone" data-colname="<?= __('Phone',UTBF_TEXT_DOMAIN); ?>">
        <?php
        $phones = [
            get_user_meta($args['data']->ID, 'billing_phone', true),
            get_user_meta($args['data']->ID, 'billing_phone_2', true),
            get_user_meta($args['data']->ID, 'shipping_phone', true),
            get_the_author_meta('shipping_phone_2', $args['data']->ID)
        ];
        $user_phone = '';
        foreach ($phones as $phone):
            if (!empty($phone)):
                $user_phone = $phone;
                break;
            endif;
        endforeach;
        ?>
        <a <?php if(!empty($user_phone)) : ?>href="tel:<?= $user_phone; ?>" <?php endif; ?>>
            <?= (!empty($user_phone)) ? $user_phone :__('No Phone',UTBF_TEXT_DOMAIN); ?>
        </a>
    </td>
    <td class="email column-email" data-colname="<?= __('Email',UTBF_TEXT_DOMAIN); ?>">
        <a href="mailto:<?= $args['data']->user_email; ?>">
            <?= $args['data']->user_email; ?>
        </a>
    </td>
</tr>