 <?php if ( is_user_logged_in() ) : ?>
    <div class="single-product-childs__no-childs utbf-form__row space-mb-10">
        <?=  __( 'You do not have any children attached to your account. Please add one from your space.', UTBF_TEXT_DOMAIN ); ?>
        <a class="button" href="<?=wc_get_page_permalink('myaccount'); ?>edit-childs/">
            <?=  __( 'Parent space' , UTBF_TEXT_DOMAIN ); ?>
        </a>
    </div>
<?php endif; ?>
