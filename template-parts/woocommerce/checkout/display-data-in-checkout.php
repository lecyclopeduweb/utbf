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
<?php if(!empty($args['child'])): ?>
    <ul>
        <?php
        /**
         *
         * Name
         *
         */
        ?>
        <li>
            <strong><?= __('Name', UTBF_TEXT_DOMAIN)  ?> : </strong>
            <?=  $args['child']['name']; ?>
        </li>
        <?php
        /**
         *
         * Classroom
         *
         */
        ?>
        <li>
            <strong><?= __('Classroom', UTBF_TEXT_DOMAIN)  ?> : </strong>
            <?= $args['child']['classroom']; ?>
        </li>
        <?php
        /**
         *
         * Emergency
         *
         */
        ?>
        <li>
            <strong><?=  __('Case of emergency', UTBF_TEXT_DOMAIN); ?> :</strong>
            <?=  $args['child']['first_name_emergency']; ?> <?=  $args['child']['last_name_emergency']; ?> / <?=  $args['child']['phone_emergency']; ?>
        </li>
    </ul>
<?php endif; ?>
