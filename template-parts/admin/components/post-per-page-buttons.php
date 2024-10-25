<?php
/**
 * Post per page
 *
 * @package WordPress
 *
 * @var String   $s                       Search Word
 * @var String   $ppp_init                Post Per Page init
 * @var String   $ppp_get                 Post Per Page
 * @var String   $slug_ppp                Slug Post Per Page
 * @var String   $base_url                Base url
 * @var Array    $ppp_array               Post Per Page Array
 */
?>
<div class="d-flex align-items-center">
    <label class="font-size-15"><?= __('Nombre d\'éléments affichés', UTBF_TEXT_DOMAIN); ?></label>
    <div class="custom-select ml-10">
        <div class="select-selected">
            <?= $args['ppp_get']; ?> <!-- Valeur initiale -->
        </div>
        <div class="select-items">
            <?php foreach($args['ppp_array'] as $ppp_get): ?>
                <?php $value = $ppp_get * $args['ppp_init']; ?>
                <div class="select-item"
                     data-value="<?= $value; ?>"
                     data-base-url="<?= $args['base_url']; ?>"
                     data-slug-ppp="<?= $args['slug_ppp']; ?>"
                     <?php if(!empty($args['s'])): ?>data-search="<?= $args['s']; ?>"<?php endif; ?>
                     onclick="
                        var baseUrl = this.getAttribute('data-base-url');
                        var slugPpp = this.getAttribute('data-slug-ppp');
                        var selectedValue = this.getAttribute('data-value');
                        var searchParam = this.getAttribute('data-search') ? '&s=' + this.getAttribute('data-search') : '';
                        window.location.href = baseUrl + searchParam + '&' + slugPpp + '=' + selectedValue;
                     ">
                    <?= $value; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
