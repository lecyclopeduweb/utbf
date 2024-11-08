<?php
/**
 * Not Logged In
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args              Args
 */
?>
<div class="single-product-childs__not-logged-in utbf-form__row space-mb-10">
    <?=  __( 'To register your child for this course, please log in or create an account.', UTBF_TEXT_DOMAIN ); ?>
    <a class="button" href="<?= wc_get_page_permalink('myaccount'); ?>edit-childs/">
        <?=  __( 'Parent space' , UTBF_TEXT_DOMAIN ); ?>
    </a>
</div>
