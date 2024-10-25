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
    <label class="font-size-15"><?= __('Number of items displayed', UTBF_TEXT_DOMAIN); ?></label>
    <select name="ppp" class="filter-ppp postform ml-10"
        slug-ppp="<?= $args['slug_ppp']; ?>"
        base-url="<?= $args['base_url']; ?>"
        keep_param='<?= (!empty($args['keep_param']))? json_encode($args['keep_param']): ''; ?>'
        <?php if(!empty($args['s'])): echo 'search="'.$args['s'].'"'; endif; ?>
        onchange="
            var baseUrl = this.getAttribute('base-url');
            var slugPpp = this.getAttribute('slug-ppp');
            var selectedValue = this.value;
            var searchParam = this.getAttribute('search') ? '&s=' + this.getAttribute('search') : '';
            window.location.href = baseUrl + searchParam + '&' + slugPpp + '=' + selectedValue;
        ">
        <?php foreach($args['ppp_array'] as $ppp_get):?>
            <?php $value = $ppp_get * $args['ppp_init']; ?>
            <option value="<?= $value; ?>"<?php if( $value == $args['ppp_get']): ?> selected <?php endif; ?>><?= $value; ?></option>
        <?php endforeach; ?>
    </select>
</div>