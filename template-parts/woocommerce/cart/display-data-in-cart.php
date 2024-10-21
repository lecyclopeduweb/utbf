<?php
/**
 * Display Data in cart
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args              Args
 */
?>
<?php if(!empty($args)): ?>
    <?php
    /**
     *
     * Name
     *
     */
    ?>
    <?=  $args['name']; ?>
    <?php
    /**
     *
     * Classroom
     *
     */
    ?>
     -  <?= __('Classroom', UTBF_TEXT_DOMAIN)  ?> :  <?= $args['classroom']; ?>
    <?php
    /**
     *
     * Canteen
     *
     */
    ?>
    <?php if($args['canteen']): ?>
        - <?=  __('Canteen', UTBF_TEXT_DOMAIN); ?> :
        <?php $i = 0;  foreach ($args['canteen'] as $canteen): ?>
            <?php if( $i != 0): ?>, <?php endif; ?>
                <?= $canteen ?>
        <?php $i++; endforeach; ?>
    <?php endif; ?>
    <?php
    /**
     *
     * Daycare
     *
     */
    ?>
    <?php if($args['daycare']): ?>
        - <?=  __('Daycare', UTBF_TEXT_DOMAIN); ?> :
        <?php $i = 0;  foreach ($args['daycare'] as $daycare): ?>
            <?php if( $i != 0): ?>, <?php endif; ?>
                <?= $daycare ?>
        <?php $i++; endforeach; ?>
    <?php endif; ?>
    <?php
    /**
     *
     * Emergency
     *
     */
    ?>
    - <?=  __('Case of emergency', UTBF_TEXT_DOMAIN); ?> :
    <?=  $args['first_name_emergency']; ?>
    <?=  $args['last_name_emergency']; ?>
    /
    <?=  $args['phone_emergency']; ?>
<?php endif; ?>
