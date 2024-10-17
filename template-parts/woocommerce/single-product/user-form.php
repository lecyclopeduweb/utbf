<?php
/**
 * User Form
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args              Args
 */
// global $product;
?>
<?php if(!empty($args['childs'])): ?>
    <?php /*
    <form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
    <?php woocommerce_quantity_input(); ?>
    <?php woocommerce_template_loop_add_to_cart(); ?>
    </form>
    */ ?>
<?php else: ?>
    <?=  __( 'You do not have any children attached to your account. Please add one.', UTBF_TEXT_DOMAIN ); ?>
<?php endif; ?>
