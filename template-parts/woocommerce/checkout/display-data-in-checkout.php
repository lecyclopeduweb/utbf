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
         * Canteen
         *
         */
        ?>
        <?php if(!empty($args['child']['canteen'])): ?>
            <li>
                <strong><?=  __('Canteen', UTBF_TEXT_DOMAIN); ?> : </strong>
                <ul>
                    <?php $count_Canteen = 0;  foreach ($args['child']['canteen'] as $canteen): ?>
                       <li>
                           <?= $canteen ?>
                       </li>
                    <?php $count_Canteen++; endforeach; ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php
        /**
         *
         * Daycare
         *
         */
        ?>
        <?php if(!empty($args['child']['daycare'])): ?>
            <li>
                <strong><?=  __('Daycare', UTBF_TEXT_DOMAIN); ?> :</strong>
                <ul>
                    <?php $count_daycare = 0;  foreach ($args['child']['daycare'] as $daycare): ?>
                        <li>
                            <?= $daycare ?>
                        </li>
                    <?php $count_daycare++; endforeach; ?>
                </ul>
            </li>
        <?php endif; ?>
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
