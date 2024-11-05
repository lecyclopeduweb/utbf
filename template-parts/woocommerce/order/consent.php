<?php
/**
 * Consent
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args              Args
 */
$wrapper_start = $args['admin-template'] ? '<p class="form-field form-field-wide wc-customer-user">' : '<div>';
$wrapper_end = $args['admin-template'] ? '</p>' : '</div>';
?>

<?= $wrapper_start; ?>
    <strong><?=  __( "Authorization to publish photos on the secure blog", UTBF_TEXT_DOMAIN ); ?></strong>&nbsp;:&nbsp;<?= $args['consent-blog']; ?>
<?= $wrapper_end; ?>

<?= $wrapper_start; ?>
    <strong><?=  __( "Authorization to publish photos on the association's communication tools (website, FB, IG, etc.)", UTBF_TEXT_DOMAIN ); ?></strong>&nbsp;:&nbsp;<?= $args['consent-communication']; ?>
<?= $wrapper_end; ?>