<?php
/**
 * Orders
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args              Args
 */
?>
<div class="form-table form-table__wrap">

    <label for="orders"></label>

    <?php /* AppUtbf\Routes\Urls add_custom_param_to_user_edit_redirect() */ ?>
    <input id="input-hidden-tab" type="hidden" name="tab" value="<?= (!empty($_GET['tab']))? $_GET['tab'] : 'infos'; ?>">
    <input type="hidden" name="ppp" value="<?= (!empty($_GET['ppp']))? $_GET['ppp'] : UTBF_PPP_USERS_ORDERS; ?>">

    <div class="tablenav top">

        <div class="tablenav-pages">
            <?php
            load_template( UTBF_THEME_PATH . '/template-parts/admin/components/post-per-page.php',null,$args);
            ?>
        </div>

    </div>

    <?php if($args['count']>$args['ppp_get']) : ?>
        <div class="tablenav top">

            <div class="tablenav-pages">
                <?php
                load_template( UTBF_THEME_PATH . '/template-parts/admin/components/pagination.php',null,array_merge($args,['layout'=>'thead']));
                ?>
            </div>

        </div>
    <?php endif; ?>

    <table class="wp-list-table widefat fixed striped table-view-list users">
        <thead>
            <tr>
                <th scope="col" class="manage-column"><?= __('Order',UTBF_TEXT_DOMAIN); ?></th>
                <th scope="col" class="manage-column"><?= __('Date',UTBF_TEXT_DOMAIN); ?></th>
                <th scope="col" class="manage-column"><?= __('State',UTBF_TEXT_DOMAIN); ?></th>
                <th scope="col" class="manage-column"><?= __('Total',UTBF_TEXT_DOMAIN); ?></th>
            </tr>
        </thead>
        <tbody id="the-list" data-wp-lists="list:user">
            <?php if( !empty($args['orders']) ): ?>
                <?php foreach ( $args['orders'] as $order ): ?>
                    <?php
                    load_template( UTBF_THEME_PATH . '/template-parts/admin/users/order-item.php',null,$order);
                    ?>
                <?php endforeach; ?>
            <?php else:?>
                <tr >
                    <td class="colspanchange" colspan="4">
                        <?= __('No order', UTBF_TEXT_DOMAIN);?>
                    </td>
                </tr>
            <?php endif;?>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col" class="manage-column"><?= __('Order',UTBF_TEXT_DOMAIN); ?></th>
                <th scope="col" class="manage-column"><?= __('Date',UTBF_TEXT_DOMAIN); ?></th>
                <th scope="col" class="manage-column"><?= __('State',UTBF_TEXT_DOMAIN); ?></th>
                <th scope="col" class="manage-column"><?= __('Total',UTBF_TEXT_DOMAIN); ?></th>
            </tr>
        </tfoot>
    </table>

    <?php if($args['count']>$args['ppp_get']) : ?>
        <div class="tablenav bottom">

            <div class="tablenav-pages">
                <?php
                load_template( UTBF_THEME_PATH . '/template-parts/admin/components/pagination.php',null,array_merge($args,['layout'=>'tfoot']));
                ?>
            </div>

        </div>
    <?php endif; ?>

</div>