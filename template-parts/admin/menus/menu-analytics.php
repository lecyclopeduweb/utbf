<?php
/**
 * Menu Analytics
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>*
 *
 * @var Array     $args              Args
 */
?>
<div class="wrap">

    <h1><?= __('Analytics',UTBF_TEXT_DOMAIN); ?></h1>

    <div class="mt-20">

        <h4>
            <?= __('Choosing a product to export',UTBF_TEXT_DOMAIN); ?>
        </h4>

        <select id="utbf-analytics-product">
            <option value=""><?= __('--Choose a product--',UTBF_TEXT_DOMAIN); ?></option>
            <?php foreach($args['products'] as $product): ?>
                <option value="<?= $product->ID; ?>">#<?= $product->ID; ?> : <?= $product->post_title; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div id="analytics-error" class="mt-20"></div>

</div>